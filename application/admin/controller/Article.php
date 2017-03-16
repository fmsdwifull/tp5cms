<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;
use think\Config;
use think\Db;
class Article extends Common
{
    public function index()
    {   
        $q = input('q');
        $catid = input('catid');
        if (!empty($q)) {
            $map['title'] = ['like', '%' . strip_tags(trim($q)) . '%'];
        }
        if ($catid) {
            $map['catid'] = intval($catid);
        }
        if (empty($map)) {
            $map = 1;
        }
        $article_list = db('article')->where($map)->order('listorder desc,id desc')->paginate(10, false, ['query' => ['q' => $q]]);
        $page = $article_list->render();
        $cate_list = db('category')->order('listorder desc')->select();
        $cate_list = cTree($cate_list);
        $this->assign('q', $q);
        $this->assign('catid', $catid);
        $this->assign('article_list', $article_list);
        $this->assign('cate_list', $cate_list);
        $this->assign('page', $page);
        return $this->fetch();
    }
    public function add()
    {
        $catid = input('catid');
        $list = db('category')->where('ispart', 0)->order('listorder desc')->select();
        $this->assign('list', $list);
        $this->assign('catid', intval($catid));
        return $this->fetch();
    }
    public function insert()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (empty($data['catid'])) {
                $this->error('请选择栏目');
            }
            $rule = ['title' => 'require|max:100'];
            $msg = ['title.require' => '标题必须填写', 'title.max' => '标题最多不能超过100个字符'];
            $validate = new Validate($rule, $msg);
            if (!$validate->check(['title' => $data['title']])) {
                $this->error($validate->getError());
            }
            $title = safe_replace($data['title']);
            if (isset($data['content'])) {
                $data['content'] = auto_save_image($data['content']);
            } else {
                $data['content'] = '';
            }
			
