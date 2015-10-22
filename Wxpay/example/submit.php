<?php 
header("Content-type:text/html;charset=utf-8");
include('testmysql.php');
session_start(); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-control:no-cache,no-store,must-revalidate");
header("Pragma:no-cache");
header("Expires:-1");

if(isset($_POST['originator'])) { 
 
    if($_POST['originator'] == $_SESSION['code']){ 
 			$fee=$_POST['fee'];
			$body=$_POST['body'];
			$store=$_POST['store'];
//echo $store."ddwad";
//echo $body;

			$paystate=$_POST['paystate'];
			$username=$_POST['username'];
			$phone=$_POST['phone'];
			setcookie("phone",$phone,time()+3600*24*7*100);
			//echo $phone."www";
			//echo $_COOKIE["phone"];
			unset($_SESSION['code']);
			$address1=$_POST['aa'];
			$address2=$_POST['detailed'];
			$address=$address1.$address2;
			$sql="insert into users values('','$username','$phone','$address','$fee','$paystate','$store','$body','','')";
			if ($pdo->exec($sql)) {
					echo "<link href='css/bootstrap.min.css' rel='stylesheet'>";
					header("refresh:1;url=http://wx.shequjia.cn/mybootstrap");
					echo "<p style='font-size:50px; margin-top:50px;' class=' text-center'>购买成功,2秒后返回首页</p>";
				exit;
	# code..
			};
        // 处理该表单的语句，省略 
 
    }else{ 
    	echo "<link href='css/bootstrap.min.css' rel='stylesheet'>";
 		echo "<p style='font-size:50px; margin-top:50px;' class=' text-center'>请不要刷新本页面或重复提交表单！</p>";
  
 
    } 

 
} 
if((isset($_SESSION['phone']))&&(!isset($_POST['originator']))){ 
	$code=$_POST['code'];
	if($code=$_SESSION['code']){

		unset($_SESSION['code']);
		$fee=$_SESSION['fee'];
		$body=$_SESSION['body'];
		$store=$_SESSION['store'];
		$address=$_SESSION['adress'];
		$username=$_SESSION['username'];
		$phone=$_SESSION['phone'];
		$paystate=$_SESSION['paystate'];
		$sql="insert into users values('','$username','$phone','$address','$fee','$paystate','$store','$body','','')";
			if ($pdo->exec($sql)) {
					echo "<link href='css/bootstrap.min.css' rel='stylesheet'>";
					header("refresh:1;url=http://wx.shequjia.cn/mybootstrap");
					echo "<p style='font-size:50px; margin-top:50px;' class=' text-center'>购买成功,2秒后返回首页</p>";
				exit;
	# code..
			};
}else{ 
	echo "<link href='css/bootstrap.min.css' rel='stylesheet'>";
 	echo "<p style='font-size:50px; margin-top:50px;' class=' text-center'>请不要刷新本页面或重复提交表单！</p>";
}

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>完成</title>
</head>
<body>
	
</body>
<script type="text/javascript">
	javascript:window.history.forward(1);
</script>
</html>