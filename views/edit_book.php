<div>
	<?php
		include('db_connect.php');
		if(isset($_GET['book_id'])){
			$book = mysqli_query($connection, "SELECT * FROM books WHERE id=".$_GET['book_id']);
			$authors_result = mysqli_query($connection, "SELECT * FROM authors, written_by WHERE id=written_by.author_id AND written_by.book_id = ".$_GET['book_id']);
		}
		mysqli_close($connection);
	?>
	<form action="index.php" method="get">
		<?php

		if(isset($_GET['quantity'])){
			$quantity = $_GET['quantity'];
		}else{
			if($authors_result)
				$quantity = mysqli_num_rows($authors_result);
			if($quantity<1){
				$quantity = 1;
			}
		}

		if(isset($_GET['book_id'])){
			$book_rec = mysqli_fetch_assoc($book);
			echo '<input type="hidden" name="book_id" value="'.$book_rec['id'].'">';
			echo 'Название:<input type="text" name="book_name" value="'.$book_rec['name'].'""><br>';

			for ($i = 0; ($author_rec = mysqli_fetch_assoc($authors_result)) && $i<$quantity; $i = $i+1) {
				echo 'Автор:<input type="text" name="authors[]" value="'.$author_rec['name'].'""><br>';
			}
			while ($i<$quantity) {
				echo 'Автор:<input type="text" name="authors[]"><br>';
				$i=$i+1;
			}
		}else {
			echo 'Название:<input type="text" name="book_name"><br>';
			for ($i=0; $i<$quantity; $i=$i+1) {
				echo 'Автор:<input type="text" name="authors[]"><br>';
			}
		}
		?>
		<button type="submit" class="submit" name="childView" value="saving_changes">Сохранить</button>
	</form>

	<form action="index.php" method="get">
		<?php
		if(isset($_GET['book_id'])){
			echo '<input type="hidden" name="book_id" value="'.$_GET['book_id'].'">';
		}
		?>
		<input type="number" class="mini" name="quantity" min="1" value="<?php mysqli_num_rows($authors_result) ?>">
		<button type="submit" name="childView" value="edit_book">Изменить количество авторов</button>
	</form>
</div>