<?php 
//0新用户 1申请中 2搭建中 3审核中 4对接中 5运营中
include('testmysql.php');
$sqlshenzhen0="select count(state) from shenzhen where state=0";
$sqlshenzhen1="select count(state) from shenzhen where state=1";
$sqlshenzhen2="select count(state) from shenzhen where state=2";
$sqlshenzhen3="select count(state) from shenzhen where state=3";
$sqlshenzhen4="select count(state) from shenzhen where state=4";
$sqlshenzhen5="select count(state) from shenzhen where state=5";

$state=$pdo->query($sqlshenzhen0);
$ShenzhenState0=$state->fetch();//杭州市状态0 社区个数
//echo $hangzhouState0[0];
$state=$pdo->query($sqlshenzhen1);
$ShenzhenState1=$state->fetch();//杭州市状态1 社区个数
//echo $hangzhouState1[0];
$state=$pdo->query($sqlshenzhen2);
$ShenzhenState2=$state->fetch();//杭州市状态2 社区个数
//echo $hangzhouState2[0];
$state=$pdo->query($sqlshenzhen3);
$ShenzhenState3=$state->fetch();//杭州市状态3 社区个数
//echo $hangzhouState3[0];
$state=$pdo->query($sqlshenzhen4);
$ShenzhenState4=$state->fetch();//杭州市状态4 社区个数
//echo $hangzhouState4[0];
$state=$pdo->query($sqlshenzhen5);
$ShenzhenState5=$state->fetch();//杭州市状态0 社区个数
//echo $hangzhouState5[0];
?>