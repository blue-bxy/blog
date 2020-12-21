<?php


namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule=[
      'catename|栏目名称'=>'require|unique:cate',
      'sort|排序'=>'require|number'
    ];

    //添加栏目场景
    public function sceneAddCate(){
        $this->only(['catename','sort']);
    }

    //添加栏目场景
    public function sceneSort(){
        $this->only(['sort']);
    }

    //编辑栏目场景
    public function sceneEditCate(){
        $this->only(['catename']);
    }
}