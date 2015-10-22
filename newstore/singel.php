<?php 

session_start();

include_once"testmysql.php";

$openid=$_SESSION['openid'];

//$code = mt_rand(0,1000000);

//$_SESSION['code'] = $code; 

$_SESSION['aa']=false;

$sql1="select * from new_users where openid='$openid'";

$row=$pdo->query($sql1);

foreach ($row as $key ) {

	$phone=$key['phone'];

	$adress=$key['adress'];

	$name=$key['name'];

	# code...

}
$qrcode=$_GET['qrcode'];
if($qrcode=='')
{ 
	$codeurl='1';
}else{ 
	$codeurl='2';
	$_SESSION['qrcode']=$qrcode;
}

if(isset($_SESSION['qrcode'])){ 
	$id=$_SESSION['qrcode'];
}else{
$id=$_GET['id'];
}
$sql="select * from new_goods where state='1' and id='$id'";

$row1=$pdo->query($sql);

foreach ($row1 as $key ) {

	$id1=$key['id'];

	$goodsname=$key['goodsname'];

	$store=$key['store'];

	$imgurl=$key['imgurl'];

	$fixprice=$key['fixprice'];

	$discountprice=$key['discountprice'];

	$details=$key['details'];

}

$sql2="select url from new_goodsdetail where goodsid='$id1'";

$row2=$pdo->query($sql2);



?>

<!DOCTYPE html>

<html lang="zh-cn">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" 

		content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

	<title>商品详情</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="swiper/swiper.3.1.2.min.css">

	<link rel="stylesheet" type="text/css" href="font/iconfont.css">

	<link rel="stylesheet" type="text/css" href="css/mymain.css">

	<style type="text/css">

		body{

			padding: 0px;

			margin: 0px;

		}

		.nowPrice{

			color:#f00;

		}

		.subMit{

			width:100%;

			height: 50px;

			background-color:#FF7F50;

			color: #fff;

			border: none;

			font-size: 16px;

			position: fixed;

			bottom: 0px;

			left:0px;

		}

		.overFlow{

			display: none;

			background-color: rgba(0,0,0,0.5);

			height: 1000px;

			width:1000px;

			position: fixed;

			left: 0px;

			top:0px;

			z-index: 5;

		}

		.alert{

			display: none;

			background-color: #fff;

			width:100%;

			left: 0px;

			top:600px; 

			height:70%;

			position: fixed;

			z-index: 10;

			font-size: 20px;

		}

		.alert b{

			width: 30%；

		}

		.alert input{

			margin-left: 5%;

			width:65%;

			height:40px;

			border-left:0px;

			border-right:0px;

			border-top:0px;

			color:#999;

		}

		.numbtn{

			width:30px;

			height: 30px;

			font-size: 20px;

		}

	</style>

</head>

<body>

<!--初始化判断-->

<b id="thisPageOpenid" style="display:none;">
  <?php echo $openid;?>
</b>
<b id="thisUrl" style="display:none;">
	<?php echo $codeurl;?>
</b>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(
  function(){
    var juge=$("#thisPageOpenid").html();
    var url=$("#thisUrl").html();
    if(juge.length>10){
    }else{
    	  alert("您还未授权");
    	if(url=="1"){
    		window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5ac9358a3855640&redirect_uri=http://admin.shequjia.cn/newstore/oauth.php&response_type=code&scope=snsapi_userinfo&state=3d6be0a4035d839573b04816624a415e#wechat_redirect";
    	}else{
    		window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5ac9358a3855640&redirect_uri=http://admin.shequjia.cn/newstore/oauth1.php&response_type=code&scope=snsapi_userinfo&state=3d6be0a4035d839573b04816624a415e#wechat_redirect";
    	}
    }

  }

);

</script>

