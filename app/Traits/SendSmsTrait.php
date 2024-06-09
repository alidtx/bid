<?php

namespace App\Traits;

use App\Traits\WriteException;
use Illuminate\Support\Facades\Log;

trait SendSmsTrait
{
    use WriteException;

    public function sendSmsToUser($to, $message)
    {
        try {

            /**
             * !! need to send SMS HERE
             */
            Log::channel('sms')->info('TO ===>'  . $to. ' MESSAGE ===>'  . trim($message));

            $message_bn = strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', trim($message))));
            
            $sms = $message_bn;
            $user = "ispahani_banglabid";
            $pass = "94W222j<";
            $sid = "BANGLABIDBANGLA";
            $msisdn = $to;
            //$url="http://sms.sslwireless.com/pushapi/idea_networks/server.php";
            $url = "http://192.168.92.138/pushapi/dynamic/server.php";
            $unique_id = "Banglabid";
            $param = "user=$user&pass=$pass&sid=$sid&";
            $sms = "sms[0][0]=$msisdn&sms[0][1]=" . urlencode($sms) . "&sms[0][2]=$unique_id";
            $data = $param . $sms . $sid;
            $crl = curl_init();

            curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($crl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($crl, CURLOPT_URL, $url);

            curl_setopt($crl, CURLOPT_HEADER, 0);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($crl, CURLOPT_POST, 1);

            curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($crl);


            Log::info($response);

            Log::info('SMS response ========> ' . json_encode($response));

            curl_close($crl);

        } catch (\Exception $exception) {
             Log::error($exception);
            $this->writeExceptionMessage($exception);
        }

        return null;
    }
}
