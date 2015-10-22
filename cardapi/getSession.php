<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" 
	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>礼品券</title>
	<style type="text/css">
		body,html{
			margin: 0px;
			padding: 0px;
			 font-family: "Microsoft YaHei";
			 background-color: #E5EFD4;
			 font-size: 12px;
		}
		.head{
			background-color: #FFD064;
			color:#fff;
		}
		.head div{
			height: 45px;
			line-height: 45px;
		}
		.head img{
			width:40px;
			height: 40px;
			float: left;
			margin-left: 5%;
			margin-top: 5px;
		}
		.head text{
			height: 45px;
			line-height: 45px;
		}
		.head p{
			text-align: center;
			margin: 0px;
		}
		.body{
			background-color: #fff;
			margin-top: 20px;
		}
		.textLine{
			width:80%;
			height: 30px;
			line-height:30px;
			margin:0px;
			margin-left:10%;
			border-bottom:solid 1px #d1d1d1;
		}
		button{
			margin-top:40px;width:80%;margin-left:10%;background-color:#FFD064;color:#fff;border:0px;
			height: 40px;font-size: 16px;
		}
	</style>
</head>
<body>
	<div style="display:none;"><?php echo $_SESSION['name'];?></div>
	<div class="head">
			<div>
				<img src="imgs/logo.jpg"/>
				<text>社区家</text>
			</div>
			<p style="font-size:20px;">福利集市入场券</p>
			<p style="font-size:10px;">凭此券现场可领取奖品</p>
			<p>有效期： 2015.9.24-2015.10.23</p>
			<br/>
			<img src="imgs/border.jpg" style="width:100%;margin:0px;height:8px;"/>
	</div>
	<br/>
	<div style="background-color:#fff;height:61px;line-height:31px;margin-top:10px;">
		<p class="textLine">
			<text style="color:#454545;">礼品券详情</text>
		</p>
		<p class="textLine" style="border:0px;">
			<text style="color:#454545;">查看公众号</text>
		</p>
	</div>
	<button>
		<b>立即领取</b>
	</button>
</body>
</html>