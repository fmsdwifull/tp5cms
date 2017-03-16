<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Common
{   
    
    
    public function index()
    {   
	    $server_info  = [
						'运行环境'     => PHP_OS.' '.$_SERVER["SERVER_SOFTWARE"],
						'PHP运行方式'  => php_sapi_name(),
						'MYSQL版本'    => mysql_get_client_info(),
						'上传附件限制' => ini_get('upload_max_filesize'),
						'执行时间限制' => ini_get('max_execution_time').'秒',
						'磁盘剩余空间 '=> round((@disk_free_space(".")/(1024*1024)),2).'M',
					    ];
	    $this->assign('server_info',$server_info);
	    return $this->fetch();
	}
		
   	
}
