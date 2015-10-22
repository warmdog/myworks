<?php
if (isset($_GET['code'])){
    //echo $_GET['code'];
    echo "</br>";
    
}else{
    echo "NO CODE";
}
$appid="wxd5ac9358a3855640";
$appsecret="22df116c8436933bbc38af7b0aa31029";

$code=$_GET['code'];
$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxd5ac9358a3855640&secret=22df116c8436933bbc38af7b0aa31029&code=$code&grant_type=authorization_code";
//echo $url."<br>";
//$output_online=http_request($url);
$output_online=file_get_contents($url);
$jsonstr=json_decode($output_online,true);
//设置token为cookie 
$access_token=$jsonstr['access_token'];
if (isset($jsonstr['errcode'])) {
    echo '<h1>错误：</h1>'.$jsonstr['errcode'];
    echo '<br/><h2>错误信息：</h2>'.$jsonstr['errmsg'];
    exit;
}
//var_dump($jsonstr);
//echo "<br>";
//echo $access_token."dwdw";
///echo "</br>";
$urla="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$appid&lang=zh_CN";
$output_user=file_get_contents($urla);
$jsonstra=json_decode($output_user,true);
$openid=$jsonstra['openid'];
$sex=$jsonstra['sex'];
$headimgurl=$jsonstra['headimgurl'];
$nickname1=$jsonstra['nickname'];
//$nickname = json_decode($tmpStr, true);  
$tmpStr = json_encode($nickname1);  
$tmpStr = preg_replace("#(\\\ud[0-9a-f]{3})|(\\\ue[0-9a-f]{3})#ie","",$tmpStr);
$nickname = json_decode($tmpStr, true); 
//$nickname=$tmpStr;
//var_dump($jsonstra);
include('testmysql.php');
$sqla="select openid,state ,code from cardusers where openid='$openid' limit 1";
$aa=$pdo->query($sqla);
foreach ($aa as $key) {
	# code...
	$bb=$key['openid'];
	$cc=$key['state'];
	$dd=$key['code'];

}
//echo $bb;
//echo '1111111111111';s
//echo $openid;
//echo "<br>";
//var_dump($cc);



?>

<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" 
	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>生成二维码</title>
<style type="text/css">
body,html{
	margin: 0px;
	padding: 0px;
	border: 0px;
	font-family: "Microsoft YaHei";
	background-color: #FFD064;
}
.demo{width:140px; margin:0px auto 0 auto; min-height:140px;border:dotted 1px #fff;}
#code{}
#main{
	width:100%;
	color: #333;
	font-size: 12px;
}
p{
	margin: 0px;
	width:200px;
	margin:0px auto 0 auto;
	text-indent: 2em;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.qrcode.min.js"></script>
</head>
<body>
<div id="pId" style="display:none;">http://admin.shequjia.cn/cardapi/delete.php?code=<?php echo $dd;?></div>
<div id="main">
   <div style="width:102px;height:102px;margin:0px auto 0 auto;">
   		<img style="width:100px;height:100px;" src="imgs/logo.jpg"/>
   </div>
   <p style="color:#f00;font-size:13px;">注意！</p>
   <p style="color:#f00;font-size:13px;width:140px;">下方二维码仅可使用一次,请谨慎扫描。</p>
   <div class="demo">
   		<div id="code"></div>
   </div>
   <br/>
   <br/>
   <p>您只需截屏保存此券的二维码图片，您就可以凭券上的二维码参加我们福利集市的优惠活动。</p>
   <p style="color:#777;">如果您再次丢失了所保存的二维码图片，没关系！
   登录首页，点击下方的找回二维码，即可找回您的入场券。
   或者带上您的手机前往活动现场，我们将为您提供现场找回,守护您的权益。</p>
   <br/>
   <p style="text-align: center;text-indent: 0em;">社区家，打造美好生活。</p>
   <br/><div class="ad_76090"><script src="/js/ad_js/bd_76090.js" type="text/javascript"></script></div><br/>
</div>
<p id="stat"><script type="text/javascript" src="/js/tongji.js"></script></p>
<!--脚本-->
<script type="text/javascript">
$(function(){
	var str = "";
	$('#code').qrcode(str);
  var text=$("#pId").html();
  createCode(text);
  //生成图片
  var canvas=document.getElementById('main');
  var strDataURI=canvas.toDataURL();
  console.log(strDataURI);
})
function createCode(text){
  $("#code").empty();
    var str = toUtf8(text);
    $("#code").qrcode({
      render: "table",
      width: 150,
      height: 150,
      text: str
    });
}
function toUtf8(str) {   
    var out, i, len, c;   
    out = "";   
    len = str.length;   
    for(i = 0; i < len; i++) {   
    	c = str.charCodeAt(i);   
    	if ((c >= 0x0001) && (c <= 0x007F)) {   
        	out += str.charAt(i);   
    	} else if (c > 0x07FF) {   
        	out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));   
        	out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));   
        	out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));   
    	} else {   
        	out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));   
        	out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));   
    	}   
    }   
    return out;   
}  
</script>
</body>
</html>