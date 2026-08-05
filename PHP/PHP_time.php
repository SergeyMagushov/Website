<?php
require('../PHP/PHP_DataBase.php'); 
session_start();

// Код подсчета времени
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $current_time = time();

    if (isset($_SESSION['last_activity'])) {
        $seconds_passed = $current_time - $_SESSION['last_activity'];

        if ($seconds_passed > 0) {
            $sql_update = "UPDATE Users SET time = time + '$seconds_passed' WHERE login = '$user'";            
            mysqli_query($connection, $sql_update);
        }
    }
    $_SESSION['last_activity'] = $current_time;
}
?>
