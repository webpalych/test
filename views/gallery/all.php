<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
    <style>
        img {
            width: 200px;
            height: auto;
        }
        figure {
            display: inline-block;
            vertical-align: top;
        }
        form:before {
            clear: both;
            display: block;
            content: '';
        }
    </style>
</head>
<body>

<h1>Галерея!</h1>
<?php if ($_GET['result'] == 'deleted') {?>
    <h4 style="color: red">Изображение удалено!</h4>
<?php }?>
<?php if ($_GET['result'] == 'uploaded') {?>
    <h4 style="color: green">Изображение добавлено!</h4>
<?php }?>

<?php
foreach ($images as $image) : ?>
    <figure>
        <h3><?php echo $image->name;?></h3>
        <span>Просмотров: <?php echo $image->views;?></span>
        <br/>
        <a href="<?php echo SITE_ADDRESS . '/?ctrl=Gallery&action=One&id=' . $image->id; ?>">
            <img src="<?php echo $image->path;?>" alt="<?php echo $image->name;?>">
        </a>
        <br/>
        <a href="<?php echo SITE_ADDRESS . '/?ctrl=Gallery&action=Delete&id=' . $image->id; ?>">Удалить</a>
    </figure>
<?php endforeach; ?>

<form action="/?ctrl=Gallery&action=Save" method="post" enctype="multipart/form-data">
    <p>Выберите файл: </p>
    <input type="file" name="file" size="20" required>
    <p>Название изображения:</p>
    <input type="text" name="filename">
    <br/>
    <input type="submit" value="Загрузить">
</form>

</body>
</html>