
<?php 
	require_once 'src/connect_bd.php'; // подключение к бд

$car_id = $_GET['id'];    // получение переданого id из index
$car = mysqli_query($link, "SELECT * FROM `car` WHERE `id` = '$car_id'"); // получение данных о выбраной строке 
$car = mysqli_fetch_assoc($car);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>update</title>
</head>
<body>
	<h3>Изменить </h3>
		<form action="cfg/update.php" method="post"> <!--  форма изменения данных  -->
			<input type="hidden" name="id"  value="<?= $car['id'] ?>">
			<p>Марка</p>
			<input type="text" name="brand" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" value="<?= $car['brand'] ?>" >
			<p>Модель</p>
			<input type="text" name="model" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" value="<?= $car['model'] ?>" >
			<p>Цвет</p>
			<input type="text" name="color" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" value="<?= $car['color'] ?>" > 
			<p>Количество</p>
			<input type="number" name="num" value="<?= $car['num'] ?>" >
			<p>Цена</p>
			<input type="number" name="price" value="<?= $car['price'] ?>" > <br> <br> 
			<button type="submit">Изменить</button>
		</form>
</body>
</html>