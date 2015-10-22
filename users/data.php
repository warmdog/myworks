<?php
include('testmysql.php');
$sql="select * from users where id=1000000002" ;
$qq =$pdo->query($sql);
foreach ($qq as $key ) {
	echo $key['date'];
}
?>