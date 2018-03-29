<?php
namespace app\admin\controller;
use app\admin\model\Admin;
use think\Controller;
use think\Session;

class Login extends Controller
{
    public function index()
    {
       // echo session('name');exit();
        if(request()->isPost()){
            $this->check(input('code'));
            $admin=new Admin();
            $num=$admin->login(input('post.'));
            if($num==1){
                $this->error('用户不存在！');
            }
            if($num==2){
                $this->success('登录成功！',url('index/index'));
            }
            if($num==3){
                $this->error('密码错误！');
            }
            return;
        }
        return view();
    }

    //验证码检测
    public function check($code='')
    {
        $captcha = new \think\captcha\Captcha();
        if(!$captcha->check($code)){
            $this->error('验证密错误！');
        }else{
            return true;
        }
    }
}
