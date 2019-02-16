<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
unset($_SESSION['login']);

unset($_SESSION['password']);

echo 'Вы вышли. <a href="index.php">Вернуться на главную</a>';

?>