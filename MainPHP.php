<?php
echo "sda";
//Считываем данные из базы данных

$con = mysqli_connect('localhost','root','','t91948ti_magic'); // соединение с базой данных
$sql="    SELECT * 
      FROM `league`  
	    JOIN `price`
	     ON `league`.price_id = `price`.id
        JOIN `regions`
	     ON `league`.regions_id = `regions`.id
        JOIN `role`
	     ON `league`.role_id = `role`.id        
	     JOIN `typeDamage`
	     ON `league`.typeDamage_id = `typeDamage`.id
	 "; //подготовка sql кода, выбираем всё из таблицы users
$result = mysqli_query($con,$sql); // записываем в result данные из mysql
if (!$con) {
    die("Ошибка: " . mysqli_connect_error());
}
echo "<table width='100%' border='1'>  <!--эхо выводит контейнер таблицы с шириной 100% и рамкой-->
<tr> <!--контейнер для создания таблицы-->
<th> ID</th>
        <th> Имя персонажа</th>
        <th> Описание</th>
        <th> Регион</th>
        <th> Роль</th>       
        <th> Цена</th>
        <th> Тип урона</th>
</tr>";  //<!--закрытие контейнера-->
while($row = mysqli_fetch_array($result)) { // заполнение таблицы данными
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td >" . $row['description'] . "</td>";
    echo "<td >" . $row['regions'] . "</td>";
    echo "<td >" . $row['role'] . "</td>";
    echo "<td >" . $row['price'] . "</td>";
    echo "<td >" . $row['typeDamage'] . "</td>";
    echo "<td> <input  type='button' class='add' name='add' value='Добавить' '>  <!--На эту кнопку назначить создание новой строки в бд-->
               <input  type='button' class='update' name='update' value='Редактировать' '>  <!--На эту кнопку назначить редактирование существующей строки в бд-->
               <input  type='button' class='delete' name='delete' value='Удалить' onclick='deleteRow(this)'> <!--На эту кнопку назначить удаление строки в бд-->
          </td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con); // закрытие соединения с базой данных

$data = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "regions" => $_POST['regions'],
    "role" => $_POST['role'],
    "price" => $_POST['price'],
    "typeDamage" => $_POST['typeDamage'],
];
//Записываем данные в базу данных
$con = mysqli_connect('localhost','root','','t91948ti_magic');  // соединение с базой данных
if (!$con) {
    die("Ошибка: " . mysqli_connect_error());
}
//$con->query("INSERT INTO `league` (`name`, `description`, `regions`, `role`, `price`, `typeDamage`) VALUES (:`name`, :`description`, :`regions`, :`role`, :`price`, :`typeDamage`)"); //подготовка sql кода, INSERT INTO  добавление данных в таблицу users, данных по меткам

$name = $_POST['name'];
$description = $_POST['description'];
$regions = $_POST['regions'];
$role = $_POST['role'];
$price = $_POST['price'];
$typeDamage = $_POST['typeDamage'];
$sql = "INSERT INTO league (name, description, regions, role, price, typeDamage) VALUES (:name, :description, :regions, :role, :price, :typeDamage)";

$statement = $con->prepare($sql); //Prepare подготавливает SQL выражение к выполнению, потом записываем результат в переменную $statement
$statement->bind_param(":name",$_POST['name']);
$statement->bind_param(":description",$_POST['description']);
$statement->bind_param(":regions",$_POST['regions']);
$statement->bind_param(":role",$_POST['role']);
$statement->bind_param(":price",$_POST['price']);
$statement->bind_param(":typeDamage",$_POST['typeDamage']);
$result = $statement->execute(); //Execute выполняет подготовленное утверждение передаем данные в функцию execute
