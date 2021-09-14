<?php
require 'Functions.php';
$host = 'localhost';  // Хост
$user = 'root';    // Имя пользователя
$pass = ''; // пароль
$db_name = 't91948tj_magic';   // Имя бД
$link = mysqli_connect($host, $user, $pass, $db_name);

$i=0;
deleteRow($link, $i);
addChampion($link);
dataOut($link);

//УДАЛЕНИЕ ДАННЫХ
//('button.delete').on('click', deleteRow($link,$i));

function deleteRow($link,$i)
{
echo $_POST['name'];
    $sql = mysqli_query($link, "DELETE FROM `league`
WHERE `name` = {$_POST['name']}");

    if ($sql) {

    } else {
        echo '<p>ERROR: ' . mysqli_error($link) . '</p>';
    }
}


mysqli_close($link); // закрытие соединения с базой данных