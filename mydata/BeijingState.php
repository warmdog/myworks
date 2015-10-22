<?php 
//0新用户 1申请中 2搭建中 3审核中 4对接中 5运营中
include('testmysql.php');
$sqlbeijing0="select count(state) from beijing where state=0";
$sqlbeijing1="select count(state) from beijing where state=1";
$sqlbeijing2="select count(state) from beijing where state=2";
$sqlbeijing3="select count(state) from beijing where state=3";
$sqlbeijing4="select count(state) from beijing where state=4";
$sqlbeijing5="select count(state) from beijing where state=5";

$state=$pdo->query($sqlbeijing0);
$BeijingState0=$state->fetch();//杭州市状态0 社区个数
//echo $HangzhouState0[0];
$state=$pdo->query($sqlbeijing1);
$BeijingState1=$state->fetch();//杭州市状态1 社区个数
//echo $HangzhouState1[0];
$state=$pdo->query($sqlbeijing2);
$BeijingState2=$state->fetch();//杭州市状态2 社区个数
//echo $HangzhouState2[0];
$state=$pdo->query($sqlbeijing3);
$BeijingState3=$state->fetch();//杭州市状态3 社区个数
//echo $HangzhouState3[0];
$state=$pdo->query($sqlbeijing4);
$BeijingState4=$state->fetch();//杭州市状态4 社区个数
//echo $HangzhouState4[0];
$state=$pdo->query($sqlbeijing5);
$BeijingState5=$state->fetch();//杭州市状态0 社区个数
//echo $HangzhouStatebeijing