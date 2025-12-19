<?php
    // подключение массива
    require "../data/sculpture.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Скульпутры</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include "../include/header.html" ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Отзывы</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">
        <div style="margin:30px 0">
            <h1>Здесь будут отзывы посетителей</h1>
        </div>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include "../include/footer.html" ?>
    </footer>
</body>
</html>