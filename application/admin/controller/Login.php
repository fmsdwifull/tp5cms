<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;
class Login extends Controller
{
    public function index()
    { 
	    
        return $this->fetch('login');
    }
    public function doLogin()
    {
        if (request()->isPost()) {
            $username = input('username');
            $passowrd = input('password');
            $code = input('code');
            $rule = ['username' => 'require|max:20', 'password' => 'require|max:20', 'code' => 'require'];
            $msg = ['username.require' => '用户名必须填写', 'username.max' => '用户名最多不能超过20个字符', 'password.require' => '密码必须填写', 'password.between' => '密码最多不能超过20个字符', 'code.require' => '验证码必须填写'];
            $data = ['username' => $username, 'password' => $passowrd, 'code' => $code];
            $validate = new Validate($rule, $msg);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
			
			$captcha = new \org\Captcha();
            if (!$captcha->check($code)) {
                $this->error('验证码错误');
            }
            $r = db('admin')->where('username', $username)->find();
            if (!$r) {
                $this->error('用户名不存在');
            }
            if ($r['password'] != md5(md5($passowrd).$r['encrypt'])) {
                $this->error('密码错误');
            }
            session('cms_admin_id', $r['id']);
            session('cms_admin_username', $username);
			session('cms_login_time', request()->time());
			unset($r);
            db('admin')->where('username', $username)->update(['lastip' => request()->ip(), 'lasttime' => request()->time()]);
            $this->success('登录成功', 'Index/index');
        }
    }
	public function captcha()
    {
        $captcha = new \org\Captcha(config('captcha'));
        $captcha->entry();
    }
}