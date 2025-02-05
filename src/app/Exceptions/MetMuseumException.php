<?php

namespace App\Exceptions;

use Exception;


class MetMuseumException extends Exception
{
    protected $code;
    protected $message;


    public function __construct(string $message = 'unable_to_interact_with_met_museum', int $code = 500)
    {
        $this->code = $code;
        $this->message = $message;
    }
}
