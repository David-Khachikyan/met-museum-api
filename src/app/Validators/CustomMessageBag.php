<?php

namespace App\Validators;

use Illuminate\Support\MessageBag;

class CustomMessageBag extends MessageBag
{
    public function add($key, $message)
    {
        return parent::add($key, SnakeCaseValidationFormatter::formatMessage($message));
    }
}
