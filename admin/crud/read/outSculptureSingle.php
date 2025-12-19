<?php
    // функция получения одной записи
    function outSculptureSingle() {
        // подключение базы приложения
        require ROOT . "/admin/connectDB.php";
         // создание подключения
        $mysqli = connectDB();
        
        // выполнение запроса
        $result = $mysqli->query("SELECT * FROM `articles` WHERE `id` = {$_GET['id']}");
        // получение данных в виде ассоциативного массива
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // перебор результирующего массива
        foreach ($rows as $item) {
            
            // создание контента статьи
            // если к статье нет изображения добавляем плейсхолдер no-image 
            if ($item["image"] != null) 
                $image = '/images/sculpture/' . $item["image"];
            else
                $image = '/images/no-image.jpg';

            echo '
                <article>
                    <div class="article">
                        <h2 class="article__title">' . $item["title"] . '</h2>
                        <div class="article__float_left">
                            <img class="article__img" width="500" src="' . $image . '" alt="">
                            <p class="article__text">' . $item["text"] . '</p>
                            <div class="article__links">
                                <a href="' . $item["link"] . '" class="article__link" target="_blank">Смотреть в источнике</a>
                            </div>
                        </div>
                    </div>
                </article>';
        }
    }