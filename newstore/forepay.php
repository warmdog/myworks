<?php
ob_start(); 
session_start();
header("Content-type: text/html; charset=utf-8");
include_once"testmysql.php";
date_default_timezone_set('PRC');
$date=date("Y-m-d H:i:s");
$openid=$_SESSION['openid'];
$money=$_GET['money'];
$body=$_GET['body'];
$store=$_GET['store'];
if($_SESSION['aa']==false){
	$sql="insert into new_orders(id,openid,fee,paystate,time,goods,store) values('','$openid','$money','','$date','$body','$store')";
	$_SESSION['aa']=true;
	if($pdo->exec($sql)){ 
		$body=urlencode($body);
		$store=urlencode($store);
		//header("refresh:0;url=http://baidu.com");
		//echo "<script type='text/javascript' src='js/jquery.min.js'></script>";
		/*echo "<script>
		$(function(){ 
				window.location.href='http://admin.shequjia.cn/Wxpay/example/newstorejsapi.php?money=$money&body=$body&store=$store';
		});
				
			  </script>";*/
		header("Location:http://admin.shequjia.cn/Wxpay/example/newstorejsapi.php?money=$money&body=$body&store=$store");
			//header("Location: index.php?money=$money&body=$body&store=$store");
		//exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type="text/javascript">

</script>
</body>
</html>