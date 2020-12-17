<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>添加、编辑缩略图-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='首页管理 > 轮播图 > 发布/编辑'; ?>
        <base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/base.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/layout.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/common.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Js/asyncbox/skins/default.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Css/pop_status.css" />
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
                        <div class="current">轮播图</div>
                    </div>
                    <form>
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
                                <th>连接地址：</th>
                                <td>
                                    <input id="name" type="text" class="input" size="60" name="info[href]" value="<?php echo ($info["href"]); ?>" placeholder="请带有 http://">
                                </td>
                            </tr>
                            <tr>
                              <th>图片：</th>
                              <td id="indexPicBox">
                                  <div class="up_btn_box">
                                      <div class="up_explain">
                                        下面是上传的图片，<span  class="remark">宽度：<strong id="advw">700</strong>px；高度：<strong id="advh">330</strong>px<span>
                                      </div>
                                      <div id="goodsPic_upload" class="btn up_but"><div class="up_but_ico"></div>上传图片</div>
                                  </div>
                                  <div class="cuitclear"></div>
                                  <ul id="uploadImageList" class="clearfix">
                                      <?php if(!empty($info[picture])): ?><li class="photo">
                                            <img src="<?php echo ($upWholeUrl); echo ($info["picture"]); ?>" width="240" height="160" />
                                            <div class="imper clearfix">
                                                <a class="delImg" title="删除" imgurl="<?php echo ($info["picture"]); ?>" href="javascript:;"></a>
                                            </div>
                                            <input type="hidden" name="info[picture]" value="<?php echo ($info["picture"]); ?>" />
                                          </li><?php endif; ?>
                                  </ul>
                              </td>
                            </tr>
                            
                        </table>
                        <input type="hidden" name="info[cid]" value="0" />
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

<!-- title提示插件 -->
<link rel="stylesheet" type="text/css" href="/Public/Js/poshytip/tip-yellow/tip-yellow.css" /><link rel="stylesheet" type="text/css" href="/Public/Js/poshytip/tip-yellowsimple/tip-yellowsimple.css" />
<script type="text/javascript" src="/Public/Js/poshytip/jquery.poshytip.min.js"></script>

<script type="text/javascript">
var id = "<?php echo ($info["id"]); ?>"; 
var uploadPath ="<?php echo C('UPLOADS_PICPATH');?>"; //图片上传根目录
var upPathRoot="<?php echo ($upWholeUrl); ?>"; //图片上传根目录完整路径


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
                browse_button: 'goodsPic_upload', // 上传按钮
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
						$('#indexPicBox').append('<div class="cuitclear"></div><ul id="uploadImageList" class="clearfix"><notempty name="info[picture]"><li class="photo"><img src="'+upPathRoot+data.path+'" width="240" height="160"/><div class="imper clearfix"><a class="delImg" imgurl="'+data.path+'" href="javascript:;"></a></div><input type="hidden" name="info[picture]" value="'+data.path+'" /></li></ul>');
                    },
                    Error: function(up, err) { //上传出错的时候触发
                        alert(err.message);
                    }
                }
            });
            uploader.init();
        
        // 图片上传】
		
        //图片删除_start
        var delUrl = "<?php echo U('Extend/del_pic');?>";
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
                    popup.error(data.info);
                }
            },'json');        
        });
        // 图片删除_end
		
        $(".submit").click(function(){
            commonAjaxSubmit();
            return false;
        });
    });
</script>
    </body>
</html>