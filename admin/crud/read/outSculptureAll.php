<?php
    // создание сессии
    session_start();

    // функция получения всех записей
    function outSculptureAll() {
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
        $result = $mysqli->query("SELECT * FROM `articles` WHERE `page` = 'sculpture'");
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
                            <p class="article__text">' . $item["teaser"] . ' <a href="/sculpture/?id=' . $item["id"] . '" class="article__link_text">[Подробнее...]</a></p>
                            <div class="article__links">
                                <a href="' . $item["link"] . '" class="article__link" target="_blank">Смотреть в источнике</a>
                            </div>
                        </div>
                        ' . $buttons . '
                    </div>
                </article>';
        }
    }