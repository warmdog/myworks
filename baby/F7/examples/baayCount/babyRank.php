<?php 
include_once"testmysql.php";
$sql="select * from baby order by count1 desc limit 1";
$row=$pdo->query($sql);
//$row=$pdo->query($sql)->fetchAll();数组类型
//echo count($row);输出数组长度
//var_dump($row);
//exit;
foreach ($row as $key ) {
	$name=$key['name'];
	$count=$key['count1'];
	$hobby=$key['hobby'];
	$imgurl=$key['imgurl'];
	$age=$key['age'];
}
?>
<div class="navbar">
  <div class="navbar-inner">
  <!--
    <div class="left"><a href="#" class="back link"> <i class="icon icon-back"></i><span>返回</span></a></div>
    -->
    <!--
      <div class="right"><a href="#" data-panel="left" class="link open-panel icon-only"><i class="icon icon-bars"></i></a></div>
    -->
  </div>
</div>
<div class="pages">
  <div data-page="services" class="page" style="padding:0px 0px;">
    <div class="page-content" style="background-color:fff;padding:0px 0px;">
      <div class="content-block" style="padding:0px 0px;margin-top:0px;font-size:20px;">
        <!--冠军-->
        <div class="baby" onclick="showBaby(this)" style="margin-bottom:10px;background-color:rgba(200,200,200,0.3);">
          <div class="imgBox" style="margin-left:20px;">
            <img name="img" src="<?php echo $imgurl;?>">
          </div>
          <div class="dtail">
            <text name="rank" style="font-size:26px;">冠军</text>
            <text name="name" style="font-size:20px;"><?php echo $name;?></text>
            <br/>
            <text name="tik" style="font-size:20px;"><?php echo $count;?>票</text>
          </div>
          <div style="display:none;" name="favorite"><?php echo $hobby;?></div>
          <div style="display:none;" name="rank">1</div>
          <div style="display:none;" name="age"><?php echo $age;?></div>
        </div>
        <img src="img/title.jpg" style="width:100%;margin-bottom:10px;">
		<?php 
		$sql="select * from baby order by count1 desc limit 5 ";
		$row=$pdo->query($sql);
		$i=0;
		foreach ($row as $key ) {
			$name=$key['name'];
			$age=$key['age'];
			$imgurl=$key['imgurl'];
			$hobby=$key['hobby'];
			$count=$key['count1'];
			$i=$i+1;
		?>
        <!--初始化生成-->
        <p class="SQJ-list-4" onclick="showBaby(this)" style="background-color:#fff;margin-bottom:10px;">
          <text name="rank" style="font-size:16px;border-right:solid 1px #FF7F50;margin-right:10px;">第<?php echo $i;?>名</text>
          <img name="img" src="<?php echo $imgurl;?>"/>
          <text class="name" name="name" style="font-size:16px;width:30%"><?php echo $name;?></text>
          <text name="tik" style="font-size:16px;width:20%;text-align:right;"><?php echo $count;?>票</text>
          <text style="display:none;" name="favorite"><?php echo $hobby;?></text>
          <text style="display:none;" name="age"><?php echo $age;?></text>
        </p>
        <?php }?>
        <!--查看更多后生成-->
        <?php 
        $sql="select * from baby order by count1 desc limit 5,100";
        $row=$pdo->query($sql);
        $y=4;
        foreach ($row as $key ) {
  			$name=$key['name'];
  			$age=$key['age'];
  			$imgurl=$key['imgurl'];
  			$hobby=$key['hobby'];
  			$count=$key['count1'];
			  $i=$i+1;
        ?>
        <p class="SQJ-hideRank SQJ-list-4" onclick="showBaby(this)" style="background-color:#fff;margin-bottom:10px;display:none;">
          <text name="rank" style="font-size:16px;border-right:solid 1px #FF7F50;margin-right:10px;">第<?php echo $i;?>名</text>
          <img name="img" src=""/>
          <text class="name" name="name" style="font-size:16px;width:30%"><?php echo $name;?></text>
          <text name="tik" style="font-size:16px;width:20%;text-align:right;"><?php echo $count;?>票</text>
          <text style="display:none;" name="favorite"><?php echo $hobby;?></text>
          <text style="display:none;" name="age"><?php echo $age;?></text>
          <text style="display:none;" name="imgUrl"><?php echo $imgurl;?></text>
        </p>
		<?php }?>
        <div id="showMoreBabyRank" style="text-align:center;height:40px;width:100%;border-top:solid 1px #CCC;color:#999;" onclick="showMoreRank()">
              点击这里就能<i class="icon iconfontPushDowm" style="font-size:20px;margin:0px;">&#xe60a;</i>看到更多萌娃
        </div>
        <p>
         &nbsp
        </p>
      </div>
    </div>
  </div>
</div>