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
$sqla="select openid from users where openid='$openid' limit 1";
$aa=$pdo->query($sqla);
$i=0;
foreach ($aa as $key) {
	# code...
	$bb=$key['openid'];
	$i=1;

}

//echo $bb;
//echo '1111111111111';s
//echo $openid;
if($i==0){
	$sql="insert into users values('','$nickname','$headimgurl','','$openid','$sex','','','','','')";

	if($pdo->exec($sql)){ 
		session_start();
	$_SESSION['openid']=$openid;
	$_SESSION['sex']=$sex;
	$_SESSION['headimgurl']=$headimgurl;
	$_SESSION['nickname']=$nickname;
		//echo $pdo->lastInsertId();
		header("Location:http://admin.shequjia.cn/users/index.php"); 
		//确保重定向后，后续代码不会被执行 
		//echo "success";
		
	}
}else{
//echo "</br>";
session_start();
$_SESSION['openid']=$openid;
$_SESSION['sex']=$sex;
$_SESSION['headimgurl']=$headimgurl;
$_SESSION['nickname']=$nickname;
header("Location:http://admin.shequjia.cn/users/index.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登入</title>
</head>

<body>
	
</body>
</html>