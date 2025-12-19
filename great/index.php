<?php
// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №4: ПОДКЛЮЧЕНИЕ К MYSQL
// =============================================
require "../admin/connectDB.php";

// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №5: CREATE ОПЕРАЦИЯ
// =============================================
if ($_POST['action'] == 'create' && !empty($_POST['title']) && !empty($_POST['text'])) {
    $mysqli = connectDB();
    $title = $mysqli->real_escape_string($_POST['title']);
    $text = $mysqli->real_escape_string($_POST['text']);
    
    // Исправляем ошибку: добавляем обязательные поля date и teaser
    $result = $mysqli->query("INSERT INTO articles (page, slag, title, date, author, teaser, text) 
                             VALUES ('great', 'new-museum', '$title', '', 'Посетитель', 'Новый музей', '$text')");
    
    if ($result) {
        $success_message = " Новый музей '$title' успешно добавлен в базу данных!";
    } else {
        $error_message = " Ошибка при добавлении музея: " . $mysqli->error;
    }
}

// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №6: UPDATE ОПЕРАЦИЯ  
// =============================================
if ($_POST['action'] == 'update' && !empty($_POST['new_title']) && !empty($_POST['id'])) {
    $mysqli = connectDB();
    $new_title = $mysqli->real_escape_string($_POST['new_title']);
    $id = intval($_POST['id']);
    
    $result = $mysqli->query("UPDATE articles SET title='$new_title' WHERE id=$id");
    
    if ($result) {
        $success_message = " Название музея успешно обновлено!";
    } else {
        $error_message = " Ошибка при обновлении: " . $mysqli->error;
    }
}

// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №7: DELETE ОПЕРАЦИЯ
// =============================================
if ($_POST['action'] == 'delete' && !empty($_POST['id'])) {
    $mysqli = connectDB();
    $id = intval($_POST['id']);
    
    // Сначала получаем название музея для сообщения
    $museum_result = $mysqli->query("SELECT title FROM articles WHERE id=$id");
    $museum = $museum_result->fetch_assoc();
    $museum_title = $museum['title'];
    
    $result = $mysqli->query("DELETE FROM articles WHERE id=$id");
    
    if ($result) {
        $success_message = " Музей '$museum_title' успешно удален из базы данных!";
    } else {
        $error_message = " Ошибка при удалении: " . $mysqli->error;
    }
}

// =============================================
// ПРАКТИЧЕСКАЯ РАБОТА №4: READ ОПЕРАЦИЯ
// =============================================
$mysqli = connectDB();
$result = $mysqli->query("SELECT * FROM articles WHERE page = 'great'");
if ($result) {
    $museums = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $museums = [];
    $error_message = "Ошибка запроса к базе данных: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Великие музеи</title>
</head>
<body>
    <header class="header">
        <?php include "../include/header.php" ?>
        <div class="header__intro">
            <h1 class="header__title">Великие музеи</h1>
        </div>
    </header>

    <main class="main container">
        <!-- Сообщения о результатах операций -->
        <?php if (isset($success_message)): ?>
            <div style="color:green; text-align:center; padding:15px; background:#d4edda; border:2px solid #c3e6cb; border-radius:8px; margin:20px 0; font-size:18px;">
                <?= $success_message ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div style="color:red; text-align:center; padding:15px; background:#f8d7da; border:2px solid #f5c6cb; border-radius:8px; margin:20px 0; font-size:18px;">
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <!-- ============================================= -->
        <!-- ПРАКТИЧЕСКАЯ РАБОТА №5: ФОРМА CREATE -->
        <!-- ============================================= -->
        <section style="background:#f8f9fa; padding:30px; margin:40px 0; border-radius:12px; border:3px solid #28a745; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
            <h2 class="title__heading" style="text-align:center; color:#28a745; margin-bottom:25px;">
                📝 ДОБАВЛЕНИЕ НОВОГО МУЗЕЯ
            </h2>
            <form method="POST" style="text-align:center;">
                <input type="hidden" name="action" value="create">
                <input type="text" name="title" placeholder="Введите название музея" required 
                       style="padding:15px; width:400px; margin:12px; border:2px solid #28a745; border-radius:8px; font-size:16px;"><br>
                <textarea name="text" placeholder="Введите описание музея" required 
                          style="padding:15px; width:400px; height:150px; margin:12px; border:2px solid #28a745; border-radius:8px; font-size:16px; font-family:Arial;"></textarea><br>
                <button type="submit" style="padding:15px 40px; background:#28a745; color:white; border:none; border-radius:8px; cursor:pointer; font-size:18px; font-weight:bold; transition:background 0.3s;">
                    🏛️ ДОБАВИТЬ МУЗЕЙ В БАЗУ ДАННЫХ
                </button>
            </form>
            <p style="text-align:center; margin-top:15px; color:#666; font-style:italic;">
               
            </p>
        </section>

        <!-- ============================================= -->
        <!-- ПРАКТИЧЕСКАЯ РАБОТА №4: ВЫВОД ДАННЫХ READ -->
        <!-- ============================================= -->
        <?php if (!empty($museums)): ?>
            <h2 class="title__heading" style="text-align:center; color:#007bff; margin:40px 0;">
                📊 СПИСОК МУЗЕЕВ ИЗ БАЗЫ ДАННЫХ
            </h2>
            <p style="text-align:center; color:#666; font-style:italic; margin-bottom:30px;">
             
            </p>
            
            <?php foreach ($museums as $museum): ?>
                <article style="margin-bottom:40px; border:2px solid #e9ecef; border-radius:12px; padding:0; overflow:hidden; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
                    <div class="title" style="padding:25px;">
                        <h2 class="title__heading" style="color:#333; border-bottom:2px solid #007bff; padding-bottom:15px;">
                            <?= htmlspecialchars($museum['title']) ?>
                        </h2>
                        <div class="title__float_left">
                            <?php if (!empty($museum['image'])): ?>
                                <img class="title__img" src="../images/great/<?= htmlspecialchars($museum['image']) ?>" 
                                     alt="<?= htmlspecialchars($museum['title']) ?>" 
                                     style="border-radius:12px; box-shadow:0 4px 8px rgba(0,0,0,0.2);">
                            <?php endif; ?>
                            <div style="font-size:17px; line-height:1.7; color:#555; margin-top:20px;">
                                <?= $museum['text'] ?>
                            </div>
                            
                            <!-- ============================================= -->
                            <!-- ПРАКТИЧЕСКАЯ РАБОТА №6: ФОРМА UPDATE -->
                            <!-- ============================================= -->
                            <form method="POST" style="margin-top:30px; padding:20px; background:#e7f3ff; border-radius:10px; border:2px solid #007bff;">
                                <h3 style="color:#007bff; margin-bottom:15px;">✏️ РЕДАКТИРОВАНИЕ МУЗЕЯ</h3>
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= $museum['id'] ?>">
                                <input type="text" name="new_title" value="<?= htmlspecialchars($museum['title']) ?>" 
                                       style="padding:12px; width:350px; border:2px solid #007bff; border-radius:6px; margin-right:15px; font-size:16px;">
                                <button type="submit" style="padding:12px 25px; background:#007bff; color:white; border:none; border-radius:6px; cursor:pointer; font-size:16px; font-weight:bold;">
                                    ОБНОВИТЬ НАЗВАНИЕ
                                </button>
                                <p style="margin-top:10px; color:#007bff; font-style:italic;">
                                    
                                </p>
                            </form>
                            
                            <!-- ============================================= -->
                            <!-- ПРАКТИЧЕСКАЯ РАБОТА №7: ФОРМА DELETE -->
                            <!-- ============================================= -->
                            <form method="POST" style="margin-top:20px; text-align:center;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $museum['id'] ?>">
                                <button type="submit" onclick="return confirm('❌ ВЫ УВЕРЕНЫ, ЧТО ХОТИТЕ УДАЛИТЬ МУЗЕЙ \"<?= htmlspecialchars(addslashes($museum['title'])) ?>\" ИЗ БАЗЫ ДАННЫХ?')" 
                                        style="padding:12px 25px; background:#dc3545; color:white; border:none; border-radius:6px; cursor:pointer; font-size:16px; font-weight:bold; transition:background 0.3s;">
                                    🗑️ УДАЛИТЬ МУЗЕЙ
                                </button>
                                <p style="margin-top:10px; color:#dc3545; font-style:italic;">
                                   
                                </p>
                            </form>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align:center; padding:50px; color:#6c757d; background:#f8f9fa; border-radius:12px; margin:40px 0;">
                <h2 style="color:#6c757d; margin-bottom:20px;">🏛️ МУЗЕИ НЕ НАЙДЕНЫ</h2>
                <p style="font-size:18px;">Используйте форму выше, чтобы добавить первый музей в базу данных</p>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <?php include "../include/footer.html" ?>
    </footer>
</body>
</html>