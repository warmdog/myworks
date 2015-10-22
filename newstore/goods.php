<?php 
include_once"testmysql.php";
$i=1;
$sql="select * from new_goods where state='1' and id='$i'";
$row=$pdo->query($sql);
foreach ($row as $key ) {
	# code...
	$id=$key['id'];
	$goodsname=$key['goodsname'];
	$store=$key['store'];
	$imgurl=$key['imgurl'];
	$fixprice=$key['fixprice'];
	$discountprice=$key['discountprice'];
	$details=$key['details'];
	var_dump($key);
	echo "</br>";
	

}
$sql="select imgurl1,imgurl2,imgurl3 from new_goods where state='1' and id='$id'";
$row1=$pdo->query($sql);
foreach ($row1 as $key ) {
	$imgurl1=$key['imgurl1'];
	$imgurl2=$key['imgurl2'];
	$imgurl3=$key['imgurl3'];
}
echo $imgurl1;


//echo $id;
?>