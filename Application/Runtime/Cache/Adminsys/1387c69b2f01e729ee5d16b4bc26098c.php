<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>板块简介-扩展管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $currentNav ='扩展管理 > 板块配置'; ?>
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
    <div class="wrap"> <div id="Top">
    <div class="top_logo_name" style="    
		"
	>后台管理系统</div>
	<div class="menu" style="flex:1;position: inherit;">
        <ul> <?php echo ($menu); ?> </ul>
    </div>
	<div class="exsit"><a href="<?php echo U("Public/loginOut");?>">退出</a></div>
</div>
    

<div class="clear"></div>

        <div class="mainBody"> <div id="Left">
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
                <div class="contentArea">
                    <div class="Item hr clearfix">
                        <div class="current">板块简介设置</div>
                    </div>
                    <form action="" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th width="120">产品：</th>
                                <td><textarea name="product" cols="100" rows="3"><?php echo ($mbcof["product"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th width="120">技术团队：</th>
                                <td><textarea name="tech" cols="100" rows="3"><?php echo ($mbcof["tech"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th>案例：</th>
                                <td><textarea name="cases" cols="100" rows="3"><?php echo ($mbcof["cases"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th>关于我们：</th>
                                <td><textarea name="about" cols="100" rows="3"><?php echo ($mbcof["about"]); ?></textarea></td>
                            </tr>
                        </table>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
                    </div>
                </div>
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
    <script type="text/javascript">
        $(".submit").click(function(){
            commonAjaxSubmit();
        });
    </script>
</body>
</html>