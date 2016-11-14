<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $article->title; ?></title>
    </head>
    <body>
        <h1><?php echo $article->title;?></h1>
        <span>Дата: <?php echo date('d-m-Y', strtotime($article->date))?></span>
        <p><?php echo $article->text;?></p>
    <p><a href="/blog">На главную</a></p>
    </body>
</html>