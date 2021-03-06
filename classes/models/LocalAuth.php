<?php

namespace classes\models;

use classes\base\App;

class LocalAuth {
    public $data = array();
    public $isLogin = false;

    public function getUserId () {
        if ($this->isLogin) {
            return $this->data['id'];
        } else {
            if (isset($_COOKIE['randomId'])) {
                return $_COOKIE['randomId'];
            }
            return $this->setRandomId();
        }
    }

    public function setRandomId () {
        $uniqId = hexdec(uniqid());
        setCookie('randomId', $uniqId, time() + 31 * 24 * 3600, '/');
        return $uniqId;
    }

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

    public function removeCookies () {
        setCookie('login', null, time() - 3600, '/');
        setCookie('password', null, time() - 3600, '/');
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
        $data['permission_id'] = 1;
        $data['registration_date'] = date("Y-m-d");
        $data['share_token'] = md5($data['login']) . md5($data['email']);
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
            $this->data['id'] = $pdo->lastInsertId();
            return $this->data['id'];
        } catch (\PDOException $e) {
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
                    $this->setCookies();
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

    public function updateRandomIdToUser () {
        if (!isset($_COOKIE['randomId'])) {
            return true;
        }
        $randomId = $_COOKIE['randomId'];
        if (!isset($this->data['id'])) {
            return true;
        }
        $userId = $this->data['id'];
        if ($userId == null) {
            return true;
        }
        $sql = 'UPDATE `users_products` SET `user_id` = ' . $userId . ', `guest_id` = 0 WHERE `guest_id` = ' . $randomId;
        APP::$app->db->update($sql);
        return true;
    }
}