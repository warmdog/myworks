<?php 

ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';
//include('testmysql.php');



$fee=$_GET['money']*100;
$body1=stripslashes($_GET['body']);
$body= str_replace("/","",$body1);
//$id=$_GET['id'];
$store=$_GET['store'];
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
<script language="JavaScript" src="jquery-1.11.3.js">

</script>
<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				var body = document.getElementById("a").innerHTML;
				var fee = document.getElementById("b").innerHTML;
				var store = document.getElementById("c").innerHTML;

				

				//alert(res.err_code+res.err_desc+res.err_msg);
				if(res.err_msg=='get_brand_wcpay_request:ok'){
					alert("购买成功，请继续填写收货地址！");
					
					window.location.href="submit2.php?paystate=1"+"&fee="+fee+"&body="+body+"&store="+store;
					}else if(res.err_msg=='get_brand_wcpay_request:cancel'){ 
						alert("用户取消支付！");
						
						
					}

					else{ 
					alert("支付失败！");}	
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
</script>


</head>

<body>



<div class="panel panel-primary">
    <div class="panel-heading" style="margin-top: 0px">
    	福利商城，便民到家，给您最贴心的服务！
    </div>
	<div class="panel-body">
    	<p style="margin:20px auto;"><b>商品名称：</b><span id="a"><?php echo htmlspecialchars($body);?></span></p>
    	<p style="margin:20px auto;"><b>商品总价：</b><span id="b"><?php echo $fee/100;?>元</span></p>
        <p style="display:none;" ><b>商家：</b><span id="c"><?php echo $store;?></span></p>
    </div>
</div>
<button class="btn btn-primary btn-block" type="button" onClick="callpay()">立即支付</button>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
