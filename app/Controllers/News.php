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
/*        $this->view->title = 'Мой крутой сайт!';
        $this->view->news = \app\Models\News::findAll();
        $this->view->display(__DIR__ . '/../templates/index.php');*/
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