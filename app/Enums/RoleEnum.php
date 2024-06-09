<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const SUPERADMIN = "super-admin";
    const ADMIN = "admin";
    const VIEWER = "viewer";
    const PARTICIPANT = "participant";
    const CALLCENTER = "Call Center";
    const FIELDAGENT = "Field agent";
    const EDITOR = "editor";

}
