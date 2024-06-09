<?php

namespace App\Http\Controllers;

use App\Jobs\SendSms;
use App\Jobs\SendEmail;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Imports\ParticipantImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ParticipantRequest;
use App\Models\Division;
use App\Traits\SendSmsTrait;
use Illuminate\Support\Facades\Redirect;

class ParticipantController extends Controller
{
    use SendSmsTrait;
    public $paginationLength;
    public $model;
    public $viewDirectory = 'participants';
    public $route = 'participant';

    public function __construct(Request $request, Participant $model)
    {
        $this->paginationLength = config('constants.pagination_length');
        $this->model = $model;

        // $this->middleware('role:super-admin|admin', ['only' => ['create','store', 'edit','update']]);
        // $this->middleware('role:super-admin|admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('role:admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('can:create-participant', ['only' => ['create','store']]);
        // $this->middleware('can:add-participant', ['only' => ['index','edit', 'update', 'store', 'register']]);

    }

    public function index(Request $request)
    {

        // $closingDate = date('Y-m-d H:i', strtotime('2022-05-27 23:59'));
        // $now = date('Y-m-d H:i');

        // if ($now >= $closingDate) {
        //     return view($this->viewDirectory . '.time-over');
        // }
        $divisions = Division::where('status',1)->whereRaw('SYSDATE() BETWEEN start_time AND end_time')->get();
        return view($this->viewDirectory . '.index')->with('divisions', $divisions);

    }
    public function registrationForm(Request $request)
    {
        return view($this->viewDirectory . '.form');
    }


    public function register(Request $request)
    {
        if ($request->filled('phone_number')) {
            $request->phone_number = $this->bn2en($request->phone_number);
            $request->merge([
                'phone' => '880' . substr($request->phone_number, -10),
            ]);
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'age' => 'required',
            'class' => 'required|string',
            'phone' => 'required|regex:^(?:\+?88)?01[2-9]\d{8}$^|unique:participants,msisdn',
            'zone' => 'required|string|exists:divisions,name',
        ],
         [
            'name.required' => 'নাম নিবন্ধন করা আবশ্যক',
            'age.required' => 'বয়স নিবন্ধন করা আবশ্যক',
            'class.required' => 'শ্রেণী নিবন্ধন করা আবশ্যক',
            'zone.required' => 'বিভাগ নিবন্ধন করা আবশ্যক', 
            'phone.required' => 'মোবাইল নাম্বার নিবন্ধন করা আবশ্যক',      
            'phone.unique' => 'এই মোবাইল নাম্বারটি নিবন্ধন করা হয়েছে',
            'phone.regex' => 'এই মোবাইল নাম্বার বিন্যাস সঠিক নয়',
        ]
    );
        try {
            DB::beginTransaction();
            $participant = $this->model->create([
                'name' => $request->name,
                'age' => $request->age,
                'class' => $request->class,
                'msisdn' => $request->phone,
                'zone' =>  $request->zone,
                'registration_type' => $request->registration_type ? $request->registration_type : 'Web',
                'created_by' => auth()->user()->id ?? null,
            ]);
            if($participant){
                $reply = "অভিনন্দন, আপনার নিবন্ধন সফল হয়েছে। চোখ রাখুন banglabid.com –এ।";
                $this->sendSmsToUser($request->phone, $reply);
            }

            DB::commit();
            if(isset(auth()->user()->id)){
             return redirect()->back()->with('success', 'Participant Added Successfully!');
             }
            return Redirect::to('https://banglabid.com/signup/success');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('error', 'রেজিস্ট্রেশন সফল হয়নি! পরে আবার চেষ্টা করুন.');
        }
    }

    function bn2en($number)
    {
        $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        return str_replace($bn, $en, $number);
    }


    public function create()
    {

        return view($this->viewDirectory . '.create');

    }

    public function store(ParticipantRequest $request)
    {

        try {
            DB::beginTransaction();

            $dates = [$request->from_date, $request->to_date];

            $request->merge([
                'voting_start_date_time' => date("Y-m-d 00:00:00", \strtotime(trim($dates[0]))),
                'voting_end_date_time' => date("Y-m-d 23:59:00", \strtotime(trim($dates[1]))),
            ]);

            $data = $request->except(['_token', 'myDateRange', 'from_date', 'to_date']);

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = \dechex(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/participants'), $filename);
                $data['image'] = $filename;

            }

            $data = $this->model->create($data);
            $role = Role::firstOrCreate(['name' => 'participant']);
            $data->assignRole($role);

            DB::commit();

            if ($data) {
                return \redirect()->route($this->route . '.index')->with('success', 'Participant Added Successfully!');
            }

        } catch (\Exception $exception) {
            DB::rollback();
            $this->model->writeExceptionMessage($exception);
            return \redirect()->back()->with('error', 'Participant Can Not Be Added!');

        }

    }

    public function edit($id)
    {

        $participant = $this->model->findOrFail($id);
        $divisions = Division::where('status',1)->get();
        return view($this->viewDirectory . '.edit', compact('participant', 'divisions'));

    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'age' => 'required|in:10,11,12,13,14,15,16,17,18,19,20',
                'class' => 'required|in:6,7,8,9,10',
                'msisdn' => 'required|regex:^(?:\+?88)?01[2-9]\d{8}$^',
            ],
             [
                'name.required' => 'নাম নিবন্ধন করা আবশ্যক',
                'age.required' => 'বয়স নিবন্ধন করা আবশ্যক',
                'class.required' => 'শ্রেণী নিবন্ধন করা আবশ্যক',
                'phone.required' => 'মোবাইল নাম্বার নিবন্ধন করা আবশ্যক',      
                'phone.unique' => 'এই মোবাইল নাম্বারটি নিবন্ধন করা হয়েছে',
                'phone.regex' => 'এই মোবাইল নাম্বার বিন্যাস সঠিক নয়',
            ]
        );

            $record = $this->model->findOrFail($id);
            $record->name = $request->name;
            $record->msisdn = $request->msisdn;
            $record->age = $request->age;
            $record->class = $request->class;
            $record->zone = $request->zone;
            $record->updated_by = auth()->user()->id ?? null;
            $record->save();
            DB::commit();

            if ($record) {
                return redirect()->route('report.participant')->with('success', 'Participant Updated Successfully!');
            }

        } catch (\Exception $exception) {
            // DB::rollback();
            Log::info($exception);
            return \redirect()->back()->with('error', 'Participant Can Not Be Updated!');

        }

    }

    public function import()
    {
        Excel::import(new ParticipantImport, 'files/corporate-list.csv');
        Excel::import(new ParticipantImport, 'files/participant-list.csv');
        Excel::import(new ParticipantImport, 'files/participant-list-2.csv');

        return response()->json(['done'], 200, []);
    }


}
