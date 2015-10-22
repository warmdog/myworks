

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
<meta http-equiv="Refresh" content="600" />
<title>商家后台</title>
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
    <div class="panel-heading">窝里快购订单接收，每30分钟刷新一次</div>
	<div class="panel-body">
		<p>为了社区家能和各位商家长久合作下去，秉着诚信负责的态度，希望商家能够认真对待，做好售后服务，谢谢大家！</p>
		<ul class="list-group">
			
		<?php 
			include_once('testmysql.php');
			include('name.php');
			$sql="select username, phone ,adress ,fee,store,body  from users order by id desc ";
			$aa=$pdo->query($sql);
			foreach($aa as $row){
		
				$arr=explode("|",$row['body']);
				//echo $row['body'];
		if(strpos($row['store'],'窝里快购')!==false){
    			echo "<li class='list-group-item'>姓名：".$row['username']."&nbsp&nbsp&nbsp"."手机号：".$row['phone']."&nbsp&nbsp&nbsp"."收货地址：".$row['adress']."&nbsp&nbsp&nbsp"."总价：".$row['fee']."&nbsp&nbsp&nbsp"."商品：";
				
    			
    				
						foreach ($arr as $key) {
						$strarr=explode("*",$key);
						$a=constant($strarr[0]).'*'.$strarr[1];
						$b=rtrim($a,'*');
						echo $b;
				
				}
			if(strpos($row['body'],'*')==false){ echo $row['body'];}

    			echo "</li>";

}
}
?>
            	
                
            
			
		</ul>
	</div>

</div>

<div style="width:100%; margin:20px auto; text-align:center;">
	<a href="http://www.shequjia.cn/" style="color:#333;">乐哈网络</a>&nbsp;&nbsp;
    <a href="##" style="color:#333;">电话：0571-86970292</a>&nbsp;&nbsp;
    <a href="##" style="color:#333;">企业QQ：800077639</a>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
