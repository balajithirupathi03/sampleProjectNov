<?php

class DataBaseAccessor extends MysqlConnector implements DataBaseInterface
{
    private static $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    private function excecutePreparedStatement($preparedStatement)
    {
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        return $result;
    }

    final public function select($fields, $tableName)
    {
        $fields = implode(",", $fields);
        $preparedStatement = $this->conn->prepare("SELECT $fields FROM $tableName");
        return $this->excecutePreparedStatement($preparedStatement);
    }

    final public function selectUsingCondition($fields, $tableName, $whereFiled, $whereValue)
    {
        $fields = implode(",", $fields);
        $preparedStatement = $this->conn->prepare("SELECT $fields FROM $tableName WHERE $whereFiled = $whereValue");
        return $this->excecutePreparedStatement($preparedStatement);
    }

    final public function selectByInnerJoin($fields, $tableNameOne, $tableNameTwo, $onCondition, $whereFiled, $whereValue)
    {
        $fields = implode(",", $fields);
        $preparedStatement = $this->conn->prepare("select $fields from $tableNameOne inner join $tableNameTwo on $onCondition where  $whereFiled = $whereValue");
        return $this->excecutePreparedStatement($preparedStatement);
    }

    final public function update($tableName, $updateField, $updateValue, $whereFiled, $whereValue)
    {
        $preparedStatement = $this->conn->prepare("UPDATE $tableName SET $updateField = ? WHERE $whereFiled = $whereValue");
        $preparedStatement->bind_param('s', $updateValue);
        $preparedStatement->execute();
    }

    final public function insert($tableName, $fields, $vallues)
    {
        $fields = implode(",", $fields);
        $values = "'" . implode("', '", $vallues) . "'";
        $preparedStatement = $this->conn->prepare("INSERT INTO $tableName($fields) VALUES ($values);");
        $preparedStatement->execute();
    }

    final public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
