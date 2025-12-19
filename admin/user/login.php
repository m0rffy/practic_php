<?php
session_start();
require "../configDB.php";
require "../connectDB.php";

if ($_POST) {
    $mysqli = connectDB();
    $login = $mysqli->real_escape_string($_POST['login']);
    $password = $_POST['password'];
    
    $result = $mysqli->query("SELECT * FROM users WHERE login='$login'");
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['login'];
        echo "<p style='color:green'>✅ Вы вошли как: " . $user['login'] . "</p>";
    } else {
        echo "<p style='color:red'>❌ Неверный логин или пароль</p>";
    }
}
?>

<h2>Вход в систему</h2>
<form method="POST">
    <input type="text" name="login" placeholder="Логин" required><br><br>
    <input type="password" name="password" placeholder="Пароль" required><br><br>
    <button type="submit">Войти</button>
</form>