<div>
	<?
	//проверка получения данных
	if (isset($_GET['book_name']) && isset($_GET['authors'])){
        echo 'Данные получены:<br>';
        echo 'ID: '.$_GET['book_id'].'<br>';
        echo 'Название: '.$_GET['book_name'].'<br> Автор(ы):<br>';
        $authors = $_GET['authors'];
        foreach($authors as $author) echo "$author<br>";


    	include('db_connect.php');
		if(isset($_GET['book_name']) && isset($_GET['book_id'])){
			if(mysqli_query($connection, 'UPDATE books SET name = $_GET["book_name"] WHERE id="'.$_GET['book_id'].'"')){
				 echo 'Название книги изменено';
			}
		}else{
			if(!isset($_GET['book_id']) && isset($_GET['book_name'])){
				mysqli_query($connection, 'INSERT INTO books (name) VALUES  ("'.$_GET['book_name'].'")');
				$query_res=mysqli_query($connection, 'SELECT * FROM books WHERE name = "'.$_GET['book_name'].'"');
				if ($_GET['book_id'] = mysqli_fetch_assoc($query_res)['id']) {
					echo 'Книга добавлена<br>';
				}
			}
		}
		foreach($authors as $author){//находим id авторов в бд по их именам
			$fio = explode(" ", $author);
			for($i=0, $str=""; $i<(count($fio)-1); $i=$i+1){
				$str=$str.'"%'.$fio[$i].'%" and name LIKE ';
			}
			$str=$str.'"%'.$fio[$i].'%"';

			$res_ids = mysqli_query($connection, "SELECT * FROM authors WHERE name LIKE $str");
			if ($authors_ids[] = mysqli_fetch_assoc($res_ids)['id']) {//этот массив содержит все id авторов данной книги.
				echo $author." уже был записан в базе.<br>";
			}
			else{
				if($is_insert = mysqli_query($connection, "INSERT INTO authors (name) VALUES ('$author')")){
					echo "Добавлен новый автор:".$author;
					$res_ids = mysqli_query($connection, "SELECT * FROM authors WHERE name LIKE $str");
					$authors_ids[] = mysqli_fetch_assoc($res_ids)['id'];
				}
			}
		}

		$old_relations = mysqli_query($connection, 'SELECT * FROM written_by WHERE book_id = "'.$_GET['book_id'].'"');
		while($relation = mysqli_fetch_assoc($old_relations)){
			if(in_array ( $relation[author_id] , $authors_ids)){
				$authors_ids = array_flip($authors_ids);
				unset($authors_ids["$relation[author_id]"]);//ведем подсчет по оставшимся id
				$authors_ids = array_flip($authors_ids);
			}else{//удаляем связи с авторами, которых нет в измененной записи
				if(mysqli_query($connection, 'DELETE FROM written_by WHERE book_id = '.$relation['book_id'].' and author_id = '.$relation['author_id'])){
					echo "старая связь удалена<br>";
				}
			}
		}

		//добавляем связи c новыми авторами
		foreach($authors_ids as $new_author){
			if(mysqli_query($connection, 'INSERT INTO written_by (book_id, author_id) VALUES ("'.$_GET['book_id'].'","'. $new_author.'")')){
				echo "новая связь добавлена<br>";
			}
		}
	}else{
        echo 'Данные не получены';
    }
    mysqli_close($connection);
	?>
</div>

<form action="index.php" method="get">
	<button type="submit" name="childView" value="home">OK</button>
</form>