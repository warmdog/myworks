<?php

$openid = $_GET['openid'];
date_default_timezone_set('PRC');
require_once "jssdk.php";
include_once"testmysql.php";
setcookie("openid", $openid, time()+3600*24*30);
//require_once "front.php";
//define("TOKEN", "find");
//$wechatObj = new wechatCallbackapiTest();
//$openid=$wechatObj->responseMsg();
$jssdk = new JSSDK("wx4a3c015429486bc0", "de18d38d688a215bb6b5cbb0567c26e7");
//$token = $jssdk->getSignPackage();
$access_token= $jssdk->getAccessToken();
//$token1=json_decode($token1,true);
$subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
$subscribe = json_decode(file_get_contents($subscribe_msg));
$zyxx = $subscribe->subscribe;

if($zyxx !== 1){
	header("Location:http://mp.weixin.qq.com/s?__biz=MzAxOTUyMzg5Mg==&mid=400367511&idx=1&sn=49bfb41ef11b85409a90776197ff6eeb#rd");
	exit;
}
if($zyxx == 1){ 
	$nRows = $pdo->query("select count(-1) from vetor where openid='$openid'")->fetchColumn();
	$i=(int)$nRows;
	
	$date=date("Y-m-d H:i:s");
	if($i==0){
		if(!empty($openid)){
			session_start();
			$_SESSION['openid'] = $openid;
			$sql="insert into vetor(id,openid,date) values('','$openid','$date')";

			if($pdo->exec($sql)){ 
				//echo $pdo->lastInsertId();
				header("Location:http://admin.shequjia.cn/babytest/F7/examples/baayCount/index.php"); 
				//确保重定向后，后续代码不会被执行 
				exit;
			}
		}
	}
	if($i!=0){
		session_start();
		$_SESSION['openid'] = $openid;
		echo $_SESSION['openid'];
		header("Location:http://admin.shequjia.cn/babytest/F7/examples/baayCount/index.php"); 
		exit;
	}
}
//var_dump($token1);
//var_dump($token1);
//var_dump($token);

?>

