<?php


namespace app\admin\controller;


use think\Controller;

class WebSet extends Controller
{
    public function index(){
        return $this->fetch();
    }
    public function setWeb(){
        $data['webName'] = input('post.webName');
        $data['keyWord'] = input('post.keyWord');
        $data['description'] = input('post.description');
        $data['phone'] = input('post.phone');
        $data['email'] = input('post.email');
        $data['beiAn'] = input('post.beiAn');
        $data['copyRight'] = input('post.copyRight');
        $webSet = new \app\admin\model\WebSet();
        $res = $webSet->addWebSet($data);
        if($res){
            $this->success('提交成功',url('Index/index'));
        }else{
            $this->error('提交失败',url('WebSet/index'));
        }
    }
}