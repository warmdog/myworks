//总页面初始化方法
$(
  function(){
    $(".link").click(
      function(){
        var obj=this;
        $(".link").removeClass("active");
        $(obj).addClass("active");
      }
    );
  }
);
//全局变量
var rockDianzan=false;
function dianzan(obj){
   rockDianzan=true;
   var id=$(obj).parent().find("[name*='num']").html();
   var num=$(obj).parent().find("[name*='tik']").html();
   num=parseInt(num)+1;
   var openId=$("#openId").html();
   $.ajax({
	          url:'add.php',
	          type:'post',
	          data:'id='+id+'&openid='+openId,
	          success:function(ee){
	             //alert("加入成功!");
	             if(ee=="投票成功"){
	             	$(obj).parent().find("[name*='tik']").html(''+num);
                	$(obj).parent().find(".dianzan").css('color','#ff8000');
	             }else{
	             	alertTextSQJ(ee);
	             }
                 //
              },
              error: function(XMLHttpRequest, textStatus, errorThrown){
                alertTextSQJ(XMLHttpRequest.status);
                alertTextSQJ(XMLHttpRequest.readyState);
                alertTextSQJ(textStatus);
              }
          });
}
function showBaby(obj){
  if(rockDianzan){
    rockDianzan=false;
  }else{
    var name=$(obj).find("[name*='name']").html();
    var tik=$(obj).find("[name*='tik']").html();
    var num=$(obj).find("[name*='num']").html();
    var favorite=$(obj).find("[name*='favorite']").html();
    var rank=$(obj).find("[name*='rank']").html();
    var age=$(obj).find("[name*='age']").html();
    var img=$(obj).find("[name*='img']").attr('src');
    $("[name*='thisName']").html(name);
    $("[name*='thisTik']").html(tik+'票');
    $("[name*='thisNum']").html(num);
    $("[name*='thisFavorite']").html(favorite);
    $("[name*='thisRank']").html(rank);
    $("[name*='thisAge']").html('('+age+'岁)');
    $("[name*='thisImg']").attr('src',img);
    showAlert();
  }
}
function showAlert(){
  $("#singelBaby").slideDown();
}
function hideBaby(obj){
  $(obj).parent().slideUp();
}
function showMoreToupiao(){
  var babyList=$('.SQJ-hideList');
  var length=4;
  if(babyList.length>4){
  }
  else{
    length=babyList.length;
    $('#showMoreBabyToupiao').html('可爱的萌娃们都在这了^.^');
  }
  for(var i=0;i<length;i++){
    var age=$(babyList[i]).find("[name*='age']").html();
    var imgurl=$(babyList[i]).find("[name*='imgUrl']").html();
    $(babyList[i]).find("[name*='img']").attr('src',imgurl);
    $(babyList[i]).removeClass('SQJ-hideList');
  }
}
function showMoreRank(){
  var babyList=$('.SQJ-hideRank');
  var length=5;
  if(babyList.length>5){
  }
  else{
    length=babyList.length;
    $('#showMoreBabyRank').html('可爱的萌娃们都在这了^.^');
  }
  for(var i=0;i<length;i++){
    var imgurl=$(babyList[i]).find("[name*='imgUrl']").html();
    $(babyList[i]).find("[name*='img']").attr('src',imgurl);
    $(babyList[i]).removeClass('SQJ-hideRank');
    $(babyList[i]).slideDown('normal');
  }
}
function reflash(){
   var ranks=$("[name*='rank']");
      for(var i=0;i<ranks.length;i++){
        var rank=$(ranks[i]).html();
        if(rank=='1'){
          rank='冠军';
        }else if(rank=='2'){
          rank='亚军';
        }else if(rank=='3'){
          rank='季军';
        }else{
          rank='第'+rank+'名';
        }
        $(ranks[i]).html(rank);
      }
}
function search(){
  document.location.hash="anchor";
  $('#searchResult').slideDown();
 var name=$('#babyname').val();
 if(name!=''){
   $('#searchBabys').html('<p style="text-align:center;height:60px;line-height:60px;font-size:16px;">正在为您努力加载。。。（x。x）</p>');
   $.ajax({
            url:'search.php',
            type:'post',
            data:'name='+name,
            success:function(ee){
                    //alert("加入成功!");
                   var babys=eval('('+ee+')');
                   $('#searchBabys').empty();
                     for(var i=0;i<babys.length;i++){
                       var id=babys[i].id;
                       var name=babys[i].name;
                       var age=babys[i].age;
                       var imgurl=babys[i].imgurl;
                       var hobby=babys[i].hoby;
                       var count1=babys[i].count1;
                       var html=
                    '<div class="SQJ-halfList-5">'+
                    '<div class="SQJ-halfList-5-inner" onclick="showBaby(this);">'+
                        '<img name="img" src="'+imgurl+'"/>'+
                        '<b style="top:0px;background-color:#FF7F50;" name="num">'+id+'号</b>'+
                        '<text style="bottom:0px;left:5%;" name="name">'+name+'</text>'+
                        '<text style="bottom:0px;left:60%;" class="dianzan" onclick="dianzan(this);">'+
                          '<i class="icon iconfont" style="font-size:26px;margin:0px;float:left;">&#xe65f;</i>'+
                          '<b name="tik" style="float:left;">'+count1+'</b>'+
                        '</text>'+
                        '<text style="display:none;" name="favorite">'+hobby+'</text>'+
                        '<text style="display:none;" name="age">'+age+'</text>'+
                    '</div>'+
                    '</div>'
                    $('#searchBabys').append(html);
                   }
                   $('#searchBabys').append('<div style="clear:both;"></div>');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  alertTextSQJ(XMLHttpRequest.status);
                  alertTextSQJ(XMLHttpRequest.readyState);
                  alertTextSQJ(textStatus);
                }
            }); 
 } 
}
