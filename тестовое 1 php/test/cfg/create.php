<?php 
require_once '../src/connect_bd.php';

// получение параметров из пост запроса по их названию
$brand = $_POST['brand'];    
$model = $_POST['model'];
$color = $_POST['color'];
$num = $_POST['num'];
$price = $_POST['price'];


mysqli_query($link, "INSERT INTO `car` (`brand`, `model`, `color`, `num`, `price`) VALUES ('$brand', '$model', '$color', '$num', '$price')");  // запрос о добавлении новой сроки с задаными параметрами



header('Location: /'); // переадресация на index
