<?php

namespace classes\models;

use classes\base\App;

class Products {
    public function addNew ($data = array(), $listId) {
        if (empty($data)) return -1;
        if (empty($data['name'])) return -1;
        if (empty($data['unit_id'])) return -1;
        $dataSql = App::$app->db->arrayToSql($data);
        $sql = 'INSERT INTO `products` (' . $dataSql['sql_names'] . ') VALUES (' . $dataSql['sql_values'] . ')';
        if (($id = APP::$app->db->insert($sql)) > -1) {
            return $this->add($id, $listId);
        }
        return -1;
    }

    public function add ($productId, $listId) {
        $sql = 'INSERT INTO `products_lists` (`product_id`, `list_id`) VALUES (' . $productId . ', ' . $listId . ')';
        if (($id = APP::$app->db->insert($sql)) > -1) {
            return $id;
        }
        return -1;
    }

    public function addUser ($userId, $productId, $isLogin = false) {
        if ($isLogin) {
            $sql = 'INSERT INTO `users_products` (`user_id`, `product_id`, `status_id`) VALUES ('.$userId.', '.$productId.', 1)';
        } else {
            $sql = 'INSERT INTO `users_products` (`guest_id`, `product_id`, `status_id`) VALUES ('.$userId.', '.$productId.', 1)';
        }
        if (($id = APP::$app->db->insert($sql)) > -1) {
            return $id;
        }
        return -1;
    }

    public function get ($id) {
        $sql = 'SELECT * FROM `products` WHERE `id` = ' . $id;
        return APP::$app->db->select($sql);
    }

    public function getActiveUser ($userId, $isLogin = false) {
        $sql = 'SELECT `users_products`.`id`, `products`.`name` FROM `users_products`';
        $sql.= 'RIGHT JOIN `products` ON `products`.`id` = `users_products`.`product_id`';
        if ($isLogin) {
            $sql.= 'WHERE `users_products`.`user_id` = ' . $userId . ' AND `users_products`.`status_id` = 1';
        } else {
            $sql.= 'WHERE `users_products`.`guest_id` = ' . $userId . ' AND `users_products`.`status_id` = 1';
        }
        return APP::$app->db->select($sql);
    }

    public function getInactiveUser ($userId, $isLogin = false) {
        $sql = 'SELECT `users_products`.`id`, `products`.`name` FROM `users_products`';
        $sql.= 'RIGHT JOIN `products` ON `products`.`id` = `users_products`.`product_id`';
        if ($isLogin) {
            $sql.= 'WHERE `users_products`.`user_id` = ' . $userId . ' AND `users_products`.`status_id` = 0';
        } else {
            $sql.= 'WHERE `users_products`.`guest_id` = ' . $userId . ' AND `users_products`.`status_id` = 0';
        }
        return APP::$app->db->select($sql);
    }

    public function getAll () {
        $sql = 'SELECT * FROM `products`';
        return APP::$app->db->select($sql);
    }

    public function getAllSearch ($searchName) {
        $sql = 'SELECT * FROM `products` WHERE `name` LIKE "%' . $searchName . '%"';
        return APP::$app->db->select($sql);
    }

    public function getList ($listId) {
        $sql = 'SELECT `products`.`name`, `products`.`unit_id` FROM `products_lists` RIGHT JOIN `products` ON `products_lists`.`product_id` = `products`.`id` WHERE `products_lists`.`list_id` = ' . $listId;
        return APP::$app->db->select($sql);
    }

    public function updateStatusUser ($id, $statusId) {
        $sql = 'UPDATE `users_products` SET `status_id` = ' . $statusId . ' WHERE `id` = ' . $id;
        return APP::$app->db->update($sql);
    }
}