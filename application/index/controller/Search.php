<?php
namespace app\index\controller;
use think\Controller;
class Search extends Common
{
    public function index()
    {
		
		$q = input('q');
        if (!$q) {
            $this->error('参数错误');
        }
        $q = FilterSearch(urldecode($q));
        
        
        $db = db('article');
        $article_list = $db->where('title','like','%'.$q.'%')->where('status',0)->order('listorder desc,id desc')->paginate(10, false, ['query' => ['q' => $q]]);
		$article_arr=[];
		foreach($article_list as $k=>$v){
			$article_arr[$k]['title']=str_replace($q, '<font color="#f00">' . $q . '</font>', $v['title']);
			$article_arr[$k]['url']=$v['url'];
			$article_arr[$k]['thumb']=$v['thumb'];
			$article_arr[$k]['description']=$v['description'];
			$article_arr[$k]['inputtime']=$v['inputtime'];
			}
		$page = $article_list->render();
		$this->assign('article_list', $article_arr);
        $this->assign('page', $page);
        /*文章列表end*/
		
		/*seo start*/
		$seo=seo($q.'搜索'.'-'.$this->seo['title'],$this->seo['keywords'],$this->seo['description']);
		$this->assign('seo',$seo);
		/*seo end*/
		
		
        return $this->fetch();
		
		}
}
