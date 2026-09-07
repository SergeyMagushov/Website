<?php
require('../PHP/PHP_DataBase.php'); 
session_start(); // Запуск сессии при авторизации

// Объявляем переменные для вывода ошибок в самом начале, чтобы в дальнейшем не было проблем из условий
$message_account_fail = "";


// Выводим информацию из таблицы отзывов
function feedback_info()
{
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user_id = $_SESSION['id'];
    // Сортировка данных из таблицы Feedback по убыванию. Добавлено условие WHERE для выборки только текущего пользователя. Выбираем также id для удаления.
    $sql = "SELECT id, user_id, rating, text FROM Feedback WHERE user_id = $user_id ORDER BY date DESC";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Начало контейнера для строки отзыва с кнопкой удаления по правому краю
            echo "<div class='comment-row-container'>";
            
            // Левый блок с текстом отзыва
            echo "<div class='comment-text-block'>";
            echo "<strong>" . "Оценка: " . "</strong>" . (int) $row['rating'] . "/10" . "<br>";
            echo "<strong>" . "Комментарий: " . "</strong>" . htmlspecialchars($row['text']);
            echo "</div>";
            
            // Правый блок с формой отправки id комментария для удаления выбранной строки
            echo "<form action='' method='POST' class='delete-comment-form'>";
            echo "<input type='hidden' name='delete_comment_id' value='" . $row['id'] . "'>";
            echo "<input type='submit' name='delete_comment_btn' value='Удалить'>";
            echo "</form>";

            echo "</div>"; // Конец контейнера для строки отзыва
            
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой
        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}


// Удаляем необходимый комментарий из таблицы отзывов
if (isset($_POST['delete_comment_btn']) && isset($_POST['delete_comment_id'])) {
    global $connection;
    $delete_id = (int)$_POST['delete_comment_id'];
    $user_id = $_SESSION['id'];

    // Удаление комментария из таблицы Feedback по его id и id текущего пользователя
    $sql_delete = "DELETE FROM Feedback WHERE id = $delete_id AND user_id = $user_id";
    mysqli_query($connection, $sql_delete); 
    
    // Сохраняем сообщение в сессию, чтобы оно не удалилось при перезагрузке
    $_SESSION['message_feedback_delete'] = "Комментарий удален";

    // Перезагрузка страницы для обновления списка комментариев
    header("Location: ../HTML/Account.php");
        
    exit();
}


// Выводим информацию из таблицы рекордов
function clicker_info()
{
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user_id = $_SESSION['id'];
    // Сортировка данных из таблицы Leaderboard по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT user_id, score FROM Leaderboard WHERE user_id = $user_id";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<strong>" . "Результат: " . "</strong>" . (int) $row['score'] . "<br>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной стркои от другой
        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}

