<?php
    require "configDB.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Музеи мира</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include ROOT . "/include/header.php" ?>
        <!-- вставка бwаннера -->
        <div class="header__intro">
            <h1 class="header__title">Музеи Мира</h1>
        </div>
    </header>

    <main class="main container">
        <?php
            // создание title для формы
            $formTitle = $_GET['action'] == "create" ? '<h1 class="form__title">Добавление статьи</h1>' : '<h1 class="form__title">Редактирование статьи</h1>';

            // создание submit кнопки для формы
            $btn = $_GET['action'] == "create" ?  '<button class="form__submit" type="submit">Добавить</button>'  :  '<button class="form__submit" type="submit">Редактировать</button>';

            // формирование action для формы
            $formAction = "crud/create/";

            // если делаем редактирование данных, то подключаемся к базе
            if ($_GET['action'] == "update") {
                //подлючение к БД
                require "./connectDB.php";
                $mysqli = connectDB();
                //выполнение запроса
                $result = $mysqli->query("SELECT * FROM `articles` WHERE `id` = '{$_GET["id"]}'");
                // получение данных в виде ассоциативного массива
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                // изменение action для формы
                $formAction = "crud/update/?id={$_GET['id']}&page={$rows[0]['page']}";
            }

            // шаблон для формы
            $pattern = '
            <form action="'. $formAction . '" class="form" method="post">
                ' . $formTitle . '
                <hr>
                <div class="form__inputs">
                    <div class="form__input">
                        <label for="title" class="form__label">Название статьи</label>
                        <input type="text" id="title" name="title" value="%s" />
                    </div>
                    %s
                    <div class="form__input">
                        <label for="slag" class="form__label">Slag или Alias</label>
                        <input type="text" id="slag" name="slag" placeholder="example-01" value="%s"/>
                    </div>
                    <div class="form__input">
                        <label for="link" class="form__label">Ссылка на источник</label>
                        <input type="text" id="link" name="link" value="%s"/>
                    </div>
                    <div class="form__input">
                        <label for="dates" class="form__label">Даты (для категории <b>Живопись</b>)</label>
                        <input type="text" id="dates" name="dates" placeholder="день месяц год/день месяц год"
                        value="%s"/>
                    </div>
                    <div class="form__input">
                        <label for="museums" class="form__label">Музеи (для категории <b>Живопись</b>)</label>
                        <textarea type="text" id="museums" name="museums"
                            placeholder="<li>Пример для одного музея</li>"
                            value="%s"></textarea>
                    </div>
                    <div class="form__input">
                        <label for="country" class="form__label">Страна</label>
                        <input type="text" id="country" name="country" value="%s"/>
                    </div>
                    <div class="form__input">
                        <label for="image" class="form__label">Ссылка на изображение</label>
                        <input type="text" id="image" name="image" value="%s"/>
                    </div>
                    <div class="form__input">
                        <label for="teaser" class="form__label">Тизер</label>
                        <textarea type="text" id="teaser" name="teaser">%s</textarea>
                    </div>
                    <div class="form__input">
                        <label for="text" class="form__label">Текст</label>
                        <textarea type="text" id="text" name="text">%s</textarea>
                    </div>
                </div>
                <div class="form__btn">
                    <button class="form__submit" type="reset">Очистить форму</button>
                    ' . $btn . '
                </div>
            </form>';
            
            if ($_GET['action'] == "update") {
                // вывод формы
                printf($pattern,
                isset($rows[0]['title']) ? $rows[0]['title'] : "",
                getPageSelect($rows[0]['page'], $_GET['action']),
                isset($rows[0]['slag']) ? $rows[0]['slag'] : "",
                isset($rows[0]['link']) ? $rows[0]['link'] : "",
                isset($rows[0]['dates']) ? $rows[0]['dates'] : "",
                isset($rows[0]['museums']) ? $rows[0]['museums'] : "",
                isset($rows[0]['country']) ? $rows[0]['country'] : "",
                isset($rows[0]['image']) ? $rows[0]['image'] : "",
                isset($rows[0]['teaser']) ? $rows[0]['teaser'] : "",
                isset($rows[0]['text']) ? $rows[0]['text'] : "");
            }elseif ($_GET['action'] == "create") {
                // вывод формы
                printf($pattern, "", getPageSelect(), "", "", "", "", "", "", "", "", "");
            }
            
        ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include ROOT . "/include/footer.html"; ?>
    </footer>
</body>
</html>