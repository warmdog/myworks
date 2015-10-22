
<?php
session_start();
date_default_timezone_set('PRC');
include('testmysql.php');
$sql="select * from content ";
$raw11=$pdo->query($sql);
$sql11="select * from goods  ";
$raw22=$pdo->query($sql11);
$openid11=$_SESSION['openid'];
$sql12="select * from users where openid='$openid11'";
$raw33=$pdo->query($sql12);
foreach ($raw33 as $key12 ) {
	$name=$key12['name'];
	$address=$key12['address'];
	$phone=$key12['phone'];
	$date10=date($key12['date']);//这是用户上次签到时间
	//$date11=strtotime($date11);
	# code...
}
$sql13="select * from auction where usersopenid='$openid11'";
$raw44=$pdo->query($sql13);
foreach ($raw44 as $key55 ) {
	$date111=$key55['date'];//这是用户上次拍卖时间
	# code...
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" 
	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>社区家用户中心</title>
	<style type="text/css">
		body,html{
			margin: 0px;
			padding: 0px;
			font-family: "Microsoft YaHei";
			font-family:"微软雅黑";
		}
		a{
			text-decoration: none;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="css/homePage.css"/>
	<link rel="stylesheet" type="text/css" href="iconfont/icons/iconfont.css"/>
	<link rel="stylesheet" type="text/css" href="iconfont/icongetmoney/iconfont.css"/>
	<link rel="stylesheet" type="text/css" href="iconfont/icongift/iconfont.css"/>
	<link rel="stylesheet" type="text/css" href="iconfont/iconperson/iconfont.css"/>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css"/>
	<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
	<div id="headLang" class="head">
			<img style="width:50px;height:50px;margin-top:5px;margin-left:10px;border-radius:10px;border:solid 1px #FAD200;float:left;"
			 src="<?php  echo $_SESSION['headimgurl'];?>"/>
			 <text style="float:left;margin-left:10px;">
			 	<br/><b><?php echo $_SESSION['nickname'];?></b>
			 	<b id="customerDate" style="display:none;"><?php echo $date10;?></b>
				<b id="auctionDate" style="display:none;"><?php echo $date111 ;?></b>
			 	<br/><text id='openid' style="display:none;"><?php echo $_SESSION['openid'];?></text>
			 	<b id="customerAddr"><?php echo $address;?></b>
			 	<b id="customerPhone"><?php echo $phone;?></b>
				<b id="customerName"><?php echo $name;?></b>
			 </text>
	</div>
	<!--论坛首页-->
	<!--承接函数-->
	<script type="text/javascript">
		function homePage(){
			$("#qiandaoPage").css('display','none');
			$("#customerPage").css('display','none');
			$("#welfare").css('display','none');
			$("#singelPai").css('display','none');
			$("#resultPai").css('display','none');
			$("#content").css('display','block');
			$("#headLang").css('display','block');
		}
	</script>
	<div id="content" class="lists">
	<br/><br/><br/><br/>
		<ul>
			<?php     
			foreach ($raw11 as $key11 ) {
				$head=	 $key11['head'];
				$content= $key11['content'];
				$url= $key11['url'];
				$imgsrc= $key11['imgsrc'];
				echo "<li><a href='$url'>";
				echo "<div>
							<p id='title01'><b>$head</b></p>
							<p class='mainText' id='text01'>$content</p>
					</div>";
				echo "<img id='img01' src='$imgsrc'/></a></li>"	;			
} ?>
			<br/>
			<br/>
		</ul>
	</div>
	<div id="footLang" class="checkBoxBottom">
		<div>
			<div onclick="homePage();">
				<i class="iconfont icon-home"></i><br/>
				<text>首页</text>
			</div>
			<div onclick="qiandaoLe();">
				<i class="iconfont icon-shoukuan"></i><br/>
				<text>签到宝</text>
			</div>
			<div onclick="welfare();">
				<i class="iconfont icon-gift"></i><br/>
				<text>乐哈拍</text>
			</div>
			<div onclick="customerLe();">
				<i class="iconfont icon-kefuyouxian"></i><br/>
				<text>我的乐哈</text>
			</div>
		</div>
	</div>
	<!--签到宝-->
	<!--承接函数-->
	<script type="text/javascript">
	function qiandaoLe(){
		$("#content").css('display','none');
		$("#welfare").css('display','none');
		$("#customerPage").css('display','none');
		$("#singelPai").css('display','none');
		$("#resultPai").css('display','none');
		$("#headLang").css('display','block');
		$("#qiandaoPage").css('display','block');
	}
	</script>
	<!--页面-->
	<div id="qiandaoPage" style="display:none;background-color:#515151;height:100%;width:100%;">
		<!--进度条 -->
		  <div style="position:fixed;background-color:#000;width:96px;height:10px;border-radius:3px;margin-top:5px;left:10%;top:100px;">
				<div id="loading" style="position:absolute;top:0px;left:0px;background-color:#F1C40F;width:96px;height:10px;border-radius:3px;">
			 	</div>
			 	<text style="position:absolute;top:0px;left:110px;color:#fff;font-size:10px;">
			 			<b id="loadText">？</b>/<b>24</b>
			 	</text>
		  </div>
		   <div style="position:fixed;top:100px;right:40px;">
		  	<img src="imgs/habi.png" style="width:30px;height:30px;float:left;"/>
		  	<b id="habiNum" style="float:left;line-height:15px;font-size:10px;color:#fff;"><br/><?php include('testmysql.php');
			//$coin=$_POST['coin'];
			$id=$_SESSION['openid'];
			$sql="select coin  from users where openid='$id' ";
			$qq=$pdo->query($sql);
			foreach ($qq as $key) {
				$coin1= $key['coin'];
				//$date=$key['date'];
				# code...
			}
			echo $coin1;
			?>
			</b>
		  </div>
		  <!-- 主容器-->
		  <div id="slime_conteneur" style="position:fixed;top:40%;">
		  	<div id="tolk" style="position:absolute;left:40px;top:-40px;color:#fff;width:200px;font-size:10px;">
		  		你好!我的名字叫金小包!快摸摸我吧！
		  	</div> 
		  	<img id="habi" src="imgs/habi.png" style="position:absolute;left:50%;top:80px;color:#fff;width:10px;height:10px;z-index:7;display:none;"/>
		  	<li style="position:relative;list-style-type:none;z-index:0;">
		  		<img id="back" src="imgs/back.png" style="position:absolute;color:#fff;width:200px;height:100px;left:30%;"/>	
		  	</li>
			  <!--馒头-->
			<div class="slime" id="slime1" style="z-index:1;">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="125px" height="100px" viewBox="0 0 126.75 103.25" enable-background="new 0 0 126.75 103.25" xml:space="preserve">
				<g class="corps">
					<path d="M126.153,71.798c0,35.275-30.128,31.452-65.403,31.452S0.411,107.073,0.411,71.798S34,0.927,63.282,0.927
						C92,0.927,126.153,36.523,126.153,71.798z"/>
				</g>
				<g class="ombre">
					<path opacity="0.1" d="M98.583,98.968c0,5.085-4.708,4.313-37.833,4.313c-29.563,0-32.769,0.771-32.769-4.313
						c0-8.718,18.86-10.218,35.301-10.218C79.407,88.75,98.583,91.125,98.583,98.968z"/>
				</g>
				<g class="reflet">
						<ellipse transform="matrix(0.5486 -0.8361 0.8361 0.5486 20.2905 77.5842)" opacity="0.5" fill="#FFFFFF" cx="82" cy="20" rx="7.75" ry="13.75"/>
				</g>
				<g class="yeux">
					<g> 
						<path d="M36.833,66.583c-3.359,0-6.083,2.724-6.083,6.083c0,3.359,2.724,6.083,6.083,6.083c3.36,0,6.083-2.724,6.083-6.083
							C42.917,69.307,40.193,66.583,36.833,66.583z M39.5,71.25c-0.874,0-1.583-0.709-1.583-1.583c0-0.875,0.709-1.583,1.583-1.583
							c0.875,0,1.583,0.709,1.583,1.583C41.083,70.541,40.375,71.25,39.5,71.25z"/>
						<circle fill="#FFFFFF" cx="39.5" cy="69.667" r="1.583"/> 
						<path d="M88.833,66.583c-3.359,0-6.083,2.724-6.083,6.083c0,3.359,2.724,6.083,6.083,6.083c3.36,0,6.083-2.724,6.083-6.083
							C94.917,69.307,92.193,66.583,88.833,66.583z M91.5,71.25c-0.874,0-1.583-0.709-1.583-1.583c0-0.875,0.709-1.583,1.583-1.583
							c0.875,0,1.583,0.709,1.583,1.583C93.083,70.541,92.375,71.25,91.5,71.25z"/>
						<circle fill="#FFFFFF" cx="91.5" cy="69.667" r="1.583"/>
					</g>
				</g>
				<g class="bouche">
					<g>
						<path fill="#A862A6">
							<animate id="animBouche" attributeName="d" dur="3s" repeatCount="indefinite" values="M49.9,78c0,3.151,1.885,5.435,4.528,7c3.228-1.911,7.589-2.749,11.072-2.749S73.344,83.089,76.572,85
					c2.643-1.565,4.528-3.849,4.528-7H65.584H49.9z; 
							M49.9,73c0,3.151,1.885,10.435,4.528,12c3.228-1.911,7.589-2.749,11.072-2.749S73.344,83.089,76.572,85
					c2.643-1.565,4.528-8.849,4.528-12H65.584H49.9z;
					M49.9,78c0,3.151,1.885,5.435,4.528,7c3.228-1.911,7.589-2.749,11.072-2.749S73.344,83.089,76.572,85
					c2.643-1.565,4.528-3.849,4.528-7H65.584H49.9z" />
						</path>
						<path fill="#E0B7E5" d="M52.678,84.25c7.116,3.558,15.028,3.558,22.144,0C68.463,80.485,59.037,80.485,52.678,84.25
							C52.679,84.25,52.656,84.25,52.678,84.25z"/>
					</g>
				</g>
				</svg>
			</div>
		</div>
		  <script>
		  //全局变量
		  var jugeDate=false;//false为不可进行签过，true为可进行签到
		  	//Colors from : http://flatuicolors.com/
		$(
			function(){
				loading();
			}
		);
		//初始化签到宝
		function loading(){
			//启动计时函数
			setTimes();
		}
		function setBabyYes(){
				var numFond = Math.floor((Math.random() * 10) + 1); 
				var couleurSlime="#FBE15E";
				var corpsSlime = document.getElementsByClassName("corps");
				corpsSlime[0].style.fill = couleurSlime;
				$("#slime1").one(
					'click',
					function(){
						$('#tolk').html('<b>Blin!Blin!</b>');
						$("#slime1").addClass("actived");
						var couleurSlime="#ddd";
						var corpsSlime = document.getElementsByClassName("corps");
						corpsSlime[0].style.fill = couleurSlime;
						$("#loading").animate({width:'0px'},2000);
						$("#habi").css("display","block");
						$("#habi").animate({width:'100px',height:'100px',position:'fixed',top:'60px',left:'40%'},3000,
							function(){
								$("#habi").fadeOut(2000);
								var num= $('#habiNum').text();
								var addNum=parseInt(10*Math.random());
								$('#tolk').text('恭喜，随机获取'+addNum+'哈币');
								addNum=addNum;
								num =parseInt(num)+addNum+'';
								// <!--阿加-->
								var customerId=$("#openid").text();
								//var customeId='oZjDqjmtBSoYpuralSpgfpSszL3Y';
									$.ajax({
					                  	url:'addcoin.php',
					                  	type:'post',
					                  	data:'customerId='+customerId+'&num='+num,
					                  	success:function(ee){
					                            //alert("加入成功!");
					                            $('#habiNum').html('<br/>'+num);
					                            $('#moneyNum').html('<br/>'+num);
					                        },
					                        error: function(XMLHttpRequest, textStatus, errorThrown) {
					                        	alert(XMLHttpRequest.status);
					                        	alert(XMLHttpRequest.readyState);
					                        	alert(textStatus);
					                        }

					                    });
								//阿加================
								$("#back").one(
									'click',
									function(){
										talk("<i>已经都给你了-。-，明天再来吧。</i>");
										$('#back').one(
											'click',
											function(){
												talk("<b>羞羞，今天不要见你了@。@</b>");
												$('#back').click(
													function(){
														talk("<b>不要再调戏人家啦！明天再来啦！</b>");
													}
												);
											}
										);
									}
								);
							});
					}
				);
		}
		function setBabyNo(){
						$('#tolk').html('<b>Blin!Blin!</b>');
						$("#slime1").addClass("actived");
						var couleurSlime="#ddd";
						var corpsSlime = document.getElementsByClassName("corps");
						corpsSlime[0].style.fill = couleurSlime;
								$('#tolk').text('leha！又见到你好高兴。');
								$("#back").one(
									'click',
									function(){
										talk("<i>已经都给你了-。-，明天再来吧。</i>");
										$('#back').one(
											'click',
											function(){
												talk("<b>羞羞，今天不要见你了@。@</b>");
												$('#back').click(
													function(){
														talk("<b>不要再调戏人家啦！明天再来啦！</b>");
													}
												);
											}
										);
									}
								);
		}
		function setTimes(){
			/**
			获取当前日期，获取上次签到日期。
			若签到日期在当前日期之前——》【1】
			【1】获取当前时间（小时 myHours)，小于9，则进度条长度为（9-myHours+15）*4；大于9，则进度条长度为24*4
			若签到时间为今天---》【2】
			【2】获取当前时间（小时 myHours），必定大于9，则进度条长度为（myHours-9）*4;
			*/
			//获取上次签到时间
				var qiandaoDate=$("#customerDate").html();
			if(qiandaoDate&&qiandaoDate!=null&&qiandaoDate!=''){
				var year=parseInt(qiandaoDate.substr(0,4));
				var month=parseInt(qiandaoDate.substr(5,2));
				var date=parseInt(qiandaoDate.substr(8,2));
			}else{
				var year=0;
				var month=0;
				var date=0;
			}
			//
		        var mydate=new Date();
		        var thisYear=mydate.getFullYear();
		        var thisMonth=mydate.getMonth()+1;
		        var thisDay= mydate.getDate();
			    var thisHours = mydate.getHours();
				//jugeDate,若签到时间与当前时间相隔小于一天,那么就为false
				//alert(year+'=='+thisYear+','+month+'=='+thisMonth+','+date+'=='+thisDay);
				if(year==thisYear&&month==thisMonth&&date==thisDay){
					jugeDate=false;
				}else{
					jugeDate=true;
				}
				//初始化进度条;
				if(jugeDate){
					if(thisHours<9){
					  thisHours=9-thisHours+15;
					}else{
					  thisHours=24;
					}
				}else{
					thisHours=thisHours-9;
				}
				var loadbar=thisHours*4;
				$("#loading").css('width',loadbar+'px');
				$("#loadText").html(''+thisHours);
				//初始化宠物
				if(jugeDate){
					setBabyYes();
				}else{
					setBabyNo();
				}
				//每隔3000000 ms进行一次判断，间隔时间接近一小时一次
		    	setTimeout("setTimes()",3000000);
		    }
		    //宠物对话
		    function talk(text){
				$('#tolk').html(text);
				$('#tolk').show();
				$('#tolk').fadeOut(3000);
			}
		</script>
	</div>
	<!--乐哈拍【fare】-->
	<!--承接函数-->
	<script type="text/javascript">
		function welfare(){
			$("#content").css('display','none');
			$("#qiandaoPage").css('display','none');
			$("#customerPage").css('display','none');
			$("#singelPai").css('display','none');
			$("#resultPai").css('display','none');
			$("#headLang").css('display','block');	
			$("#welfare").css('display','block');
		}
	</script>
	<style type="text/css">
		.imgsBoxes{
			width: 100%;
			height: 100px;
		}
		.imgsBoxes div{
			width: 33%;
			height: 100px;
			float: left;
			cursor: pointer;
		}
		.imgsBoxes div img{
			width:60%;
			height:60px;
			margin: 0px auto 0px auto;
			border-radius:3px;
		}
		.imgsBoxes div p{
			font-size: 10px;
			margin: 0px;
			text-align: center;
			color:#AAA;
			overflow: hidden;
			white-space:nowrap;
			text-overflow:ellipsis;
		}
	</style>
	<div id="welfare" style="display:none;">
		<!--拍卖结果-->
		<div onclick="resultPai()" style="font-size:14px;position:fixed;right:10px;top:0px;">
		<br/>
			我的竞拍>>>
		</div>
		<br/><br/><br/><br/>
		<!--商品展示-->
			<?php 
				 $i=0;
				foreach ($raw22 as $key22 ) {
					$goodsid=$key22['id'];
					$goodsname=$key22['goodsname'];
					$goodsabout=$key22['about'];
					$goodsimg=$key22['imgsrc'];
					$goodsreserve=$key22['reserve'];
					if($i%3==0){
						echo "<div class='imgsBoxes'>";
					}
					$a11=$i+1;
					echo "<div  align='center' id='$goodsid' onclick='singelPai(this);' name='$a11'>";
					echo"  <img id='img$a11' src='$goodsimg'/>";
					 echo " <p id='name$a11'>$goodsname</p>
					 		<b id='price$a11' style='display:none;'>$goodsreserve</b>
					 		<b id='desc$a11' style='display:none;'>$goodsabout</b>
					</div>";
					if($i%3==2){
						echo "</div>";
					}
					$i++;
				}
			?>	
		<!--竞拍榜-->
		<div onclick="" style="margin-bottom:10px;margin-left:3%;">
			<style type="text/css">
				#resultPaiList ul{
					margin: 0px;
					padding: 0px;
					margin-right: 3%;
				}
				#resultPaiList ul li{
					display: block;
					height:60px;
					line-height: 30px;
					background-color:#fff; 
					width:80%;
					margin-left: 10%;
				}
				#resultPaiList ul li text{
					border: 0px;
					display: block;
					height:30px;
					line-height: 30px;
					background-color:#DDB172;
					text-align: center; 
				}
				#resultPaiList ul li p{
					margin: 0px;
					border: 0px;
					display: block;
					height:30px;
					line-height: 30px;
					background-color:#CA9149; 
					text-align: center;
				}
			</style>
			<div id="resultPaiList">
				<ul style="border-bottom:dotted 2px #999;">
					<li>
						<p style="background-color:#fff;">&nbsp</p>
						<text style="background-color:#a96b26;color:#fff;width:100%;margin:0px;">
							昨日竞拍结果
							<b id="togglePaiHang" style="display:block;width:30px;float:right;text-align:center;background-color:#a96b26;margin-right:10px;" onclick='showListPaiHang()'>↑</b>
						</text>
						<script type="text/javascript">
							function showListPaiHang(){
								$(".PaiHang").toggle();
								var text=$("#togglePaiHang").html();
								if(text=='↑'){
									text='↓';
								}else if(text=='↓'){
									text='↑'
								}
								$("#togglePaiHang").html(text);
							}
						</script>
					</li>
						<li class="PaiHang">
							<text>商品名称</text>
							<p>xx出价100哈币</p>
						</li>
						<li class="PaiHang">
							<text>商品名称</text>
							<p>xx出价100哈币</p>
						</li>
						<li class="PaiHang">
							<text>商品名称</text>
							<p>xx出价100哈币</p>
						</li>
						<li class="PaiHang">
							<text>商品名称</text>
							<p>xx出价100哈币</p>
						</li>
					<li>
						<p style="background-color:#a96b26;border-top:solid 1px #000;">&nbsp</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!--乐哈拍子页：单个商品拍卖-->
	<!--承接函数-->
