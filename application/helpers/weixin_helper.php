<?php
//define your token
define("TOKEN", "webqd_weixin_token");
define('APPID', 'wx2286781cfd22101e');
define('APPSECRET', 'd855331a9f7cfa3cd4048c437107c737');

/**
 * 开发模式下的自动回复功能，也可以使用编辑模式下的自动回复功能
 */
function response_msg() {
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
	if (!empty($postStr)) {
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		#这里有从用户通过公众平台接收过来的数据，具体是什么类型的数据，开发者文档上写的很清楚，可以去上面查。
		$fromUsername = $postObj -> FromUserName;
		$toUsername = $postObj -> ToUserName;
		$keyword = trim($postObj -> Content);
		$msgType = $postObj -> MsgType;
		$time = time();
		$textTpl = "<xml>
	                <ToUserName><![CDATA[%s]]></ToUserName>
	                <FromUserName><![CDATA[%s]]></FromUserName>
	                <CreateTime>%s</CreateTime>
	                <MsgType><![CDATA[%s]]></MsgType>
	                <Content><![CDATA[%s]]></Content>
	                </xml>";
		switch( $msgType ) {
			case "text" :
				//这个xml格式的数据是你服务器上的数据，是要传回公众平台的

				//关于时间的自动回复
				if ($keyword == '时间' || $keyword == 'time' || $keyword == "shijian") {
					$contentStr = date("Y-m-d H:i:s", time());
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
				} else {
					$msgType = "text";
					$contentStr = "欢迎您关注唯创网讯!";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
				}
				break;

			case "event" :
				#这个是事件的操作，当关注的时候自动回复
				$event = $postObj -> Event;
				$msgType = "text";
				if ($event == 'subscribe') {
					$contentStr = "唯创网讯，感谢您的关注!";
				}
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
				break;
		}
	} else {
		echo "";
		exit ;
	}
}

/**
 * 向用户推送消息
 * @param array 其中msgtype代表消息类型：text为文本，news为图文
 */
function push_message($msg_data) {
	$access_token = get_access_token_from_file();
    
	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $access_token;

	$result = http_post($url, json_encode($msg_data));
	return json_decode($result);
}

/**
 * 构造http请求，可以是post和get方式
 * @param url string 请求路径
 * @param post_data json格式的字符串，不传是get方式
 * @return http请求结果
 */
function http_post($url, $post_data = '') {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	if ($post_data) {
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
	}
	$result = curl_exec($curl);
	if (curl_errno($curl)) {
		return 'Errno' . curl_error($curl);
	}
	curl_close($curl);
	return $result;
}

function get_access_token_from_file() {
	$access_token = read_file('./weixin/access_token.txt');
	return $access_token;
}

function get_openid() {
	if (isset($_GET['code'])) {
		$code = $_GET['code'];
	} else {
		echo "NO CODE";
	}

	// 运行cURL，请求网页
	$data = http_post('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . APPID . '&secret=' . APPSECRET . '&code=' . $code . '&grant_type=authorization_code');

	// 获取access_token；
	$reg = "#{.+}#";
	preg_match_all($reg, $data, $matches);
	$json = $matches[0][0];

	$accessArr = json_decode($json, true);
	$access_token = $accessArr['access_token'];
	$openid = $accessArr['openid'];

	return $openid;
}

function check_consult(){
	$CI =& get_instance();
	$CI -> load -> model('consult_model');
	$openid = get_openid() ;
	$row = $CI -> consult_model -> get_by_weixin($openid);
	if($row){
		return TRUE;
	}
	return FALSE;
}

function check_bind_weixin(){
	$CI =& get_instance();
	$CI -> load -> model('user_model');
	$openid = get_openid() ;
	$row = $CI -> user_model -> get_by_weixin($openid);
	if($row){
		return TRUE;
	}
	return FALSE;
}
?>