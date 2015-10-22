<?php
session_start();
$openid=$_SESSION['openid'];
include_once"testmysql.php";
$phone=$_POST['phone'];
$adress=$_POST['address'];
$name=$_POST['name'];
$sql="update new_users set phone='$phone',adress='$adress',name='$name' where openid='$openid'";
if($pdo->exec($sql)){ 
	echo "添加成功~";
}
