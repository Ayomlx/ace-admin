<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public $loginMarked;
    public $cUid;
    public $ism;
    /**
      +----------------------------------------------------------
     * 初始化
     * 如果 继承本类的类自身也需要初始化那么需要在使用本继承类的类里使用parent::_initialize();
      +----------------------------------------------------------
     */
    public function _initialize() {
        error_reporting(0);
        ini_set("error_reporting","E_ALL & ~E_NOTICE"); 
        $systemConfig = include APP_PATH . '/Common/Conf/systemConfig.php';
        if (empty($systemConfig['TOKEN']['member_marked'])) {
            $systemConfig['TOKEN']['admin_marked'] = "admin.ppw360.com";
            $systemConfig['TOKEN']['admin_timeout'] = 3600;
            $systemConfig['TOKEN']['member_marked'] = "home.ppw360.com";
            $systemConfig['TOKEN']['member_timeout'] = 3600;
            set_config("systemConfig", $systemConfig, APP_PATH . "/Common/Conf/");
            if (is_dir(APP_PATH . "install/")) {
                //delDirAndFile(WEB_ROOT . "/install/", TRUE);
            }
        } 
        // checkKey();
        // 定义模板【
        // 如果是1的话只访问电脑版
        $who = defineView(1);
        $this->ism=$who['mobile'];
        C('DEFAULT_THEME',$who['view']);
        $this->webroot=$who['webroot'];
        // 定义模板】
        $this->loginMarked = md5($systemConfig['TOKEN']['member_marked']);

        // 获取当前用户id
        // 登录信息分配到模板
        $this->login = $this->checkLogin(0);
        $markedArr = explode('_', $_COOKIE[$this->loginMarked]);
        $this->cUid=substr($markedArr[0],0,-32);

        $this->uid = $this->cUid;
        //当前用户用户名分配到模板 
		if($this->checkLogin(0)){
            $cominfo = M('Member')->where('uid ='.$this->cUid)->field('account')->find();
            $this->user_account = $cominfo['account'];
        }
        // 当前时间分配到模板
        $this->nowtime = time();
        // 图片上传路径
        $this->upWholeUrl = __ROOT__.trim(C('UPLOADS_PICPATH'),'.');
		$this->assign("site", $systemConfig);
		$about_category = M('About_category')->where('pid=0')->order('sort desc')->select();
		foreach($about_category as $k=>$v){
			$about_category[$k]['item'] = M('About_category')->where('pid='.$v['cid'])->select();
		}
		$this->assign("about_category", $about_category);
    }
	
    // 判断登陆状态
    public function checkLogin($type) {
        if (isset($_COOKIE[$this->loginMarked])) {
            $cookie = explode("_", $_COOKIE[$this->loginMarked]);
            $timeout = C("TOKEN");
            if (time() > (end($cookie) + $timeout['member_timeout'])) {
                setcookie($this->loginMarked, NULL, -$timeout['member_timeout'], "/");
                unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                if($type){
                    $this->error("登录超时，请重新登录", U("Login/index"));
                }else{
                    return 0;
                }
            } else {
                if ($cookie[0] == $_SESSION[$this->loginMarked]) {
                    setcookie($this->loginMarked, $cookie[0] . "_" . time(), 0, "/");
                } else {
                    setcookie($this->loginMarked, NULL, -$timeout['member_timeout'], "/");
                    unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                    if($type){
                        $this->error("帐号异常，请重新登录", U("Login/index"));
                    }else{
                        return 0;
                    } 
                }
            }
        } else {
            if($type){
                $this->redirect("Login/index");
            }else{
                return 0;
            } 
        }
        return 1;
    }

    /**
      +----------------------------------------------------------
     * 验证token信息
      +----------------------------------------------------------
     */
    protected function checkToken() {
        if (IS_POST) {
            if (!M("Admin")->autoCheckToken($_POST)) {
                die(echojson(array('status' => 0, 'info' => '重复提交数据！','msg' => '重复提交数据！')));
            }
            unset($_POST[C("TOKEN_NAME")]);
        }
    }

}