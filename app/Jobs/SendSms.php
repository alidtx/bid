<?php

namespace App\Jobs;


use Carbon\Carbon;
use App\Models\QuizData;
use App\Traits\SendSmsTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SendSmsTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $user;
    private $sms;
    private $type;

    public function __construct($user, $sms, $type = null)
    {
        $this->user = $user;
        $this->sms = $sms;
        $this->type = $type;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to = $this->user;
        $message = $this->sms;
        $type = $this->type;
        $this->sendSmsToUser($to, $message, $type);
        
    }
}
