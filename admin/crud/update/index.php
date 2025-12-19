<?php
    // подключаем конфигурационный файл приложения
    require '../../configDB.php';
    // подключение базы приложения
    require ROOT . "/admin/connectDB.php";

    // создание подключения
    $mysqli = connectDB();

    $sql = sprintf(
        "UPDATE `articles` SET
            `page` = '%s',
            `slag` = '%s', 
            `title` = '%s', 
            `date` = '%s', 
            `link` = '%s', 
            `dates` = '%s', 
            `museums` = '%s', 
            `country` = '%s', 
            `teaser` = '%s', 
            `text` = '%s',
            `image` = '%s'
            WHERE `id` = '{$_GET['id']}'",
        $_POST['selectPage'],
        $_POST['slag'],
        $_POST['title'],
        date('d/m/y'),
        empty($_POST['link'])? null : $_POST['link'],
        empty($_POST['dates'])? null : $_POST['dates'],
        empty($_POST['museums'])? null : $_POST['museums'],
        empty($_POST['country'])? null : $_POST['country'],
        addslashes($_POST['teaser']),
        addslashes($_POST['text']),
        empty($_POST['image'])? null : $_POST['image']
    );

    $mysqli->query($sql);

    header("Location:/admin/crud/result.php?action=update&id={$_GET['id']}&page={$_GET['page']}");
    exit;