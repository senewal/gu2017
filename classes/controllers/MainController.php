<?php

namespace classes\controllers;

use classes\base\Controller;

class MainController extends Controller {
    public function actionIndex () {
//        echo "Hello, world!:)";
//        require_once DIR_TO_HTML . '/index.html';

        $this->layout = 'layout';
        echo $this->render('main', array(
            'styles' => array(
                DIR_TO_CSS . '/style.css'
            ),
            'scripts' => array(
                DIR_TO_JS . '/main.js'
            )
        ));
    }
}
