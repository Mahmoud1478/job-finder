<?php

namespace App\Enums;

use App\Enums\Utilities\HasOperations;
use App\Enums\Utilities\Stringable;

enum UserTypeEnum: int
{
    use HasOperations,Stringable;
    case Employee = 1;
    case Employer = 2;
    case Admin = 3;

}
