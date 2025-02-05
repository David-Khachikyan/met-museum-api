<?php

namespace App\DTO;

class SearchRequestDTO
{
    private string $term;
    private ?int $departmentId;
    private ?int $page;
    private ?int $perPage;


    public static function init(array $data)
    {
        return (new self())
            ->setPage($data['page'] ?? 1)
            ->setPerPage($data['perPage'] ?? 10)
            ->setTerm($data['q'])
            ->setDepartmentId($data['departmentId'] ?? null);
    }

    public function toArray(): array
    {
        return [
            'term' => $this->getTerm(),
            'departmentId' => $this->getDepartmentId(),
            'page' => $this->getPage(),
            'perPage' => $this->getPerPage(),
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

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    public function setPerPage(?int $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }
}
