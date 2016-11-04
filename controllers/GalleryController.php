<?php

class GalleryController {

    public function actionAll () {

        $images = Gallery::get_all();
        include __DIR__ . '/../views/gallery/all.php';

    }

    public function actionOne() {

        if ( $image = Gallery::get_one( $_GET['id'] )) {
            $image->increment_view();
            include_once __DIR__.'/../views/gallery/single.php';
        }  else {
            include __DIR__ . '/../views/404.php';
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

            include __DIR__.'/../views/404.php';

        }

    }
}