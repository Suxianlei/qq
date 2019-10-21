<?php


namespace app\admin\model;


use think\Model;

class WebSet extends Model
{
    public function addWebSet($data){
        return $this->save($data,['id'=> 1]);
    }

}