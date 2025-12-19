<?php
    // подключение массива
    require "../data/articles.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Статьи</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include "../include/header.html" ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Статьи</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container">
        <!-- вывод ВСЕХ статей -->
        <?php
            foreach ($arr as $item) {
                echo '
                <article>
                    <div class="article">
                        <h2 class="article__title">' . $item["content"]["title"] . '</h2>
                        <div class="article__float_left">
                            <img class="article__img" width="500" src="/images/articles/' . $item["image"] . '" title="' . $item["content"]["title"] . '">
                            ' . $item["content"]["text"] . '
                            <a href="' . $item["link"] . '" class="article__link" target="_blank">Смотреть в источнике</a>
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