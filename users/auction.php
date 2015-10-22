<?php 
include('testmysql.php');
date_default_timezone_set('PRC');
$date=date("Y-m-d H:i:s");
//echo $date;
$openid=$_POST['customerId'];
$goodsid=$_POST['productId'];
//$sql="select img"
$userscoin=$_POST['haBiNumPai'];
$sql="insert into auction values('','$goodsid','$openid','$userscoin','$date','0')";
if($pdo->exec($sql)){ 
	echo "竞拍成功。";
}
?>