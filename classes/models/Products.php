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

    public function get ($id) {
        $sql = 'SELECT * FROM `products` WHERE `id` = ' . $id;
        return APP::$app->db->select($sql);
    }

    public function getAll () {
        $sql = 'SELECT * FROM `products`';
        return APP::$app->db->select($sql);
    }

    public function getList ($listId) {
        $sql = 'SELECT `products`.`name`, `products`.`unit_id` FROM `products_lists` RIGHT JOIN `products` ON `products_lists`.`product_id` = `products`.`id` WHERE `products_lists`.`list_id` = ' . $listId;
        return APP::$app->db->select($sql);
    }
}