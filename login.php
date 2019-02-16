<?php
header('Content-Type: text/html; charset=utf-8');
$log=$_POST["log"];  
$pass=$_POST["pass"];

if (!$log or !$pass) {
echo "Введите данные";
exit;
}
if (!get_magic_quotes_gpc()) {
$log=addslashes($log);
$pass=addslashes($pass);

}
@$db=new mysqli('localhost','kuza','123','4steps');
if(mysqli_connect_errno()){
echo "Ошибка базы данных";
exit;
}
$query="select * from users where login='$log' and password='$pass'";
$result=mysqli_query($db, $query);
$num_results=mysqli_num_rows($result);
if ($num_results>0) {
	session_start(); 
 $_SESSION['login']=$log;
 $_SESSION['password']=$pass;
 echo $db->affected_rows."Вы вошли <a href='index.php'>Вернуться на главную</a>";

}
else{
 echo "Неверный логин или пароль <a href='index.php'>Вернуться на главную</a> ";
}
?>

