<?php
require('../PHP/PHP_DataBase.php'); 
session_start();

if (isset($_POST['button_score'])) { // Обозначаем, что все, что внутри, будет работать при нажатии на кнопку с name "button_score"
    // Объявляем переменные для вывода ошибок в самом начале, чтобы в дальнейшем не было проблем из условий
    $message_score_success = "";
    $message_score_fail = ""; 

    // ID не считывается с поля ввода, так как поля ввода нет. Считывание происходит из сессии    
    $user_id = $_SESSION['id']; 
    // Задаем переменную для поля ввода и "связываем" его с name поля в html
    $score = htmlspecialchars($_POST['score']);

    // Проверяем, есть ли результат данного пользователя в таблице
    $check_sql = "SELECT score FROM Leaderboard WHERE user_id = $user_id";
    $check_result = mysqli_query($connection, $check_sql);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        // Если есть, получаем его текущий максимальный счет
        $row = mysqli_fetch_assoc($check_result);
        $old_score = $row['score'];

        // Если новый результат больше старого, обновляем его
        if ($score > $old_score) {
            $sql = "UPDATE Leaderboard SET score = $score WHERE user_id = $user_id";
            $sql1 = $connection->prepare($sql);

            if ($sql1) {
                if ($sql1->execute()) {
                    $message_score_success = "Вы улучшили свой рекорд" . "<br>";
                } else {
                    $message_score_fail = "Проблемы с сохранением: " . $sql1->error;
                }
                $sql1->close();
            }
        } else {
            // Если новый результат меньше или равен старому, выводим сообщение без обновления БД
            $message_score_fail = "Вы не побили свой рекорд" . "<br>";
        }
    } else {
        // Для первого результата пользователя
        // Записываем данные созданных переменных (данные из полей) в соответствующее поля подключенной таблицы БД   
        $sql = "INSERT INTO Leaderboard (user_id, score) VALUES ($user_id, $score)";
        $sql1 = $connection->prepare($sql);

        if ($sql1) {
            if ($sql1->execute()) {
                $message_score_success = "Ваш результат записан" . "<br>";
            } else {
                $message_score_fail = "Проблемы с сохранением: " . $sql1->error;
            }
            $sql1->close();
        }
    }
}


// Публикуем топ-10 записей (результатов), хранящихся в таблице "Leaderboard", на странице. Для этого создаем функцию и потом вызываем ее в HTMl 
function score_publish()
{
    // Переменная connection уже была инициализирована раннее, но внутри функции ее не видно, поэтому надо дописать global
    global $connection;

    // Сортировка данных из таблицы feedback под убыванию дат комментариев
    $sql = "SELECT Leaderboard.score, Users.login, Users.avatar FROM Leaderboard INNER JOIN Users ON Leaderboard.user_id = Users.id ORDER BY score DESC LIMIT 15;";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $place = 1; // Начинаем с первого места
        
        while ($row = mysqli_fetch_assoc($result)) {
            $badge = '';
            if ($place == 1) {
                $medal = '<img src="../Images/Clicker/Moon_Lord.gif" style="width: 30px; height: 30px;">' . "<strong>" . "1 место" . "</strong>";
            } elseif ($place == 2) {
                $medal = '<img src="../Images/Clicker/Lunatic_Cultist.gif" style="width: 20x; height: 30px;">' . "<strong>" . "2 место" . "</strong>";
            } elseif ($place == 3) {
                $medal = '<img src="../Images/Clicker/Betsy.gif" style="width: 30px; height: 30px;">' . "<strong>" . "2 место" . "</strong>";
            } else {
                $medal = "<strong>" . "$place" . "</strong>" . "<strong>" . " место" . "</strong>"; // Для остальных мест просто выводим номер
            }

            // Вывод места результата пользователя в таблице рекордов
            echo $medal . "<br>";           

            // Вывод результата и никнейма пользователя
            echo "<strong>" . "Результат: " . "</strong>" . (int) $row['score'] . "<br>";
            echo "<strong>" . "Никнейм: " . "</strong>" . htmlspecialchars($row['login']) . "<br>";
            // Вывод картинки профиля пользователя
            echo '<strong> Аватарка: </strong>';
            echo '<img src="' . htmlspecialchars($row['avatar']) . '"style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;" alt="Аватар">' . "<br>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одного результата от другого

            $place++; // Прохордим все места в рамках 15 выводимых записей. Первый три получают отметки, как указано в цикле
        }
    }
}
?>