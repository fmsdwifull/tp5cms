<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"/var/www/html/tp5cms/application/admin/view/article/index.html";i:1495690588;s:62:"/var/www/html/tp5cms/application/admin/view/public/header.html";i:1495690588;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/webuploader/css/webuploader.css">
    <script type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.10.2.min.js"></script>
    
    <script type="text/javascript">
      function selectall(name) {
	if($("#check_box").prop('checked')== true) {
		$("input[name='"+name+"']").each(function() {
  			$(this).prop('checked',true);
			
		});
	} else {
		$("input[name='"+name+"']").each(function() {
  			$(this).removeAttr("checked");
		});
	}
   } 
      </script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo"><a href="<?php echo url('Index/index'); ?>" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="__ROOT__" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="<?php echo url('Admin/password'); ?>">修改密码</a></li>
                <li><a href="<?php echo url('Common/logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo url('Article/index'); ?>"><i class="icon-font">&#xe005;</i>文章管理</a></li>
                        <li><a href="<?php echo url('Category/index'); ?>"><i class="icon-font">&#xe005;</i>栏目管理</a></li>
                        <li><a href="<?php echo url('Tag/index'); ?>"><i class="icon-font">&#xe005;</i>TAG管理</a></li>
                        <li><a href="<?php echo url('Attachment/index'); ?>"><i class="icon-font">&#xe005;</i>附件管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo url('System/set'); ?>"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="<?php echo url('Common/cache'); ?>"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->

<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo url('Index/index'); ?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">文章管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="<?php echo url('Article/index'); ?>" method="get">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择栏目:</th>
                            <td>
                                 <select name="catid">
                                    <option value="0">选择栏目</option>
                                    <?php if(is_array($cate_list) || $cate_list instanceof \think\Collection): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['catid']; ?>" <?php if($catid): ?>selected="selected"<?php endif; if($vo['ispart'] == 1): ?> disabled="disabled"<?php endif; ?>><?php echo str_repeat("└─",$vo['level']); ?><?php echo $vo['catname']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="q" value="<?php echo !empty($q)?$q:''; ?>"  type="text"></td>
                            <td><input class="btn btn-primary btn2" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="<?php echo url('Article/add'); ?>"><i class="icon-font"></i>添加文章</a>
                        <a onclick="myform.action='<?php echo url('Article/delete'); ?>';myform.submit();" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a onclick="myform.action='<?php echo url('Article/listorder'); ?>';myform.submit();" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                        <a onclick="myform.action='<?php echo url('Article/status'); ?>';myform.submit();" href="javascript:void(0)"><i class="icon-font"></i>更新状态</a>
                        <a onClick="confirm_delete()" href="<?php echo url('Article/deleteAll'); ?>"><i class="icon-font"></i>删除所有文章</a>
                    </div>
                   <script language="javascript">
					function confirm_delete() {
						if (!confirm("确认要删除所有文章？")) {
							window.event.returnValue = false;
						}
					}
				   </script>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="20"><input class="allChoose" id="check_box" onclick="selectall('id[]');" type="checkbox"></th>
                            <th width="60">排序</th>
                            <th>标题</th>
                            <th width="50">状态</th>
                            <th width="200">栏目</th>
                            <th width="140">时间</th>
                            <th width="60">操作</th>
                        </tr>
                        <?php if(is_array($article_list) || $article_list instanceof \think\Collection): $i = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr align="center">
                            <td class="tc"><input name="id[]" value="<?php echo $vo['id']; ?>" type="checkbox"></td>
                            <td>
                               <input class="common-input sort-input" name="listorder[<?php echo $vo['id']; ?>]" value="<?php echo $vo['listorder']; ?>" type="text">
                            </td>
                            <td align="left"><a target="_blank" href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo !empty($q)?str_replace($q, '<font color=red>'.$q.'</font>', $vo['title']):$vo['title']; ?></a>
                            </td>
                            <td><?php echo !empty($vo['status'])?'未审核':'已审核'; ?></td>
                            <td><?php echo get_catname($vo['catid']); ?></td>
                            <td><?php echo date("Y-m-d H:i:s",$vo['inputtime']); ?></td>
                            <td>
                                <a class="link-update" href="<?php echo url('Article/edit',['id'=>$vo['id']]); ?>">修改</a>
                                <a class="link-del" href="<?php echo url('Article/delete',['id'=>$vo['id']]); ?>">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <tr><td colspan="9"><?php echo $page; ?></td></tr>
                    </table>
                   
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
