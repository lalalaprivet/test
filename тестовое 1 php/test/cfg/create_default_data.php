<?php  
require_once '../src/connect_bd.php';

// запрос по кнопке для быстрого заполнения таблицы тест данными

	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'BMW', 'X1', 'Серый', '3', '2790000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'BMW', 'X3', 'Желтый', '4', '4520000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'BMW', 'M4', 'Зеленый', '7', '7670000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'AUDI', 'A3 Sedan', 'Красный', '1', '2675000')");		
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'AUDI', 'Q5', 'Черный', '8', '6578500')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'TOYOTA', 'Camry', 'Белый', '2', '2710000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'TOYOTA', 'Land Cruiser Prado', 'Черный', '8', '3237000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'ŠKODA', 'Octavia', 'Серый', '3', '1598000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'CHEVROLET', 'Trailblazer', 'Желтый', '3', '2024000')");
	mysqli_query($link, "INSERT INTO `car` (`id`, `brand`, `model`, `color`, `num`, `price`) VALUES (NULL, 'PORSCHE', 'Panamera', 'Черный', '5', '8210000')");
	
	header('Location: /'); // переадресация на index

?>