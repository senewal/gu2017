<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;
use classes\models\Share;

class UserController extends Controller
{
    public function __construct()
    {
        $this->localAuth = new LocalAuth();
        $this->localAuth->checkIsLogin();
    }

    public function actionIndex()
    {
        $this->layout = 'layout';
        $share = new Share();
        echo $this->render('user', array(
            'title' => 'User',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'shares' => $share->getAllIShare($this->localAuth->data['share_token']),
            'styles' => array(
                $this->addCssFile('styles')
            ),
            'scripts' => array(
                $this->addJsFile('user')
            )
        ));
    }

    public function actionShare()
    {
        $this->layout = 'layout';
        $data = array(
            'title' => 'User',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'styles' => array(
                $this->addCssFile('styles')
            ),
            'scripts' => array()
        );

        $token = isset($_GET['token']) ? $_GET['token'] : null;

        $view = 'user_share_not_login';
        if ($this->localAuth->isLogin) {
            $share = new Share();
            $tokenStatus = $share->checkShareToken($this->localAuth->data['share_token'], $token);
            switch ($tokenStatus) {
                case 0: $view = 'user_share_bad_token'; break;
                case 1:
                    $share->addShareToken($this->localAuth->data['share_token'], $token);
                case 3:
                    $view = 'user_share_success';
                    $userShareData = $share->getUserByShareToken($token);
                    $data['userShare'] = (count($userShareData) > 0) ? $userShareData[0] : null;
                    $data['token'] = $token;
                    break;
                case 2: $view = 'user_share_token_is_mine'; break;
                case 4: $view = 'user_share_token_is_block'; break;
            }
        }
        echo $this->render($view, $data);
    }

}