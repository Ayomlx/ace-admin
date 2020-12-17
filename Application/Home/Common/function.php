<?php
 /*函数名称:get_code()
    *作用:取得随机字符串
    * 参数:
    1、(int)$length = 32 #随机字符长度
    2、(int)$mode = 0    #随机字符类型，
    0为大小写英文和数字,1为数字,2为小写字母,3为大写字母,
    4为大小写字母,5为大写字母和数字,6为小写字母和数字
    *返回:取得的字符串
*/
function get_code($length=32,$mode=0){
    switch ($mode){
            case '1':
                    $str='123456789';
                    break;
            case '2':
                    $str='abcdefghijklmnopqrstuvwxyz';
                    break;
            case '3':
                    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
            case '4':
                    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    break;
            case '5':
                    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                    break;
            case '6':
                    $str='abcdefghijklmnopqrstuvwxyz1234567890';
                    break;
            default:
                    $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
                    break;
    }
    $checkstr='';
    $len=strlen($str)-1;
    for ($i=0;$i<$length;$i++){
        //$num=rand(0,$len);//产生一个0到$len之间的随机数
        $num=mt_rand(0,$len);//产生一个0到$len之间的随机数
        $checkstr.=$str[$num];  
    }
    return $checkstr;
}

// 验证手机号和邮箱是否符合固定条件

function verifyME($tp,$how,$adr,$uid){
    if($tp=='email'){
        $vid = M('member')->where(array('email'=>$adr,'verify_email'=>1))->getField('uid');
        if($how=='findpwd'){
            if($vid){
                return array('status'=>1);
            }else{
                return array('status' => 0, 'info' => "该邮箱未注册，或未进行过认证！");
            }
        }
        if($how=='register'){
            if(!$vid){
                return array('status'=>1);
            }else{
                return array('status' => 0, 'info' => "您的邮箱已被注册请更换！");
            }
        }
        if($how=='verify'){
            if(!$vid){
                return array('status'=>1);
            }else{
                if($vuid==$uid){
                    return array('status'=>1);
                }else{
                    return array('status' => 0, 'info' => "您的邮箱已被注册请更换！");
                }
            }
        }
    }
    if($tp=='mobile'){
        $vid = M('member')->where(array('mobile'=>$adr,'verify_mobile'=>1))->getField('uid');
        if($how=='findpwd'){
            if($vid){
                return array('status'=>1);
            }else{
                return array('status' => 0, 'info' => "该手机号未注册，或未进行过认证！");
            }
        }
        if($how=='register'){
            if(!$vid){
                return array('status'=>1);
            }else{
                return array('status' => 0, 'info' => "您的手机号已被注册请更换！");
            }
        }
        if($how=='verify'){
            if(!$vid){
                return array('status'=>1);
            }else{
                if($vuid==$uid){
                    return array('status'=>1);
                }else{
                    return array('status' => 0, 'info' => "您的手机号已被注册请更换！");
                }
            }
        }
    }
}


// 字符串截取函数$string【字符】, $sublen【截取长度】, $start = 0【起始位】, $code = 'UTF-8'【编码格式】
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8'){
    if($code == 'UTF-8'){
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
        return join('', array_slice($t_string[0], $start, $sublen));
    }else{
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i< $strlen; $i++){
            if($i>=$start && $i< ($start+$sublen)){
                if(ord(substr($string, $i, 1))>129){
                    $tmpstr.= substr($string, $i, 2);
                }else{
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        //if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}

// 不进行跳转的地址
  function noback(){
    return array(
            U('Login/index@'.webdomain()),
            U('Login/register@'.webdomain()),
            U('Login/register@'.webdomain(),array('registerType'=>'email')),
            U('Login/register@'.webdomain(),array('registerType'=>'mobile')),
            U('Login/index@'.wapdomain()),
            U('Login/register@'.wapdomain()),
            U('Login/register@'.wapdomain(),array('registerType'=>'email')),
            U('Login/register@'.wapdomain(),array('registerType'=>'mobile'))
        );
  }

  //获取ip
	function getip($type = 0) {
		$type       =  $type ? 1 : 0;
		static $ip  =   NULL;
		if ($ip !== NULL) return $ip[$type];
		if($_SERVER['HTTP_X_REAL_IP']){//nginx 代理模式下，获取客户端真实IP
			$ip=$_SERVER['HTTP_X_REAL_IP'];    
		}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
			$ip     =   $_SERVER['HTTP_CLIENT_IP'];
		}elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
			$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos    =   array_search('unknown',$arr);
			if(false !== $pos) unset($arr[$pos]);
			$ip     =   trim($arr[0]);
		}elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
		}else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		// IP地址合法验证
		$long = sprintf("%u",ip2long($ip));
		$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
		return $ip[$type];
	}

?>
