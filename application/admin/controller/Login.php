<?php


namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;

class Login extends Controller
{
    public function verify()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }
    public function index(){
        return $this->fetch();
    }

}