<?php
    // создание сессии
    session_start();

    // подключаем конфигурационный файл приложения
    require '../../configDB.php';
    // подключение базы приложения
    require ROOT . "/admin/connectDB.php";

    // создание подключения
    $mysqli = connectDB();
    
    // формирование запроса
    $sql = "SELECT * FROM `users` WHERE `login` = '{$_POST['login']}'";
    // выполнение запроса
    $result = $mysqli->query($sql);
    // если есть запись, то входим в аккаунт
    if($result->num_rows) {
        // формирование ответа в виде ассоциативного массива
        $rows = $result->fetch_assoc();
    
        // если пароль и логин совпадает
        if (password_verify($_POST['password'], $rows['password'])) {
            // запись пользователя в сессию
            $_SESSION['id'] = $rows['id'];
            // редирект на страницу аккаунта в случае входа
            header("Location:/personal/account/");
            exit;
        }
        // если не совпадают
        else {
            $status = 418;
            // редирект на страницу входа
            header("Location:/personal/login/?status=$status");
            exit;
        }
    }
    // если нет пользователя в базе
    else {
        $status = 418;
        // редирект на страницу входа
        header("Location:/personal/login/?status=$status");
        exit;
    }