<?php
require "../admin/connectDB.php";

$mysqli = connectDB();
$result = $mysqli->query("SELECT * FROM articles WHERE page = 'sculpture' LIMIT 3");
$sculptures = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Скульптуры</title>
</head>
<body>
    <?php include "../include/header.php" ?>
    
    <main class="main container">
        <h1>Скульптуры</h1>
        <?php foreach ($sculptures as $sculpture): ?>
            <div style="border:1px solid #ccc; padding:15px; margin:10px 0;">
                <h2><?= $sculpture['title'] ?></h2>
                <p><?= $sculpture['text'] ?></p>
            </div>
        <?php endforeach; ?>
    </main>

    <?php include "../include/footer.html" ?>
</body>
</html>