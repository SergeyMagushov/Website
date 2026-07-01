<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Authorisation";

$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die("Подключение не удалось: " . mysqli_connect_error());
}

// Код подсчета времени (работает для любой страницы, где подключен этот файл)
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $current_time = time();

    if (isset($_SESSION['last_activity'])) {
        $seconds_passed = $current_time - $_SESSION['last_activity'];        
        if ($seconds_passed > 0) {
            $sql_update = "UPDATE Users SET total_time = total_time + ? WHERE login = ?";
            $stmt_update = mysqli_prepare($connection, $sql_update);
            if ($stmt_update) {
                mysqli_stmt_bind_param($stmt_update, "is", $seconds_passed, $user);
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);
            }
        }
    }
    $_SESSION['last_activity'] = $current_time;
}
?>
