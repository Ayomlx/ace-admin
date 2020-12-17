<?php

namespace Adminsys\Model;
use Think\Model;
class CommonModel extends Model {

    /**
     * 【参数说明】
     * params string $table 数据表名
     * params string/array $where 条件
     * params string $limit 输出数量(起始n,结束n)
     * params string $field 字段
     * params string $order 排序
     **/

    //获取列表集合
    public function getList($table, $where, $order='sort desc', $limit, $field) {
        $M = M($table);
        if($field){
            $list = $M->field($field)->where($where)->order($order)->limit($limit)->select();
        }else{
             $list = $M->where($where)->order($order)->limit($limit)->select();
        }
        return $list;
    }

    //获取数量
    public function getCount($table, $where, $field='id') {
        $M = M($table);
        return $M->field($field)->where($where)->count();
    }

    //获取单条记录
    public function getFind($table, $where, $field, $order){
        $M = M($table);
        return $M->field($field)->where($where)->order($order)->find();
    }

    //获取字段值
    public function getCol($table, $where, $field, $bool=false) {
        $M = M($table);
        return $M->where($where)->getField($field, $bool);
    }

    //添加
    public function insert($table, $data, $tp=0) {
        $M = M($table);
        if($tp==0){
            $re = $M->add($data);
        }else{
            $re = $M->addAll($data);
        }
        return $re;
    }

    //更新
    public function update($table, $data, $where) {
        $M = M($table);
        if($where){
            return $M->where($where)->save($data);
        }else{
            return $M->save($data);
        }
    }

    //删除
    public function del($table, $where) {
        $M = M($table);
        if($where){
            return $M->where($where)->delete();
        }
        
    }

    //排序
    public function sort($table, $data, $where_field='cid', $field='sort') {
        if ($data) {
            $M = M($table);
            $where=array($where_field=>$data['odAid']);
            if($data['odType'] == 'rising'){
                if($M->where($where)->setInc($field)){
                    return array('status'=>1,'info'=>'排序写入数据库成功.');
                }
            }elseif($data['odType'] == 'drop'){
                if($M->where($where)->setDec($field)){
                    return array('status'=>1,'info'=>'排序写入数据库成功.');
                }
            }
        } else {
            return array('status'=>0,'info'=>'异常操作');
        }
    }

    //分类
    public function category($cid=0, $cat_where) {
        if (IS_POST) {
            $act = $_POST[act];
            $data = $_POST['data'];
            $data['name'] =addslashes($data['name']) ;
            $nameArr = explode(',', addslashes($data['name'])) ;
            $M = M("Category");
            if ($act == "add") { //添加分类
                foreach ($nameArr as $nk => $nv) {
                        if($nv !=''){
                          $newData = array(
                            'pid'=>$data['pid'],
                            'name'=>$nv,
                            'module_id'=>$data['module_id']
                            );
                        if ($M->where($newData)->count() == 0) {
                            $newData['ico']=$data['ico'];
                            ($M->add($newData)) ? $successName .=$nv.',': $errorName .= $nv.',';
                        } else {
                            $reName .= $nv.',';
                        }  
                    }
                }
                if($successName !=''){
                    $info = $successName.'已经成功添加到系统中<br/>';
                    if($errorName !='') {
                        $info .= $errorName.'添加失败<br/>';
                    }elseif($reName !=''){
                       $info .= $reName.'已存在并跳过<br/>' ;
                    }
                    return array('status' => 1, 'info' => $info, 'url' => U('Category/index', array('time' => time())));
                }else{
                    if($errorName !='') {
                        $info .= $errorName.'添加失败<br/>';
                    }elseif($reName !=''){
                       $info .= $reName.'已存在并跳过<br/>';
                    }
                    return array('status' => 0, 'info' => $info );
                }
                
            } else if ($act == "edit") { //修改分类
                if (empty($data['name'])) {
                    unset($data['name']);
                }
                if ($data['pid'] == $data['cid']) {
                    unset($data['pid']);
                }
                return ($M->save($data)) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功更新', 'url' => U('Category/index', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset($data['pid'], $data['name']);
                $list = $M->field('cid,pid')->select();
                $cidArr = $this->get_all_child($list, $data['cid']);
                $cidArr[] = $data['cid'];
                $del_where['cid'] = array('in',$cidArr);
                if($this->del('Category',$del_where)){
                    return array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功删除', 'url' => U('Category/index', array('time' => time())));
                }else{
                    return array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 删除失败');
                }
            }
        } else {
            $cat = new \Org\Util\Category('Category', array('cid', 'pid', 'name', 'fullname', 'commend', 'module_id'));
            $list = $cat->getList($cat_where,$cid,'sort desc');//获取分类结构
            $module_list = $this->getCol('Module', '', 'id,name', true);
            foreach ($list as $k => $v) {
                $list[$k]['module_name'] = $module_list[$v['module_id']];
            }
            return $list;
        }
    }

