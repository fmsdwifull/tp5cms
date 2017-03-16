<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
    protected function _initialize()
    {
		$this->seo=db('system')->where('id',1)->find();
		}
}
