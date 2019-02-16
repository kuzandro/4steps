<!DOCTYPE HTML>
<html lang="ru">
<head>
<link href="style.css" rel="stylesheet" />
<meta charset="utf-8">
<title>4step | Админка</title> 
</head>
<body>
<div class="main">

<div class="header">
<div class="logo"><a href="index.php"><img src="logo.jpg" width="521" height="150"></a></div>
<?php
session_start();
if (!isset($_SESSION['login']) and !isset($_SESSION['password'])) {
echo'<form class="login" method="post" action="login.php">
Логин <input type="text" size="20" name="log" class="log" /><br />
Пароль <input type="password" size="20" name="pass" class="pass" /><br />
<a href="reg.html">Регистрация</a>&emsp; <a href="">Забыли пароль?</a><br />
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

<div class="article">

<h2>Добавить товар</h2>

<form method="post" action="save.php" name="f1">

Бренд<select name="brand" size="1">
<option selected value="Adidas">Adidas</option>
<option value="Nike">Nike</option>
<option value="Puma">Puma</option>
<option value="Reebok">Reebok</option>
<option value="New Balance">New Balance</option>
<option value="Vans">Vans</option>
<option value="Lacoste">Lacoste</option>
</select>
<br />
Категория<select name="category" size="1">
<option selected value="Стиль">Стиль</option>
<option value="Бег">Бег</option>
<option value="Тренировка">Тренировка</option>
<option value="Футбол">Футбол</option>
<option value="Баскетбол">Баскетбол</option>
</select>
<br /><br />
Модель<input type="text" name="model" size="20" /><br />
Пол<input type="radio" name="sex" value="Мужские" checked /> Мужской <input type="radio" name="sex" value="Женские" /> Женский<br />
Размер<input type="text" name="size" size="20" /><br />
Цвет <input type="text" name="color" size="20" /><br />
Описание <input type="text" name="thumbnail" cols="40" rows="3"><br />
Url картинки <input type="text" name="picture" size="20" value="goods/" /><br />
Цена <input type="text" name="cost" size="20" />
<input type="reset" value="Очистить" />
<input type="submit" value="Добавить" />

</form>


<h2>Заказы</h2>
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
echo '<table border="1">';
echo '<tr>
<td><b>id</b></td>
<td><b>Покупки</b></td>
<td><b>Цены</b></td>
<td><b>Общая стоимость</b></td>
<td><b>Имя</b></td>
<td><b>Адрес</b></td>
<td><b>Телефон</b></td>
<td><b>Дата</b></td>
</tr>';
$result = mysql_query("SELECT * FROM boughts");
while ($row = mysql_fetch_assoc($result)) {
$id=$row['id'];
$allchosen=$row['allchosen'];
$prises=$row['prises'];
$allcost=$row['allcost']; 
$name=$row['name'];
$addres=$row['addres']; 
$phone=$row['phone'];
$date=$row['date'];


echo '<tr>';
   echo '<td>'.$id.'</td>';
   echo '<td>'.$allchosen.'</td>';
   echo '<td>'.$prises.'</td>';
   echo '<td>'.$allcost.'</td>';
   echo '<td>'.$name.'</td>';
   echo '<td>'.$addres.'</td>';
   echo '<td>'.$phone.'</td>';
   echo '<td>'.$date.'</td>';
   echo '</tr>';
}

mysql_close($connect_to_db);
?>

</div>
</div>
</body>
</html>
