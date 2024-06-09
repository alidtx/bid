<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Imports\DoctorImport;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DoctorRequest;
use Maatwebsite\Excel\Facades\Excel;

class DoctorController extends Controller
{
    public $paginationLength;
    public $model;
    public $viewDirectory = 'doctors';
    public $route = 'doctor';

    public function __construct(Request $request, Doctor $model){
        $this->paginationLength = config('constants.pagination_length');
        $this->model = $model;

        $this->middleware('can:read-doctor', ['only' => ['index','show']]);
        $this->middleware('can:create-doctor', ['only' => ['create','store']]);
        $this->middleware('can:edit-doctor', ['only' => ['edit', 'update']]);

        if ($request->has('msisdn')) {
            $request->merge([
                'msisdn' => '880'.substr($request->msisdn,-10)
            ]);
        }

    }

    public function index(Request $request)
    {

        $doctors = $this->model->latest()->paginate($this->paginationLength);
    
        return view($this->viewDirectory.'.index', compact('doctors', 'request'));

    }
    public function create()
    {

        return view($this->viewDirectory.'.create');

    }

    public function store(DoctorRequest $request)
    {

        try {
            DB::beginTransaction();

            $data = $request->validated();

            if($request->file('image')){
                $file= $request->file('image');
                $filename= \dechex(time()).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/doctors'), $filename);
                $data['image']= $filename;

            }

            $data = $this->model->create($data);
  
            DB::commit();
  
            if ($data) {
              return \redirect()->route($this->route.'.index')->with('success', 'Doctor Added Successfully!');
           }
  
          } catch (\Exception $exception) {
            DB::rollback();
  
            $this->model->writeExceptionMessage($exception);
            return \redirect()->back()->with('error', 'Doctor Can Not Be Added!');
  
          }

    }

    public function edit($id)
    {

        $doctor = $this->model->findOrFail($id);

        return view($this->viewDirectory.'.edit', compact('doctor'));

    }


    public function update(DoctorRequest $request, $id)
    {

        try {
            DB::beginTransaction();
            $record = $this->model->findOrFail($id);

            $data = $request->validated();

            if($request->file('image')){
                $file= $request->file('image');
                $filename= \dechex(time()).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/doctors'), $filename);
                $data['image']= $filename;

            }

            $data = $record->update($data);
  
            DB::commit();
  
            if ($data) {
              return \redirect()->route($this->route.'.index')->with('success', 'Doctor Updated Successfully!');
           }
  
          } catch (\Exception $exception) {
            DB::rollback();
  
            $this->model->writeExceptionMessage($exception);
            return \redirect()->back()->with('error', 'Doctor Can Not Be Updated!');
  
          }

    }


    public function import() 
        {
            Excel::import(new DoctorImport, 'files/corporate-list.csv');
            Excel::import(new DoctorImport, 'files/doctor-list.csv');
            Excel::import(new DoctorImport, 'files/doctor-list-2.csv');

            return response()->json(['done'], 200, []);
        }

}
