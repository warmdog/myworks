<?php 
session_start();
$openid=$_SESSION['openid'];
$address=$_POST['addr'];
$phone=$_POST['phoneNum'];
$name=$_POST['name'];
include('testmysql.php');
$sql="UPDATE users SET address='$address',phone='$phone',name='$name' WHERE openid='$openid' ";
if($pdo->exec($sql)){ 
	echo "添加成功!";
}