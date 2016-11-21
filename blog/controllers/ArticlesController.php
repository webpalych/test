<?php

class ArticlesController  {

    public function actionAll () {

        session_start();

        $items = Article::get_all();
        $view = new View;

        if ( isset($_SESSION['login'])) {
            $view->user_name = $_SESSION['user'];
        }

        $view->articles= $items;
        $view->display('blog/all.php');

    }

    public function actionOne() {

        session_start();

        $view = new View;

        if ( $item = Article::get_one_by_id( $_GET['id'] )) {

            $view->article = $item;

            if ( isset($_SESSION['login'])) {
                $view->user_name = $_SESSION['user'];
            }

            $view->display('blog/single.php');

        } else {

            $view->display('404.php');

        }

    }
}