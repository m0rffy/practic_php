<?php
    // подключаем конфигурационный файл приложения
    require '../../admin/configDB.php';
    // подключение функции
    require ROOT . '/admin/crud/read/outCitySingle.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Барселона</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include ROOT . "/include/header.php" ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Барселона</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">
        <div class="title">
            <?php outCitySingle("musei-barcelony") ?>
        </div>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include ROOT . "/include/footer.html" ?>
    </footer>
</body>
</html>