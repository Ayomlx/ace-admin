<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
	<title>产品详情页</title>
	<link rel="stylesheet" type="text/css" href="/Public/Home/Css/swiper.min.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/Css/layui.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/Css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/Css/foot.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/Css/style1.css" />
</head>

<body>
	<div class="box">
		<!-- 顶部 -->
		<div class="topBox" <?php if(!empty($info[bgpic])): ?>style="background: url('<?php echo ($upWholeUrl); echo ($info["bgpic"]); ?>');"<?php else: ?> style="background: url('/Public/Home/Images/top_banner.png');"<?php endif; ?>>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="title">
							<?php if(!empty($info[title])): ?><h1><?php echo ($info["title"]); ?></h1><?php endif; ?>
							<?php if(!empty($info[summary])): ?><h6><?php echo ($info["summary"]); ?></h6><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="hrefList">
				<ul>
					<li>
						<a class="scroll" href="<?php echo U('Product/lists',array('id'=>$info['id']));?>#fangAnBox">产品概述</a>
						<i></i>
					</li>
					<li>
						<a class="scroll" href="<?php echo U('Product/lists',array('id'=>$info['id']));?>#gongnengBox">应用场景</a>
						<i></i>
					</li>
					<li>
						<a class="scroll" href="<?php echo U('Product/lists',array('id'=>$info['id']));?>#keHuAnLiBox">客户案例</a>
						<i></i>
					</li>
				</ul>
			</div>
		</div>

		<!-- 方案概述 -->
		<div class="container">
			<div class="row">
				<div class="fangAnBox  col-sm-12 col-md-12 col-lg-12" id="fangAnBox">
					<div class="fangAn">
						<div class="title">产品概述</div>
						<div class="swiper-container" id="swiper1">
							<div class="swiper-wrapper">
								<?php if(is_array($info[type_0])): foreach($info[type_0] as $key=>$vo): ?><div class="swiper-slide">
										<h2><?php echo ($vo[1]); ?></h2>
										<p><?php echo ($vo[2]); ?></p>
										<img src="<?php echo ($upWholeUrl); echo ($vo[0]); ?>" alt="<?php echo ($vo[1]); ?>">
									</div><?php endforeach; endif; ?>
							</div>
							<!-- Add Pagination -->
							<!-- <div class="swiper-pagination"></div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<!-- 主要功能 -->
		<div class="container">
			<div class="row ">
				<div class="gongnengBox  col-sm-12 col-md-12 col-lg-12" id="gongnengBox">
					<div class="gongneng">
						<div class="title">应用场景</div>
						<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
							<ul class="layui-tab-title">
								<?php if(is_array($info[type_1])): foreach($info[type_1] as $k=>$vo): ?><li <?php if(($k) == "1"): ?>class="layui-this"<?php endif; ?>><?php echo ($vo[1]); ?></li><?php endforeach; endif; ?>
							</ul>
							<div class="layui-tab-content">
								<?php if(is_array($info[type_1])): foreach($info[type_1] as $k=>$vo): ?><div <?php if(($k) == "1"): ?>class="layui-tab-item layui-show"<?php else: ?>class="layui-tab-item"<?php endif; ?>>
									<div class="content ng-star-inserted">
										<div class="content-box">
											<h2><?php echo ($vo[1]); ?></h2>
											<p class="ng-star-inserted">
												<?php echo (msubstr($vo[2],0,125,'utf-8')); ?>
											</p>
										</div>
										<div class="img-box"><img alt="<?php echo ($vo[1]); ?>" src="<?php echo ($upWholeUrl); echo ($vo[0]); ?>"></div>
									</div>
								</div><?php endforeach; endif; ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 客户案例 -->
		<div class="container container_active">
			<div class="row">
				<div class="keHuAnLiBox   col-sm-12 col-md-12 col-lg-12" id="keHuAnLiBox">
					<div class="keHuAnLi" style='padding:16px 0'>
						<div class="swiper-container" id="swiper3">
							<div class="swiper-wrapper">
								<?php if(is_array($info[type_3])): foreach($info[type_3] as $key=>$vo): ?><div class="swiper-slide">
									<img src="<?php echo ($upWholeUrl); echo ($vo[0]); ?>" alt="<?php echo ($vo[1]); ?>">
								</div><?php endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 返回顶部 -->
		<div class="returnTop">
			<img src="./images/return_top.png" alt="">
		</div>
		<!-- 底部-->
		<footer class="footer">
			<div class="container">
				<div class="row footer-top">
					<div class="col-md-4 col-lg-4">
						<h4>
							<img src="/Uploads/Logo/logo1.png">
						</h4>
					</div>
					<div class="col-md-8  col-lg-8">
						<div class="row about">
							<div class="col-sm-8">
								<ul class="list-unstyled">
									<li><font style="font-size: 14px;color: #dfe3e8;">联系我们</font>  / CONTACT US</li>
									<li style="margin-top: 30px;">
										<font>联系我们：0352-2888602  &nbsp; </font>
										<font style="margin-left: 10px;">招商合作：18935186765</font>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<ul class="list-inline text-center foot-inline">
					<li><a href="#">京ICP备19056901号-2</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<li>Copyright © 2020-2030 版权所有：百商万企汇</li>
				</ul>
			</div>
		</footer>
	</div>
	<script type="text/javascript" src="/Public/Home/Js/layui.all.js"></script>
	<script type="text/javascript" src="/Public/Home/Js/swiper.min.js"></script>
	<script type="text/javascript" src="/Public/Home/Js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Home/Js/jquery.js"></script>
	<script type="text/javascript" src="/Public/Home/Js/script.js"></script>
</body>

</html>