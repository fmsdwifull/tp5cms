<?php
namespace app\index\controller;

use think\Controller;
class Article extends Common
{
    public function show()
    {
        $catid = input('catid');
        $id = input('id');
        if (!$catid || !$id) {
            $this->error('参数错误');
        }
        $cate_db = db('category');
        $article_db = db('article');
        /*栏目详情start*/
        $cate_info = $cate_db->where('catid', $catid)->find();
        if (empty($cate_info)) {
            $this->error('栏目不存在');
        }
        $this->assign('category', new_html_special_chars($cate_info));
        /*栏目详情end*/
        /*文章详情start*/
        $article_info = $article_db->where('catid', $catid)->where('id', $id)->where('status', 0)->find();
        if (empty($article_info)) {
            $this->error('文章不存在');
        }
		$keywords=$article_info['keywords'];
		$this->assign('keywords',stringToArray($keywords));
        $this->assign('article', new_html_entity_decode($article_info));
        /*文章详情end*/
        /*子栏目start*/
        $subcate = $cate_db->where('pid', $catid)->limit(10)->select();
        /*子栏目end*/
        /*同级栏目start*/
        $samecate = $cate_db->where('pid', get_catpid($catid))->limit(10)->select();
        /*同级栏目end*/
        if (empty($subcate)) {
            $subcate = $samecate;
        }
        $this->assign('subcate', $subcate);
        $this->assign('samecate', $samecate);
        /*点击数start*/
        $article_db->where('id', $id)->setInc('hits');
        /*点击数end*/
        /*上一篇start*/
        $previous_page = $article_db->where('catid', $catid)->where('status', 0)->where('id', 'lt', $id)->order('id desc')->limit('1')->find();
        if (empty($previous_page)) {
            $previous_page = ['title' => '第一篇', 'thumb' => __ROOT__ . '/public/images/nopic_small.gif', 'url' => 'javascript:alert(\'第一篇\');'];
        }
        $this->assign('previous_page', $previous_page);
        /*上一篇end*/
        /*下一篇start*/
        $next_page = $article_db->where('catid', $catid)->where('status', 0)->where('id', 'gt', $id)->order('id asc')->limit('1')->find();
        if (empty($next_page)) {
            $next_page = ['title' => '最后一篇', 'thumb' => __ROOT__ . '/public/images/nopic_small.gif', 'url' => 'javascript:alert(\'最后一篇\');'];
        }
        $this->assign('next_page', $next_page);
        /*下一篇end*/
        /*seo start*/
        $seo = seo($article_info['title'] . '-' . $this->seo['title'], $article_info['keywords'], $article_info['description']);
        $this->assign('seo', $seo);
        /*seo end*/
        /*模板start*/
        $template = str_replace('.html', '', $cate_info['show']);
        return $this->fetch($template);
        /*模板end*/
    }
}