            //自动提取摘要
            if ($data['description'] == '' && isset($data['content'])) {
                $description_length = 200;
                $data['description'] = str_cut(str_replace(["'", "\r\n", "\t", '&ldquo;', '&rdquo;', '&nbsp;'], '', strip_tags(stripslashes($data['content']))), $description_length);
                $data['description'] = addslashes($data['description']);
            }
            //自动提取缩略图
            if ($data['thumb'] == '' && isset($data['content'])) {
                $auto_thumb_no = 0;
                if (preg_match_all("/(src)=([\"|']?)([^ \"'>]+\\.(gif|jpg|jpeg|bmp|png))\\2/i", stripslashes($data['content']), $matches)) {
                    $data['thumb'] = $matches[3][$auto_thumb_no];
                }
            }
            $data['description'] = str_replace(['/', '\\', '#', '.', "'"], ' ', $data['description']);
            $data['keywords'] = str_replace(['/', '\\', '#', '.', "'"], ' ', $data['keywords']);
            foreach ($data['catid'] as $v) {
                $id = db('article')->insertGetId(['content' => $data['content'], 'inputtime' => request()->time(), 'updatetime' => request()->time(), 'title' => $data['title'], 'keywords' => $data['keywords'], 'description' => $data['description'], 'thumb' => $data['thumb'], 'catid' => $v]);
                $url = __ROOT__ . '/index.php/Article/show/catid/' . $v . '/id/' . $id;
                db('article')->where('id', $id)->update(['url' => $url]);
                if (isset($data['keywords'])) {
                    $this->go_to_tag($id, $data['keywords']);
                }
            }
            if (isset($data['dosubmit'])) {
                $this->success('添加成功', 'Article/index');
            } else {
                $this->success('添加成功');
            }
        }
    }
    public function edit()
    {
        $id = intval($_GET['id']);
        if (!$id) {
            $this->error('非法参数');
        }
        $result = db('article')->where('id', $id)->find();
        if (!$result) {
            $this->error('文章不存在');
        }
        $result['content'] = htmlspecialchars_decode($result['content']);
        $list = db('category')->where('ispart', 0)->order('listorder desc')->select();
        $this->assign('list', $list);
        $this->assign('result', $result);
        return $this->fetch();
    }
    public function update()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (empty($data['catid'])) {
                $this->error('请选择栏目');
            }
            $data['title'] = safe_replace($data['title']);
            if (isset($data['content'])) {
                $data['content'] = auto_save_image($data['content']);
            } else {
                $data['content'] = '';
            }
            //自动提取摘要
            if ($data['description'] == '' && isset($data['content'])) {
                $description_length = 200;
                $data['description'] = str_cut(str_replace(["'", "\r\n", "\t", '&ldquo;', '&rdquo;', '&nbsp;'], '', strip_tags(stripslashes($data['content']))), $description_length);
                $data['description'] = addslashes($data['description']);
            }
            //自动提取缩略图
            if ($data['thumb'] == '' && isset($data['content'])) {
                $auto_thumb_no = 0;
                if (preg_match_all("/(src)=([\"|']?)([^ \"'>]+\\.(gif|jpg|jpeg|bmp|png))\\2/i", stripslashes($data['content']), $matches)) {
                    $data['thumb'] = $matches[3][$auto_thumb_no];
                }
            }
            $data['description'] = str_replace(['/', '\\', '#', '.', "'"], ' ', $data['description']);
            $data['keywords'] = str_replace(['/', '\\', '#', '.', "'"], ' ', $data['keywords']);
            $data['updatetime'] = request()->time();
            $id = intval($data['id']);
            db('article')->where('id', $id)->update($data);
            if (isset($data['keywords'])) {
                $this->go_to_tag($id, $data['keywords']);
            }
            $this->success('修改成功', 'Article/index');
        }
    }
    public function delete()
    {
        $data = input('param.');
        if (!isset($data['id']) || empty($data['id'])) {
            $this->error('参数错误');
        }
        if (is_array($data['id'])) {
            foreach ($data['id'] as $v) {
                $v = intval($v);
                db('article')->where('id', $v)->delete();
            }
            $this->success('删除成功');
        } else {
            $id = intval($data['id']);
            if (!$id) {
                $this->error('非法参数');
            }
            db('article')->where('id', $id)->delete();
            $this->success('删除成功');
        }
        $this->success('删除成功');
    }
    public function deleteAll()
    {
        //db('article')->where(1)->delete();
        $config = Config::get('database');
        $prefix = $config['prefix'];
        db('article')->execute('truncate ' . $prefix . 'article');
        $this->success('删除成功');
    }
    public function listorder()
    {
        $data = input('post.');
        foreach ($data['listorder'] as $k => $v) {
            $k = intval($k);
            db('article')->where('id', $k)->update(['listorder' => $v]);
        }
        $this->success('更新成功');
    }
    public function status()
    {
        $data = input('post.');
        if (!isset($data['id']) || empty($data['id'])) {
            $this->error('参数错误');
        }
        foreach ($data['id'] as $v) {
            $v = intval($v);
            $status = db('article')->where('id', $v)->value('status');
            $status = $status ? 0 : 1;
            db('article')->where('id', $v)->update(['status' => $status]);
        }
        $this->success('更新成功');
    }
    private function go_to_tag($contentid, $data)
    {
        $data = preg_split('/[ ,]+/', $data);
        $tag_db = db('tag');
        $tag_data_db = db('tag_data');
        if (is_array($data) && !empty($data)) {
            foreach ($data as $v) {
                $v = safe_replace(addslashes($v));
                $v = str_replace(['//', '#', '.'], ' ', $v);
                $r = $tag_db->where('tag', $v)->find();
                if (!$r) {
                    $tagid = $tag_db->insertGetId(['tag' => $v, 'count' => 1]);
                } else {
                    $tag_db->where('tagid', $r['tagid'])->setInc('count', 1);
                    $tagid = $r['tagid'];
                }
                if (!$tag_data_db->where(['tagid' => $tagid, 'contentid' => $contentid])->find()) {
                    $tag_data_db->insert(['tagid' => $tagid, 'contentid' => $contentid]);
                }
            }
        }
    }
	
	public function get_keywords()
    {
        $number = input('number');
        $data = input('data');
        return $this->get_keywords_data($data, $number);
    }
	
	private function get_keywords_data($data, $number = 3)
    {
        $data = trim(strip_tags($data));
        if (empty($data)) {
            return '';
        }
        $http = new \org\Http();
        $data = iconv('utf-8', 'gbk', $data);
        if (isset($_SERVER['HTTP_HOST'])) {
            $siteurl = $_SERVER['HTTP_HOST'];
        } else {
            $siteurl = '';
        }
        $http->post('http://tool.phpcms.cn/api/get_keywords.php', array('siteurl' => $siteurl, 'charset' => 'utf-8', 'data' => $data, 'number' => $number));
        if ($http->is_ok()) {
            return iconv('gbk', 'utf-8', $http->get_data());
        }
        return '';
    }
}