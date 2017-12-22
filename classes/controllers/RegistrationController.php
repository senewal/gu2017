<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;

class RegistrationController extends Controller {
    public function actionIndex () {
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

    public function actionAjaxSend () {
        $localAuth = new LocalAuth();
        unset($_POST['password2']);
        $_POST['password'] = $localAuth->hashPassword($_POST['password']);
        $returnArray = array(
            'result' => 0,
            'errorMessage' => 'SQL error!'
        );
        if ($localAuth->register($_POST) > -1) {
            $returnArray = array('result' => 1);
        }
        echo json_encode($returnArray);
    }
}