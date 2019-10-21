<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class News extends Controller
{
    public function index(){
        $res =  Db::table('category')->column('id,name');
        $this->assign('cate_list',$res);
        return $this->fetch();
    }
    public function add(){
        $data['title'] = input('post.title');
        $data['keyWord'] = input('post.keyWord');
        $data['description'] = input('post.description');
        $data['category'] = input('post.category');
        $data['article'] = input('post.article');
        $res = Db::table('news')->insert($data);
        if($res){
            $this->success('提交成功',url('News/lists'));
        }else{
            $this->error('提交失败',url('News/index'));
        }
    }
    public function lists(){
        $res =  Db::table('category')->column('id,name');
        $this->assign('cate_list',$res);
        $res =  Db::table('news')->select();
        $this->assign('lists',$res);
        return $this->fetch();
    }

    public function delete(){
        $id = input('post.id');
        $res = Db::table('news')->delete($id);
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
        $res =  Db::table('category')->column('id,name');
        $this->assign('cate_list',$res);
        $res =  Db::table('news')->find($id);
        $this->assign('res',$res);
        return $this->fetch();
    }

    public function doEdit(){
        $id = input('post.id');
        $data['title'] = input('post.title');
        $data['keyWord'] = input('post.keyWord');
        $data['description'] = input('post.description');
        $data['category'] = input('post.category');
        $data['article'] = input('post.article');
        $res =  Db::table('news')->where('id',$id)->update($data);
        if($res!== false){
            $this->success('修改成功',url('News/lists'));
        }else{
            $this->error('修改失败',url('News/lists'));
        }
    }

}