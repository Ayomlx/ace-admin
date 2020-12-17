<?php
namespace Adminsys\Controller;
use Think\Controller;
// 本类设置项目一些常用信息
class ExtendController extends CommonController {
    /**
      +----------------------------------------------------------
     * 配置网站信息
      +----------------------------------------------------------
     */
    public function index() {
        $this->list = D('Common')->getList('Slide', 'cid=0','sort desc', '5');
        $this->display('slide');
    }

    //轮播图列表
    public function slide() {
        $this->list = D('Common')->getList('Slide', 'cid=0','sort desc', '5');
        $this->display();
    }

    //添加轮播图
    public function slide_add(){
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            $data['addtime'] = time();
            #标题和链接验证
            if(!$data['title']){
                echojson(array('status'=>0, 'info'=>'标题名称不能为空.'));
            }
            if(!$data['href']){
                echojson(array('status'=>0, 'info'=>'链接地址不能为空.'));
            }
            #添加记录
            if (D('Common')->insert('Slide', $data)) {
                echojson(array('status'=>1, 'info'=>'发布成功', 'url'=>U('Extend/slide')));
            } else {
                echojson(array('status'=>0, 'info'=>'发布失败，请刷新页面尝试操作'));
            }
        } else {
            $this->display();
        }
    }
    
    //编辑轮播图
    public function slide_edit(){
        $M = M("Slide");
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            #标题和链接验证
            if(!$data['title']){
                echojson(array('status'=>0, 'info'=>'标题名称不能为空.'));
            }
            if(!$data['href']){
                echojson(array('status'=>0, 'info'=>'链接地址不能为空.'));
            }
            #修改记录
            if (D('Common')->update('Slide', $data)) {
                echojson(array('status'=>1, 'info'=>'更新成功', 'url'=>U('Extend/slide')));
            } else {
                return array('status'=>0, 'info'=>'发布失败，请刷新页面尝试操作');
            }



        } else {
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if ($info['id'] == '') {
                $this->error("不存在该记录");
            }
            $this->assign("info", $info);
            $this->display('slide_add');
        }
    }

    //轮播图排序
    public function slide_sort() {
        if (IS_POST) {
            $data = I('post.');
            echojson(D('Common')->sort('Slide',$data,'id'));
        } else {
            echojson(array('status'=>0,'info'=>'操作异常.'));
        }
    }

    //添加分类图标
    public function category_add(){
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            $data['addtime'] = time();
            #标题和链接验证
            if(!$data['title']){
                echojson(array('status'=>0, 'info'=>'标题名称不能为空.'));
            }
            if(!$data['href']){
                echojson(array('status'=>0, 'info'=>'链接地址不能为空.'));
            }
            #添加记录
            if (D('Common')->insert('Slide', $data)) {
                echojson(array('status'=>1, 'info'=>'发布成功', 'url'=>U('Extend/category')));
            } else {
                echojson(array('status'=>0, 'info'=>'发布失败，请刷新页面尝试操作'));
            }
        } else {
            $this->display();
        }
    }
    
    //编辑分类图标
    public function category_edit(){
        $M = M("Slide");
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            #标题和链接验证
            if(!$data['title']){
                echojson(array('status'=>0, 'info'=>'标题名称不能为空.'));
            }
            if(!$data['href']){
                echojson(array('status'=>0, 'info'=>'链接地址不能为空.'));
            }
            #修改记录
            if (D('Common')->update('Slide', $data)) {
                echojson(array('status'=>1, 'info'=>'更新成功', 'url'=>U('Extend/category')));
            } else {
                return array('status'=>0, 'info'=>'发布失败，请刷新页面尝试操作');
            }



        } else {
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if ($info['id'] == '') {
                $this->error("不存在该记录");
            }
            $this->assign("info", $info);
            $this->display('slide_add');
        }
    }
    
    //分类图标列表
    public function category() {
        $this->list = D('Common')->getList('Slide', 'cid=1','sort desc', '12');
        $this->display();
    }


    //删除轮播图/分类图标
    public function del() {
        $id = I('id');
        if (D('Common')->del('Slide', 'id='.$id)) {
            echojson(array('status'=>'1','info'=>'成功删除'));
        } else {
            echojson(array('status'=>'0','info'=>'删除失败，可能是不存在该ID的记录'));
        }
    }

    //删除轮播图/分类图标图片
    public function del_pic() {
        $data = I('post.');
        $re = D('Common')->delFile('Slide', $data);
        echojson($re);
    }

    //技术团队
    public function tech() {
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            //获取头像
            $data['avatar'] = implode('|', I('post.pic'));
            //获取姓名
            $data['name'] = implode('|', I('post.name'));
            //获取职务
            $data['duty'] = implode('|', I('post.duty'));
            //判断新增/更新
            if($data['id']){
                $act = '更新';
                $suc = D('Common')->update('Team_case', $data);
            }else{
                unset($data['id']);
                $act = '发布';
                $suc = D('Common')->insert('Team_case', $data);
            }
            //返回结果
            if ($suc) {
                echojson(array('status'=>1, 'info'=>'团队信息'.$act.'成功.', 'url'=>U('Extend/tech')));
            } else {
                echojson(array('status'=>0, 'info'=>'团队信息'.$act.'失败,请刷新页面尝试操作.'));
            }

        } else {
            $info = D('Common')->getFind('Team_case', 'type=0');
            if ($info['avatar']) {
               $avatar = explode('|', $info['avatar']);
               $name = explode('|', $info['name']);
               $duty = explode('|', $info['duty']);
               for($i=0; $i<count($avatar); $i++) {
                   $list[$i] = array($avatar[$i], $name[$i], $duty[$i]);
               }
               $info['avatar'] = $list;
            }
            $this->info = $info;
            $this->display();
        }
    }

    //案例
    public function cases() {
        if (IS_POST) {
            $this->checkToken();
            $data = $_POST['info'];
            //获取头像
            $data['avatar'] = implode('|', I('post.pic'));
            //获取姓名
            $data['name'] = implode('|', I('post.name'));
            //获取职务
            $data['duty'] = implode('|', I('post.duty'));
            //判断新增/更新
            if($data['id']){
                $act = '更新';
                $suc = D('Common')->update('Team_case', $data);
            }else{
                unset($data['id']);
                $act = '发布';
                $suc = D('Common')->insert('Team_case', $data);
            }
            //返回结果
            if ($suc) {
                echojson(array('status'=>1, 'info'=>'案例'.$act.'成功.', 'url'=>U('Extend/cases')));
            } else {
                echojson(array('status'=>0, 'info'=>'案例'.$act.'失败,请刷新页面尝试操作.'));
            }

        } else {
            $info = D('Common')->getFind('Team_case', 'type=1');
            if ($info['avatar']) {
               $avatar = explode('|', $info['avatar']);
               $name = explode('|', $info['name']);
               $duty = explode('|', $info['duty']);
               for($i=0; $i<count($avatar); $i++) {
                   $list[$i] = array($avatar[$i], $name[$i], $duty[$i]);
               }
               $info['avatar'] = $list;
            }
            $this->info = $info;
            $this->display();
        }
    }

    //异步排序图片
    public function picOrder(){
        C('TOKEN_ON',false);
        if (IS_POST) {
            $data = array(
                'id' => I('post.id'),
                'avatar' => I('post.imgArr'),
                'name' => I('post.nameArr'),
                'duty' => I('post.dutyArr')
                );
            if(D('Common')->update('Team_case', $data)){
                echojson(array('status'=>1, 'info'=>'排序成功，已保存到数据库'));
            }else{
                echojson(array('status'=>0, 'info'=>'排序失败，请刷新页面尝试操作'));
            }
        }
    }

    //异步删除技术团队/案例图片
    public function del_pic_tech_case(){
        $imgUrl = I('post.imgurl');
        $imgName = I('post.imgname');
        $imgDuty = I('post.imgduty');
        $imgDelUrl = C('UPLOADS_PICPATH').I('post.imgurl'); 
        $id = I('post.id');
		if($id){
            $info = D('Common')->getFind('Team_case', 'id='.$id);
            $newPic = str_replace('||','|',trim(str_replace($imgUrl, '', $info['avatar']),'|'));
            $newName = str_replace('||','|',trim(str_replace($imgName, '', $info['name']),'|'));
            $newDuty = str_replace('||','|',trim(str_replace($imgDuty, '', $info['duty']),'|'));
            $data = array(
                'id' => $id,
                'avatar' => $newPic,
                'name' => $newName,
                'duty' => $newDuty
                );
            if(D('Common')->update('Team_case', $data)){
                $ecJson = array(
                    'status' => 1,
                    'info' => '删除成功!'
                    );
                @unlink($imgDelUrl);
                
                $picFix = explode(',',C('GOODS_PIC_PREFIX'));
                foreach ($picFix as $pfK => $pfV) {
                    @unlink( C('UPLOADS_PICPATH').picRep($imgUrl,$pfK));
                }
                
                echojson($ecJson);
            }else{
                $ecJson = array(
                    'status' => 0,
                    'info' => '删除失败，刷新页面重试!'
                    );
                echojson($ecJson);
            }
        }else{
            if(@unlink($imgDelUrl)){
                echojson(array(
                    'status' => 1,
                    'info' => '已从服务器删除成功!'
                ));
            }else{
                echojson(array(
                    'status' => 0,
                    'info' => '删除失败，请检查文件权限!'
                ));
            }
            
        }
    }

    //产品列表
    public function product() {
        $this->list = D('Common')->getList('Extend_product');
        $this->display();
    }

    //产品添加
    public function product_add() {
        if (IS_POST){
            $data = $_POST['info'];
            if(D('Common')->insert('Extend_product', $data)){
                echojson(array('status'=>1, 'info'=>'产品添加成功', 'url'=>U('Extend/product')));
            }else{
                echojson(array('status'=>0, 'info'=>'添加失败，请刷新页面尝试操作'));
            }
        } else {
            $this->display();
        }
    }

    //产品编辑
    public function product_edit() {
        if (IS_POST) {
            $data = $_POST['info'];
            if(D('Common')->update('Extend_product', $data)){
                echojson(array('status'=>1, 'info'=>'产品编辑成功', 'url'=>U('Extend/product')));
            }else{
                echojson(array('status'=>0, 'info'=>'编辑失败，请刷新页面尝试操作'));
            }
        } else {
            $id = I('id');
            $this->info = D('Common')->getFind('Extend_product', 'id='.$id);
            $this->display('product_add');
        }
    }

    //产品删除
    public function product_del() {
        $id = I('id');
        if($id){
            $where['id'] = array('in', $id);
        }
        if(D('Common')->del('Extend_product', $where)){
            echojson(array('status'=>1, 'info'=>'产品删除成功'));
        }else{
            echojson(array('status'=>0, 'info'=>'删除失败，请刷新页面尝试操作'));
        }
    }

    //产品排序
    public function product_sort() {
        if (IS_POST) {
            $data = I('post.');
            echojson(D('Common')->sort('Extend_product',$data,'id'));
        } else {
            echojson(array('status'=>0,'info'=>'操作异常.'));
        }
    }

    //产品“概述/功能/应用/案例”——添加
    public function product_detail_add() {
        if(IS_POST){
            $re = D('Extend')->product_detail();
            echojson($re);
        }else {
            $this->product_id = I('get.product_id');

            $this->display();
        }
    }

    //产品“概述/功能/应用/案例”——编辑
    public function product_detail_edit() {
        if(IS_POST){
            echojson(D('Extend')->product_detail());
        }else{
            $product_id = I('get.product_id');
            $tp = I('get.tp');
            $where['product_id'] = array('eq', $product_id);
            $where['type'] = array('eq', $tp);
            $info = D('Common')->getFind('Extend_product_detail', $where);
            if ($info['picture']) {
               $picture = explode('|', $info['picture']);
               $title = explode('|', $info['title']);
               $summary = explode('|', $info['summary']);
               for($i=0; $i<count($picture); $i++) {
                   $list[$i] = array($picture[$i], $title[$i], $summary[$i]);
               }
               $info['picture'] = $list;
            }
            $typeArr = array(0=>'概述',1=>'应用',2=>'可视化',3=>'案例');

            $this->product_id = $product_id;
            $this->tp = $tp;
            $this->tp_name = $typeArr[$tp];
            $this->info = $info;

            $this->display('product_detail_add');
        }
    }
	
	 //异步产品图片“概述/功能/应用/案例”排序
    public function picOrder_product(){
        C('TOKEN_ON',false);
        if (IS_POST) {
            $data = array(
                'id' => I('post.id'),
                'picture' => I('post.imgArr'),
                'title' => I('post.titArr'),
                'summary' => I('post.sumArr')
                );
            if(D('Common')->update('Extend_product_detail', $data)){
                echojson(array('status'=>1, 'info'=>'排序成功，已保存到数据库'));
            }else{
                echojson(array('status'=>0, 'info'=>'排序失败，请刷新页面尝试操作'));
            }
        }
    }
	
	//异步“概述/功能/应用/案例”删除
    public function del_pic_product(){
        $imgUrl = I('post.imgurl');
        $imgTitle = I('post.imgtitle');
        $imgSummary = I('post.imgsummary');
        $imgDelUrl = C('UPLOADS_PICPATH').I('post.imgurl'); 
        $id = I('post.id');
		if($id){
			$info = D('Common')->getFind('Extend_product_detail', 'id='.$id);
            $newPic = str_replace('||','|',trim(str_replace($imgUrl, '', $info['picture']),'|'));
            $newTitle = str_replace('||','|',trim(str_replace($imgTitle, '', $info['title']),'|'));
            $newSummary = str_replace('||','|',trim(str_replace($imgSummary, '', $info['summary']),'|'));
            $data = array(
                'id' => $id,
                'picture' => $newPic,
                'title' => $newTitle,
                'summary' => $newSummary
                );
            if(D('Common')->update('Extend_product_detail', $data)){
                $ecJson = array(
                    'status' => 1,
                    'info' => '删除成功!'
                    );
                @unlink($imgDelUrl);
                
                $picFix = explode(',',C('GOODS_PIC_PREFIX'));
                foreach ($picFix as $pfK => $pfV) {
                    @unlink( C('UPLOADS_PICPATH').picRep($imgUrl,$pfK));
                }
                
                echojson($ecJson);
            }else{
                $ecJson = array(
                    'status' => 0,
                    'info' => '删除失败，刷新页面重试!'
                    );
                echojson($ecJson);
            }
        }else{
            if(@unlink($imgDelUrl)){
                echojson(array(
                    'status' => 1,
                    'info' => '已从服务器删除成功!'
                ));
            }else{
                echojson(array(
                    'status' => 0,
                    'info' => '删除失败，请检查文件权限!'
                ));
            }
            
        }
    }
	
	/**
      +----------------------------------------------------------
     * 配置栏目简介信息
      +----------------------------------------------------------
     */
    public function setMenuConfig() {
        if (IS_POST) {
            $this->checkToken();
            $config = APP_PATH . "Common/Conf/setMenuConfig.php";

            $config = file_exists($config) ? include "$config" : array();
            $config = is_array($config) ? $config : array();
            $data = I('post.');
            if (set_config("setMenuConfig", $data, APP_PATH . "Common/Conf/")) {
                delDirAndFile(WEB_CACHE_PATH . "Cache/Admin/");
                echojson(array('status' => 1, 'info' => '设置成功','url'=>__ACTION__));
            } else {
                echojson(array('status' => 0, 'info' => '设置失败，请检查'));
            }
        } else {
            $mbcof = include APP_PATH . 'Common/Conf/setMenuConfig.php';
            $this->mbcof=$mbcof;
            $this->display(); 
        }
    }



}

?>