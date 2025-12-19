<?php
// Простая форма добавления
if ($_POST['title']) {
    $mysqli = connectDB();
    $mysqli->query("INSERT INTO articles (title, page, text) VALUES ('{$_POST['title']}', 'great', '{$_POST['text']}')");
    echo "Запись добавлена!";
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Название" required>
    <textarea name="text" placeholder="Текст" required></textarea>
    <button>Добавить</button>
</form>