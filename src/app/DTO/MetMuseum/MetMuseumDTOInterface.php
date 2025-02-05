<?php

namespace App\DTO\MetMuseum;

interface MetMuseumDTOInterface
{
    public static function init(array $data): self;
    public function toArray(): array;
}
