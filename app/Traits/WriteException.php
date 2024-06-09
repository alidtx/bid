<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait WriteException
{
    
    public function writeExceptionMessage(\Exception $exception)
    {
        Log::error('[Class => ' . __CLASS__ . ", function => " . __FUNCTION__ . " ]" . " @ " . $exception->getFile() . " "
            . $exception->getLine() . " " . $exception->getMessage());
    }
}
