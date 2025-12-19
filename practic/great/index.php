<?php
    // подключение массива
    require "../data/great.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Великие музеи</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include "../include/header.html"; ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Великие музеи</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">

        <!-- вставка статичной страницы -->
        <?php include "../include/velikie-musei.html"; ?>

        <!-- вставка ВСЕХ музеев -->
        <?php
            foreach ($arr as $item) {
                echo '<article>
                        <div class="title">
                            <h2 class="title__heading">' . $item['content']['title'] . '</h2>
                            <div class="title__float_left">
                                <img class="title__img" src="' . $item['image'] . '" alt="">
                                ' . $item['content']['text'] . '
                            </div>
                        </div>
                    </article>';
            }
        ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include "../include/footer.html" ?>
    </footer>
</body>
</html>