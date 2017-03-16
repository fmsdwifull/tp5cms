<?php

/**
 * 安装程序配置文件
 */
define('INSTALL_APP_PATH', realpath('') . '/');
return [
    'original_table_prefix' => 'five_', //默认表前缀
    // 模板设置
    'view_replace_str'=>[
        '__PUBLIC__'=> __ROOT__.'/public', // 模板变量替换
    ],
];