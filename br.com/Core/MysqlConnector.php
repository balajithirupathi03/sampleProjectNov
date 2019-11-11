<?php

require_once 'Config/MysqlConnectionConfig.php';

class MysqlConnector
{
    public function getConnection()
    {
        $conn = mysqli_connect(hostname, username, password, databasename);
        if (!$conn) {
            die('Could not connect: ' . mysqli_error($conn));
        }
        return $conn;
    }
}
