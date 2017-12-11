<?php

namespace classes\models;

use classes\base\App;

class LocalAuth {
    public $data = array();
    public $isLogin = false;

    public function getCookieUser () {
        return isset($_COOKIE['user']) ? $_COOKIE['user'] : null;
    }

    public function getCookiePassword () {
        return isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
    }

    public function setCookies () {
        setCookie('username', $this->data['username'], time() + 31 * 24 * 3600, '/');
        setCookie('password', $this->data['password'], time() + 31 * 24 * 3600, '/');
    }

    public function register ($data = null) {
        if (empty($data)) return false;

        if (empty($data['user'])) return false;
        if (empty($data['password'])) return false;
        if (empty($data['first_name'])) return false;
        if (empty($data['last_name'])) return false;
        if (empty($data['email'])) return false;

        $this->data = $data;

        /* sql add new user */

        return true;
    }

    public function login ($data = null) {
        if (empty($data)) return false;

        if (empty($data['user'])) return false;
        if (empty($data['password'])) return false;

        /* sql get user and check */

        $this->data = $data;

        $this->isLogin = true;

        return true;
    }

    public function checkIsLogin () {
        $user = $this->getCookieUser();
        $password = $this->getCookiePassword();
        return $this->login(array(
            'user' => $user,
            'password' => $password
        ));
    }
}