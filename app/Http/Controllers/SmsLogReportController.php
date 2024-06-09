<?php

namespace App\Http\Controllers;

use App\Exports\SmsReportExport;
use App\Exports\SentSmsReportExport;
use App\Exports\VoteCountExport;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Division;
use App\Models\SentSmsLog;
use App\Models\SmsLog;

class SmsLogReportController extends Controller
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
        $data['tableData'] = SmsLog::filter($request->all())->orderBy('id', 'desc')->paginate(10);
        $data['download_url_log'] = route('report.sms-log.download') . '?' . http_build_query($request->all());
        $data['divisions'] = Division::where('status',1)->get();
        return view('report.sms_log_report')->with($data);
    }

    public function exportToCsv(Request $request)
    {   
        ini_set('max_execution_time', '600');
        $query = SmsLog::filter($request->all())->orderBy('id', 'desc');

        return (new SmsReportExport($query))->download('sms-log-report-' . \dechex(time()) . '.xlsx');
    }

    public function sentSmsLog(Request $request)
    {
        $data['tableData'] = SentSmsLog::filter($request->all())->orderBy('id', 'desc')->paginate(10);
        $data['sent_sms_download_url'] = route('report.sent-sms-log.download') . '?' . http_build_query($request->all());
        $data['divisions'] = Division::where('status',1)->get();
        return view('report.sent_sms_log_report')->with($data);        
    }

    public function sentSmsLogExportCsv(Request $request)
    {
        ini_set('max_execution_time', '600');
        $query = SentSmsLog::filter($request->all())->orderBy('id', 'desc');

        return (new SentSmsReportExport($query))->download('sms-log-report-' . \dechex(time()) . '.xlsx');

    }

    public function participantAdd()
    {
        $divisions = Division::where('status',1)->get();
        return view('report.participant_add')->with('divisions', $divisions);
    }


}
