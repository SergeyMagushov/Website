<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('Footer.php'); ?>
<?php require('../PHP/PHP_auth.php'); ?>
<?php require('../PHP/PHP_register.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Auth.css">
</head>

<body>
    <!-- 1. Выводим оповещения в самом начале, чтобы они были выше всех -->
    <!-- Вывод сообщения об успешном выходе из личного кабинета -->
    <?php if (!empty($_SESSION['message_auth_quit'])): ?>
        <div id="errorModal" style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999999;
    ">
            <div style="
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            min-width: 300px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            color: #333;
            position: relative;
        ">
                <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;">Внимание</p>
                <p><?php echo $_SESSION['message_auth_quit']; ?></p>
                <button class="modal-button" onclick="this.closest('#errorModal').remove()" style="
                margin-top: 15px;
                padding: 8px 25px;
                cursor: pointer;
                border: 3px solid grey;
                border-radius: 5px;
            ">ОК</button>
            </div>
        </div>

        <!-- Удаление сообщения о выходе из личного кабнета, чтобы оно не появлялось постоянно при открытии страницы авторизации -->
        <?php
        unset($_SESSION['message_auth_quit']);
        ?>
    <?php endif; ?>

    <!-- Вывод сообщения об успешной регистрации -->
    <?php if (!empty($_SESSION['message_register_success'])): ?>
        <div id="errorModal" style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999999;
    ">
            <div style="
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            min-width: 300px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            color: #333;
            position: relative;
        ">
                <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;">Поздравляем</p>
                <p><?php echo $_SESSION['message_register_success']; ?></p>
                <button class="modal-button" onclick="this.closest('#errorModal').remove()" style="
                margin-top: 15px;
                padding: 8px 25px;
                cursor: pointer;
                border: 3px solid grey;
                border-radius: 5px;
            ">ОК</button>
            </div>
        </div>

        <!-- Удаление сообщения об успешной регистрации, чтобы оно не появлялось постоянно при открытии страницы авторизации -->
        <?php
        unset($_SESSION['message_register_success']);
        ?>
    <?php endif; ?>

    <!-- Вывод сообщения об ошибке авторизации в связи с неправильным логином, паролем -->
    <?php if (!empty($message_auth_fail)): ?>
        <div id="errorModal" style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999999;
        ">
            <div style="
                background: white;
                padding: 30px;
                border-radius: 10px;
                text-align: center;
                min-width: 300px;
                box-shadow: 0 0 20px rgba(0,0,0,0.5);
                color: #333;
                position: relative;
            ">
                <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;">Ошибка</p>
                <p><?php echo $message_auth_fail; ?></p>
                <button class="modal-button" onclick="this.closest('#errorModal').remove()" style="
                    margin-top: 15px;
                    padding: 8px 25px;
                    cursor: pointer;
                    border: 3px solid grey;
                    border-radius: 5px;
                ">ОК</button>
            </div>
        </div>
    <?php endif; ?>


    <div class="container">
        <div class="container_auth">
            <h1 class="auth-title" style="color: grey">Вход в систему</h1>
            <form method="POST" action="">
                Логин: <input type="text" name="login" required><br>
                Пароль: <input type="password" name="password" required><br>
                <nav>
                    <ul>
                        <li><a href="Register.php">Нет аккаунта ?</a></li>
                    </ul>
                </nav>
                <input type="submit" name="button_auth" value="Войти в аккаунт">
            </form>
        </div>
    </div>
</body>

</html>