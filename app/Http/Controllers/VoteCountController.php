<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use App\Models\VoteCount;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\VoteCountExport;
use App\Exports\VotersVoteExport;
use App\Exports\ParticipantExport;
use Illuminate\Support\Facades\DB;

class VoteCountController extends Controller
{
    public $paginationLength;
    public $model;
    public $viewDirectory = 'vote-counts';
    public $route = 'vote-count';

    public function __construct(VoteCount $model){
        $this->middleware('auth');

        $this->paginationLength = config('constants.pagination_length');
        $this->model = $model;

    }

    public function index(Request $request)
    {

   
        $query = Participant::filter($request->except('sortBy'))->addSelect(['votes' => VoteCount::selectRaw('sum(votes) as total_votes')
        ->whereColumn('participant_id', 'participants.id')
        ->groupBy('participant_id')
    ]);

        if ($request->filled('sortBy') && ($request->sortBy == 'DESC' || $request->sortBy == 'ASC')) {
            $query =  $query->orderBy('votes', $request->sortBy);
      
        }
            
    //   dd(1);
        if($request->filled('submit') && $request->submit == 'export'){
            return (new ParticipantExport($query))->download('total-vote-counts-'.\dechex(time()).'.xlsx');
        }

        $data = $query->paginate($this->paginationLength);
        $participants = Participant::select(['id', 'name', 'bank_name']) ->get();

        // dd($data);

        return view($this->viewDirectory.'.index', compact( 'data', 'request', 'participants'));

    }
    public function dateWiseReport(Request $request)
    {

        $query = $this->model->filter($request->except(['from_date', 'to_date']))->latest();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $startDate = date("Y-m-d", \strtotime(trim($request->from_date)));
            $endDate = date("Y-m-d", \strtotime(trim($request->to_date)));

            $query->whereBetween('date', [$startDate, $endDate]);
        }


        if($request->filled('submit') && $request->submit == 'export'){
            return (new VoteCountExport($query))->download('date-wise-vote-counts-'.\dechex(time()).'.xlsx');
        }

        $voteCounts = $query->paginate($this->paginationLength);

        $participants = Participant::select(['id', 'name', 'bank_name'])->get();

        return view($this->viewDirectory.'.date-wise-report', compact('voteCounts', 'request', 'participants'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function export(Request $request) 
    {
         return (new VoteCountExport($request))->download('vote-counts-'.\dechex(time()).'.xlsx');
        // return Excel::download(new VoteCountExport(), 'vote-counts-'.\dechex(time()).'.xlsx');
    }

    public function voterVoteCount (Request $request) 
    {
         
        $query = SmsLog::filter($request->except('sortBy'))
        ->select('msisdn', DB::raw('count(*) as total'))
        ->groupBy('msisdn');


        if ($request->filled('sortBy') && ($request->sortBy == 'DESC' || $request->sortBy == 'ASC')) {
            $query =  $query->orderBy('total', $request->sortBy);
      
        }
            
    //   dd(1);
        if($request->filled('submit') && $request->submit == 'export'){
            return (new VotersVoteExport($query))->download('voters-vote-counts-'.\dechex(time()).'.xlsx');
        }

        $data = $query->paginate($this->paginationLength);

        return view($this->viewDirectory.'.voters-vote', compact( 'data', 'request'));
    }
}
