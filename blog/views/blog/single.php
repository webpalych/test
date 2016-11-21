<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $article->title; ?></title>
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
        <h1><?php echo $article->title;?></h1>
        <span>Дата: <?php echo date('d-m-Y', strtotime($article->date))?></span>
        <p><?php echo $article->text;?></p>
    <p><a href="/blog">На главную</a></p>
    </body>
</html>