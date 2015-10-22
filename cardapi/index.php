<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-control:no-cache,no-store,must-revalidate");
header("content-type:text/html;charset=utf-8");
header("Pragma:no-cache");
header("Expires:-1");
session_start();
$openid=$_SESSION['openid'];
$rand = md5(time() . mt_rand(0,1000));
include('testmysql.php');
$sql="UPDATE cardusers SET code='$rand' ,state=1  where openid='$openid' ";
if($pdo->exec($sql)){ 
	session_destroy();
}
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
.demo{width:150px; margin:0px auto 0 auto; min-height:150px;border:dotted 1px #fff;}
#code{}
#main{
	width:100%;
	color: #333;
	font-size: 12px;
	margin-top:50px;
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
<div id="pId" style="display:none;">http://admin.shequjia.cn/cardapi/delete.php?code=<?php echo $rand;?></div>
<div id="main">
   <div style="width:102px;height:102px;margin:0px auto 0 auto;">
   		<img style="width:100px;height:100px;" src="imgs/logo.jpg"/>
   </div>
   <p style="color:#f00;font-size:13px;">注意！</p>
   <p style="color:#f00;font-size:13px;width:140px;">下方二维码仅可使用一次,请谨慎扫描。</p>
   <div class="demo" style="">
   		<div id="code"></div>
   </div>
   <br/>
   <br/>
   <p>您只需截屏保存此券的二维码图片，您就可以凭券上的二维码参加我们福利集市的优惠活动。</p>
   <p style="color:#777;">如果您丢失了所保存的二维码图片，没关系！
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
