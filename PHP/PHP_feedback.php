<?php
require('../PHP/PHP_DataBase.php'); 
session_start();

// Создание процесса сохранения комментария и данных пользователя
if (isset($_POST['button_feedback'])) { // Обозначаем, что все, что внутри, будет работать при нажатии на кнопку с name "button_feedback" (в файле Feedback.php)
    // Объявляем переменные для вывода ошибок в самом начале, чтобы в дальнейшем не было проблем из условий
    $message_feedback_success = "";
    $message_feedback_fail = "";

    // ID не считывается с поля ввода, так как поля ввода нет. Считывание происходит из сессии    
    $user_id = $_SESSION['id']; 
    // Задаем переменные для поля ввода и "связываем" его с name поля в html  
    $rating = htmlspecialchars($_POST['rating']);
    $text = htmlspecialchars($_POST['text']);
    $date = htmlspecialchars($_POST['date']);

    // Если без сессии авторизации - проверка, есть ли такой логин и электронная почта в таблицы зарегистрированных пользователей
    // $sql0 = "SELECT login, email FROM Users WHERE login ='$name' AND email ='$email'";
    // $result0 = mysqli_query($connection, $sql0);
    // $row = mysqli_fetch_assoc($result0);
    // if ($row['login'] === $name && $row['email'] === $email) {
        // Записываем данные созданных переменных (данные из полей) в соответствующее поля подключенной таблицы БД     
        $sql = "INSERT INTO Feedback (user_id, rating, text, date) VALUES ($user_id, $rating, '$text', '$date')"; // Определяем поле и переменную
        $sql1 = $connection->prepare($sql);
        if ($sql1->execute()) {
            $message_feedback_success = "Ваш отзыв добавлен" . "<br>";
        } else {
            $message_feedback_fail = "Проблемы с подключением" . $sql1->error;
        }
    // } else {
    //     $reg1 = "Ваш логин и почта не найдены в базе зарегистрированных пользователей." . "<br>" .
    //     "Зарегистрируйтесь, чтобы оставить комментарий" . "<br>";
    // }
}



// Публикуем все комментарии, хранящиеся в таблице "feedback", на странице. Для этого создаем функцию и потом вызываем ее в HTMl 
function feedback_publish()
{
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    // Сортировка данных из таблицы Feedback совмещенной с таблице Users по убыванию
    $sql = "SELECT Feedback.rating, Feedback.text, Feedback.date, Users.login, Users.avatar FROM Feedback INNER JOIN Users ON Feedback.user_id = Users.id ORDER BY Feedback.date DESC";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        // Цикл вывода данных
        while ($row = mysqli_fetch_assoc($result)) {            
            echo "<strong>" . "Никнейм: " . "</strong>" . htmlspecialchars($row['login']) . "<br>";

            echo '<strong> Аватарка: </strong>';
            echo '<img src="' . htmlspecialchars($row['avatar']) . '"style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;" alt="Аватар">' . "<br>";
            
            echo "<strong>" . "Оценка: " . "</strong>" . (int) $row['rating'] . "/10" . "<br>";
            echo "<strong>" . "Начало просмотра: " . "</strong>" . $row['date'] . "<br>";
            echo "<strong>" . "Комментарий: " . "</strong>" . (htmlspecialchars($row['text']));
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одного комментария от другого
        }
    }
}
?>
