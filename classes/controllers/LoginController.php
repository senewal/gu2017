<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;

class LoginController extends Controller {
    public function actionIndexOld () {
        $this->layout = 'layout_auth_local';
        echo $this->render('login', array(
            'title' => 'Авторизация',
            'styles' => array(
                $this->addCssFile('styles_auth_local')
            ),
            'scripts' => array(
                $this->addJsFile('AuthForm'),
                $this->addJsFile('login')
            )
        ));
    }

    public function actionIndex () {
        $this->layout = 'layout';
        echo $this->render('login', array(
            'title' => 'Авторизация',
            'isLogin' => false,
            'userData' => null,
            'styles' => array(
                $this->addCssFile('styles')
            ),
            'scripts' => array(
                $this->addJsFile('AuthForm'),
                $this->addJsFile('login')
            )
        ));
    }

    public function actionAjaxSend () {
        $localAuth = new LocalAuth();
        $_POST['password'] = $localAuth->hashPassword($_POST['password']);
        $returnArray = array(
            'result' => 0,
            'errorMessage' => 'Неправильный пользователь или пароль!'
        );
        if ($localAuth->login($_POST)) {
            $localAuth->updateRandomIdToUser();
            $returnArray = array('result' => 1);
            $localAuth->updateRandomIdToUser();
        }
        echo json_encode($returnArray);
    }

    public function actionOut () {
        $localAuth = new LocalAuth();
        $localAuth->removeCookies();
        header('Location: /');
    }
}
