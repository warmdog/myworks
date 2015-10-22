<?php 
session_start();
header("Cache-control:no-cache,no-store,must-revalidate");
header("Pragma:no-cache");
header("Expires:0");
//header('Pragma:no-cache'); 
//header("Cache-Control: no-cache, must-revalidate");
$code = mt_rand(0,1000000); 
$_SESSION['code'] = $code; 

$paystate=$_GET["paystate"];
$body=$_GET['body'];
$fee=$_GET['fee'];
$store=$_GET['store'];
//echo $body."wdw";
//echo $_COOKIE['phone'];
//var_dump($_COOKIE);

/*if(!empty($_COOKIE["phone"])){ 
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
	$_SESSION['paystate']=$paystate;
}		
	*/


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
    	<p style="margin:20px auto;"><b>商品名称：</b><span id="a"><?php echo $body;?></span></p>
    	<p style="margin:20px auto;"><b>商品价格：</b><span id="b"><?php echo $fee;?></span></p>
        <p style="margin:20px auto;"><b>该商品由：</b><span id="c"><?php echo $store;?></span><b>提供</b></p>
    </div>
	<div class="panel-footer">该商品已通过微信支付</div>
</div>
<form role="form" action="sub.php" method="post"  onsubmit="return InputCheck(this)">
	<input type="hidden" name="originator" value="<?php echo $code ?>">
	<input type="hidden" name="paystate" value="<?php echo $paystate ;?>">
	<input type="hidden" name="fee" value="<?php echo $fee ;?>">
	<input type="hidden" name="body" value="<?php echo $body ;?>">
	<input type="hidden" name="store" value="<?php echo $store ;?>">
	
	<div class="form-group">
    	<label for="name">收货人姓名</label>
    	<input type="text" class="form-control" name="username" id="name" placeholder="姓名">
	</div>
    <div class="form-group">
    	<label for="number">手机号</label>
    	<input type="text" class="form-control" id="phone" name="phone" placeholder="联系方式">
	</div>
	<div class="form-group">
    	<label for="license">车牌号</label>
    	<input type="text" class="form-control" id="license" name="license" placeholder="车牌号">
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
	<div class="form-group">
		<label>选择时间段</label>
    	<select class="form-control" name="bb"> 
      		<option value="10:00-10:30">10:00-10:30</option> 
      		<option value="10:30-11:00">10:30-11:00</option> 
      		<option value="11:00-11:30">11:00-11:30</option> 
      		<option value="11:30-12:00">11:30-12:00</option>
      		<option value="12:00-12:30">12:00-12:30</option> 
      		<option value="12:30-13:00">12:30-13:00</option> 
      		<option value="13:00-13:30">13:00-13:30</option> 
      		<option value="13:30-14:00">13:30-14:00</option> 
      		<option value="16:00-16:30">16:00-16:30</option> 
      		<option value="16:30-17:00">16:30-17:00</option> 
      		<option value="17:00-17:30">17:00-17:30</option> 
      		<option value="17:30-18:00">17:30-18:00</option> 
      		<option value="18:00-18:30">18:00-18:30</option> 
      		<option value="18:30-19:00">18:30-19:00</option> 
      		<option value="19:00-19:30">19:00-19:30</option> 
      		<option value="19:30-20:00">19:30-20:00</option>  
      	</select>
	</div>
	
<button id="qw" class="btn btn-primary btn-block" type="submit" >确认提交</button>
</form>   

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
