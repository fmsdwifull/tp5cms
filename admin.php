<?php

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
define('BIND_MODULE','admin');
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';

// 检测程序安装
if(!is_file(ROOT_PATH . 'data/install.lock')){
	header('Location: ./install.php');
}