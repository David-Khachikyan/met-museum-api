<?php

namespace App\Validators;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    public function passes()
    {
        $validator = parent::passes();

        $messages = [];
        foreach ($this->messages()->getMessages() as $key => $value) {
            $messages[$key] = SnakeCaseValidationFormatter::formatErrorMessages($value);
        }

        $this->messages = new CustomMessageBag($messages);

        return $validator;
    }
}
