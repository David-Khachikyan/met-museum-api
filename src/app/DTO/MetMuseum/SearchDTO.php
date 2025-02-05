<?php

namespace App\DTO\MetMuseum;

class SearchDTO implements MetMuseumDTOInterface
{
    private string $term;
    private ?int $departmentId;


    public static function init(array $data): SearchDTO
    {
        return (new self())
            ->setTerm($data['term'])
            ->setDepartmentId($data['departmentId'] ?? null);
    }

    public function toArray(): array
    {
        return [
            'q' => $this->getTerm(),
            'departmentId' => $this->getDepartmentId(),
        ];
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    public function setTerm(string $term): self
    {
        $this->term = $term;
        return $this;
    }

    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?int $departmentId): self
    {
        $this->departmentId = $departmentId;
        return $this;
    }
}
