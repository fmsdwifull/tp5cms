<?php
namespace app\admin\controller;

use think\Controller;
class Common extends Controller
{
    protected function _initialize()
    {
        
		if (!session('cms_admin_id')||!session('cms_admin_username')||request()->time() - session('cms_login_time') > 2 * 60 * 60) {
            session('cms_admin_username', null);
			session('cms_admin_id', null);
			session('cms_login_time', null);
            $this->redirect(url('Login/index'));
        }
    }
    public function logout()
    {
        session('cms_admin_username', null);
        session('cms_admin_id', null);
		session('cms_login_time', null);
        $this->success('退出成功', 'Login/index');
    }
    public function cache()
    {
		$path=RUNTIME_PATH;
        delDirAndFile($path);
        $this->success('清除缓存成功');
    }
}