<?php

namespace app\index\controller;

use think\Controller;

class Article extends Base
{
    //文章详情页
    public function info(){
        $articleInfo=model('Article')->with('comments,comments.member')->find(input('id'));
        $articleInfo->setInc('click');
        $commentcount=model('Comment')->where('article_id',input('id'))->count();
        $ViewData=[
            'articleInfo'=>$articleInfo,
            'commentcount'=>$commentcount
        ];
        $this->assign($ViewData);
        return view();
    }

    //文章评论
    public function comment(){
        $data=[
            'article_id'=>input('post.article_id'),
            'member_id'=>input('post.member_id'),
            'content'=>input('post.content')
        ];
        $result=model('Comment')->comm($data);
        if($result==1){
            $this->success('评论成功！');
        }else{
            $this->error($result);
        }
    }
}
