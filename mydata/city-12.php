
<?php
/** 文件: pdo_page.class.php
** 版本: 2.0
** 功能: 使用php数据对象(pdo)实现数据的分页显示
** 运行环境:
**                ① php版本--5.1以上(包括5.1)
**                ② 打开pdo扩展(默认为关闭)
**                ③ 打开与所使用db相应对应的pdo扩展(默认为关闭)
**
** DISCLAIMER:
** Distributed "as is", fell free to modify any part of this code.
** You can use this for any projects you want, commercial or not.
** It would be very kind to email me any suggestions you have or bugs you 
** might find.
**
** 完成时间: 2006-10-15
** Power By 刘胜蛟 (Email: liushengjiao@163.com/liushengjiao@gmail.com)
**/
class pdo_page{
/* 变量定义部分 begin */

        /* pdo数据源 */
        private $db_driver = '';
        private $db_host = '';
        private $db_user = '';
        private $db_password = '';
        private $db_char = '';
        private $db_name = '';
        private $db_table = '';
        private $db_table_field = '';
        private $db = '';                //数据库连接句柄

        /* 分页显示参数设置 */
        private $page_size = 0;                //每页显示的记录数目
        private $link_num = 0;                //显示页码链接的数目

        private $page = 1;                //页码
        private $records = 0;                //表中记录总数
        private $page_count = 0;        //总页数
        private $pagestring = '';        //前后分页链接字符串
        private $page_link = '';        //页码链接字符串
        private $page_select = '';        //表单跳转页字符串
        private $page_jump = '';        //text筐输入页码跳转
        private $i;                    //选出社区的 id
/* 变量定义部分 end */

/* 函数定义(类方法) begin */

        function __construct(){

        }

        /* 设置分页信息 begin */
        public function set($db_driver,
                        $db_host,
                        $db_user,
                        $db_password,
                        $db_name,
                        $db_table,
                        $db_table_field,
                        $page_size,
                        $link_num){
                /* db参数设置 begin */
                $this->db_driver = $db_driver;                //db驱动
                $this->db_host = $db_host;                //dbms地址
                $this->db_user = $db_user;                //dbms帐户
                $this->db_password = $db_password;        //dbms密码
                $this->db_name = $db_name;                //db名称
                $this->db_table = $db_table;                //表名
                $this->db_table_field = $db_table_field;//字段数组，
                                                        //将要显示的字段名称
                                                        //写入该数组
                /* db参数设置 end */

                /* 分页参数设置 begin */
                $this->page_size = $page_size;                //每页显示记录的数目
                $this->link_num = $link_num;                //显示翻页链接的数目
                /* 分页参数设置 end */
        }
        /* 设置分页信息 end*/ 
        
        /* 获取分页链接数据 begin */
        public function get(){
                $page_data[0] = $this->records;                //表中记录的总数
                $page_data[1] = $this->page_count;        //总页数
                $page_data[2] = $this->page;                //当前页码
                $page_data[3] = $this->pagestring;        //'首页'、'上一页'、
                                                        //'下一页'、//'尾页'
                                                        //－－链接样式

                $page_data[4] = $this->page_link;        //[1]、[2]、[3]
                                                        //－－链接样式

                $page_data[5] = $this->page_select;        //表单翻页样式
                $page_data[6] = $this->page_jump;        //跳转的指定页样式
                return $page_data;
        }
        /* 获取分页链接数据 end */

        /* 连接数据库 begin */
        private function db_conn(){
                try{
                        $this->db = new pdo(
                                "$this->db_driver:dbname=$this->db_name;
                                host=$this->db_host;charset=utf8",
                                "$this->db_user",
                                "$this->db_password"
                        );
                        $this->db->query('set names utf8');
                        return $this->db;
                } catch(pdoexception $e) {
                        die($e->getmessage());
                }
        }
        /* 连接数据库 end */

        /* 页码处理 begin */
        private function set_page(){
                if (isset($_REQUEST['page'])) {
                        $this->page = intval($_REQUEST['page']);
                } else {
                        $this->page = 1;
                }
        }
        /* 页码处理 end */

