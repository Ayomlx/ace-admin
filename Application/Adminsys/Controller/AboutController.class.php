<?php

namespace Adminsys\Controller;
use Think\Controller;
class AboutController extends CommonController {
    
    public function index() {
        $count = D('Common')->getCount('About');
		$pConf = page($count,8);
        $this->page = $pConf['show'];
        $this->list = D('Common')->getList('About', '', 'id desc', $pConf['first'].','.$pConf['list']);
        $this->cate = D('Common')->category(27, 'module_id=7');
        C('TOKEN_ON',false);
        $this->display(); 
    }
    
    //搜索
    public function search(){
            $keyW = I('get.');
            if($keyW['cid'] != '') $where['cid'] = $keyW['cid'];
            if($keyW['keyword'] != '') $where['title'] = array('LIKE', '%' . $keyW['keyword'] . '%');
            if($keyW['cid'] != ''){
                $catname = D('Common')->getCol('category', 'cid='.$keyW['cid'], 'name');
            }else{
               $catname = '所有'; 
            }
            $this->keyS = array('count'=>$count, 'keyword'=>$keyW['keyword'], 'name'=>$catname, 'cid'=>$keyW['cid']);

            $count = D('Common')->getCount('About', $where);
            $pConf = page($count,8);
			$this->page = $pConf['show'];
            $this->list = D('Common')->getList('About', $where, 'id desc', $pConf['first'].','.$pConf['list']);
            $this->cate = D('Common')->category(27, 'module_id=7');
            C('TOKEN_ON',false);
            $this->display('index');
    }
    
    //添加
    public function add() {
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            $data['addtime'] = time();
            $act = D('Common')->insert('About', $data);
            if ($act) {
                echojson(array('status'=>1, 'info'=>'已经发布', 'url'=>U('About/index')));
            } else {
                echojson(array('status'=>0, 'info'=>'发布失败，请刷新页面尝试操作'));
            }
        } else {
            $this->assign("list", D('Common')->category(41, 'module_id=7'));
            $this->display();
        }
    }
    
    //编辑
    public function edit() {
        $M = M("About");
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            if(D('Common')->update('About', $data)){
                echojson(array('status'=>1, 'info'=>'已经更新', 'url'=> U('About/index')));
            }else{
                echojson(array('status'=>0, 'info'=>'更新失败，请刷新页面尝试操作'));
            }
        } else {
            $id = I('id');
            if ($id=='') {
                $this->error("不存在该记录");
            }
            $info = D('Common')->getFind('About', 'id='.$id);
            $info['content']=stripslashes($info['content']);
            $this->assign("info", $info);
            $this->assign("list", D('Common')->category(41, 'module_id=7'));
            $this->display("add");
        }
    }
    
    //删除
    public function del() {
        $id = I('id');
        C('TOKEN_ON',false);
        $where['id'] = array('in',$id);
        if (D('Common')->del('About',$where)) {
            echojson(array('status'=>1,'info'=>'删除成功'));
        } else {
            echojson(array('status'=>0,'info'=>'删除失败，可能是不存在该ID的记录'));
        }
    }
    
	//排序
    public function sort() {
        if (IS_POST) {
            $data = I('post.');
            $re = D('Common')->sort('About', $data, 'id');
            echojson($re);
        } else {
            echojson(array('status'=>'0','info'=>'什么情况'));
        }
    }
	
	//图片删除
	public function del_pic() {
        $data = I('post.');
        $re = D('Common')->delFile('About', $data);
        echojson($re);
    }
	
}?>
