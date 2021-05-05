<?php

namespace Fira\Infrastructure\Database\Sql;

use mysqli;

abstract class AbstractSqlDriver
{
    protected static AbstractSqlDriver $instance;

    protected mysqli $connection;

    abstract public function getRowById(int $id, string $table);

    abstract public function select(array $field, string $table, string $where): array;

    abstract public function update(string $table_name, array $columns, array $value, string $condition): bool;

    abstract public function delete(string $table_name, string $condition): bool;

    abstract public function insert(string $table_name, array $columns, array $values): bool;
}
