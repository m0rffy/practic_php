<?php
    // подключаем конфигурационный файл приложения
    require '../../configDB.php';
    // подключение базы приложения
    require ROOT . "/admin/connectDB.php";

    // создание подключения
    $mysqli = connectDB();

    // если пароли не совпадают
    if ($_POST['password'] != $_POST['enterPassword']) {
        // редирект на регистрацию
        header('Location:/personal/registration/?status=401'); // статус выбран случайно
        exit;
    } else {
        // проверка логина
        $isLogin = $mysqli->query("SELECT * FROM `users` WHERE `login` = '{$_POST['login']}'");
        // если пользователь с таким логином существует
        if($isLogin->num_rows) {
            // редирект на регистрацию
            header('Location:/personal/registration/?status=400'); // статус выбран случайно
            exit;
        // если пользователя с таким логином не существует
        } else {
            // хэширование пароля
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // формирование sql строки
            $sql = sprintf(
                "INSERT INTO `users`(`id`, `login`, `email`, `password`) 
                VALUES (null, '%s', '%s', '%s')",
                $_POST['login'],
                $_POST['email'],
                $hash
            );
            // запрос
            $mysqli->query($sql);    
            // редирект на страницу результата
            header('Location:/personal/login/');
            // конец скрипта
            exit;
        }
    }