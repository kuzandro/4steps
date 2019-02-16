<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$brand=$_POST["brand"];
$model=$_POST["model"]; 
$sex=$_POST["sex"];
$size=$_POST["size"]; 
$color=$_POST["color"];
$cost=$_POST["cost"];

$_SESSION['good_count']=$_SESSION['good_count']+1;
$incart=$_SESSION['good_count'] - 1;

$_SESSION['id'][$incart] = $product_id;
$_SESSION['model'][$incart] = $model;
$_SESSION['brand'][$incart] = $brand;
$_SESSION['sex'][$incart] = $sex;
$_SESSION['size'][$incart] = $size;
$_SESSION['color'][$incart] = $color;
$_SESSION['cost'][$incart] = $cost;

echo 'Товар добавлен <a href="cartp.php">Оформить покупку</a> <a href="index.php">На главную</a>';

?>