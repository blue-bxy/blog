<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;

    //只读字段
    protected $readonly=['username','email'];

    //关联评论
    public function comments(){
        return $this->hasMany('Comment','member_id','id');
    }

    //添加会员
    public function add($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('AddMember')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '会员添加失败';
        }
    }

    //编辑会员
    public function edit($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('EditMember')->check($data)){
            return $validate->getError();
        }
        $memberInfo=$this->find($data['id']);
        if($memberInfo['password']!=$data['password']){
            return '原密码不正确';
        }
        $memberInfo->password=$data['conpass'];
        $memberInfo->nickname=$data['nickname'];
        $result=$memberInfo->save();
        if($result){
            return 1;
        }else{
            return '会员编辑成功';
        }
    }

    //会员注册
    public function register($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '注册失败!';
        }
    }

    //会员登录
    public function login($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        unset($data['verify']);
        $result=$this->where($data)->find();
        if($result){
            $sessionData=[
                'id'=>$result['id'],
                'nickname'=>$result['nickname'],
            ];
            session('user',$sessionData);
            return 1;
        }else{
            return '用户名或者密码错误!';
        }
    }
}
