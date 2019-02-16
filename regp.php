<!DOCTYPE HTML>
<html lang="ru">
<head>
<link href="style.css" rel="stylesheet" />
<meta charset="utf-8">
<title>4step | Регистрация</title>
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

<div class="article">
<h2>Регистрация</h2>
<form method="post" action="reg.php" name="f1" class="f1" id="f1">
<fieldset>
<legend>***</legend>
Логин <span class="star">*</span> <input type="text" size="30"  name="log" class="log" id="log" /><br />
E-mail <span class="star">*</span> <input type="text" size="30" name="email" class="email" id="email" /><br />
Пароль <span class="star">*</span> <input type="password" size="30" name="pass" class="pas" id="pas" /><br />
Повторите пароль <span class="star">*</span> <input type="password" size="30" name="password1" class="password1" id="password1" />

</fieldset>
<fieldset>
<legend>Личная информация</legend>
Имя<input type="text" size="30"  name="name" class="imya" id="imya" /><br />
Фамилия <input type="text" size="30"  name="surname" class="surname" id="surname" /><br />
Телефон <input type="text" size="30"  name="phone" class="phone" id="phone" /><br />

</fieldset>

<input type="reset" value="Очистить" />
<input type="submit" value="Подтвердить" />
</form>
</div>

</div>
<div class="footer"></div>
</body>
</html>