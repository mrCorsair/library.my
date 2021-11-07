<div>
	<?php
		include('db_connect.php');
		if(isset($_GET['author_id'])){
			if(mysqli_query($connection, 'UPDATE authors SET name = "'.$_GET["author_name"].'" WHERE id="'.$_GET['author_id'].'"')){
				echo "Данные изменены<br>";
			}else{
				echo "Ошибка изменения данных<br>";
			}
		}else{
			if(mysqli_query($connection, 'INSERT INTO authors (name) VALUES  ("'.$_GET['author_name'].'")')){
				echo "Данные добавлены<br>";
			}else{
				echo "Ошибка добавления данных<br>";
			}
		}
	?>

	<form action="index.php" method="get">
		<button type="submit" name="childView" value="home">OK</button>
	</form>
</div>