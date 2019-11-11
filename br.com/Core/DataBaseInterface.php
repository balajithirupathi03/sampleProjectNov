<?php

interface DataBaseInterface
{
    public function select($fields, $tableName);
    public function selectUsingCondition($fields, $tableName, $whereFiled, $whereValue);
    public function selectByInnerJoin($fields, $tableNameOne, $tableNameTwo, $onCondition, $whereFiled, $whereValue);
    public function update($tableName, $updateField, $updateValue, $whereFiled, $whereValue);
    public function insert($tableName, $fields, $vallues);
}
