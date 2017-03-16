<?php

namespace app\Common\taglib;

use think\template\TagLib;

class Article extends Taglib
{
    // 标签定义
    protected $tags = [
       
        'category'      =>  ['attr' => 'pid,num,name', 'close' => 1], 
        'arclist'      =>  ['attr' => 'cateid,num,name', 'close' => 1], 
		'taglist'      =>  ['attr' => 'num,name', 'close' => 1], 
    ];

    
    public function tagCategory($tag, $content) {
        $pid        = isset($tag['pid'])?$tag['pid']:0;
		$num        = $tag['num'];
        $parseStr   = $parseStr   = '<?php ';
        $parseStr  .= '$__CATEGORY__ = db(\'category\')->alias(\'a\')->where(\'pid\','.$pid.')->where(\'ishidden\',0)->order("listorder desc")->limit('.$num.')->select();';
        $parseStr  .= '?>{volist name="__CATEGORY__" id="'. $tag['name'] .'"}';
        $parseStr  .= $content;
        $parseStr  .= '{/volist}';
        //解析模板
        $this->tpl->parse($parseStr);
        return $parseStr;
    }

  
    public function tagArclist($tag, $content) {
        $num        = $tag['num'];
		$where=isset($tag['catid'])?'catid in ('.catid_str($tag['catid']).')  and status=0':'status=0';
        $parseStr   = $parseStr   = '<?php ';
        $parseStr  .= '$__LIST__ = db(\'article\')->alias(\'a\')->where("'.$where.'")->order("id desc")->limit('.$num.')->select();';
        $parseStr  .= '?>{volist name="__LIST__" id="'. $tag['name'] .'"}';
        $parseStr  .= $content;
        $parseStr  .= '{/volist}';
        //解析模板
        $this->tpl->parse($parseStr);
        return $parseStr;
    }
	
	public function tagTaglist($tag, $content) {
        $num        = $tag['num'];
		$parseStr   = $parseStr   = '<?php ';
        $parseStr  .= '$__LIST__ = db(\'tag\')->alias(\'a\')->order("tagid desc")->limit('.$num.')->select();';
        $parseStr  .= '?>{volist name="__LIST__" id="'. $tag['name'] .'"}';
        $parseStr  .= $content;
        $parseStr  .= '{/volist}';
        //解析模板
        $this->tpl->parse($parseStr);
        return $parseStr;
    }
}