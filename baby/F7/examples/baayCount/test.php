<?php
define("TOKEN", "find");//定义识别码
$wechatObj = new wechatCallbackapiTest();//实例化wechatCallbackapiTest类
if(!isset($_GET["echostr"])){
     $wechatObj->responseMsg();
}else{
 $wechatObj->valid();
}
class wechatCallbackapiTest{
 public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
         echo $echoStr;
         exit;
        }
  }
 public function responseMsg(){//执行接收器方法
	  $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
	  if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      		$RX_TYPE = trim($postObj->MsgType);
	      	switch($RX_TYPE){
	       	case "event":
	       	$result = $this->receiveEvent($postObj);
	       	breadk;
      }
      echo $result;
  }else{
   echo "";
   exit;
  }
 }
  private function receiveEvent($object){
   $content = "";
   switch ($postObj->Event){
    case "subscribe":
    $content = "欢迎关注网志博客";//这里是向关注者发送的提示信息
    break;
    case "unsubscribe":
    $content = "取小关注";
    //$this->linkMysql();
    break;
   }
   $result = $this->transmitText($object,$content);
   return $result;
  
    }
 private function transmitText($object,$content){
   $textTpl = "<xml>
       <ToUserName><![CDATA[%s]]></ToUserName>
       <FromUserName><![CDATA[%s]]></FromUserName>
       <CreateTime>%s</CreateTime>
       <MsgType><![CDATA[text]]></MsgType>
       <Content><![CDATA[%s]]></Content>
       <FuncFlag>0</FuncFlag>
       </xml>";
    $result = sprintf($textTpl, $object->FromUserName, $object->$ToUserName, time(), $content);
    return $result;
  }
 private function checkSignature(){
 	 if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
  		$token = TOKEN;
  		$tmpArr = array($token, $timestamp, $nonce);
	  	sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
  		if( $tmpStr == $signature ){
   			return true;
  		}else{
   			return false;
  		}
 	}

	private function linkMysql(){ 
		$dsn="mysql:host=114.215.170.242;dbname=baby";
		$user='shequjia';
		$password='shequjia102030';
		try {
	    	$pdo = new PDO($dsn, $user, $password); 
	    	$pdo->query('set names utf8');
	    	$sql="update count  set count=count +1 where id=1";
			$pdo->exec($sql);
		} catch (PDOException $e) {
			file_put_contents("test.txt",$e,FILE_APPEND);
	    	die('连接数据库失败!');    
		}
		
	}
}