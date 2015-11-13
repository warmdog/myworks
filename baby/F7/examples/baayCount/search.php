<?php 
include_once"testmysql.php";
$name=$_POST['name'];

if(!empty($name)){
	$sql="select * from baby where name LIKE '%$name%'";
	$row=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

	echo   json_encode($row);
}
?>

