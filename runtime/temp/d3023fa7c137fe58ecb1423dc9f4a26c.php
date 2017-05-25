<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"/var/www/html/tp5cms/application/index/view/index/index.html";i:1495690588;s:62:"/var/www/html/tp5cms/application/index/view/public/header.html";i:1495690588;s:62:"/var/www/html/tp5cms/application/index/view/public/footer.html";i:1495690588;}*/ ?>
﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,minimal-ui,maximum-scale=1.0,user-scalable=no"/>
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $seo['title']; ?></title>
<meta name="keywords" content="<?php echo $seo['keywords']; ?>">
<meta name="description" content="<?php echo $seo['description']; ?>">
<link href="__PUBLIC__/2016/css/common.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/2016/css/layout.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="zheaderposition">
  <div class="zheadercont">
    <div class="web clearfix">
      <div class="wwheadrightbox">
        <div class="wheadrighttop clearfix">
          <a class="wwphnavicon" href="javascript:;"></a>
          <a class="wwsearchph" href="javascript:;"></a>
          
          <!--搜索start-->
          <div class="wwsearch hidden-sm">
            <div class="wwsearchcon">
            <form action="__ROOT__/index.php/Search/index.html" method="get">
              <input class="wwsearchtext" name="q" type="text" value="" />
              <input class="wwsearchbut" type="submit" value="" />
              </form>
            </div>
          </div>
          <!--搜索 end-->
         
        </div>
        <!-- 头部栏目 start-->
        <div class="wwnav clearfix">
          <ul class="clearfix">
            <li>
              <h3 class="yjchan">
                <a href="__ROOT__">首页</a>
              </h3>
            </li>
           
           <?php $__CATEGORY__ = db('category')->alias('a')->where('pid',0)->where('ishidden',0)->order("listorder desc")->limit(6)->select();if(is_array($__CATEGORY__) || $__CATEGORY__ instanceof \think\Collection): $i = 0; $__LIST__ = $__CATEGORY__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
              <h3 class="yjchan">
                <a href="<?php echo $vo['url']; ?>"><?php echo $vo['catname']; ?></a>
                <span></span>
              </h3>
              <div class="wwnavlist">
               
                
                <div class="wwnavdrop">
                  <h4><a href="javascript:;">栏目二</a></h4>
                  <div class="wwnavdroplist">
                    <ul>
                      
                      <li><h5><a href="javascript:;">栏目二二</a></h5></li>
                      <li><h5><a href="javascript:;">栏目二二</a></h5></li>
                      <li><h5><a href="javascript:;">栏目二二</a></h5></li>
                      <li><h5><a href="javascript:;">栏目二二</a></h5></li>
                     
                    </ul>
                  </div>
                 
                </div>
                
                
                <div class="wwnavdrop">
                  <h4><a href="javascript:;">栏目三</a></h4>
                  <div class="wwnavdroplist">
                    <ul>
                      
                      <li><h5><a href="javascript:;">栏目三三</a></h5></li>
                       <li><h5><a href="javascript:;">栏目三三</a></h5></li>
                      
                    </ul>
                  </div>
                 
                </div>
               
              </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
           
            
          </ul>
        </div>
        <!-- 头部栏目 end-->
      </div>
      <a class="wwlogo" href="__ROOT__">
        <img src="__PUBLIC__/2016/picture/logo.jpg" />
      </a>
     
    </div>
  </div>
