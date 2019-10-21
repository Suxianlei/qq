<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class Ad extends Controller
{
    public function index(){
        return $this->fetch();
    }
    public function add(){
        $data['title'] = input('post.title');
        $data['ad_url'] = input('post.ad_url');
        $data['update_time'] = date("Y-m-d H:i:s",time());
        $res = Db::table('ad')->insert($data);
        if($res){
            $this->success('提交成功',url('Ad/lists'));
        }else{
            $this->error('提交失败',url('Ad/index'));
        }
    }
    public function lists(){
        $res =  Db::table('ad')->select();
        $this->assign('lists',$res);
        return $this->fetch();
    }

    public function delete(){
        $id = input('post.id');
        $res = Db::table('ad')->delete($id);
        if($res){
            $data['code'] = 1;
            $data['msg'] = '删除成功';
        }else{
            $data['code'] = 0;
            $data['msg'] = '删除失败';
        }
        return json($data);
    }

    public function edit(){
        $id = input('get.id');
        $res =  Db::table('ad')->find($id);
        $this->assign('res',$res);
        return $this->fetch();
    }

    public function doEdit(){
        $id = input('post.id');
        $data['title'] = input('post.title');
        $data['ad_url'] = input('post.ad_url');
        $data['update_time'] = date("Y-m-d H:i:s",time());
        $res =  Db::table('ad')->where('id',$id)->update($data);
        if($res!== false){
            $this->success('修改成功',url('Ad/lists'));
        }else{
            $this->error('修改失败',url('Ad/lists'));
        }
    }
}