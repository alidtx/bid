<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailBounceController extends Controller
{

    private $response = [];

    public function __construct()
    {
        //
    }

    public function handle(Request $request)
    {
        try {

            Log::info('Mail Bounce Request: ' . print_r($request->all(), true));

            $postBody = file_get_contents('php://input');

            Log::info("Mail bounce data : >>> " . json_encode($postBody));

            // JSON decode the body to an array of message data
            $message = json_decode($postBody);
            $mailBounce = null;
            if ($message) {
                try {
                    //$message = json_decode($message->Message);

                    $mailBounce = DB::table('mail_bounces')->insert([
                        'email' => $message->bounce->bouncedRecipients[0]->emailAddress,
                        'bounce_time' => date('Y-m-d H:i:s'),
                        'bounce_type' => $message->bounce->bounceType,
                        'json_data' => $postBody,
                    ]);

                    Log::info("Mail Bounce email address has been saved >>" . $message->bounce->bouncedRecipients[0]->emailAddress);

                } catch (\Exception $e) {
                    Log::error("Mail Bounce data saved failed >>" . $e->getMessage());
                }

            }else{
            Log::info('No message found!');
            return $this->successResponse('No data found', null, 'No data');

            }

            if ($mailBounce) {
                Log::info('Mail Bounce email address has been saved: ' . $message->bounce->bouncedRecipients[0]->emailAddress);
                $this->response['data'] = $mailBounce;
                return $this->successResponse('Successfully data retrieved', null, $this->response);
            }
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
