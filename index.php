<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Музеи мира</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include "include/header.php" ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Музеи Мира</h1>
        </div>
    </header>

    <main class="main container">
        <!-- вставка статичной статьи -->
        <?php include "include/glavnaya.html" ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include "include/footer.html"; ?>
    </footer>
</body>
</html>