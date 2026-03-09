<?php
header('Content-Type:application/json');
session_start();
$db['hostname'] = 'localhost';
$db['username'] = 'customer_duro';
$db['password'] = 'fI06li!2'; 
$db['database'] = 'customer_durotech';
$link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);

date_default_timezone_set('Asia/Kolkata');
$site_url = "https://www.durotechindustries.com.au/";
mysqli_query($link,"SET SESSION SQL_MODE := ''");

?>