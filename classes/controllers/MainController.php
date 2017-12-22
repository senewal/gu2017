<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\LocalAuth;

class MainController extends Controller {
    public function __construct() {
        $this->localAuth = new LocalAuth();
        $this->localAuth->checkIsLogin();
    }

    public function actionIndex () {
        $this->layout = 'layout';
        echo $this->render('main', array(
            'title' => 'Список покупок',
            'isLogin' => $this->localAuth->isLogin,
            'userData' => $this->localAuth->data,
            'styles' => array(
                $this->addCssFile('style')
            ),
            'scripts' => array(
                $this->addJsFile('main'),
                $this->addJsFile('sum'),
                $this->addJsFile('maket')
            )
        ));
    }
}
