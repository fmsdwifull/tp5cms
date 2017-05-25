<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/var/www/html/tp5cms/application/admin/view/category/index.html";i:1495693117;s:62:"/var/www/html/tp5cms/application/admin/view/public/header.html";i:1495690588;}*/ ?>
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

 <script language="javascript">
function confirm_delete() {
	if (!confirm("确认要删除？")) {
		window.event.returnValue = false;
	}
}
</script>
<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo url('Index/index'); ?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">栏目管理</span></div>
        </div>
       
        <div class="result-wrap">
                <div class="result-title">
                       <div class="result-list">
                        <a  href="<?php echo url('Category/add'); ?>"><i class="icon-font"></i>添加栏目</a>
                        <a  href="<?php echo url('Category/addBatch'); ?>"><i class="icon-font"></i>批量添加栏目</a>
                       </div>
                </div>
                <div class="result-content">
                    <form action="<?php echo url('Category/listorder'); ?>" method="post" >
                    <table class="result-tab" width="100%" >
                        <tr>
                            <th width="40">排序</th>
                            <th>名称</th>
                            <th width="40">属性</th>
                            <th width="40">显示</th>
                            <th width="230">操作</th>
                        </tr>
                       <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr align="center">
                           
                            <td><input type="text" size="2" name="listorder[<?php echo $vo['catid']; ?>]" value="<?php echo $vo['listorder']; ?>" /></td>
                            <td align="left"><?php echo str_repeat("└─",$vo['level']); ?><a href="<?php echo url('Article/index',['catid'=>$vo['catid']]); ?>"><?php echo $vo['catname']; ?> </a> [ ID:<?php echo $vo['catid']; ?> ] <?php if($vo['ispart'] == 0): ?> ( 文章：<?php echo $vo['article_number']; ?> ) <?php endif; ?> </td>
                            <td><?php echo !empty($vo['ispart'])?'<font color=red>频道</font>':'列表'; ?></td>
                            <td><?php echo !empty($vo['ishidden'])?'<font color=red>隐藏</font>':'显示'; ?></td>
                            <td align="right">
                                <?php if($vo['ispart'] == 0): ?> <a href="<?php echo url('Article/add',['catid'=>$vo['catid']]); ?>">添加文章</a><?php endif; ?> 
                                <a  href="<?php echo url('Category/add',['catid'=>$vo['catid']]); ?>">添加子栏目</a>
                                <a  href="<?php echo $vo['url']; ?>" target="_blank">预览</a>
                                <a  href="<?php echo url('Category/edit',['catid'=>$vo['catid']]); ?>">编辑</a>
                                <a onClick="confirm_delete()" href="<?php echo url('Category/delete',['catid'=>$vo['catid']]); ?>">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <tr><td colspan="5"><input type="submit" value="排序" /></td></tr>
                    </table>
                    </form>
                </div>
            
        </div>
    </div>
    
</div>
</body>
</html>
