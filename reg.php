<?php
header('Content-Type: text/html; charset=utf-8');
$pass=$_POST["pass"];
$log=$_POST["log"];
$name=$_POST["name"]; 
$email=$_POST["email"];
$surname=$_POST["surname"]; 
$phone=$_POST["phone"];
if (!$log || !$email || !$pass) {
echo "Введите данные";
exit;
}
if (!get_magic_quotes_gpc()) {
$log=addslashes($log);
$email=addslashes($email);
$pass=addslashes($pass);
$name=addslashes($name);
$surname=addslashes($surname);
$phone=addslashes($phone);
}
@$db=new mysqli('localhost','kuza','123','4steps');
if(mysqli_connect_errno()){
echo "Ошибка базы данных";
exit;
}
$query="select * from users where login='$log'";
$result=mysqli_query($db, $query);
$num_results=mysqli_num_rows($result);
 if ($num_results>0) {
 echo "Такой логин уже есть в базе";
}
else{
$query="insert into users values('".NULL."','".$log."','".$pass."','".$email."','".$name."','".$surname."','".$phone."')";
$result=$db->query($query);
if($result) echo $db->affected_rows."Пользователь добавлен <a href='index.php'>Вернуться на главную</a>";
}
?>