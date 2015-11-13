<?php 
//整个活动时间内 可以投票次数
include_once"testmysql.php";
$id=(int)$_POST['id'];
//$id=1;
$openid=$_POST['openid'];
//$openid='oZjDqjmtBSoYpuralSpgfpSszL3Y';
$array=array();
date_default_timezone_set("PRC");
$date=date("Y-m-d-H:i:s");
$arr=explode('-',$date);

$sql="select a.count1, b.times from regulation a,vetor b where b.openid='$openid'";
$row=$pdo->query($sql);
foreach ($row as $key ) {
	$count=(int)$key['count1'];
	$vetor_times=(int)$key['times'];
}

$sqlvetor="select baby1 from vetor_baby where openid='$openid'";
$vetor_baby=$pdo->query($sqlvetor);
foreach ($vetor_baby as $key ) {
	$id1=$key['baby1'];
	//echo $id1;
	if($id1==$id){ 
		echo "已投过票啦~";
		exit;
	}
}

if($count>$vetor_times){
	$sqltime="select count(-1) from regulation where id=1 and now() between start and end";
	$a=(int)$pdo->query($sqltime)->fetchColumn();
	if($a>0){
		$sqlupdate="update baby a, vetor b  set a.count1=a.count1+1,b.times=b.times+1 where a.id='$id' and b.openid='$openid'";
		if($pdo->exec($sqlupdate)){ 
			$sqlbaby="insert into vetor_baby(id,openid,baby1)values('','$openid',$id)";
			$pdo->exec($sqlbaby);
			echo "投票成功";
		}
	}else{ 
		echo "不在投票时间内";
	}
}else{ 
	echo "已超出投票次数！";
}
	//unset($_COOKIE["$id"]);
	//var_dump($_COOKIE["$id"]) ;
/*//投票success
$sql="update baby set count1=count+1 ";
	if($pdo->exec($sql)){ 
		echo "投票成功";
	}
public function dateFormat ($time){ 
	$end=date('Y-m-d',strtotime($time));
	$arr=explode('-',$end);
	$year=(int)$arr['0'];
	$month=(int)$arr[1];
	$day=(int)$arr[2];
}
$start=date('Y-m-d',strtotime($start));
$arr=explode('-',$start);
$year1=(int)$arr['0'];
$month1=(int)$arr[1];
$day1=(int)$arr[2];
$end=date('Y-m-d',strtotime($end));
$arr=explode('-',$end);
$year2=(int)$arr['0'];
$month2=(int)$arr[1];
$day2=(int)$arr[2];
if($year1<$year){ 
	1
}else{ 

}*/
