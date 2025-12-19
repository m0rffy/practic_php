<?php
    // подключение массива
    require "../../data/painting.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Итальянская живопись</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <!-- Меню + баннер -->
    <header class="header">
        <!-- Меню -->
        <?php include("../../include/header.html") ?>
        <!-- Баннер -->
        <div class="header__intro">
            <h1 class="header__title">Итальянская живопись</h1>
        </div>
    </header>

    <!-- Контент -->
    <main class="main container">
        <?php
            // перебираем массив художников
            foreach ($arr as $item) {
                // если страна текущего художника == Италия, то выводим данные массива
                if ($item["content"]["country"] == "Италия") {
                    $museums = "";
                     // добавление списка музеев
                    foreach ($item["content"]["museums"] as $museum) {
                        $museums .= "<li>" . $museum . "</li>";
                    }

                    // формирование блока вывода
                    $out = '
                    <article>
                        <div class="article">
                            <div class="article__title">' . $item["content"]["title"] . '</div>
                            <div class="article__float_left">
                                <div ><img class="article__img" width="500" src="' . $item["image"] . '" title="' . $item["content"]["title"] . '"></div>
                                <div class="article__info">
                                    <p><span><b>Год рождения: </b>' . $item["content"]["dates"][0] . '</span></p>
                                    <p><span><b>Дата рождения: </b>' . $item["content"]["dates"][1] . '</span></p>
                                    <p><span><b>Страна: </b>' . $item["content"]["country"] . '</span></p>
                                    <p><b>Работы художника находятся:</b>
                                    <ul>
                                        ' . $museums . '
                                    </ul>
                                    </p>
                                </div>
                            </div>
                            ' . $item["content"]["text"] . '
                        </div>
                    </article>';
                    // вывод статьи
                    echo $out;
                }
            }
        ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вывод футера -->
        <?php include "../../include/footer.html" ?>
    </footer>
</body>
</html>