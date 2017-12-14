<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;
use classes\models\Lists;
use classes\models\Products;

class TestController extends Controller {
    public function actionIndex () {
        echo "Tadek TEST PHP!<hr>";

        $localAuth = new LocalAuth();
        $lists = new Lists();
        $products = new Products();

        echo "<pre>";
        var_dump($products->get(2));
        echo "</pre><hr>";

        echo "<pre>";
        var_dump($products->getAll());
        echo "</pre><hr>";

        echo "<pre>";
        var_dump($products->getList(8));
        echo "</pre>";

//        for ($i = 1; $i < 10; $i++) {
//            echo "ADD PRODUCT" . $products->addNew(array(
//                    'name' => 'test - ' . $i,
//                    'unit_id' => 1
//                ), 7);
//            $products->add($i, 8);
//        }

//        echo "ADD LIST: " . $lists->add(array(
//                'user_id' => 11,
//                'status_id' => 1,
//                'label' => 'test'
//            )) . "<br>";


//        echo "REGISTER = " . $localAuth->register(array(
//            'name' => 'Tadeus',
//            'surname' => 'Tunkevic',
//            'login' => 'tade4ex',
//            'password' => $localAuth->hashPassword('test'),
//            'email' => 'tade4ex@gmail.com',
//            'permission_id' => 1
//        )) . "<br>";

//        echo $localAuth->checkIsLogin() ? "tak" : "nie";

    }
}
