<?php
session_start();
if((!isset($_SESSION['code']))||(!isset($_GET['code'])))
{	
	die("非法访问！");
} 
$code=$_GET['code'];
include('HangzhouState.php');
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
            <li><a href="city-1.html" class="am-cf"><span class="am-icon-check"></span> 杭州市</a></li>
            <li><a href="city-2.html"><span class="am-icon-puzzle-piece"></span> 深圳市</a></li>
            <li><a href="city-3.html"><span class="am-icon-th"></span> 北京市</a></li>
            <li><a href="city-4.html"><span class="am-icon-calendar"></span> 上海市</a></li>
            <li><a href="city-5.html"><span class="am-icon-bug"></span> 天津市</a></li>
          </ul>
        </li>
        <li><a href="admin-setting.html"><span class="am-icon-table"></span> 操作日志</a></li>
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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">城市</strong> / <small>杭州市</small></div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
            <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
          </div>
        </div>
      </div>
      <div class="am-u-sm-12 am-u-md-3">
        <div class="am-form-group">
          <select data-am-selected="{btnSize: 'sm'}">
            <option value="option1">所有类别</option>
            <option value="option2">新用户</option>
            <option value="option3">申请中</option>
            <option value="option3">搭建中</option>
            <option value="option3">审核中</option>
            <option value="option3">对接中</option>
            <option value="option3">运营中</option>
          </select>
        </div>
      </div>
      <div class="am-u-sm-12 am-u-md-3">
        <div class="am-input-group am-input-group-sm">
          <input type="text" class="am-form-field">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button">搜索</button>
          </span>
        </div>
      </div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">社区名称</th><th class="table-type">类别</th><th class="table-author">微信账号</th><th class="table-password">密码</th><th class="table-state">状态</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox" /></td>
              <td>1</td>
              <td><a href="#">下沙街道早成社区</a></td>
              <td>A</td>
              <td class="am-hide-sm-only">zaocheng@163.com</td>
              <td class="am-hide-sm-only">zc123456</td>
              <td>运营中</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            
          </tbody>
        </table>
          <div class="am-cf">
  共 15 条记录
  <div class="am-fr">
    <ul class="am-pagination">
      <li class="am-disabled"><a href="#">«</a></li>
      <li class="am-active"><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li><a href="#">»</a></li>
    </ul>
  </div>
</div>
          <hr />
          <p>注：.....</p>
        </form>
      </div>

    </div>
    
    <div class="am-g">
      <div class="am-u-md-6">
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">杭州市社区情况统计<span class="am-icon-chevron-down am-fr" ></span></div>
          <div id="collapse-panel-1" class="am-in">
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
                <td>100</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>申请中</td>
                <td>123</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>搭建中</td>
                <td>99</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>审核中</td>
                <td>23</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>对接中</td>
                <td>123</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>运营中</td>
                <td>111</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
     </div>
        <div class="am-u-md-6">
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">其他数据统计<span class="am-icon-chevron-down am-fr" ></span></div>
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
                <td>100</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>申请中</td>
                <td>123</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>搭建中</td>
                <td>99</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>审核中</td>
                <td>23</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>对接中</td>
                <td>123</td>
              </tr>
              <tr>
                <td class="am-text-center"></td>
                <td>运营中</td>
                <td>111</td>
              </tr>
              </tbody>
            </table>
          </div>
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