<!--页面内容-->

	<div id="store" style="display:none;"><?php echo $store;?></div>

	<div id="goodName" style="display:none;"><?php echo $goodsname;?></div>

  <div class="swiper-container swiper1" style="height: 250px;">

		 <div class="swiper-slide"><img src="<?php echo $imgurl;?>" width="100%" style="height: 250px;"></div>

  </div>

  <div style="margin:10px;border-bottom:solid 1px #ddd;font-size:12px;background-color:#fff;width:100%;margin-left:0px;">

  	<text class="my-textarea" style="margin-left:10px;"><?php echo $details;?></text>

  </div>

  <div style="margin:10px;border-bottom:solid 1px #ddd;background-color:#fff;width:100%;margin-left:0px;">

  	<p>

  		<b style="font-size:14px;margin-left:10px;">

	  		<text class="nowPrice">优惠价：</text>

	  		￥

	  		<text class="nowPrice" id="priceSingel"><?php echo $discountprice;?></text>

  	   </b>

  	</p>

  	<p>

  		<b style="font-size:12px;color:#999;margin-left:10px;">

  			<text class="name">原价：</text><s>￥<?php echo $fixprice;?></s>

  		</b>

  	</p>

  	<p>

  		<b style="font-size:12px;color:#333;margin-left:10px;">

  			<text class="name">可获得积分：￥</text><text id="exchangeCoin"><?php echo $discountprice;?></text>

  		</b>

  	</p>

  	<b style="margin-left:10px;">数量：</b>

  	<button onclick="cutNum();" class="numbtn" style="">

  		&nbsp-&nbsp

  	</button>

  	<input readonly="readonly" id="proNumber" style="height:30px;margin-bottom:5px;text-align:center;" value="1">

  	<button onclick="addNum();" class="numbtn">

  		&nbsp+&nbsp

  	</button>

  	<p><b style="font-size:14px;margin-left:10px;"><text class="nowPrice">总价：</text>￥<text class="nowPrice" id="priceAll"><?php echo $discountprice;?></text></b></p>

   	<button class="subMit" onclick="buy();">

   		<b>立&nbsp&nbsp&nbsp即&nbsp&nbsp&nbsp购&nbsp&nbsp&nbsp买</b>

   	</button>

  <p style="font-size:14px;color:#d00;text-align:center;">商品详情</p>

  <div>

  <?php foreach ($row2 as $key2) {

	$img2=$key2['url'];

 ?>

  	<img src="<?php echo $img2;?>" style="width:100%;">

  	<?php }?>

  	<br><br><br>

  </div>

   <div>

  	

  </div>

 	<!--弹出框-->

 	<div id="overflowIt" class="overFlow">

 	</div>

 	<div id="alertIt" class="alert">

 		<p>

 			<div onclick="hideAlert();" style="margin-right:10px;font-size:30px;text-align:right;">×</div>

 		</p>

 		<br/>

 		<b>收货地址</b><input id="address" value="<?php echo $adress;?>" placeholder="请填写地址" maxlength="30"/><br/><br/>

 		<b>收件人&nbsp&nbsp&nbsp&nbsp</b><input id="name" value="<?php echo $name;?>" placeholder="请填写名字" maxlength="22"/><br/><br/>

 		<b>联系方式</b><input id="cellPhone" value="<?php echo $phone;?>"  placeholder="请填写手机号码" maxlength="13"/>

 		<button onclick="sure();" style="width:65%;margin-top:10px;margin-left:20%;border-radius:3px;border:0px;padding:5px;background-color:#FF7E50;color:#fff;">确定</button>

 		<p id="warningtext" style="text-align:center;color:#f00;font-size:16px;display:none;">请完整填写相关信息</p>

 	</div>

 </div>

</body>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="swiper/swiper.3.1.2.min.js"></script>

<script type="text/javascript" src="js/mymain.js"></script>

<script type="text/javascript">

	//全局变量

	var priceSingel="";

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

			new Swiper(

				'.swiper-container', 

				{

				autoplay: 2500,

				pagination : '.swiper-pagination'

				}

			);	

			//初始化单价

			 priceSingel=$("#priceSingel").html();

			 //priceSingel=parseInt(priceSingel);

		}

	);

		

		function addNum(){

			var proNumber=$('#proNumber').val();

			proNumber=parseInt(proNumber);

			proNumber=proNumber+1;

			$('#proNumber').val(""+proNumber);

			var priceAll=priceSingel*proNumber;

			$("#priceAll").html(""+priceAll);

			$("#exchangeCoin").html(""+priceAll);

		}

		function cutNum(){

			var proNumber=$('#proNumber').val();

			proNumber=parseInt(proNumber);

			if(proNumber>1){

				proNumber=proNumber-1;

				$('#proNumber').val(""+proNumber);

				var priceAll=priceSingel*proNumber;

				$("#priceAll").html(""+priceAll);

				$("#exchangeCoin").html(""+priceAll);

			}	

		}

		function buy(){

			alertIt();

		}

		function alertIt(){

			$("#overflowIt").css("display","block");

			$("#alertIt").css("display","block");

			$("#alertIt").animate({'top':'30%'},500);

		}

		function sure(){

			var address=$('#address').val();

			var name=$('#name').val();

			var cellPhone=$('#cellPhone').val();

			if(address==""){

				$("#warningtext").html('请填写收货地址');

				$("#warningtext").css("display",'block');

				return false;

			}

			if(name==""){

				$("#warningtext").html('请填写联系人姓名');

				$("#warningtext").css("display",'block');

				return false;

			}

			if(cellPhone==""){

				$("#warningtext").html('请填写联系电话');

				$("#warningtext").css("display",'block');

				return false;

			}

			//回调成功

				$.ajax({

                  	url:'add.php',

                  	type:'post',

                  	data:'phone='+cellPhone+'&address='+address+'&name='+name,

                  	success:function(ee){

                            //alert("加入成功!");

                           pay();

                        },

                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                        	alert(XMLHttpRequest.status);

                        	alert(XMLHttpRequest.readyState);

                        	alert(textStatus);

                        }

                    });

		}

		function hideAlert(){

			 $("#overflowIt").css("display","none");

			 $("#alertIt").css("display","none");

			 $("#alertIt").css('top','100%');

		}

		function pay(){

			var store=$("#store").html();

			var priceAll=$("#priceAll").html();

			var goodName=$("#goodName").html();

			var url="http://admin.shequjia.cn/newstore/forepay.php?store="+store+"&money="+priceAll+"&body="+goodName;

			window.location.href = url;

		}

</script>

</html>