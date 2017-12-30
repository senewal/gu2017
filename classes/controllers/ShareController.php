<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;
use classes\models\Products;
use classes\models\Share;

class ShareController extends Controller
{
    public function __construct()
    {
        $this->localAuth = new LocalAuth();
        $this->localAuth->checkIsLogin();
    }

    public function actionAll () {
        if (!$this->localAuth->isLogin) {
            header("Location: /");
        }
        $this->layout = 'layout';
        $share = new Share();
        echo $this->render('share_all', array(
            'title' => 'Share list',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'shares' => $share->getAllShareForMe($this->localAuth->data['share_token']),
            'styles' => array(
                $this->addCssFile('styles')
            ),
            'scripts' => array()
        ));
    }

    public function actionList () {
        if (!$this->localAuth->isLogin) {
            return $this->actionListUndefined();
        }
        $share = new Share();
        $urls = explode('/', $_SERVER['REQUEST_URI']);
        $token = array_pop($urls);
        if (!$share->tokenIsAvalible($this->localAuth->data['share_token'], $token)) {
            return $this->actionListUndefined();
        }
        $this->layout = 'layout';
        echo $this->render('share_list', array(
            'title' => 'Share list',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'shareUserData' => $share->getUserByShareToken($token),
            'styles' => array(
                $this->addCssFile('style')
            ),
            'scripts' => array(
                $this->addJsFile('Container'),
                $this->addJsFile('Goods'),
                $this->addJsFile('GoodsList'),
                $this->addJsFile('share_list')
            )
        ));
    }

    public function actionListUndefined ()
    {
        $this->layout = 'layout';
        echo $this->render('share_list_undefined', array(
            'title' => 'Share list',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'styles' => array(
                $this->addCssFile('style')
            ),
            'scripts' => array()
        ));
    }

    public function actionAjaxBlockUser ()
    {
        $result = array( 'result' => 0 );
        if ($this->localAuth->isLogin && isset($_POST['id'])) {
            $share = new Share();
            if ($share->blockUser($this->localAuth->data['share_token'], $_POST['id'])) {
                $result['result'] = 1;
            }
        }
        echo json_encode($result);
    }

    public function actionAjaxUnBlockUser ()
    {
        $result = array( 'result' => 0 );
        if ($this->localAuth->isLogin && isset($_POST['id'])) {
            $share = new Share();
            if ($share->unBlockUser($this->localAuth->data['share_token'], $_POST['id'])) {
                $result['result'] = 1;
            }
        }
        echo json_encode($result);
    }

    public function actionAjaxGetActiveUserProducts()
    {
        $share = new Share();
        $userId = $share->getUserIdByToken($_GET['share_token']);
        $result = array('result' => 0);
        try {
            $products = new Products();
            $result = array(
                'result' => 1,
                'userId' => $this->localAuth->getUserId(),
                'goods' => $products->getActiveUser($userId, true)
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
}