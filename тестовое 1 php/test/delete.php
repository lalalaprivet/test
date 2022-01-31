<?php 

	require_once 'src/connect_bd.php'; // подключение к бд

?>
<!-- Страница с подтверждением удаления  -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>delete</title>
</head>
<body>
	<h3>Вы действительно хотите удалить это? </h3>
		<button> <a href="cfg/delete.php?id=<?=$_GET['id']?>">да</a></button> <!-- вызов скрипта удаления строки с передачей id -->
		<button>  <a href="index.php">нет</a></button> 
</body>
</html>  