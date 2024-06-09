<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public $route = 'division';
   
    public function index(){
        $divisions = Division::get();
        return view('division.index')->with('divisions',$divisions);
    }

    public function edit($id){
        $division = Division::findOrFail($id);
        return view('division.edit', compact('division'));
    }

    public function update(Request $request, $id)
    {

        try {
            $record = Division::findOrFail($id);
            // $data = $request->validated();
            $startTime = $request->start_time ? Carbon::parse($request->start_time)->format('Y-m-d').' '.Carbon::now()->format('H:i:s') :  $record->start_time;
            $endTime = $request->end_time ? Carbon::parse($request->end_time)->format('Y-m-d').' '.Carbon::now()->format('H:i:s') :  $record->end_time;
            $record->start_time = $startTime;
            $record->end_time = $endTime;
            $record->status = $request->status;
            $record->updated_by = auth()->user()->id ?? null;
            $record->save();    
            if ($record) {
              return \redirect()->route('division.list')->with('success', 'Division Updated Successfully!');
           }
  
          } catch (\Exception $exception) {
            return \redirect()->back()->with('error', 'Division Can Not Be Updated!');
  
          }

    }


}
