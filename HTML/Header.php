<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Header.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="Website.php" class="logo-link">
                <i class="GGGAME-icon"></i>
                GGGAME
            </a>

            <nav>
                <ul>
                    <li><a href="Website.php">Главная</a></li>
                    <li><a href="Playthroughs.php">Прохождения</a></li>
                    <li><a href="Gallery.php">Галерея</a></li>
                    <li><a href="Worlds.php">Скачать миры</a></li>
                    <li><a href="Feedback.php">Отзывы</a></li>

                    <!-- Отдельный пунк меню, который показывается, когда пользователь авторизовался -->
                    <?php if (isset($_SESSION['login'])): ?>
                        <!-- Видно только авторизованным -->
                        <li><a href="Clicker.php">Мини-игра</a></li>
                    <?php endif; ?>
                    
                    <!-- Отдельный пунк меню, который показывается, когда пользователь авторизовался -->
                    <?php if (isset($_SESSION['login'])): ?>
                        <!-- Видно только авторизованным -->
                        <li class="user-info" style="font-family: times new roman">Вы вошли как: <strong><?php echo $_SESSION['login']; ?></strong></li>
                        <li><a href="../PHP/PHP_QuitAuth.php">Выйти</a></li>
                    <?php else: ?>
                        <li><a href="Auth.php">Авторизация</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </header>

</body>

</html>