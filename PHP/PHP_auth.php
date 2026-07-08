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


// Создание логики процесса авторизации пользователя при нажатии на кнопку авторизации с name 'button_auth' (в файле Auth.php)
if (isset($_POST['button_auth'])) {    
    // Объявляем переменную для вывода ошибки в самом начале, чтобы в дальнейшем не было проблем из условий
    $message_auth_fail = ""; 
    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $avatar = $_POST['avatar']; // создаем переменную для дальнейшей записи данных о картинке в сессию и вывод ее в Header
    // SQL запрос для провперки логина и пароли с таблице Users
    $sql = "SELECT login, password, avatar FROM Users WHERE login='$login' AND password='$password'";
    $result = mysqli_query($connection, $sql);
    // Если есть совпаденгия
    if (mysqli_num_rows($result) === 1) {
        // Вместо $reg0 = "Вы авторизованы";
        $_SESSION['message_auth_success'] = "Вы авторизованы"; // Создаем текст оповещения, который выводится при авторизации на странице feedback
        // необходимо сделать через Session, так как таким образом происходит длительность у текста оповещения. Просто через $reg0 удалится почти сразу
        $row = mysqli_fetch_assoc($result);
        // if ($row['login'] === $login && $row['password'] === $password) {
        // $_SESSION['user_id'] = $row['id'];
        $_SESSION['login'] = $row['login'];
        $_SESSION['avatar'] = $row['avatar']; // запись данных о картинке в сессию и дальнейший вывод ее в Header
        header("Location: ../HTML/Feedback.php"); // Перенаправление на нужную страницу при авторизации
        exit();
        // }
    } else {
        $message_auth_fail = "Неправильный логин или пароль";
    }
}
?>