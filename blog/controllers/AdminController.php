<?php

class AdminController {

    public function actionAll () {

        $items = Article::get_all();
        $view = new View;
        $view->articles = $items;
        $view->display_admin('all.php');

    }

    public function actionEdit () {

        $view = new View;

        if ($_GET['id']) {
            $article = Article::get_one_by_id($_GET['id']);
            $view->article = $article;
        }

        $view->display_admin('edit.php');
    }

    public function actionUpdate () {

        if ($_GET['id']) {
            $new_article = new Article;
            $new_article->id = $_GET['id'];
            $new_article->title = $_POST['articleTitle'];
            $new_article->text = $_POST['articleText'];
            $new_article->save();
            header('Location: /blog/admin/?ctrl=Admin&action=EditArticle&id='.$new_article->id.'&result=updated');
        } else {
            $new_article = new Article;
            $new_article->title = $_POST['articleTitle'];
            $new_article->text = $_POST['articleText'];
            $new_article->save();
            header('Location: /blog/admin/?ctrl=Admin&action=EditArticle&id='.$new_article->id.'&result=added');
        }

    }

    public function actionDelete () {

       if (Article::delete($_GET['id'])) {
           header('Location: /blog/admin/?result=deleted');
       } else {
           $view = new View;
           $view->display('404.php');
       }

    }

} 