    /**
     * 递归无限级分类获取任意节点下所有子类
     * @param array $category 待排序的数组
     * @param int $pid 父级节点
     * @return array $arr 排序后的数组
     */
    public function get_all_child($category, $pid=0)
    {
        static $arr = array();
        foreach($category as $k=>$v){
            if($v['pid'] == $pid){
                $arr[] = $v['cid'];
                #注销当前节点数据，减少已无用的遍历
                unset($category[$k]);
                $this->get_all_child($category, $v['cid']);
            }
        }
        return $arr;
    }
    
    //获取单一pid下所有子类
    public function getChild($pid=0, $order='sort desc'){
        $M = M('Category');
        $where['pid'] = array('eq',$pid);
        $field = 'cid,pid,name,commend';
        $list = $this->getList('Category', $where, $order, '', $field);
        return $list;
    }

    //递归获取子类
    public function recurChild($cid, $item=1, $list){
        $list[$item] = $this->getList('Category', 'cid='.$cid);
        if($list[$item]) ++$item;
        #取pid
        $pid = $this->getCol('Category', 'cid='.$cid, 'pid');
        if($pid == 0){
            return $list;
        }
        #递归pid
        return $this->recurChild($pid,$item,$list);
    }

	/**
     * 中文分词  
         * @params string $title 需要分词的语句 
         * @params int $num  分词个数，默认不用填写
     **/
    public function get_tags($title, $num=null){        
        $pscws = new \Org\Util\Pscws('utf-8');
        $pscws->set_dict(SCWS_PATH . 'dict.utf8.xdb');
        $pscws->set_rule(SCWS_PATH . 'rules.utf8.ini');
        $pscws->set_ignore(true);
        $pscws->send_text($title);
        $words = $pscws->get_tops($num);
        $pscws->close();
        $tags = array();
        foreach ($words as $val) {
            $tags[] = $val['word'];
        }
        return implode(',', $tags);
    }

    //删除文件
    public function delFile($table, $data, $field=array('id','picture')) {
        $M = M($table);
        $id = $data['id'];
        $imgUrl = $data['imgurl'];
        $fullPath = C('UPLOADS_PICPATH').$imgUrl;
        
        $newData = array(
                    $field[0]=>$id,
                    $field[1]=>''
                );
        if($id){
            if($M->save($newData)){
                if(@unlink($fullPath)){
                    return array('status'=>1, 'info'=>'已从数据库删除成功!');
                }else{
                    return array('status'=>0, 'info'=>'删除失败，刷新页面重试!');
                }
            }
        }else{
            if(@unlink($fullPath)){
                return array('status'=>1, 'info'=>'已从磁盘删除成功!');
            }else{
                return array('status'=>0,'info'=>'磁盘文件删除失败，请检查文件是否存在或磁盘权限!'.$fullPath);
            }
            
        }
    }

	
	

}

?>
