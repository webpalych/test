<?php

class ArticlesController  {

    public function actionAll () {

        $items = Article::get_all();
        $view = new View;
        $view->articles= $items;
        $view->display('blog/all.php');

    }

    public function actionOne() {

        $view = new View;
        if ( $item = Article::get_one_by_id( $_GET['id'] )) {

            $view->article = $item;
            $view->display('blog/single.php');

        } else {

            $view->display('404.php');

        }

    }
}