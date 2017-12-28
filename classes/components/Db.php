<?php

namespace classes\components;

use PDO;

class Db implements ComponentInterface {
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    private $charset = DB_CHARSET;

    public $pdo;

    public function init () {
        $dsn = 'mysql:host:' . $this->host . ':' . $this->port . ';'
            . 'dbname=' . $this->dbname . ';'
            . 'charset=' . $this->charset;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        $this->pdo->exec("use " . $this->dbname);
        return true;
    }

    public function insert ($sql) {
        $pdo = $this->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            return -1;
        }
    }

    public function update ($sql) {
        $pdo = $this->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return 1;
        } catch (\PDOException $e) {
            return 0;
        }
    }

    public function select ($sql) {
        $pdo = $this->pdo;
        try {
            $rows = $pdo->query($sql);
            $rowArray = $rows->fetchAll();
            if (count($rowArray) > 0) return $rowArray;
            return array();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function arrayToSql ($data) {
        $sql_names = array();
        $sql_values = array();
        foreach ($data as $name => $value) {
            array_push($sql_names, '`' . $name . '`');
            array_push($sql_values, '"' . $value . '"');
        }
        return array(
            'sql_names' => join(",", $sql_names),
            'sql_values' => join(",", $sql_values)
        );
    }
}