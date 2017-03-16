<?php
namespace app\admin\controller;
use think\Controller;
class System extends Common
{   
    
    
    public function set()
    {
	    if (request()->isPost()) {
             $data = input('post.');
			 db('system')->where('id',1)->update($data);
			 $this->success('设置成功');	
			}
		$detail = db('system')->where('id',1)->find();
        $this->assign('detail', $detail);	
	    return $this->fetch();
	}
		
   	
}
