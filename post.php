<?php

header('Content-Type: text/html; charset=utf-8');
echo '1';
	$db_host = 'localhost';
    $db_name = '4steps';
    $db_username = 'kuza';
    $db_password = '123';
    $db_table_to_show = 'goods';

    // соединяемся с сервером базы данных
    $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
		or die("Could not connect: " . mysql_error());
echo '1';

    // подключаемся к базе данных
    mysql_select_db($db_name, $connect_to_db)
		or die("Could not select DB: " . mysql_error());


$result = mysql_query("SELECT * FROM goods");

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
        
    echo '<img src="'.$picture.'" height="250" width="250" /><br />';
    echo $brand.' '. $model.' '.$color.'<br />';
    echo $sex.'<br />';
    echo 'Доступные размеры:'.$size.'<br />';
    echo 'Цена: '.$cost.' руб.';
    echo '<p>'.$thumbnail.'</p>';
}
mysql_close($connect_to_db);
?>