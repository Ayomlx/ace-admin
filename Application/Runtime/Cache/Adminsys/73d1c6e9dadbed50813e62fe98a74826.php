<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>节点管理-权限管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $currentNav ='权限管理 > 节点管理'; ?>
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
                        <div class="current">节点管理</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                                <td width="5%">序号</td>
                                <td width="26%">节点结构  <b title="单击分类隐藏/显示该分类下在子类">[i]</b></td>
                                <td width="12%">名称</td>
                                <td width="16%">显示名</td>
                                <td width="6%">排序</td>
                                <td width="16%">类型</td>
                                <td width="6%">状态</td>
                                <td width="13%">操作</td>
                            </tr>
                        </thead>
                        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr align="center" id="<?php echo ($vo["id"]); ?>" pid="<?php echo ($vo["pid"]); ?>">
                                <td><?php echo ($k); ?></td>
                                <td align="left" class="tree" style="cursor: pointer;"><?php echo ($vo["fullname"]); ?></td>
                                <td align="left"><?php echo ($vo["name"]); ?></td>
                                <td align="left"><?php echo ($vo["title"]); ?></td>
                                <td edit="0" fd="sort"><?php echo ($vo["sort"]); ?></td>
                                <td align="left"><?php echo ($vo["level"]); ?></td>
                                <td><?php echo ($vo["statusTxt"]); ?></td>
                                <td><a href="javascript:void(0);" class="opStatus" val="<?php echo ($vo["status"]); ?>"><?php echo ($vo["chStatusTxt"]); ?></a>┆<a href="/Adminsys/Access/editNode?id=<?php echo ($vo["id"]); ?>" class="edit">编辑</a>┆<a href="/Adminsys/Access/delNode?id=<?php echo ($vo["id"]); ?>" class="edit">删除</a></td>
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
        <script type="text/javascript">
            $(function(){
                //快捷启用禁用操作
                $(".opStatus").click(function(){
                    var obj=$(this);
                    var id=$(this).parents("tr").attr("id");
                    var status=$(this).attr("val");
                    $.getJSON("/Adminsys/Access/opNodeStatus", { id:id, status:status }, function(json){
                        if(json.status==1){
                            popup.success(json.info);
                            $(obj).attr("val",json.data.status).html(status==1?"启用":"禁用").parents("td").prev().html(status==1?"禁用":"启用");
                        }else{
                            popup.alert(json.info);
                        }
                    });
                });

                //快捷改变操作排序dblclick
                $("tbody>tr>td[fd]").click(function(){
                    var inval = $(this).html();
                    var infd = $(this).attr("fd");
                    var inid =  $(this).parents("tr").attr("id");
                    if($(this).attr('edit')==0){
                        $(this).attr('edit','1').html("<input class='input' size='5' id='edit_"+infd+"_"+inid+"' value='"+inval+"' />").find("input").select();
                    }
                    $("#edit_"+infd+"_"+inid).focus().bind("blur",function(){
                        var editval = $(this).val();
                        $(this).parents("td").html(editval).attr('edit','0');
                        if(inval!=editval){
                            $.post("/Adminsys/Access/opSort",{id:inid,fd:infd,sort:editval});
                        }
                    })
                });

                var chn=function(cid,op){
                    if(op=="show"){
                        $("tr[pid='"+cid+"']").each(function(){
                            $(this).removeAttr("status").show();
                            chn($(this).attr("id"),"show");
                        });
                    }else{
                        $("tr[pid='"+cid+"']").each(function(){
                            $(this).attr("status",1).hide();
                            chn($(this).attr("id"),"hide");
                        });
                    }
                }
                $(".tree").click(function(){
                    if($(this).attr("status")!=1){
                        chn($(this).parent().attr("id"),"hide");
                        $(this).attr("status",1);
                    }else{
                        chn($(this).parent().attr("id"),"show");
                        $(this).removeAttr("status");
                    }
                });
            });
        </script>
    </body>
</html>