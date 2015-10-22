<?php 
include('testmysql.php');
$coin=$_POST['num'];
$openid=$_POST['customerId'];
date_default_timezone_set('PRC');
$date=date("Y-m-d H:i:s");
$sql="UPDATE users SET coin=$coin ,date='$date' where openid='$openid'";
if($pdo->exec($sql)){ 
	echo "success";
}