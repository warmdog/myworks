<?php 
//0新用户 1申请中 2搭建中 3审核中 4对接中 5运营中
include('testmysql.php');
$sqltianjin0="select count(state) from tianjin where state=0";
$sqltianjin1="select count(state) from tianjin where state=1";
$sqltianjin2="select count(state) from tianjin where state=2";
$sqltianjin3="select count(state) from tianjin where state=3";
$sqltianjin4="select count(state) from tianjin where state=4";
$sqltianjin5="select count(state) from tianjin where state=5";

$state=$pdo->query($sqltianjin0);
$TianjinState0=$state->fetch();//杭州市状态0 社区个数
//echo $HangzhouState0[0];
$state=$pdo->query($sqltianjin1);
$TianjinState1=$state->fetch();//杭州市状态1 社区个数
//echo $HangzhouState1[0];
$state=$pdo->query($sqltianjin2);
$TianjinState2=$state->fetch();//杭州市状态2 社区个数
//echo $HangzhouState2[0];
$state=$pdo->query($sqltianjin3);
$TianjinState3=$state->fetch();//杭州市状态3 社区个数
//echo $HangzhouState3[0];
$state=$pdo->query($sqltianjin4);
$TianjinState4=$state->fetch();//杭州市状态4 社区个数
//echo $HangzhouState4[0];
$state=$pdo->query($sqltianjin5);
$TianjinState5=$state->fetch();//杭州市状态0 社区个数
//echo $HangzhouStatetianjin