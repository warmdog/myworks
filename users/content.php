<?php 
include('testmysql.php');
$sql="select * from content ";
$raw=$pdo->query($sql);
foreach ($raw as $key ) {
	echo $key['head'];
	echo $key['content'];
	echo $key['url'];
}
?>
