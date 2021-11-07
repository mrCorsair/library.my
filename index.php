<?php
    if (!isset($_GET['childView'])) {
        $title = 'Home';
        $childView = 'views/home.php';
    }else{
        $title = $_GET['childView'];
        $childView = 'views/'.$_GET['childView'].'.php';
    }
    include('views/_layout.php');
?>