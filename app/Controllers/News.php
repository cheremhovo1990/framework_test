<?php

namespace app\controllers;

use fra\web\Controller;

class News  extends Controller
{
    protected function actionIndex()
    {
        echo 'index';
        $this->view->my = 'example';
        $this->view->display(__DIR__ . '/../view/index.php');
/*        $model = new \app\models\Test();
        $model->name = 'Robbert';
        $model->email = 'my@emial.com';
        $model->insert();*/
    }

    protected function actionOne()
    {
        echo 'One';
    }
}