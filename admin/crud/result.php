<?php
    // подключаем конфигурационный файл приложения
    require '../configDB.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Статьи</title>
</head>
<body>
    <!-- меню + баннер -->
    <header class="header">
        <!-- вставка меню -->
        <?php include ROOT . "/include/header.php" ?>
        <!-- вставка баннера -->
        <div class="header__intro">
            <h1 class="header__title">Музеи мира</h1>
        </div>
    </header>

    <!-- контент -->
    <main class="main container" style="margin: 30px 0px">
        <?php 
            if ($_GET['action'] == "create") {
                echo "
                    <div style='width:75%; margin:50px auto'>
                        <img src='/images/result/create.jpg' width='300px'>
                        <h1>Запись успешно добавлена</h1>
                    </div>";
            } 
            elseif ($_GET['action'] == "update") {
                $page = $_GET['page'] == 'great' ? 'great' : "{$_GET['page']}?id={$_GET['id']}";
                echo "
                    <div style='width:75%; margin:50px auto'>
                        <img src='/images/result/update.jpg' width='300px'>
                        <h1 style='margin: 0 0 50px;'>Запись успешно редактирована</h1>
                        <a class='title__btn' href='/$page'>Просмотреть запись</a>
                    </div>";
            }
            elseif ($_GET['action'] == "delete") {
                $page = $_GET['page'];
                echo "
                    <div style='width:75%; margin:50px auto'>
                        <img src='/images/result/delete.jpg' width='300px'>
                        <h1 style='margin: 0 0 50px;'>Запись успешно удалена</h1>
                        <a class='title__btn' href='/$page'>В категорию</a>
                        <a class='title__btn' href='/'>На главную</a>
                    </div>";
            }        
            elseif ($_GET['action'] == "error") {
                echo "
                    <div style='width:75%; margin:50px auto'>
                        <img src='/images/result/error.jpg' width='300px'>
                        <h1>Произошла ошибка</h1>
                    </div>";
            }
        ?>
    </main>

    <!-- футер -->
    <footer class="footer">
        <!-- вставка футера -->
        <?php include ROOT . "/include/footer.html"; ?>
    </footer>
</body>
</html>