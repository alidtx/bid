<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\SmsLog;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\SmsController;
use Maatwebsite\Excel\Concerns\ToModel;

class SmsLogImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $liveDate = Carbon::parse('2022-04-05 16:33:22');
        $smsDate = Carbon::parse($row[2]);
     if ($smsDate->lt($liveDate)) {
        try {
            DB::beginTransaction();

            $smsController = new SmsController;

            \Log::info('Reply SMS -> ' . json_encode(['msisdn' => $row[0],'sms' => $row[1]]));

    
            $date = Carbon::parse($row[2])->format('Y-m-d');
            $msisdn = '880' . substr($row[0], -10);
            $sms = \strtoupper($row[1]);
            $answer = \trim(substr($sms, 3)); // take the first char
            $sms = preg_replace('!\s+!', ' ', $sms);

            $smsData = explode(' ', $sms, 3);
         
        
            $participant_name = @$smsData[1];
            $bank_name = @$smsData[2];

            // return response()->json(['response' => $data], 200, []);

            Log::channel('sms')->info('FROM ===>' . $msisdn . ' MESSAGE ===>' . $sms);

            $participant = Participant::where([
                'name' => $participant_name,
                // 'bank_name' => $bank_name,
                'status' => 1,
            ])->first();

            $status = $smsController->getSmsStatus($participant, $smsDate);

            $response = $status;

            $reply = $smsController->getSmsReply($status);

            SmsLog::create([
                'msisdn' => $msisdn,
                'participant_id' => $participant->id ?? null,
                'question_id' => 1,
                'sms_body' => $sms,
                'sms_reply' => $reply,
                'status' => $status,
                'sms_date' => $date,
                'created_at' => $smsDate,
                'updated_at' => $smsDate,
            ]);

            // $this->sendSmsToUser($msisdn, $reply);

            DB::commit();
            
            echo $reply;
            echo "</br>";
            // return response()->json(['response' => $response], 200, []);
        } catch (\Exception $exception) {

            DB::rollback();
     
            // return response()->json(['response' => $exception], 200, []);
            echo 'Thank you For your SMS';
            echo "</br>";

        }
     }
      
    }
}
