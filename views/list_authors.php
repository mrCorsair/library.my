<div>
	Авторы:<br>
	<table>
	<?php
	include('db_connect.php');
	?>

	<?php
	$result = mysqli_query($connection, "SELECT * FROM authors");
	while ($record = mysqli_fetch_assoc($result)) {
		echo '<tr><form action="index.php" method="get">';
		echo '<td><input type="hidden" name="author_id" value="'.$record['id'].'">'.$record['name'].'</input><td>';
		echo '<button type="submit" name="childView" value="edit_author">Редактировать</button>';
		echo '<button type="submit" name="childView" value="del_author">Удалить</button>';
		echo '</form></tr>';
	}

	mysqli_close($connection);

	?>
	</table>

	<form action="index.php" method="get">
		<button type="submit" class="leftbutton" name="childView" value="edit_author">Добавить Автора</button>
	</form>
</div>