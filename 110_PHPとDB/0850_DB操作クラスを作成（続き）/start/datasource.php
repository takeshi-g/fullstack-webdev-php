<?php

namespace db;

use PDO;
use PDOException;

class DataSource
{

    private $conn;
    private $sqlResult;

    public function __construct($host = 'localhost', $port = '8889', $dbName = 'test_phpdb', $username = 'test_user', $password = 'pwd')
    {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};";
        $this->conn = new PDO($dsn, $username, $password);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function select($sql = "", $params = [])
    {
        $stt = $this->executeSql($sql, $params);
        return $stt->fetchAll();
    }

    public function selectOne($sql = "", $params = [])
    {
        $result = $this->select($sql, $params);
        return count($result) > 0 ? $result[0] : false;
    }
    public function execute($sql = "", $params = [])
    {
        $this->executeSql($sql, $params);
        return $this->sqlResult;
    }

    public function begin() 
    {
        $this->conn->beginTransaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollBack();
    }


    private function executeSql($sql, $params)
    {
        $stt = $this->conn->prepare($sql);
        $this->sqlResult = $stt->execute($params);
        return $stt;
    }
}
