<?php
header('Content-Type: text/html; charset=utf-8');
$brand=$_POST["brand"];
$category=$_POST["category"];
$model=$_POST["model"]; 
$sex=$_POST["sex"];
$size=$_POST["size"]; 
$color=$_POST["color"];
$thumbnail=$_POST["thumbnail"];
$picture=$_POST["picture"];
$cost=$_POST["cost"];
if (!$brand || !$category || !$model) {
echo "Введите данные";
exit;
}

if (!get_magic_quotes_gpc()) {
$brend=addslashes($brend);
$category=addslashes($category);
$model=addslashes($model);
$sex=addslashes($sex);
$size=addslashes($size);
$color=addslashes($color);
$thumbnail=addslashes($thumbnail);
$picture=addslashes($picture);
$cost=addslashes($cost);
}
mysql_query('SET NAMES utf8');
@$db=new mysqli('localhost','kuza','123','4steps');
if(mysqli_connect_errno()){
echo "Ошибка бд";
exit;
}
mysql_query('SET NAMES utf8');
$query="insert into goods values('".NULL."','".$model."','".$brand."','".$category."','".$sex."','".$color."','".$size."','".$thumbnail."','".$picture."','".$cost."')";
mysql_query('SET NAMES utf8');
$result=$db->query($query);
if($result) echo $db->affected_rows."Товар добавлен <a href='admin.html'>Вернуться в админку</a>";

?>