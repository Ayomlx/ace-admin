<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>配置信息-系统设置-<?php echo ($site["SITE_INFO"]["title"]); ?></title>
        <?php $currentNav ='系统设置 > 配置信息'; ?>
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
                        <div class="current">站点配置信息</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <tr>
                            <td width="10%">站点名称：</td>
                            <td width="40%"><?php echo ($site["SITE_INFO"]["name"]); ?></td>
                            <td width="10%">一句话描述：</td>
                            <td width="40%"><?php echo ($site["SITE_INFO"]["summary"]); ?></td>
                        </tr>
                        <tr>
                            <td width="120">网站版本：</td>
                            <td><?php echo ($site["SITE_INFO"]["version"]); ?></td>
                            <td>ICP备案：</td>
                            <td><?php echo ($site["SITE_INFO"]["icp"]); ?></td>
                        </tr>
                        <tr>
                            <td>客服邮箱：</td>
                            <td><?php echo ($site["SITE_INFO"]["service"]); ?></td>
                            <td>客服电话：</td>
                            <td><?php echo ($site["SITE_INFO"]["tel"]); ?></td>
                        </tr>
                        <tr>
                            <td>传真号码：</td>
                            <td><?php echo ($site["SITE_INFO"]["fax"]); ?></td>
                            <td>邮政编码：</td>
                            <td><?php echo ($site["SITE_INFO"]["postcode"]); ?></td>
                        </tr>
                        <tr>
                            <td>网站标题：</td>
                            <td colspan="3"><?php echo ($site["SITE_INFO"]["title"]); ?>（页面"title"处的内容）</td>
                        </tr>
                        <tr>
                            <td>网站关键字：</td>
                            <td colspan="3"><?php echo ($site["SITE_INFO"]["keyword"]); ?>（页面"keywords"处的内容）</td>
                        </tr>
                        <tr>
                            <td>网站简介：</td>
                            <td colspan="3"><?php echo ($site["SITE_INFO"]["description"]); ?>（页面"description"处的内容）</td>
                        </tr>
                    </table>
                </div>
                <!--
                <div class="contentArea">
                    <div class="Item hr clearfix">
                        <div class="current">邮箱配置信息</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                            <tr>
                                <td width="10%">邮件服务器：</td>
                                <td width="40%"><?php echo ($site["SYSTEM_EMAIL"]["smtp_host"]); ?></td>
                                <td width="10%">邮件发送端口：</td>
                                <td width="40%"><?php echo ($site["SYSTEM_EMAIL"]["smtp_port"]); ?></td>
                            </tr>
                            <tr>
                                <td>发件人地址：</td>
                                <td><?php echo ($site["SYSTEM_EMAIL"]["from_email"]); ?></td>
                                <td>发件人名称：</td>
                                <td><?php echo ($site["SYSTEM_EMAIL"]["from_name"]); ?></td>
                            </tr>
                            <tr>
                                <td>验证用户名：</td>
                                <td><?php echo ($site["SYSTEM_EMAIL"]["smtp_user"]); ?></td>
                                <td>验证密码：</td>
                                <td>******</td>
                            </tr>
                            <tr>
                                <td>回复EMAIL：</td>
                                <td><?php echo ($site["SYSTEM_EMAIL"]["reply_email"]); ?> （留空则为发件人EMAIL）</td>
                                <td>回复名称：</td>
                                <td><?php echo ($site["SYSTEM_EMAIL"]["reply_name"]); ?> （留空则为发件人名称）</td>
                            </tr>
                        </table>
                </div>
                <div class="contentArea">
                    <div class="Item hr clearfix">
                        <div class="current">短信配置信息</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <tr>
                            <td width="10%">短信提交地址：</td>
                            <td colspan="3"><?php echo ($site["SYSTEM_NOTE"]["url"]); ?></td>
                        </tr>
                        <tr>
                            <td width="10%">用户名：</td>
                            <td width="40%">变量名：<?php echo ($site["SYSTEM_NOTE"]["uid"]["field"]); ?>&nbsp;&nbsp;值：<?php echo ($site["SYSTEM_NOTE"]["uid"]["value"]); ?></td>
                            <td width="10%">密码：</td>
                            <td width="40%">变量名：<?php echo ($site["SYSTEM_NOTE"]["pwd"]["field"]); ?>&nbsp;&nbsp;值：******</td>
                        </tr>
                        <tr>
                            <td>接收者：</td>
                            <td>变量名：<?php echo ($site["SYSTEM_NOTE"]["mob"]["field"]); ?></td>
                            <td>发送内容：</td>
                            <td>变量名：<?php echo ($site["SYSTEM_NOTE"]["con"]["field"]); ?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4">
                            *提示：如果提示发送成功，且并未收到短信，请登录短信管理平台查看是否关键字被屏蔽！*
                            </td>
                        </tr>
                    </table>
                </div>
                -->
                <div class="contentArea">
                    <div class="Item hr clearfix">
                        <div class="current">安全配置信息</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <tr>
                            <td width="10%">后台登陆标示：</td>
                            <td width="40%"><?php echo ($site["TOKEN"]["admin_marked"]); ?></td>
                            <td width="10%">后台登陆有效期：</td>
                            <td width="40%"><?php echo ($site["TOKEN"]["admin_timeout"]); ?> <br/></td>
                        </tr>
                        <tr>
                            <td>前台登陆标示：</td>
                            <td><?php echo ($site["TOKEN"]["member_marked"]); ?></td>
                            <td>前台登陆有效期：</td>
                            <td><?php echo ($site["TOKEN"]["member_timeout"]); ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                            *登录标示：网站登陆COOKIE标示，在COOKIE里已MD5加密该值存储登陆信息；
                            登陆有效期：登陆后如未操作时间超过该设定值时就自动退出系统，单位为秒，最小值为100*
                            </td>
                        </tr>
                    </table>
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
</body>
</html>