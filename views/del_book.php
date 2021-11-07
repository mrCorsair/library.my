<?php
	include('db_connect.php');
	if(isset($_GET['book_id'])){
		if(mysqli_query($connection, 'DELETE FROM books WHERE id = '.$_GET['book_id'])){
			echo "Запись о книге удалена<br>";
		}else{
			echo "Ошибка запроса удаления<br>";
		}
	}else{
		echo "Данных не получено";
	}
	mysqli_close($connection);

	<form action="index.php" method="get">
		<button type="submit" name="childView" value="home">OK</button>
	</form>
?>