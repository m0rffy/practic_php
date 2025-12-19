<?php
require "../configDB.php";
require "../connectDB.php";

if ($_POST) {
    $mysqli = connectDB();
    $login = $mysqli->real_escape_string($_POST['login']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $mysqli->query("INSERT INTO users (login, password, role) VALUES ('$login', '$password', 'user')");
    echo "<p style='color:green'>Пользователь зарегистрирован!</p>";
}
?>

<h2>Регистрация пользователя</h2>
<form method="POST">
    <input type="text" name="login" placeholder="Логин" required><br><br>
    <input type="password" name="password" placeholder="Пароль" required><br><br>
    <button type="submit">Зарегистрировать</button>
</form>