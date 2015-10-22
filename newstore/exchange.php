<?php
session_start();

include_once"testmysql.php";

$openid=$_SESSION['openid'];

$sql="select bonus from new_users where openid='$openid'";

$row=$pdo->query($sql);

foreach ($row as $key ) {

	$bonus=$key['bonus'];

}

$sql1="select * from new_exchange where state='1'";

$row1=$pdo->query($sql1);

?>

<!DOCTYPE html>

<!--#2BB761 #F6D200  #E7652B-->

<html lang="zh-cn">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<title>积分商城</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="swiper/swiper.3.1.2.min.css">

<link rel="stylesheet" type="text/css" href="font/iconfont.css">

<link rel="stylesheet" type="text/css" href="css/mymain.css">

<!--[if lt IE 9]>

<script src="js/html5shiv.js"></script>

<script src="js/respond.min.js"></script>

<![endif]-->

</head>

<body>

<!--初始化判断-->

<b id="thisPageOpenid" style="display:none;">

  <?php echo $openid;?>

</b>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript">

$(

  function(){

    var juge=$("#thisPageOpenid").html();

    if(juge.length>2){

    }else{

      alert("您还未授权");

      window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5ac9358a3855640&redirect_uri=http://admin.shequjia.cn/newstore/oauth.php&response_type=code&scope=snsapi_userinfo&state=3d6be0a4035d839573b04816624a415e#wechat_redirect";

    }

  }

);

</script>

<!--页面内容-->

<div class="container-fuild store-banner">

  <img src="img/store-banner.jpg" alt="">

  <span>当前积分:<b id="bonusHave"><?php echo $bonus;?></b></span>

  <b id="openId" style="display:none;"><?php echo $openid;?></b>

</div>

<div class="container-fuild store-main">

<div class="row">

<?php  foreach ($row1 as $key1) {

	$name=$key1['goodsname'];

	$imgurl=$key1['imgurl'];

	$bonus1=$key1['bonus'];

   ?>

    <div class="col-xs-6 exchange">

      <img src="<?php echo $imgurl;?>">

      <p class="store-title"><b><?php echo $name;?></b></p>

      <p><span class="store-jifen">积分：<b><?php echo $bonus1;?></b></span><span class="store-change">立即兑换</span></p>

    </div>


  <?php  }?>

  </div>

</div>

<div class="toolbar tabbar toolbar-fixed">

    <div class="toolbar-inner">

        <a href="home.php" class="link"><i class="iconfont icon-home"></i><span class="tabbar-label">首页</span></a>

        <a href="#" class="link active"><i class="iconfont icon-sponsor"></i><span class="tabbar-label">兑换</span></a>

        <a href="my.php" class="link"><i class="iconfont icon-people"></i><span class="tabbar-label">我</span></a>

    </div>

</div>

<script type="text/javascript" src="swiper/swiper.3.1.2.min.js"></script>

<script type="text/javascript" src="js/mymain.js"></script>

<script type="text/javascript">

$(

    function(){

      $(".exchange").click(

          function(){

              var obj=this;

              var objList=$(obj).find('b');

              var openid=$('#openId').html();

              var goodsname=$(objList[0]).html();

              var bonus=$(objList[1]).html();

              bonus=parseInt(bonus);

              var bonusHave=$('#bonusHave').html();

              bonusHave=parseInt(bonusHave);

              if(bonusHave<bonus){

                  alert("您的当前积分为"+bonusHave+",不足以兑换该商品。");

              }else{

                 $.ajax({

                  url:'add1.php',

                  type:'post',

                  data:'openid='+openid+'&goodsname='+goodsname+'&bonus='+bonus,

                  success:function(ee){

                    if(ee=='兑换成功！'){

                      bonusHave=bonusHave-bonus;

                      $("bonusHave").html(bonusHave);

                       alert('兑换成功');

                    }else{

                      alert(ee);

                    }

                  },

                  error: function(XMLHttpRequest, textStatus, errorThrown){

                    alert(XMLHttpRequest.status);

                    alert(XMLHttpRequest.readyState);

                    alert(textStatus);

                  }

                });

              }

          }

        );

    }

  );

</script>

</body>

</html>

