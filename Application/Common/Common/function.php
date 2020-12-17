<?php

/**
  +----------------------------------------------------------
 * 原样输出print_r的内容
  +----------------------------------------------------------
 * @param string    $content   待print_r的内容
  +----------------------------------------------------------
 */
function pre($content) {
    header("Content-type: text/html;charset=utf-8");
    echo "<pre>";
    print_r($content);
    echo "</pre>";
}

/**
 * 网站分页配置
 * @param  [type] $count [总数]
 * @param  [type] $size  [每页显示]
 * @return [type]        [description]
 */
function page_all($count,$size,$client='web'){
    $page = new \Think\Page($count, $size);
    $page->lastSuffix = false;
    $page->setConfig('prev','上一页');
    $page->setConfig('next','下一页');
    $page->setConfig('first','首页');
    $page->setConfig('last','尾页');
    $page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% <span>共%TOTAL_PAGE%页</span>');
    $pConf['show'] = $page->show();
    $pConf['first'] = $page->firstRow;
    $pConf['list'] = $page->listRows;
    return $pConf;
}

function page($count,$size,$client='web'){
    $page = new \Think\Page($count, $size);
	$page->rollPage = 5;
    $page->lastSuffix = false;
    $page->setConfig('prev','<<上一页');
    $page->setConfig('next','下一页>>');
    $page->setConfig('first','首页');
    $page->setConfig('last','尾页');
    $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    $pConf['show'] = $page->show();
    $pConf['first'] = $page->firstRow;
    $pConf['list'] = $page->listRows;
    return $pConf;
}

/**
 * 验证验证码
 * @param $code
 * @param string $id
 * @return bool
 */
function check_verify($code, $id = '',$reset = true){
    session_start();
    $verify = new \Think\Verify();
    $verify->reset = $reset;
    return $verify->check($code, $id,$reset);
    session_write_close();
}

/**
 * 快速文件数据读取和保存 针对简单类型数据 字符串、数组
 * @param string $name 缓存名称
 * @param mixed $value 缓存值
 * @param string $path 缓存路径
 * @return mixed
 */
function set_config($name, $value='', $path=DATA_PATH) {
    static $_cache  = array();
    $filename       = $path . $name . '.php';
    if ('' !== $value) {
        if (is_null($value)) {
            // 删除缓存
            return false !== strpos($name,'*')?array_map("unlink", glob($filename)):unlink($filename);
        } else {
            // 缓存数据
            $dir            =   dirname($filename);
            // 目录不存在则创建
            if (!is_dir($dir))
                mkdir($dir,0755,true);
            $_cache[$name]  =   $value;
            return file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($value, true) . ";?>"));
        }
    }
    if (isset($_cache[$name]))
        return $_cache[$name];
    // 获取缓存数据
    if (is_file($filename)) {
        $value          =   include $filename;
        $_cache[$name]  =   $value;
    } else {
        $value          =   false;
    }
    return $value;
}

/**
  +----------------------------------------------------------
 * 加密密码
  +----------------------------------------------------------
 * @param string    $data   待加密字符串
  +----------------------------------------------------------
 * @return string 返回加密后的字符串
 */
function encrypt($data) {
    return md5(C("AUTH_CODE") . md5($data));
}

/**
  +----------------------------------------------------------
 * 将一个字符串转换成数组，支持中文
  +----------------------------------------------------------
 * @param string    $string   待转换成数组的字符串
  +----------------------------------------------------------
 * @return string   转换后的数组
  +----------------------------------------------------------
 */
function strToArray($string) {
    $strlen = mb_strlen($string);
    while ($strlen) {
        $array[] = mb_substr($string, 0, 1, "utf8");
        $string = mb_substr($string, 1, $strlen, "utf8");
        $strlen = mb_strlen($string);
    }
    return $array;
}

/**
  +----------------------------------------------------------
 * 生成随机字符串
  +----------------------------------------------------------
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
  +----------------------------------------------------------
 * @return string
  +----------------------------------------------------------
 */
function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } else if ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str[$i] = $string[rand(0, $count)];
        $code .= $str[$i];
    }
    return $code;
}

/**
  +-----------------------------------------------------------------------------------------
 * 删除目录及目录下所有文件或删除指定文件
  +-----------------------------------------------------------------------------------------
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
  +-----------------------------------------------------------------------------------------
 * @return bool 返回删除状态
  +-----------------------------------------------------------------------------------------
 */
function delDirAndFile($path, $delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}

