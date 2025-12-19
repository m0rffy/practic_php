<?php
    // создание сессии
    session_start();

    // функция получения набора записей
    function outPaintingCountry($country) {
        // подключение базы приложения
        require ROOT . "/admin/connectDB.php";
        // подключение функции на проверку прав
        require ROOT . "/admin/isAdmin.php"; 
        // стандартные права
        $isAdmin = false;
         // создание подключения
        $mysqli = connectDB();

        // если пользователь зашел
        if(isset($_SESSION['id'])) {
            // проверка прав
            $isAdmin = isAdmin($mysqli, $_SESSION['id']);
        }
        
        // выполнение запроса
        $result = $mysqli->query("SELECT * FROM `articles` WHERE `page` = 'painting' AND `country` = '$country'");
        // получение данных в виде ассоциативного массива
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // перебор результирующего массива
        foreach ($rows as $item) {
            // если есть права, то кнопки есть
            if($isAdmin == 'admin') {
                $buttons = '
                <div class="title__btns">
                    <a class="title__btn" href="/admin/form.php?action=update&id=' . $item['id'] . '">Редактировать</a>
                    <a class="title__btn" href="/admin/crud/delete/?id=' . $item['id'] . '&page=' . $item['page'] . '">Удалить</a>
                </div>';
            }
            // если нет, то нет кнопок
            else {
                $buttons = '';
            }

            // создание контента тизера
            // разбиваем дату по сепаратору "/"
            list($data1, $data2) = explode("/", $item["dates"]);
            
            // если к статье нет изображения добавляем плейсхолдер no-image 
            if ($item["image"] != null) 
                $image = '/images/painting/' . $item["image"];
            else
                $image = '/images/no-image.jpg';
            
            echo '
                <article>
                    <div class="article">
                        <div class="article__title">' . $item["title"] . '</div>
                        <div class="article__float_left">
                            <div><img class="article__img" width="500" src="' . $image . '" alt=""></div>
                            <div class="article__info">
                                <p><span><b>Дата рождения: </b>' . $data1 . '</span></p>
                                <p><span><b>Дата смерти: </b>' . $data2 . '</span></p>
                                <p><span><b>Страна: </b>' . $item["country"] . '</span></p>
                                <p><b>Работы художника находятся:</b>
                                <ul>
                                    ' . $item["museums"] . '
                                </ul>
                                </p>
                                <a href="/painting/?id=' . $item["id"] . '" class="article__link_text">Подробнее...</a>
                            </div>
                        </div>
                        ' . $buttons . '
                    </div>
                </article>';
        }
    }