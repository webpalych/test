<?php

class GalleryController  {

    public function actionAll () {

        $items = Gallery::get_all();
        $view = new View;
        $view->images = $items;
        $view->display('gallery/all.php');

    }

    public function actionOne() {

        $view = new View;
        if ( $item = Gallery::get_one( $_GET['id'] )) {
            $item->increment_view();
            $view->image = $item;
            $view->display('gallery/single.php');
        }  else {
            $view->display('404.php');
        }

    }

    public function actionSave() {

        if ($_FILES['file']) {

            if (!empty($_POST['filename'])) {
                Gallery::save_image($_FILES['file'], '/img', $_POST['filename']);
            } else {
                Gallery::save_image($_FILES['file'], '/img');
            }

        } else {

            echo 'Файл не выбран!';

        }

    }

    public function actionDelete() {

        if (isset($_GET['id'])) {

            Gallery::delete_image( $_GET['id']);

        } else {
            $view = new View;
            $view->display('404.php');

        }

    }
}