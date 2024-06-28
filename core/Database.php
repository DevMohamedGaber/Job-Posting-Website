<?php
class Database {
    private $dbName = "linkedin_clone_db";
    private $host = "localhost";
    private $user = "root";
    private $password = "";

    private $connection = null;

    public function __construct()
    {
        $dsn = "mysql:host=". $this->host .";dbname=". $this->dbName .";";

        $this->connection = new \PDO($dsn, $this->user, $this->password);
    }
    public function Query($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        if(count($params) > 0) {
            for ($i=1; $i <= count($params); $i++) {
                $stmt->bindValue($i, $params[$i - 1]);
            }
        }
        $stmt->execute();

        return $stmt;
    }
    public function GetLastId()
    {
        return $this->connection->lastInsertId();
    }
    public function CloseConnection()
    {
        $this->connection = null;
    }
}

