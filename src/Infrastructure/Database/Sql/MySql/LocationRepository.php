<?php

namespace Fira\Infrastructure\Database\Sql\Mysql;

use DateTimeImmutable;
use Fira\App\DependencyContainer;
use Fira\Domain\Entity\Entity;
use Fira\Domain\Entity\LocationEntity;
use Fira\Domain\Utility\Pager;
use Fira\Domain\Utility\Sort;
use Fira\Infrastructure\Database\Sql\Mysql\MySqlDriver;
use http\Exception\RuntimeException;

class LocationRepository implements \Fira\Domain\Repository\LocationRepository
{
    private int $page;
    private array $entities = [];
    private int $row;
    public function __constructor(int $page, int $rows)
    {
        $this->row += 1;
        $this->page += 1;
    }
    public function getByName(string $name, Pager $pager, Sort $sort): array
    {
        $rowData = DependencyContainer::getSqlDriver()->getRowByName($name, 'locations');
        $entity = new LocationEntity();
        $entity
            ->setId($rowData['id'])
            ->setName($rowData['name'])
            ->setCategory($rowData['category'])
            ->setDescription($rowData['description'])
            ->setLatitude($rowData['latitude'])
            ->setLongitude($rowData['longitude'])
            ->setCreatedAt(new DateTimeImmutable($rowData['created_at']));
        $entity1 = sort($entity);
        return array($entity1);
    }

    public function getByCategory(string $category, Pager $pager, Sort $sort): array
    {
        $rowData = DependencyContainer::getSqlDriver()->getRowByCategory($category, 'locations');
        $entity = new LocationEntity();
        $entity
            ->setId($rowData['id'])
            ->setName($rowData['name'])
            ->setCategory($rowData['category'])
            ->setDescription($rowData['description'])
            ->setLatitude($rowData['latitude'])
            ->setLongitude($rowData['longitude'])
            ->setCreatedAt(new DateTimeImmutable($rowData['created_at']));
        $entity1 = sort($entity);
        return array($entity1);
    }

    public function registerEntity(Entity $entity): void{
        if(empty($entity)){
            throw new RuntimeException("can't be empty");
        }
    }

    public function save(): void
    {
        // TODO: Implement save() method.
    }

    public function getById(int $id): Entity
    {
        $rowData = DependencyContainer::getSqlDriver()->getRowById($id, 'locations');
        $entity = new LocationEntity();
        $entity
            ->setId($rowData['id'])
            ->setName($rowData['name'])
            ->setCategory($rowData['category'])
            ->setDescription($rowData['description'])
            ->setLatitude($rowData['latitude'])
            ->setLongitude($rowData['longitude'])
            ->setCreatedAt(new DateTimeImmutable($rowData['created_at']));

        return $entity;
    }

    public function getByIds(array $id): array
    {
        $rowData = DependencyContainer::getSqlDriver()->getRowById($id, 'locations');
        $entity = new LocationEntity();
        $entity
            ->setId($rowData['id'])
            ->setName($rowData['name'])
            ->setCategory($rowData['category'])
            ->setDescription($rowData['description'])
            ->setLatitude($rowData['latitude'])
            ->setLongitude($rowData['longitude'])
            ->setCreatedAt(new DateTimeImmutable($rowData['created_at']));

        return array($entity);
    }

    public function delete(int $id, string $name, string $category, string $description, float $latitide, float $longtitude): bool
    {
        $rowData = DependencyContainer::getSqlDriver()->getRowById($id, 'locations');
        unset($rowData);
    }

    public function getNextid(int $id): int
    {
        $id = 0;
        foreach ($this->entities as $entity) {
            if ($entity->getId() > $id) {
                $id = $entity->getId();
            }
        }

        return ++$id;
    }

    public function search(array $fields,string $table,string $where,Pager $pager, Sort $sort): array
    {
        $res = (new MySqlDriver)->select($fields,$table,$where);
        $page = (new Pager)->getCurrentPage();
        $sorted = (new Sort($res,'ACS'));
        $resault = [$res , $page , $sorted];
        return $resault;
    }
}
