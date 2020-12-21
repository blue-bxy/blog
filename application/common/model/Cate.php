<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    //软删除
    use SoftDelete;

    //关联文章模型
    public function article(){
        return $this->hasMany('Article','cate_id','id');
    }

    //栏目添加
    public function addcate($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('AddCate')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '栏目添加失败';
        }
    }

    //栏目排序
    public function sort($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('Sort')->check($data)){
            return $validate->getError();
        }
        $cateInfo=$this->find($data['id']);
        $cateInfo->sort=$data['sort'];
        $result=$cateInfo->save();
        if($result){
            return 1;
        }else{
            return '排序失败';
        }
    }

    //栏目编辑
    public function editcate($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('EditCate')->check($data)){
            return $validate->getError();
        }
        $cateInfo=$this->find($data['id']);
        $cateInfo->catename=$data['catename'];
        $result=$cateInfo->save();
        if($result){
            return 1;
        }else{
            return '栏目编辑失败';
        }
    }
}