        /* 获取db中记录的数目 begin */
        private function get_records(){
                $sql = "select count(*) from $this->db_table ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while ($f = $stmt->fetch()) {
                        $this->records = $f[0];
                }
        }
        /* 获取db中记录的数目 end */

        /* 建立翻页链接字符串 begin */
        private function page_link(){
                /* 前后页链接字符串 begin */
                if ($this->page == 1) {
                        //首页,无链接
                        $this->pagestring .='第一页|上一页';
                } else {
                        //不为首页，有链接
                        $this->pagestring .='<a href=?page=1>第一页</a>|
                        <a href=?page='.($this->page-1).'>上一页</a>';
                        
                }
                if ($this->page==$this->page_count || $this->page_count==0) {
                        //末页,无链接
                        $this->pagestring .='下一页|尾页';
                } else {
                        //非末页，有链接
                        $this->pagestring .='<a href=?page='.($this->page+1).'>
                        下一页</a>|<a href=?page='.$this->page_count.'>尾页</a>';
                }
                /* 前后页链接字符串 end */

                /* 页码链接字符串 begin */
                for ($i=$this->page;$i<=$this->page+$this->link_num-1;$i++) {
                        if ($i<=$this->page_count) {
                                $this->page_link .= '<a href=?page='.$i.'>
                                ['.$i.']</a> ';
                                $last_page = $i;
                        }
                }
                if ($i-$this->link_num-1 < 1) {
                                $front_page = 1;
                } else {
                                $front_page = $i - $this->link_num - 1;
                }
                if ($last_page == $this->page_count) {
                                $back_page = $last_page;
                } else {
                                $back_page = $last_page+1;
                }
                $this->page_link = '<a href=?page='.$front_page.'>往前</a>'.' '.
                        $this->page_link.' '.'<a href=?page='.$back_page.'>往后
                        </a>';
                /* 页码链接字符串 end */

                /* select页码 begin */
                $this->page_select = "<form action='' method=post>
                        <select name=page>";
                for ($i = 1;$i <= $this->page_count;$i++) {
                        if ($i == $this->page) {
                                $this->page_select .= "<option selected>$i
                                </option>";
                        } else {
                                $this->page_select .= "<option>$i</option>";
                        }
                }
                $this->page_select .= "</select><input type=submit value=前往>
                        </form>";
                /* select页码 end */

                /* input跳转表单begin */
               $this->page_jump = "<form action='' method=post><input 
                       type=text size=1 name=page value=$this->page><input 
                        type=submit value=go>";
                /* input跳转表单end */

        }
        /* 建立翻页链接字符串 end */
        
		function delete(){ 


		}  
        

        /* 获取数据 begin */
        function fetch_data(){
                if ($this->records) {
                        $sql = "select * from $this->db_table order by id desc limit ".($this->page-1)*$this->page_size.",$this->page_size ";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                     /*  echo "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
                        <meta name='renderer' content='webkit'>
                        <meta http-equiv='Cache-Control' content='no-siteapp' />
                        <link rel='icon' type='image/png' href='assets/i/favicon.png'>
                        <link rel='apple-touch-icon-precomposed' href='assets/i/app-icon72x72@2x.png'>
                        <meta name='apple-mobile-web-app-title' content='Amaze UI' />
                        <link rel='stylesheet' href='assets/css/amazeui.min.css'/>
                        <link rel='stylesheet' href='assets/css/admin.css'>";*/




                        //echo "<table border=0 width=90%><tr>";
                        /* 取字段名称 begin */
                        $field_count = count($this->db_table_field);
                        for($i = 0;$i < $field_count;$i++){
                                $field_name = $this->db_table_field[$i];
                                if($i==0){ 
                                	//echo "<th style='width:14%'>$field_name</th>";
                                }
                                if($i==1){ 

                                	//echo" <th style='width:20%'>$field_name</th>";
                                }
                                if($i==2){ 

                                	//echo" <th style='width:6%'>$field_name</th>";
                                }
                                if($i==3){ 

                                	//echo" <th style='width:24%'>$field_name</th>";
                                }
                                if($i==4){ 

                                	//echo" <th style='width:10%'>$field_name</th>";
                                }
                                if($i==5){ 

                                	//echo" <th style='width:10%'>$field_name</th>";
                                }


                               // echo "<td><center><b>$field_name</b></center>
                                    //    </td>";
                        }
                       // echo "</tr></thead>";
                        /* 取字段名称 end */
                        /* 获取数据 begin */
                        //echo "<tbody>";
                        while($f = $stmt->fetch()){
                                echo "<tr>";
                                for($i = 0;$i < $field_count;$i++){
                                        $field_name = $this->db_table_field[$i];
                                        $this->i=$f['id'];
                                        $field_value = $f["$field_name"];
                                        echo "<td>$field_value
                                                </td>";
                                        echo "<td>
                                             <button id='edit'  style='border:solid 1px #ccc;width:66px;height:28px;'>编辑
                                             </button>
                                             <button id='delete' style='border:solid 1px #ccc;width:66px;height:28px;'>删除</button></td>";
                                }
                                //echo" $this->i";
                                echo "</tr>";
                        }
                        /* 获取数据 end */
                       // echo "</tbody></table>";639152/689152
                }
        }
        /* 获取数据 end */
        /* 建立分页 begin */
        public function create_page(){
                $this->db_conn();
                $this->set_page();
                $this->get_records();      
                $this->page_count = ceil($this->records/$this->page_size);
                $this->page_link();
                $this->fetch_data();
                $this->delete();

        }
        /* 建立分页 end */

        function __destruct(){

        }
/* 函数定义(类方法) end */
}


