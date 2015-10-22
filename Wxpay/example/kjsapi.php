<?php 

ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
header("Content-type:text/html;charset=utf-8");
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';
//include('testmysql.php');
$fee=$_GET['money']*100;
//$body1=stripslashes($_GET['body']);
$body=urldecode($_GET['body']);
$store=urldecode($_GET['store']);
//$body= str_replace("'","",$body1);
//$id=$_GET['id'];
$state=$fee."$$".$body."$$".$store;
//$qq="11";
//echo $fee."</br>";
//$GLOBALS['fee'] = $fee;
//var_dump($GLOBALS['fee']);
//defined("qq","$fee");
//echo constant("qq") ;
//var_dump($fee);
//$qq1=intval($fee);
//$_COOKIE["fee"]=$qq1;
//var_dump($qq1);
//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);
//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}
//die;
//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid($state);
//$fee=$_REQUEST['money'];
//echo $fee;
//$GLOBALS['fee'] = $fee;
//var_dump($GLOBALS['fee']);
//defined("qq","$fee");
//echo constant("qq") ;
//$qq=$tools->setfee($fee);
//echo $qq;
//die;
//echo $openid."1111111";
//$qq=intval($fee);
//GLOBALS $fee;
//②、统一下单
$input = new WxPayUnifiedOrder();
//$qq=intval($fee);
$input->SetBody($body);
$input->SetAttach($id);
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee($fee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($id);
$input->SetNotify_url("http://admin.shequjia.cn/Wxpay/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
//var_dump($input);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
//printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);
//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>微信安全支付</title>
<link href="css/bootstrap.min.css" rel="stylesheet"> 
<style type="text/css">
		body,html{
			margin: 0px;
			padding: 0px;
			border: 0px;
			 font-family: "Microsoft YaHei";
			 background-color: #D1D1D1;
			 font-size: 14px;
		}
		a{
			text-decoration: none;
		}
		.textLine{
			display:block;width:80%;border-bottom:solid 1px #d1d1d1;height:40px;line-height:40px;margin:0px auto 0 auto;
		}
		.textLine text{
			width:30%;
			height: 38px;
			line-height:38px;
			display:block;
			float:left;
			border: 5px;
		}
		.onlyText{
			color:#797979;padding:0px;margin:0px;margin-left:10%;line-height:40px;
		}
		select{
			width:30%;
			margin-left:10px 10% 10px 0px;
			border-radius: 6px;
			height:30px;
		}
	</style>
<script src="js/jquery.min.js"></script>
<script language="JavaScript" src="jquery-1.11.3.js"></script>
</head>
<body>
<div style="background-color:#FFD064;height:90px;width:100%;line-height:90px;position: fixed;top:0px;">
	<text style="color:#fff;margin-left:10%;font-size:16px;">
		<text style="border-top:solid 1px #fff;border-left:solid 1px #fff;">
			福
		</text>
		利&nbsp集&nbsp市&nbsp入
		<text style="border-right:solid 1px #fff;border-bottom:solid 1px #fff;">
			场&nbsp券
		</text>
	</text>
	<img src="images/mogu.jpg" style="height:100%;width:25%;float:right;margin-right:5%"/>
</div>
<p class="onlyText" style="margin-top: 90px;">抢购信息</p>
<div style="background-color:#eee;height:51px;line-height:50px;width:100%;">
	<p class="textLine">
		<text style="color:#454545;">区域</text>
		<select id="quYu">
			<option value='-1'>--请选择--</option>
			<option value='0'>江干区</option>
			<option value='1'>下城区</option>
			<option value='2'>滨江区</option>
			<option value='3'>拱墅区</option>
			<option value='4'>西湖区</option>
		</select>
	</p>
</div>
<div style="background-color:#EBEBEB;height:41px;line-height:40px;">
	<p class="textLine">
		<text style="color:#454545;">小区</text>
		<select id="sheQu">
		</select>
	</p>
</div>
<p class="onlyText">支付方式</p>
<div style="background-color:#eee;height:31px;line-height:30px;width:100%;position:relative;">
	<p class="textLine">
		<img src="images/weichat.jpg" style="width:45px;height:15px;display:inline;position:absolute;top:7px;">
		<text style="color:#b2b2b2;margin-left:30%;">
			微信
		</text>
	</p>
</div>
<button onclick="sure()" style="width:100%;height:40px;background-color:#FFD064;color:#fff;border:0px;margin:0px;position:fixed;bottom:0px;left:0px;">去支付</button>
<!--底部版权-->
<script type="text/javascript">
	$(
		function(){
			var quYus=[
				{xiaoQus:['--请选择--','高教社区','闻潮社区','大北社区','东湾社区','云水社区','伊萨卡社区','滟澜社区','铭和社区','早城社区','柠檬社区','天仙社区','万家花园社区','红梅社区','三里亭社区','兰苑社区','蓝桥社区','九华社区','红苹果社区','新江花园社区','兴安社区','金海社区','丽江社区','相江社区','天新社区','云峰社区','建华社区','王家井社区','三叉社区','水湘社区','钱塘社区','运新社区','新凯苑社区','健风社区','双菱社区','江汀社区']},
				{xiaoQus:['--请选择--','打铁关社区','现代城社区','三里家园社区','京都苑社区','流水东苑社区']},
				{xiaoQus:['--请选择--','西浦社区','白马湖社区','天官社区']},
				{xiaoQus:['--请选择--','杭钢北苑社区','杭钢南苑社区','东苑第一社区','勤丰社区']},
				{xiaoQus:['--请选择--','颐兰社区','香樟社区','翰墨香林社区']}
			];
			$("#quYu").change(
				function(){
					var quYuCode=$("#quYu").val();
					quYuCode=parseInt(quYuCode);
					var xiaoQus=quYus[quYuCode].xiaoQus;
					$('#sheQu').empty();
					for(var i=0;i<xiaoQus.length;i++){
						var html='<option value="'+xiaoQus[i]+'">'+xiaoQus[i]+'</option>';
						$('#sheQu').append(html);
					}
				}
			);
		}
	);
</script>
<script type="text/javascript">
	$(
		function(){
			document.getElementById("quYu").options[0].selected="selected";
		}
	);
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//var body = document.getElementById("a").innerHTML;
				//var fee = document.getElementById("b").innerHTML;
				//var store = document.getElementById("c").innerHTML;
				var quYu=$('#quYu>option:selected').html();
				var sheQu=$('#sheQu').val();
				//alert(res.err_code+res.err_desc+res.err_msg);
				if(res.err_msg=='get_brand_wcpay_request:ok'){
						alert("购买成功！");
						window.location.href="http://admin.shequjia.cn/cardapi/ahead.php?money=1&body='一元卡券'&store='社区家'&quYu='"+quYu+"'&sheQu='"+sheQu+"'";
					}else if(res.err_msg=='get_brand_wcpay_request:cancel'){ 
						alert("用户取消支付！");
						window.location.href="http://admin.shequjia.cn/cardapi/ahead.php?money=1&body='一元卡券'&store='社区家'&quYu='"+quYu+"'&sheQu='"+sheQu+"'";
						//window.location.href="http://admin.shequjia.cn/cardapi/ahead.php";
						//window.location.href="http://wx.shequjia.cn/mybootstrap/new/finalsubmit.php?paystate=1"+"&fee="+fee+"&body="+body+"&store="+store;	
					}
					else{ 
						alert("支付失败！");
					}	
			}
		);
	}
	function callpay()
	{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
	}
	function sure(){
		var quYu=$('#quYu').val();
		var shequ=$("#sheQu").val();
		if(quYu=="-1"||shequ=="--请选择--"||shequ==''||!(shequ)){
			alert('请选择您所在的区域和小区');
		}else{
			callpay();
		}
	}
</script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
