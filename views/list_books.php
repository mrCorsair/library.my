<div>
	Книги:<br>
	<table>
	<?php
		include('db_connect.php');
		$books_result = mysqli_query($connection, "SELECT * FROM books");

		while ($record = mysqli_fetch_assoc($books_result)) {
			$authors_result = mysqli_query($connection, "SELECT * FROM authors, written_by WHEre id=written_by.author_id AND written_by.book_id = ".$record['id']);
			$str="";
			if($author_rec = mysqli_fetch_assoc($authors_result)){
				$str=$author_rec['name'];
			}
			while ($author_rec = mysqli_fetch_assoc($authors_result)) {
				$str=$str.", ".$author_rec['name'];
			}
			echo '<tr><form action="index.php" method="get">';
			echo '<td><input type="hidden" name="book_id" value="'.$record['id'].'">'.$record['name'].'</td><td>'.$str.'</input><td>';
			echo '<button type="submit" name="childView" value="edit_book">Редактировать</button>';
			echo '<button type="submit" name="childView" value="del_book">Удалить</button>';
			echo '</form></tr>';
		}
		mysqli_close($connection);
	?>
	</table>
	<form action="index.php" method="get">
		<button type="submit" class ="leftbutton" name="childView" value="edit_book">Добавить книгу</button>
	</form>
</div>