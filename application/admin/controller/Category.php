<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class Category extends Controller
{
    public function index(){
        $res =  Db::table('category')->column('id,name');
        $this->assign('cate_list',$res);
        return $this->fetch();
    }
    public function add(){
        $data['name'] = input('post.name');
        $data['keyWord'] = input('post.keyWord');
        $data['description'] = input('post.description');
        $data['category_id'] = input('post.category_id');
        $res = Db::table('category')->insert($data);
        if($res){
            $this->success('提交成功',url('Category/lists'));
        }else{
            $this->error('提交失败',url('Category/index'));
        }
    }
    public function lists(){
        $res =  Db::table('category')->column('id,name');
        $this->assign('cate_list',$res);
        $res =  Db::table('category')->select();
        $this->assign('lists',$res);
        return $this->fetch();
    }

    public function delete(){
        $id = input('post.id');
        $res = Db::table('category')->delete($id);
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
        $res =  Db::table('category')->where('id','neq',$id)->column('id,name');
        $this->assign('cate_list',$res);
        $res =  Db::table('category')->find($id);
        $this->assign('res',$res);
        return $this->fetch();
    }

    public function doEdit(){
        $id = input('post.id');
        $data['name'] = input('post.name');
        $data['keyWord'] = input('post.keyWord');
        $data['description'] = input('post.description');
        $data['category_id'] = input('post.category_id');
        $res =  Db::table('category')->where('id',$id)->update($data);
        if($res!== false){
            $this->success('修改成功',url('Category/lists'));
        }else{
            $this->error('修改失败',url('Category/lists'));
        }
    }

}