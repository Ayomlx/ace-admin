<?php

namespace Home\Model;
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

    /**
    * formatData格式化数据
    * type数据类型[0=技术/案例,1=产品详情]
    **/
    public function formatData($data, $type=0){
        if($data) {
            switch ($type) {
                case 0:
                    if ($data['avatar']) {
                       $avatar = explode('|', $data['avatar']);
                       $name = explode('|', $data['name']);
                       $duty = explode('|', $data['duty']);
                       for($i=0; $i<count($avatar); $i++) {
                           $list[$i] = array($avatar[$i], $name[$i], $duty[$i]);
                       }
                       return $list;
                    }
                    break;
                case 1:
                    if ($data['picture']) {
                       $picture = explode('|', $data['picture']);
                       $title = explode('|', $data['title']);
                       $summary = explode('|', $data['summary']);
                       for($i=0; $i<count($picture); $i++) {
                           $list[$i] = array($picture[$i], $title[$i], $summary[$i]);
                       }
                       return $list;
                    }
                    break;
                default:
                    break;
            }
            
        }
    }

	
	

}

?>
