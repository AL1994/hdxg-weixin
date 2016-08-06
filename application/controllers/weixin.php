<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//
// 接收用户消息
// 微信公众账号接收到用户的消息类型判断
//

class Weixin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        define("TOKEN", "hdxg_weixin");
        define('APPID', 'wxf10d1e32b454c8f3');
        define('APPSECRET', '1d46b1fd13f3be27c6b69d9f97bef149');

        if (isset($_GET['echostr'])) {
            $this->valid();
        }else{
            $this->responseMsg();
        }
    }
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            $fromUsername = $postObj['FromUserName'];
            $toUsername = $postObj['ToUserName'];
            $keyword = trim($postObj['Content']);
            $time = time();
            $msgType = trim($postObj['MsgType']);

            //用户发送的消息类型判断
            if(!empty($keyword)){
                switch ($msgType)
                {
                    case "text":    //文本消息
                        /*$contentStr = date("Y-m-d H:i:s",time());
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;*/
                        // $open_id = $this -> get_openid();
                        $contentStr = $fromUsername;
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                        $this -> load -> model('message_model');
                        $this -> message_model -> save($keyword, $fromUsername);
                        break;
                    case "image":   //图片消息
                        break;

                    case "voice":   //语音消息
                        break;
                    case "video":   //视频消息
                        break;
                    case "location"://位置消息
                        break;
                    case "link":    //链接消息
                        break;
                    default:
                        break;
                }
            }
            
//            echo $result;
        }else {
            echo "";
            exit;
        }
    }


























}
?>