<?php

    // функция проверки пользователя на права
    function isAdmin($mysqli, $userId) {        
        // выполнение запроса
        $result = $mysqli->query("SELECT `role` FROM `users` WHERE `id` = '$userId'");
        // если пользователь найден
        if($result->num_rows) {
            // получение данных в виде ассоциативного массива
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // если роль admin
            if($rows[0]['role'] == 'admin') {
                return "admin";
            }
            // если роль user
            else {
                return "user";
            }
        }
        // не даем права
        return false;
    }