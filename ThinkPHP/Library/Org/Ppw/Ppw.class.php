<?php
/**
 * desc 定义注册登录类
 * author:215186218@qq.com
 * date:2019-08-12
 */
namespace Org\Ppw;
class Ppw {

		public $AppKey='a49f1f2521234d4dfe10f673879bf12f';     //开发者平台分配的AppKey
		public $AppSecret='b6c315f34c97';             			//开发者平台分配的AppSecret,可刷新
		public $Nonce;											//随机数（最大长度128个字符）
		public $CurTime;             							//当前UTC时间戳，从1970年1月1日0点0 分0 秒开始到现在的秒数(String)
		public $CheckSum;										//SHA1(AppSecret+Nonce+CurTime),三个参数拼接的字符串，进行SHA1哈希计算，转化成16进制字符(String，小写)
		
		public function httpHeader(){
			$hex_digits = '0123456789abcdef';
			for($i=0;$i<128;$i++){
				$this->Nonce.= $hex_digits[rand(0,15)];	
			}
			$this->CurTime = (string)(time());
			$join_string = $this->AppSecret.$this->Nonce.$this->CurTime;
			$this->CheckSum = sha1($join_string);
			$http_header = array(
				'AppKey:'.$this->AppKey,
				'Nonce:'.$this->Nonce,
				'CurTime:'.$this->CurTime,
				'CheckSum:'.$this->CheckSum,
				'Content-Type:application/x-www-form-urlencoded;charset=utf-8'
			);
			return $http_header;
		}
		
		/**
		 * 将json字符串转化成php数组
		 * @param  $json_str
		 * @return $json_arr
		 */
		public function json_to_array($json_str){
			if(is_array($json_str) || is_object($json_str)){
				$json_str = $json_str;
			}else if(is_null(json_decode($json_str))){
				$json_str = $json_str;
			}else{
				$json_str =  strval($json_str);
				$json_str = json_decode($json_str,true);
			}
			$json_arr=array();
			foreach($json_str as $k=>$w){
				if(is_object($w)){               
					$json_arr[$k]= $this->json_to_array($w); //判断类型是不是object
				}else if(is_array($w)){
					$json_arr[$k]= $this->json_to_array($w);
				}else{
					$json_arr[$k]= $w;
				}
			}
			return $json_arr;
		}
		
		/**
		 * 使用CURL方式发送post请求
		 * @param  $url     [请求地址]
		 * @param  $data    [array格式数据]
		 * @return $请求返回结果(array)
		 */
		public function postDataCurl($url,$data){
			$timeout = 5000;  
			$http_header = $this->httpHeader();

			$postdataArray = array();
			foreach ($data as $key=>$value){
				array_push($postdataArray, $key.'='.urlencode($value));
			}
			$postdata = join('&', $postdataArray);
	
			$ch = curl_init(); 
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt ($ch, CURLOPT_HEADER, false ); 
			curl_setopt ($ch, CURLOPT_HTTPHEADER,$http_header);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER,false); //处理http证书问题  
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$result = curl_exec($ch);  
			if (false === $result) {
				$result =  curl_errno($ch);
			}
			curl_close($ch);    
			return $this->json_to_array($result) ;
		}
		
        /**
		 * 发送模板短信
		 * @param  $templateid       [模板编号(由客服配置之后告知开发者)]
		 * @param  $mobiles          [验证码]
		 * @param  $params          [短信参数列表，用于依次填充模板，JSONArray格式，如["xxx","yyy"];对于不包含变量的模板，不填此参数表示模板即短信全文内容]
		 * @return $result      [返回array数组对象]
		 */
		public function sendSMSTemplate($templateid,$mobile){
			/*
			$url = 'https://api.netease.im/sms/sendtemplate.action';
			$data= array(
				'templateid' => $templateid,
				'mobiles' => json_encode($mobiles),
				'params' => json_encode($params)
			);
			*/
			$url = 'https://api.netease.im/sms/sendcode.action';
			$data = array(
				'templateid' => $templateid,
				'mobile' => $mobile
			);
			
			$result = $this->postDataCurl($url, $data);
			return $result;
		}
		
		/**
		 * 校验验证码
		 * @param  $mobile       [目标手机号]
		 * @param  $code          [验证码]
		 * @return $result      [返回array数组对象]
		 */
		public function verifycode($mobile,$code=''){
			$url = 'https://api.netease.im/sms/verifycode.action';
			$data= array(
				'mobile' => $mobile,
				'code' => $code
			);
			
			$result = $this->postDataCurl($url,$data);
			return $result;
		}
        
       
} //类结束
?>