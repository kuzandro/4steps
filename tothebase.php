<?php
header('Content-Type: text/html; charset=utf-8');
$allchosen=$_POST["allchosen"];
$allcost=$_POST["allcost"];
$prises=$_POST["prises"]; 
$name=$_POST["name"];
$addres=$_POST["addres"]; 
$phone=$_POST["phone"];
$date=$_POST["date"];

if (!$name and !$addres and !$phone) {
echo "Введите данные";
exit;
}

if (!get_magic_quotes_gpc()) {
$allchosen=addslashes($allchosen);
$allcost=addslashes($allcost);
$prises=addslashes($prises);
$name=addslashes($name);
$addres=addslashes($addres);
$phone=addslashes($phone);
}

@$db=new mysqli('localhost','kuza','123','4steps');
if(mysqli_connect_errno()){
echo "Ошибка базы данных";
exit;
}

$query="insert into boughts values('".NULL."','".$allchosen."','".$prises."','".$allcost."','".$name."','".$addres."','".$phone."','".$date."')";
$result=$db->query($query);
if($result) echo $db->affected_rows."Заказ оформлен <a href='index.php'>Вернуться на главную</a>";

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
?>