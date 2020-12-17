<?php

namespace Adminsys\Controller;
use Think\Controller;
class ModuleController extends CommonController {
    
    //模型添加/修改
    public function index() {
        C('TOKEN_ON',false);
        if (IS_POST) {
            $act = $_POST['act'];
            $data = $_POST['info'];
            $data['name'] = addslashes($data['name']);
            if($act=='add'){
                unset($data['id']);
                $re = D('Common')->insert('Module', $data);
            }elseif($act=='edit'){
                $re = D('Common')->update('Module', $data);
            }
            $tag = $act=='add'?'添加':'修改';
            echojson($re?array('status'=>1, 'info'=>'模型'.$tag.'成功.', 'url'=>U('Module/index')):array('status'=>0, 'info'=>'模型'.$tag.'失败.', 'url'=>U('Module/index')));
        }else{
            $list = D('Common')->getList('Module');
            $this->list = $list;
            $this->btn = '添加';
            $this->display(); 
        }
        
    }
    
    //模型编辑
    public function edit() {
        if ($_GET) {
            C('TOKEN_ON',false);
            #待编辑信息
            $where['id'] = array('eq', I('get.id'));
            $info = D('Common')->getFind('Module', $where);
            $this->info = $info;
            #模型列表
            $list = D('Common')->getList('Module');
            $this->list = $list;
            $this->btn = '修改';
            $this->action = 'edit';
        }
        $this->display("index");
    }
    
    //模型删除
    public function del() {
        $id = I('id');
        C('TOKEN_ON',false);
        //文章、产品、单页、会员为系统模型，不可删除
        $id = array_diff($id, '2,3,6,7');
        $where['id'] = array('in',$id);
        if (D('Common')->del('Module',$where)) {
            $where_field['module_id'] = array('in',$id);
            D('Common')->del('Module_field',$where_field);
            echojson(array('status'=>1,'info'=>'模型删除成功'));
        } else {
			echojson(array('status'=>0,'info'=>'模型删除失败，可能是不存在该ID的记录'));
        }
    }
    
	//模型排序
    public function sort() {
        if (IS_POST) {
            $data = I('post.');
            echojson(D('Common')->sort('Module',$data,'id'));
        } else {
            echojson(array('status'=>0,'info'=>'操作异常.'));
        }
    }

    //模型状态设置
    public function set_status() {
        $id = I('id');
        $v = I('opt',0);
        $table = I('t','Module');
        $vTag = $v==0?'状态禁用':'状态启用';
        $where['id'] = array('in',$id);
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

    //字段列表
    public function field() {
        #获取模型id
        $module_id = I('id');
        C('TOKEN_ON',false);
        #检索所属模型字段
        $where['module_id'] = array('eq', $module_id);
        $list = D('Common')->getList('Module_field', $where);
        
        $this->list = $list;
        $this->module_id = $module_id;
        $this->display();
    }

    //添加字段
    public function field_add() {
        if(IS_POST){
            $data = $_POST['info'];
            unset($data['id']);
            $re = D('Common')->insert('Module_field',$data);
            if($re){
                $where['id'] = array('eq', $data['module_id']);
                $module_name = D('Common')->getCol('Module', $where, 'name');
                if($module_name){
                    $module_name .= '模型';
                }
                echojson(array('status'=>1,'info'=>$module_name.'字段添加成功.','url'=>U('Module/field',array('id'=>$data['module_id']))));
            }else{
                echojson(array('status'=>0,'info'=>'添加失败，操作异常.'));
            }
        }else{
            $module_id = I('id');
            if($module_id){
                $info['module_id'] = $module_id;
            }else{
                $this->error('模型id缺失,请关联对应模型.');
            }
            $this->btn = '添加';
            $this->info = $info;
            $this->display();
        }
        
    }

    //修改字段
    public function field_edit() {
        if(IS_POST){
            $data = $_POST['info'];
            $re = D('Common')->update('Module_field',$data);
            if($re!==false){
                echojson(array('status'=>1,'info'=>'字段修改成功','url'=>U('Module/field',array('id'=>$data['module_id']))));
            }else{
                echojson(array('status'=>0,'info'=>'修改失败，操作异常.'));
            }
        }else{
            $id = I('id');
            $where['id'] = array('eq',$id);
            $info = D('Common')->getFind('Module_field',$where);
            $this->info = $info;
            $this->display('field_add');
        }
    }

    //字段删除
    public function field_del() {
        $id = I('id');
        C('TOKEN_ON',false);
        $where['id'] = array('in',$id);
        if (D('Common')->del('Module_field',$where)) {
            echojson(array('status'=>1,'info'=>'字段删除成功'));
        } else {
            echojson(array('status'=>0,'info'=>'字段删除失败，可能是不存在该ID的记录'));
        }
    }
    
    //字段排序
    public function field_sort() {
        if (IS_POST) {
            $data = I('post.');
            echojson(D('Common')->sort('Module_field',$data,'id'));
        } else {
            echojson(array('status'=>0,'info'=>'操作异常.'));
        }
    }

    //字段异步设置
    public function field_ajaxset() {
        $id = I('id');
        $opt = I('opt');
        $optTag = array('R-0'=>'不必填','R-1'=>'必填','S-0'=>'状态禁用','S-1'=>'状态启用');
        #操作字段
        $vArr = explode('-', $opt);
        $val = $vArr[1];
        if($opt=='R-0' || $opt=='R-1'){
            $field = 'required';
        }elseif($opt=='S-0' || $opt=='S-1'){
            $field = 'status';
        }

        $where['id'] = array('in',$id);
        $data[$field] = $val;
        if (D('Common')->update('Module_field', $data, $where)) {
            //写入日志
            //$log['uid'] = $_SESSION['my_info']['aid'];
            //$log['title'] = '设置商务信息';
            //$log['content'] = '标题为:'.$logTxt.'的商务信息设置为:'.$optTag[$opt];
            //writeLog($log['uid'],$log['title'],$log['content']);
            //end
            echojson(array('status'=>1, 'info'=>$optTag[$opt].'设置成功.'));
        } else {
            echojson(array('status'=>0, 'info'=>'操作异常.'));
        }
    }
	
}?>
