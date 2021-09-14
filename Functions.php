<?php
//ДОБАВЛЕНИЕ ДАННЫх

function addChampion($link){

    $sql = mysqli_query($link, "INSERT INTO `league` (`name`, `description`, `regions_id`, `role_id`, `price_id`, `typeDamage_Id`) VALUES ('{$_POST['name']}', '{$_POST['description']}', '{$_POST['regions']}', '{$_POST['role']}', '{$_POST['price']}', '{$_POST['typeDamage']}')");

    if ($sql) {

    } else {
        echo '<p>ERROR: ' . mysqli_error($link) . '</p>';
    }
}



//ВЫВОД ДАННЫХ на экран
function dataOut($link)
{
    Global $i;
    $sql = "    SELECT * 
      FROM `league`  
	    JOIN `price`
	     ON `league`.price_id = `price`.id
        JOIN `regions`
	     ON `league`.regions_id = `regions`.id
        JOIN `role`
	     ON `league`.role_id = `role`.id        
	     JOIN `typeDamage`
	     ON `league`.typeDamage_id = `typeDamage`.id
	     ORDER BY ind
	 "; //подготовка sql кода, выбираем всё из таблицы users
    $result = mysqli_query($link, $sql); // записываем в result данные из mysql
    if (!$link) {
        die("Ошибка: " . mysqli_connect_error());
    }
    echo "<table width='100%' border='1'>  <!--эхо выводит контейнер таблицы с шириной 100% и рамкой-->
<tr> <
<th> ID</th>
        <th> Имя персонажа</th>
        <th> Описание</th>
        <th> Регион</th>
        <th> Роль</th>       
        <th> Цена</th>
        <th> Тип урона</th>
        <th> Действия</th>
</tr>";
    while ($row = mysqli_fetch_array($result)) { // заполнение таблицы данными
        echo "<tr align='center'>";
        echo "<td >" . ++$i . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td >" . $row['description'] . "</td>";
        echo "<td >" . $row['regions'] . "</td>";
        echo "<td >" . $row['role'] . "</td>";
        echo "<td >" . $row['price'] . "</td>";
        echo "<td >" . $row['typeDamage'] . "</td>";
        echo "<td > 
 <!-- <input  type='button' class='add' name='add' value='Добавить' '> На эту кнопку назначить создание новой строки в бд-->
                <!--   <input  type='button' class='update' name='update' value='Редактировать' '> На эту кнопку назначить редактирование существующей строки в бд-->
               <input id=$i type='button' class='delete' name='delete' value='Удалить' onclick='$(this).closest(\"tr\").remove();'> <!--На эту кнопку назначить удаление строки в бд отправить в функицю удаления-->
               
          </td>";
        echo "</tr>";
    }
    echo "</table>";
}
