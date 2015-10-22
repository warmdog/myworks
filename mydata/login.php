<?php 
include('testmysql.php');
if(!isset($_POST['submit'])){ 
	exit("非法访问");

}
$username=$_POST['username'];
$password=$_POST['password'];
//echo $username;
//echo $password;
$sql="select * from admin where username='$username' and password='$password'";
$row=$pdo->query($sql);
//$qw=$row->fetchAll();
//echo sizeof($qw);
foreach ($row as $key ) {
	//echo"dwdw";
	if($key['username']==$username&&$key['password']==$password){ 
			//echo "dengrucheng";
			session_start();
			$code=mt_rand(0,1000000);
			$_SESSION['code']=$code;
			$code=md5($code);
			echo "<script language='javascript'>window.location.href='admin-index.php?code=$code' ;</script>";
			exit;
	}
}
$qw=$row->fetchAll();
if(sizeof($qw)==0){ 
		echo "<script language='javascript'>alert('输入的用户名或密码错误,请重新输入') ;window.location.href='login.html' ;</script>";
	}
//echo "<script language='javascript'>alert('输入的用户名已存在,请重新输入') ;window.location.href='index.html' ;</script>";
?>





