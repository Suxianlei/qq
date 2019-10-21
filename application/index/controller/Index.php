<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function get_info(){
        //获取网站基本设置信息
        $web_set_res = Db::table('web_set')->find(1);
        $this->assign('web_set_res',$web_set_res);

        //获取广告链接
        $ad_res = Db::table('ad')->select();
        $this->assign('ad_res',$ad_res);
    }
    public function common(){
        $this->get_info();
        return $this->fetch();
    }
    public function index(){
        $this->get_info();
        //获取新闻
        $news_res = Db::table('news')->column('id,title,score');
        $this->assign('news_res',$news_res);

        //获取案例
        $an_li_res = Db::table('an_li')->column('id,name,pic_url');
        $this->assign('an_li_res',$an_li_res);
        return $this->fetch();
    }
    public function about(){
        $this->get_info();
        return $this->fetch();
    }

    public function honour(){
        $this->get_info();
        return $this->fetch();
    }
    public function goods(){
        $this->get_info();
        return $this->fetch();
    }
    public function news(){
        $this->get_info();
        $res_news_category = Db::table('category')->where('category_id',1)->column('id,name');
        $this->assign('res_news_category',$res_news_category);
        return $this->fetch();
    }

    public function news_nei(){
        $this->get_info();
        $id = input('id');
        $news_info = Db::table('news')->find($id);
        $this->assign('news_info',$news_info);
        Db::table('news')->where('id', $id)->setInc('score');
        return $this->fetch();
    }
    public function an_li(){
        $this->get_info();
        return $this->fetch();
    }
    public function an_li_nei(){
        $this->get_info();
        $id = input('id');
        $an_li_info = Db::table('an_li')->find($id);
        $this->assign('an_li_info',$an_li_info);
        return $this->fetch();
    }
    public function ren_cai(){
        $this->get_info();
        return $this->fetch();
    }


}
