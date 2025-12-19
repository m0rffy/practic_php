<?php
require "configDB.php";

function connectDB() {
    $mysqli = new mysqli(HOST, USER, PWD, DB);
    if ($mysqli->connect_error) {
        die("Ошибка подключения: " . $mysqli->connect_error);
    }
    return $mysqli;
}
?>