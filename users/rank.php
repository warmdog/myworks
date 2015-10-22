<?php
 date_default_timezone_set('PRC');
include_once"testmysql.php";
$array = array();
//$sqlrank1="select userscoin,date from auction where goodsid=2 order by userscoin desc limit 1"; order by userscoin desc limit 1
for($i=0;$i<9;$i++)
{
	$sqlrank="select a.userscoin,a.date,a.usersopenid, b.username from auction a,users b where a.goodsid=$i+1 and a.state='0'and a.usersopenid=b.openid ";
	$rank1=$pdo->query($sqlrank);
	foreach ($rank1 as $rank) {
			//echo $rank['userscoin'];
			$date1= date($rank['date']);
		    $time = date('Y-m-d',strtotime($date1));
			$arr=explode("-",$time);
			$year=(int)$arr[0];
			$month=(int)$arr[1];
			$day=(int)$arr[2];
			//echo $day;
			$time1=date('Y-m-d',time());
			$arr1=explode("-",$time1);
			$year1=(int)$arr1[0];
			$month1=(int)$arr1[1];
			$day1=(int)$arr1[2];
			//echo $day1;
			
			if(($year<=$year1)&&($month<=$month1)&&($day<$day1)){ 
				$max=array();
				if($rank['userscoin']>$max[$i]){
					
					$name=array();
					$max[$i]=$rank['userscoin'];
					$name[$i]=$rank['username'];
				}
				
			}
			
			
	}
	
	$array[$i]['max']=$max[$i];
	$array[$i]['name']=$name[$i];
	
}	
//var_dump($array);
	//echo "</br>";
//echo $array[2]['max'];
?>
