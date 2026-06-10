<?php
session_start();
session_unset(); // Удаляет все переменные сессии
session_destroy(); // Уничтожает саму сессию

//Отдельная сессия для вывода оповещения о выходе из личного кабинета
session_start(); 
$_SESSION['message_auth_quit'] = "Вы вышли из личного кабинета";

// Перенаправляем пользователя на страницу авторизации
header("Location: http://localhost/Проект%20(сайт)/HTML/Auth.php");
exit();
?>
