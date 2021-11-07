<div>
	<?php
		include('db_connect.php');
		if(isset($_GET['author_id'])){
			$authors_result = mysqli_query($connection, "SELECT * FROM authors WHERE id= ".$_GET['author_id']);
			$author = mysqli_fetch_assoc($authors_result);
		}
		mysqli_close($connection);
		if($author){
			$id=$author['id'];
			$name=$author['name'];
			echo '<form action="index.php" method="get">
				<input type="hidden" name="author_id" value="'.$id.'">
				Имя автора:<br>
				<input type="text" name="author_name" value="'.$name.'"><br>
				<button type="submit" class="submit" name="childView" value="add_or_change_author">Сохранить</button>
			</form>';
		}else{
			echo '<form action="index.php" method="get">
				Имя автора:<br>
				<input type="text" name="author_name" ><br>
				<button type="submit" class="submit" name="childView" value="add_or_change_author">Сохранить</button>
			</form>';
		}
	?>
</div>