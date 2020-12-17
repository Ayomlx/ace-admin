<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>产品管理-扩展管理-<?php echo ($site["SITE_INFO"]["name"]); ?>
        </title>
        <?php $currentNav ='扩展管理 > 产品 > 列表'; ?>
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
                  <div class="current">产品</div>
                  <div style="float:right; margin-top:6px;"><a href="<?php echo U('Extend/product_add');?>" class="sbtn on">添加产品</a></div>
                </div>
 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                      <thead>
                          <tr>
                              <td width="4%">ID</td>
                              <td width="70%" style="text-align: left;">名称</td>
                              <td width="8%">排序</td>
                              <td width="8%">内容</td>
                              <td width="6%">操作</td>
                          </tr>
                      </thead>
                      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="<?php echo ($vo["id"]); ?>">
                              <td><?php echo ($vo["id"]); ?></td>
                              <td align="left"><?php echo ($vo["title"]); ?></td>
                              <td align="center">
                                <div class="ajax_order">
                                    <a class="rising" href="javascript:void(0)">加</a>
                                    <span class="input" aid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["sort"]); ?></span>
                                    <a class="drop" href="javascript:void(0)">减</a>
                                </div>
                              </td>
                              <td><a href="/Adminsys/Extend/product_detail_edit?tp=0&product_id=<?php echo ($vo["id"]); ?>">概述</a> ┆ <a href="/Adminsys/Extend/product_detail_edit?tp=1&product_id=<?php echo ($vo["id"]); ?>">应用</a> ┆ <!-- <a href="/Adminsys/Extend/product_detail_edit?tp=2&product_id=<?php echo ($vo["id"]); ?>">可视化</a> ┆  --><a href="/Adminsys/Extend/product_detail_edit?tp=3&product_id=<?php echo ($vo["id"]); ?>">案例</a></td>
                              <td align="center"><a href="/Adminsys/Extend/product_detail_add?id=<?php echo ($vo["id"]); ?>">添加</a> ┆ <a href="/Adminsys/Extend/product_edit?id=<?php echo ($vo["id"]); ?>">编辑</a></td>
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
    				//异步编辑排序字段
    				$('.ajax_order a').on("click",function(){
    					var odType = $(this).attr('class');
    					var odShow = $(this).parents('.ajax_order').children('.input');
    					var odVal = odShow.html();
    					var odAid = odShow.attr('aid');
    					$.post("<?php echo U('Index/sort');?>",{'tp':0,'odType':odType,'odAid':odAid},function(data){      //ajax后台
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
    				
    				//删除
    				$(".del").click(function(){
    					var id = $(this).attr("data");
    					if(!id){
    						alert("出现错误，请刷新后重试")
    						return false;
    					}
    					popup.confirm('你真的打算删除【<b>'+$(this).attr("name")+'</b>】吗?','温馨提示',function(action){
    						if(action == 'ok'){
    							$delurl = "<?php echo U('Extend/del');?>";
    							$.post($delurl,{id:id},function(data) {
    								if (data.status==1){
    									popup.success(data.info);
    									setTimeout(function(){
    										location.reload();
    									},1000)
    								}else {
    									popup.success(data.info);
    								}
    							},'json');
    							
    						}
    					});
    					return false;
    				})

            //异步编辑排序字段
            $('.ajax_order a').on("click",function(){
              var odType = $(this).attr('class');
              var odShow = $(this).parents('.ajax_order').children('.input');
              var odVal = odShow.html();
              var odAid = odShow.attr('aid');
              $.post("<?php echo U('Extend/product_sort');?>",{'odType':odType,'odAid':odAid},function(data){      //ajax后台
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