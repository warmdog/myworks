<?php 
session_start();
include_once"testmysql.php";
$openid=$_SESSION['openid'];
$nickname=$_SESSION['nickname'];
$imgurl=$_SESSION['headimgurl'];
$sql="select * from new_orders where openid='$openid' and paystate='1' order by id desc";
$row=$pdo->query($sql);


?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" 
		content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>订单</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="swiper/swiper.3.1.2.min.css">
	<link rel="stylesheet" type="text/css" href="font/iconfont.css">
	<link rel="stylesheet" type="text/css" href="css/mymain.css">
	<style type="text/css">
		.nowPrice{
			color:#f00;
		}
		button{
			width:100%;
			position: fixed;
			bottom: 0px;
			height: 30px;
			background-color:#FF7E50;
			color: #fff;
			border: none;
		}
		.info p{
			margin:0px;
		}
	</style>
</head>
<body>
<!--初始化判断-->
<b id="thisPageOpenid" style="display:none;">
  <?php echo $openid;?>
</b>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(
  function(){
    var juge=$("#thisPageOpenid").html();
    if(juge.length>2){
    }else{
      alert("您还未授权");
      window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5ac9358a3855640&redirect_uri=http://admin.shequjia.cn/newstore/oauth.php&response_type=code&scope=snsapi_userinfo&state=3d6be0a4035d839573b04816624a415e#wechat_redirect";
    }
  }
);
</script>
<!--页面内容-->
		<div class="container-fuild user-box" style="height:170px;">
		  <div class="user-img">
		  <br/>
		    <img src="<?php echo $imgurl;?>">
		    <p><?php echo $nickname;?></p>
		  </div>
		</div>
		<!--订单-->
		<?php foreach ($row as $key) {
			$goods=$key['goods'];
			$time=$key['time'];
			$fee=$key['fee'];
			$sql22="select imgurl from new_goods where goodsname='$goods'";
			$qwe=$pdo->query($sql22);
			foreach ($qwe as $key22) {
				$imgurl22=$key22['imgurl'];
			}
	# code...
?>
		<div style="border:solid 1px #ddd;padding:10px;height:90px;">
				<div style="width:40%;float:left">
					<img src="<?php echo $imgurl22;?>" style="height:70px;width:70px;">
				</div>
				<div style="width:60%;float:left">
					<b style="color:#777;"><?php echo $goods;?></b><br/>
					<b style="font-size:14px;color:#E78900;"><text>购买时间：</text><text><?php echo $time;?></text></b><br/>
					<b style="font-size:14px;color:#E78900;"><text>价格：</text><text><?php echo $fee;?></text></b><br/>
				</div>
		</div>
		<?php }?>
</body>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="swiper/swiper.3.1.2.min.js"></script>
<script type="text/javascript" src="js/mymain.js"></script>
<script type="text/javascript">
	$(
		function(){
			var texts=$(".my-textarea");
			for(var i=0;i<texts.length;i++){
				var text=$(texts[i]).html();
				if(text.length>30){
					text=text.substr(0,20)+"..."
				}
				$(texts[i]).html(text);
			}
			//初始化banlar
			var mySwiper = 
			new Swiper('.swiper-container', {
			autoplay: 2500,
			pagination : '.swiper-pagination'
			}
			);
		}
	);
</script>
</html>