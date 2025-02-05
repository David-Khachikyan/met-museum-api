<?php

namespace App\Traits\Array;

trait WithCamelCaseToSnakeCase
{
    private function camelCaseToSnakeCase($str): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $str));
    }
}
