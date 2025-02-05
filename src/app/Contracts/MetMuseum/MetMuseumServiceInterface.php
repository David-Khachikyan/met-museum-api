<?php

namespace App\Contracts\MetMuseum;

use App\DTO\MetMuseum\SearchDTO;

interface MetMuseumServiceInterface
{
    public function getDepartments(): object;

    public function search(SearchDTO $searchDTO): object;

    public function getObject(int $objectId): object;
}
