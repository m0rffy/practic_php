<?php
    // создание сессии
    session_start();

    // функция получения всех записей
    function outGreatAll() {
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
        $result = $mysqli->query("SELECT * FROM `articles` WHERE `page` = 'great'");
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
                $image = '/images/great/' . $item["image"];
            else
                $image = '/images/no-image.jpg';

            echo '
                <article>
                    <div class="title">
                        <h2 class="title__heading">' . $item['title'] . '</h2>
                        <div class="title__float_left title__paragraph">
                            <img class="title__img" src="' . $image . '" alt="">' . $item['text'] . ' 
                        </div>
                        ' . $buttons .  '
                    </div>
                </article>';
        }
    }