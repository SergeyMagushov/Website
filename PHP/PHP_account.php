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

    $user = $_SESSION['login'];
    // Сортировка данных из таблицы feedback по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT name, rating, text FROM Feedback WHERE name = '$user' ORDER BY date DESC";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<strong>" . "Оценка: " . "</strong>" . (int) $row['rating'] . "/10" . "<br>";
            echo "<strong>" . "Комментарий: " . "</strong>" . htmlspecialchars($row['text']);
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой
        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}

// Выводим информацию из таблицы рекордов
function clicker_info()
{    
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user = $_SESSION['login'];
    // Сортировка данных из таблицы feedback по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT player, score FROM Leaderboard WHERE player = '$user'";
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

// Выводим информацию из таблицы рекордов
function auth_info()
{    
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user = $_SESSION['login'];
    // Сортировка данных из таблицы feedback по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT login, password, email FROM Users WHERE login = '$user'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Делаем вывод пароля скрытым
            echo "<strong>" . "Логин: " . "</strong>";            
            echo "<details style='display: inline-block; cursor: pointer;'>";
            echo "<summary style='color: solid grey; text-decoration: none; font-size: 0.9em;'>Показать логин</summary>";
            echo "<strong>" . "Логин: " . "</strong>" . htmlspecialchars($row['login']) . "<br>";
            echo "</details><br>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой
            
            // Делаем вывод пароля скрытым
            echo "<strong>" . "Пароль: " . "</strong>";            
            echo "<details style='display: inline-block; cursor: pointer;'>";
            echo "<summary style='color: solid grey; text-decoration: none; font-size: 0.9em;'>Показать пароль</summary>";
            echo "<span style='background: #eee; border-radius: 3px;'>" . (int) $row['password'] . "</span>";
            echo "</details><br>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой
            
            // Делаем вывод пароля скрытым
            echo "<strong>" . "E-mail: " . "</strong>";
            echo "<details style='display: inline-block; cursor: pointer;'>";
            echo "<summary style='color: solid grey; text-decoration: none; font-size: 0.9em;'>Показать E-mail</summary>";
            echo "<span style='background: #eee; border-radius: 3px;'>" . htmlspecialchars($row['email']);
            echo "</details><br>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одной строки от другой
        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}