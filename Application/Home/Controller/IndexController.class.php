<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
    public function index() {
        #轮播图
        $list['slide'] = D('Common')->getList('Slide', 'cid=0');
        #分类图标
        $list['catimg'] = D('Common')->getList('Slide', 'cid=1');
        #产品
        $list['product'] = D('Common')->getList('Extend_product');
        #技术团队
        $tech = D('Common')->getFind('Team_case', 'type=0');
        $list['tech'] = D('Common')->formatData($tech);
        #案例
        $cases = D('Common')->getFind('Team_case', 'type=1');
        $list['cases'] = D('Common')->formatData($cases);
        #关于我们
        $list['about'] = D('Common')->getFind('About', 'cid=42');
        if($list['about']['content']) {
        	$list['about']['content'] = strip_tags($list['about']['content'], '<p>');
        }
        #栏目简介
        $list['menu_summary'] = include APP_PATH . 'Common/Conf/setMenuConfig.php';        

        $this->list = $list;
		$this->display();
    }
	
    

}