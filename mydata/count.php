<?php 
//统计5个市的所有社区个数
include('testmysql.php');
$sql1="select count(id) from beijing";
$sql2="select count(id) from shenzhen";
$sql3="select count(id) from shanghai";
$sql4="select count(id) from tianjin";
$sql5="select count(id) from hangzhou";
$q1=$pdo->query($sql1);
$rows1=$q1->fetch();
$q2=$pdo->query($sql2);
$rows2=$q2->fetch();
$q3=$pdo->query($sql3);
$rows3=$q3->fetch();
$q4=$pdo->query($sql4);
$rows4=$q4->fetch();
$q5=$pdo->query($sql5);
$rows5=$q5->fetch();
$allcoun=$rows1[0]+$rows2[0]+$rows3[0]+$rows4[0]+$rows5[0];
?>