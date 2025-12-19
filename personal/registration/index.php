<?php
// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №8: РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЕЙ
// =============================================
session_start();
require "../../admin/connectDB.php";

$error = '';
$success = '';

if ($_POST) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    if (empty($login) || empty($password)) {
        $error = 'Логин и пароль обязательны';
    } else {
        $mysqli = connectDB();
        
        // Проверяем, нет ли уже такого логина
        $check = $mysqli->query("SELECT * FROM users WHERE login = '$login'");
        if ($check->num_rows > 0) {
            $error = 'Пользователь с таким логином уже существует';
        } else {
            // Хешируем пароль
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Вставляем нового пользователя
            $result = $mysqli->query("INSERT INTO users (login, password, email, name, surname, role) 
                                     VALUES ('$login', '$hashed_password', '$email', '$name', '$surname', 'user')");
            
            if ($result) {
                $success = 'Регистрация успешна. Теперь вы можете войти.';
            } else {
                $error = 'Ошибка при регистрации: ' . $mysqli->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Регистрация</title>
</head>
<body>
    <header class="header">
        <?php include "../../include/header.php" ?>
        <div class="header__intro">
            <h1 class="header__title">Регистрация</h1>
        </div>
    </header>

    <main class="main container">
        <h2 class="title__heading">Регистрация нового пользователя</h2>
        
        <?php if ($error): ?>
            <div style="color: red; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px 0;">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div style="color: green; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; margin: 20px 0;">
                <?= $success ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" style="max-width: 500px; margin: 0 auto;">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Логин:</label>
                <input type="text" name="login" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Пароль:</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" name="email" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Имя:</label>
                <input type="text" name="name" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;">Фамилия:</label>
                <input type="text" name="surname" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <button type="submit" style="padding: 12px 30px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
                Зарегистрироваться
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            Уже есть аккаунт? <a href="../login/" style="color: #007bff;">Войдите</a>
        </p>
        
        <div style="margin-top: 30px; padding: 15px; background: #e9ecef; border-radius: 5px;">
            <h3>Практическая работа №8: Создание таблицы users и регистрация пользователей</h3>
            <p>Реализована система регистрации новых пользователей с хешированием паролей и проверкой уникальности логина.</p>
        </div>
    </main>

    <?php include "../../include/footer.html" ?>
</body>
</html>