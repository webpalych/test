<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Блог</title>
    </head>
    <body>
        <?php if ($user_name) :?>
            <p>
                Привет, <?php echo $user_name;?>!
                <a href="/blog/admin/?ctrl=Admin&action=Logout">Выйти</a>
            </p>
        <?php else: ?>
            <p>
                <a href="/blog/admin/?ctrl=Admin&action=FormLogin">Войдите</a>
                или
                <a href="/blog/admin/?ctrl=Admin&action=FormRegister">Зарегистрируйтесь</a>
            </p>
        <?php endif;?>
        <h1>Блог</h1>

        <?php
        foreach ($articles as $article) : ?>

            <h2><?php echo $article->title;?></h2>
            <span><?php echo date('d-m-Y', strtotime($article->date))?></span>
            <p><?php echo $article->text;?></p>
            <a href="/blog/?ctrl=Articles&action=One&id=<?php echo $article->id;?>">Подробнее &gt;</a>

        <?php endforeach; ?>


    </body>
</html>