<?php

namespace classes\controllers;

use classes\base\Controller;

class MainController extends Controller {
    public function actionIndex () {
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

    public function actionSaveListToDb () {
    }

    public function actionSendListToUser () {
    }

    public function actionRemoveListFromDb () {
    }

    public function actionChangeListStatus () {
    }

    public function actionAddProductToList () {
    }

    public function actionRemoveProductFromList () {
    }

    public function actionChangeProductStatus () {
    }
}
