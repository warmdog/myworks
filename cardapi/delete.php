<?php 
include('testmysql.php');
$code=$_GET['code'];
$sqla="select code,state from cardusers where code='$code' ";
$aa=$pdo->query($sqla);
foreach ($aa as $key) {
	# code...	
	$cc=$key['state'];
	$dd=$key['code'];
}
//var_dump($cc);
if($cc=='1'){ 
	$sql="UPDATE cardusers SET state=2 where code='$code'";
	if($pdo->exec($sql)){ 
		//echo "信息通过,此二维码刚才已经被消费！";
	}
}else{
		//echo "此用户已消费过，请不要重复消费！！！！";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>票据核销</title>
	<meta name="viewport" 
	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
	body,html{
		background-color: #FFD064;
		font-family: "Microsoft YaHei";
		color: #fff;
	}
	</style>
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<div style="margin:40% auto 0 auto;width:200px;text-align:center;">
	<b id="state" style="display: none;"><?php  echo $cc; ?></b>
	<b id="text">此票据已经核销</b>
</div>
<div>
	<img src="imgs/mogu.jpg" style="height:40%;width:40%;margin-left:20%;"/>
</div>
<script type="text/javascript">
	$(
		function(){ 
		var state=$("#state").html();
		//alert(state);
		if(state==null||state==""){ 
			$("#text").val("您的票据可能为无效票据，请出示支付记录。");
		}else{ 
			if(state=="1"){
				$("#text").html("核销成功，您可以入场了！"); 
			}else if(state=="2"){ 
				$("#text").html("对不起，您的票据已被使用过。");
			}else{ 
				$("#text").html("数据异常，请刷新重试。");
			}
		}	
	}
	);
</script>
</body>
</html>
