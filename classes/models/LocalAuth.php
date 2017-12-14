<?php

namespace classes\models;

use classes\base\App;

class LocalAuth {
    public $data = array();
    public $isLogin = false;

    public function getCookieLogin () {
        return isset($_COOKIE['login']) ? $_COOKIE['login'] : null;
    }

    public function getCookiePassword () {
        return isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
    }

    public function setCookies () {
        setCookie('login', $this->data['login'], time() + 31 * 24 * 3600, '/');
        setCookie('password', $this->data['password'], time() + 31 * 24 * 3600, '/');
    }

    /*
     * return -1 when error
     * return {id} when success
     * */
    public function register ($data = null) {
        if (empty($data)) return -1;
        if (empty($data['name'])) return -1;
        if (empty($data['surname'])) return -1;
        if (empty($data['login'])) return -1;
        if (empty($data['password'])) return -1;
        if (empty($data['email'])) return -1;
        if (empty($data['permission_id'])) return -1;
        $data['registration_date'] = date("Y-m-d");
        $this->data = $data;

        $sql_names = array();
        $sql_values = array();
        foreach ($data as $name => $value) {
            array_push($sql_names, '`' . $name . '`');
            array_push($sql_values, '"' . $value . '"');
        }
        $sql_names = join(",", $sql_names);
        $sql_values = join(",", $sql_values);

        $sql = 'INSERT INTO `users` (' . $sql_names . ') VALUES (' . $sql_values . ')';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $this->isLogin = true;
            $this->setCookies();
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            echo $e;
            return -1;
        }
    }

    public function login ($data = null) {
        if (empty($data)) return false;

        if (empty($data['login'])) return false;
        if (empty($data['password'])) return false;

        $sql = 'SELECT * FROM `users` WHERE `login` = "' . $data['login'] . '"';
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            $rowArray = $rows->fetchAll();
            if (count($rowArray) > 0) {
                if ($rowArray[0]['password'] == $data['password']) {
                    $this->isLogin = true;
                    $this->data = $rowArray[0];
                    return true;
                }
            }
        } catch (\PDOException $e) {
            $this->isLogin = false;
            return false;
        }
        $this->isLogin = false;
        return false;
    }

    public function checkIsLogin () {
        $login = $this->getCookieLogin();
        $password = $this->getCookiePassword();
        return $this->login(array(
            'login' => $login ,
            'password' => $password
        ));
    }

    public function hashPassword ($password) {
        return md5($password);
    }
}