<?php session_start(); ?>
<?php require('../PHP/PHP_account.php'); ?>
<?php require('Header.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет игрока — Статистика и достижения</title>
    <meta name="description" content="Управляйте своим аккаунтом, просматривайте историю опубликованных комментариев, рекорды кликов и общую таблицу топ-игроков по времени.">
    <link rel="stylesheet" href="../CSS/Account.css">
</head>

<body>
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
            
            <span onclick="document.getElementById('errorModal').remove()" style="
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 24px;
                font-weight: bold;
                color: #aaa;
                cursor: pointer;
                line-height: 1;
                transition: color 0.2s;
            " onmouseover="this.style.color='#333'" onmouseout="this.style.color='#aaa'">
                &times;
            </span>

            <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;">Ошибка</p>
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

<!-- Вывод сообщения об удалении комментария -->
<?php if (!empty($_SESSION['message_feedback_delete'])): ?>
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
        
            <span onclick="document.getElementById('errorModal').remove()" style="
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 24px;
                font-weight: bold;
                color: #aaa;
                cursor: pointer;
                line-height: 1;
                transition: color 0.2s;
            " onmouseover="this.style.color='#333'" onmouseout="this.style.color='#aaa'">
                &times;
            </span>

            <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;">Поздравляем</p>
            <p><?php echo $_SESSION['message_feedback_delete']; ?></p>
            <button class="modal-button" onclick="this.closest('#errorModal').remove()" style="
                margin-top: 15px;
                padding: 8px 25px;
                cursor: pointer;
                border: 3px solid grey;
                border-radius: 5px;
            ">ОК</button>
        </div>
    </div>

    <!-- Удаление сообщения об удалении комментария, чтобы оно не появлялось постоянно при перезагрузки страницы личного кабинета -->
    <?php
    unset($_SESSION['message_feedback_delete']);
?>
<?php endif; ?>

<!-- Вывод модального окна с полем для изменения комментария -->
<!-- К этом модальному окну не применяется анимация автоматического закрытия из файла Window.js, потому что у него название errorModalLong -->
<!-- Автоматического закрытия модального окна, так как необходимо написать новый комментарий -->
<?php if (!empty($_SESSION['feedback_edit'])): ?>
    <div id="errorModalLong" style="
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
        
            <span onclick="document.getElementById('errorModalLong').remove()" style="
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 24px;
                font-weight: bold;
                color: #aaa;
                cursor: pointer;
                line-height: 1;
                transition: color 0.2s;
            " onmouseover="this.style.color='#333'" onmouseout="this.style.color='#aaa'">
                &times;
            </span>

            <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;"><?php echo $_SESSION['feedback_edit']; ?></p>
                <form action="" method="POST">                    
                    <input type="text" name="edit_comment_text" minlength="10" maxlength="3000" placeholder="От 10 до 3 000 символов" required><br>
                    <input type="submit" name="button_feedback" value="Изменить комментарий">
                </form>
        </div>
    </div>

    <!-- Удаление сообщения об изменении комментария, чтобы оно не появлялось постоянно при перезагрузки страницы личного кабинета -->
    <?php
    unset($_SESSION['feedback_edit']);    
?>
<?php endif; ?>

<!-- Вывод сообщения об изменении комментария -->
<?php if (!empty($_SESSION['message_feedback_edit'])): ?>
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
        
            <span onclick="document.getElementById('errorModal').remove()" style="
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 24px;
                font-weight: bold;
                color: #aaa;
                cursor: pointer;
                line-height: 1;
                transition: color 0.2s;
            " onmouseover="this.style.color='#333'" onmouseout="this.style.color='#aaa'">
                &times;
            </span>

            <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 10px;">Поздравляем</p>
            <p><?php echo $_SESSION['message_feedback_edit']; ?></p>
            <button class="modal-button" onclick="this.closest('#errorModal').remove()" style="
                margin-top: 15px;
                padding: 8px 25px;
                cursor: pointer;
                border: 3px solid grey;
                border-radius: 5px;
            ">ОК</button>
        </div>
    </div>

    <!-- Удаление сообщения об изменении комментария, чтобы оно не появлялось постоянно при перезагрузки страницы личного кабинета -->
    <?php
    unset($_SESSION['message_feedback_edit']);
?>
<?php endif; ?>

    <h1 style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">Ваш профиль и личные рекорды</h1>

    <main class="container">
        <!-- Левая колонка -->
        <section class="feedback">
            <h2 class="auth-title" style="color: grey">Ваши комментарии</h2>
            <?php feedback_info(); ?>
        </section>

        <div class="clicker-auth">
            <section class="clicker">
                <h2 class="auth-title" style="color: grey">Ваши рекорды</h2>
                <?php clicker_info(); ?>
            </section>

            <section class="auth">
                <h2 class="auth-title" style="color: grey">Данные аккаунта</h2>
                <?php auth_info(); ?>
                <input type="submit" value="Выйти"
                    onclick="window.location.href='../PHP/PHP_QuitAuth.php'; return false;">
            </section>
        </div>

        <section class="top-users">
            <h2 class="auth-title" style="color: grey">Топ-время</h2>
            <?php top_users_info(); ?>
        </section>
    </main>

    <?php require('Footer.php'); ?>

    <script src="../Java Script/Window.js"></script>
</body>

</html>
