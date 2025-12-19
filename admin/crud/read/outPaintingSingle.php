<?php
    // функция получения одной записи
    function outPaintingSingle() {
        // подключение базы приложения
        require ROOT . "/admin/connectDB.php";
         // создание подключения
        $mysqli = connectDB();
        
        // выполнение запроса
        $result = $mysqli->query("SELECT * FROM `articles` WHERE `id` = {$_GET['id']}");
        // формирование данных в виде ассоциативного массива
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // перебор результирующего массива
        foreach ($rows as $item) {
            
            // создание контента статьи
            //разбиваем дату по сепаратору "/"
            list($data1, $data2) = explode("/", $item["dates"]);
            
            // если к статье нет изображения добавляем плейсхолдер no-image 
            if ($item["image"] != null) 
                $image = '/images/painting/' . $item["image"];
            else
                $image = '/images/no-image.jpg';
            
            $out = '
                <article>
                    <div class="article">
                        <div class="article__title">' . $item["title"] . '</div>
                        <div class="article__float_left">
                            <div ><img class="article__img" width="500" src="' . $image . '" alt=""></div>
                            <div class="article__info">
                                <p><span><b>Год рождения: </b>' . $data1 . '</span></p>
                                <p><span><b>Дата рождения: </b>' . $data2 . '</span></p>
                                <p><span><b>Страна: </b>' . $item["country"] . '</span></p>
                                <p><b>Работы художника находятся:</b>
                                <ul>
                                    ' . $item["museums"] . '
                                </ul>
                                </p>
                            </div>
                        </div>
                        <div>
                            ' . $item["text"] . '
                        </div>
                    </div>
                </article>';
        
            // вывод статьи
            echo $out;
        }
    }