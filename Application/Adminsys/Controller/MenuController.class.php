<?php

namespace Adminsys\Controller;
use Think\Controller;
class MenuController extends CommonController {
    
    public function index() {
        $list = D('Common')->getList('Menu','pid=0','sort desc,cid asc');
        if($list){
            foreach ($list as $k => $v) {
                $where['pid'] = array('eq', $v['cid']);
                $list[$k]['childmenu'] = D('Common')->getList('Menu',$where,'sort desc,cid asc');
            }
        }
		$this->list = $list;
        C('TOKEN_ON',false);
        $this->display(); 
    }
    
    public function add() {
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            unset($data['cid']);
            if($data['pid']>0){
                $data['ctl'] = D('Common')->getCol('Menu','cid='.$data['pid'],'ctl');
            }
            if(D('Common')->insert('Menu', $data)){
                echojson(array('status'=>1,'info'=>'栏目添加成功.','url'=>U('Menu/index')));
            }else{
                echojson(array('status'=>0,'info'=>'添加失败，操作异常.'));
            }
        } else {
            #栏目列表
            $list = D('Common')->getList('Menu','pid=0','sort desc,cid asc');
            if($list){
                foreach ($list as $k => $v) {
                    $where['pid'] = array('eq', $v['cid']);
                    $list[$k]['childmenu'] = D('Common')->getList('Menu',$where,'sort desc,cid asc');
                }
            }
            #模型列表
            //$list_module = D('Common')->getList('Menu','status=1');
            $this->list = $list;
            $info['status'] = 1;
            $this->info = $info;
            $this->display();
        }
    }
    
    public function edit() {
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            $re = D('Common')->update('Menu', $data);
            if($re!==false){
                echojson(array('status'=>1,'info'=>'栏目修改成功','url'=>U('Menu/index')));
            }else{
                echojson(array('status'=>0,'info'=>'修改失败，操作异常.'));
            }
        } else {
            $where['cid'] = array('eq', I('get.id'));
            $info = D('Common')->getFind('Menu', $where);
            if (!$info) {
                $this->error("不存在该记录");
            }
            #栏目列表
            $list = D('Common')->getList('Menu','pid=0','sort desc,cid asc');

            $info['active'] = '编辑';
            $this->assign("info", $info);
            $this->list = $list;
            $this->display("add");
        }
    }
    
    //栏目删除
    public function del() {
        $id = I('id');
        C('TOKEN_ON',false);
        $where['cid'] = array('in',$id);
        if (D('Common')->del('Menu',$where)) {
            echojson(array('status'=>1,'info'=>'栏目删除成功'));
        } else {
            echojson(array('status'=>0,'info'=>'栏目删除失败，可能是不存在该ID的记录'));
        }
    }
    
	//栏目排序
    public function sort() {
        if (IS_POST) {
            $data = I('post.');
            echojson(D('Common')->sort('Menu',$data));
        } else {
            echojson(array('status'=>0, 'info'=>'操作异常.'));
        }
    }

    //状态设置
    public function set_status() {
        $id = I('id');
        $v = I('opt',0);
        $table = I('t','Menu');
        $vTag = $v==0?'状态禁用':'状态启用';
        $where['cid'] = array('in',$id);
        $data['status'] = $v;
        if (D('Common')->update($table, $data, $where)) {
            //写入日志
            //$log['uid'] = $_SESSION['my_info']['aid'];
            //$log['title'] = '设置商务信息';
            //$log['content'] = '标题为:'.$logTxt.'的商务信息设置为:'.$optTag[$opt];
            //writeLog($log['uid'],$log['title'],$log['content']);
            //end
            echojson(array('status'=>1, 'info'=>$vTag.'设置成功.'));
        } else {
            echojson(array('status'=>0, 'info'=>'操作异常.'));
        }
    }

    //异步修改名称
    public function ajax_set_name() {
        if (IS_POST) {
            $f_name = array('name'=>'栏目名称', 
                            'short_name'=>'简称'
                        );
            $info = I('post.');
            $field = $info['f'];
            $data['cid'] = $info['odId'];
            $data[$field] = $info['odVal'];
            if(D('Common')->update('Menu',$data)){
                echojson(array('status'=>'1','info'=>$f_name[$field].'修改成功.'));
            }else{
                echojson(array('status'=>'0','info'=>'修改失败,操作异常.'));
            }
        }else{
            echojson(array('status'=>'0','info'=>'异常操作'));
        }
    }

    //异步获取控制器名
    public function ajax_getctl(){
        $cid = I('id');
        C('TOKEN_ON',false);
        if($cid){
            $ctl = D('Common')->getCol('Menu','cid='.$cid, 'ctl');
            echojson(array('status'=>1,'info'=>$ctl));
        }
    }

	
}?>
