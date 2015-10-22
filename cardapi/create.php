<?php 
header("Content-type:text/html;charset=utf-8");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-control:no-cache,no-store,must-revalidate");
header("Pragma:no-cache");
header("Expires:-1");
include('testmysql.php');
session_start();

$district=$_SESSION['district'];

$village=$_SESSION['village'];
$village= str_replace("'","",$village);
$district = str_replace("'","",$district);
//echo $district;
$sql="select * from fuli  ";
$qq=$pdo->query($sql);
foreach ($qq as $key ) {
	$village1=$key['village'];
	//echo $village1;
	//echo "</br>";
	if ($village1==$village) {
		$sql1="UPDATE fuli SET count=count+1 WHERE village='$village'";
		$pdo->exec($sql1);
		//echo $village.'111';
		
		//echo "success";
		header("refresh:0;url=http://admin.shequjia.cn/cardapi/index.php");
		exit;
	}
		
}


$sql2="insert into fuli values('','$district','$village','1')";
$pdo->exec($sql2);

header("refresh:0;url=http://admin.shequjia.cn/cardapi/index.php");
exit;
	
//echo "success";

/*$table='qweqqq';
$sql="create table $table( 
	id int(10) not null auto_increment primary key,
	a varchar(20)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";
if($pdo->exec($sql)){ 
	echo "success";
}*/

;
