<?php

namespace App\Traits\Array;

trait WithArraySorting
{
    use WithCamelCaseToSnakeCase;

    private function sortData(array $data, string $orderBy, string $orderType): array
    {
        $orderBy = $this->camelCaseToSnakeCase($orderBy);
        usort($data, function ($a, $b) use ($orderBy, $orderType) {
            if ($a[$orderBy] === $b[$orderBy]) {
                return 0;
            }

            if ($orderType === 'asc') {
                return ($a[$orderBy] < $b[$orderBy]) ? -1 : 1;
            } else {
                return ($a[$orderBy] > $b[$orderBy]) ? -1 : 1;
            }
        });

        return $data;
    }

}
