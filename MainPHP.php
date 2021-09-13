<?php
echo "sda";
//Считываем данные из базы данных

$con = mysqli_connect('localhost','t91948tj_magic','Qwebvp2W','league'); // соединение с базой данных
$sql="SELECT * FROM users"; //подготовка sql кода, выбираем всё из таблицы users
$result = mysqli_query($con,$sql); // записываем в result данные из mysql
if (!$con) {
    die("Ошибка: " . mysqli_connect_error());
}
echo $result;
$data = [ //Создал Массив data
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "regions" => $_POST['regions'],
    "role" => $_POST['role'],
    "difficult" => $_POST['difficult'],
    "price" => $_POST['price'],
    "typeDamage" => $_POST['typeDamage'],
];

//Записываем данные в базу данных
$connection = new PDO('mysql:host=localhost;dbname=league','t91948tj_magic','Qwebvp2W'); // соединение с базой данных
if (!$connection) {
    die("Ошибка: " . mysqli_connect_error());
}
$sql = 'INSERT INTO users (name, description, regions, role, difficult, price, typeDamage) VALUES (:name, :description, :regions, :role, :difficult, :price, :typeDamage)'; //подготовка sql кода, INSERT INTO  добавление данных в таблицу users, данных по меткам
$statement = $connection->prepare($sql); //Prepare подготавливает SQL выражение к выполнению, потом записываем результат в переменную $statement
$result = $statement->execute($data); //Execute выполняет подготовленное утверждениепередаем данные в функцию execute