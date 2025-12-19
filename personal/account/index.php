<?php
// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №9: ЛИЧНЫЙ КАБИНЕТ
// =============================================
session_start();

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    header('Location: ../login/');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Личный кабинет</title>
</head>
<body>
    <header class="header">
        <?php include "../../include/header.php" ?>
        <div class="header__intro">
            <h1 class="header__title">Личный кабинет</h1>
        </div>
    </header>

    <main class="main container">
        <div style="background: #d4edda; padding: 25px; border-radius: 10px; margin: 20px 0;">
            <h2 style="color: #155724;">Добро пожаловать, <?= $user['name'] ? $user['name'] : $user['login'] ?>!</h2>
            <p>Вы вошли как: <strong><?= $user['role'] ?></strong></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin: 30px 0;">
            <div style="background: white; padding: 20px; border-radius: 10px; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="color: #007bff;">Информация о пользователе</h3>
                <p><strong>Логин:</strong> <?= $user['login'] ?></p>
                <p><strong>Имя:</strong> <?= $user['name'] ? $user['name'] : 'Не указано' ?></p>
                <p><strong>Фамилия:</strong> <?= $user['surname'] ? $user['surname'] : 'Не указана' ?></p>
                <p><strong>Email:</strong> <?= $user['email'] ? $user['email'] : 'Не указан' ?></p>
                <p><strong>Роль:</strong> <?= $user['role'] ?></p>
            </div>

            <div style="background: white; padding: 20px; border-radius: 10px; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="color: #28a745;">Действия</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">
                        <a href="/great/" style="color: #007bff; text-decoration: none;">🏛️ Посмотреть музеи</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="/articles/" style="color: #007bff; text-decoration: none;">📚 Читать статьи</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="/sculpture/" style="color: #007bff; text-decoration: none;">🗿 Скульптуры</a>
                    </li>
                    <li>
                        <a href="../login/logout.php" style="color: #dc3545; text-decoration: none;">🚪 Выйти из системы</a>
                    </li>
                </ul>
            </div>
        </div>

        <div style="margin-top: 30px; padding: 20px; background: #e9ecef; border-radius: 10px;">
            <h3>Практическая работа №9: Личный кабинет пользователя</h3>
            <p>Реализован личный кабинет с отображением информации о пользователе и защитой доступа через проверку сессии.</p>
        </div>
    </main>

    <?php include "../../include/footer.html" ?>
</body>
</html>