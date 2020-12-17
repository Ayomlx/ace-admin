<?php
namespace Adminsys\Controller;
use Think\Controller;
// 本类设置项目一些常用信息
class WebinfoController extends CommonController {
    /**
      +----------------------------------------------------------
     * 配置网站信息
      +----------------------------------------------------------
     */
    public function index() {

        $this->display();
    }

    /**
      +----------------------------------------------------------
     * 配置网站信息
      +----------------------------------------------------------
     */
    public function steWebConfig() {
        $this->checkSystemConfig('SITE_INFO','steWebConfig');
    }
    
    /**
      +----------------------------------------------------------
     * 配置网站短信
      +----------------------------------------------------------
     */
    public function setNoteConfig() {
        $display = 'setNoteConfig';
        $this->checkSystemConfig("SYSTEM_NOTE",$display);
    }
    /**
      +----------------------------------------------------------
     * 配置网站安全信息
      +----------------------------------------------------------
     */
    public function setSafeConfig() {
        $this->checkSystemConfig("TOKEN",'setSafeConfig');
    }
    /**
      +----------------------------------------------------------
     * 编辑用户协议
      +----------------------------------------------------------
     */
    public function setUserAgreement() {
        if (IS_POST) {
            $this->checkToken();
            $config = APP_PATH . "Common/Conf/UserAgreement.php";
            $config = file_exists($config) ? include "$config" : array();
            $config = is_array($config) ? $config : array();
            if (set_config("UserAgreement", I('post.'), APP_PATH . "Common/Conf/")) {
                delDirAndFile(WEB_CACHE_PATH . "Cache/Admin/");
                echojson(array('status' => 1, 'info' => '用户协议已更新'));
            } else {
                echojson(array('status' => 0, 'info' => '用户协议失败，请检查', 'url' => __ACTION__));
            }
        } else {
            $this->UserAgreement = include APP_PATH . 'Common/Conf/UserAgreement.php';
            $this->display('setUserAgreement');
        }
    }
    /**
     * 导航链接管理
     * @return [type] [description]
     */
    public function navigation() {
        if (IS_POST) {
            echojson(D("Webinfo")->navigation());
        } else {
            $this->assign("list", D("Webinfo")->navigation());
            $this->display();
        }
    }
    //---导航链接异步排序
    public function order_navigation() {
        if (IS_POST) {
            $getInfo = I('post.');
            $M = M('navigation');
            $where=array('lid'=>$getInfo['odAid']);
            if($getInfo['odType'] == 'rising'){
                if($M->where($where)->setInc('sort')){

                    echojson(array('status'=>'1','msg'=>'排序写入数据库成功'));
                }
            }elseif($getInfo['odType'] == 'drop'){
                if($M->where($where)->setDec('sort')){
                    echojson(array('status'=>'1','msg'=>'排序写入数据库成功'));
                }
            }
        } else {
            echojson(array('status'=>'0','msg'=>'什么情况'));
        }
    }
    /**
      +----------------------------------------------------------
     * 网站配置信息保存操作等
      +----------------------------------------------------------
     */
    private function checkSystemConfig($obj = "SITE_INFO",$display) {
        if (IS_POST) {
            $this->checkToken();
            $config = APP_PATH . "Common/Conf/systemConfig.php";
            $config = file_exists($config) ? include "$config" : array();
            $config = is_array($config) ? $config : array();
            $config = array_merge($config, array("$obj" => $_POST));
            if($obj == "SITE_INFO"){
              $str = "网站配置信息";
            }elseif ($obj == "SYSTEM_EMAIL") {
              $str = "系统邮箱配置";
            }elseif($obj == 'TOKEN'){
              $str = "安全设置";
            }elseif($obj == 'SYSTEM_NOTE'){
              $str = "系统短信配置";
            }
            if (set_config("systemConfig", $config, APP_PATH . "Common/Conf/")) {
                delDirAndFile(WEB_CACHE_PATH . "Cache/Admin/");
                if ($obj == "TOKEN") {
                    unset($_SESSION, $_COOKIE);
                    echojson(array('status' => 1, 'info' => $str . '已更新，你需要重新登录', 'url' => __APP__ . '?' . time()));
                } else {
                    echojson(array('status' => 1, 'info' => $str . '已更新'));
                }
            } else {
                echojson(array('status' => 0, 'info' => $str . '失败，请检查', 'url' => __ACTION__));
            }
        } else {
            $this->display($display);
        }
    }

