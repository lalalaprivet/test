<?php 
require_once '../src/connect_bd.php'; // Подключение к бд

// получение параметров из пост запроса по их названию
$id = $_POST['id'];     
$brand = $_POST['brand'];
$model = $_POST['model'];
$color = $_POST['color'];
$num = $_POST['num'];
$price = $_POST['price'];

mysqli_query($link,"UPDATE `car` SET `brand` = '$brand', `model` = '$model', `color` = '$color', `num` = '$num', `price` = '$price' WHERE `car`.`id` = '$id'"); // Запрос к бд на изменение данных по id

	
header('Location: /');  // переадресация на index
