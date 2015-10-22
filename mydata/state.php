<?php 
//0新用户 1申请中 2搭建中 3审核中 4对接中 5运营中
include('testmysql.php');
$sqls1="select count(state) from hangzhou where state=0";
$qq1=$pdo->query($sqls1);
$row1=$qq1->fetch();
echo"$row1[0]";
die();
?>