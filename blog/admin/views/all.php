<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Консоль</title>
</head>
<body>
<p>
    Привет, <?php echo $user_name;?>!
    <a href="/blog/admin/?ctrl=Admin&action=Logout">Выйти</a>
</p>
<h1>Все Записи</h1>
<?php if($_GET['result'] == 'deleted') {
    echo 'Запись удалена!';
}
?>
<table border="1">
    <tr>
        <th>Название</th>
        <th>Дата</th>
        <th></th>
    </tr>
    <?php
    foreach ($articles as $article) : ?>
        <tr>
            <td><?php echo $article->title;?></td>
            <td><?php echo date('d-m-Y', strtotime($article->date))?></td>
            <td>
                <a href="/blog/admin/?ctrl=Admin&action=Edit&id=<?php echo $article->id?>">Изменить</a>
                <a href="/blog/admin/?ctrl=Admin&action=Delete&id=<?php echo $article->id?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="/blog/admin/?ctrl=Admin&action=Edit">Добавить новую</a>
</p>
</body>
</html>