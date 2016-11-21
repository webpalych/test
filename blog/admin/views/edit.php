<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить новость</title>
</head>
<body>
<p>
    Привет, <?php echo $user_name;?>!
    <a href="/blog/admin/?ctrl=Admin&action=Logout">Выйти</a>
</p>

<form method="post" action="/blog/admin/?ctrl=Admin&action=Update<?php echo $article->id ? '&id='.$article->id : '' ?>">
    <p>Название</p>
    <input type="text" name="articleTitle" value="<?php echo $article->title ? $article->title : ''?>"/>
    <p>Текст</p>
    <textarea name="articleText" cols="30" rows="10"><?php echo $article->text ? $article->text : ''?></textarea>
    <br/>
    <input type="submit" value="Обновить"/>
</form>
<?php if($_GET['result'] == 'updated') {
    echo 'Запись обновлена!';
}
if($_GET['result'] == 'added') {
    echo 'Запись добавлена!';
}
?>
</body>
</html>