<?php

namespace App\Imports;

use App\Jobs\SendSms;
use App\Models\SentSmsLog;
use App\Traits\WriteException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Traits\SendSmsTrait;

class SmsImport implements ToModel, WithHeadingRow
{
    use WriteException;
    use SendSmsTrait;
    /**
     * Class constructor.
     */
    public $body;
    public $type;
    public function __construct($smsBody = null, $smsType = null)
    {
        $this->body = $smsBody;
        $this->type = $smsType;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        try {
          DB::beginTransaction();
          SentSmsLog::create([
            'msisdn' => $row['msisdn'],
            'sms_body'    => $this->formatSmsBody($row),
            'type' => $this->type,
            'limit' => $row['limit'] ??  null,
        ]);
        // SendSms::dispatch($row['msisdn'], $this->formatSmsBody($row),  $this->type);  
        $this->sendSmsToUser($row['msisdn'], $this->formatSmsBody($row));
        DB::commit();
        } catch (\Exception $exception) {
          DB::rollback();
          $this->writeExceptionMessage($exception);
        }
        
    }

    public function formatSmsBody($row){
       $smsBody = \str_replace('[name]', $row['name'] ?? '', $this->body);
       $smsBody = \str_replace('[limit]', $row['limit'] ?? '', $smsBody);
       return $smsBody;
    }
}
