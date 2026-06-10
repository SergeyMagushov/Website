<?php
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


// Создание логики процесса регистрации пользователя
if (isset($_POST['button_reg'])) { // Обозначаем, что все, что внутри, будет работать при нажатии на кнопку с id "button_reg"
    // Задаем переменные для полей ввода логина, пароля и email и "связываем" их с id полей в html    
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $password1 = htmlspecialchars($_POST['password1']);
    $email = htmlspecialchars($_POST['email']);

    // Считываем логин из таблицы базы данных для проверки, не занят ли логин, который вводит пользователь
    $sql0 = "SELECT login FROM Users WHERE login='$login'";
    $result = mysqli_query($connection, $sql0);
    $row = mysqli_fetch_assoc($result);

    // проверка на то, не пустые ли поля логина, пароля и email, а также - не занят ли логин, который вводит пользователь
    if (!empty($login) && !empty($password) && !empty($email) && $row['login'] !== $login) {
        // Проверка, совпадает ли пароль и проверочный пароль
        if ($password === $password1) {
            // Записываем данные созданных переменных (логин, пароль, Email) в соответствующие поля подключенной таблицы БД)     
            $sql = "INSERT INTO `Users` (`login`, `password`, `email`) VALUES ('$login', '$password', '$email')"; // Определяем поля и переменные
            $sql1 = $connection->prepare($sql);
            if ($sql1->execute()) {
                $_SESSION['message_register_success'] = "Вы зарегистрированы" . "<br>";
                header("Location: http://localhost/Проект%20(сайт)/HTML/Auth.php");
            } else {
                $message_register_fail_connection = "Ошибка регистрации: " . $sql1->error;
            }
        } else {
            $message_register_fail_passwords = "Первый и второй пароли не совпадают";
        }
    } else {
        $message_register_fail_login = "Такой логин уже занят";
    }
}
?>