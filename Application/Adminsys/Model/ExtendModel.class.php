<?php
namespace Adminsys\Model;
use Think\Model;
class ExtendModel extends Model {

    public function product_detail() {
        if (IS_POST) {
            $data = $_POST['info'];
            //获取图片
            $data['picture'] = implode('|', I('post.pic'));
            //获取标题
            $data['title'] = implode('|', I('post.title'));
            //获取摘要
            $data['summary'] = implode('|', I('post.summary'));
            //匹配操作信息
            $type = $data['type'];
            $typeArr = array(0=>'概述',1=>'功能',2=>'应用',3=>'案例');
            //判断新增/更新
            if($data['id']){
                $act = $typeArr[$type].'更新';
                $suc = D('Common')->update('Extend_product_detail', $data);
            }else{
                unset($data['id']);
                $act = $typeArr[$type].'发布';
                $suc = D('Common')->insert('Extend_product_detail', $data);
            }
            //返回结果
            if ($suc) {
                 return array('status'=>1, 'info'=>$act.'成功.', 'url'=>U('Extend/product'));
            } else {
                return array('status'=>0, 'info'=>$act.'失败,请刷新页面尝试操作.');
            }

        }     
    }


}

?>
