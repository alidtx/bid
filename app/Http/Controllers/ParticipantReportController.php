<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantExport;
use App\Exports\SmsLogExport;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Division;


class ParticipantReportController extends Controller
{

    public function __construct(Request $request, Participant $model)
    {

        // $this->middleware('role:super-admin|admin', ['only' => ['create','store', 'edit','update']]);
        // $this->middleware('role:super-admin|admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('role:admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('can:create-participant', ['only' => ['create','store']]);
        // $this->middleware('can:participant-report', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $data['tableData'] = Participant::filter($request->all())->orderBy('id', 'desc')->paginate(10);
        $data['download_url'] = route('report.participant.download') . '?' . http_build_query($request->all());
        $data['divisions'] = Division::where('status',1)->get();
        return view('report.participant_report')->with($data);
    }

    public function exportToCsv(Request $request)
    {   
        ini_set('max_execution_time', '600');
        $query = Participant::filter($request->all())->orderBy('id', 'desc');

        return (new ParticipantExport($query))->download('participant-report-' . \dechex(time()) . '.xlsx');

    }

    public function ParticipantReportCallCenter(Request $request)
    {   
        if($request->has('mobile_no')){
            $data['tableData'] = Participant::filter($request->all())->orderBy('id', 'desc')->paginate(10);
        }
        $data['download_url'] = route('report.participant.download') . '?' . http_build_query($request->all());
        $data['divisions'] = Division::where('status',1)->get();
        return view('report.call_center')->with($data);
    }

    public function participantAdd()
    {
        $divisions = Division::where('status',1)->get();
        return view('report.participant_add')->with('divisions', $divisions);
    }
}
