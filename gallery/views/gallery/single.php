<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
    <style>
        img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<h1><?php echo $image->name;?></h1>
<span>Просмотров: <?php echo $image->views;?></span>
<br/>
<a href="<?php echo SITE_ADDRESS . '/gallery/?ctrl=Gallery&action=Delete&id=' . $image->id; ?>">Удалить</a>
<figure>
    <img src="<?php echo '/gallery' . $image->path;?>" alt="<?php echo $image->name;?>">
</figure>
</body>
</html>