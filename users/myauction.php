<?php 
include('testmysql.php');
//$openid=$_POST['openid'];
$openid=$_SESSION['openid'];
$sql3="select * from auction where usersopenid='$openid' order by id desc limit 1";
$aaa=$pdo->query($sql3);
$i=0;

foreach ($aaa as $key3 ) {
	$goodsid=$key3['goodsid'];
	$userscoin=$key3['userscoin'];
	$i=1;
	# code...
}

//$all= $aaa->fetchAll();
//$bbb=sizeof($all);
//echo $bbb;
//var_dump($goodsid);

if($i!==0){ 
$sql4="select * from goods where id=$goodsid";
$aaa1=$pdo->query($sql4);
foreach ($aaa1 as $key4) {
	$about1=$key4['about'];
	$goodsname1=$key4['goodsname'];
	$imgsrc1=$key4['imgsrc'];
}
//echo $about1;
}else{ 
	$imgsrc1='imgs/xue.jpg';//默认图片修改位置
	//echo $imgsrc1;
}
//echo $userscoin;
//echo $goodsname1."</br>";
//echo $imgsrc1."</br>";

?>