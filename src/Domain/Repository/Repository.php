<?php

namespace Fira\Domain\Repository;

use Fira\Domain\Entity\Entity;

interface Repository
{
    public function registerEntity(Entity $entity): void;

    public function save(): void;

    public function getById(int $id): Entity;

    public function getByIds(array $id): array;

    public function delete(int $id, string $name, string $category, string $description, float $latitide, float $longtitude): bool;

    public function getNextid(int $id): int;
}