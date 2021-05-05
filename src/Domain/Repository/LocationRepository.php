<?php

namespace Fira\Domain\Repository;

use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;

interface LocationRepository extends Repository
{
    public function getByName(string $name, Pager $pager, Sort $sort): array;

    public function getNextid(int $id) :int;

    public function getByCategory(string $category, Pager $pager, Sort $sort): array;

    public function search(array $searchParams,string $table,string $where, Pager $pager, Sort $sort): array;

    public function delete(int $id, string $name, string $category, string $description, float $latitide, float $longtitude): bool;
}
