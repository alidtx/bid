<?php

namespace App\Http\Controllers;

use App\Exports\QuizExport;
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
use App\Models\Quiz;
use App\Traits\SendSmsTrait;
use Illuminate\Http\Request;
use App\Traits\WriteException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class QuizController extends Controller
{

    use SendSmsTrait, WriteException;

    public function __construct(Request $request, Quiz $model)
    {
         $this->model = $model;
        // $this->middleware('role:super-admin|admin', ['only' => ['create','store', 'edit','update']]);
        // $this->middleware('role:super-admin|admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('role:admin', ['only' => ['index','show', 'create','store', 'edit', 'update']]);
        // $this->middleware('can:create-participant', ['only' => ['create','store']]);
        // $this->middleware('can:send-sms', ['only' => ['create', 'edit', 'update']]);
    }

    public $smsStatus = 'SUCCESS';
    
    public function quiz(Request $request)
    {
        try {
            // DB::beginTransaction();
            Log::info('Received QUIZ SMS -> ' . json_encode($request->all()));
             
            $data = $request->all();
            $date = Carbon::now()->format('Y-m-d H:i:s');
            $msisdn = '880' . substr($data['msisdn'], -10);
            $sms = \strtoupper($data['sms']);
            $sms = preg_replace('!\s+!', ' ', $sms);
            $sms = str_replace("'", "", $sms);

            $words = explode(" ", $sms);

            $ans = strtoupper($words[count($words) - 1]);
            $phone_number = $request->msisdn;
            $reply = "Thank you For your SMS";
            
            $participant = $this->model->create([
                'msisdn' => $phone_number,
                'answer' => $ans,
                'sms_body' => $sms,
                'sms_reply' => $reply,
                'created_by' => null,
            ]);
            $this->sendSmsToUser($msisdn, $reply);

            Log::channel('sms')->info('FROM ===>' . $msisdn . ' MESSAGE ===>' . $sms);
            // DB::commit();

            // echo 'Thank you For your SMS';
            echo "No";
            // return response()->json(['response' => $response], 200, []);
        } catch (\Exception $exception) {

            DB::rollback();
            $this->writeExceptionMessage($exception);
            // return response()->json(['response' => $exception], 200, []);
            // echo 'Thank you For your SMS';
        }
    }

    public function quizReport(Request $request){
        $data['tableData'] = Quiz::filter($request->all())->orderBy('id', 'desc')->paginate(10);
        $data['download_url'] = route('report.quiz-download') . '?' . http_build_query($request->all());
        $data['divisions'] = Division::where('status',1)->get();
        return view('report.quiz_report')->with($data);
    }


    public function exportToCsv(Request $request)
    {   
        ini_set('max_execution_time', '600');
        $query = Quiz::filter($request->all())->orderBy('id', 'desc');
        return (new QuizExport($query))->download('quiz-report-' . \dechex(time()) . '.xlsx');
    }
    
}