</div>


    <!--轮播图start-->
    <div class="wwindexbanner swiper-container-horizontal">
        <ul class="swiper-wrapper clearfix">
            
            <li class="swiper-slide" mod-img="__PUBLIC__/2016/picture/banner1.jpg" pc-img="__PUBLIC__/2016/picture/banner1.jpg"><a href="javascript:;">
                <img src="__PUBLIC__/2016/picture/banner1.jpg" /></a></li>
            
            <li class="swiper-slide" mod-img="__PUBLIC__/2016/picture/banner2.jpg" pc-img="__PUBLIC__/2016/picture/banner2.jpg"><a href="javascript:;">
                <img src="__PUBLIC__/2016/picture/banner2.jpg" /></a></li>
            
            <li class="swiper-slide" mod-img="__PUBLIC__/2016/picture/banner3.jpg" pc-img="__PUBLIC__/2016/picture/banner3.jpg"><a href="javascript:;">
                <img src="__PUBLIC__/2016/picture/banner3.jpg" /></a></li>
            
            <li class="swiper-slide" mod-img="__PUBLIC__/2016/picture/banner4.jpg" pc-img="__PUBLIC__/2016/picture/banner4.jpg"><a href="javascript:;">
                <img src="__PUBLIC__/2016/picture/banner4.jpg" /></a></li>
            
            <li class="swiper-slide" mod-img="__PUBLIC__/2016/picture/banner5.jpg" pc-img="__PUBLIC__/2016/picture/banner5.jpg"><a href="javascript:;">
                <img src="__PUBLIC__/2016/picture/banner5.jpg" /></a></li>
            
        </ul>
        <div class="wwindexbannerbtn"></div>
    </div>
    <!--轮播图end-->


    <!--content-->
    <div class="wwmain">
        <div class="wwmaincon">
            <div class="wwindexnews indexpos">
                <div class="web">
                    <h3 class="wwindextit">新闻中心</h3>
                    <ul class="clearfix">
                        
                       <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(4)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="col-sm-6 col-lg-3">
                            <a href="<?php echo $vo['url']; ?>">
                                <span><img src="<?php echo $vo['thumb']; ?>" height="220" /></span>
                                <h4><?php echo $vo['title']; ?></h4>
                                <p><?php echo $vo['description']; ?></p>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        
                    </ul>
                    <p class="wwindexnewmore"><a href="javascript:;">了解更多</a></p>
                </div>
            </div>
            <div class="wwindexpro clearfix indexpos">
                <div class="wwinproleft">
                    <div class="wwprolifirst">
                        
                        <h3><a href="javascript:;">关于我们</a></h3>
                        <p>一女同事在办公室犯贱：“我太漂亮了，每天都被一群男人死缠着，我又很难拒绝别人，该怎么办呢？”我默默的把水杯的水泼在她的脸上。女同事恍然大悟的说：“我懂了，您是要我头脑清醒，心静如水！是吗？”我告诉她：“美不美一瓢水，卸了妆全是鬼！”</p>
                        <a class="wwprolifirstmore" href="javascript:;">了解更多</a>
                        
                    </div>
                </div>

                <div class="wwinproright">
                    <div class="wwinprodiv">
                        <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(1)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <a href="<?php echo $vo['url']; ?>">
                            <img src="<?php echo $vo['thumb']; ?>" width="960" height="280" /></a>
                        <div class="wwinprodivtext">
                            <h3><a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></h3>
                            <p><?php echo $vo['description']; ?></p>
                            <a class="wwprolifirstmore" href="<?php echo $vo['url']; ?>">了解更多</a>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="wwinprodiv wwinprodivlast swiper-container-horizontal">
                        <ul class="swiper-wrapper">
                            <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(4)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="swiper-slide">
                                <a href="<?php echo $vo['url']; ?>">
                                    <img src="<?php echo $vo['thumb']; ?>" /></a>
                                <div class="wwinprodivtext">
                                    <h3><a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></h3>
                                    <p><?php echo $vo['description']; ?></p>
                                    <a class="wwprolifirstmore" href="<?php echo $vo['url']; ?>">了解更多</a>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                           
                            
                        </ul>
                        <div class="wwinprodivleft"></div>
                        <div class="wwinprodivright"></div>
                    </div>
                </div>
            </div>



            <div class="wwserve indexpos">
                <h3 class="wwindextit">产品展示</h3>
                <p class="wwindextitcopy">致力成为国际领先的、以新材料为本的行业综合服务商</p>
                <div class="indexweb">
                    <ul class="clearfix">
                        
                        <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(6)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="col-md-4 col-sm-6">
                            <a href="<?php echo $vo['url']; ?>">
                                <span><img src="<?php echo $vo['thumb']; ?>" height="250" /></span>
                                <h3><?php echo $vo['title']; ?></h3>
                                <p><?php echo str_cut($vo['description'],80); ?></p>
                            </a>
                        </li>
                           <?php endforeach; endif; else: echo "" ;endif; ?>
                        
                    </ul>
                </div>

            </div>
            <div class="wwinnovate indexpos">
                <h3 class="wwindextit">形象展示</h3>
                <div class="indexweb clearfix">
                    <div class="wwinnoleft col-md-6">
                        <div class="wwinnoleftdiv swiper-container-horizontal">
                            <ul class="swiper-wrapper clearfix">

                                <!--轮播图 start-->
                                 <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(5)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li class="swiper-slide"><a href="<?php echo $vo['url']; ?>">
                                    <img src="<?php echo $vo['thumb']; ?>" width="630" height="456" /></a></li>
                                 <?php endforeach; endif; else: echo "" ;endif; ?>
                               
                                <!--轮播图 end-->
                            </ul>
                            <div class="wwinprodivleft"></div>
                            <div class="wwinprodivright"></div>
                        </div>
                    </div>
                    <div class="wwinnoright col-md-6">
                        <ul class="clearfix swiper-wrapper">
                             <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(4)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="col-md-6 swiper-slide">
                                <a href="<?php echo $vo['url']; ?>">
                                    <span><img src="<?php echo $vo['thumb']; ?>" height="220" /></span>
                                    <p><?php echo $vo['title']; ?><span></span></p>
                                </a>
                            </li>
                             <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            
                        </ul>
                        <div class="wwinprodivleft"></div>
                        <div class="wwinprodivright"></div>
                    </div>
                </div>
            </div>
            <div class="wwindexhd clearfix indexpos">
                <div class="wwindexhdleft swiper-container-horizontal">
                    <ul class="clearfix swiper-wrapper">
                         <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(4)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="swiper-slide"><a href="javascript:;">
                            <img src="<?php echo $vo['thumb']; ?>" height="437" /></a></li>
                          <?php endforeach; endif; else: echo "" ;endif; ?>
                        
                    </ul>
                    <div class="wwinprodivleft"></div>
                    <div class="wwinprodivright"></div>
                </div>
                <div class="wwindexhdright">
                    
                    <h3><a href="javascript:;">企业文化</a></h3>
                    <ul>
                        <?php $__LIST__ = db('article')->alias('a')->where("status=0")->order("id desc")->limit(6)->select();if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                       
                    </ul>
                    <p class="wwindexpage"><a class="wwpage" href="javascript:;"><span>了解更多</span></a></p>
                    <!--</div>-->
                </div>
            </div>

            <div class="wwindexhonor indexpos">
                <ul class="clearfix">
                    
                    <li class="col-md-3 col-xs-6">
                        <a href="javascript:;">
                            <h3>公司概况</h3>
                            <img src="__PUBLIC__/2016/picture/wwpic192.jpg" />
                            <p>公司成立于2015年12月</p>
                        </a>
                    </li>
                    
                    <li class="col-md-3 col-xs-6">
                        <a href="javascript:;">
                            <h3>荣誉资质</h3>
                            <img src="__PUBLIC__/2016/picture/wwpic193.jpg" />
                            <p>国家级高新技术企业</p>
                        </a>
                    </li>
                    
                    <li class="col-md-3 col-xs-6">
                        <a href="javascript:;">
                            <h3>企业文化</h3>
                            <img src="__PUBLIC__/2016/picture/wwpic194.jpg" />
                            <p>创新立足全球市场</p>
                        </a>
                    </li>
                    
                    <li class="col-md-3 col-xs-6">
                        <a href="javascript:;">
                            <h3>联系我们</h3>
                            <img src="__PUBLIC__/2016/picture/wwpic195.jpg" />
                            <p>企业热线：10086</p>
                        </a>
                    </li>
                    
                </ul>
            </div>

        </div>
    </div>



    <!--content-->

    
