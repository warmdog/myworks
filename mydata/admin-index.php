﻿<?php 
session_start();
if((!isset($_SESSION['code']))||(!isset($_GET['code'])))
{	
	die("非法访问！");
}
include('count.php');
include('ShanghaiState.php');
include('ShenzhenState.php');
include('BeijingState.php');
include('TianjinState.php');
include('HangzhouState.php');
$code=$_GET['code'];
echo $allcoun;
?>

<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>社区信息管理后台</title>
  <meta name="description" content="社区家  上海誓鸟">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，社区家暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>shequjia</strong> <small>社区信息管理</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
          <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
          <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="admin-index.php?code=<?php echo $code;?>"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 城市选择 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            <li><a href="city-Hangzhou.php?code=<?php echo $code;?>" class="am-cf"><span class="am-icon-check"></span> 杭州市</a></li>
            <li><a href="city-Shenzhen.php?code=<?php echo $code;?>"><span class="am-icon-puzzle-piece"></span> 深圳市</a></li>
            <li><a href="city-Beijing.php?code=<?php echo $code;?>"><span class="am-icon-th"></span> 北京市</a></li>
            <li><a href="city-Shanghai.php?code=<?php echo $code;?>"><span class="am-icon-calendar"></span> 上海市</a></li>
            <li><a href="city-Tianjin.php?code=<?php echo $code;?>"><span class="am-icon-bug"></span> 天津市</a></li>
          </ul>
        </li>
        <li><a href="admin-setting.php"><span class="am-icon-table"></span> 操作日志</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>时光静好，与君语；细水流年，与君同。—— shequjia</p>
        </div>
      </div>

    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>数据分析及统计</small></div>
    </div>

    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-home"></span><br/>接入社区<br/><?php echo $allcoun;?></a></li>
      <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-gift"></span><br/>成交订单<br/>1308</a></li>
      <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>180082</a></li>
      <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>30000</a></li>
    </ul>

    <div class="am-g">
      <div class="am-u-md-6">
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">社区情况统计<span class="am-icon-chevron-down am-fr" ></span></div>
          <div id="collapse-panel-1" class="am-in">
            <table class="am-table am-table-bd am-table-bdrs am-table-striped am-table-hover">
              <tbody>
              <tr>
                <th>#</th>
                <th>城市</th>
                <th>数量</th>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>杭州市</td>
                <td><?php echo $rows5[0]; ?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>深圳市</td>
                <td><?php echo $rows2[0];?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>北京市</td>
                <td><?php echo $rows1[0];?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>上海市</td>
                <td><?php echo $rows3[0];?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>天津市</td>
                <td><?php echo $rows4[0];?></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
     </div>
        <div class="am-u-md-6">
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">社区状态数据统计<span class="am-icon-chevron-down am-fr" ></span></div>
          <div id="collapse-panel-2" class="am-in">
            <table class="am-table am-table-bd am-table-bdrs am-table-striped am-table-hover">
              <tbody>
              <tr>
                <th>#</th>
                <th>状态</th>
                <th>数量</th>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>新用户</td>
                <td><?php echo $ShanghaiState0[0]+$BeijingState0[0]+$ShenzhenState0[0]+$TianjinState0[0]+$HangzhouState0[0]   ?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>申请中</td>
                <td><?php echo $ShanghaiState1[0]+$BeijingState1[0]+$ShenzhenState1[0]+$TianjinState1[0]+$HangzhouState1[0]   ?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>搭建中</td>
                <td><?php echo $ShanghaiState2[0]+$BeijingState2[0]+$ShenzhenState2[0]+$TianjinState2[0]+$HangzhouState2[0]   ?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>审核中</td>
                <td><?php echo $ShanghaiState3[0]+$BeijingState3[0]+$ShenzhenState3[0]+$TianjinState3[0]+$HangzhouState3[0]   ?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>对接中</td>
                <td><?php echo $ShanghaiState4[0]+$BeijingState4[0]+$ShenzhenState4[0]+$TianjinState4[0]+$HangzhouState4[0]   ?></td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>运营中</td>
                <td><?php echo $ShanghaiState5[0]+$BeijingState5[0]+$ShenzhenState5[0]+$TianjinState5[0]+$HangzhouState5[0]   ?></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>        
      </div>
    </div>

</div>

<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
  <span class="am-icon-btn am-icon-th-list"></span>
</a>

<footer>
  <hr>
  <p class="am-padding-left">© 2015 shequjia.cn</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