// Выводим информацию из таблицы пользователей
function auth_info()
{
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user = $_SESSION['login']; // Так как в этом модуле выводятся только данные из таблицы пользователей, то можно использовать login
    // Сортировка данных из таблицы Users по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT login, password, email, time, avatar FROM Users WHERE login = '$user'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Делаем вывод логина скрытым
            echo "<strong>" . "Логин: " . "</strong>";
            echo "<details style='display: inline-block; cursor: pointer;'>";
            echo "<summary style='color: solid grey; text-decoration: none; font-size: 0.9em;'>Показать логин</summary>";
            echo "<strong>" . "Логин: " . "</strong>" . htmlspecialchars($row['login']);
            echo "</details>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой

            // Делаем вывод пароля скрытым
            echo "<strong>" . "Пароль: " . "</strong>";
            echo "<details style='display: inline-block; cursor: pointer;'>";
            echo "<summary style='color: solid grey; text-decoration: none; font-size: 0.9em;'>Показать пароль</summary>";
            echo "<span style='background: #eee; border-radius: 3px;'>" . (int) $row['password'] . "</span>";
            echo "</details>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой

            // Делаем вывод электронной почты скрытым
            echo "<strong>" . "E-mail: " . "</strong>";
            echo "<details style='display: inline-block; cursor: pointer;'>";
            echo "<summary style='color: solid grey; text-decoration: none; font-size: 0.9em;'>Показать E-mail</summary>";
            echo "<span style='background: #eee; border-radius: 3px;'>" . htmlspecialchars($row['email']);
            echo "</details>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой

            // Делаем вывод времени, проведенного на сайте
            $time = round((int) $row['time'] / 60); // Записываем в переменную время в минутах и округляем до 0 знаков после запятой
            echo "<strong>" . "Время на сайте: " . "</strong>";
            // Если больше или равно 60 минут - это уже час и больше, выводим отдельно и часы, и минуты. Если меньше выводим минуты из переменной $time
            if ($time >= 60) {
                $hours = round($time / 60);
                $minutes = $time % 60; // Минуты считаются, как отсаток от деления. Например, всего 620 минут. Это 620 / 60 - остаток 20, это минуты
                echo $hours . " ч. " . $minutes . " мин.";
            } else {
                echo $time . " мин.";
            }
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой

            // Вывод картинки с правильным синтаксисом PHP
            echo '<strong>Аватарка: </strong>';
            echo '<img src="' . htmlspecialchars($row['avatar']) . '"style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" alt="Аватар">';
            echo '<hr>'; // вывод разделительной линии

        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}

    function top_users_info()
{
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user = $_SESSION['login'];
    // Сортировка данных из таблицы Login по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT login, time, avatar FROM Users ORDER BY time DESC LIMIT 15;";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $place = 1; // Начинаем с первого места

        while ($row = mysqli_fetch_assoc($result)) {
            
        $medal = '';
            if ($place == 1) {
                $medal = '<img src="../Images/Clicker/Moon_Lord.gif" style="width: 40px; height: 40px;">' . "<strong>" . "1 место" . "</strong>";
            } elseif ($place == 2) {
                $medal = '<img src="../Images/Clicker/Lunatic_Cultist.gif" style="width: 25x; height: 38px;">' . "<strong>" . "2 место" . "</strong>";
            } elseif ($place == 3) {
                $medal = '<img src="../Images/Clicker/Empress_of_Light.gif" style="width: 70px; height: 45px;">' . "<strong>" . "3 место" . "</strong>";
            } elseif ($place == 4) {
                $medal = '<img src="../Images/Clicker/Duke_Fishron_(Second_Form).gif" style="width: 50px; height: 40px;">' . "<strong>" . "4 место" . "</strong>";
            } elseif ($place == 5) {
                $medal = '<img src="../Images/Clicker/Golem.webp" style="width: 38px; height: 42px;">' . "<strong>" . "5 место" . "</strong>";
            } elseif ($place == 6) {
                $medal = '<img src="../Images/Clicker/Plantera_(Second_form).gif" style="width: 35px; height: 46px;">' . "<strong>" . "6 место" . "</strong>";
            } elseif ($place == 7) {
                $medal = '<img src="../Images/Clicker/160px-Twins_(second_form).gif" style="width: 45px; height: 59px;">' . "<strong>" . "7 место" . "</strong>";
            } elseif ($place == 8) {
                $medal = '<img src="../Images/Clicker/279px-Queen_Slime_(Second_form).webp" style="width: 60px; height: 30px;">' . "<strong>" . "8 место" . "</strong>";
            } elseif ($place == 9) {
                $medal = '<img src="../Images/Clicker/Wall_of_Flesh.gif" style="width: 30px; height: 70px;">' . "<strong>" . "9 место" . "</strong>";
            } elseif ($place == 10) {
                $medal = '<img src="../Images/Clicker/Skeletron_Head.png" style="width: 32px; height: 40px;">' . "<strong>" . "10 место" . "</strong>";
            } elseif ($place == 11) {
                $medal = '<img src="../Images/Clicker/Deerclops.gif" style="width: 33px; height: 55px;">' . "<strong>" . "11 место" . "</strong>";
            } elseif ($place == 12) {
                $medal = '<img src="../Images/Clicker/Queen_Bee.gif" style="width: 55px; height: 44px;">' . "<strong>" . "12 место" . "</strong>";
            } elseif ($place == 13) {
                $medal = '<img src="../Images/Clicker/Brain_of_Cthulhu_(Second_Phase).gif" style="width: 40px; height: 40px;">' . "<strong>" . "13 место" . "</strong>";
            } elseif ($place == 14) {
                $medal = '<img src="../Images/Clicker/Eye_of_Cthulhu_(Phase_2).gif" style="width: 30px; height: 40px;">' . "<strong>" . "14 место" . "</strong>";
            } else {
                $medal = '<img src="../Images/Clicker/King_Slime.gif" style="width: 30px; height: 30px;">' . "<strong>" . "15 место" . "</strong>";
            }

            // Вывод места результата пользователя в таблице рекордов
            echo $medal . "<br>";  
            $place++; // Прохордим все места в рамках 15 выводимых записей. Первый три получают отметки, как указано в цикле
        
            // Вывод логина
            echo "<strong>" . "Логин: " . "</strong>" . htmlspecialchars($row['login']) . "<br>";
            
            // Вывод картинки
            echo '<strong> Аватарка: </strong>';
            echo '<img src="' . htmlspecialchars($row['avatar']) . '"style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;" alt="Аватар">' . "<br>";
           
            // Делаем вывод времени, проведенного на сайте
            $time = round((int) $row['time'] / 60); // Записываем в переменную время в минутах и округляем до 0 знаков после запятой
            echo "<strong>" . "Время на сайте: " . "</strong>";
            // Если больше или равно 60 минут - это уже час и больше, выводим отдельно и часы, и минуты. Если меньше выводим минуты из переменной $time
            if ($time >= 60) {
                $hours = round($time / 60);
                $minutes = $time % 60; // Минуты считаются, как отсаток от деления. Например, всего 620 минут. Это 620 / 60 - остаток 20, это минуты
                echo $hours . " ч. " . $minutes . " мин.";
            } else {
                echo $time . " мин.";
            }
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой
        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}
?>