<?php
// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №9: АУТЕНТИФИКАЦИЯ ПОЛЬЗОВАТЕЛЕЙ
// =============================================
session_start();
require "../../admin/connectDB.php";

$error = '';

if ($_POST) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        $error = 'Введите логин и пароль';
    } else {
        $mysqli = connectDB();
        
        // Ищем пользователя в базе
        $result = $mysqli->query("SELECT * FROM users WHERE login = '$login'");
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Проверяем пароль
            if (password_verify($password, $user['password'])) {
                // Сохраняем пользователя в сессии
                $_SESSION['user'] = $user;
                header('Location: /');
                exit;
            } else {
                $error = 'Неверный пароль';
            }
        } else {
            $error = 'Пользователь с таким логином не найден';
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
    <title>Вход</title>
</head>
<body>
    <header class="header">
        <?php include "../../include/header.php" ?>
        <div class="header__intro">
            <h1 class="header__title">Вход в систему</h1>
        </div>
    </header>

    <main class="main container">
        <h2 class="title__heading">Вход в систему</h2>
        
        <?php if ($error): ?>
            <div style="color: red; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px 0;">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" style="max-width: 500px; margin: 0 auto;">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Логин:</label>
                <input type="text" name="login" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;">Пароль:</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <button type="submit" style="padding: 12px 30px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
                Войти
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            Нет аккаунта? <a href="../registration/" style="color: #007bff;">Зарегистрируйтесь</a>
        </p>
        
        <div style="margin-top: 30px; padding: 15px; background: #e9ecef; border-radius: 5px;">
            <h3>Практическая работа №9: Аутентификация и авторизация пользователей</h3>
            <p>Реализована система входа пользователей с проверкой логина и пароля, использованием сессий для сохранения состояния аутентификации.</p>
            <p><strong>Тестовые пользователи:</strong></p>
            <ul>
                <li>Логин: <code>admin</code>, Пароль: <code>admin</code> (роль: администратор)</li>
                <li>Логин: <code>moderator</code>, Пароль: <code>moderator</code> (роль: модератор)</li>
            </ul>
        </div>
    </main>

    <?php include "../../include/footer.html" ?>
</body>
</html>