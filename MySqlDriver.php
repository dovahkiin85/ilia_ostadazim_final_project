<?php


namespace Fira\Infrastructure\Database\Sql\Mysql;


use Fira\Infrastructure\Database\Sql\AbstractSqlDriver;
use mysqli;
use RuntimeException;

class MySqlDriver extends AbstractSqlDriver
{
    public function __construct(string $host, string $username, string $password, string $dbName, int $port)
    {
        $this->connection = new mysqli('localhost', 'root', '1380_ilia_1385','location', 8000);
        $this->connection->select_db($dbName);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getRowById(int $id, string $table): array
    {
        $rows = $this->select(['*'], $table, 'id = ' . $id);
        if (empty($rows) || !isset($rows[0])) {
            throw new RuntimeException('Row with Id ' . $id . ' not found.');
        }

        return $rows[0];
    }

    public function select(array $field, string $table, string $where): array
    {
        if (empty($field)) {
            throw new RuntimeException('Fields should not be empty');
        }

        if (isset($field[0]) && $field[0] === '*') {
            $fieldString = '*';
        } else {
            $fieldString = implode(',', $field);
        }

        $query = <<<sql
SELECT {$fieldString} FROM {$table} WHERE {$where}; 
sql;

        $mysqlResult = $this->connection->query($query);
        return $mysqlResult->fetch_array();
    }

    public function update(string $table_name, array $columns, array $value, string $condition): bool{
        if (empty($table_name)){
            throw new \http\Exception\RuntimeException("table name is empty");
        }
        if (empty($columns)){
            throw new \http\Exception\RuntimeException("no columns inserted");
        }
        if (empty($value)){
            throw new \http\Exception\RuntimeException("no values inserted");
        }
        if (empty($condition)){
            throw new \http\Exception\RuntimeException("condition can't be empty");
        }
        $query = <<<sql
UPDATE {$table_name} SET {$condition} = {$value} WHERE {$condition}; 
sql;
        $mysqlResult = $this->connection->query($query);
        if ($mysqlResult == true){
            return true;
        }
    }

    public function delete(string $table_name, string $condition): bool
    {
        if (empty($table_name)){
            throw new \http\Exception\RuntimeException("table name is empty");
        }
        if (empty($condition)){
            throw new \http\Exception\RuntimeException("condition can't be empty");
        }
        $query = <<<sql
DELETE FROM {$table_name} WHERE {$condition};
sql;
        $mysqlResult = $this->connection->query($query);
        if ($mysqlResult == true){
            return true;
        }
    }

    public function insert(string $table_name, array $columns, array $values): bool
    {
        if (empty($table_name)){
            throw new \http\Exception\RuntimeException("table name should not be empty");
        }
        if (empty($values)){
            throw new \http\Exception\RuntimeException("no values inserted");
        }
        if (empty($columns)){
            throw new \http\Exception\RuntimeException("no columns inserted");
        }
        $query = <<<sql
INSERT INTO {$columns} VALUES {$values};
sql;
        $mysqlResult = $this->connection->query($query);
        if ($mysqlResult == true){
            return true;
        }
    }
}