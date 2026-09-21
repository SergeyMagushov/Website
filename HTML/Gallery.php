<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея картинок — Медиафайлы, фанарты и скриншоты GGGAME</title>
    <meta name="description" content="Интерактивная галерея картинок нашего игрового сообщества. Нажмите на изображение для его увеличения. Здесь собраны лучшие арты и превью стримов.">
    <link rel="stylesheet" href="../CSS/Gallery.css">
</head>

<body>
    <h1 style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">Фотогалерея и медиа материалы проекта GGGAME</h1>

    <main class="body">
        <div class="body1">
            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-1" class="zoom-checkbox">
                <label for="zoom-img-1">
                    <img src="../Images/Gallery/10607152-1770-4502-a7c0-d20f1a389499-profile_image-300x300.png"
                        alt="Главное изображение профиля GGGAME">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-2" class="zoom-checkbox">
                <label for="zoom-img-2">
                    <img src="../Images/Gallery/gdvy1f9T5kIGj4XmZyPrVowfDrBsHPJg8uC8F7Kta50s-R1G-4RMpv2XrupwDm1xt5LWVuy-.jpg"
                        alt="Графический арт по мотивам игры Террария">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-3" class="zoom-checkbox">
                <label for="zoom-img-3">
                    <img src="../Images/Gallery/AerKQg41OSo.jpg" alt="Интересный скриншот прохождения игры">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-4" class="zoom-checkbox">
                <label for="zoom-img-4">
                    <img src="../Images/Gallery/f9132e78ad7c0b0f2ceb00e3347b19bb.1000x1000x1.jpg" alt="Тематический игровой мем сообщества">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-5" class="zoom-checkbox">
                <label for="zoom-img-5">
                    <img src="../Images/Gallery/images (1).jfif" alt="Элемент оформления канала Серега">
                </label>
            </div>
        </div>

        <div class="body1">
            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-6" class="zoom-checkbox">
                <label for="zoom-img-6">
                    <img src="../Images/Gallery/i (4).webp" alt="Картинка превью GGGAME смотрит">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-7" class="zoom-checkbox">
                <label for="zoom-img-7">
                    <img src="../Images/Gallery/i (4)(1).webp" alt="Альтернативный арт хайлайтов стримов">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-8" class="zoom-checkbox">
                <label for="zoom-img-8">
                    <img src="../Images/Gallery/i (5).webp" alt="Обложка видеоролика Террария Хардкор">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-9" class="zoom-checkbox">
                <label for="zoom-img-9">
                    <img src="../Images/Gallery/i (6).webp" alt="Превью серии Бесконечная Террария">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-10" class="zoom-checkbox">
                <label for="zoom-img-10">
                    <img src="../Images/Gallery/gggame-гггейм.gif" alt="Фирменная гиф анимация логотипа GGGAME">
                </label>
            </div>
        </div>

        <div class="body1">
            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-11" class="zoom-checkbox">
                <label for="zoom-img-11">
                    <img src="../Images/Gallery/i (8).webp" alt="Скриншот игрового мира Майнкрафт">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-12" class="zoom-checkbox">
                <label for="zoom-img-12">
                    <img src="../Images/Gallery/i (9).webp" alt="Графика к прохождению игры Smite 2">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-13" class="zoom-checkbox">
                <label for="zoom-img-13">
                    <img src="../Images/Gallery/i (10).webp" alt="Игровой постер к разбору Deadlock">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-14" class="zoom-checkbox">
                <label for="zoom-img-14">
                    <img src="../Images/Gallery/i (11).webp" alt="Баннер раздела Скачать миры">
                </label>
            </div>

            <div class="zoom-container">
                <input type="checkbox" id="zoom-img-15" class="zoom-checkbox">
                <label for="zoom-img-15">
                    <img src="../Images/Gallery/i (12).webp" alt="Финальный графический элемент галереи">
                </label>
            </div>
        </div>
    </main>

    <?php require('Footer.php'); ?>
</body>

</html>
