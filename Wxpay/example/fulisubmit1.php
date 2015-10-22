<?php 
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-control:no-cache,no-store,must-revalidate");
header("Pragma:no-cache");
header("Expires:-1");
include('name.php');

//header('Pragma:no-cache'); 
//header("Cache-Control: no-cache, must-revalidate");
$code = mt_rand(0,1000000); 
$_SESSION['code'] = $code; 

//$paystate=$_GET["paystate"];
$body=$_GET['body'];
$str = str_replace("'","",$body );
$body=$str;
//$arr=explode("|",$body);


//echo "Wdwdwd".$c1;




//var_dump($arr);
//foreach ($arr as $key) {
	# code...
	//$strarr=explode("*",$key);
	//var_dump($strarr);
	
	//foreach ($strarr as $key1 ) {
			//echo $strarr[0]."</br>";
		//}
	//}
//echo $body;
$fee=$_GET['money'];
$store=$_GET['store'];
$str = str_replace("'","",$store );
$store=$str;
//echo $body."wdw";
//echo $_COOKIE['phone'];
//var_dump($_COOKIE);

if(!empty($_COOKIE["phone"])){ 
	$phone=$_COOKIE["phone"];
	include('testmysql.php');
	$sql="select username,adress from users where phone='$phone' limit 1";
	$b1=$pdo->query($sql);
	foreach ($b1 as $key) {
	# code...
	$bb=$key['username'];
	$cc=$key['adress'];
	$dd=$bb."$$".$cc;
}
	$_SESSION['username']=$bb;
	$_SESSION['adress']=$cc;
	$_SESSION['phone']=$phone;
	$_SESSION['body']=$body;
	$_SESSION['fee']=$fee;
	$_SESSION['store']=$store;
	//echo $_SESSION['body'];
	//$_SESSION['paystate']=$paystate;
	//echo  $_SESSION['store'];
}		
	


?>


<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
<title></title>
<link href="css/bootstrap.min.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style type="text/css">

a:link{
	text-decoration:none;
}
a:visited{
	text-decoration:none;
}
a:hover{
	text-decoration:none;
}
a:active{
	text-decoration:none;
}

</style>
</head>

<body>
<div class="panel panel-primary">
    <div class="panel-heading">
    	请认真填写信息，商品才能及时送达噢
    </div>
	<div class="panel-body">
    	<p style="margin:20px auto;"><b>商品名称：</b><span id="a"><?php foreach ($arr as $key) {
	# code...
	$strarr=explode("*",$key);
	//var_dump($strarr);
	
	//foreach ($strarr as $key1 ) {
			$a=constant($strarr[0]).'*'.$strarr[1];
			$b=rtrim($a,'*');
			echo $b;
		//}
	}
	if(strpos($body,'*')==false){ echo $body;}


		?></span></p>
    	<p style="margin:20px auto;"><b>商品价格：</b><span id="b"><?php echo $fee;?></span></p>
        <p style="margin:20px auto;"><b>该商品由：</b><span id="c"><?php echo $store;?></span><b>提供</b></p>
    </div>
	<div class="panel-footer">该商品已通过微信支付</div>
</div>
<div class="container">
<form role="form" action="submit.php" method="post"  onsubmit="return InputCheck(this)">
	<input type="hidden" name="originator" value="<?php echo $code ?>">
	
	<input type="hidden" name="fee" value="<?php echo $fee ;?>">
	<input type="hidden" name="body" value="<?php echo $body ;?>">
	<input type="hidden" name="store" value="<?php echo $store ;?>">
	<a href="submit.php">
        <p>收货人：<?php echo $bb;?></p>
        <p>地址：<?php echo $cc;?></p>
        <p>电话：<?php echo $phone;?></p>
        <p class="btn btn-primary btn-block">选取该地址并提交</p>
    </a>
	<div class="form-group">
    	<label for="name">收货人姓名</label>
    	<input type="text" class="form-control" name="username" id="name" placeholder="姓名">
	</div>
    <div class="form-group">
    	<label for="number">手机号</label>
    	<input type="text" class="form-control" id="phone" name="phone" placeholder="联系方式">
	</div>
    <div class="form-group">
		<label>选择您的城市</label>
    	<select class="form-control"> 
      		<option>杭州</option> 
      </select>
	</div>
	<div class="form-group">
		<label>选择您的社区</label>
    	<select class="form-control" name="aa">
		<option value="蓝桥社区">蓝桥社区</option>
        	<option value="柠檬社区">柠檬社区</option> 
            <option value="香樟社区">香樟社区</option> 
        	<option value="伊萨卡社区">伊萨卡社区</option>  
      		<option value="早城社区">早城社区</option> 
      		<option value="打铁关社区">打铁关社区</option> 
      		<option value="东苑第一社区">东苑第一社区</option> 
      		<option value="现代城社区">现代城社区</option>
      		<option value="滟澜社区">滟澜社区</option>  
      	</select>
	</div>
	<div class="form-group">
    	<label for="name">详细地址</label>
    	<input type="text" class="form-control" id="name" name="detailed" placeholder="/小区/楼/号">
	</div>
<button id="qw" class="btn btn-primary btn-block" type="submit" >确认提交</button>
</form>   
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
		
		javascript:window.history.forward(1);

		
		function InputCheck(loginForm){ 
              if(loginForm.username.value=="")
              	{ 
              		alert("请输入姓名");
              		loginForm.username.focus();
              		return(false); 
              	}
              	var num=loginForm.phone.value;
              	//alert(num);
              	var reg=/^0?1[3|4|5|7|8][0-9]\d{8}$/;
              	if(!reg.test(num)){ 
              		alert("手机号格式错误，请重新输入！");
              		loginForm.phone.focus();
              		return(false);
              	}
		}
</script>

</body>
</html>
