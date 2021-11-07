<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
    <div class="header">
        <form action="index.php" method="get" class="menu">
            <button type="submit" name="childView" value="home">Главная</button>
            <button type="submit" name="childView" value="list_books">Книги</button>
            <button type="submit" name="childView" value="list_authors">Авторы</button>
        </form>
    </div>
    <div class="content">
        <?php include($childView); ?>
     </div>
</body>
</html>