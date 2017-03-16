<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;
class Category extends Common
{
    public function index()
    {
        $list = $this->cateList();
        foreach ($list as $k => $v) {
            $list[$k]['article_number'] = db('article')->where('catid', $v['catid'])->count();
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function add()
    {
        $catid = input('catid');
        $list = $this->cateList();
        $this->assign('list', $list);
        $this->assign('catid', intval($catid));
        return $this->fetch();
    }
    public function addBatch()
    {
        $list = $this->cateList();
        $this->assign('list', $list);
        return $this->fetch();
    }
    private function cateList()
    {
        $list = db('category')->order('listorder desc')->select();
        $list = cTree($list);
        return $list;
    }
    public function insert()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (empty($data['catname'])) {
                $this->error('栏目名称必须填写');
            }
            if (!preg_match('/^(.+).html$/', $data['category']) || !preg_match('/^(.+).html$/', $data['list']) || !preg_match('/^(.+).html$/', $data['show'])) {
                $this->success('模板格式不正确');
            }
            if (isset($data['content'])) {
                $data['content'] = auto_save_image($data['content']);
            }
			
            $catid = db('category')->insertGetId($data);
            if ($catid > 0) {
                $url = __ROOT__ . '/index.php/Category/show/catid/' . $catid;
                db('category')->where('catid', $catid)->update(['url' => $url]);
                $this->success('添加成功', 'Category/index');
            } else {
                $this->error('添加失败');
            }
        }
    }
    public function insertBatch()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (empty($data['catname'])) {
                $this->error('栏目名称必须填写');
            }
            if (!preg_match('/^(.+).html$/', $data['category']) || !preg_match('/^(.+).html$/', $data['list']) || !preg_match('/^(.+).html$/', $data['show'])) {
                $this->success('模板格式不正确');
            }
            if (strpos($data['catname'], "\n") === false) {
                $data['catname'] = str_cut($data['catname'], 32);
                $catid = db('category')->insertGetId($data);
                $url = __ROOT__ . '/index.php/Category/show/catid/' . $catid;
                db('category')->where('catid', $catid)->update(['url' => $url]);
                $this->success('添加成功', 'Category/index');
            } else {
                $cat_arr = explode("\n", $data['catname']);
                foreach ($cat_arr as $key => $val) {
                    $val = trim($val);
                    if (!$val) {
                        continue;
                    }
                    $data['catname'] = str_cut($val, 32);
                    $catid = db('category')->insertGetId($data);
                    $url = __ROOT__ . '/index.php/Category/show/catid/' . $catid;
                    db('category')->where('catid', $catid)->update(['url' => $url]);
                }
                $this->success('添加成功', 'Category/index');
            }
        }
    }
    public function edit()
    {
        $catid = input('catid');
        if (!$catid) {
            $this->error('参数错误');
        }
        $list = $this->cateList();
        $detail = db('category')->where('catid', $catid)->find();
        $this->assign('list', $list);
        $this->assign('detail', $detail);
        return $this->fetch();
    }
    public function update()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (empty($data['catname'])) {
                $this->error('栏目名称必须填写');
            }
            $catid = intval($data['catid']);
            if (isset($data['content'])) {
                $data['content'] = auto_save_image($data['content']);
            }
            db('category')->where('catid', $catid)->update($data);
            $this->success('修改成功', 'Category/index');
        }
    }
    public function listorder()
    {
        if (request()->isPost()) {
            $data = input('post.');
            foreach ($data['listorder'] as $key => $val) {
                db('category')->where('catid', $key)->update(['listorder' => intval($val)]);
            }
            $this->success('排序成功');
        }
    }
    public function delete()
    {
        $catid = input('catid');
        if (!$catid) {
            $this->error('参数错误');
        }
        db('category')->where('catid', 'in', catid_str($catid))->delete();
        db('article')->where('catid', 'in', catid_str($catid))->delete();
        $this->success('删除成功');
    }
}