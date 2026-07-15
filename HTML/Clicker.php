<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('../PHP/PHP_clicker.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой Кликер</title>
    <link rel="stylesheet" href="../CSS/Clicker.css">
</head>

<body>
    <!-- Вывод сообщения о записи счета -->
    <?php if (!empty($message_score_success)): ?>
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
                <p><?php echo $message_score_success; ?></p>
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

    <!-- Вывод сообщения об ошибке записи счета -->
    <?php if (!empty($message_score_fail)): ?>
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
                <p><?php echo $message_score_fail; ?></p>
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
        <?php if (isset($_SESSION['login'])): ?>
            <!-- Этот блок виден ТОЛЬКО авторизованным пользователям -->
            <div class="container">
                <form action="" method="POST" class="game" onsubmit="updateHiddenField()">
                    <!-- Заголовок со счетом. Внутри span с id="score", который будет менять JavaScript -->
                    <h1>Счет: <span id="score">0</span></h1>
                    <!-- Кнопка клика -->
                    <div class="button" id="button"></div>
                    <!-- Счетчик прибавки при ручном нажатии -->
                    <h1>Один клик: <span id="score1">1</span></h1>
                    <!-- Счетчик авто-прибавки  -->
                    <h1>Авто-клик: <span id="score2">1</span></h1>
                    <h1><span id="attention"></span></h1>
                    <!-- Невидимое поле - Сюда записывается счет -->
                    <input type="hidden" name="score" id="hidden_score" value="0">
                    <!-- Кнопка записи данных в таблицу базы данных -->
                    <input type="submit" name="button_score" value="Сохранить результат">
                </form>


                <!-- Кнопки улучшений (первая группа)-->
                <div class="buttons">
                    <h1>Прибавка +1 (Цена 20)</h1>
                    <div class="button1" id="button1"></div>
                    <h1>Прибавка +2 (Цена 40)</h1>
                    <div class="button2" id="button2"></div>
                    <h1>Прибавка +4 (Цена 80)</h1>
                    <div class="button3" id="button3"></div>
                    <h1>Прибавка +8 (Цена 160)</h1>
                    <div class="button4" id="button4"></div>
                </div>

                <!-- Кнопки улучшений (вторая группа)-->
                <div class="buttons1">
                    <h1>Прибавка +16 (Цена 320)</h1>
                    <div class="button5" id="button5"></div>
                    <h1>Прибавка +32 (Цена 640)</h1>
                    <div class="button6" id="button6"></div>
                    <h1>Прибавка +64 (Цена 1280)</h1>
                    <div class="button7" id="button7"></div>
                    <h1>Прибавка +128 (Цена 2560)</h1>
                    <div class="button8" id="button8"></div>
                </div>

                <!-- Кнопки улучшений (авто клики)-->
                <div class="buttons2">
                    <h1>Авто-прибавка +1 (Цена 200)</h1>
                    <div class="button9" id="button9"></div>
                    <h1>Авто-прибавка +2 (Цена 400)</h1>
                    <div class="button10" id="button10"></div>
                    <h1>Авто-прибавка +4 (Цена 800)</h1>
                    <div class="button11" id="button11"></div>
                    <h1>Авто-прибавка +8 (Цена 1600)</h1>
                    <div class="button12" id="button12"></div>
                </div>
            </div>
        <?php else: ?>
            <div class="container" style="display: flex; justify-content: center; align-items: center; color: #333; padding: 20px;">
                <p>Чтобы поиграть в кликер —
                    <a href="Auth.php" style="color: #007bff; text-decoration: underline;">авторизуйтесь</a>.
                </p>
            </div>
        <?php endif; ?>

        <div class="scrollable-box">
            <?php score_publish(); ?>
        </div>
    </div>

    <?php require('Footer.php'); ?>

    <script src="../Java Script/Clicker.js"></script>
</body>

</html>