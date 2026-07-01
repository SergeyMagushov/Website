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
                        <li class="user-info"><a href="Account.php">Личный кабинет
                                (<strong><?php echo $_SESSION['login']; ?></strong>)</a></li>
                        <li><a href="../PHP/PHP_QuitAuth.php">Выйти</a></li>
                    <?php else: ?>
                        <li><a href="Auth.php">Авторизация</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- Отдельный пунк меню, который показывается, когда пользователь авторизовался -->
            <?php if (isset($_SESSION['login'])): ?>
                <div class="music-dropdown">
                    <a href="#" class="music-toggle" onclick="return false;">Музыка ▼</a>
                    <ul class="music-menu">
                        <!-- Встроенный аудиоплеер в начале списка -->
                        <li class="player-wrapper">
                            <div class="player-container">
                                <audio id="global-player" controls></audio>
                                <div id="current-track-title">Выберите трек</div>
                            </div>
                        </li>

                        <!-- Список треков -->
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Overworld_Day.mp3.mpeg">1. Overworld Day</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Eerie.mp3.mpeg">2. Eerie</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Overworld_Night.mp3.mpeg">3. Overworld Night</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Title_Screen.mp3.mpeg">4. Title Screen</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Underground.mp3.mpeg">5. Underground</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Boss_1.mp3.mpeg">6. Boss 1</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Jungle.mp3.mpeg">7. Jungle</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Corruption.mp3.mpeg">8. Corruption</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Underground_Corruption.mp3.mpeg">9. Underground Corruption</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-The_Hallow.mp3.mpeg">10. The Hallow</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Boss_2.mp3.mpeg">11. Boss 2</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Underground_Hallow.mp3.mpeg">12. Underground Hallow</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Boss_3.mp3.mpeg">13. Boss 3</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Snow.mp3.mpeg">14. Snow</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Space_Night.mp3.mpeg">15. Space Night</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Crimson.mp3.mpeg">16. Crimson</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Golem.mp3.mpeg">17. Golem</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Alternate_Day.mp3.mpeg">18. Alternate Day</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Rain.mp3.mpeg">19. Rain</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Ice_Biome.mp3.mpeg">20. Ice Biome</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Desert.mp3.mpeg">21. Desert</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Ocean_Day.mp3.mpeg">22. Ocean Day</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Dungeon.mp3.mpeg">23. Dungeon</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Plantera.mp3.mpeg">24. Plantera</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Boss_5.mp3.mpeg">25. Boss 5</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Lihzahrd.mp3.mpeg">26. Lihzahrd</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Ice_Underground.mp3.mpeg">27. Ice Underground</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/Music-Mushrooms.mp3.mpeg">28. Mushrooms</a></li>
                        <li><a href="#" class="track-link" data-src="../MP3/RainAmbience.mp3.mpeg">29. Rain Ambience</a></li>
                    </ul>
                </div>

            <?php endif; ?>

        </div>
    </header>

    <script src="../Java Script/MP3Player.js"></script>

</body>

</html>