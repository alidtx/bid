<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SmsStatusEnum extends Enum
{
  
    const INVALID =   'INVALID';
    const SUCCESS = 'SUCCESS';
    const VOTING_TIME_OVER = 'VOTING_TIME_OVER';
    const FAILED = 'FAILED';
  
    
}