/**
  +----------------------------------------------------------
 * 将一个字符串部分字符用*替代隐藏
  +----------------------------------------------------------
 * @param string    $string   待转换的字符串
 * @param int       $bengin   起始位置，从0开始计数，当$type=4时，表示左侧保留长度
 * @param int       $len      需要转换成*的字符个数，当$type=4时，表示右侧保留长度
 * @param int       $type     转换类型：0，从左向右隐藏；1，从右向左隐藏；2，从指定字符位置分割前由右向左隐藏；3，从指定字符位置分割后由左向右隐藏；4，保留首末指定字符串
 * @param string    $glue     分割符
  +----------------------------------------------------------
 * @return string   处理后的字符串
  +----------------------------------------------------------
 */
function hideStr($string, $bengin = 0, $len = 4, $type = 0, $glue = "@") {
    if (empty($string))
        return false;
    $array = array();
    if ($type == 0 || $type == 1 || $type == 4) {
        $strlen = $length = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string, 0, 1, "utf8");
            $string = mb_substr($string, 1, $strlen, "utf8");
            $strlen = mb_strlen($string);
        }
    }
    switch ($type) {
        case 1:
            $array = array_reverse($array);
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i]))
                    $array[$i] = "*";
            }
            $string = implode("", array_reverse($array));
            break;
        case 2:
            $array = explode($glue, $string);
            $array[0] = hideStr($array[0], $bengin, $len, 1);
            $string = implode($glue, $array);
            break;
        case 3:
            $array = explode($glue, $string);
            $array[1] = hideStr($array[1], $bengin, $len, 0);
            $string = implode($glue, $array);
            break;
        case 4:
            $left = $bengin;
            $right = $len;
            $tem = array();
            for ($i = 0; $i < ($length - $right); $i++) {
                if (isset($array[$i]))
                    $tem[] = $i >= $left ? "*" : $array[$i];
            }
            $array = array_chunk(array_reverse($array), $right);
            $array = array_reverse($array[0]);
            for ($i = 0; $i < $right; $i++) {
                $tem[] = $array[$i];
            }
            $string = implode("", $tem);
            break;
        default:
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i]))
                    $array[$i] = "*";
            }
            $string = implode("", $array);
            break;
    }
    return $string;
}

/**
  +----------------------------------------------------------
 * 功能：字符串截取指定长度
 * leo.li hengqin2008@qq.com
  +----------------------------------------------------------
 * @param string    $string      待截取的字符串
 * @param int       $len         截取的长度
 * @param int       $start       从第几个字符开始截取
 * @param boolean   $suffix      是否在截取后的字符串后跟上省略号
  +----------------------------------------------------------
 * @return string               返回截取后的字符串
  +----------------------------------------------------------
 */
function cutStr($str, $len = 100, $start = 0, $suffix = 1) {
    $str = strip_tags(trim(strip_tags($str)));
    $str = str_replace(array("\n", "\t"), "", $str);
    $strlen = mb_strlen($str);
    while ($strlen) {
        $array[] = mb_substr($str, 0, 1, "utf8");
        $str = mb_substr($str, 1, $strlen, "utf8");
        $strlen = mb_strlen($str);
    }
    $end = $len + $start;
    $str = '';
    for ($i = $start; $i < $end; $i++) {
        $str.=$array[$i];
    }
    return count($array) > $len ? ($suffix == 1 ? $str . "&hellip;" : $str) : $str;
}

/**
  +----------------------------------------------------------
 * 功能：字符串截取指定长度
 * msubstr($str, $start=0, $length, $charset=”utf-8″, $suffix=true)
  +----------------------------------------------------------
 * @param string    $str      待截取的字符串
 * @param int       $length         截取的长度
 * @param int       $start       从第几个字符开始截取
 * @param boolean   $suffix      是否在截取后的字符串后跟上省略号
 * @param boolean		$suffix		是否在截取后的字符后面显示省略号，默认true显示，false为不显示
  +----------------------------------------------------------
 * @return string               返回截取后的字符串
  +----------------------------------------------------------
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(function_exists("mb_substr")){
        $slice= mb_substr($str, $start, $length, $charset);
    }elseif(function_exists('iconv_substr')) {
        $slice= iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }    
        $fix='';
        if(strlen($slice) < strlen($str)){
            $fix='...';
        }
        return $suffix ? $slice.$fix : $slice;
}

/**
  +----------------------------------------------------------
 * 功能：检测一个目录是否存在，不存在则创建它
  +----------------------------------------------------------
 * @param string    $path      待检测的目录
  +----------------------------------------------------------
 * @return boolean
  +----------------------------------------------------------
 */
