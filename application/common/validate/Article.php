<?php


namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule=[
        'title|文章标题'=>'require|unique:article',
        'author|作者'=>'require',
        'tags|标签'=>'require',
        'cate_id|所属栏目'=>'require',
        'desc|文章概要'=>'require',
        'content|文章内容'=>'require'
    ];

    //添加文章场景
    public function sceneAddArticle(){
        $this->only(['title','tags','cate_id','desc','content','author']);
    }
}