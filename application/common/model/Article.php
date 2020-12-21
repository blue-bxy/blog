<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;

    //关联栏目表
    public function cate(){
        return $this->belongsTo('Cate','cate_id','id');
    }

    //关联评论
    public function comments(){
        return $this->hasMany('Comment','article_id','id');
    }

    //文章添加
    public function add($data){
        $validate=new \app\common\validate\Article();
        if(!$validate->scene('AddArticle')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '文章添加失败';
        }
    }

    //文章推荐
    public function top($data){
        $articleInfo=$this->find($data['id']);
        $articleInfo->is_top=$data['is_top'];
        $result=$articleInfo->save();
        if($result){
            return 1;
        }else{
            return '操作失败';
        }
    }

    //文章编辑
    public function edit($data){
        $validate=new \app\common\validate\Article();
        if(!$validate->scene('AddArticle')->check($data)){
            return $validate->getError();
        }
        $articleInfo=$this->find($data['id']);
        $articleInfo->is_top=$data['is_top'];
        $articleInfo->title=$data['title'];
        $articleInfo->tags=$data['tags'];
        $articleInfo->content=$data['content'];
        $articleInfo->cate_id=$data['cate_id'];
        $articleInfo->desc=$data['desc'];
        $articleInfo->author=$data['author'];
        $result=$articleInfo->save();
        if($result){
            return 1;
        }else{
            return '文章编辑失败';
        }
    }
}
