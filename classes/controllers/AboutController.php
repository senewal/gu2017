<?php

namespace classes\controllers;

use classes\base\Controller;

class AboutController extends Controller {
    public function actionIndex () {
        $this->layout = 'layout';
        echo $this->render('about', array(
            'styles' => array(
                DIR_TO_CSS . '/style.css'
            ),
            'scripts' => array(
                DIR_TO_JS . '/main.js'
            )
        ));
    }
}
