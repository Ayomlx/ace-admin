<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>栏目列表-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $currentNav ='栏目管理 > 栏目列表'; ?>
        <meta name="viewport" content="width=1200,initial-scale=1.0"/>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="edge" />
<base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=/Public/Admin/Css/base.css|/Public/Admin/Css/layout.css|/Public/Admin/Css/common.css|/Public/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Css/pop_status.css" />
<script type="text/javascript" src="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=/Public/Js/jquery-1.9.0.min.js|/Public/Js/functions.js|/Public/Admin/Js/base.js|/Public/Js/jquery.form.js|/Public/Js/asyncbox/asyncbox.js<?php echo ($addJs); ?>"></script>
<script type="text/javascript" src="/Public/Js/pop_status.js"></script>
        <style>
        .auto_textarea {
          width: 120px;
          min-height: 20px;
          line-height: 20px;
          _height: 20px;
          /* max-height: 150px;*/
          margin-left: 0px;
          margin-right: auto;
          padding: 2px;
          outline: 0;
          border: 1px solid #ccc;
          font-size: 12px;
          word-wrap: break-word;
          overflow-x: hidden;
          overflow-y: auto;
          -webkit-user-modify: read-write-plaintext-only;
          border-radius: 0px;
        }
        </style>
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
                        <div class="current">栏目列表</div>
                        <a href="<?php echo U('/Adminsys/Menu/add');?>" class="btn fr">添加栏目</a>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                              <td width="4%">ID</td>
                              <td width="4%">结构</td>
                              <td width="32%">栏目名称</td>
                              <td width="20%">简称</td>
                              <td width="8%">控制器</td>
                              <td width="8%">方法</td>
                              <td width="6%">状态</td>
                              <td width="12%">排序</td>
                              <td width="6%">操作</td>
                          </tr>
                        </thead>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="<?php echo ($vo["cid"]); ?>" pid="<?php echo ($vo["pid"]); ?>">
                              <td align="center"><input id="id" name="id[]" type="checkbox" value="<?php echo ($vo["cid"]); ?>" /></td>
                              <td class="tree" style="cursor: pointer;">展开</td>
                              <td align="left">
                                <div class="auto_textarea ajax_name" name="ajax_name" attr_f="name" attr_tp="star" attr_id="<?php echo ($vo["cid"]); ?>" attr_val="<?php echo ($vo["name"]); ?>" contenteditable="true" ><?php echo ($vo["name"]); ?></div>
                              </td>
                              <td align="left">
                                <div class="auto_textarea ajax_short_name" name="ajax_short_name" attr_f="short_name" attr_tp="star" attr_id="<?php echo ($vo["cid"]); ?>" attr_val="<?php echo ($vo["short_name"]); ?>" contenteditable="true" ><?php echo ($vo["short_name"]); ?></div>
                              </td>
                              <td align="left"><?php echo ($vo["ctl"]); ?></td>
                              <td align="left"><?php echo ($vo["fun"]); ?></td>
                              <td align="center"><?php if(($vo[status]) == "0"): ?><img src="/Public/Admin/Img/toolbar_no.gif" /><?php else: ?><img src="/Public/Admin/Img/toolbar_ok.gif" /><?php endif; ?></td>
                              <td align="center">
                                <div class="ajax_order">
                                    <a class="rising" href="javascript:void(0)">加</a>
                                    <span class="input" aid="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["sort"]); ?></span>
                                    <a class="drop" href="javascript:void(0)">减</a>
                                </div>
                              </td>
                              <td align="center"><?php if(!in_array(($vo[cid]), explode(',',"5,13,24"))): ?><a href="/Adminsys/Menu/edit?id=<?php echo ($vo["cid"]); ?>">编辑</a><?php endif; ?></td>
                            </tr>
                            <?php if(is_array($vo[childmenu])): $i = 0; $__LIST__ = $vo[childmenu];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr align="center" id="<?php echo ($item["cid"]); ?>" pid="<?php echo ($item["pid"]); ?>" class="twoTree">
                                <td align="center"><input id="id" name="id[]" type="checkbox" value="<?php echo ($item["cid"]); ?>" /></td>
                                <td></td>
                                <td align="left" style="padding-left: 40px;">
                                  <div style="float: left; width: 20px; padding-top: 1px;">├</div> <div class="auto_textarea ajax_name" name="ajax_name" attr_tp="star" attr_id="<?php echo ($item["cid"]); ?>" attr_val="<?php echo ($item["name"]); ?>" contenteditable="true" ><?php echo ($item["name"]); ?></div>
                                </td>
                                <td align="left">
                                <!--<div class="auto_textarea ajax_short_name" name="ajax_short_name" attr_f="short_name" attr_tp="star" attr_id="<?php echo ($item["cid"]); ?>" attr_val="<?php echo ($item["short_name"]); ?>" contenteditable="true" ><?php echo ($item["short_name"]); ?></div>-->
                              </td>
                                <td align="left"><?php echo ($item["ctl"]); ?></td>
                                <td align="left"><?php echo ($item["fun"]); ?></td>
                                <td align="center"><?php if(($item[status]) == "0"): ?><img src="/Public/Admin/Img/toolbar_no.gif" /><?php else: ?><img src="/Public/Admin/Img/toolbar_ok.gif" /><?php endif; ?></td>
                                <td align="center">
                                  <div class="ajax_order">
                                      <a class="rising" href="javascript:void(0)">加</a>
                                      <span class="input" aid="<?php echo ($item["cid"]); ?>"><?php echo ($item["sort"]); ?></span>
                                      <a class="drop" href="javascript:void(0)">减</a>
                                  </div>
                                </td>
                                <td align="center"><?php if(!in_array(($item[cid]), explode(',',"5,13,24"))): ?><a href="/Adminsys/Menu/edit?id=<?php echo ($item["cid"]); ?>">编辑</a><?php endif; ?></td>
                               </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                        <tr align="center">
                          <td colspan="9" align="right"><span class="tdtxt" style="padding-right:12px;">
                            <input type="checkbox" id="chkall" /> 选中/取消所有</span>
                            <select name="set_status" id="set_status">
                              <option value="0">状态:禁用</option>
                              <option value="1">状态:启用</option>
                            </select>
                            &nbsp;&nbsp;<button class="btn" id="set">设置</button>
                            <button class="btn" id="del">批量删除</button></td>
                        </tr>
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
              $.each($(".twoTree"), function(i){   
                   if(i >= 0){      
                         this.style.display = 'none';  
                    } 
              });

              $("#chkall").click(function(){
                $("input[name='id[]']").prop("checked", $(this).prop("checked")); 
              })

              //异步编辑排序字段
      				$('.ajax_order a').on("click",function(){
      					var odType = $(this).attr('class');
      					var odShow = $(this).parents('.ajax_order').children('.input');
      					var odVal = odShow.html();
      					var odAid = odShow.attr('aid');
      					var sortUrl = "<?php echo U('Menu/sort');?>";
                $.post(sortUrl,{'odType':odType,'odAid':odAid},function(data){      //ajax后台
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

      				//异步删除信息
              $('#del').on("click",function(){
                var delUrl = "<?php echo U('Menu/del');?>";
                var idArr = new Array;
                $("input[name='id[]']:checkbox:checked").each(function(i){
                  idArr[i] = $(this).val()
                });
                if(idArr.length==0){
                  popup.error('选项不能为空,请选择.'); 
                  return false;
                }
                popup.confirm('你真的打算删除操作吗?','温馨提示',function(action){
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

              //异步设置
              $('#set').on("click",function(){
                var setUrl = "<?php echo U('Menu/set_status');?>";
                var idArr = new Array;
                $("input[name='id[]']:checkbox:checked").each(function(i){
                  idArr[i] = $(this).val()
                });
                if(idArr.length==0){
                  popup.error('选项不能为空,请选择.'); 
                  return false;
                }
                var opt = $('#set_status').val();
                popup.confirm('确认此项操作吗?','温馨提示',function(action){
                  if(action == 'ok'){
                    $.post(setUrl,{'id':idArr,'opt':opt},function(data){
                      console.log(data);
                      if(data.status==1){
                        popup.success(data.info);
                        setTimeout(function(){
                          location.reload();
                        },1000)
                      }else{
                        alert(data.info);  
                      }
                    },'json');
                  }
                }); 
                return false;
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
                  if($(this).attr("status")==1){
                      chn($(this).parent().attr("id"),"hide");
                      $(this).html('展开');
                      $(this).removeAttr("status");
                  }else{
                      chn($(this).parent().attr("id"),"show");
                      $(this).html('<span style="color:#266AAE;font-weight:bold;">收缩</span>');
                      $(this).attr("status",1);
                  }
              });


              //异步修改名称信息
              $('.ajax_name,.ajax_short_name').blur(function(){
                var odVal = $(this).text();
                var odId = $(this).attr('attr_id');
                var oldVal = $(this).attr('attr_val');
                var f = $(this).attr('attr_f');
                if(oldVal==odVal){
                  return false;
                }
                var odUrl_set = "<?php echo U('Menu/ajax_set_name');?>";
                $.post(odUrl_set,{odId:odId,odVal:odVal,f:f},function(data){
                  console.log(data);
                  if (data.status==1) {
                    popup.success(data.info);
                    //location.reload();
                  } else {
                    popup.error(data.info);
                  }
                },'json');  
              });

      			});   
        </script>
    </body>
</html>