<?php

use think\Lang;
use think\Db;

function check_env()
{
    $items = array(
        'os'      => array('操作系统', '不限制', PHP_OS, 'success'),
        'php'     => array('PHP版本', '5.4', PHP_VERSION, 'success'),
        'upload'  => array('附件上传', '不限制', '未知', 'success'),
        'gd'      => array('GD库', '2.0', '未知', 'success'),
        'disk'    => array('磁盘空间', '5M', '未知', 'success'),
    );

    //PHP环境检测
    if($items['php'][2] < $items['php'][1]){
        $items['php'][3] = 'error';
        session('error', true);
    }

    //附件上传检测
    if(@ini_get('file_uploads'))
        $items['upload'][2] = ini_get('upload_max_filesize');

    //GD库检测
    $tmp = function_exists('gd_info') ? gd_info() : array();
    if(empty($tmp['GD Version'])){
        $items['gd'][2] = '未安装';
        $items['gd'][3] = 'error';
        session('error', true);
    } else {
        $items['gd'][2] = $tmp['GD Version'];
    }
    unset($tmp);

    //磁盘空间检测
    if(function_exists('disk_free_space')) {
        $items['disk'][2] = floor(disk_free_space(INSTALL_APP_PATH) / (1024*1024)).'M';
    }

    return $items;
}



function check_dirfile()
{
    $items = array(
        array('dir',  '可写', 'success', 'uploads'),
        array('file', '可写', 'success', 'application/config.php'),
        array('file', '可写', 'success', 'application/database.php'),
        array('dir',  '可写', 'success', 'runtime'),
        array('dir',  '可写', 'success', 'data'),

    );

    foreach ($items as &$val) {
        if('dir' == $val[0]){
            if(!is_writable(INSTALL_APP_PATH . $val[3])) {
                if(is_dir($val[3])) {
                    $val[1] = '可读';
                    $val[2] = 'error';
                    session('error', true);
                } else {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    session('error', true);
                }
            }
        } else {
            if(file_exists(INSTALL_APP_PATH . $val[3])) {
                if(!is_writable(INSTALL_APP_PATH . $val[3])) {
                    $val[1] = '不可写';
                    $val[2] = 'error';
                    session('error', true);
                }
            } else {
                if(!is_writable(dirname(INSTALL_APP_PATH . $val[3]))) {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    session('error', true);
                }
            }
        }
    }

    return $items;
}


function check_fun()
{
    $items = array(
        array('iconv',     '支持', 'success'),
        array('file_get_contents', '支持', 'success'),
        array('mb_strlen',         '支持', 'success'),
    );

    foreach ($items as &$val) {
        if(!function_exists($val[0])){
            $val[1] = '不支持';
            $val[2] = 'error';
            $val[3] = '开启';
            session('error', true);
        }
    }

    return $items;
}


function write_config($config)
{
    if(is_array($config)){
       
        $get_database = file_get_contents(ROOT_PATH . 'data/install/database.tpl');
        //替换配置项
        foreach ($config as $name => $value) {
            
            $get_database = str_replace("[{$name}]", $value, $get_database);
        }
        show_msg("开始写入配置文件...",'green');
        //写入应用配置文件
        if(!file_put_contents(APP_PATH . 'database.php', $get_database)){
            show_msg("配置文件写入失败...",'red');
        }else{
            show_msg("配置文件写入成功...",'green');
        }
        //成功跳转
        if(session('error')){
         
        } else {
            to_step4();
        }
    }
}


function show_msg($msg, $class = '')
{
    echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
    flush();
    ob_flush();
}


function to_step4()
{
    $url = url('index/step4');
    echo "<script type=\"text/javascript\">window.location.href='".$url."';</script>";
    ob_flush();
    flush();
    
}



function create_tables($db,$prefix)
{
    //读取SQL文件
    $sql = file_get_contents(ROOT_PATH . '/data/install/install.sql');
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    //替换表前缀
    $orginal = config('original_table_prefix');
    $sql = str_replace(" `{$orginal}", " `{$prefix}", $sql);
    //开始安装
    show_msg('开始安装数据表...','green');
    foreach ($sql as $value) {
        $value = trim($value);
        if(empty($value)) continue;
        if(substr($value, 0, 12) == 'CREATE TABLE') {
            $name = preg_replace("/^CREATE TABLE `(\w+)` .*/s", "\\1", $value);
            $msg = "创建数据表{$name}";
            if(false !== $db->execute($value)){
                show_msg($msg . '......[成功]','green');
            }else{
                
                show_msg($msg . '......[失败]', 'red');
                session('error', true);            }
        } else {
            $db->execute($value);
        }
    }
}


function register_administrator($db, $prefix)
{
    show_msg('开始注册创始人账号信息...','green');
    $admin = session('admin_info');
    $sql = "INSERT INTO `[PREFIX]admin` VALUES " .
           "('1','[NAME]', '[PASS]','[NICK]','[EMAIL]', '[TIME]', '[IP]','[encrypt]')";
    
	$encrypt=create_randomstr();
    $password = md5(md5($admin['password']).$encrypt);
   
    $sql = str_replace(
        array('[PREFIX]','[NAME]', '[PASS]', '[NICK]','[EMAIL]', '[TIME]', '[IP]','[encrypt]'),
        array($prefix,$admin['username'], $password,$admin['username'], $admin['email'],time(),$_SERVER["REMOTE_ADDR"],$encrypt),
        $sql);
    //执行sql
	
    $db->execute($sql);
    
    show_msg('创始人账号信息注册完毕...','green');
}


function get_write_color($str)
{
    if($str == '可写'){
        return '<span style="color:green">可写</span>';
    }else{
        return '<span style="color:red">不可写</span>';
    }
}


function get_fun_color($str)
{
    if($str == '支持'){
        return '<span style="color:green">支持</span>';
    }else{
        return '<span style="color:red">不支持</span>';
    }
}

function random($length, $chars = '0123456789') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function create_randomstr($lenth = 6) {
	return random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}



