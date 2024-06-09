<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Jobs\SendSms;
use App\Models\Doctor;
use App\Models\SmsLog;
use App\Models\Question;
use App\Imports\SmsImport;
use App\Models\SentSmsLog;
use App\Jobs\SendCorrectSms;
use App\Models\Division;
use App\Models\Participant;
use App\Traits\SendSmsTrait;
use Illuminate\Http\Request;
use App\Traits\WriteException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class SmsController extends Controller
{

    use SendSmsTrait, WriteException;

    public function __construct(Request $request, Participant $model)
    {
         $this->model = $model;
        // $this->middleware('role:super-admin|admin', ['only' => ['create','store', 'edit','update']]);
        // $this->middleware('role:super-admin|admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('role:admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('can:create-participant', ['only' => ['create','store']]);
        // $this->middleware('can:send-sms', ['only' => ['create', 'edit', 'update']]);
    }

    public $smsStatus = 'SUCCESS';

    public function create()
    {
        $divisions = Division::get();
        return view('sms.create')->with('divisions', $divisions);
    }

    public function sendSms(Request $request)
    {
        try {
        $request->validate([
            'zone' => 'nullable|exists:divisions,name',
            'sms_body' => 'required|string',
            'file' => 'nullable|file',
        ]);
        // DB::beginTransaction();
        if($request->has('file')){
            ini_set('max_execution_time', '600');
            $file = $request->file('file');
            $filename = 'sms-file-' . \dechex(time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files/imports'), $filename);    
            Excel::import(new SmsImport($request->sms_body), public_path('files/imports/' . $filename));
        }
        else{
            $divisions =  Participant::where('zone',$request->zone)->select('msisdn', 'zone')->get();
            if(count($divisions)>0){
                foreach($divisions as $division){
                    SentSmsLog::create([
                        'msisdn' => $division->msisdn,
                        'zone' => $request->zone,
                        'sms_body' => $request->sms_body,
                    ]);
                    $this->sendSmsToUser($division->msisdn, $request->sms_body);

                }
            }
        }
        // DB::commit();
        return redirect()->back()->with('success', 'SMS sent Successfully!');

    } catch (\Exception $e) {
        DB::rollback();
        Log::error($e);
        return redirect()->back()->with('error', 'SMS sent Failed!');
    }
    }
   

    // public function sendCorrectAnswer()
    // {

    
    //     ini_set('max_execution_time', '600');

    //     $date = Carbon::now()->format('Y-m-d');

    //     $question = Question::where([
    //         'sending_date' => $date,
    //         'status' => 0,
    //         'is_used' => 1,
    //     ])->first(); //1

    //     $doctors = Doctor::where(['status' => 1])->get(); //5000

    //     if ($question) {
    //         foreach ($doctors as $doctor) {
    //             SendCorrectSms::dispatch($doctor, $question);
    //             // $this->sendSmsToUser($doctor->msisdn, $question->correct_answer_body);
    //         }

    //         $response = 'Done';zone
    //     } else {
    //         $response = 'No Question Found!';
    //     }
    //     Log::error('sendCorrectAnswer()' . $response);
    //     return response()->json([$response], 200, []);

    // }

    public function pushPullSms(Request $request)
    {

        try {
            // DB::beginTransaction();

            Log::info('Received SMS -> ' . json_encode($request->all()));
             
            $data = $request->all();
            $date = Carbon::now()->format('Y-m-d H:i:s');
            $msisdn = '880' . substr($data['msisdn'], -10);
            $sms = \strtoupper($data['sms']);
            $sms = preg_replace('!\s+!', ' ', $sms);
            $sms = str_replace("'", "", $sms);
            $sms = trim(substr($sms, 9));

            $words = explode(" ", $sms);
            $arr = array_reverse($words);

            $zone = strtoupper($words[count($words) - 1]);
            $class = strtoupper($words[count($words) - 2]);
            $age = strtoupper($words[count($words) - 3]);
            $name = strstr($sms,$arr[2],true);
            $phone_number = $request->msisdn;
            $reply = "";
            if(count($words) < 4){
                $reply = "দুঃখিত, আপনার বার্তার ফরম্যাটটি সঠিক নয়। সঠিক ফরম্যাটে চেষ্টা করুন অথবা নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100-এ।";
                $this->sendSmsToUser($msisdn, $reply);
                exit;
            }

            if(!$zoneName = Division::where('short_name',$zone)->first()){
                 $reply = "দুঃখিত, আপনার বিভাগ কোড ভুল হয়েছে। নিবন্ধনে সহায়তার জন্যে ফোন করুন 09678771100 নাম্বারে বা ভিজিট করুন  banglabid.com";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Division Incorrect', $date, $name, $age, $zone, $this->convertStringAge($class));
                 exit;
            }
            $division = Division::where('short_name',$zone)->whereRaw('SYSDATE() NOT BETWEEN start_time AND end_time')->first();
            if($division){
                 $reply = "দুঃখিত, $division->name_bn বিভাগ থেকে নিবন্ধনের সময় শেষ।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Registration Time Over', $date, $name, $age, $zoneName->name, $this->convertStringAge($class));
                 exit;
            }
            
            $classArray = [6,7,8,9,10,'SIX', 'SEVEN','EIGHT','NINE','TEN'];
            if(!in_array($class, $classArray)){
                 $reply = "দুঃখিত, এ প্রতিযোগিতাটি ষষ্ঠ থেকে দশম শ্রেণির শিক্ষার্থীদের জন্যে। নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100 নাম্বারে।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Class Incorrect', $date, $name, $age,  $zoneName->name, $this->convertStringAge($class));
                 exit;
            }

            $ageArray = [10,11,12,13,14,15,16,17,18,19,20];
            if(!in_array($age, $ageArray)){
                 $reply = "দুঃখিত, এ প্রতিযোগিতাটি ষষ্ঠ থেকে দশম শ্রেণির শিক্ষার্থীদের জন্যে। নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100 নাম্বারে।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Age Incorrect', $date, $name, $age,   $zoneName->name, $this->convertStringAge($class));
                 exit;
            }

            if(Participant::where('msisdn', $phone_number)->first()){
                 $reply = "আপনার নাম্বারটি এ বছরের ইস্পাহানি মির্জাপুর বাংলাবিদ-এর জন্যে ইতিমধ্যেই নিবন্ধিত আছে। তথ্য সহযোগিতার জন্যে ফোন করুন 09678771100 নাম্বারে।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Already Registered', $date, $name, $age, $zoneName->name, $this->convertStringAge($class));
                 exit;
            }

            // $shortname = Division::where('status', 1)->pluck('short_name')->toArray();
            // if(!in_array($words[4], $shortname)){
            //     dd("working");
            //     $reply = "দুঃখিত, আপনার বার্তার ফরম্যাটটি সঠিক নয়। সঠিক ফরম্যাটে চেষ্টা করুন অথবা নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100-এ।";
            //     $this->sendSmsToUser($msisdn, $reply);
            //     exit;
            // }

            $participant = $this->model->create([
                'name' => $name,
                'age' => $age,
                'class' => $this->convertStringAge($class),
                'msisdn' => $phone_number,
                'zone' =>  $zoneName->name,
                'registration_type' => 'Sms',
                'created_by' => null,
            ]);

            if($participant){
                $reply = "অভিনন্দন, আপনার নিবন্ধন সফল হয়েছে। চোখ রাখুন banglabid.com –এ।";
                $this->saveSmsLog($msisdn, $sms, $reply, 'Participant Created', $date, $name, $age, $zoneName->name, $this->convertStringAge($class));
                exit;
            }

            Log::channel('sms')->info('FROM ===>' . $msisdn . ' MESSAGE ===>' . $sms);
            // DB::commit();
            echo "No";
            // return response()->json(['response' => $response], 200, []);
        } catch (\Exception $exception) {
            // DB::rollback();
            $this->writeExceptionMessage($exception);
            // return response()->json(['response' => $exception], 200, []);
            // echo 'Thank you For your SMS';
        }
    }

    private function saveSmsLog($msisdn, $sms, $reply, $status, $date, $name, $age, $zone, $class){
        SmsLog::create([
            'msisdn' => $msisdn,
            'sms_body' => $sms,
            'sms_reply' => $reply,
            'status' => $status,
            'sms_date' => $date,
            'name' => $name,
            'age' => $age,
            'zone' => $zone,
            'class' => $class,
        ]);
        $this->sendSmsToUser($msisdn, $reply);
        echo "No";
    }


    private function convertStringAge($age) {

        switch ($age) {
            case 'SIX':
                return '6';

            case 'SEVEN':
                return '7';
            
            case 'EIGHT':
                return '8';
            
            case 'NINE':
                return '9';
            
            case 'TEN':
                return '10';
    
            default:
                return $age;
        }
    }




    public function pushPullSmsTest(Request $request)
    {

        try {
            // DB::beginTransaction();
            Log::info('Received SMS -> ' . json_encode($request->all()));
            // $numbers = $this->extract_numbers($request->sms);

            $data = $request->all();
            $date = Carbon::now()->format('Y-m-d H:i:s');
            $msisdn = '880' . substr($data['msisdn'], -10);
            $sms = \strtoupper($data['sms']);
            $sms = preg_replace('!\s+!', ' ', $sms);
            $sms = str_replace("'", "", $sms);
            $sms = substr($sms, 9);

            $words = explode(" ", $sms);
            $arr = array_reverse($words);

            
            $zone = strtoupper($words[count($words) - 1]);
            $class = strtoupper($words[count($words) - 2]);
            $age = strtoupper($words[count($words) - 3]);
            $name = strstr($sms,$arr[2],true);
            $phone_number = $request->msisdn;
            $reply = "";


            if(count($words)!=5){
                $reply = "দুঃখিত, আপনার বার্তার ফরম্যাটটি সঠিক নয়। সঠিক ফরম্যাটে চেষ্টা করুন অথবা নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100-এ।";
                $this->sendSmsToUser($msisdn, $reply);
                exit;
            }

            if($words[0]!='BANGLABID'){
                $reply = "দুঃখিত, আপনার বার্তার ফরম্যাটটি সঠিক নয়। সঠিক ফরম্যাটে চেষ্টা করুন অথবা নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100-এ।";
                $this->sendSmsToUser($msisdn, $reply);
                exit;
            }

            if(!Division::where('short_name',$zone)->first()){
                 $reply = "দুঃখিত, আপনার বিভাগ কোড ভুল হয়েছে। নিবন্ধনে সহায়তার জন্যে ফোন করুন 09678771100 নাম্বারে বা ভিজিট করুন  banglabid.com";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Division Incorrect', $date, $name, $age, $zone, $class);
                 exit;
            }
            $division = Division::where('name', $zone)->orWhere('status',0)->orWhere('short_name',$zone)->whereRaw('SYSDATE() BETWEEN start_time AND end_time')->first();
            dd($division);
            if($division){
                 $reply = "দুঃখিত, $division->name_bn বিভাগ থেকে নিবন্ধনের সময় শেষ।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Registration Time Over', $date, $name, $age, $zone, $class);
                 exit;
            }
            
            $classArray = [6,7,8,9,10];
            if(!in_array($class, $classArray)){
                 $reply = "দুঃখিত, এ প্রতিযোগিতাটি ষষ্ঠ থেকে দশম শ্রেণির শিক্ষার্থীদের জন্যে। নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100 নাম্বারে।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Class Incorrect', $date, $name, $age, $zone, $class);
                 exit;
            }

            $ageArray = [10,11,12,13,14,15,16,17,18,19,20];
            if(!in_array($age, $ageArray)){
                 $reply = "দুঃখিত, এ প্রতিযোগিতাটি ষষ্ঠ থেকে দশম শ্রেণির শিক্ষার্থীদের জন্যে। নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100 নাম্বারে।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Age Incorrect', $date, $name, $age, $zone, $class);
                 exit;
            }

            if(Participant::where('msisdn', $phone_number)->first()){
                 $reply = "আপনার নাম্বারটি এ বছরের ইস্পাহানি মির্জাপুর বাংলাবিদ-এর জন্যে ইতিমধ্যেই নিবন্ধিত আছে। তথ্য সহযোগিতার জন্যে ফোন করুন 09678771100 নাম্বারে।";
                 $this->saveSmsLog($msisdn, $sms, $reply, 'Already Registered', $date, $name, $age, $zone, $class);
                 exit;
            }

            $shortname = Division::where('status', 1)->pluck('short_name')->toArray();
            if(!in_array($words[4], $shortname)){
                $reply = "দুঃখিত, আপনার বার্তার ফরম্যাটটি সঠিক নয়। সঠিক ফরম্যাটে চেষ্টা করুন অথবা নিবন্ধন করুন banglabid.com থেকে বা ফোন করুন 09678771100-এ।";
                $this->sendSmsToUser($msisdn, $reply);
                exit;
            }

           
            
            $participant = $this->model->create([
                'name' => $name,
                'age' => $age,
                'class' => $class,
                'msisdn' => $phone_number,
                'zone' =>  $zone,
                'registration_type' => 'Sms',
                'created_by' => null,
            ]);

            if($participant){
                $reply = "অভিনন্দন, আপনার নিবন্ধন সফল হয়েছে। চোখ রাখুন banglabid.com –এ।";
                $this->sendSmsToUser($phone_number, $reply);
            }

            Log::channel('sms')->info('FROM ===>' . $msisdn . ' MESSAGE ===>' . $sms);
            // DB::commit();
            echo "No";
            // return response()->json(['response' => $response], 200, []);
        } catch (\Exception $exception) {
            // DB::rollback();
            $this->writeExceptionMessage($exception);
            // return response()->json(['response' => $exception], 200, []);
            // echo 'Thank you For your SMS';
        }
    }

    function extract_numbers($string)
    {
        // dd($string);
    preg_match_all('/([\d]+)/', $string, $match);
    $str = explode("",$string);
    dd($str[-1]);
    
        dd($match[0]);
    return $match[0];
    }

    // public function getSmsStatus($participant, $smsDate = null)
    // {

    //     if (!$participant) {
    //         return  SmsStatusEnum::INVALID;
    //     }

    //     $startDate = Carbon::parse($participant->voting_start_date_time)->format('Y-m-d H:i:s');
    //     $endDate = Carbon::parse($participant->voting_end_date_time)->format('Y-m-d H:i:s');
    //     $check = $smsDate ? Carbon::parse($smsDate)->between($startDate, $endDate) : Carbon::now()->between($startDate, $endDate);

    //     if (!$check) {
    //         return  SmsStatusEnum::VOTING_TIME_OVER;
    //     }

    //     $date = $smsDate ? Carbon::parse($smsDate)->format('Y-m-d') : Carbon::now()->format('Y-m-d');

    //     $record = VoteCount::updateOrCreate(
    //         [
    //             'participant_id' => $participant->id,
    //             'date' => $date,
    //         ],
    //         [
    //             'participant_id' => $participant->id,
    //             'date' => $date,
    //             'votes' => DB::raw('IFNULL(votes,0) + 1'),
    //         ]
    //     );

    //     if ($record) {
    //         return SmsStatusEnum::SUCCESS;
    //     } else {
    //         return SmsStatusEnum::FAILED;
    //     }

    // }

    public function getSmsReply($msisdn, $type)
    {
        switch ($type) {
            case 'CREDIT_LIMIT':
                $response = '';
                $sentSMS = SentSmsLog::where(['type' => 'CREDIT_LIMIT', 'msisdn' => $msisdn])->latest()->first();

                if (!$sentSMS || $sentSMS->status == 1) {
                    $response = 'You are not eligible for the upgrade or you have already upgraded! Thanks';
                    $this->smsStatus = 'INVALID';
                } else {
                    $response = 'Congratulation! Your credit limit is successfully updated to ' . $sentSMS->limit . 'Tk.';
                    $this->smsStatus = 'SUCCESS';
                    $sentSMS->update(['status'=> 1]);
                }

                return $response;
                break;
            case 'NID':
                return 'Thanks for your SMS.';
                break;

        }
    }

    

}
