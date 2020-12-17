<?php
namespace Adminsys\Controller;
use Think\Controller;
use Org\Util\Rbac;
class PublicController extends Controller {

    public $loginMarked;

    /**
      +----------------------------------------------------------
     * 初始化
      +----------------------------------------------------------
     */
    public function _initialize() {
        header('Content-Type:application/json; charset=utf-8');
        $loginMarked = C("TOKEN");
        $this->loginMarked = md5($loginMarked['admin_marked']);
    }

    /**
      +----------------------------------------------------------
     * 验证token信息
      +----------------------------------------------------------
     */
    private function checkToken() {
        if (!M("Admin")->autoCheckToken($_POST)) {
            die(json_encode(array('status' => 0, 'info' => '令牌验证失败')));
        }
        unset($_POST[C("TOKEN_NAME")]);
    }

    public function index() {
        if (IS_POST) {
          //  $this->checkToken();
            $returnLoginInfo = D("Public")->auth();
            //生成认证条件
            if ($returnLoginInfo['status'] == 1) {
                $map = array();
                // 支持使用绑定帐号登录
                $map['account'] = I('post.account');
               // import('Org.Util.Rbac');
                $authInfo = Rbac::authenticate($map);
                $_SESSION[C('USER_AUTH_KEY')] = $authInfo['aid'];
                $_SESSION['account'] = $authInfo['account'];
                if ($authInfo['account'] == C('ADMIN_AUTH_KEY')) {
                    $_SESSION[C('ADMIN_AUTH_KEY')] = true;
                }
                //echojson($_SESSION);
                // 缓存访问权限
                RBAC::saveAccessList();
            }
            echojson($returnLoginInfo);
        } else {
            if (isset($_COOKIE[$this->loginMarked])) {
                $this->redirect("Index/index");
            }
            $systemConfig = include APP_PATH . 'Common/Conf/systemConfig.php';
            $this->assign("site", $systemConfig);
            $this->display("Common:login");
        }
    }

    public function timeing(){
        if (IS_POST) {

        }else{
            pre('asdasd');
            die;
        }
        
    }

    public function verify_code(){
        ob_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 17;
        $Verify->length   = 4;
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }
    public function loginOut() {
        $timeout = C("TOKEN");
        setcookie($this->loginMarked, NULL, -$timeout['admin_timeout'], "/");
        unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
        }
        $this->redirect("Index/index");
    }

    public function findPwd() {
        $M = M("Admin");
        if (IS_POST) {
            $this->checkToken();
            echojson(D("Public")->findPwd());
        } else {
            $timeout = C("TOKEN");
            setcookie($this->loginMarked, NULL, -$timeout['admin_timeout'], "/");
            unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
            $cookie =I('get.code');
            $shell = substr($cookie, -32);
            $aid = (int) str_replace($shell, '', $cookie);
            $info = $M->where(array('aid'=>$aid))->find();
            if ($info['status'] == 0) {
                $this->error("你的账号被禁用，有疑问联系管理员吧", __APP__);
            }
            if (md5($info['find_code']) == $shell) {
                $this->assign("info", $info);
                $_SESSION['aid'] = $aid;
                $systemConfig = include APP_PATH . 'Common/Conf/systemConfig.php';
                $this->assign("site", $systemConfig);
                $this->display("Common:findPwd");
            } else {
                $this->error("验证地址不存在或已失效", __APP__);
            }
        }
    }

}