<?php
	include('db_connect.php');
	if(isset($_GET['author_id'])){
		if(mysqli_query($connection, 'DELETE FROM authors WHERE id = '.$_GET['author_id'])){
			echo "Запись об авторе удалена<br>";
		}else{
			echo "Ошибка запроса удаления<br>";
		}
	}else{
		echo "Данных не получено";
	}
	mysqli_close($connection);
?>
	<form action="index.php" method="get">
		<button type="submit" name="childView" value="home">OK</button>
	</form>
