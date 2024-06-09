<?php

namespace App\Jobs;

use App\Traits\SendSmsTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCorrectSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SendSmsTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user;
    private $sms;

    public function __construct($user, $sms)
    {
        $this->user = $user;
        $this->sms = $sms;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to = $this->user->msisdn;
        $message = $this->sms->correct_answer_body;
        $this->sendSmsToUser($to, $message);
    }
}
