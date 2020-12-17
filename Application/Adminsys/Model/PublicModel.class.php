<?php

namespace Adminsys\Model;
use Think\Model;
class PublicModel extends Model {

    public function auth($datas) {
        $datas = $_POST;
        /*取消登陆验证码 2016-01-12 zhouhe
        if (check_verify($_POST['verify_code'])==false) {
            die(json_encode(array('status' => 0, 'info' => "验证码错误啦，再输入吧",'url'=>__SELF__)));
        }
        */
        $M = M("Admin");
        $where['account'] = array('eq',$datas['account']);
        if ($M->where($where)->count() >= 1) {
            $info = $M->where($where)->find();
            if ($info['status'] == 0) {
                return array('status' => 0, 'info' => "你的账号被禁用，有疑问联系管理员吧");
            }

            if ($info['pwd'] == encrypt($datas['pwd'])) {
                $systemConfig = include APP_PATH . '/Common/Conf/systemConfig.php';
                $loginMarked = md5($systemConfig['TOKEN']['admin_marked']);
                $shell = $info['aid'] .md5($info['pwd'] . C('AUTH_CODE'));
                $_SESSION[$loginMarked] = $shell;
                $shell.= "_" . time();
                
                setcookie($loginMarked, $shell, time()+$systemConfig['TOKEN']['admin_timeout'], "/");
                $_SESSION['my_info'] = $info;
                return array('status' => 1, 'info' => "登录成功", 'url' => U("Index/index"));
            } else {
                return array('status' => 0, 'info' => "账号或密码错误");
            }
        } else {
            return array('status' => 0, 'info' => "不存在：" . $datas["account"] . '的管理员账号！');
        }
    }

    public function findPwd() {
        $datas = $_POST;
        $M = M("Admin");
        if (check_verify($_POST['verify_code'])==false) {
            die(json_encode(array('status' => 0, 'info' => "验证码错误啦，再输入吧")));
        }

        if (trim($datas['pwd']) == '') {
            return array('status' => 0, 'info' => "密码不能为空");
        }
        if (trim($datas['pwd']) != trim($datas['pwd1'])) {
            return array('status' => 0, 'info' => "两次密码不一致");
        }
        $data['aid'] = $_SESSION['aid'];
        $data['pwd'] = md5(C("AUTH_CODE") . md5($datas['pwd']));
        $data['find_code'] = NULL;
        if ($M->save($data)) {
            return array('status' => 1, 'info' => "你的密码已经成功重置", 'url' => U('Access/index'));
        } else {
            return array('status' => 0, 'info' => "密码重置失败");
        }
    }

}

?>
