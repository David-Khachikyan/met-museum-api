<?php

namespace App\Traits\Array;

use InvalidArgumentException;

trait WithArrayFiltering
{
    use WithCamelCaseToSnakeCase;

    private function filterData(array $data, array $filters): array
    {
        if (empty($filters)) {
            return $data;
        }

        $filteredData = [];
        foreach ($data as $row) {
            $matchesConditions = true;
            foreach ($filters as $defaultField => $filter) {
                if (is_array($filter) && isset($filter['operator'], $filter['value'])) {
                    $f = $filter['field'];
                    $operator = $filter['operator'];
                    $value = $filter['value'];
                    if (!$this->compare($row[$f], $operator, $value)) {
                        $matchesConditions = false;
                        break;
                    }

                } else {
                    $field = isset($filter['field']) ? $filter['field'] : $defaultField;
                    if ($row[$this->camelCaseToSnakeCase($field)] !== $filter) {
                        $matchesConditions = false;
                        break;
                    }
                }
            }

            if ($matchesConditions) {
                $filteredData[] = $row;
            }
        }

        return $filteredData;
    }

    private function compare($fieldValue, $operator, $value): bool
    {
        switch ($operator) {
            case '=':
            case '==':
                return $fieldValue == $value;
            case '!=':
            case '<>':
                return $fieldValue != $value;
            case '<':
                return $fieldValue < $value;
            case '>':
                return $fieldValue > $value;
            case '<=':
                return $fieldValue <= $value;
            case '>=':
                return $fieldValue >= $value;
            case 'in':
                return in_array($fieldValue, $value);
            case '!in':
                return !in_array($fieldValue, $value);
            default:
                throw new InvalidArgumentException("Invalid operator: $operator");
        }
    }
}
