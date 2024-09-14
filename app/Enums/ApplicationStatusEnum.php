<?php

namespace App\Enums;

use App\Enums\Utilities\HasOperations;
use App\Enums\Utilities\Stringable;

enum ApplicationStatusEnum: int
{
    use HasOperations,Stringable;
    case Pending = 1;
    case Accepted = 2;
    case Cancel = 3;
    case CancelByEmployee = 4;

    public function toBadge()
    {

        return match ($this) {
            ApplicationStatusEnum::Pending => "<span class='badge badge-pill badge-primary'>{$this->toString()->ucsplit()->implode(' ')}</span>",
            ApplicationStatusEnum::Accepted => "<span class='badge badge-pill badge-success'>{$this->toString()->ucsplit()->implode(' ')}</span>",
            ApplicationStatusEnum::Cancel, ApplicationStatusEnum::CancelByEmployee => "<span class='badge badge-pill badge-danger'>{$this->toString()->ucsplit()->implode(' ')}</span>",
        };
    }
}
