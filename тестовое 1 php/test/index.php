<?php 

require_once 'src/connect_bd.php'; // подключение к бд
require_once 'cfg/cfg.php'; // файл с постоянными значениями

 //===========================================================================================================
$page = (isset($_GET['page']) ? (int)$_GET['page'] : $default_page);
$search = (isset($_GET['search']) ? (string)$_GET['search'] : $default_search);             // Получение GET параметров
$sort = (isset($_GET['sort']) ? (string)$_GET['sort'] : $default_sort);
 //===========================================================================================================

$count = mysqli_query($link, "SELECT count(*) FROM `car` WHERE `car`.`brand` LIKE '%$search%' || `model` LIKE '%$search%' || `color` LIKE '%$search%' || `num` LIKE '%$search%' || `price` LIKE '%$search%'");
$count = mysqli_fetch_array($count)[0];  // Подчет количества строк для определения количества страниц с учетом параметра поиска 

$max_page = $count / $limit; // рассчет максимальной страницы
$min_page = 1; // минимальная страница

$offset = ($page-1) * $limit; // число строк, которые необходимо пропустить, для того чтобы выдать нужные строк( для отображения на последующих страниц или пропуска предедущих)

$cars = mysqli_query($link, "SELECT * FROM `car` WHERE `car`.`brand` LIKE '%$search%' || `model` LIKE '%$search%' || `color` LIKE '%$search%' || `num` LIKE '%$search%' || `price` LIKE '%$search%' ORDER BY $sort ASC LIMIT  $limit OFFSET $offset");
$cars = mysqli_fetch_all($cars); // освной запрос по выводу отсортированых, найденых строк с учетом выбраной страницы.
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Document</title>
</head>

<body>
	<style type="text/css">
		th,td { outline: 2px solid #000; /*стили таблицы*/ }
	</style>
	<form action="cfg/create_default_data.php" method="post">
	   <button  name="submit" >Заполнить таблицу</button> <!-- просто для быстрого заполнения таблицы тест данными -->
	</form><br>
		<a href="index.php"><button  name="submit" >очистить данные</button></a> <!-- кнопка для сброса параметров поиска и сортировки в исходное состояние-->
	
	<!-- форма для выбора параметра по которому сортируются данные  -->
	<h3>Сортировать(от меньшего к большему) по: </h3>
			<form action="index.php" method="get">
				<input name="sort" list="models" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" placeholder="Нажмите, чтобы выбрать" value="<?= $sort ?>">
				<input type="hidden" name="search" value="<?= $search ?>"> <!-- hidden - скрытый параметр, для передачи get запроса доп параметра  -->
				<datalist id="models">
						 <option value="brand" />
   						 <option value="model" />
  						 <option value="color" />
   						 <option value="num" />
   					     <option value="price" />
				</datalist>
					<button type="submit">Сортировать</button><br><br>
		    </form>
   
   	<form action="index.php" method="get"> <!-- форма для поиска -->
   		<input type="search" name="search" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" placeholder="Поиск" value="<?= $search ?>">
   		<input type="hidden" name="sort" value="<?= $sort ?>"><!-- hidden - скрытый параметр, для передачи get запроса доп параметра  -->
   		<button name="search_btn">Найти</button>
   	</form>
   			<?php 
   					if(isset($cars) && is_array($cars)) { // проверяем, что массив машин содержит значение        			           
   			 ?>
	 <br> 
	<table>
		<tr>
			<th>Марка</th>  
			<th>Модель</th>
			<th>Цвет</th>
			<th>Количество</th>
			<th>Цена</th>
		</tr>
<?php 
	
	 foreach ($cars as $cars) // формируем html строку для каждого элемента массива "cars" 
{             
?>
                    <tr>
                        <td><?= $cars[1] ?></td>
                        <td><?= $cars[2] ?></td>
                        <td><?= $cars[3] ?></td>
                        <td><?= $cars[4] ?> шт.</td>
                        <td><?= $cars[5] ?> Руб.</td>
                        <td><a href="update.php?id=<?= $cars[0] ?>">Изменить</a></td> <!-- вызов скрипта обновления таблицы по нажатию с передачей id строки -->
                        <td><a href="delete.php?id=<?= $cars[0] ?>">Удалить</a></td>   <!-- вызов скрипта удаления таблицы по нажатию с передачей id строки -->
                    </tr>
<?php
}
?>
		</table>
<?php   } 
		else {
			
		}

			?>


<?php 

	for ($i = 1; $i <= $max_page; $i++)  // вывод доступных страниц 
    
{
?>
		<a href="index.php?page=<?=$i?>&search=<?=$search?>&sort=<?=$sort?>"><?=$i?></a>  <!-- ссылка, по которой осуществляется переход на страницу с сохранением параметров выборки -->
	

		 <?php
		
            }
            
           if($page < $max_page ) {?>
           	<a href="index.php?page=<?=$page+1?>&search=<?=$search?>&sort=<?=$sort?>">вперед</a>  
           	<? }
           
       
			 ?>
		<?php 
		if ($page > $min_page) {?>
			<a href="index.php?page=<?=$page-1?>&search=<?=$search?>&sort=<?=$sort?>">назад</a>
	<?	}?>

		<h3>Добавить новое авто</h3>
		<form action="cfg/create.php" method="post">
			<p>Марка</p>
			<input type="text" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" name="brand">
			<p>Модель</p>
			<input type="text" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" name="model">
			<p>Цвет</p>
			<input type="text" pattern="^[A-Za-zА-Яа-яЁё\s0-9]+$" name="color">
			<p>Количество</p>
			<input type="number"  name="num">
			<p>Цена</p>
			<input type="number" name="price"> <br> <br> 
			<button type="submit">Добавить авто</button>
		</form>
</body>
</html>

