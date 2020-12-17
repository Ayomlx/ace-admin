<?php
namespace Org\Tfz;
class Curl{
	/**
	 * 要请求的post
	 *
	 * @param string 	$url 	要请求的url
	 * @param array 	$params 要传递的参数数组
     * @param int 	    $time   超时时间，缺省10秒
	 */
    public static function post($url,$params,$http_header,$timeout=5000) {
        $paramsStr = $params;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$http_header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsStr);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $returnValue = curl_exec($ch);
        curl_close($ch);
        return $returnValue;
    }
	
}