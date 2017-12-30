<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;

class RegistrationController extends Controller {
    public function actionIndexOld () {
        $this->layout = 'layout_auth_local';
        echo $this->render('registration', array(
            'title' => 'Регистрация',
            'styles' => array(
                $this->addCssFile('styles_auth_local')
            ),
            'scripts' => array(
                $this->addJsFile('AuthForm'),
                $this->addJsFile('registration')
            )
        ));
    }

    public function actionIndex () {
        $this->layout = 'layout';
        echo $this->render('registration', array(
            'title' => 'Регистрация',
            'isLogin' => false,
            'userData' => null,
            'styles' => array(
                $this->addCssFile('styles')
            ),
            'scripts' => array(
                $this->addJsFile('AuthForm'),
                $this->addJsFile('registration')
            )
        ));
    }

    public function actionAjaxSend () {
        $localAuth = new LocalAuth();
        unset($_POST['password2']);
        $_POST['password'] = $localAuth->hashPassword($_POST['password']);
        $returnArray = array(
            'result' => 0,
            'errorMessage' => 'Пользователь с таким логином уже есть!'
        );
        if ($localAuth->register($_POST) > -1) {
            $returnArray = array('result' => 1);
            $localAuth->updateRandomIdToUser();
        }
        echo json_encode($returnArray);
    }
}