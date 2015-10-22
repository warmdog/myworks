<?php 
header("Content-type:text/html;charset=utf-8");
include('testmysql.php');
session_start(); 


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
			$time=$_POST['bb'];
			$license=$_POST['license'];
			$address1=$_POST['aa'];
			$address2=$_POST['detailed'];
			$address=$address1.$address2;
			$sql="insert into users values('','$username','$phone','$address','$fee','$paystate','$store','$body','$license','$time')";
			if ($pdo->exec($sql)) {
					echo "<link href='css/bootstrap.min.css' rel='stylesheet'>";
					header("refresh:2;url=http://wx.shequjia.cn/mybootstrap");
					echo "<p style='font-size:50px; margin-top:50px;' class=' text-center'>购买成功,2秒后返回首页</p>";
				exit;
	# code..
			};
        // 处理该表单的语句，省略 
 
    }else{ 
 
        echo '请不要刷新本页面或重复提交表单！'; 
 
    } 

 
} 





?>