<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends CommonController {
    
    public function lists(){
    	$id = I('id');
    	#产品信息
    	$info = D('Common')->getFind('Extend_product', 'id='.$id);
    	#概述
    	$type_0 = D('Common')->getFind('Extend_product_detail', 'type=0 and product_id='.$id);
    	$info['type_0'] = D('Common')->formatData($type_0, 1);
    	#功能
    	$type_1 = D('Common')->getFind('Extend_product_detail', 'type=1 and product_id='.$id);
    	$info['type_1'] = D('Common')->formatData($type_1, 1);
    	#应用
    	$type_2 = D('Common')->getFind('Extend_product_detail', 'type=2 and product_id='.$id);
    	$info['type_2'] = D('Common')->formatData($type_2, 1);
    	#案例
    	$type_3 = D('Common')->getFind('Extend_product_detail', 'type=3 and product_id='.$id);
    	$info['type_3'] = D('Common')->formatData($type_3, 1);
    	
    	$this->info = $info;
    	$this->display();
    }

}