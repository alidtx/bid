<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\SmsLogExport;
use App\Imports\SmsLogImport;
use Maatwebsite\Excel\Facades\Excel;

class SmsLogController extends Controller
{

    public $paginationLength;
    public $model;
    public $viewDirectory = 'sms-logs';
    public $route = 'sms-log';

    public function __construct(SmsLog $model)
    {
        $this->middleware('auth');

        $this->paginationLength = config('constants.pagination_length');
        $this->model = $model;

    }

    public function index(Request $request)
    {

        $query = $this->model->filter($request->except(['from_date', 'to_date']))->latest();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $startDate = date("Y-m-d", \strtotime(trim($request->from_date)));
            $endDate = date("Y-m-d", \strtotime(trim($request->to_date)));

            $query->whereBetween('sms_date', [$startDate, $endDate]);

        }

        if ($request->filled('submit') && $request->submit == 'export') {
            return (new SmsLogExport($query))->download('sms-log-' . \dechex(time()) . '.xlsx');
        }

        $smsLogs = $query->paginate($this->paginationLength);
        
        return view($this->viewDirectory . '.index', compact('smsLogs', 'request'));

    }

    public function creditLimit(Request $request)
    {

        $query = $this->model->filter($request->except(['from_date', 'to_date']))->where('type', 'CREDIT_LIMIT')->latest();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $startDate = date("Y-m-d", \strtotime(trim($request->from_date)));
            $endDate = date("Y-m-d", \strtotime(trim($request->to_date)));

            $query->whereBetween('sms_date', [$startDate, $endDate]);

        }

        if ($request->filled('submit') && $request->submit == 'export') {
            return (new SmsLogExport($query))->download('sms-log-credit-limit-' . \dechex(time()) . '.xlsx');
        }

        $smsLogs = $query->paginate($this->paginationLength);
        
        return view($this->viewDirectory . '.credit-limit', compact('smsLogs', 'request'));

    }
    public function nidCollection(Request $request)
    {

        $query = $this->model->filter($request->except(['from_date', 'to_date']))->where('type', 'NID')->where('sms_body', 'like', '%NID%')->latest();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $startDate = date("Y-m-d", \strtotime(trim($request->from_date)));
            $endDate = date("Y-m-d", \strtotime(trim($request->to_date)));

            $query->whereBetween('sms_date', [$startDate, $endDate]);

        }

        if ($request->filled('submit') && $request->submit == 'export') {
            return (new SmsLogExport($query))->download('sms-log-nid-collection-' . \dechex(time()) . '.xlsx');
        }

        $smsLogs = $query->paginate($this->paginationLength);
        
        return view($this->viewDirectory . '.nid-collection', compact('smsLogs', 'request'));

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
        ini_set('max_execution_time', '600'); 
        
        return (new SmsLogExport($request))->download('sms-log-' . \dechex(time()) . '.xlsx');
        // return Excel::download(new SmsLogExport(), 'sms-log-'.\dechex(time()).'.xlsx');
    }

    public function import()
    {
        ini_set('max_execution_time', '600');

        Excel::import(new SmsLogImport, 'files/sms-logs.csv');

        return response()->json(['done'], 200, []);
        // return Excel::download(new SmsLogExport(), 'sms-log-'.\dechex(time()).'.xlsx');
    }
}
