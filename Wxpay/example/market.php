<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
<title></title>
<link href="css/bootstrap.min.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style type="text/css">
a:link{
text-decoration:none;
}
a:visited{
text-decoration:none;
}
a:hover{
text-decoration:none;
}
a:active{
text-decoration:none;
}
 
</style>

</head>

<body>
<div class="panel panel-primary">
    <div class="panel-heading text-center">我的订单</div>
	<div class="panel-body">


<form action="ajax.php" method="POST">  
<?php  
    session_start();  //重启session  
    //$money=$_SESSION['money'];
    //$store=$_SESSION['store'];
    $cart = $_SESSION['data'];
 	//$n= count($money);
 	//$all=$money+$store+$cart;
    //$all=array_merge_recursive($money,$store,$cart);
   //var_dump($cart);
    //echo "wdwdw";
    //echo count($money);
    //var_dump($money);
    //var_dump($store);  //得到购物车  
    $allfee=0;
    $allbody;
    $allstore;
    $allfee1=0;
    $allfee2=0;
    foreach($cart as $b=>$c){ 
		
		echo "<ul class='list-group'>";
		echo "<li class='list-group-item'>";
		echo "<input type='checkbox' value='$b' name='d[]' style='float:right; width:20px; height:20px; border-radius:10px;' />";
		echo "<p>商品：".$b."</p>";
		echo "<p><span>数量：";
	
		$i=0;

    			foreach ($c as $key => $value) {
    				# code...
    				
    				if($i%2==0)
    				{
    				echo"$value &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."单价:￥ ".$key;
    				echo "&nbsp";
    				
    				$allfee=$value*$key+$allfee;
    				$allbody=$b.'*'.$value.'|'.$allbody;
    				echo $allbody;
    				$num=$value;
    				}
    				else{
    					if($key=="窝里快购"){

						echo "<p><span class='glyphicon glyphicon-star'></span>&nbsp;<span>此商品由<span style='color:#F60;'>".$key."</span>提供，此商店满100包邮</p></li>"; 
						$allfee1=$allfee1+$num*$value;
						
					}
						if($key=='社区家'){ 
						echo "<p><span class='glyphicon glyphicon-star'></span>&nbsp;<span>此商品由<span style='color:#F60;'>".$key."</span>提供，此商店满100包邮</p></li>"; 
						$allfee2=$allfee2+$num*$value;
					}
    					$allstore=$key.'|'.$allstore;
    				}

    				$i++;
    			}
    	
       //对购物车里的商品进行遍历  
        //将商品的名字输出到页面上，每个商品前面对应一个多选框，其值是商品在购物车中的编号。  
        //用d作为购物车管理界面中  购物车所有的商品，用于index.php页面撤销/删除某些商品的业务处理。  
       //echo "<input type='checkbox' value='$i' name='d[]' />".$i.' 数量：'.$c."<br />";  
    } 
   	if((100-$allfee1)>0&&($allfee1!=0)){ 
   		$a1=100-$allfee1;
   		echo "<p><span class='glyphicon glyphicon-star'></span>&nbsp;<span>还差<span style='color:#F60;'>".$a1."</span>包邮，五里沟满100包邮</p></li>";
   	}
  	if((100-$allfee2)>0&&($allfee2!=0)){ 
   		$a2=100-$allfee2;
   		echo "<p><span class='glyphicon glyphicon-star'></span>&nbsp;<span>还差<span style='color:#F60;'>".$a2."</span>包邮，社区家满100包邮</p></li>";
   	}
    

?>  
	<p>合计：<span style="color:#F60;"><?php echo $allfee ?></span></p>
	<p>提醒：<span style="color:#F60;"><?php echo $allfee ?></span></p>
    <input type="submit" class="btn-primary" value="删除商品" />
    <input type="button" value="立即支付" class="btn-primary" onclick="location='http://admin.shequjia.cn/Wxpay/example/jsapi.php?money=<?php echo $allfee; ?>&body=<?php echo $allbody; ?>&store=<?php echo $allstore; ?>';"/>
    <input type="button" value="继续购物" class="btn-primary" onclick="location='list1.html';" /> 
</form>
</div>
</div>
</body>
