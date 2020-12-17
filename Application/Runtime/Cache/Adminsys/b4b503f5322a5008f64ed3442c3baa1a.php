<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            <?php if((ACTION_NAME) == "index"): ?>单页列表<?php endif; ?>
            <?php if((ACTION_NAME) == "search"): ?>搜索结果<?php endif; ?>
            -<?php echo ($site["SITE_INFO"]["name"]); ?>
        </title>
        <?php if(ACTION_NAME == 'index'){ $pagname = '单页列表'; }elseif(ACTION_NAME == 'search'){ $pagname = '搜索结果'; }; $addCss=""; $addJs=""; $currentNav ='单页管理 > '.$pagname; ?>
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
                        <div class="current">
                            <?php if((ACTION_NAME) == "index"): ?>单页列表<?php endif; ?>
                            <?php if((ACTION_NAME) == "search"): ?>搜索结果<?php endif; ?>
                        </div>
                        <div class="search">
                            <form action="<?php echo U('search');?>" method='get'>
                            关键字：
                                <input type="text" value="<?php echo ($keyS["keyword"]); ?>" name="keyword" class="input" placeholder="搜索标题的关键字" />
                                &nbsp;&nbsp;分类：
                                <select name="cid">
                                    <option value="">所有分类</option>
                                    <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo[cid] == $keyS[cid]): ?><option value="<?php echo ($vo["cid"]); ?>" selected="selected"><?php echo ($vo["fullname"]); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["fullname"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                &nbsp;&nbsp;<button class="btn">筛选</button>
                            </form>
                        </div>
                    </div>
                  <?php if((ACTION_NAME) == "search"): ?><div class="seamsg">
                            在<span class="keyword"><?php echo ($keyS["name"]); ?></span>分类下找到<span class="keyword"><?php echo ($keyS["count"]); ?></span>个<?php if($keyS['keyword'] != ''): ?>与<span class="keyword"><?php echo ($keyS["keyword"]); ?></span>相关的<?php endif; ?>单页！
                        </div><?php endif; ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                              <td width="4%">ID</td>
                              <td width="82%">名称</td>
                              <td width="10%">排序</td>
                              <td width="4%">操作</td>
                          </tr>
                        </thead>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="<?php echo ($vo["id"]); ?>">
                              <td><input id="id" name="id[]" type="checkbox" value="<?php echo ($vo["id"]); ?>" /></td>
                              <td align="left"><?php echo ($vo["title"]); ?></td>
                              <td align="center">
                                <div class="ajax_order">
                                    <a class="rising" href="javascript:void(0)">加</a>
                                    <span class="input" aid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["sort"]); ?></span>
                                    <a class="drop" href="javascript:void(0)">减</a>
                                </div>
                              </td>
                              <td align="center"> <a href="/Adminsys/About/edit?id=<?php echo ($vo["id"]); ?>">编辑 </a></td>
                          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <tr align="center">
                          <td colspan="4" align="right"><span class="tdtxt" style="padding-right:12px;">
                            <input type="checkbox" id="chkall" /> 选中/取消所有</span>&nbsp;&nbsp;
                            <button class="btn" id="del">批量删除</button></td>
                        </tr>
						<?php if(!empty($$page)): ?><tr>
                            <td colspan="8" align="right" class="page"><?php echo ($page); ?></td>
                        </tr><?php endif; ?>
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
            var odUrl = "<?php echo U('About/sort');?>"; //排序提交地址
			$(function(){
				$("#chkall").click(function(){
                  $("input[name='id[]']").prop("checked", $(this).prop("checked")); 
                })

                //异步删除信息
                $('#del').on("click",function(){
                  var delUrl = "<?php echo U('About/del');?>";
                  var idArr = new Array;
                  $("input[name='id[]']:checkbox:checked").each(function(i){
                    idArr[i] = $(this).val()
                  });
                  if(idArr.length==0){
                    popup.error('选项不能为空,请选择.'); 
                    return false;
                  }
                  popup.confirm('删除模型,其所属字段一并删除,确认此项操作吗?','温馨提示',function(action){
                    if(action == 'ok'){
                      $.post(delUrl,{'id':idArr},function(data){
                        if(data.status==1){
                          popup.success(data.info);
                          setTimeout(function(){
                            location.reload();
                          },1000)
                        }else{
                          popup.error(data.info);  
                        }
                      },'json');
                    }
                  });
                  return false;
                });

                //异步编辑排序字段
				$('.ajax_order a').on("click",function(){
					var odType = $(this).attr('class');
					var odShow = $(this).parents('.ajax_order').children('.input');
					var odVal = odShow.html();
					var odAid = odShow.attr('aid');
					$.post(odUrl,{'odType':odType,'odAid':odAid},function(data){      //ajax后台
						if (data.status) {
							if(odType == 'rising'){
								odShow.html(parseInt(odVal) + 1);
							}else if(odType == 'drop'){
								odShow.html(parseInt(odVal) - 1);
							}
							
						} else {
							popup.error(data.msg);
						}
					},'json');        
				});
				

			});   
        </script>
    </body>
</html>