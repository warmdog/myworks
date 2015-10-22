<?php 
include_once"testmysql.php";
$openid=$_POST['openid'];
$bonus=(int)$_POST['bonus'];
$goodsname=$_POST['goodsname'];
$sql="update new_users set bonus=bonus-$bonus where openid='$openid'";
$sql1="insert into new_users_exchange(id,openid,exchange,state) values('','$openid','$goodsname','0')";
if(($pdo->exec($sql))&&($pdo->exec($sql1))){ 
	echo "兑换成功！";
}