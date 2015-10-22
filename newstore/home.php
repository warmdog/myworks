<?php 
session_start();
include_once"testmysql.php";



$openid=$_SESSION['openid'];

$sql="select * from new_goods where state='1' ";

$row=$pdo->query($sql);

?>

<!DOCTYPE html>

<!--#2BB761 #F6D200  #E7652B-->

<html lang="zh-cn">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport"

	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

<title>福利集市</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="swiper/swiper.3.1.2.min.css">

<link rel="stylesheet" type="text/css" href="font/iconfont.css">

<link rel="stylesheet" type="text/css" href="css/mymain.css">

<!--[if lt IE 9]>

<script src="js/html5shiv.js"></script>

<script src="js/respond.min.js"></script>

<![endif]-->

<style type="text/css">

	body,html{

		margin: 0px;

		padding: 0px;

		border: 0px;

	}

	.container-fluid{

		margin: 0px;

		padding: 0px;

	}

	.name{

		color: #717171;

		margin-left:20px;

	}

	s{

		color: #919191;

	}

	.nowPrice{

		color: #f00;

	}

	.block{

		border:solid 1px #ddd;

	}

	.info{

		margin-top:10px;

	}

	.info p{

		margin:0px;

		padding: 0px;

	}

	.my-textarea{

	}

  	.myPro{

    		padding: 0 15px;

		margin: 20px 0;

		background-color:#FFF;

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

<!--头部-->

	<div class="swiper-container" >

	    <div class="swiper-wrapper">

	      <div class="swiper-slide"><img src="img/1.jpg" width="100%"></div>

	      <div class="swiper-slide"><img src="img/2.jpg" width="100%"></div>

	      <div class="swiper-slide"><img src="img/3.jpg" width="100%"></div>

	    </div>

	    <div class="swiper-pagination"></div>

  </div>

<!--中部表单-->
<!--单个商品-->
<div class="myPro" id="XS" name="29">
		<div>
				<div id="XS">
					<img src="img/dsgy.jpg" style="width:100%;margin-top:10px;">
				</div>
				<div class="info">
					<p class="my-textarea" style="text-align:center;"><b>滴水公益一元起拍</b></p>
					<p><text class="my-textarea">滴水公益一元起拍</text></p>
					<p><text>原价：</text><s>￥1</s><text class="name">优惠价：</text><text class="nowPrice">￥1</text></p>
					<p>兑换后可获得积分<text>1</text></p>
				</div>
		</div>
	</div>
<!--循环遍历-->
<?php 

	foreach ($row as $key ) {

	# code...

	$id=$key['id'];

	$goodsname=$key['goodsname'];

	$store=$key['store'];

	$imgurl=$key['imgurl'];

	$fixprice=$key['fixprice'];

	$discountprice=$key['discountprice'];

	$details=$key['details'];

?>

	<div class="myPro" id="XS" name="<?php echo $id;?>">

		<div>

				<div id="XS">

					<img src="<?php echo $imgurl;?>" style="width:100%;margin-top:10px;">

				</div>

				<div class="info">

					<p class="my-textarea" style="text-align:center;"><b><?php  echo $goodsname;?></b></p>

					<p><text class="my-textarea"><?php echo $details;?></text></p>

					<p><text>原价：</text><s>￥<?php echo $fixprice;?></s><text class="name">优惠价：</text><text class="nowPrice">￥<?php echo $discountprice;?></text></p>

					<p>兑换后可获得积分<text><?php echo $discountprice;?></text></p>

				</div>

		</div>

	</div>

<?php }?>

<!-- 底部选项卡-->

<br/>

<br/>

<br/>

<br/>

<div class="toolbar tabbar toolbar-fixed">

    <div class="toolbar-inner">

        <a href="#" class="link active"><i class="iconfont icon-home"></i><span class="tabbar-label">首页</span></a>

        <a href="exchange.php" class="link"><i class="iconfont icon-sponsor"></i><span class="tabbar-label">兑换</span></a>

        <a href="my.php" class="link"><i class="iconfont icon-people"></i><span class="tabbar-label">我</span></a>

    </div>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="swiper/swiper.3.1.2.min.js"></script>

<script type="text/javascript" src="js/mymain.js"></script>

<script type="text/javascript">

	$(

		function(){

			var texts=$(".my-textarea");

			for(var i=0;i<texts.length;i++){

				var text=$(texts[i]).html();

				if(text.length>20){

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

			//初始化商品点击

			$(".myPro").click(

				function(){

					var obj=this;

					var id=$(obj).attr("name");

					window.location.href="singel.php?id="+id;

				}

			);

		}

	);

</script>

</body>

</html>



