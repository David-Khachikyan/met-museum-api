<?php

namespace App\Validators;

use function collect;

class SnakeCaseValidationFormatter
{
    public static function formatErrorMessages(array $errorMessages): array
    {
        return collect($errorMessages)
            ->map(function ($errorMessage) {
                return self::formatMessage($errorMessage);
            })
            ->toArray();
    }

    public static function formatMessage(string $message): string
    {
        return str_replace(' ', '_', strtolower(rtrim(str_replace('\'', '', $message), '.')));
    }
}
