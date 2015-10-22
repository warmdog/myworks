<?php 

session_start();

include_once"testmysql.php";

$openid=$_SESSION['openid'];

$imgurl=$_SESSION['headimgurl'];

$nickname=$_SESSION['nickname'];

//$code = mt_rand(0,1000000); 

//$_SESSION['code'] = $code; 

$sql1="select * from new_users where openid='$openid'";

$row=$pdo->query($sql1);

foreach ($row as $key ) {

  $phone=$key['phone'];

  $adress=$key['adress'];

  $name=$key['name'];

  # code...

}

$sql="select bonus from new_users where openid='$openid'";

$row1=$pdo->query($sql);

foreach ($row1 as $key ) {

	$bonus=$key['bonus'];

}



?>

<!DOCTYPE html>

<!--#2BB761 #F6D200  #E7652B-->

<html lang="zh-cn">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<title>个人中心</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="swiper/swiper.3.1.2.min.css">

<link rel="stylesheet" type="text/css" href="font/iconfont.css">

<link rel="stylesheet" type="text/css" href="css/mymain.css">

<!--[if lt IE 9]>

<script src="js/html5shiv.js"></script>

<script src="js/respond.min.js"></script>

<![endif]-->

<style type="text/css">

  .overFlow{

      display: none;

      background-color: rgba(0,0,0,0.5);

      height: 1000px;

      width:1000px;

      position: fixed;

      left: 0px;

      top:0px;

      z-index: 5;

    }

    .alert{

      display: none;

      background-color: #fff;

      width:100%;

      left: 0px;

      top:600px; 

      height:70%;

      position: fixed;

      z-index: 10;

      font-size: 20px;

    }

    .alert b{

      width: 30%；

    }

    .alert input{

      margin-left: 5%;

      width:65%;

      border-radius: 4px;

      color:#999;

    }

</style>

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

<div class="container-fuild user-box">

  <div class="toolbar tabbar mytab">

    <div class="toolbar-inner">

        <a href="dingdan.php" class="link"><i class="iconfont icon-deliver icon-color"></i><span class="tabbar-label icon-color">订单</span></a>

        

        <a href="exchange.php" class="link"><i class="iconfont icon-recharge icon-color"></i><span class="tabbar-label icon-color">积分</span></a>

    </div>

  </div>

  <div class="user-img">

    <img src="<?php echo $imgurl;?>">

    <p><?php echo $nickname;?></p>

  </div>

</div>

<div class="container-fuild aply-box">

  <div class="mylist-group">

      <p onclick="alert('购物车正在打造中');" title="" style="border-bottom:solid 1px #eee">

        <i class="iconfont icon-goodsfill icon-color-red icon-left"></i><span>购物车</span><i class="iconfont icon-next icon-right"></i>

      </p>

       <p onclick="alertIt();" title="" style="border-bottom:solid 1px #eee">

        <i class="iconfont icon-locationfill icon-color-green icon-left"></i><span>收货地址</span><i class="iconfont icon-next icon-right"></i>

      </p>

      <a href="exchangedingdan.php" title="" style="border-bottom:solid 1px #eee">

        <i class="iconfont icon-locationfill icon-color-green icon-left"></i><span>兑换记录</span><i class="iconfont icon-next icon-right"></i>

      </a>

  </div>

</div>

<!--弹出框-->

<div id="overflowIt" class="overFlow">

</div>

<div id="alertIt" class="alert">

    <p>

      <div onclick="hideAlert();" style="margin-right:10px;font-size:30px;text-align:right;">×</div>

    </p>

    <br/>

    <b>收货地址</b><input id="address" value="<?php echo $adress;?>" placeholder="请填写地址" maxlength="30"/><br/><br/>

    <b>收件人&nbsp&nbsp&nbsp&nbsp</b><input id="name" value="<?php echo $name;?>" placeholder="请填写名字" maxlength="22"/><br/><br/>

    <b>联系方式</b><input id="cellPhone" value="<?php echo $phone;?>"  placeholder="请填写手机号码" maxlength="13"/>

    <button onclick="sure();" style="width:65%;margin-top:10px;margin-left:20%;border-radius:3px;border:0px;padding:5px;background-color:#FF7E50;color:#fff;">确定</button>

    <p id="warningtext" style="text-align:center;color:#f00;font-size:16px;display:none;">请完整填写相关信息</p>

</div>

<div class="toolbar tabbar toolbar-fixed">

    <div class="toolbar-inner">

        <a href="home.php" class="link"><i class="iconfont icon-home"></i><span class="tabbar-label">首页</span></a>

        <a href="exchange.php" class="link"><i class="iconfont icon-sponsor"></i><span class="tabbar-label">兑换</span></a>

        <a href="my.php" class="link active"><i class="iconfont icon-people"></i><span class="tabbar-label">我</span></a>

    </div>

</div>

<script type="text/javascript" src="swiper/swiper.3.1.2.min.js"></script>

<script type="text/javascript" src="js/mymain.js"></script>

<script type="text/javascript">

  function alertIt(){

    $("#overflowIt").css("display","block");

    $("#alertIt").css("display","block");

    $("#alertIt").animate({'top':'30%'},500);

  }

  function sure(){

      var address=$('#address').val();

      var name=$('#name').val();

      var cellPhone=$('#cellPhone').val();

      if(address==""){

        $("#warningtext").html('请填写收货地址');

        $("#warningtext").css("display",'block');

        return false;

      }

      if(name==""){

        $("#warningtext").html('请填写联系人姓名');

        $("#warningtext").css("display",'block');

        return false;

      }

      if(cellPhone==""){

        $("#warningtext").html('请填写联系电话');

        $("#warningtext").css("display",'block');

        return false;

      }

      //回调成功

        $.ajax({

                    url:'add.php',

                    type:'post',

                    data:'phone='+cellPhone+'&address='+address+'&name='+name,

                    success:function(ee){

                            //alert("加入成功!");

                           $("#overflowIt").css("display","none");

                           $("#alertIt").css("display","none");

                        },

                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                          alert(XMLHttpRequest.status);

                          alert(XMLHttpRequest.readyState);

                          alert(textStatus);

                        }

                    });

    }

    function hideAlert(){

       $("#overflowIt").css("display","none");

       $("#alertIt").css("display","none");

       $("#alertIt").css('top','100%');

    }

</script>

</body>

</html>



