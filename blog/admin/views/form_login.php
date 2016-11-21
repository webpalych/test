<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
<h1>Введите логин и пароль</h1>
<form method="post" action="/blog/admin/?ctrl=Admin&action=Login">
    <p>Имя пользователя</p>
    <input type="text" name="userName" required>
    <p>Пароль</p>
    <input type="password" name="userPass" required>
    <br/>
    <input type="submit" value="Войти">
</form>
<?php if($_GET['result'] == 'auth_error') {
    echo 'Неверное имя пользователя и/или пароль!';
}
if($_GET['result'] == 'logout') {
    echo 'Вы успешно вышли.';
}
if($_GET['result'] == 'success_register') {
    echo 'Вы успешно зарегистрировались! Теперь вы можете войти на сайт.';
}
?>
</body>
</html>