<?php
    require '../../configDB.php';
    require '../../connectDB.php';

    $mysqli = connectDB();

    $sql = "DELETE FROM `articles` WHERE `id` = '{$_GET['id']}'";
    $mysqli->query($sql);

    $page = $_GET['page'];

    header("Location:/admin/crud/result.php?action=delete&page=$page");
    exit;