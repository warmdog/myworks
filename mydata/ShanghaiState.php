<?php 
//0新用户 1申请中 2搭建中 3审核中 4对接中 5运营中
include('testmysql.php');
$sqlhangzhou0="select count(state) from shanghai where state=0";
$sqlhangzhou1="select count(state) from shanghai where state=1";
$sqlhangzhou2="select count(state) from shanghai where state=2";
$sqlhangzhou3="select count(state) from shanghai where state=3";
$sqlhangzhou4="select count(state) from shanghai where state=4";
$sqlhangzhou5="select count(state) from shanghai where state=5";

$state=$pdo->query($sqlhangzhou0);
$ShanghaiState0=$state->fetch();//杭州市状态0 社区个数
//echo $HangzhouState0[0];
$state=$pdo->query($sqlhangzhou1);
$ShanghaiState1=$state->fetch();//杭州市状态1 社区个数
//echo $HangzhouState1[0];
$state=$pdo->query($sqlhangzhou2);
$ShanghaiState2=$state->fetch();//杭州市状态2 社区个数
//echo $HangzhouState2[0];
$state=$pdo->query($sqlhangzhou3);
$ShanghaiState3=$state->fetch();//杭州市状态3 社区个数
//echo $HangzhouState3[0];
$state=$pdo->query($sqlhangzhou4);
$ShanghaiState4=$state->fetch();//杭州市状态4 社区个数
//echo $HangzhouState4[0];
$state=$pdo->query($sqlhangzhou5);
$ShanghaiState5=$state->fetch();//杭州市状态0 社区个数
//echo $HangzhouState5[0];
?>