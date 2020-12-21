<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class System extends Model
{
    //软删除
    use SoftDelete;

    //系统设置
    public function edit($data){
        $validate=new \app\common\validate\System();
        if(!$validate->check($data)){
            return $validate->getError();
        }
        $system=$this->find($data['id']);
        $system->webname=$data['webname'];
        $system->copyright=$data['copyright'];
        $result=$system->save();
        if($result){
            return 1;
        }else{
            return '系统设置失败';
        }
    }
}
