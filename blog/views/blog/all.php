<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Блог</title>
    </head>
    <body>
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