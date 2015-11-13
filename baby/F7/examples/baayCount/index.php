<?php 
session_start();
$openid = $_SESSION['openid'];
//$openid=$_COOKIE["openid"];

if(empty($_SESSION['openid'])){ 
	header("Location:http://mp.weixin.qq.com/s?__biz=MzAxOTUyMzg5Mg==&mid=400367511&idx=1&sn=49bfb41ef11b85409a90776197ff6eeb#rd");	
	exit;
}
include_once"testmysql.php";
//$sql="select * from baby order by rand() ";
$sql="select * from baby order by id ";
$row=$pdo->query($sql)->fetchAll();
$sql="select sum(aa.count1) as a ,count(aa.id) as b ,bb.count as c from baby aa,count bb ";
$row1=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$sql2="update count set count=count+1 where id=1" ;
$pdo->exec($sql2);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>宝贝活动</title>
    <!-- Path to Framework7 Library CSS-->
    <link rel="stylesheet" href="../../dist/css/framework7.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <link rel="stylesheet" type="text/css" href="css/toolbar.css"> 
    <link rel="stylesheet" type="text/css" href="css/inputs.css">
    <link rel="stylesheet" type="text/css" href="css/buttons.css">
    <link rel="stylesheet" type="text/css" href="css/alert.css">
    <link rel="stylesheet" href="font/dianzan/demo.css">
    <link rel="stylesheet" href="font/dianzan/iconfont.css">
    <link rel="stylesheet" href="font/pushDown/iconfont.css">
    <style type="text/css">
       body,html{
        margin: 0px;
        padding: 0px;
        font-family:'KaiTi';
        font-size: 20px;
      }
      .hide{
        display:none;
      }
    </style>
  </head>
  <body>
    <!-- Status bar overlay for fullscreen mode-->
    <div class="statusbar-overlay"></div>
    <!-- Right panel with cover effect-->
    <div class="panel panel-right panel-reveal">
      <div class="content-block">
        <p>Right panel content goes here</p>
      </div>
    </div>
    <!-- Views-->
    <div class="views">
      <!-- Put panels-overlay and left-panel with view inside of views-->
      <!-- Panels overlay-->
      <div class="panel-overlay"></div>
      <!-- Left panel with reveal effect-->
      <div class="panel panel-left panel-cover">
        <!-- Left view-->
        <div class="view view-left navbar-through" style="display:none;">
        </div>
      </div>
      <!-- Right view, it is main view-->
      <div class="view view-main navbar-through">
        <div class="navbar" style="height:0px;">
            <div class="toolbar tabbar toolbar-fixed">
                <div class="toolbar-inner" style="padding:0px;">
                    <a href="index.php" class="link active"><i class="iconfont icon-home"></i><span class="tabbar-label" style="font-size:20px;">投票</span></a>
                    <a href="babyRank.php" class="link item-link"><i class="iconfont icon-sponsor"></i><span class="tabbar-label" style="font-size:20px;">排行榜</span></a>
                </div>
            </div>
            <!--信息板-->
            <b id="openId" style="display:none;" ><?php echo $openid;?></b>
            <!--单个宝贝弹出框-->
            <div id="singelBaby" class="SQJ-alert-1" style="z-index:20;">
                    <div class="closeIcon" onclick="hideBaby(this)">
                      ×
                    </div>
                   <div class="baby">
                    <div class="imgBox" style="margin-left:20px;">
                      <img name="thisImg" src="img/baby2.jpg">
                    </div>
                    <div class="dtail">
                     <br/>
                      <b name="thisNum"></b>
                      <b name="thisName"></b>
                      <br/>
                      <b name="thisTik"></b>
                    </div>
                  </div>
                  <img name="thisImg" src="img/baby2.jpg"/ style="width:100%;">
                  <div>
                    <p><b name="thisName"></b><b name="thisAge"></b></p>
                    <p name="thisFavorite"></p>
                  </div>
            </div>
            <!--单个页面弹出框-->
            <div id="searchResult" class="SQJ-alert-1" style="z-index:10;">
                    <div class="closeIcon" onclick="hideBaby(this)">
                      ×
                    </div>
                    <br/>
                    <br/>
                   <div id="searchBabys">
                   </div>
            </div>
          <!--
  		      <div class="right"><a href="#" data-panel="left" class="link open-panel icon-only"><i class="icon icon-bars"></i></a></div>
  		    --> 
        </div>
        <!-- Pages-->
        <div class="pages">
          <!-- Page, data-page contains page name-->
          <div data-page="index-1" class="page" style="background-color:#fff;padding:0px;margin:0px;">
            <!-- Scrollable page content-->
            <div class="page-content" style="padding-top:0px;font-size:20px;padding:0px;margin:0px;">
              <div class="content-block" style="padding:0px;margin:0px;">
                <img src="img/chengbao.png" style="width:100%;">
                <div style="width:100%;height:50px;margin-top:10px;">
                  <div style="width:33%;float:left;text-align:center;font-size:16px;border-right:solid 1px #ccc;color:#BBB;">
                    <div>宝贝数</div>
                    <div  style="font-size:14px;color:#333"><?php echo $row1[0]['b'];?> </div>
                  </div>
                  <div style="width:33%;float:left;text-align:center;font-size:16px;border-right:solid 1px #ccc;color:#BBB;">
                    <div>总票数</div>
                    <div  style="font-size:14px;color:#333"><?php echo $row1[0]['a'];?></div>
                  </div>
                  <div style="width:33%;float:left;text-align:center;font-size:16px;color:#BBB;">
                    <div>访问量</div>
                    <div style="font-size:14px;color:#333"><?php echo $row1[0]['c'];?></div>
                  </div>
                </div>
                <div>
                  <p style="text-align:center;font-size:20px;">活动描述</p>
                  <p style="padding:2px 10px;font-size:16px;">活动内容：一起投票选出我们最具人气的萌宝吧！</p>
                  <p style="padding:2px 10px;font-size:16px;">投票方式：在投票页面，为您喜欢的萌娃点赞。那么可爱的他（她）就会获得您所投出的宝贵一票。</p>
                  <p style="padding:2px 10px;font-size:16px;">每人一天最多可以投出三票，三票只能投给不同的宝贝。</p>
                  <p style="padding:2px 10px;font-size:16px;">大家一起来支持我们的宝贝们吧！</p>
                </div>
                <a href="shearchBaby.html">
                  <div name="anchor" style="background-color:#fff;padding:10px 0px;">
                    <div class="SQJ-input-1" style=" width:70%;
                                  height:40px;
                                  line-height: 40px;
                                  border-radius:0px;
                                  border: solid 1px #bbb; 
                                  background-color: #fff;
                                  margin-left:1%;
                                  text-align:center;
                                  color:#CCC;
                                  width:72%;
                                  display: inline-block;" >
                      宝贝姓名
                    </div> 
                    <button class="SQJ-button-1" style="width:23%;float:right;margin-right:1%;background-color:#fff;color:#666;border-radius:0px;border:solid 1px #bbb;">
                      搜索
                    </button>
                  </div>
                </a>
                <div style="width:100%;height:30px;background-color:#DDD;">
                  &nbsp
                </div>
                <br/>
                <!--遍历生成-->
                <div id='babys'>
                    <?php 
                      //$sql="select count(-1)+1  as rank from baby where count1>(select count1 from baby where id=$id)";
                      //$rank=$pdo->query($sql)->fetchColumn();
                      # code...
                    	for($i=0;$i<6;$i++)
                    	{
                    ?>
                    <div class="SQJ-halfList-5">
                    <div class="SQJ-halfList-5-inner" onclick="showBaby(this)" style="position:relative;">
                        <img name="img" src="<?php echo $row[$i]['imgurl'];?>"/>
                        <b style="top:0px;left:0px;background-color:#FF7F50;position:absolute;" name="num"><?php echo $row[$i]['id'];?>号</b>
                        <text style="bottom:0px;left:5%;font-size:14px;border-radius:0px;" name="name"><?php echo $row[$i]['name'];?></text>
                        <text style="bottom:0px;right:5%;border-radius:0px;" class="dianzan" onclick="dianzan(this)">
                          <i class="icon iconfont" style="font-size:26px;margin:0px;">&#xe65f;</i>
                          <tik name="tik" style="font-size:14px;"><?php echo $row[$i]['count1'];?></tik>
                        </text>
                        <text style="display:none;" name="favorite"><?php echo $row[$i]['hobby'];?></text>
                        <text style="display:none;" name="age"><?php echo $row[$i]['age'];?></text>
                    </div> 
                    </div>
                    <?php }?>
                  <!--初始化不显示的部分-->
                  <?php for($i=6;$i<count($row);$i++)
                  {      ?>
                  <div class="SQJ-halfList-5 SQJ-hideList">
                    <div class="SQJ-halfList-5-inner" onclick="showBaby(this)">
                        <img name="img" src=""/>
                        <b style="top:0px;left:0px;background-color:#FF7F50;position:absolute;" name="num"><?php echo $row[$i]['id'];?>号</b>
                        <text style="bottom:0px;left:5%;font-size:14px;border-radius:0px;" name="name"><?php echo $row[$i]['name'];?></text>
                        <text style="bottom:0px;right:5%;border-radius:0px;" class="dianzan" onclick="dianzan(this)">
                          <i class="icon iconfont" style="font-size:26px;margin:0px;">&#xe65f;</i>
                          <tik name="tik" style="font-size:14px;"><?php echo $row[$i]['count1'];?></tik>
                        </text>
                        <text style="display:none;" name="favorite"><?php echo $row[$i]['hobby'];?></text>
                        <text style="display:none;" name="age"><?php echo $row[$i]['age'];?></text>
                        <text style="display:none;" name="imgUrl"><?php echo $row[$i]['imgurl'];?></text>
                    </div> 
                    </div> 
                    <?php }?>
                    <div style="clear:both;"></div>
                </div>
                <div id="showMoreBabyToupiao" style="text-align:center;height:40px;color:#999;width:100%;margin-top:20px;border-top:solid 1px #ccc;"  onclick="showMoreToupiao()">
                  点击这里就能<i class="icon iconfontPushDowm" style="margin:0px;">&#xe60a;</i>看到更多萌娃
                </div>
                <p>
                  &nbsp
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="../../dist/js/framework7.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/my-app.js"></script>
    <script type="text/javascript" src="js/alert.js"></script>
    <script type="text/javascript" src="js/baby.js"></script>
    <script type="text/javascript">
    </script>
  </body>
</html>