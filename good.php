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

$db_host = 'localhost';
    $db_name = '4steps';
    $db_username = 'kuza';
    $db_password = '123';
    $db_table_to_show = 'goods';


    $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
        or die("Could not connect: " . mysql_error());

    mysql_select_db($db_name, $connect_to_db)
        or die("Could not select DB: " . mysql_error());

$result = mysql_query("SELECT * FROM goods WHERE brand='$brand' and model='$model' and color='$color'");
while ($row = mysql_fetch_assoc($result)) {
$brand=$row['brand'];
$category=$row['category'];
$model=$row['model']; 
$sex=$row['sex'];
$size=$row['size']; 
$color=$row['color'];
$thumbnail=$row['thumbnail'];
$picture=$row['picture'];
$cost=$row['cost'];
$id=$row['id'];
echo '<div class="article">';
echo '<div class="goodphoto"><img src="'.$picture.'" width="250" height="250"></div>';
echo '<div class="goodinfo">';
echo '<h2>'.$brand.' '. $model.' '.$color.'</h2>';
echo $sex.'<br />';

$sizes=explode(' ', $size);
echo '<b>Доступные размеры:</b> ';
echo '<form method="post" action="cart.php">';
for ($i=0; $i<count($sizes); $i++){
echo '<input type="radio" name="size" value="'.$sizes[$i].'">'.$sizes[$i];
}

echo '<p><b>Цена:</b> '.$cost.'  
<input type="hidden" name="id" value="'.$id.'" />
<input type="hidden" name="brand" value="'.$brand.'" />
<input type="hidden" name="model" value="'.$model.'" />
<input type="hidden" name="sex" value="'.$sex.'" />
<input type="hidden" name="color" value="'.$color.'" />
<input type="hidden" name="cost" value="'.$cost.'" />
<input type="submit" value="В корзину" /></p>'; 
echo '</form>';

echo '</div> <div class="goodtext">';
echo '<p>'.$thumbnail.'</p></div>';
echo '<div class="more">';

$res = mysql_query("SELECT * FROM goods WHERE model='$model' and color!='$color'");
$num_results=mysql_num_rows($res);
if ($num_results!=0){
echo '<h3>Другие цвета</h3>';
while ($rows = mysql_fetch_assoc($res)) {
    $picture=$rows['picture'];
    $brand=$rows['brand'];
    $color=$rows['color'];
    $model=$rows['model']; 

  echo '<a href="good.php?brand='.$brand.'&model='.$model.'&color='.$color.'"><img src="'.$picture.'" width="250" height="250"/></a>';
}
}
echo '</div>';
}
?>

</div>
<div class="footer"></div>
</body>
</html>