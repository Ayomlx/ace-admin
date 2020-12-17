<?php
namespace Adminsys\Model;
use Think\Model;
class MemberModel extends Model {
    public function add(){
        $data = I('post.info');
        $uid = I('post.uid');
        #模型扩展字段
        $p_data = I('post.param');

        if($data['pwd']){
            if(strlen($data['pwd'])<6){
                return array('status'=>0, 'info'=>'密码少于6位！');
                exit;
            }
            $data['pwd']=encrypt($data['pwd']);
        }else{
            unset($data['pwd']);
        }
        if($uid){
            $where['uid'] = array('eq', $uid);
            if(D('Common')->update('Member', $data, $where)!==false){
                #更新模型扩展字段数据
                if($p_data){
                    foreach ($p_data as $pdk => $pdv) {
                        $p_where['data_id'] = array('eq', $uid);
                        $p_where['module_id'] = array('eq', 6);
                        $p_where['field_id'] = array('eq', $pdk);
                        $p_data_ext['default'] = $pdv;
                        #数据存在?'更新':'插入'
                        if(D('Common')->count('Module_field_data', $p_where)){
                            D('Common')->update('Module_field_data', $p_data_ext, $p_where);
                        }else{
                            $p_data_ext['data_id'] = $uid;
                            $p_data_ext['module_id'] = 6;
                            $p_data_ext['field_id'] = $pdk;
                            D('Common')->insert('Module_field_data', $p_data_ext);
                        }
                    }
                }
                return array('status'=>1, 'info'=>'修改会员成功','url'=>U('Member/index'));
                exit;
            }else{
                return array('status'=>0, 'info'=>'修改会员失败');
                exit;
            }
        }else{
            if(empty($data['pwd'])){
                return array('status'=>0, 'info'=>'请输入密码！');
                exit;
            }
            $re = D('Common')->insert('Member', $data);
            if($re){
                #保存模型扩展字段数据
                if($p_data){
                    $i = 0;
                    foreach ($p_data as $pdk => $pdv) {
                        $p_data_ext[$i]['data_id'] = $re;
                        $p_data_ext[$i]['module_id'] = 6;
                        $p_data_ext[$i]['field_id'] = $pdk;
                        $p_data_ext[$i]['default'] = $pdv;
                        $i++;
                    }
                    D('Common')->insert('Module_field_data', $p_data_ext, 1);
                }
                return array('status'=>1, 'info'=>'添加会员成功','url'=>U('Member/index'));
                exit;
            }else{
                return array('status'=>0, 'info'=>'添加会员失败');
                exit;
            }
        }
    }
	
}
?>
