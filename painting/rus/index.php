<?php
    // подключаем конфигурационный файл приложения
    require '../../admin/configDB.php';
    // подключение функций
    require ROOT . '/admin/crud/read/outPaintingCountry.php';
    require ROOT . '/admin/crud/read/outPaintingSingle.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Русская живопись</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- меню -->
        <?php include ROOT . "/include/header.php" ?>
        <!-- баннер -->
        <div class="header__intro">
            <h1 class="header__title">Русская живопись</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">
        <?php outPaintingCountry("Россия") ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вывод футера -->
        <?php include ROOT . "/include/footer.html" ?>
    </footer>
</body>
</html>