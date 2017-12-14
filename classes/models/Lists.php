<?php

namespace classes\models;

use classes\base\App;

class Lists {
    public function add ($data = array()) {
        if (empty($data)) return -1;
        if (empty($data['user_id'])) return -1;
        if (empty($data['status_id'])) return -1;
        if (empty($data['label'])) return -1;
        $data['add_time'] = time();
        $dataSql = App::$app->db->arrayToSql($data);
        $sql = 'INSERT INTO `lists` (' . $dataSql['sql_names'] . ') VALUES (' . $dataSql['sql_values'] . ')';
        if (($id = APP::$app->db->insert($sql)) > -1) {
//            return $this->userAdd($data['user_id'], $id);
            return $id;
        }
        return -1;
    }

    public function userAdd ($userId, $listId) {
        $sql = 'INSERT INTO `users_lists` (`user_id`, `list_id`) VALUES (' . $userId . ', ' . $listId . ')';
        if (APP::$app->db->insert($sql) > -1) return $listId;
        return -1;
    }

    public function get ($listId) {
        $sql = 'SELECT * FROM `lists` WHERE `id` = ' . $listId;
        return APP::$app->db->select($sql);
    }

    public function userGet ($userId) {
        $sql = 'SELECT * FROM `lists` WHERE `user_id` = ' . $userId;
        return APP::$app->db->select($sql);
    }
}