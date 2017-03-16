<?php


namespace app\install\controller;

use think\Controller;
use think\Request;
use think\Db;


class Index extends Controller
{
    
    protected function _initialize()
    {
        // 检测程序安装
        if (is_file(ROOT_PATH . 'data/install.lock')) {
            echo '程序已经安装！';
            exit();
        }
    }

   
    public function index()
    {
        session('step',0);
        session('error',false);
        return $this->fetch();
    }

   
    public function step1()
    {
        if(session('step')!=0 && session('step')!=2){
            $this->redirect('index/index');
        }
        session('error',false);
        //环境检测
        $env = check_env();
        //函数检测
        $fun = check_fun();
        //文件目录检测
        $dirfile = check_dirfile();

        $this->assign('env',$env);
        $this->assign('fun',$fun);
        $this->assign('dirfile',$dirfile);
        

        session('step',1);
        return $this->fetch();
    }

    
    public function step2($db=null,$admin=null)
    {
        //判断请求类型
        if(request()->isPost()){
            //检测管理员信息
            if(!is_array($admin) || empty($admin[0]) || empty($admin[1]) || empty($admin[3])){
                return $this->error('请填写完整管理员信息');
            } else if($admin[1] != $admin[2]){
                return $this->error('确认密码和密码不一致');
            } elseif(!filter_var($admin[3], FILTER_VALIDATE_EMAIL)){
                return $this->error('请填写正确的管理员邮箱');
            } else {
                $info = array();
                list($info['username'], $info['password'], $info['repassword'], $info['email'])
                = $admin;
                //缓存管理员信息
                session('admin_info', $info);
            }

            //检测数据库配置
            if(!is_array($db) || empty($db[0]) ||  empty($db[1]) || empty($db[2]) || empty($db[3])){
                return $this->error('请填写完整的数据库配置');
            } else {
                $DB = array();
                list($DB['type'], $DB['hostname'], $DB['database'], $DB['username'], $DB['password'],
                     $DB['hostport'], $DB['prefix']) = $db;

                //缓存数据库配置
                session('db_config', $DB);

                //创建数据库
                $dbname = $DB['database'];
                unset($DB['database']);
                $db  = Db::connect($DB);
                $sql = "CREATE DATABASE IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET utf8";
                if(!$db->execute($sql)){
                    return $this->error($db->getError());
                    exit();
                }else{
                    return $this->success('OK',url('index/step3',['access'=>'success']));
                }
            }

            //跳转到数据库安装页面
            // $this->redirect('index/step3',['access'=>'success']);
        }else{
            if(session('error')){
                return $this->error('环境检测未通过，请调整环境后重试');
            }
            $step = session('step');
            if($step !=1 && $step != 2){
                return $this->redirect('index/step1');
            }
            session('step',2);
            return $this->fetch();
        }
    } 

   
    public function step3()
    {
        $access = input('access');
        if($access!='success'){
            return $this->redirect('index/step2');
        }
        if(session('step')!=2){
            return $this->redirect('index/step2');
        }
        session('step',3);
        echo $this->fetch();
        
        $dbconfig = session('db_config');
        $db = Db::connect($dbconfig); 
        $prefix = $dbconfig['prefix'];
        //创建数据表
        create_tables($db, $dbconfig['prefix']);
        //注册创始人信息
        register_administrator($db, $dbconfig['prefix']);
        //写入配置文件
        write_config($dbconfig);
        
    }

   
    public function step4()
    {
        if(session('step')!=3){
           return $this->redirect('index/step2');
        }
        //写入安装锁文件
        file_put_contents(INSTALL_APP_PATH.'data/install.lock', 'lock');
        session('step',null);
        session('error',null);
        $host = $_SERVER["HTTP_HOST"]; //主机
        $name = $_SERVER['SCRIPT_NAME'];//地址
        $admin_path = str_replace("install.php", "admin.php", $name);
        $index_path = str_replace("install.php", "index.php", $name);
        $admin_url = "http://".$host.$admin_path;
        $index_url = "http://".$host.$index_path;
        $this->assign('admin_url',$admin_url);
        $this->assign('index_url',$index_url);
        return $this->fetch();
    }


}
