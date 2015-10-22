<?php 
include('testmysql.php');
//$coin=$_POST['coin'];
$id=$_POST['openid'];
$sql="select coin  from users where openid='$id' ";
$qq=$pdo->query($sql);
foreach ($qq as $key) {
	$coin1= $key['coin'];
	//$date=$key['date'];
	

	# code...
}
echo $coin1;
/*$sql ="UPDATE users SET coin=coin+$coin where openid=$id ";
if($pdo->exec($sql)){ 
	echo "修改成功！";
}

$sql="select coin from users where openid=$id ";
$qq=$pdo->query($sql);
foreach ($qq as $key) {
	echo $key['coin'];
	# code...
}*/
?>