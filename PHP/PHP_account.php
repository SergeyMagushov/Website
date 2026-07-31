<?php
session_start(); // Запуск сессии при авторизации

// Подключение базы данных
$servername = "localhost"; // Название сервера - в рассматриваемом случае можно использовать localhost или ввести ip адрес
$username = "root";        // Имя пользователя (в рассматриваемом случае - root)
$password = "";            // Пароль - в рассматриваемом случа пароль не используется
$dbname = "Authorisation"; // название базы данных
// Создаем соединение
$connection = mysqli_connect($servername, $username, $password, $dbname);
// Проверяем соединение
if (!$connection) {
    die("Подключение не удалось: " . mysqli_connect_error());
}
// echo "Подключение успешно осуществлено" . "<br>";
// Закрытие соединения можно не прописыать, так как оно существляется автоматически

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
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<strong>" . "Логин: " . "</strong>" . htmlspecialchars($row['login']) . "<br>";
            
            // Вывод картинки с правильным синтаксисом PHP
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