<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>添加、编辑产品-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
		<base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
		<link rel="stylesheet" type="text/css" href="/Public/Admin/Css/base.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Admin/Css/layout.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Admin/Css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Admin/Css/navi.css" />
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
                        <div class="current">添加编辑产品</div>
                    </div>
                    <form>
                    <!-产品->
					<div id="con_mttab_1" class="current">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th>标题：</th>
                                <td>
                                    <input id="title" type="text" class="input" size="60" name="info[title]" value="<?php echo ($info["title"]); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>摘要：</th>
                                <td>
                                    <textarea class="input" style="height: 40px; width: 438px;" name="info[summary]" placeholder="如果不填写则系统自动截取内容前200个字符"><?php echo ($info["summary"]); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th width="100">产品图片：</th>
                                <td id="indexPicBox">
                                  <div class="up_btn_box">
                                      <div class="up_explain">
                                        下面是上传的图片，<span  class="remark">宽度：<strong id="advw">540</strong>px；高度：<strong id="advh">360</strong>px<span>
                                      </div>
                                      <div id="btn_pic_pload" class="btn up_but"><div class="up_but_ico"></div>产品图片</div>
                                  </div>
                                  <div class="cuitclear"></div>
                                  <ul id="uploadImageList" class="clearfix">
                                      <?php if(!empty($info[picture])): ?><li class="photo">
                                            <img src="<?php echo ($upWholeUrl); echo ($info["picture"]); ?>" width="360" height="240" />
                                            <div class="imper clearfix">
                                                <a class="delImg" title="删除" imgurl="<?php echo ($info["picture"]); ?>" href="javascript:;"></a>
                                            </div>
                                            <input type="hidden" name="info[picture]" value="<?php echo ($info["picture"]); ?>" />
                                          </li><?php endif; ?>
                                  </ul>
                              </td>
                            </tr>

                            <tr>
                                <th width="100">背景图片：</th>
                                <td id="indexPicBox_bg">
                                  <div class="up_btn_box">
                                      <div class="up_explain">
                                        下面是上传的图片，<span  class="remark">宽度：<strong id="advw">1359</strong>px；高度：<strong id="advh">560</strong>px<span>
                                      </div>
                                      <div id="btn_pic_upload_bg" class="btn up_but"><div class="up_but_ico"></div>背景图片</div>
                                  </div>
                                  <div class="cuitclear"></div>
                                  <ul id="uploadImageList_bg" class="clearfix">
                                      <?php if(!empty($info[bgpic])): ?><li class="photo">
                                            <img src="<?php echo ($upWholeUrl); echo ($info["bgpic"]); ?>" width="800" height="330" />
                                            <div class="imper clearfix">
                                                <a class="delImg" title="删除" imgurl="<?php echo ($info["bgpic"]); ?>" href="javascript:;"></a>
                                            </div>
                                            <input type="hidden" name="info[bgpic]" value="<?php echo ($info["bgpic"]); ?>" />
                                          </li><?php endif; ?>
                                  </ul>
                              </td>
                            </tr>
                            
							
                        </table>
                        </div>
						<input type="hidden" name="info[id]" value="<?php echo ($info["id"]); ?>" />
                    </form>
					<div class="blank50"></div>
					<div class="blank50"></div>
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

		<!-- 拖动排序 -->
		<script type="text/javascript" src="/Public/Js/jquery.dragsort-0.5.1.min.js"></script>
		<script type="text/javascript" src="/Public/Admin/Js/tab.js"></script>
		<!-- Ueditor编辑器js -->
		<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script><script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script><script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
		<!-- 上传插件【 -->
		<script type="text/javascript" src="/Public/plupload/plupload.full.min.js"></script>
		<script type="text/javascript" src="/Public/plupload/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
		<script type="text/javascript" src="/Public/plupload/i18n/zh_CN.js"></script>
		<!-- 上传插件】 -->

		<!-- title提示插件 -->
		<link rel="stylesheet" type="text/css" href="/Public/Js/poshytip/tip-yellow/tip-yellow.css" /><link rel="stylesheet" type="text/css" href="/Public/Js/poshytip/tip-yellowsimple/tip-yellowsimple.css" />
		<script type="text/javascript" src="/Public/Js/poshytip/jquery.poshytip.min.js"></script>


		<script type="text/javascript">
			var id = "<?php echo ($info["id"]); ?>"; //产品id
			var uploadPath ="<?php echo C('UPLOADS_PICPATH');?>"; //图片上传根目录
			var upPathRoot="<?php echo ($upWholeUrl); ?>"; //图片上传根目录完整路径

			$('.imper a').poshytip();

			// 上传变量配置【
			var moxieswf = "/Public/plupload/Moxie.swf";
			var moxiesxap = "/Public/plupload/Moxie.xap";
			// 上传变量配置】

			$(function(){
				var uplode_url = '<?php echo U("Upload/upIndexPic");?>';//PHP处理脚本地址
				var uplode_path = '/Public';
				var sid = '<?php echo session_id();?>';//sessionID
				// 图片上传【
		        
		            var uploader = new plupload.Uploader({//创建实例的构造方法
		                runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
		                browse_button: 'btn_pic_pload', // 上传按钮
		                url: uplode_url, //远程上传地址
		                flash_swf_url: moxieswf, //flash文件地址
		                silverlight_xap_url: moxiesxap, //silverlight文件地址
		                filters: {
		                    max_file_size: '4mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
		                    mime_types: [//允许文件上传类型
		                        {title: "files", extensions: "jpg,jpeg,gif,png"}
		                    ]
		                },
		                multi_selection: false, //true:ctrl多文件上传, false 单文件上传
		                init: {
		                    FilesAdded: function(up, files) { //文件上传前
		                        if ($("#uploadImageList").children("li").length > 1) {
		                            alert("您上传的图片太多了！");
		                            uploader.destroy();
		                        } else {
		                            uploader.start();
		                        }
		                    },
		                    FileUploaded: function(up, file, info) { //文件上传成功的时候触发
		                        var data = JSON.parse(info.response);
								$('#indexPicBox #uploadImageList').remove();
								$('#indexPicBox').append('<div class="cuitclear"></div><ul id="uploadImageList" class="clearfix"><notempty name="info[picture]"><li class="photo"><img src="'+upPathRoot+data.path+'" width="360" height="240"/><div class="imper clearfix"><a class="delImg" imgurl="'+data.path+'" href="javascript:;"></a></div><input type="hidden" name="info[picture]" value="'+data.path+'" /></li></ul>');
		                    },
		                    Error: function(up, err) { //上传出错的时候触发
		                        alert(err.message);
		                    }
		                }
		            });
		            uploader.init();

		            var uploader_bg = new plupload.Uploader({//创建实例的构造方法
		                runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
		                browse_button: 'btn_pic_upload_bg', // 上传按钮
		                url: uplode_url, //远程上传地址
		                flash_swf_url: moxieswf, //flash文件地址
		                silverlight_xap_url: moxiesxap, //silverlight文件地址
		                filters: {
		                    max_file_size: '4mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
		                    mime_types: [//允许文件上传类型
		                        {title: "files", extensions: "jpg,jpeg,gif,png"}
		                    ]
		                },
		                multi_selection: false, //true:ctrl多文件上传, false 单文件上传
		                init: {
		                    FilesAdded: function(up, files) { //文件上传前
		                        if ($("#uploadImageList_bg").children("li").length > 1) {
		                            alert("您上传的图片太多了！");
		                            uploader_bg.destroy();
		                        } else {
		                            uploader_bg.start();
		                        }
		                    },
		                    FileUploaded: function(up, file, info) { //文件上传成功的时候触发
		                        var data = JSON.parse(info.response);
								$('#indexPicBox_bg #uploadImageList_bg').remove();
								$('#indexPicBox_bg').append('<div class="cuitclear"></div><ul id="uploadImageList_bg" class="clearfix"><notempty name="info[bgpic]"><li class="photo"><img src="'+upPathRoot+data.path+'" width="800" height="330"/><div class="imper clearfix"><a class="delImg" imgurl="'+data.path+'" href="javascript:;"></a></div><input type="hidden" name="info[bgpic]" value="'+data.path+'" /></li></ul>');
		                    },
		                    Error: function(up, err) { //上传出错的时候触发
		                        alert(err.message);
		                    }
		                }
		            });

		            uploader_bg.init();
		        
		        // 图片上传】

				//图片删除
				$(document).on("click",".delImg",function(){
				//$('.delImg').click(function(){
					var delImgUrl = $(this).attr('imgurl');
					var delImgName = $(this).attr('imgname');
					var delImgDuty = $(this).attr('imgduty');
					var delDiv = $(this);
					var delUrl = "<?php echo U('Extend/del_pic_tech_case');?>";
					$.post(delUrl, {'id':id, 'imgurl':delImgUrl, 'imgname':delImgName, 'imgduty':delImgDuty}, function(data){      //ajax后台
						if (data.status) {
							delDiv.parents('.photo').fadeOut().remove();
							popup.success(data.info);
							setTimeout(function(){
								popup.close("asyncbox_success");
							},1000);
						} else {
							alert(data.info);
						}
					},'json');
				});

				//拖动排序
			    if(id){
			        $("#uploadImageList").dragsort({ dragSelector: "li", dragBetween: true, dragEnd: saveOrder, placeHolderTemplate: "<li class='placeHolder'></li>" });     
			    }else{
			        $("#uploadImageList").dragsort({ dragSelector: "li", dragBetween: true, placeHolderTemplate: "<li class='placeHolder'></li>" });  
			    }
			    function saveOrder() {
			        var pic = $("#uploadImageList li").map(function() { return $(this).children('input[name="pic[]"]').val(); }).get();
			        var name = $("#uploadImageList li").map(function() { return $(this).children('input[name="name[]"]').val(); }).get();
			        var duty = $("#uploadImageList li").map(function() { return $(this).children('input[name="duty[]"]').val(); }).get();
			        var imgArr = pic.join("|"); //组合图片从新排列数据
			        var nameArr = name.join("|");
			        var dutyArr = duty.join("|"); 
			        console.log(imgArr);
			        $.post(imgOrderUrl,{'id':id,'imgArr':imgArr,'nameArr':nameArr,'dutyArr':dutyArr},function(data){  //ajax提交到后台排序
			            if (data.status) {
			                popup.success(data.info);
			                setTimeout(function(){
			                    popup.close("asyncbox_success");
			                },1000);
			            } else {
			                popup.error(data.info);
			                setTimeout(function(){
			                    popup.close("asyncbox_success");
			                },2000);
			            }
			        },'json');
			    };
				//拖动排序_end

				$(".submit").click(function(){
					commonAjaxSubmit();
					return false;
				});
			});
		</script>
    </body>
</html>