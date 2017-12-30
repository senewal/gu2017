<?php

namespace classes\models;

use classes\base\App;

class Share {

    public function tokenIsAvalible ($myToken, $token) {
        $sqlData = array(
            'from_token' => $token,
            'to_token' => $myToken,
            'block' => 0
        );
        $where = array();
        foreach ($sqlData AS $key => $value) {
            array_push($where, '`' . $key . '` = "' . $value . '"');
        }
        $sql = 'SELECT * FROM `users_share` WHERE ' . join(' AND ', $where);
        $data = APP::$app->db->select($sql);
        if (count($data) == 0) {
            return false;
        }
        return true;
    }

    public function blockUser ($id) {
        $id = $_POST['id'];
        $sql = 'UPDATE `users_share` SET `block` = 1 WHERE `id` = ' . $id;
        if (APP::$app->db->update($sql) == 1) {
            return true;
        }
        return false;
    }

    public function unBlockUser ($id) {
        $id = $_POST['id'];
        $sql = 'UPDATE `users_share` SET `block` = 0 WHERE `id` = ' . $id;
        if (APP::$app->db->update($sql) == 1) {
            return true;
        }
        return false;
    }

    /*
     * return
     * 0 - token not find
     * 1 - ok token
     * 2 - this is my token
     * 3 - this token early added for this user
     * 4 - this user is block
     */
    public function checkShareToken ($myToken, $token) {
        if ($token == $myToken) return 2;
        $sql = 'SELECT * FROM `users` WHERE `share_token` = "' . $token . '"';
        $data = APP::$app->db->select($sql);
        if (count($data) == 0) return 0;
        if ($data[0]['share_token'] == $token) {
            $sql = 'SELECT * FROM `users_share` WHERE `from_token` = "' . $token . '" AND `to_token` = "' . $myToken . '"';
            $data = APP::$app->db->select($sql);
            if (count($data) > 0) {
                if ($data[0]['block'] == 1) return 4;
                return 3;
            }
            return 1;
        }
        return 0;
    }

    public function addShareToken ($myToken, $token)
    {
        $sql = 'INSERT INTO `users_share` (`from_token`, `to_token`, `date`) VALUES ("'.$token.'", "'.$myToken.'", "'.date("Y-m-d").'")';
        APP::$app->db->insert($sql);
    }

    public function getUserByShareToken ($token) {
        $sql = 'SELECT `name`, `surname`, `email` FROM `users` WHERE `share_token` = "' . $token . '"';
        return APP::$app->db->select($sql);
    }

    public function getAllIShare ($myToken)
    {
        $sql = 'SELECT `users`.`name`, `users`.`surname`, `users`.`email`, `users_share`.`id` AS `users_share_id`, `users_share`.`block` AS `users_share_block` FROM `users_share`';
        $sql.= ' RIGHT JOIN `users` ON `users`.`share_token` = `users_share`.`to_token`';
        $sql.= ' WHERE `users_share`.`from_token` = "'.$myToken.'"';
        return APP::$app->db->select($sql);
    }

    public function getAllShareForMe ($myToken)
    {
        $sql = 'SELECT `users`.`name`, `users`.`surname`, `users`.`email`, `users`.`share_token`, `users_share`.`id` AS `users_share_id`, `users_share`.`block` AS `users_share_block` FROM `users_share`';
        $sql.= ' RIGHT JOIN `users` ON `users`.`share_token` = `users_share`.`from_token`';
        $sql.= ' WHERE `users_share`.`to_token` = "'.$myToken.'" AND `users_share`.`block` = 0';
        return APP::$app->db->select($sql);
    }

    public function getUserIdByToken ($token)
    {
        $sql = 'SELECT `id` FROM `users` WHERE `share_token` = "'.$token.'"';
        $data = APP::$app->db->select($sql);
        if (count($data) == 0) return -1;
        return $data[0]['id'];
    }
}