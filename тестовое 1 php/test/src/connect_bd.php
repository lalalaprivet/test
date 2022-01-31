<?php // подключение к бд

	$host = 'test';
	$database = 'car_list';
	$user = 'root';
	$password = '';

	$link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключиться к БД");

?>