<div>
	<script type="text/javascript">
		var minPai=0;
		var maxPai=0;
		function singelPai(obj){
			//根据商品id进行初始化  阿加
			var ProductId=$(obj).attr("id");
			var i=$(obj).attr("name");
			var Pname=$("#name"+i).text();
			var Pimg=$("#img"+i).attr("src");
			//开发中
			var Pdesc=$("#desc"+i).text();
			minPai=$("#price"+i).text();
			maxPai=$("#habiNum").text();
			var ProductId=$(obj).attr("name");
			$('#singelPaiName').text(Pname);
			$('#singelPaiImg').attr('src',Pimg);
			$('#singelPaiId').text(ProductId);
			$('#singelPaiDesc').text(Pdesc);
			//控制显隐藏
			$("#content").css('display','none');
			$("#qiandaoPage").css('display','none');
			$("#customerPage").css('display','none');
			$("#welfare").css('display','none');
			$("#resultPai").css('display','none');
			$("#headLang").css('display','block');	
			$("#singelPai").css('display','block');
			//设定起拍价
			$("#haBiNumPai").val(''+minPai);
		}
	</script>
	<style type="text/css">
		.desc p{
			margin: 0px;
			margin-left: 20%;
			width:60%;
			text-align: left;
			color:#AAA;
			overflow: hidden;
		}
		#customerInfo ul{
			margin: 0px;
			padding: 0px;
			margin-right: 3%;
		}
		#customerInfo ul li{
			color:#333;
			display: block;
			height:60px;
			line-height: 60px;
			background-color:#CCC; 
		}
		#customerInfo ul li text{
			width:20%;
			text-align: right;
			border: 0px;
			display: block;
			height:50px;
			line-height: 50px;
			background-color:#CCC;
			float:left; 
		}
		#customerInfo ul li input{
			margin: 15px 0px 0px 0px;
			border: 0px;
			display: block;
			height:20px;
			line-height: 20px;
			background-color:#eee; 
			float:left;
		}
		#customerInfo ul li text b{
			color: #f00; 
		}
	</style>
		<div id="singelPai" style="display:none;">
			<div onclick="welfare();" style="font-size:14px;position:fixed;right:10px;top:0px;">
				<br/>
					前往拍卖大厅>>>
			</div>
			<br/><br/><br/><br/>
			<div>
				<img id="singelPaiImg" src="imgs/02.jpg" style="margin-left:20%;width:60%;height:150px;border-radius:10px;border:solid 3px #333;">
			</div>
			<div class="desc">
				<b id='singelPaiId' style="display:none;"></b>
				<p id='singelPaiName' style="color:#313131;font-size:14px;text-align:center;">商品名称</p>
				<p id="singelPaiDesc" style="color:#919191;height:40px;line-height:20px;font-size:12px;"></p>
			</div>
			<div>
					<p id="clickToggel" style="text-align:center;" onclick="toggleCustomerInfo()">修改个人信息↓↓↓</p>
					<div id="customerInfo" style="display:none">
						<ul style="border-bottom:dotted 2px #999;">
							<li style="height:30px;line-height:30px;">
								<b style="font-size:12px;margin-left:20%;color:#f00;">请维护以下信息,以便我们配送礼品:<b>
							</li>
							<li>
								<text><b>*</b>地址:&nbsp&nbsp&nbsp</text>
								<input id="Addr" type="text" value="<?php echo $address;?>" style="width:60%;"/>
							</li>
							<li>
								<text><b>*</b>号码:&nbsp&nbsp&nbsp</text>
								<input id="phoneNum" type="text" value="<?php echo $phone;?>"  style="width:60%;"/>
							</li>
							<li>
								<text><b>*</b>姓名:&nbsp&nbsp&nbsp</text>
								<input id="name" type="text" value="<?php echo $name;?>"  style="width:60%;"/>
							</li>
							<li>
								<button onclick="commitCustomer()" style="margin-left:20%;width:60%;border-radius:3px;color:#333;background-color:#fff;">提交</button>
							</li>
						</ul>
					</div> 
			</div>
			<div style="margin-bottom:40px;margin-top:20px;">
				<button onclick="cutPai()" style="margin-left:20%;width:10%;">-</button>
				<input id="haBiNumPai" type="text"  
					style="width:35%;border-radius:3px;color:#FA3737;text-align:center;font-weight:bold;" 
					readonly="readonly" value="0" />
				<button  onclick="addPai();" style="width:10%;">+</button>
			</div>
			<div>
				<button id="singelPaiCommit" onclick="commitSingelPai();" style="margin-left:20%;width:60%;border-radius:3px;color:#333;background-color:#fff;display:none;">
					竞拍
				</button>
				<button id="singelPaiNo" onclick="alert('您已在本轮拍卖过了');" style="margin-left:20%;width:60%;border-radius:3px;color:#333;background-color:#DDD;">
					您已在本轮拍卖过了
				</button>	
			</div>
		</div>
		<br/><br/><br/>
	</div>
	<!--竞拍页对应脚本-->
	<!--阿加-->
	<script>
		var jugeAuction=false;
						$(
							function(){
								jugePaiMai();
								//
								var jugeByName=$("#name").val();
								if(jugeByName&&jugeByName!=""&&jugeByName!=null){
									hideCustomerInfo();
								}else{
									showCustomerInfo();
								}
							}
						);
						function toggleCustomerInfo(){
							$('#customerInfo').toggle();
							var text=$("#clickToggel").html();
							if(text=="修改个人信息↓↓↓"){
								text="收起个人信息↑↑↑";
							}else if(text=="收起个人信息↑↑↑"){
								text="修改个人信息↓↓↓";
							}
							$("#clickToggel").html(text);
						}
						function showCustomerInfo(){
							$("#customerInfo").show();
							var text="收起个人信息↑↑↑";
							$("#clickToggel").html(text);
						}
						function hideCustomerInfo(){
							$("#customerInfo").hidden();
							var text="修改个人信息↓↓↓";
							$("#clickToggel").html(text);
						}
						function commitCustomer(){
							var addr=$('#Addr').val();
							var phoneNum=$('#phoneNum').val();
							var name=$('#name').val();
							if(addr==""||phoneNum==""||name==""){
								alert("请将上方信息填写完整，以便我们配送礼品。");
							}else{
								$.ajax({
					              	url:'add.php',
					              	type:'post',
					              	data:'addr='+addr+'&phoneNum='+phoneNum+'&name='+name,
					              	success:function(ee){
					              		if(ee==""){
					              			ee="信息维护成功"
					              		}
					              		alert(ee);
				                    },
				                    error: function(XMLHttpRequest, textStatus, errorThrown){
				                    	alert(XMLHttpRequest.status);
				                    	alert(XMLHttpRequest.readyState);
				                    	alert(textStatus);
				                    }
				                });
							}
						}
		function jugePaiMai(){
			//上次拍卖时间
			var auctionDate=$("#auctionDate").html();
			if(auctionDate&&auctionDate!=null&&auctionDate!=''){
				var year=parseInt(auctionDate.substr(0,4));
				var month=parseInt(auctionDate.substr(5,2));
				var date=parseInt(auctionDate.substr(8,2));
			}else{
				var year=0;
				var month=0;
				var date=0;
			}
			//当前时间
		        var mydate=new Date();
		        var thisYear=mydate.getFullYear();
		        var thisMonth=mydate.getMonth()+1;
		        var thisDay= mydate.getDate();
		        var thisXinQi=mydate.getDay();
		    //计算时间节点的日期。
		    /**
		    当前的星期（thisXinQi）：
		    星期三的日期为thisDay+（3-thisXinQi）;
		    星期五的日期为thisDay+（5-thisXinQi）;
		    */
		    var xinqiDate00=thisDay+(0-thisXinQi);
		    var xinqiDate03=thisDay+(3-thisXinQi);
		    var xinqiDate05=thisDay+(5-thisXinQi);
		    //判断本轮内是否进行过竞拍
		    /**
		    落点：最近一次竞拍时间是否落在本轮时间内。
		    周6到周三算一轮
		   当前的星期（thisXinQi）;拍卖日期（date）：
		   如果  thisXinQi<3判断条件是 0<dat&&date<3  ====>false 
		   如果 thisXinQi==6||0  周末不拍卖	====>false 
		   否则判断条件是 3<dat&&date<5	====>false 
		    */
		    var text="您已在本轮拍卖过了";
		    if(thisXinQi==0){
		    	jugeAuction=false;
		    	text="周末不拍卖";
		    }else if(thisXinQi<3){
		    	if(xinqiDate00<=date&&date<=xinqiDate03){
		    		jugeAuction=false;
			    }else{
			    	jugeAuction=true;
			    }
		    }else if(thisXinQi==6){
		    	jugeAuction=false;
		    	text="周末不拍卖";
		    }else{
		    	if(xinqiDate03<=date&&date<=xinqiDate05){
		    		jugeAuction=false;
			    }else{
			    	jugeAuction=true;
			    }
		    }
		    if(jugeAuction){
		    	$("#singelPaiCommit").css("display","block");
		    	$("#singelPaiNo").css("display","none");
		    }else{
		    	$("#singelPaiNo").text(text);
		    	$("#singelPaiNo").click(
		    		function(){
		    			alert(text);
		    		}
		    	);
		    	$("#singelPaiCommit").css("display","none");
		    	$("#singelPaiNo").css("display","block");
		    }
		}
		function addPai(){
			var haBiNumPai=$('#haBiNumPai').val();
			haBiNumPai=parseInt(haBiNumPai);
			var max=parseInt(maxPai);
			if(haBiNumPai<max){
				haBiNumPai=haBiNumPai+1;
				$('#haBiNumPai').val(""+haBiNumPai);
			};
		}
		function cutPai(){
			var haBiNumPai=$('#haBiNumPai').val();
			haBiNumPai=parseInt(haBiNumPai);
			haBiNumPai=haBiNumPai-1;
			var min=parseInt(minPai);
			if(min<haBiNumPai){
				$('#haBiNumPai').val(""+haBiNumPai);
			}
		}
		//阿加
		function commitSingelPai(){
			//alert("jssdas");
			var customerId=$("#openid").text();
			var productId=$("#singelPaiId").text();
			var numPai=$("#haBiNumPai").val();
			var max=parseInt(maxPai);
            var min=parseInt(minPai);
            var haBiNumPai=$('#haBiNumPai').val();
            //开发中
            var myPaiImg=$('#singelPaiImg').attr('src');
            //alert(customerId+numPai+productId);
            //alert(max);
            var addr=$('#Addr').val();
			var phoneNum=$('#phoneNum').val();
			var name=$('#name').val();
			if(addr==""||phoneNum==""||name==""){
				alert("请填写个人信息，以便我们配送礼品。");
				showCustomerInfo();
			}else{
				if(min>max){
	            	alert("您的乐哈币不够");
	            }else{
	         	//alert('dwd');
		              $.ajax({
		             	url:'auction.php',
		             	type:'post',
		             	data:'customerId='+customerId+'&haBiNumPai='+haBiNumPai+'&productId='+productId,
		            	success:function(ee){
		                       //alert("加入成功!");
		                        $("#singelPaiCommit").css("display","none");
			    				$("#singelPaiNo").css("display","block");
		                        $("#myPaiImg").attr("src",myPaiImg);
		                        $("#MyPdcImg").attr("src",myPaiImg);
		                        $("#myPaiNum").text("出价"+haBiNumPai+"乐哈币");
				       			$("#productNum").text("拍价"+haBiNumPai);
		                        alert(ee);
		                    },
		                    error: function(XMLHttpRequest, textStatus, errorThrown){
		                    	alert(XMLHttpRequest.status);
		                   		alert(XMLHttpRequest.readyState);
		                    	alert(textStatus);
		                    }
		                });
				}
			} 
		}
	</script>
	<!--我的竞拍-->
	<!--承接函数-->
	<script type="text/javascript">
		function resultPai(){
			$("#content").css('display','none');
			$("#qiandaoPage").css('display','none');
			$("#customerPage").css('display','none');
			$("#welfare").css('display','none');
			$("#singelPai").css('display','none');
			$("#headLang").css('display','block');	
			$("#resultPai").css('display','block');
		}
	</script>
	<div id="resultPai" style="display:none;">
		<div onclick="welfare();" style="font-size:14px;position:fixed;right:10px;top:0px;">
			<br/>
				返回>>>
		</div>
		<br/><br/><br/><br/>
		<div>
			<img id='myPaiImg' src="<?php include('myauction.php'); echo $imgsrc1;?>" style="margin-left:20%;width:60%;height:150px;border-radius:10px;border:solid 3px #333;"/>
		</div>
		<div class="desc">
			<p style="color:#313131;font-size:14px;text-align:center;"><?php echo $goodsname1 ;?></p>
			<p style="color:#919191;height:40px;line-height:20px;font-size:12px;"><?php echo $about1 ;?></p>
			<p id="myPaiNum" style="color:#919191;font-size:10px;">出价：<?php  echo $userscoin; ?>乐哈币</p>
		</div>
		<div>
			<p style="margin-left:20%;width:60%;border-radius:3px;color:#333;font-size:10px;">
				当前状态:
				<b>竞拍中</b>
			</p>
		</div>
		<br/><br/><br/>
	</div>
	<!--我的乐哈[customer]-->
	<!--承接函数-->
	<script type="text/javascript">
		function customerLe(){
			$("#content").css('display','none');
			$("#qiandaoPage").css('display','none');
			$("#welfare").css('display','none');
			$("#singelPai").css('display','none');
			$("#resultPai").css('display','none');
			$("#headLang").css('display','block');
			$("#customerPage").css('display','block');
		}
	</script>
	<style type="text/css">
		.customerPage{
			height: 100%;
			background-color: #efefef;
			font-size: 14px;
			color:#777;
		}
		.customerPage ul{
			padding: 0px;
			margin: 0px;
		}
		.customerPage ul li{
			background-color: #fff;
			height: 40px;
			line-height: 40px;
			list-style-type :none;
		}
		.customerPage ul li b{
			margin-left: 10px;
			float: left;
		}
		.customerPage ul li img{
			float:right;
			width:20px;
			height:20px;
			margin-top: 5px;
			border-radius: 3px;
			margin-right: 5px;
			border: solid 1px #f00;
		}
		.customerPage ul li text{
			float:right;
			margin-right: 5px;
		}
	</style>
	<div id="customerPage" class="customerPage" style="display:none;">
		<br/><br/><br/><br/><br/>
		<ul>
			<br/>
			<li onclick="resultPai();">
				<b>我的竞拍</b><text id="productNum">拍价<?php  echo $userscoin;?></text><img id="MyPdcImg" style=""  src="<?php echo $imgsrc1;?>"/>
			</li>
			<br/>
			<li onclick="qiandaoLe();">
				<b>我的签到宝</b><text id="moneyNum"><?php echo $coin1;?></text><img style="" src="imgs/habi.png"/>
			</li>
			<br/>
			<li>
				<b>前往福利集市</b>
			</li>
			<br/>
			<li>
				<b>前往论坛</b>
			</li>
		</ul>
	</div>
	<script type="text/javascript">
	</script>
</body>
</html>
