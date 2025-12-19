<?php
session_start();
?>

<div class="header__inner">
    <div><img width="100" src="/images/logo.png" alt=""></div>
    <nav class="header__nav nav">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="/" class="nav__link">Главная</a>
            </li>
            <li class="nav__item">
                <a href="/great/" class="nav__link">Великие музеи</a>
            </li>
            <li class="nav__item">
                <a href="/articles/" class="nav__link">Статьи</a>
            </li>
            <li class="nav__item">
                <a href="/painting/" class="nav__link">Живопись</a>
            </li>
            <li class="nav__item">
                <a href="/sculpture/" class="nav__link">Скульптура</a>
            </li>
            <li class="nav__item">
                <a href="/cities/" class="nav__link">Города</a>
            </li>
            
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Если пользователь авторизован -->
                <li class="nav__item">
                    <a href="/personal/account/" class="nav__link" style="color: #28a745;">
                        <?= $_SESSION['user']['name'] ? $_SESSION['user']['name'] : $_SESSION['user']['login'] ?>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="/personal/login/logout.php" class="nav__link" style="color: #dc3545;">Выйти</a>
                </li>
            <?php else: ?>
                <!-- Если пользователь не авторизован -->
                <li class="nav__item">
                    <a href="/personal/login/" class="nav__link">Войти</a>
                </li>
                <li class="nav__item">
                    <a href="/personal/registration/" class="nav__link">Регистрация</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>