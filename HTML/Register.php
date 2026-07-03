<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('Footer.php'); ?>
<?php require('../PHP/PHP_register.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Register.css">
</head>

<body>
    <!-- 1. Выводим ошибку в самом начале BODY, чтобы она была выше всех -->

    <!-- Вывод сообщения об ошибке регистрации в связи с неполадками с соединением, несовпадением паролей
    или совпадении логина с уже существующим в таблице зарегистрированных пользователей -->
    <?php if (!empty($message_register_fail_connection) || !empty($message_register_fail_passwords) || !empty($message_register_fail_login)): ?>
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
                <p><?php echo $message_register_fail_connection, $message_register_fail_passwords, $message_register_fail_login; ?></p>
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
        <div class="container_register">
            <h1 class="auth-title" style="color: grey">Регистрация</h1>
            <form method="POST" action="">
                Логин: <input type="text" name="login" minlength="8" placeholder="Минимум 8 символов" required><br>
                Пароль: <input type="password" name="password" minlength="8" placeholder="Минимум 8 символов"
                    required><br>
                Повторите пароль: <input type="password" name="password1" placeholder="Должен совпадать с паролем"
                    required><br>
                Email: <input type="email" name="email" required><br>
                Согласие на обработку персональных данных: <input type="checkbox" name="personal" required><br>
                <input type="submit" name="button_reg" value="Регистрация">
            </form>
        </div>
    </div>
</body>

</html>