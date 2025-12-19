<?php
    // подключаем конфигурационный файл приложения
    require '../admin/configDB.php';
    // подключение функций
    require ROOT . '/admin/crud/read/outArticlesAll.php';
    require ROOT . '/admin/crud/read/outArticleSingle.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Статьи</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include ROOT . "/include/header.php" ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Статьи</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">
        <?php
            if (isset($_GET["id"])) {
                //вставка выбранной статьи
                outArticleSingle();
            } else {
                // вставка ВСЕХ статей
                outArticlesAll();
            }
        ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include ROOT . "/include/footer.html" ?>
    </footer>
</body>
</html>