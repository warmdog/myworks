<?php
ob_start();
session_start();
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
//$refresh_token=$jsonstr['refresh_token'];
//$urlaa="https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=wxd5ac9358a3855640&grant_type=refresh_token&refresh_token=$refresh_token";
//$output_online=file_get_contents($urlaa);
//$jsonstr=json_decode($output_online,true);
//$access_token=$jsonstr['access_token'];



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

//$sex=$jsonstra['sex'];
//$headimgurl=$jsonstra['headimgurl'];
//$nickname1=$jsonstra['nickname'];  
//$tmpStr = json_encode($nickname1);  
//$tmpStr = preg_replace("#(\\\ud[0-9a-f]{3})|(\\\ue[0-9a-f]{3})#ie","",$tmpStr);
//$nickname = json_decode($tmpStr, true); 
//$nickname=$tmpStr;
//var_dump($jsonstra);

include('testmysql.php');
$nRows = $pdo->query("select count(-1) from vetor where openid='$openid'")->fetchColumn();
$i=(int)$nRows;
$_SESSION['openid']=$openid;
date_default_timezone_set('PRC');
$date=date("Y-m-d H:i:s");
//echo $bb;
//echo '1111111111111';s
//echo $openid;
if($i==0){
	if(!empty($openid)){
		$sql="insert into vetor(id,openid,date) values('','$openid','$date')";

		if($pdo->exec($sql)){ 
			//echo $pdo->lastInsertId();
			header("Location:http://admin.shequjia.cn/babyCount/F7/examples/baayCount/index.php"); 
			//确保重定向后，后续代码不会被执行 
			exit;
		}
	}else{ 
		header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5ac9358a3855640&redirect_uri=http://admin.shequjia.cn/babyCount/F7/examples/baayCount/oauth.php&response_type=code&scope=snsapi_userinfo&state=3d6be0a4035d839573b04816624a415e#wechat_redirect");	
		exit;
	}
}
//echo "</br>";
if($i!=0){
	header("Location:http://admin.shequjia.cn/babyCount/F7/examples/baayCount/index.php"); 
	exit;
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