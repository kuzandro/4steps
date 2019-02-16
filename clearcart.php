<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$incart=$_SESSION['good_count'] - 1;

unset($_SESSION['id'][$incart]);
unset($_SESSION['model'][$incart]);
unset($_SESSION['brand'][$incart]);
unset($_SESSION['sex'][$incart]);
unset($_SESSION['size'][$incart]);
unset($_SESSION['color'][$incart]);
unset($_SESSION['cost'][$incart]);

unset($_SESSION['good_count']);
echo 'Корзина очищена <a href="index.php">Вернуться на главную</a>';
?>