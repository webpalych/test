<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<h1>Введите логин и пароль</h1>
<form method="post" action="/blog/admin/?ctrl=Admin&action=Register">
    <p>Имя пользователя</p>
    <input type="text" name="userName" required>
    <p>Пароль</p>
    <input type="password" name="userPass" required>
    <br/>
    <input type="submit" value="Регистрация">
</form>
</body>
</html>