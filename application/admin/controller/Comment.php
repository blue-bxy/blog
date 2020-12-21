<?php

namespace app\admin\controller;


class Comment extends Base
{
    //评论列表
    public function commentlist(){
        $comment=model('Comment')->with('article,member')->order('create_time','desc')->paginate('10');
        $ViewData=[
            'comments'=>$comment
        ];
        $this->assign($ViewData);
        return view();
    }

    //删除评论
    public function del(){
        $comment=model('comment')->find(input('post.id'));
        $result=$comment->delete();
        if($result){
            $this->success('评论删除成功！','admin/comment/commentlist');
        }else{
            $this->error('删除失败');
        }
    }
}
