<?php
require('../PHP/PHP_DataBase.php'); 

// Создание логики процесса регистрации пользователя
if (isset($_POST['button_reg'])) { // Обозначаем, что все, что внутри, будет работать при нажатии на кнопку с id "button_reg"
    // Объявляем переменные для вывода ошибок в самом начале, чтобы в дальнейшем не было проблем из условий
    $message_register_fail_connection = "";
    $message_register_fail_passwords = "";
    $message_register_fail_login = "";

    // Задаем переменные для полей ввода логина, пароля и email и "связываем" их с id полей в html    
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $password1 = htmlspecialchars($_POST['password1']);
    $email = htmlspecialchars($_POST['email']);

    // Путь к картинке, которая будет использоваться, если пользователь при регистрации не выбрал фото
    $avatar = "../Images/Avatars/Default.png";

    // Проверяем, был ли загружен файл через форму и нет ли ошибок загрузки
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {

        $target_dir = "../Images/Avatars/"; // Папка на сервере, куда будут сохраняться картинки   
        $file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION); // Получаем расширение загружаемого файла (например: png, jpg) 
        $file_name = $login . "_" . time() . "." . $file_extension; // Уникальное имя файла с логином и текущем временем         
        $target_file = $target_dir . $file_name; // Путь к файлу, записывающийся в базу данных - состоит из папки, где хранятся файлы и названия файла

        // Помещение файла в папку для храрения картинок пользователей
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $avatar = $target_file; // Если перенос прошел успешно, обновляем переменную пути для базы данных
        }
    }

    // Считываем логин из таблицы базы данных для проверки, не занят ли логин, который вводит пользователь
    $sql0 = "SELECT login FROM Users WHERE login='$login'";
    $result = mysqli_query($connection, $sql0);
    $row = mysqli_fetch_assoc($result);

    // проверка на то, не пустые ли поля логина, пароля и email, а также - не занят ли логин, который вводит пользователь
    if (!empty($login) && !empty($password) && !empty($password1) && !empty($email) && $row['login'] !== $login) {
        // Проверка, совпадает ли пароль и проверочный пароль
        if ($password === $password1) {
            // Записываем данные созданных переменных (логин, пароль, Email) в соответствующие поля подключенной таблицы БД)     
            $sql = "INSERT INTO `Users` (`login`, `password`, `email`, `avatar`) VALUES ('$login', '$password', '$email', '$avatar')"; // Определяем поля и переменные
            $sql1 = $connection->prepare($sql);
            if ($sql1->execute()) {
                $_SESSION['message_register_success'] = "Вы зарегистрированы" . "<br>";
                header("Location: ../HTML/Auth.php");
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