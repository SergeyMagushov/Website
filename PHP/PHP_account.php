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


// Выводим информацию из таблиц базы данных, которая есть о пользователе для наполнения личного кабинета информацией
function feedback_info()
{    
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    $user = $_SESSION['login'];
    // Сортировка данных из таблицы feedback по убыванию. Добавлено условие WHERE для выборки только текущего пользователя.
    $sql = "SELECT name, rating, text, date FROM Feedback WHERE name = '$user' ORDER BY date DESC";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<strong>" . "Оценка: " . "</strong>" . (int) $row['rating'] . "/10" . "<br>";
            echo "<strong>" . "Начало просмотра: " . "</strong>" . htmlspecialchars($row['date']) . "<br>";
            echo "<strong>" . "Комментарий: " . "</strong>" . htmlspecialchars($row['text']);
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одного комментария от другого
        }
    } else {
        $message_account_fail = "Ошибка соединения" . "<br>";
    }
}
