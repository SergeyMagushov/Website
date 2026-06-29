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
                        <li><a href="track1.mp3">1. Overworld Day — 02:17</a></li>
                        <li><a href="track2.mp3">2. Eerie — 02:41</a></li>
                        <li><a href="track3.mp3">3. Overworld Night — 02:00</a></li>
                        <li><a href="track4.mp3">4. Title Screen — 01:19</a></li>
                        <li><a href="track5.mp3">5. Underground — 02:59</a></li>
                        <li><a href="track6.mp3">6. Boss 1 — 02:16</a></li>
                        <li><a href="track7.mp3">7. Jungle — 02:44</a></li>
                        <li><a href="track8.mp3">8. Corruption — 02:37</a></li>
                        <li><a href="track9.mp3">9. Underground Corruption — 02:22</a></li>
                        <li><a href="track10.mp3">10. The Hallow — 02:06</a></li>
                        <li><a href="track11.mp3">11. Boss 2 — 02:00</a></li>
                        <li><a href="track12.mp3">12. Underground Hallow — 02:55</a></li>
                        <li><a href="track13.mp3">13. Boss 3 — 01:50</a></li>
                        <li><a href="track14.mp3">14. Ocean — 01:28</a></li>
                        <li><a href="track15.mp3">15. Eclipse — 01:36</a></li>
                        <li><a href="track16.mp3">16. Rain — 01:36</a></li>
                        <li><a href="track17.mp3">17. Alternate Day — 01:40</a></li>
                        <li><a href="track18.mp3">18. Space — 01:35</a></li>
                        <li><a href="track19.mp3">19. Golem — 01:28</a></li>
                        <li><a href="track20.mp3">20. Mushrooms — 01:16</a></li>
                        <li><a href="track21.mp3">21. Crimson — 02:07</a></li>
                        <li><a href="track22.mp3">22. Lihzahrd — 01:37</a></li>
                        <li><a href="track23.mp3">23. Ice — 01:34</a></li>
                        <li><a href="track24.mp3">24. Plantera — 01:16</a></li>
                        <li><a href="track25.mp3">25. Dungeon — 01:40</a></li>
                        <li><a href="track26.mp3">26. Lunar Boss — 01:27</a></li>
                        <li><a href="track27.mp3">27. Alternate Underground — 01:12</a></li>
                        <li><a href="track28.mp3">28. Underground Crimson — 02:41</a></li>
                        <li><a href="track29.mp3">29. Goblin Army — 01:45</a></li>
                        <li><a href="track30.mp3">30. Underworld — 02:10</a></li>
                        <li><a href="track31.mp3">31. Pirate Invasion — 01:50</a></li>
                        <li><a href="track32.mp3">32. Pumpkin Moon — 01:26</a></li>
                        <li><a href="track33.mp3">33. Frost Moon — 01:08</a></li>
                        <li><a href="track34.mp3">34. Martian Madness — 01:41</a></li>
                        <li><a href="track35.mp3">35. Lunar Towers — 01:27</a></li>
                        <li><a href="track36.mp3">36. Moon Lord — 01:53</a></li>
                        <li><a href="track37.mp3">37. The Journey Begins — 01:23</a></li>
                        <li><a href="track38.mp3">38. Underground Ice — 01:24</a></li>
                        <li><a href="track39.mp3">39. Space Day — 01:23</a></li>
                        <li><a href="track40.mp3">40. Empress of Light — 02:48</a></li>
                        <li><a href="track41.mp3">41. Queen Slime — 01:29</a></li>
                        <li><a href="track42.mp3">42. Slime Rain — 01:22</a></li>
                        <li><a href="track43.mp3">43. Desert — 01:29</a></li>
                        <li><a href="track44.mp3">44. Underground Desert — 02:01</a></li>
                        <li><a href="track45.mp3">45. Sandstorm — 01:38</a></li>
                        <li><a href="track46.mp3">46. Old One's Army — 02:22</a></li>
                        <li><a href="track47.mp3">47. Underground Jungle — 01:48</a></li>
                        <li><a href="track48.mp3">48. Jungle Night — 01:35</a></li>
                        <li><a href="track49.mp3">49. Queen Bee — 01:27</a></li>
                        <li><a href="track50.mp3">50. Graveyard — 01:57</a></li>
                        <li><a href="track51.mp3">51. Town Day — 02:06</a></li>
                        <li><a href="track52.mp3">52. High Wind — 01:20</a></li>
                        <li><a href="track53.mp3">53. Storm — 01:35</a></li>
                        <li><a href="track54.mp3">54. Duke Fishron — 01:42</a></li>
                        <li><a href="track55.mp3">55. Morning Rain — 01:00</a></li>
                        <li><a href="track56.mp3">56. Ocean Night — 01:32</a></li>
                        <li><a href="track57.mp3">57. Town Night — 01:56</a></li>
                        <li><a href="track58.mp3">58. Alt Title — 01:35</a></li>
                        <li><a href="track59.mp3">59. Journey's End - Credits — 02:12</a></li>
                        <li><a href="track60.mp3">60. Terraria Day Theme Remix (Xenon/DSniper)</a></li>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    </header>

</body>

</html>