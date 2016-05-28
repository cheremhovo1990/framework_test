<?php

namespace app\controllers;

use fra\View;

class News
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        $methodName = 'action' . $action;
        $this->beforeAction();
        return $this->$methodName();
    }

    protected function beforeAction()
    {
    }

    protected function actionIndex()
    {
        $model = new \app\models\Test();
        $model->name = 'Robbert';
        $model->email = 'my@emial.com';
        $model->insert();
    }

    protected function actionOne()
    {
/*        $id = (int)$_GET['id'];
        $this->view->article = \app\Models\News::findById($id);
        $this->view->display(__DIR__ . '/../templates/one.php');*/
    }

    protected function actionCreate()
    {
/*        try {
            $article = new \app\Models\News();
            $article->fill([]);
            $article->save();
        } catch (MultiException $e) {
            $this->view->errors = $e;
        }
        $this->view->display(__DIR__ . '/../templates/create.php');*/
    }

}