    /**
      +----------------------------------------------------------
     * 测试邮件账号是否配置正确
      +----------------------------------------------------------
     */
    public function testEmailConfig() {
        C('TOKEN_ON', false);
        $return = send_mail($_POST['test_email'], "", "测试配置是否正确", "这是一封测试邮件，如果收到了说明配置没有问题", "", $_POST);
        if ($return == 1) {
            echojson(array('status' => 1, 'info' => "测试邮件已经发往你的邮箱" . $_POST['test_email'] . "中，请注意查收"));
        } else {
            echojson(array('status' => 0, 'info' => "$return"));
        }
    }
    /**
      +----------------------------------------------------------
     * 测试邮件账号是否配置正确
      +----------------------------------------------------------
     */
    public function testNoteConfig() {
        C('TOKEN_ON', false);
        echojson(sendNote(C('SYSTEM_NOTE.test'),$content='如果收到了说明没有问题'));
    }
    // 快递管理
    public function express(){
        if (IS_POST) {
            $this->checkSystemConfig("EXPRESS",'express');
        }else{
            $express = M('express');
            $letter = explode('|', 'A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z');
            foreach ($letter as $lk => $lv) {
                $data = $express->where(array('letter'=>$lv))->order('sort desc')->select();
                if($data){
                    $list[$lv] = $data;
                }
            }

            $this->list=$list;
            $this->display();
        }
        
    }
    // 快递查询测试
    public function express_test(){
        if (IS_POST) {
            echojson(getExpressHtml(I('post.typecom'),I('post.typenu')));
        }else{
            $this->list=expressCompany();
            $this->display();
        }
        
    }
    // ------快递异步字段开关
    public function onOff_express() {
        if (IS_POST) {
            $data = array(
                'id'=>I('post.eid'),
                'status'=>I('post.val')
                );
            $sta = $data['status'] == 0 ? '关闭':'开启';
            if($data['status']==0){
                $sta = '启用';
            }elseif ($data['status']==1) {
                $sta = '禁用';
            }elseif ($data['status']==2) {
                $sta = '常用';
            }
            if(M('express')->save($data)){
                echojson(array('status'=>'1','msg'=>'已设置'.$sta)); 
            }else{
                echojson(array('status'=>'0','msg'=>'设置'.$sta.'失败')); 
            }
        } else {
            E('页面不存在');
        }
    }
    //---快递异步排序
    public function order_express() {
        if (IS_POST) {
            $getInfo = I('post.');
            $M = M('express');
            $where=array('id'=>$getInfo['eid']);
            if($getInfo['odType'] == 'rising'){
                if($M->where($where)->setInc('sort')){
                    echojson(array('status'=>'1','msg'=>'排序写入数据库成功'));
                }
            }elseif($getInfo['odType'] == 'drop'){
                if($M->where($where)->setDec('sort')){
                    echojson(array('status'=>'1','msg'=>'排序写入数据库成功'));
                }
            }
        } else {
            echojson(array('status'=>'0','msg'=>'什么情况'));
        }
    }
    // 快捷登陆配置
    public function set_login() {
        if (IS_POST) {
            $this->checkToken();
            $config = APP_PATH . "Common/Conf/SetLogin.php";

            $config = file_exists($config) ? include "$config" : array();
            $config = is_array($config) ? $config : array();
            $data = I('post.');
            if (set_config("SetLogin", $data, APP_PATH . "Common/Conf/")) {
                delDirAndFile(WEB_CACHE_PATH . "Cache/Admin/");
                echojson(array('status' => 1, 'info' => '设置成功','url'=>__ACTION__));
            } else {
                echojson(array('status' => 0, 'info' => '设置失败，请检查'));
            }
        } else {
            $mbcof = include APP_PATH . 'Common/Conf/SetLogin.php';
            $this->mbcof=$mbcof;
            $this->display(); 
        }
    }
	
	//Logo删除
	public function del_pic() {
        $data = I('post.');
		$imgUrl = $data['imgurl'];
        $fullPath = C('UPLOADS_PICPATH').$imgUrl;
		if(@unlink($fullPath)){
			echojson(array('status'=>1, 'info'=>'已从磁盘删除成功!'));
		}else{
			echojson(array('status'=>0,'info'=>'磁盘文件删除失败，请检查文件是否存在或磁盘权限!'.$fullPath));
		}
    }


}

?>