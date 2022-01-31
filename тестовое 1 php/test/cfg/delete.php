<?php 
	require_once '../src/connect_bd.php'; // подчключение к бд

 	$id = $_GET['id']; // получение ид выбраного элемента из index по get 
	$id = mysqli_query($link, "DELETE FROM `car` WHERE `car`.`id` = '$id'"); // запрос на удаление строки  из бд с определенным id

	
	header('Location: /'); // переадресация на index

?>
