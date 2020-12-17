<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加、编辑单页-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='资讯管理 > 添加编辑单页'; ?>
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
                        <div class="current">添加编辑单页</div>
                    </div>
                    <form>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th width="100">名称：</th>
                                <td><input id="title" type="text" class="input" size="60" name="info[title]" value="<?php echo ($info["title"]); ?>"/></td>
                            </tr>
                            <tr>
                                <th>分类：</th>
                                <td>
                                    <select name="info[cid]" id="opt_expo">
                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo[cid] == $info[cid]): ?><option value="<?php echo ($vo["cid"]); ?>" selected="selected"><?php echo ($vo["fullname"]); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["fullname"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                 </td>
                            </tr>
							<tr>
                                <th>图标：</th>
                                <td id="linkPicBox">
                                <div class="up_btn_box"><div class="up_explain">图片格式：*.gif; *.jpg; *.png；尺寸：宽<?php echo C('LINK_ICO_WIDTH');?>&nbsp; 高<?php echo C('LINK_ICO_HEIGHT');?>。如果上传的图片让您看着不舒服，请检查图片尺寸是否符合要求</div>
                                <div id="linkPic_upload" class="btn up_but"><div class="up_but_ico"></div>上传图片</div>
                                <div class="clearfix"></div>
                                    <ul id="uploadImageList" class="clearfix">
                                        <?php if(!empty($info[picture])): ?><li class="photo"><img id="upImgSize" src="<?php echo ($upWholeUrl); echo ($info["picture"]); ?>" width="<?php echo C('ABOUT_ICO_WIDTH');?>" height="<?php echo C('ABOUT_ICO_HEIGHT');?>"/>
                                        <div class="imper">
                                        <a class="delImg" imgurl="<?php echo ($info["picture"]); ?>" href="javascript:;"></a><a class="bigImg" href="<?php echo ($upWholeUrl); echo ($info["picture"]); ?>"  target="_blank"></a></div>
                                        <input type="hidden" name="info[picture]" value="<?php echo ($info["picture"]); ?>" />
                                        </li><?php endif; ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea id="content" style="width: 95%; height:400px;" name="info[content]"><?php echo ($info["content"]); ?></textarea></td>
                            </tr>
							
                        </table>
                        <input type="hidden" name="info[id]" value="<?php echo ($info["id"]); ?>" />
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
<!-- 上传插件【 -->
<script type="text/javascript" src="/Public/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="/Public/plupload/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
<script type="text/javascript" src="/Public/plupload/i18n/zh_CN.js"></script>
<!-- 上传插件】 -->
<!-- Ueditor编辑器js -->
<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script><script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script><script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript">
// 上传变量配置【
var moxieswf = "/Public/plupload/Moxie.swf";
var moxiesxap = "/Public/plupload/Moxie.xap";
// 上传变量配置】
var id = "<?php echo ($info["id"]); ?>";
$(function(){
	// 百度编辑器
	window.UEDITOR_CONFIG.imageUrl = "<?php echo U('Upload/editorUpload');?>";
	window.UEDITOR_CONFIG.imagePath = '<?php echo ($upWholeUrl); ?>';
	window.UEDITOR_CONFIG.savePath = ['<?php echo ($upWholeUrl); ?>'];
	UE.getEditor('content');	
	//window.UEDITOR_CONFIG.toolbars=[['fullscreen','source','|','undo','redo','|','bold','italic','removeformat','formatmatch','forecolor','|','insertorderedlist','insertunorderedlist','|','indent','rowspacingtop','rowspacingbottom','lineheight','|','justifyleft','justifycenter','justifyright','justifyjustify','paragraph','fontfamily','fontsize']];
    //UE.getEditor('content');
	// 百度编辑器——end
	
	//上传初始化变量
	var uplode_url = '<?php echo U("Upload/upAboutIco");?>';//PHP处理脚本地址
	var uplode_path = '/Public'; //插件公共目录
	var sid = '<?php echo session_id();?>';//sessionID
	var upPathRoot="<?php echo ($upWholeUrl); ?>"; //图片上传根目录完整路径
	var uploadPath ="<?php echo C('UPLOADS_PICPATH');?>"; //图片上传根目录
	var linkPicW = "<?php echo C('ABOUT_ICO_WIDTH');?>";
	var linkPicH = "<?php echo C('ABOUT_ICO_HEIGHT');?>";

	// 关于我们图片上传【
	
		var uploader = new plupload.Uploader({//创建实例的构造方法
			runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
			browse_button: 'linkPic_upload', // 上传按钮
			url: uplode_url, //远程上传地址
			flash_swf_url: moxieswf, //flash文件地址
			silverlight_xap_url: moxiesxap, //silverlight文件地址
			filters: {
				max_file_size: '4mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
				mime_types: [//允许文件上传类型
					{title: "files", extensions: "jpg,gif"}
				]
			},
			multi_selection: false, //true:ctrl多文件上传, false 单文件上传
			init: {
				FilesAdded: function(up, files) { //文件上传前
					if ($("#uploadImageList").children("li").length > 1) {
						alert("您上传的图片太多了！");
						uploader.destroy();
					} else {
						var li = '';
						plupload.each(files, function(file) { //遍历文件
							li += "<li class='photo' id='" + file['id'] + "'><div style='width: "+linkPicW+"px;' class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
						});
						$("#uploadImageList").html(li);
						uploader.start();
					}
				},
				UploadProgress: function(up, file) { //上传中，显示进度条
			 var percent = file.percent;
					$("#" + file.id).find('.bar').css({"width": percent + "%"});
					$("#" + file.id).find(".percent").text(percent + "%");
				},
				FileUploaded: function(up, file, info) { //文件上传成功的时候触发
					var data = JSON.parse(info.response);
					 $("#" + file.id).html('<img id="upImgSize" src="'+upPathRoot+data.path+'" width="'+linkPicW+'" height="'+linkPicH+'"/><div class="imper"><a class="delImg" imgurl="'+data.path+'" href="javascript:;"></a><a class="bigImg" href="'+uploadPath+data.path+'"  target="_blank"></a></div><input type="hidden" name="info[picture]" value="'+data.path+'" />');
					popup.success(data.msg);
					setTimeout(function(){
						popup.close("asyncbox_success");
					},1000);
				},
				Error: function(up, err) { //上传出错的时候触发
					alert(err.message);
				}
			}
		});
		uploader.init();
	
	// 关于我们图片上传】
	
	// 关于我们图标删除
	var delUrl = "<?php echo U('About/del_pic');?>";
	$(document).on("click",".delImg",function(){
		var delImgUrl = $(this).attr('imgurl');
		var delDiv = $(this);
		$.post(delUrl,{'id':id,'imgurl':delImgUrl},function(data){      //ajax后台
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
	// 关于我们图标删除_end
	
	$(".submit").click(function(){
		commonAjaxSubmit();
		return false;
	});
});


</script>
    </body>
</html>