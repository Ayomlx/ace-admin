<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>权限管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $currentNav ='权限管理 > 管理员列表'; ?>
        <meta name="viewport" content="width=1200,initial-scale=1.0"/>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="edge" />
<base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=/Public/Admin/Css/base.css|/Public/Admin/Css/layout.css|/Public/Admin/Css/common.css|/Public/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Css/pop_status.css" />
<script type="text/javascript" src="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=/Public/Js/jquery-1.9.0.min.js|/Public/Js/functions.js|/Public/Admin/Js/base.js|/Public/Js/jquery.form.js|/Public/Js/asyncbox/asyncbox.js<?php echo ($addJs); ?>"></script>
<script type="text/javascript" src="/Public/Js/pop_status.js"></script>
    </head>
    <body>
        <div class="wrap">
            <div id="Top">
    <div class="top_logo_name" style="    
		"
	>后台管理系统</div>
	<div class="menu" style="flex:1;position: inherit;">
        <ul> <?php echo ($menu); ?> </ul>
    </div>
	<div class="exsit"><a href="<?php echo U("Public/loginOut");?>">退出</a></div>
</div>
    

<div class="clear"></div>

            <div class="mainBody">
                <div id="Left">
    <div id="control" class=""></div>
    <div class="subMenuList">
        <ul>
			<li>
				<a><?php echo ($menu_name); ?></a>
				<ol class="child_list">
					<?php if(is_array($sub_menu)): foreach($sub_menu as $key=>$sv): ?><li><a href="<?php echo ($sv["url"]); ?>"><?php echo ($sv["title"]); ?></a></li><?php endforeach; endif; ?>
				</ol>
			</li>
        </ul>
    </div>

</div>
                <div id="Right">
                    <div class="Item hr clearfix">
                        <div class="current">管理员列表</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                                <td width="4%">AID</td>
                                <td width="12%">账号</td>
                                <td width="8%">昵称</td>
                                <td width="4%">所属组</td>
                                <td width="54%">备注</td>
                                <td width="10%">开通时间</td>
                                <td width="4%">状态</td>
                                <td width="4%">操作</td>
                            </tr>
                        </thead>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" aid="<?php echo ($vo["aid"]); ?>">
                                <td><?php echo ($vo["aid"]); ?></td>
                                <td align="left"><?php echo ($vo["account"]); ?></td>
                                <td align="left"><?php echo ($vo["nickname"]); ?></td>
                                <td><?php if(($vo["group"]) == ""): ?>无<?php else: echo ($vo["group"]); endif; ?></td>
                                <td align="left"><?php echo ($vo["remark"]); ?></td>
                                <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
                                <td><?php echo ($vo["statusTxt"]); ?></td>
                                <td><?php if($vo["email"] == C('ADMIN_AUTH_KEY')): ?>--<?php else: ?>[ <a href="/Adminsys/Access/editAdmin?aid=<?php echo ($vo["aid"]); ?>">编辑</a> ]<?php endif; ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <script type="text/javascript">
    $(window).resize(autoSize);
    $(function(){
        autoSize();
    });

</script>
    </body>
</html>