<!--footer-->

<div class="footer">
  <div class="commonweb footerWeb">
    <ul class="clearfix yj_chan" id="wwfootone">
      
      <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
      
      <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
     <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
      <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
      <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
      <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
      <li class="li1">
        <h3>
          <a href="javascript:;">大栏目</a>
          <em></em>
        </h3>
        <ul class="wwfootdrop er_chan" id="wwfoottwo">
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          <li> <h4><a href="javascript:;">小栏目</a></h4></li>
          
        </ul>
      </li>
     
     
    
    
      <li class="li2">
        <p>扫描二维码，关注我们</p>
        <p class="code-img">
          <img src="__PUBLIC__/2016/picture/wqp_img10.jpg">
        </p>
        <p class="tel">
          客服热线：<a href="tel:10086">10086</a>
        </p>
      </li>
    </ul>
  </div>
</div>

<div class="footerBottom">
  <div class="commonweb clearfix">
    <div class="footer-text">
      <a href="javascript:;">联系我们</a>|<a href="javascript:;">网站地图</a>|<a href="javascript:;">关于我们</a>
    </div>
    <p class="footer-right">
      © 2016 版权所有
    </p>
  </div>
</div>



<!---footer end-->
<script src="__PUBLIC__/2016/js/jquery-1.12.2.min.js"></script>
<script src="__PUBLIC__/2016/js/idangerous.swiper.min.js"></script>
<script src="__PUBLIC__/2016/js/layout.js"></script>

<div class="rightmenu">
        <div class="ico-box ico01 wwico-box">
            <a href="javascript:;" class="ico-cont ico-cont01">新闻中心</a>
        </div>
        <div class="ico-box ico02 wwico-box">
            <a href="javascript:;" class="ico-cont ico-cont02">关于我们</a>
        </div>
        <div class="ico-box ico03 wwico-box">
            <a href="javascript:;" class="ico-cont ico-cont03">产品展示</a>
        </div>
        <div class="ico-box ico04 wwico-box">
            <a href="javascript:;" class="ico-cont ico-cont04">形象展示</a>
        </div>
        <div class="ico-box ico05 wwico-box">
            <a href="javascript:;" class="ico-cont ico-cont05">企业文化</a>
        </div>
        <div class="ico-box ico06 backtop"></div>
</div>
 <script>
       
		$(function () {


    //-------- 导航 --------


    //-------- 判断分辨率 --------

    $(window).resize(function () {

    })

    $(window).load(function () {
        positioncont2();
        $(window).resize(function () {
            positioncont2();
        })
    })

    function positioncont2() {

        var overflowwid2 = $("body").css("overflow", "hidden").width();
        var windowwid2 = $("body").removeAttr("style").width();
        var scrollwid2 = overflowwid2 - windowwid2;
		
		if (windowwid2 + scrollwid2 > 991) {
            $('.rightmenuin').addClass('rightmenuins')
			$('.rightmenu').show();
        }
        else {
            $('.rightmenuin').removeClass('rightmenuins')
			$('.rightmenu').hide();
        };
		
		
	}
	
	})	
    </script>
</body>
</html>
