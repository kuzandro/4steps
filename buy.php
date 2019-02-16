<!DOCTYPE HTML>
<html lang="ru">
<head>
<link href="style.css" rel="stylesheet" />
<meta charset="utf-8">
<?php
$brand=$_GET['brand'];
$model=$_GET['model'];
$color=$_GET['color'];
echo '<title>4step | '.$brand.' '. $model.' '.$color.'</title>'; 
?>
</head>
<body>
<div class="main">

<div class="header">
<div class="logo"><a href="index.php"><img src="logo.jpg" width="521" height="150"></a></div>
<?php
session_start();
if (!isset($_SESSION['good_count'])) {
    $_SESSION['good_count']=0;
}
echo '<a href="cartp.php">Корзина</a> '.$_SESSION['good_count'].' <a href="clearcart.php">Очистить</a>';

if (!isset($_SESSION['login']) and !isset($_SESSION['password'])) {
echo'<form class="login" method="post" action="login.php">
Логин <input type="text" size="20" name="log" class="log" /><br />
Пароль <input type="password" size="20" name="pass" class="pass" /><br />
<a href="regp.php">Регистрация</a>&emsp; <a href="">Забыли пароль?</a><br />
<input type="submit" value="Войти" />
</form>';
}
else {
    $db_host = 'localhost';
    $db_name = '4steps';
    $db_username = 'kuza';
    $db_password = '123';
    $db_table_to_show = 'goods';

    $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
        or die("Could not connect: " . mysql_error());


    mysql_select_db($db_name, $connect_to_db)
        or die("Could not select DB: " . mysql_error());

    $log=$_SESSION['login'];
    $pass=$_SESSION['password'];

    $result = mysql_query("SELECT * FROM users where login='$log' and password='$pass'");
    while ($row = mysql_fetch_assoc($result)) {
    $name=$row['name'];
    $surname=$row['surname'];
    echo $name.' '.$surname;
    echo '<form action="logout.php"><input type="submit" value="Выйти"></form>';
}
    mysql_close($connect_to_db);
}
?>
</div>
<div class="nav">
<div class="all"><a href="index.php">Все модели</a></div>

<a href="brand.php?brand=Adidas">Adidas</a> &emsp; <a href="brand.php?brand=Nike">Nike</a> &emsp; <a href="brand.php?brand=Puma">Puma</a> &emsp; <a href="brand.php?brand=Reebok">Reebok</a> &emsp; <a href="brand.php?brand=New Balance">New Balnce</a> &emsp; <a href="brand.php?brand=Vans">Vans</a> &emsp; <a href="brand.php?brand=Lacoste">Lacoste</a> 
</div>

<div class="aside">
    <form method="post" action="search.php">
Тип поиска <select name="searchtype" size="1">
<option selected value="model">По модели</option>
<option value="color">По цвету</option>
<option value="size">По размеру</option>
</select>
<input type="text" name="searchterm" size="20" />
<input type="submit" value="Искать" />
</form>
</div>

<?php
$date=date("F j, Y, g:i a");
echo '<div class="article">';
echo '<h2>Оформление заказа</h2>';
$allcost=$_POST["allcost"];
$allchosen=$_POST["allchosen"];
$prises=$_POST["prises"]; 
echo $allchosen.'<br />';
echo $prises.'<br />';
echo '<b>Общая стоимость:</b> '.$allcost;
echo '<form method="post" action="tothebase.php">
<input type="hidden" name="allchosen" value="'.$allchosen.'" />
<input type="hidden" name="allcost" value="'.$allcost.'" />
<input type="hidden" name="prises" value="'.$prises.'" />
<input type="hidden" name="date" value="'.$date.'" />
<b>Ваше имя</b> <input type="text" name="name" /><br />
<b>Адрес доставки</b><br /> <textarea name="addres" cols="30" rows="15"></textarea><br />
<b>Контактный телефон</b> <input type="text" name="phone" /><br />
<input type="reset" value="Очистить" />
<input type="submit" value="Оформить заказ" />
</form>';

?>

</div>
<div class="footer"></div>
</body>
</html>