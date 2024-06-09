<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
   

    private $response = [];

    public function __construct()
    {
        //
    }

    public function handle(Request $request)
    {
        try {
            Log::info('Complaint Request: ' . print_r($request->all(), true));
            $this->response['data'] = $request->all();
            $postBody = file_get_contents('php://input');
            $message = json_decode($postBody);
            Log::info('Complaint Request: ' . json_encode($postBody));
            return $this->successResponse('Successfully data retrieved', null, $this->response);
        } catch (\Exception $exception) {
            Log::error($exception);
            return $this->invalidResponse($exception->getMessage());
        }
    }

    public function invalidResponse(string $message)
    {
        return response()->json([
            'status' => 'FAIL',
            'message' => $message,
            'data' => null,
            'code' => 422,
        ], 200);
    }

    public function successResponse(string $message, string $ui = null, $data = null)
    {
        return response()->json([
            'ui' => $ui,
            'message' => $message,
            'status' => 'SUCCESS',
            'data' => $data,
            'code' => 200,
        ], 200);
    }

}
