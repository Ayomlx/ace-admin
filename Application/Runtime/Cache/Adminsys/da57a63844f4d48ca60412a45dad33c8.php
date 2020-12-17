<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>站点配置-系统设置-<?php echo ($site["SITE_INFO"]["title"]); ?></title>
        <?php $currentNav ='系统设置 > 站点配置'; ?>
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
                        <div class="current">站点配置</div>
                    </div>
                    <form action="" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            
							<tr>
                                <th width="120">站点名称：</th>
                                <td><input name="name" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["name"]); ?>" /> </td>
                            </tr>
							<tr>
                                <th width="120">站点Logo：</th>
                                <td id="linkPicBox">
                                <div class="up_btn_box"><div class="up_explain">LOGO格式：*.jpg; *.png；尺寸：宽<?php echo C('LOGO_ICO_WIDTH');?>&nbsp; 高<?php echo C('LOGO_ICO_HEIGHT');?></div>
                                <div id="linkPic_upload" class="btn up_but"><div class="up_but_ico"></div>上传LOGO</div>
                                <div class="clearfix"></div>
                                    <ul id="uploadImageList" class="clearfix">
                                        <?php if(!empty($site[SITE_INFO][logo])): ?><li class="photo"><img id="upImgSize" src="<?php echo ($upWholeUrl); echo ($site["SITE_INFO"]["logo"]); ?>" width="<?php echo C('LOGO_ICO_WIDTH');?>" height="<?php echo C('LOGO_ICO_HEIGHT');?>"/>
                                        <div class="imper">
                                        <a class="delImg" imgurl="<?php echo ($site["SITE_INFO"]["logo"]); ?>" href="javascript:;"></a><a class="bigImg" href="<?php echo ($upWholeUrl); echo ($site["SITE_INFO"]["logo"]); ?>"  target="_blank"></a></div>
                                        <input type="hidden" name="logo" value="<?php echo ($site["SITE_INFO"]["logo"]); ?>" />
                                        </li><?php endif; ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th width="120">一句话描述：</th>
                                <td><input name="summary" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["summary"]); ?>" /> </td>
                            </tr>
                            <tr>
                                <th width="120">网站版本：</th>
                                <td><input name="version" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["version"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>ICP备案：</th>
                                <td><input class="input" name="icp" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["icp"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>客服邮箱：</th>
                                <td><input class="input" name="service" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["service"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>客服电话：</th>
                                <td><input class="input" name="tel" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["tel"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>传真号码：</th>
                                <td><input class="input" name="fax" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["fax"]); ?>" /></td>
                            </tr>
							<tr>
                                <th>公司名称：</th>
                                <td><input class="input" name="company" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["company"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>公司地址：</th>
                                <td><input class="input" name="address" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["address"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th width="120">网站标题：</th>
                                <td><input name="title" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["title"]); ?>" /> （页面"title"处的内容）</td>
                            </tr>
                            <tr>
                                <th>网站关键字：</th>
                                <td><input class="input" name="keyword" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["keyword"]); ?>" /> （页面"keywords"处的内容）</td>
                            </tr>
                            <tr>
                                <th>网站简介：</th>
                                <td><textarea name="description" cols="100" rows="3"><?php echo ($site["SITE_INFO"]["description"]); ?></textarea> （页面"description"处的内容）</td>
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
<!-- 上传插件【 -->
<script type="text/javascript" src="/Public/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="/Public/plupload/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
<script type="text/javascript" src="/Public/plupload/i18n/zh_CN.js"></script>
<!-- 上传插件】 -->
<script type="text/javascript">
// 上传变量配置【
var moxieswf = "/Public/plupload/Moxie.swf";
var moxiesxap = "/Public/plupload/Moxie.xap";
// 上传变量配置】
var id = "<?php echo ($info["id"]); ?>";
$(function(){
	//上传初始化变量
	var uplode_url = '<?php echo U("Upload/upLogoIco");?>';//PHP处理脚本地址
	var uplode_path = '/Public'; //插件公共目录
	var sid = '<?php echo session_id();?>';//sessionID
	var upPathRoot="<?php echo ($upWholeUrl); ?>"; //图片上传根目录完整路径
	var uploadPath ="<?php echo C('UPLOADS_PICPATH');?>"; //图片上传根目录
	var linkPicW = "<?php echo C('LOGO_ICO_WIDTH');?>";
	var linkPicH = "<?php echo C('LOGO_ICO_HEIGHT');?>";

	// LOGO上传【
	
		var uploader = new plupload.Uploader({//创建实例的构造方法
			runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
			browse_button: 'linkPic_upload', // 上传按钮
			url: uplode_url, //远程上传地址
			flash_swf_url: moxieswf, //flash文件地址
			silverlight_xap_url: moxiesxap, //silverlight文件地址
			filters: {
				max_file_size: '4mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
				mime_types: [//允许文件上传类型
					{title: "files", extensions: "jpg,png"}
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
					 $("#" + file.id).html('<img id="upImgSize" src="'+upPathRoot+data.path+'" width="'+linkPicW+'" height="'+linkPicH+'"/><div class="imper"><a class="delImg" imgurl="'+data.path+'" href="javascript:;"></a><a class="bigImg" href="'+uploadPath+data.path+'"  target="_blank"></a></div><input type="hidden" name="logo" value="'+data.path+'" />');
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
	
	// LOGO上传】
	
	// LOGO删除
	var delUrl = "<?php echo U('Webinfo/del_pic');?>";
	$(document).on("click",".delImg",function(){
		var delImgUrl = $(this).attr('imgurl');
		var delDiv = $(this);
		$.post(delUrl,{'imgurl':delImgUrl},function(data){      //ajax后台
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
	
	$(".submit").click(function(){
        commonAjaxSubmit();
    });
});
</script>
</body>
</html>