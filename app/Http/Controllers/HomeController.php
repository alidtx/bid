<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SmsLog;
use App\Models\VoteCount;
use App\Models\SentSmsLog;
use App\Models\Participant;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $paginationLength;

    public function __construct()
    {
        $this->middleware('auth');
        $this->paginationLength = config('constants.pagination_length');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data['totalParticipant'] = Participant::count();
        $data['totalSms'] = SmsLog::count() + Quiz::count();
        $data['totalSms'] = Participant::where('registration_type', 'Sms')->count();
        $data['totalSmsToday'] = Participant::whereDate('created_at',date('Y-m-d'))->where('registration_type', 'Sms')->count();


        $data['totalParticipantToday'] = Participant::whereDate('created_at',date('Y-m-d'))->count();
        $data['totalWebCountToday'] = Participant::whereDate('created_at',date('Y-m-d'))->where('registration_type', 'Web')->count();
        $data['totalWebCount'] = Participant::where('registration_type', 'Web')->count();
        $data['participants'] = Participant::orderBy('id', 'desc')->limit(15)->get();

        return view('home')->with($data);
    }


    public function divisionWiseParticipantChart(Request $request)
    {
        $dhaka  = Participant::where('zone','Dhaka')->count();
        $mymensingh  = Participant::where('zone','Mymensingh')->count();
        $rajshahi  = Participant::where('zone','Rajshahi')->count();
        $rangpur  = Participant::where('zone','Rangpur')->count();
        $barisal  = Participant::where('zone','Barisal')->count();
        $sylhet  = Participant::where('zone','Sylhet')->count();
        $khulna  = Participant::where('zone','Khulna')->count();
        $Chittagong  = Participant::where('zone','Chittagong')->count();
        $Comilla  = Participant::where('zone','Comilla')->count();

        return ['counts' => [$dhaka,$mymensingh, $rajshahi, $rangpur, $barisal, $sylhet, $khulna, $Chittagong, $Comilla], 'type' => ['Dhaka','Mymensingh', 'Rajshahi', 'Rangpur','Barisal', 'Sylhet', 'Khulna', 'Chittagong', 'Comilla']];
    }


    public function registrationTypeWiseChart(Request $request)
    {
         $web = Participant::where('registration_type', 'Web')->count();
         $sms = Participant::where('registration_type', 'Sms')->count();
         $callCenter = Participant::where('registration_type', 'Call Center')->count();
         $fieldAgent = Participant::where('registration_type', 'Field agent')->count();
         
         return ['counts' => [$web,$sms, $callCenter, $fieldAgent], 'type' => ['Web', 'Sms', 'Call Center', 'Field agent']];

    }

    public function getCreditChartData(Request $request)
    {

        $receivedCount = SmsLog::where('type', 'CREDIT_LIMIT')->count();
        $sentCount = SentSmsLog::where('type', 'CREDIT_LIMIT')->count();

       return ['counts' => [ $receivedCount, $sentCount], 'type' => ['Received', 'Sent']];
    }
    public function getNidChartData(Request $request)
    {

        $receivedCount = SmsLog::where('type', 'NID')->where('sms_body', 'like', '%NID%')->count();
        $sentCount = SentSmsLog::where('type', 'NID')->where('sms_body', 'like', '%NID%')->count();

       return ['counts' => [ $receivedCount, $sentCount], 'type' => ['Received', 'Sent']];
    }

    public function getOverallChartData(Request $request)
    {

        $data = Participant::addSelect(['votes' => VoteCount::selectRaw('sum(votes) as total_votes')
        ->whereColumn('participant_id', 'participants.id')
        ->groupBy('participant_id')
        ])->orderBy('votes', 'DESC')->take(10)->get();


        $votes = [];
        $participants = [];

        foreach ($data as $participant) {
            $votes[] = $participant->votes;
            $participants[] = $participant->name;
        }

       return ['votes' => $votes, 'participants' => $participants];
    }
}
