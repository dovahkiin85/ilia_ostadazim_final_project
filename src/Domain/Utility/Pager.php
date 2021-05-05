<?php

namespace Fira\Domain\Utility;

class Pager
{
    private int $pageNumber;
    private int $pageSize;
    private int $totalPageNum;
    private int $totalRowNum;

    public function __constructor(int $pageNumber, int $pageSize, int $totalPageNum, int $totalRowNum)
    {
        $this->pageNumber = $pageNumber;
        $this->pageSize = $pageSize;
        $this->totalPageNum = $totalPageNum;
        $this->totalRowNum = $totalRowNum;
    }

    public function getCurrentPage(): int
    {
        return $this->pageNumber;
    }

    public function incrementPage(): self
    {
        $this->pageNumber++;
        return $this;
    }

    public function setCurrentPage(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): int
    {
        $this->pageSize = $pageSize;
        return $this->pageSize;
    }

    public function getTotalRows($row): int
    {
        $this->totalRowNum = $row;
        return $this->totalRowNum;
    }

    public function getTotalPages($page): int
    {
        $this->totalPageNum = $page;
        return $this->totalPageNum;

    }
}