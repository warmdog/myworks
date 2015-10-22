<?php 
include_once"testmysql.php";
session_start();
$openid=$_SESSION['openid'];
$money=$_GET['money'];
$body=$_GET['body'];
$store=$_GET['store'];
date_default_timezone_set('PRC');
$date=date("Y-m-d H:i:s");
$sql="insert into new_orders(id,openid,fee,paystate,time,goods,store) values('','$openid','$money','','$date','$body','$store')";
if($pdo->exec($sql)){ 
	header("refresh:0;url=http://admin.shequjia.cn/Wxpay/example/newstorejsapi.php?money=$money&body=$body&store=$store");
}
?>