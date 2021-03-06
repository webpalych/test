<?php

class AdminController {

    public function actionAll () {

        session_start();

        if ( !isset($_SESSION['login'])) {

            $view = new View;
            $view->display_admin('form_login.php');

        } else {

            $items = Article::get_all();
            $view = new View;
            $view->user_name = $_SESSION['user'];
            $view->articles = $items;
            $view->display_admin('all.php');

        }

    }

    public function actionEdit () {

        session_start();

        if ( !isset($_SESSION['login'])) {

            $view = new View;
            $view->display_admin('form_login.php');

        } else {

            $view = new View;
            $view->user_name = $_SESSION['user'];
            if ($_GET['id']) {
                $article = Article::get_one_by_id($_GET['id']);
                $view->article = $article;
            }

            $view->display_admin('edit.php');
        }
    }

    public function actionUpdate () {

        session_start();

        if ( !isset($_SESSION['login'])) {

            $view = new View;
            $view->display_admin('form_login.php');

        } else {

            if ($_GET['id']) {
                $new_article = new Article;
                $new_article->id = $_GET['id'];
                $new_article->title = $_POST['articleTitle'];
                $new_article->text = $_POST['articleText'];
                $new_article->save();
                header('Location: /blog/admin/?ctrl=Admin&action=Edit&id='.$new_article->id.'&result=updated');
            } else {
                $new_article = new Article;
                $new_article->title = $_POST['articleTitle'];
                $new_article->text = $_POST['articleText'];
                $new_article->save();
                $transport = Swift_MailTransport::newInstance();

                $mailer = Swift_Mailer::newInstance($transport);

                $message = Swift_Message::newInstance()

                    // Give the message a subject
                    ->setSubject('Создана новая запись!')

                    // Set the From address with an associative array
                    ->setFrom(array('john@doe.com' => 'John Doe'))

                    // Set the To addresses with an associative array
                    ->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))

                    // Give it a body
                    ->setBody('<html>' .
                        ' <head></head>' .
                        ' <body>' .
                        '<h1>Добавлена новая запись</h1>' .
                        '<p>Название:' . $new_article->title. ' </p>'.
                        ' </body>' .
                        '</html>',
                        'text/html');

                $mailer->send($message);

                header('Location: /blog/admin/?ctrl=Admin&action=Edit&id='.$new_article->id.'&result=added');
            }
        }
    }

    public function actionDelete () {

        session_start();

        if ( !isset($_SESSION['login'])) {

            $view = new View;
            $view->display_admin('form_login.php');

        } else {

            if (Article::delete($_GET['id'])) {

                header('Location: /blog/admin/?result=deleted');

            } else {

                $view = new View;
                $view->display('404.php');

            }
        }
    }

    public function actionLogin () {

        $user_name = $_POST['userName'];
        $user_pass_hash = md5($_POST['userPass']);

        $user = Users::get_one_by_field('user_name',$user_name);

        if ($user && ($user_pass_hash == $user->password_hash)) {

            session_start();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user->user_name;

            $this->actionAll();

        } else {

            header('Location: /blog/admin/?result=auth_error');

        }

    }

    public function actionLogout () {

        session_start();
        $_SESSION = array();
        session_destroy();

        header('Location: /blog/admin/?result=logout');

    }

    public function actionRegister () {

        $user = new Users;

        $user->user_name = $_POST['userName'];
        $user->password_hash = md5($_POST['userPass']);

        if ($user->user_name && $user->password_hash) {

            $user->save();

            if ($user->id) {

                header('Location: /blog/admin/?result=success_register');

            } else {

                die ('Ошибка доступа к базе данных!');

            }

        } else {

            $this->actionFormRegister();

        }

    }

    public function actionFormRegister () {

        $view = new View;
        $view->display_admin('form_register.php');

    }

    public function actionFormLogin () {

        $view = new View;
        $view->display_admin('form_login.php');

    }

} 