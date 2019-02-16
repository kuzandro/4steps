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
echo '<a href="cartp.php">Корзина</a> '.$_SESSION['good_count'];
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
echo '<div class="article">';
echo '<h2>Корзина</h2>';
if ($_SESSION['good_count']>0) {
echo '<table border="1">';
echo '<tr>
<td><b>Бренд</b></td>
<td><b>Модель</b></td>
<td><b>Цвет</b></td>
<td><b>Пол</b></td>
<td><b>Размер</b></td>
<td><b>Цена</b></td>
</tr>';
$allcost=0;
for ($i=0; $i<$_SESSION['good_count']; $i++){
    echo '<tr>';
   echo '<td>'.$_SESSION['brand'][$i].'</td>';
   echo '<td>'.$_SESSION['model'][$i].'</td>';
   echo '<td>'.$_SESSION['color'][$i].'</td>';
   echo '<td>'.$_SESSION['sex'][$i].'</td>';
   echo '<td>'.$_SESSION['size'][$i].'</td>';
   echo '<td>'.$_SESSION['cost'][$i].'</td>';
   echo '</tr>';
   $allcost = $allcost + $_SESSION['cost'][$i];
   $allchosen = $allchosen.'<br />'.$_SESSION['id'][$i].' '.$_SESSION['brand'][$i].' '.$_SESSION['model'][$i].' '.$_SESSION['color'][$i].' '.$_SESSION['sex'][$i].' '.$_SESSION['size'][$i];
   $prises = $prises.'<br />'.$_SESSION['cost'][$i];
}
echo '</table>';
echo 'Общая стоимость: '.$allcost.'<br />';
echo '<a href="clearcart.php">Очистить корзину</a> 
<form method="post" action="buy.php">
<input type="hidden" name="allchosen" value="'.$allchosen.'" />
<input type="hidden" name="prises" value="'.$prises.'" />
<input type="hidden" name="allcost" value="'.$allcost.'" />
<input type="submit" value="Оформить заказ" />
</form>';
}
else{
    echo 'Ваша корзина пуста';
}


?>

</div>
<div class="footer"></div>
</body>
</html>