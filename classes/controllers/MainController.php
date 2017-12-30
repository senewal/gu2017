<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;
use classes\models\Products;

class MainController extends Controller
{
    public function __construct()
    {
        $this->localAuth = new LocalAuth();
        $this->localAuth->checkIsLogin();
    }

    public function actionIndex()
    {
        $this->layout = 'layout';
        echo $this->render('main', array(
            'title' => 'Мои покупки',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'styles' => array(
                $this->addCssFile('style')
            ),
            'scripts' => array(
                $this->addJsFile('Container'),
                $this->addJsFile('Goods'),
                $this->addJsFile('GoodsList'),
                $this->addJsFile('main')
            )
        ));
    }

    public function actionHistory()
    {
        $this->layout = 'layout';
        echo $this->render('history', array(
            'title' => 'История покупок',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'styles' => array(
                $this->addCssFile('style')
            ),
            'scripts' => array(
                $this->addJsFile('Container'),
                $this->addJsFile('Goods'),
                $this->addJsFile('GoodsList'),
                $this->addJsFile('sum'),
                $this->addJsFile('maket'),
                $this->addJsFile('history')
            )
        ));
    }

    public function actionAjaxGetFindProductsList()
    {
        $result = array('result' => 0);
        try {
            $products = new Products();
            $searchName = isset($_GET['search']) ? $_GET['search'] : '';
            $data = $products->getAllSearch($searchName);
            $result = array(
                'result' => 1,
                'goods' => $data
            );
        } catch (\Exception $e) {
        }
        echo json_encode($result);
    }

    public function actionAjaxAddUserProduct()
    {
        $result = array('result' => 0);
        $userId = $this->localAuth->getUserId();
        $productId = isset($_POST['productId']) ? $_POST['productId'] : -1;
        $products = new Products();
        $addUserProductId = $products->addUser($userId, $productId, $this->localAuth->isLogin);
        if ($addUserProductId != -1) {
            $result['result'] = 1;
            $result['id'] = $addUserProductId;
        }
        echo json_encode($result);
    }

    public function actionAjaxGetActiveUserProducts()
    {
        $result = array('result' => 0);
        try {
            $products = new Products();
            $result = array(
                'result' => 1,
                'userId' => $this->localAuth->getUserId(),
                'goods' => $products->getActiveUser($this->localAuth->getUserId(), $this->localAuth->isLogin)
            );
        } catch (\Exception $e) {
        }
        echo json_encode($result);
    }

    public function actionAjaxGetInactiveUserProducts()
    {
        $result = array('result' => 0);
        try {
            $products = new Products();
            $result = array(
                'result' => 1,
                'goods' => $products->getInactiveUser($this->localAuth->getUserId(), $this->localAuth->isLogin)
            );
        } catch (\Exception $e) {
        }
        echo json_encode($result);
    }

    public function actionAjaxChangeUserProductStatus()
    {
        $result = array('result' => 0);
        $id = $_POST['id'];
        $statusId = $_POST['statusId'];
        try {
            $products = new Products();
            $result['result'] = $products->updateStatusUser($id, $statusId);
        } catch (\Exception $e) {
        }
        echo json_encode($result);
    }

    public function actionAjaxAddNewProduct()
    {
        $result = array('result' => 0);
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        if ($name == '') {
            echo json_encode($result);
            return false;
        }
        $products = new Products();
        $productId = $products->add($name, 1);
        if ($productId != -1) {
            $userId = $this->localAuth->getUserId();
            $addUserProductId = $products->addUser($userId, $productId, $this->localAuth->isLogin);
            if ($addUserProductId != -1) {
                $result['result'] = 1;
                $result['id'] = $addUserProductId;
            }
        }
        echo json_encode($result);
    }
}
