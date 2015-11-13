<?
define("TOKEN", "find");
//require_once "jssdk.php";

//$jssdk = new JSSDK("wx831449bd459d5082", "58f923e1d07a08aa7a0de1d95417f2e8");
//$token = $jssdk->getAccessToken();

$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                
                //return $toUsername;
                //exit;
                $keyword = trim($postObj->Content);
                $time = time();
                $nMsg = 1;
				$newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount><![CDATA[$nMsg]]></ArticleCount>
				<Articles>
				<item>
				<Title><![CDATA[快来给萌宝投票吧]]></Title>
				<Description><![CDATA[本活动最终解释权归社区家所有！]]></Description>
				<PicUrl><![CDATA[http://wx.qlogo.cn/mmopen/Q3auHgzwzM4W3OmmH9gwrXH9YZKO08wzKdKRHvzzZmRgTrgj3T5OEuiasKSE9YEVt2TvTaibvw0fClntJ5db7How/0]]></PicUrl>
				<Url><![CDATA[http://admin.shequjia.cn/baby/F7/examples/baayCount/sample.php?openid=$fromUsername]]></Url>
				</item>
				</Articles>
				<FuncFlag>0</FuncFlag>
				</xml>";      
				if((!empty( $keyword ))&&$keyword=='投票')
                {
              		$msgType= "news";
                	$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	//echo "Input something...";
                	$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>"; 
          
			      $msgType = "text"; //回复消息的类型
			      $contentStr = "请发送‘投票’二字参与宝贝活动！"; //回复给微信用户的内容
			      $time = time(); //回复消息的时间戳
			      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);//经过sprintf处理过后，
			      echo $resultStr;

                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}
?>
