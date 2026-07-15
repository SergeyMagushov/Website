<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('../PHP/PHP_account.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Account.css">
</head>

<!-- Вывод сообщения об ошибке подключения -->
<?php if (!empty($message_account_fail)): ?>
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
            <!-- ИСПРАВЛЕНО: имя переменной заменено на корректное message_score_fail -->
            <p><?php echo $message_account_fail; ?></p>
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

<body>
    <div class="container">
        <!-- Левая колонка -->
        <div class="feedback">
            <h1 class="auth-title" style="color: grey">Ваши комментарии</h1>
            <?php feedback_info(); ?>
        </div>
        
        <div class="clicker-auth">
            <div class="clicker">
                <h1 class="auth-title" style="color: grey">Ваши рекорды</h1>
                <?php clicker_info(); ?>
            </div>
            
            <div class="auth">
                <h1 class="auth-title" style="color: grey">Данные аккаунта</h1>
                <?php auth_info(); ?>
                <input type="submit" value="Выйти" onclick="window.location.href='../PHP/PHP_QuitAuth.php'; return false;">
            </div>           
        </div>

        <div class="top-users">
            <h1 class="auth-title" style="color: grey">Топ-время</h1>
            <?php top_users_info(); ?>
        </div>
    </div>

    <?php require('Footer.php'); ?>
</body>

</html>
