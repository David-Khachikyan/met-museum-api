<?php

namespace App\Traits\Array;

use Illuminate\Support\Carbon;

trait WithSnakeCaseToCamelCaseArray
{
    private function toCamelCase(string $string): string
    {
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        return lcfirst($string);
    }

    public function convertKeysToCamelCase(array $array): array
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            $newKey = $this->toCamelCase($key);
            if (is_array($value)) {
                if (empty($value)) {
                    $newArray[$newKey] = null;
                } else {
                    $newArray[$newKey] = $this->convertKeysToCamelCase($value);
                }
            } else {
                if ($newKey == 'eventDate') {
                    $newArray[$newKey] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
                } else {
                    $newArray[$newKey] = (string)$value;
                }
            }
        }
        return $newArray;
    }
}
