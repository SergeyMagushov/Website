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
            $sql1 = mysqli_query($connection, $sql);

            if ($sql1) {
                $message_score_success = "Вы улучшили свой рекорд" . "<br>";
            } else {
                // Для процедурного стиля ошибку получаем через mysqli_error($connection)
                $message_score_fail = "Проблемы с сохранением: " . mysqli_error($connection);
            }
        } else {
            // Если новый результат меньше или равен старому, выводим сообщение без обновления БД
            $message_score_fail = "Вы не побили свой рекорд" . "<br>";
        }
    } else {
        // Для первого результата пользователя
        // Записываем данные созданных переменных (данные из полей) в соответствующее поля подключенной таблицы БД   
        $sql = "INSERT INTO Leaderboard (user_id, score) VALUES ($user_id, $score)";
        $sql1 = mysqli_query($connection, $sql);

        if ($sql1) {
            $message_score_success = "Ваш результат записан" . "<br>";
        } else {
            $message_score_fail = "Проблемы с сохранением: " . mysqli_error($connection);
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
            $medal = '';
            if ($place == 1) {
                $medal = '<img src="../Images/Clicker/Moon_Lord.gif" style="width: 40px; height: 40px;">' . "<strong>" . "1 место" . "</strong>";
            } elseif ($place == 2) {
                $medal = '<img src="../Images/Clicker/Lunatic_Cultist.gif" style="width: 25x; height: 38px;">' . "<strong>" . "2 место" . "</strong>";
            } elseif ($place == 3) {
                $medal = '<img src="../Images/Clicker/Empress_of_Light.gif" style="width: 70px; height: 45px;">' . "<strong>" . "3 место" . "</strong>";
            } elseif ($place == 4) {
                $medal = '<img src="../Images/Clicker/Duke_Fishron_(Second_Form).gif" style="width: 50px; height: 40px;">' . "<strong>" . "4 место" . "</strong>";
            } elseif ($place == 5) {
                $medal = '<img src="../Images/Clicker/Golem.webp" style="width: 38px; height: 42px;">' . "<strong>" . "5 место" . "</strong>";
            } elseif ($place == 6) {
                $medal = '<img src="../Images/Clicker/Plantera_(Second_form).gif" style="width: 35px; height: 46px;">' . "<strong>" . "6 место" . "</strong>";
            } elseif ($place == 7) {
                $medal = '<img src="../Images/Clicker/160px-Twins_(second_form).gif" style="width: 45px; height: 59px;">' . "<strong>" . "7 место" . "</strong>";
            } elseif ($place == 8) {
                $medal = '<img src="../Images/Clicker/279px-Queen_Slime_(Second_form).webp" style="width: 60px; height: 30px;">' . "<strong>" . "8 место" . "</strong>";
            } elseif ($place == 9) {
                $medal = '<img src="../Images/Clicker/Wall_of_Flesh.gif" style="width: 30px; height: 70px;">' . "<strong>" . "9 место" . "</strong>";
            } elseif ($place == 10) {
                $medal = '<img src="../Images/Clicker/Skeletron_Head.png" style="width: 32px; height: 40px;">' . "<strong>" . "10 место" . "</strong>";
            } elseif ($place == 11) {
                $medal = '<img src="../Images/Clicker/Deerclops.gif" style="width: 33px; height: 55px;">' . "<strong>" . "11 место" . "</strong>";
            } elseif ($place == 12) {
                $medal = '<img src="../Images/Clicker/Queen_Bee.gif" style="width: 55px; height: 44px;">' . "<strong>" . "12 место" . "</strong>";
            } elseif ($place == 13) {
                $medal = '<img src="../Images/Clicker/Brain_of_Cthulhu_(Second_Phase).gif" style="width: 40px; height: 40px;">' . "<strong>" . "13 место" . "</strong>";
            } elseif ($place == 14) {
                $medal = '<img src="../Images/Clicker/Eye_of_Cthulhu_(Phase_2).gif" style="width: 30px; height: 40px;">' . "<strong>" . "14 место" . "</strong>";
            } else {
                $medal = '<img src="../Images/Clicker/King_Slime.gif" style="width: 30px; height: 30px;">' . "<strong>" . "15 место" . "</strong>";
            }

            // Вывод места результата пользователя в таблице рекордов
            echo $medal . "<br>"; 
            $place++; // Прохордим все места в рамках 15 выводимых записей. Первый три получают отметки, как указано в цикле          

            // Вывод результата и никнейма пользователя           
            echo "<strong>" . "Никнейм: " . "</strong>" . htmlspecialchars($row['login']) . "<br>";
            // Вывод картинки профиля пользователя
            echo '<strong> Аватарка: </strong>';
            echo '<img src="' . htmlspecialchars($row['avatar']) . '"style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;" alt="Аватар">' . "<br>";
            echo "<strong>" . "Результат: " . "</strong>" . (int) $row['score'] . "<br>";
            echo "<hr>"; // вывод строки, представляющей прямую линию, для отделения одного результата от другого

            
        }
    }
}
?>