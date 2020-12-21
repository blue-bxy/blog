<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//后台路由
Route::group('admin',function(){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('/register','admin/index/register','get|post');
    Route::rule('forgetpwd','admin/index/forgetpwd','get|post');
    Route::rule('resetpwd','admin/index/resetpwd','get|post');
    Route::rule('index','admin/home/index','get|post');
    Route::rule('loginout','admin/home/loginout','post');
    Route::rule('catelist','admin/cate/list','get|post');
    Route::rule('cateadd','admin/cate/addcate','get|post');
    Route::rule('catesort','admin/cate/sort','post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    Route::rule('catedel','admin/cate/del','get|post');
    Route::rule('articlelist','admin/article/list','get');
    Route::rule('articleadd','admin/article/add','get|post');
    Route::rule('articletop','admin/article/top','post');
    Route::rule('articleedit/[:id]','admin/article/edit','get|post');
    Route::rule('articledel','admin/article/del','get|post');
    Route::rule('memberlist','admin/member/memberlist','get|post');
    Route::rule('memberadd','admin/member/add','get|post');
    Route::rule('memberedit/[:id]','admin/member/edit','get|post');
    Route::rule('memberdel','admin/member/del','get|post');
    Route::rule('adminlist','admin/admin/adminlist','get|post');
    Route::rule('adminadd','admin/admin/add','get|post');
    Route::rule('adminstatus','admin/admin/status','post');
    Route::rule('adminedit/[:id]','admin/admin/edit','get|post');
    Route::rule('admindel','admin/admin/del','post');
    Route::rule('commentlist','admin/comment/commentlist','get');
    Route::rule('commentdel','admin/comment/del','post');
    Route::rule('set','admin/system/set','get|post');
});

//前台路由
    Route::rule('cate/:id','index/index/index','get');
    Route::rule('/','index/index/index','get');
    Route::rule('article-<id>','index/article/info','get');
    Route::rule('register','index/index/register','get|post');
    Route::rule('login','index/index/login','get|post');
    Route::rule('loginout','index/index/loginout','get|post');
    Route::rule('search','index/index/search','get');
    Route::rule('comment','index/article/comment','post');
