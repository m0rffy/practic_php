<?php
    // функция получения одной записи
    function outCitySingle($slag) {
        // подключение базы приложения
        require ROOT . "/admin/connectDB.php";
         // создание подключения
        $mysqli = connectDB();
        
        // выполнение запроса
        $result = $mysqli->query("SELECT * FROM `articles` WHERE `slag` = '$slag'");
        // получение данных в виде ассоциативного массива
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // перебор результирующего массива
        foreach ($rows as $item) {
            
            // создание контента статьи
            echo '
                <h2 class="title__heading">' . $item["title"] . '</h2>
                ' . $item["text"] . '';
        }
    }