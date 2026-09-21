<?php session_start(); ?>
<?php require('Header.php'); ?>
<?php require('../PHP/PHP_time.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Прохождения видеоигр — Все плейлисты и серии каналов GGGAME</title>
        <meta name="description" content="Смотрите полные прохождения игровых проектов, плейлисты серий по Террарии на хардкоре, Майнкрафту и обзоры новинок Smite от авторов нашего сообщества.">
        <link rel="stylesheet" href="../CSS/Playthroughs.css">
</head>


<body>
        <h1 style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">Архив игровых прохождений и видеоматериалов GGGAME</h1>

        <main class="sliders-container">
                <!-- Слайдер 1 -->
                <div class="slider1" id="slider1">
                        <p class="slider-title">GGGAME</p>
                        <div class="slides" id="slides1">
                                <div class="slide active">
                                        <a href="https://www.youtube.com/playlist?list=PLbc9UrelHDeXJ1QzOzQ_lHNPOyspcb0EI"
                                                target="_blank">
                                                <img src="../Images/Sliders/Террария хардкор.jpeg" alt="Прохождение Террария Хардкор">
                                        </a>
                                        <p class="picture_name">Террария Хардкор</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLbc9UrelHDeVjghAJA2Htl606OSyqvndv"
                                                target="_blank"><img src="../Images/Sliders/Террария на планетах.jpeg" alt="Прохождение Террария на планетах"></a>
                                        <p class="picture_name">Террария на планетах</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLbc9UrelHDeWXoOd0_3EVmYc-f2RrNdZt"
                                                target="_blank"><img src="../Images/Sliders/Микро террария.jpeg" alt="Прохождение Микро Террария"></a>
                                        <p class="picture_name">Микро Террария</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLbc9UrelHDeUv4hMR_hGXZ-t1E3YbQbvl"
                                                target="_blank"><img src="../Images/Sliders/Террария на острове.jpeg" alt="Прохождение Террария на острове"></a>
                                        <p class="picture_name">Террария на острове</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLbc9UrelHDeXn9Fp48UnSAYAirZWE-wRr"
                                                target="_blank"><img src="../Images/Sliders/Террария за йо-йошника.jpeg" alt="Летсплей Террария за йо-йошника"></a>
                                        <p class="picture_name">Террария за йо-йошника</p>
                                </div>
                        </div>
                        <div class="controls" id="controls1">
                                <button id="prevBtn1">&lt;</button>
                                <button id="nextBtn1">&gt;</button>
                        </div>
                        <div class="dots" id="dotsContainer1"></div>
                </div>

                <!-- Слайдер 2 -->
                <div class="slider2" id="slider2">
                        <p class="slider-title">Serega</p>
                        <div class="slides" id="slides2">
                                <div class="slide active"><a
                                                href="https://www.youtube.com/playlist?list=PLzZ7gRsUjR-TeJrucnF-1B92klkCbpPN0"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Первые алмазы ! Майнкрафт Начало.jpg" alt="Видео Майнкрафт Начало — Первые алмазы"></a>
                                        <p class="picture_name">Майнкрафт "Начало"</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLzZ7gRsUjR-SfGRwknOBLzg-18nTaDiRj"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Океанические приключения  в Майнкрафт.jpg" alt="Майнкрафт на острове — Океанические приключения"></a>
                                        <p class="picture_name">Майнкрафт на острове</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLzZ7gRsUjR-TyNFdchDxQYI_kyjD_1Th9"
                                                target="_blank"><img src="../Images/Sliders/Майнкрафт 1.17.jpeg" alt="Обзоры обновлений игры Майнкрафт"></a>
                                        <p class="picture_name">Обзоры обновлений Майнкрафт</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLzZ7gRsUjR-SWcF-ZSkIcJIc9FBY5LZUl"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Банан ! растения против Зомби 2.jpg" alt="Прохождение игры Растения против Зомби 2"></a>
                                        <p class="picture_name">Растения против Зомби</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLzZ7gRsUjR-RLt1Vonr1e7NGbFK975LvC"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Карточки Покемон сколько заработал.jpg" alt="Обзор коллекции Карточки Покемон"></a>
                                        <p class="picture_name">Карточки Покемон</p>
                                </div>
                        </div>
                        <div class="controls" id="controls2">
                                <button id="prevBtn2">&lt;</button>
                                <button id="nextBtn2">&gt;</button>
                        </div>
                        <div class="dots" id="dotsContainer2"></div>
                </div>

                <!-- Слайдер 3 -->
                <div class="slider3" id="slider3">
                        <p class="slider-title">Skotobazina</p>
                        <div class="slides" id="slides3">
                                <div class="slide active"><a
                                                href="https://www.youtube.com/playlist?list=PLTECYQ5EoWN01g3oii0w4xftBhU4doMZB"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Hytale forest biome showcase.jpg" alt="Обзор игры Hytale forest biome showcase"></a>
                                        <p class="picture_name">Hytale</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLTECYQ5EoWN1NGumkLjwMpuUFp9YvK0ZW"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Sylvanus is a carry in this meta Smite conquest gameplay.jpg" alt="Геймплей Smite conquest gameplay"></a>
                                        <p class="picture_name">Smite</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLTECYQ5EoWN0QN3zKLU1pSt3Lpp8zcMRH"
                                                target="_blank"><img
                                                        src="../Images/Sliders/Deadlock all heroes and abilities.jpg" alt="Обзор всех героев Deadlock all heroes and abilities"></a>
                                        <p class="picture_name">Deadlock</p>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/playlist?list=PLTECYQ5EoWN1Ntj2_zVnUefdwlZC2b_ec"
                                                target="_blank"><img src="../Images/Sliders/Smite 2.jpg" alt="Обзор игрового процесса Smite 2"></a>
                                        <p class="picture_name">Smite 2</p>
                                </div>
                        </div>
                        <div class="controls" id="controls3">
                                <button id="prevBtn3">&lt;</button>
                                <button id="nextBtn3">&gt;</button>
                        </div>
                        <div class="dots" id="dotsContainer3"></div>
                </div>

                <!-- Слайдер 4 -->
                <div class="slider4" id="slider4">
                        <h1>Хайлайты GGGAME</h1>
                        <div class="slides" id="slides4">
                                <div class="slide active"><a
                                                href="https://www.youtube.com/watch?v=flcU3zRoKrk"
                                                target="_blank"><img
                                                        src="../Images/Sliders/i (4).webp"></a>
                                        <h2 class="picture_name">GGGAME смотрит</h2>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/watch?v=Ii3FOBoETRg"
                                                target="_blank"><img
                                                        src="../Images/Sliders/i (5).webp"></a>
                                        <h2 class="picture_name">Террария Хардкор</h2>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/watch?v=XYufLnI38rU"
                                                target="_blank"><img
                                                        src="../Images/Sliders/i (6).webp"></a>
                                        <h2 class="picture_name">Бесконечная Террария</h2>
                                </div>
                                <div class="slide"><a
                                                href="https://www.youtube.com/watch?v=YZ65XowF1AQ"
                                                target="_blank"><img src="../Images/Sliders/i (7).webp"></a>
                                        <h2 class="picture_name">GGGAME разговаривает</h2>
                                </div>
                        </div>
                        <div class="controls" id="controls4">
                                <button id="prevBtn4">
                                        <<button id="nextBtn4">>
                                </button>
                        </div>
                        <div class="dots" id="dotsContainer4"></div>
                </div>
        </div>

        <?php require('Footer.php'); ?>
</body>
<script src="../Java Script/Playthroughs.js"></script>

</html>