<?php
require '../../../common.inc.php';
require 'init.inc.php';

 /**
 * @brief 请求临时token.请求需经过URL编码，编码时请遵循 RFC 1738
 *  
 * @param $appid
 * @param $appkey
 *
 * @return 返回字符串格式为：oauth_token=xxx&oauth_token_secret=xxx
 */
function get_request_token($appid, $appkey)
{
    //请求临时token的接口地址, 不要更改!!
    $url    = "http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token?";


    //生成oauth_signature签名值。签名值生成方法详见（http://wiki.opensns.qq.com/wiki/【QQ登录】签名参数oauth_signature的说明）
    //（1） 构造生成签名值的源串（HTTP请求方式 & urlencode(uri) & urlencode(a=x&b=y&...)）
	$sigstr = "GET"."&".rawurlencode("http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token")."&";

	//必要参数
    $params = array();
    $params["oauth_version"]          = "1.0";
    $params["oauth_signature_method"] = "HMAC-SHA1";
    $params["oauth_timestamp"]        = time();
    $params["oauth_nonce"]            = mt_rand();
    $params["oauth_consumer_key"]     = $appid;

    //对参数按照字母升序做序列化
    $normalized_str = get_normalized_string($params);
    $sigstr        .= rawurlencode($normalized_str);
   
	
	//（2）构造密钥
    $key = $appkey."&";


 	//（3）生成oauth_signature签名值。这里需要确保PHP版本支持hash_hmac函数
    $signature = get_signature($sigstr, $key);
    
		
	//构造请求url
    $url      .= $normalized_str."&"."oauth_signature=".rawurlencode($signature);

    //echo "$sigstr\n";
    //echo "$url\n";

    return file_get_contents($url);
}

/**
 * @brief 跳转到QQ登录页面.请求需经过URL编码，编码时请遵循 RFC 1738
 *
 * @param $appid
 * @param $appkey
 * @param $callback
 *
 * @return 返回字符串格式为：oauth_token=xxx&openid=xxx&oauth_signature=xxx&timestamp=xxx&oauth_vericode=xxx
 */
function redirect_to_login($appid, $appkey, $callback)
{
    //跳转到QQ登录页的接口地址, 不要更改!!
    $redirect = "http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize?oauth_consumer_key=$appid&";

    //调用get_request_token接口获取未授权的临时token
    $result = array();
    $request_token = get_request_token($appid, $appkey);
    parse_str($request_token, $result);

    //request token, request token secret 需要保存起来
    //在demo演示中，直接保存在全局变量中.
    //为避免网站存在多个子域名或同一个主域名不同服务器造成的session无法共享问题
    //请开发者按照本SDK中comm/session.php中的注释对session.php进行必要的修改，以解决上述2个问题，
    $_SESSION["token"]        = $result["oauth_token"];
    $_SESSION["secret"]       = $result["oauth_token_secret"];

    if ($result["oauth_token"] == "")
    {
        //示例代码中没有对错误情况进行处理。真实情况下网站需要自己处理错误情况
		//See http://wiki.opensns.qq.com/wiki/%E3%80%90QQ%E7%99%BB%E5%BD%95%E3%80%91%E5%85%AC%E5%85%B1%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E
		echo $request_token;exit;
    }

    ////构造请求URL
    $redirect .= "oauth_token=".$result["oauth_token"]."&oauth_callback=".rawurlencode($callback);
    header("Location:$redirect");
}

//redirect_to_login接口调用示例(当用户点击QQ登录按钮时，应该调用该接口以引导用户到QQ登录页面)
redirect_to_login(QQ_APPID, QQ_APPKEY, QQ_CALLBACK);
?>