function makeDir($path) {
    return is_dir($path) or (makeDir(dirname($path)) and @mkdir($path, 0777));
}

/**
  +----------------------------------------------------------
 * 功能：检测一个字符串是否是邮件地址格式
  +----------------------------------------------------------
 * @param string $value    待检测字符串
  +----------------------------------------------------------
 * @return boolean
  +----------------------------------------------------------
 */
function is_email($value) {
    return preg_match("/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i", $value);
}

/**
  +----------------------------------------------------------
 * 功能：系统邮件发送函数
  +----------------------------------------------------------
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表namespace Org\Util\PHPMailer;
  +----------------------------------------------------------
 * @return boolean
  +----------------------------------------------------------
 */
function send_mail($to, $name, $subject = '', $body = '', $attachment = null, $config = '') {
    $config = is_array($config) ? $config : C('SYSTEM_EMAIL');
    //import('PHPMailer.phpmailer', VENDOR_PATH);         //从PHPMailer目录导class.phpmailer.php类文件
    $mail = new \Org\Util\PHPMailer\PHPMailer();                           //PHPMailer对象
    $mail->CharSet = 'UTF-8';                         //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();                                   // 设定使用SMTP服务

//    $mail->IsHTML(true);
    $mail->SMTPDebug = 0;                             // 关闭SMTP调试功能 1 = errors and messages2 = messages only
    $mail->SMTPAuth = true;                           // 启用 SMTP 验证功能
    if ($config['smtp_port'] == 465)
        $mail->SMTPSecure = 'ssl';                    // 使用安全协议
    $mail->Host = $config['smtp_host'];                // SMTP 服务器
    $mail->Port = $config['smtp_port'];                // SMTP服务器的端口号
    $mail->Username = $config['smtp_user'];           // SMTP服务器用户名
    $mail->Password = $config['smtp_pass'];           // SMTP服务器密码
    $mail->SetFrom($config['from_email'], $config['from_name']);
    $replyEmail = $config['reply_email'] ? $config['reply_email'] : $config['reply_email'];
    $replyName = $config['reply_name'] ? $config['reply_name'] : $config['reply_name'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            if (is_array($file)) {
                is_file($file['path']) && $mail->AddAttachment($file['path'], $file['name']);
            } else {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
    } else {
        is_file($attachment) && $mail->AddAttachment($attachment);
    }
    ob_clean();
    return $mail->Send() ? true : $mail->ErrorInfo;
}

/**
  +----------------------------------------------------------
 * 功能：剔除危险的字符信息
  +----------------------------------------------------------
 * @param string $val
  +----------------------------------------------------------
 * @return string 返回处理后的字符串
  +----------------------------------------------------------
 */
function remove_xss($val) {
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters
    // this prevents like <IMG SRC=@avascript:alert('XSS')>
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
        // @ @ search for the hex values
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        // @ @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }
    return $val;
}

/**
  +----------------------------------------------------------
 * 功能：计算文件大小
  +----------------------------------------------------------
 * @param int $bytes
  +----------------------------------------------------------
 * @return string 转换后的字符串
  +----------------------------------------------------------
 */
function byteFormat($bytes) {
    $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}

function checkCharset($string, $charset = "UTF-8") {
    if ($string == '')
        return;
    $check = preg_match('%^(?:
                                [\x09\x0A\x0D\x20-\x7E] # ASCII
                                | [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
                                | \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
                                | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
                                | \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
                                | \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
                                | [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
                                | \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
                                )*$%xs', $string);

    return $charset == "UTF-8" ? ($check == 1 ? $string : iconv('gb2312', 'utf-8', $string)) : ($check == 0 ? $string : iconv('utf-8', 'gb2312', $string));
}

/**
 * 显示指定英文标示的广告位
 * @param string $tagname 广告位标示
 * @param string $htag html标签，如div,li,td等，
 */
function showAdvPosition($tagname,$htag="",$is_flash = true)
{
    if(!$tagname){
        return '';
    }
    $advertising_position = M('Advertising_position');
    $advertising = M('Advertising');
    $adv_postmap['tagname'] = array('eq',$tagname);
    $ap= $advertising_position->where($adv_postmap)->find();

    $now=time();
    $advmap['status'] = array('eq',1);
    $advmap['pid'] = array('eq',$ap['id']);
    $advmap['_string'] = "((adv_start_time <='".$now."' and adv_end_time >='".$now."') or (adv_start_time =0 and adv_end_time = 0 ) or (adv_start_time <='".$now."' and adv_end_time = 0 ) or (adv_start_time =0 and adv_end_time >='".$now."' ))";
    
    $adv_list = $advertising->where($advmap)->order('sort desc,id asc')->select();

    foreach($adv_list as $key => $adv){
        $adv_list[$key]['html']= getAdvHTML($adv,$ap);
    }

    $ap['adv_list'] = $adv_list;

    if ($is_flash && $ap ['is_flash'] == 1 && ! empty ( $ap ['flash_style'] )) {
        $adv_path =  __ROOT__ ."/Public/Advertising/" . $ap ['flash_style'] . ".swf";
        $adv_pics = "";
        $adv_texts = "";
        $adv_links = "";
        
        foreach ( $ap ['adv_list'] as $adv ) {
            if (empty ( $adv_pics ))
                $jg = "";
            else
                $jg = "|";
            
            $adv_pics .= $jg .C('UPLOADS_PICPATH') . $adv ['code'];
            $adv_texts .= $jg . $adv ['desc'];
            $adv_links .= $jg . $adv ['url'];
            
        }
        
        unset ( $ap ['adv_list'] );
        $parseStr = $ap ['style'];

        $parseStr = str_replace('[adv_position.width]',$ap['width'], $parseStr);
        $parseStr = str_replace('[adv_position.height]',$ap['height'], $parseStr);
        $parseStr = str_replace('[adv_path]',$adv_path, $parseStr);
        $parseStr = str_replace('[adv_pics]',$adv_pics, $parseStr);
        $parseStr = str_replace('[adv_links]',$adv_links, $parseStr);
        $parseStr = str_replace('[adv_texts]',$adv_texts, $parseStr);
        if ($htag){
            $parseStr ='<'.$htag.'>'.$parseStr.'</'.$htag.'>';
        }

    } else {
        $ap_adv_list = $ap ['adv_list'];
        $parseStr='';
        if($ap_adv_list){
            if ($htag){
                foreach($ap_adv_list as $value){
                    $parseStr.='<'.$htag.'>'.$value['html'].'</'.$htag.'>';
                }
            }else{
                $parseStr.='<ul>';
                foreach($ap_adv_list as $value){
                    $parseStr.='<li>'.$value['html'].'</li>';
                }
                $parseStr.='</ul>';
            }
        }
    }
        
    return $parseStr;
    
}

function getAdvHTML($adv,$ap)
{   
    if($ap['width'] == 0)
        $ap['width']="";
    else
        $ap['width']=" width='".$ap['width']."'";
        
    if($ap['height'] == 0)
        $ap['height']="";
    else
        $ap['height']=" height='".$ap['height']."'";
        
    switch($adv['type']){
        case '1':
            if($adv['url']=='')
                $adv_str = "<img src='".C('UPLOADS_PICPATH').$adv['code']."'".$ap['width'].$ap['height']."/>";
            elseif(intval($adv['is_vote']) ==1)
                $adv_str = "<a href='".C('UPLOADS_PICPATH').$adv['url']."' target='_blank' title='".$adv['desc']."'><img src='".C('UPLOADS_PICPATH').$adv['code']."'".$ap['width'].$ap['height']."/></a>";
            else
                $adv_str = "<a href='".$adv['url']."' target='_blank' title='".$adv['desc']."'><img src='".C('UPLOADS_PICPATH').$adv['code']."'".$ap['width'].$ap['height']."/></a>";
            break;
        case '2':
            $adv_str = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0'".$ap['width'].$ap['height'].">".
                       "<param name='movie' value='".C('UPLOADS_PICPATH').$adv['code']."' />".
                       "<param name='quality' value='high' />".
                       "<param name='menu' value='false' />".
                       "<embed src='".C('UPLOADS_PICPATH').$adv['code']."' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'".$ap['width'].$ap['height']."></embed>".
                       "</object>";
            break;
        case '3':
            $adv_str = htmlspecialchars_decode($adv['code']);
            break;
    }
    return $adv_str;
}
//获取广告类型
function getAdvtype($type) {
    switch ($type) {
        case 2 :
            $showText = 'Flash广告';
            break;
        case 3 :
            $showText = '自定义代码广告';
            break;
        case 1 :
        default :
            $showText = '图片广告';

    }
    return $showText;

}
/**
  +----------------------------------------------------------
 * 获取图片尺寸
  +----------------------------------------------------------
 * @param string    $pN   为配置文件中图片的前缀pre_,max_,mid_,mini_
  +----------------------------------------------------------
 */
    function picSize($wk,$wh,$how='news') {
        if($how=='news'){
            $picFix = explode(',',C('NEWS_PIC_PREFIX'));
            $picWidth = explode(',',C('NEWS_PIC_WIDTH'));
            $picHeight = explode(',',C('NEWS_PIC_HEIGHT'));
        }elseif ($how=='product') {
            $picFix = explode(',',C('PRODUCT_PIC_PREFIX'));
            $picWidth = explode(',',C('PRODUCT_PIC_WIDTH'));
            $picHeight = explode(',',C('PRODUCT_PIC_HEIGHT'));
        }elseif ($how=='user') {
            $picFix = explode(',',C('USER_PIC_PREFIX'));
            $picWidth = explode(',',C('USER_PIC_WIDTH'));
            $picHeight = explode(',',C('USER_PIC_HEIGHT'));
        }elseif ($how=='techcase') {
            $picFix = explode(',',C('TEAMCASE_PIC_PREFIX'));
            $picWidth = explode(',',C('TEAMCASE_PIC_WIDTH'));
            $picHeight = explode(',',C('TEAMCASE_PIC_HEIGHT'));
        }
        $picSize = array();
        $sK = 0;
        foreach ($picFix as $fK => $fV) {
            $picSize[$sK] = array(
                'width'=> $picWidth[$fK],
                'height'=> $picHeight[$fK]
            );
            $sK +=1;
        }
        if($wk<4){
            return($picSize[$wk][$wh]);
        }
        return($picSize);
    }
/**
  +----------------------------------------------------------
 * 获取数据库中图片加上前缀的地址
  +----------------------------------------------------------
 * @param string    $str   为数据库中图片的地址
 * @param string    $fix   为配置文件中图片的前缀pre_,max_,mid_,mini_的索引分别是0,1,2,3
  +----------------------------------------------------------
 */
    function picRep($str,$fix,$how='news'){
        if($how=='news'){
            $picFix = explode(',',C('NEWS_PIC_PREFIX'));
            $preg = '/'.C('NEWS_PICPATH').'\/\d+?\//is';
        }elseif($how=='product'){
           $picFix = explode(',',C('PRODUCT_PIC_PREFIX'));
            $preg = '/'.C('PRODUCT_PICPATH').'\/\d+?\//is';
        }elseif($how=='user'){
            $picFix = explode(',',C('USER_PIC_PREFIX'));
            $preg = '/'.C('USER_PICPATH').'\//is';
        }elseif($how=='techcase'){
           $picFix = explode(',',C('TEAMCASE_PIC_PREFIX'));
            $preg = '/'.C('TEAMCASE_PICPATH').'\/\d+?\//is';
        }
        preg_match($preg, $str, $gdPicPath);
        $picFixPath=preg_replace($preg , $gdPicPath[0].$picFix[$fix], $str);
        return($picFixPath);

    }
    // 图片url
    function getImgUrl($str){
        return C('WEB_ROOT'). str_replace('./', '', C('UPLOADS_PICPATH').$str);
    }


/**
 * 通过数据库图片地址字符串获取指定图片
 * @param  [type] $picStr [数据库中图片字符串]
 * @param  [type] $fix    [第几种图片]
 * @param  [type] $key    [第几个图片]
 * @return [type]         [description]
 */
    function getPicUrl($picStr,$fix,$key){
        if ($picStr) {
            $picArr = explode('|', $picStr);
        }
        return picRep($picArr[$key],$fix);
    }
    
    /**
     * [sendSms 发私信]
     * @param  [type] $uid     [用户id]
     * @param  [str] $type     [类型]
     * @param  [type] $content [内容]
     * @return [type]          [description]
     */
    function sendSms($uid,$type,$content){
        $smsData=array(
            'uid'=>$uid,
            'type'=>$type,
            'content'=>$content,
            'time'=>time()
            );
        M('mysms')->add($smsData);
    }
    
	// 秒转换分秒
	function conversionM_S($s){
		if($s>0){
			$minute =  (int)($s/60);
			$second = $s%60;
			if($minute!=0){$conversion =$minute.'分钟';}
			if($second!=0){$conversion .=$second.'秒';}
		}else{
			$conversion=0;
		}
		return $conversion;
	}

	// 判断是手机登陆还是PC登陆
	function ismobile() {
		// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
		if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
			return true;
		//此条摘自TPM智能切换模板引擎，适合TPM开发
		if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
			return true;
		//如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
		if (isset ($_SERVER['HTTP_VIA']))
			//找不到为flase,否则为true
			return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
		//判断手机发送的客户端标志,兼容性有待提高
		if (isset ($_SERVER['HTTP_USER_AGENT'])) {
			$clientkeywords = array(
				'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
			);
			//从HTTP_USER_AGENT中查找手机浏览器的关键字
			if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
				return true;
			}
		}
		//协议法，因为有可能不准确，放到最后判断
		if (isset ($_SERVER['HTTP_ACCEPT'])) {
			// 如果只支持wml并且不支持html那一定是移动设备
			// 如果支持wml和html但是wml在html之前则是移动设备
			if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
				return true;
			}
		}
		return false;
	 }
	 // $type=1(只访问电脑版)
	 function defineView($type){
		if($type==1){
			$data['view']='Web';
			$data['mobile'] = 0;
		}elseif($type==2){
			$data['view']='Wap';
			$data['mobile'] = 1;
		}else{
			$data=array();
			if(ismobile()){
				$data['view']='Wap';
				$data['mobile'] = 1;
			}else{
				$data['view']='Web';
				$data['mobile'] = 0;
			}
		}
		return $data;
	 }
	// 读取广告位数据
	function getAdvData($tagname){
		$advertising_position = M('Advertising_position');
		$advertising = M('Advertising');
		$adv_postmap['tagname'] = array('eq',$tagname);
		$ap= $advertising_position->where($adv_postmap)->find();
		$now=time();
		$advmap['status'] = array('eq',1);
		$advmap['pid'] = array('eq',$ap['id']);
		$advmap['_string'] = "((adv_start_time <='".$now."' and adv_end_time >='".$now."') or (adv_start_time =0 and adv_end_time = 0 ) or (adv_start_time <='".$now."' and adv_end_time = 0 ) or (adv_start_time =0 and adv_end_time >='".$now."' ))";
		$adv_list = $advertising->where($advmap)->order('sort desc,id asc')->select();
		return array('adv_list'=>$adv_list,'ap'=>$ap);
	}
	function get_by_curl($url,$post = false){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if($post){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
		}
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	// 获取wap链接地址
	function getwapurl($url){
		$tempu=parse_url($url);  
		$nurl=$tempu['host']; 
		if($nurl){
			$plc = str_replace('/', '', str_replace('http://', '', C('WEB_ROOT')));
			$tourl = str_replace($nurl,$plc, $url);
		}else{
			$tourl = '网址格式不对';
		}
		return $tourl;
	}


	// 数组排序
	//     SORT_ASC - 默认，按升序排列。(A-Z)
	//     SORT_DESC - 按降序排列。(Z-A)
	// 随后可以指定排序的类型：
	//     SORT_REGULAR - 默认。将每一项按常规顺序排列。
	//     SORT_NUMERIC - 将每一项按数字顺序排列。
	//     SORT_STRING - 将每一项按字母顺序排列
	// $person = my_sort($person,'id',SORT_DESC,SORT_NUMERIC);pre($person);
	function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){   
		if(is_array($arrays)){   
			foreach ($arrays as $array){   
				if(is_array($array)){   
					$key_arrays[] = $array[$sort_key];   
				}else{   
					return false;   
				}   
			}   
		}else{
			return false;   
		}  
		array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
		return $arrays;   
	}  

	// 格式化数字删除后多余0例：1.00=1
	function wipezero($num){
		$num = strrev((float)sprintf("%.2f",$num));
		$num = strrev($num);
		return $num;
	}

	function echojson($code){
		header('Content-Type:application/json; charset=utf-8');
		echo json_encode($code);
	}

    /**
     *  post提交数据 
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据 
     * @return url响应返回的html
     */
    function sendPost($url, $datas) {
        $temps = array();   
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);      
        }   
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], 80);
        fwrite($fd, $httpheader);
        $gets = "";
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        return $gets;
    }

    
    // 移动版域名
    function wapdomain(){
        $tempu=parse_url(C('WEB_ROOT'));  
        return $tempu['host'];
    }
    // 电脑版域名
    function webdomain(){
        $tempu=parse_url(C('WEB_ROOT'));  
        return $tempu['host'];
    }
    // 判断微信浏览器
    function is_weixin(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
        }else{
            return false;
        }
    }
    
	//获取当前页面完整URL地址
    function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }
    
	function getJson($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
	

?>

