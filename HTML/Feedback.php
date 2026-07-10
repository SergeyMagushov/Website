<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('../PHP/PHP_feedback.php'); ?>
<?php require('../PHP/PHP_auth.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Feedback.css">
</head>

<body>

    <!-- 1. Выводим оповещения в самом начале, чтобы они были выше всех -->
    <!-- Вывод сообщения об авторизации -->
    <?php if (!empty($_SESSION['message_auth_success'])): ?>
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
                <p><?php echo $_SESSION['message_auth_success']; ?></p>
                <button class="modal-button" onclick="this.closest('#errorModal').remove()" style="
                margin-top: 15px;
                padding: 8px 25px;
                cursor: pointer;
                border: 3px solid grey;
                border-radius: 5px;
            ">ОК</button>
            </div>
        </div>

        <!-- Удаление сообщения об авторизации, чтобы оно не появлялось постоянно при открытии страницы с отзывами -->
        <?php
        unset($_SESSION['message_auth_success']);
        ?>
    <?php endif; ?>

    <!-- Вывод сообщения о публикации комментария -->
    <?php if (!empty($message_feedback_success)): ?>
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
                <p><?php echo $message_feedback_success; ?></p>
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

    <!-- Вывод сообщения об ошибке публикации комментария -->
    <?php if (!empty($message_feedback_fail)): ?>
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
                <p><?php echo $message_feedback_fail; ?></p>
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

    <div class="body">
        <div class="scrollable-box">
            <?php feedback_publish(); ?>
        </div>

        <?php if (isset($_SESSION['login'])): ?>
            <!-- Этот блок виден ТОЛЬКО авторизованным пользователям -->
            <div class="container_feedback">
                <h1 class="auth-title" style="color: grey">Оставить отзыв</h1>
                <form action="" method="POST" class="feedback">
                    Оценка видосам: <input type="number" min="0" max="10" name="rating" placeholder="От 1 до 10"
                        required><br>
                    Комментарий: <input type="text" name="text" minlength="10" maxlength="3000"
                        placeholder="От 10 до 3 000 символов" required><br>
                    Когда начали смотреть (примерно): <input type="date" name="date" style="color: grey" required><br>
                    Согласие на обработку персональных данных: <input type="checkbox" name="personal" required><br>
                    <input type="submit" name="button_feedback" value="Оставить комментарий">
                </form>
            </div>
        <?php else: ?>
            <!-- Этот блок виден ТОЛЬКО гостям -->
            <div class="container_feedback" style="text-align: center; padding: 20px;">
                <p>Чтобы оставить комментарий —
                    <a href="Auth.php" style="color: #007bff; text-decoration: underline;">авторизуйтесь</a>.
                </p>
            </div>
        <?php endif; ?>
    </div>

    <?php require('Footer.php'); ?>
</body>

</html>