///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////example///////////////////////////////////////
/*step1: 建立分页对象
*new pdo_page;
*/
     //'首页'、'上一页'、
                                                        //'下一页'、'尾页'
                                                        //－－链接样式

        //echo '<center>'.$page_data[4].'</center>';        //[1]、[2]、[3]
                                                        //－－链接样式

        //echo '<center>'.$page_data[5].'</center>';        //表单翻页样式
        //echo '<center>'.$page_data[6].'</center>';        //跳转的指定页

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
  				<li><a href="admin-index.php"><span class="am-icon-home"></span> 首页</a></li>
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
  		<!-- 测试-->
  		<div class="am-cf am-padding">
  			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">城市</strong> / <small>杭州市</small></div>
  		</div>

  		<div class="am-g">
  			<div class="am-u-sm-12 am-u-md-6">
  				<div class="am-btn-toolbar">
  					<div class="am-btn-group am-btn-group-xs">
  						<button id="newObj" type="button" class="am-btn am-btn-default">
  							<span class="am-icon-plus"></span> 新增
  						</button>
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
  								
  								<th style="width:10%px;">ID</th>
  								<th style="width:20%;">社区名称</th>
  								<th style="width:6%;">类别</th>
  								<th style="width:24%;">微信账号</th>
  								<th style="width:10%;">密码</th>
  								<th style="width:10%;">状态</th>
  								<th style="width:20%;" >操作</th>
  							</tr>
  						</thead>
  						<tbody>
  							<tr id="newTr" name="newTr"  style="display:none;">
  								<td style="width:20px;"><input style="display:none;" id="SCid" /></td>
  							
  								<td><input id="SCname" name="SCname" type="text" /></td>
  								<td>
  									<select id="SCtype" name="SCtype" style="font-size；10px;">
  										<option value="1">A</option>  
  										<option value="2">B</option>
  										<option value="3">C</option>
  									</select>
  								</td>
  								<td><input id="SCweichat" name="SCweichat" type="text" /></td>
  								<td><input id="SCpassword"  name="SCpassword" type="text" /></td>
  								<td>
  									<select id="SCstatus" name="SCstatus">
  										<option>新用户</option>
  										<option>申请中</option>
  										<option>搭建中</option>
  										<option>审核中</option>
  										<option>对接中</option>
  										<option>运营中</option>
  									</select>
  								</td>
  								<td style="line-height:30px;">
  									<button id="commit" 
    									style="border:solid 1px #ccc;width:66px;height:28px;">
    									确定
    								</button>
                    <button id="commitEdit" style="border:solid 1px #ccc;width:66px;height:28px;display:none;">
                        提交修改
                    </button>
  							</td>
  						</tr>
  						
  							<?php	$page = new pdo_page;
  							$page->set('mysql',
  								'121.41.128.207',
  								'zhangmin',
  								'shequjia123456',
  								'admin',
  								'hangzhou',
  								array('id','shequname','state','account','password','degree'),
  								2,
  								4);
  							$page->create_page();
  							$page_data = $page->get();




 ?><tr>
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
  					<?php 
        					echo '共有'.$page_data[0].'条记录';        //表中记录的总数
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '第'.$page_data[2].'页/';
        					echo '共'.$page_data[1].'页</center>';                //总页数

        					echo '<center>'.$page_data[3].'</center>'; 
        					?>
  					
  				</div>
  				<hr />
  				
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
<script type="text/javascript">
	$(
		function(){
			$("#newObj").click(
				function(){
					$("#newTr").toggle();
				}
				);
      $("#commitEdit").click(
        function(){
          $("#commitEdit").hide();
          $("#commit").show();
          $("#newTr").hide();
        }
        );
      $("#edit").click(
          function(obj){
              obj=this;

              $("#newTr").show();
               $("#commit").hide();
              $("#commitEdit").show();
              var city=hangzhou;
              var id=$(obj).attr("name");
              alert(obj);
               $.ajax({
                    url:'modify.php',
                    type:'post',
                    data:'city='+city+'&id='+id,
                    success:function(ee){
                            //alert("加入成功!");
                           console.log(ee);
                              var res=eval('('+ee+')');
                              var name=res.name;
                              var type=res.type;
                              var weiChat=res.weiChat;
                              var password=res.password;
                              var status=res.status;
                              var id=res.id;
                               $("#SCname").val(name);
                               $("#SCtype").val(type);
                               $("#SCweichat").val(weiChat);
                               $("#SCpassword").val(password);
                               $("#SCstatus").val(status);
                               $("#SCid").val(id);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                          alert(XMLHttpRequest.status);
                          alert(XMLHttpRequest.readyState);
                          alert(textStatus);
                        }
                    });
          }
        );
			$("#commit").click(
				function(){
					var name=$("#SCname").val();
					var type=$("#SCtype").val();
					var weiChat=$("#SCweichat").val();
					var password=$("#SCpassword").val();
					var status=$("#SCstatus").val();
              //  if(name==""){ 
          		//	
             	//	newTr.SCname.focus();
                //	return(false);
              // }
                  //alert(name+type+weiChat+password+status);
                  $.ajax({
                  	url:'ajax.php',
                  	type:'post',
                  	data:'shequname='+name+'&degree='+type+'&account='+weiChat+'&password='+password+'&state='+status,
                  	success:function(ee){
                            //alert("加入成功!");
                            alert(ee);
                            $("#newTr").hide();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                        	alert(XMLHttpRequest.status);
                        	alert(XMLHttpRequest.readyState);
                        	alert(textStatus);
                        }

                    });
                  alert("等待加入。。。");
              }
              );
}
);
</script>
</body>
</html>
