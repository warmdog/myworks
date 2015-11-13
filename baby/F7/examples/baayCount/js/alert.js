//依赖jquery，坚持framework框架
//文本提示框
var testIdex=100;
function alertTextSQJ(text){
	if($('.overFlow').length>0){
	}else{
		var htmlBack='<div class="overFlow">&nbsp<div>';
		$('.navbar').append(htmlBack);
	}
	$('.overFlow').css('display','block');
	if(testIdex>5){
		testIdex--;
	}else{
		alert('有病啊！弹这么多框');
	}
	var htmlAlert='<div class="SQJ-alert-text" style="z-index:'+testIdex+'">'+
						'<div class="closeIcon" onclick="hideAlertSQJ(this)">'+
	                    	'×'+
	                    '</div>'+
	                    '<p style="margin-top:20%;">'+
	                    	'社区家提醒您：'+
	                    '</p>'+
	                    '<p>'+
	                    	text+
	                    '</p>'+
                    '</div>';
	$('.navbar').append(htmlAlert);
	$('.SQJ-alert-text').slideDown();
}
function hideAlertSQJ(obj){
	$(obj).parent().slideUp('normal',
		function(){
			$(obj).parent().remove();
			if($('.SQJ-alert-text').length>0){
			}else{
				$('.overFlow').css('display','none');
				testIdex=100;
			}
		}
	);
}
//文本确认框
function confirmTextSQJ(text,sureFunc){
	if($('.overFlow').length>0){
	}else{
		var htmlBack='<div class="overFlow">&nbsp<div>';
		$('.navbar').append(htmlBack);
	}
	if(testIdex>5){
		testIdex--;
	}else{
		alert('有病啊！弹这么多框');
	}
	var htmlAlert='<div class="SQJ-alert-text" style="z-index:'+testIdex+'">'+
						'<div class="closeIcon" onclick="hideAlertSQJ(this)">'+
	                    	'×'+
	                    '</div>'+
	                    '<p>'+
	                    	'请您确认以下操作:'+
	                    '</p>'+
	                    '<p>'+
	                    	text+
	                    '</p>'+
	                    '<div class="buttonConfirm" onclick="run(this,'+sureFunc+')">确定</div>'+
                    '</div>';
	$('.navbar').append(htmlAlert);
	$('.SQJ-alert-text').slideDown();
}
function run(obj,func){
	func();
	hideAlertSQJ(obj);
}
