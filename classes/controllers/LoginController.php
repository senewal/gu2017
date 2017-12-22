<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;

class LoginController extends Controller {
    public function actionIndex () {
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

    public function actionAjaxSend () {
        $localAuth = new LocalAuth();
        $_POST['password'] = $localAuth->hashPassword($_POST['password']);
        $returnArray = array(
            'result' => 0,
            'errorMessage' => 'SQL error!'
        );
        if ($localAuth->login($_POST)) {
            $returnArray = array('result' => 1);
        }
        echo json_encode($returnArray);
    }

    public function actionOut () {
        $localAuth = new LocalAuth();
        $localAuth->removeCookies();
        header('Location: /');
    }
}
