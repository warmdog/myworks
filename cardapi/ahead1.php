<?php
//session_start();
header("Content-type:text/html;charset=utf-8");
$money=$_GET['money'];
$body=$_GET['body'];
$store=$_GET['store'];
$body = str_replace("'","",$body );
$store=str_replace("'","",$store );

$body=urlencode($body);
$store=urlencode($store);
//$district=$_GET['quYu'];
//$village=$_GET['sheQu'];
//$_SESSION['district']=$district;
//$_SESSION['village']=$village;
header("refresh:0;url=http://admin.shequjia.cn/Wxpay/example/kjsapi.php?money=$money&body=$body&store=$store");


?>