<?php
// уничтожение сессии или выход из аккаунта
session_start();
session_destroy();
// редирект на страницу регистрации
header("Location:/personal/registration/");
exit;