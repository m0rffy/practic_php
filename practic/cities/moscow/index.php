<?php
    // подлючение массива
    require "../../data/cities.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Москва</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- Вставка меню -->
        <?php include "../../include/header.html" ?>
        <!-- Вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Москва</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">
        <div class="title">
            <?php
                foreach ($arr as $item) {
                    if ($item["slag"] == "musei-moskvy") {
                        echo '
                        <h2 class="title__heading">' . $item["content"]["title"] . '</h2>
                        ' . $item["content"]["text"] . '';
                    }
                }
            ?>
        </div>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include "../../include/footer.html" ?>
    </footer>
</body>
</html>