<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class AnLi extends Controller
{
    public function index(){
        return $this->fetch();
    }
    public function add(){
        // 获取表单上传文件
        $file = request()->file('image');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( './static/uploads');
        if($info){
            $pic_url = $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
        $data['name'] = input('post.name');
        $data['pic_url'] = $pic_url;
        $data['article'] = input('post.article');
        $res = Db::table('an_li')->insert($data);
        if($res){
            $this->success('提交成功',url('AnLi/lists'));
        }else{
            $this->error('提交失败',url('AnLi/index'));
        }
    }
    public function lists(){
        $res =  Db::table('an_li')->select();
        $this->assign('lists',$res);
        return $this->fetch();
    }

    public function delete(){
        $id = input('post.id');
        $res =  Db::table('an_li')->find($id);
        unlink('./static/uploads/'.$res['pic_url']);
        $res = Db::table('an_li')->delete($id);
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
        $res =  Db::table('an_li')->find($id);
        $this->assign('res',$res);
        return $this->fetch();
    }

    public function doEdit(){
        $id = input('post.id');
        // 获取表单上传文件
        $file = request()->file('image');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( './static/uploads');
        if($info){
            $pic_url = $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
        $res =  Db::table('an_li')->find($id);
        unlink('./static/uploads/'.$res['pic_url']);
        $data['name'] = input('post.name');
        $data['pic_url'] = $pic_url;
        $data['article'] = input('post.article');
        $res =  Db::table('an_li')->where('id',$id)->update($data);
        if($res!== false){
            $this->success('修改成功',url('AnLi/lists'));
        }else{
            $this->error('修改失败',url('AnLi/lists'));
        }
    }

}