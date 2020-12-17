<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加、编辑栏目-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $currentNav ='栏目管理 > 添加编辑栏目'; ?>
        <base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/base.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/layout.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/common.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Css/pop_status.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Js/asyncbox/skins/default.css" />
        <script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="/Public/Js/pop_status.js"></script>
        <script type="text/javascript" src="/Public/Js/functions.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/base.js"></script>
        <script type="text/javascript" src="/Public/Js/jquery.form.js"></script>
        <script type="text/javascript" src="/Public/Js/asyncbox/asyncbox.js"></script>
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
                        <div class="current"><?php echo ((isset($info["active"]) && ($info["active"] !== ""))?($info["active"]):添加); ?>栏目</div>
                    </div>
                    <form>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th>栏目：</th>
                                <td>
                                    <select id="menu" name="info[pid]">
                                        <option value="0" <?php if(($info[pid]) == "0"): ?>selected<?php endif; ?>>根栏目</option>
                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cid"]); ?>" <?php if(($vo[cid]) == $info['pid']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option>
                                            <?php if(is_array($vo[childmenu])): $i = 0; $__LIST__ = $vo[childmenu];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["cid"]); ?>">&nbsp;&nbsp;&nbsp;&nbsp;├ <?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                 </td>
                            </tr>
							<tr>
                                <th width="100">名称：</th>
                                <td><input type="text" class="input" size="30" name="info[name]" value="<?php echo ($info["name"]); ?>"/></td>
                            </tr>
                            <tr id="tr_short_name">
                                <th width="100">简称：</th>
                                <td><input type="text" class="input" size="30" name="info[short_name]" value="<?php echo ($info["short_name"]); ?>"/></td>
                            </tr>
                            <tr id="tr_ctl">
                                <th width="100">控制器名：</th>
                                <td><input type="text" id="ctl" class="input" size="30" name="info[ctl]" value="<?php echo ($info["ctl"]); ?>" onkeyup="value=value.replace(/[^a-zA-Z]/g,'')" placeholder="英文且首字母必须大写" /></td>
                            </tr>
                            <tr>
                                <th width="100">方法名：</th>
                                <td><input type="text" class="input" size="30" name="info[fun]" value="<?php echo ($info["fun"]); ?>" placeholder="英文" /></td>
                            </tr>
                            <tr>
                                <th width="100">排序：</th>
                                <td><input type="text" class="input" style="width:6%;" name="info[sort]" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>"/></td>
                            </tr>
                            <tr>
                                <th width="100">状态：</th>
                                <td><label><label><input type="radio" name="info[status]" value="1" <?php if($info["status"] == 1): ?>checked="checked"<?php endif; ?> /> 启用</label> &nbsp; <input type="radio" name="info[status]" value="0" <?php if($info["status"] == 0): ?>checked="checked"<?php endif; ?> /> 禁用</label></td>
                            </tr>
                        </table>
                        <input type="hidden" id="cid" name="info[cid]" value="<?php echo ($info["cid"]); ?>" />
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
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
            $(function(){
                $("#menu").change(function(){
                    var pid = $(this).val();
                    if(pid==0){
                        $('#tr_ctl').show();
                        $('#tr_short_name').show();
                    }else{
                        if($('#cid').val()){
                            odurl = "<?php echo U('Menu/ajax_getctl');?>";
                            $.post(odurl,{id:pid},function(data){
                                if(data.status){
                                    $('#ctl').val(data.info);
                                    $('#ctl').attr('readonly','readonly');
                                    
                                }
                            },'json')
                        }else{
                            $('#tr_ctl').hide();
                        }
                    }
                })

                $(".submit").click(function(){
                    if($('#name').val()==''){
                        popup.alert("栏目名称不能为空！");
                        return false;
                    }
                    commonAjaxSubmit();
                    return false;
                });
            });
        </script>
    </body>
</html>