<?php
$connection = mysqli_connect('127.0.0.1','root','','my_books');

if($connection == false){
	echo 'Не удалось подключиться к базе данных<br>';
	echo mysqli_connect_error();
	exit();
}

?>