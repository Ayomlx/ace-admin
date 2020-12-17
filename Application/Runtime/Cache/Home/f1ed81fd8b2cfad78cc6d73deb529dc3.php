<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html lang="en">
<head>
    <title>Banker &mdash; Website Template by cssmoban</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Public/Home/fonts/icomoon/style.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/fonts/flaticon/font/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/jquery.fancybox.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/bootstrap-datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/aos.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/foot.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/Css/style.css" />
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<!--<div class="adcenter"><script src="http://www.cssmoban.com/include/new/ggad2_728x90.js"></script></div>-->


<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>


<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-xl-2">
                    <h1 class="mb-0 site-logo"><a href="index.html" class="h2 mb-0">
					  <img src="<?php echo ($upWholeUrl); ?>Logo/logo1.png">
					</a></h1>
                </div>

                <div class="col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li><a href="#swiper1" class="nav-link">首页</a></li>
                            <li class="has-children">
                                <a href="#category-section" class="nav-link">
									产品
<!--									<img src="images/xia.png" alt="">-->
								</a>
                                <ul class="dropdown">
                                    <?php if(is_array($list[product])): $i = 0; $__LIST__ = $list[product];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Product/lists',array('id'=>$vo['id']));?>" class="nav-link"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>

                            <!-- <li><a href="#team-section" class="nav-link">技术</a></li> -->
                            <li><a href="#gallery-section" class="nav-link">案例</a></li>
                            <li><a href="#about-section" class="nav-link">关于</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

            </div>
        </div>

    </header>


<!--    轮播图-->
    <div class="swiper-container" id="swiper1">
        <div class="swiper-wrapper">
            <?php if(is_array($list[slide])): $i = 0; $__LIST__ = $list[slide];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                <img src="<?php echo ($upWholeUrl); echo ($vo["picture"]); ?>" alt="<?php echo ($vo["title"]); ?>">
                <div class="slide site-blocks-cover">
                    <!-- <h1 class="text-uppercase" data-aos="fade-up"><?php echo ($vo["title"]); ?></h1> -->
                    <p class="mb-5 desc"  data-aos="fade-up" data-aos-delay="100"><?php echo ($vo["summary"]); ?></p>
                    <div data-aos="fade-up" data-aos-delay="100">
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>




    <!--产品图标-->
    <section class="site-section" id="category-section">
        <div class="container">
            <div class="row mb-5">
                <div class="swiper-container" id="swiper2">
                    <div class="swiper-wrapper">
                        <?php if(is_array($list[catimg])): $i = 0; $__LIST__ = $list[catimg];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                            <div class="col-md-12 text-center" data-aos="fade-up" data-aos-delay="">
                                <img src="<?php echo ($upWholeUrl); echo ($vo["picture"]); ?>" alt="<?php echo ($vo["title"]); ?>" class="img-fluid w-25 mb-4">
                                <h3 class="card-title"><?php echo ($vo["title"]); ?></h3>
                                <p><?php echo (msubstr($vo["summary"],0,120,'utf-8')); ?></p>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        
                    </div>
                </div>


            </div>


            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">产品</h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100"><?php echo ($list["menu_summary"]["product"]); ?></p>
                </div>
            </div>

            <div class="row align-items-lg-center" >
                <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">

                    <div class="owl-carousel slide-one-item-alt">
                        <?php if(is_array($list[product])): $i = 0; $__LIST__ = $list[product];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo ($upWholeUrl); echo ($vo["picture"]); ?>" alt="Image" class="img-fluid"><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="custom-direction">
                        <a href="#" class="custom-prev"><span>
<!--                            <span class="icon-keyboard_backspace"></span>-->
                            <span>←</span>
                        </span></a><a href="#" class="custom-next"><span>
<!--                        <span class="icon-keyboard_backspace"></span>-->
                        <span>→</span>
                    </span></a>
                    </div>

                </div>
                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

                    <div class="owl-carousel slide-one-item-alt-text">
                        <?php if(is_array($list[product])): $k = 0; $__LIST__ = $list[product];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div>
                            <h2 class="section-title mb-3"><?php echo ($k); ?>. <?php echo ($vo["title"]); ?></h2>
                            <p><?php echo (msubstr($vo["summary"],0,250,'utf-8')); ?></p>

                            <p><a href="<?php echo U('Product/lists',array('id'=>$vo['id']));?>" class="btn btn-primary mr-2 mb-2">Learn More</a></p>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 技术团队-->
    <!-- 
	<section class="site-section border-bottom" id="team-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">技术团队</h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100"><?php echo ($list["menu_summary"]["tech"]); ?></p>
                </div>
            </div>
            <div class="row">

                <?php if(!empty($list[tech])): if(is_array($list[tech])): foreach($list[tech] as $k=>$vo): ?><div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="">
                            <div class="team-member">
                                <figure>
                                    <img src="<?php echo ($upWholeUrl); echo ($vo[0]); ?>" alt="Image" class="img-fluid">
                                </figure>
                                <div class="p-3">
                                    <h3><?php echo (msubstr($vo[1],0,24,'utf-8')); ?></h3>
                                    <span class="position"><?php echo (msubstr($vo[2],0,24,'utf-8')); ?></span>
                                </div>
                            </div>
                        </div><?php endforeach; endif; endif; ?>

            </div>
        </div>
    </section>
	 -->

<!--案例-->
<section class="site-section border-bottom" id="gallery-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">案例</h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100"><?php echo ($list["menu_summary"]["cases"]); ?></p>
                </div>
            </div>
            <div class="row">

                <?php if(!empty($list[cases])): if(is_array($list[cases])): foreach($list[cases] as $k=>$vo): ?><div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="">
                            <div class="team-member">
                                <figure>
                                    <img src="<?php echo ($upWholeUrl); echo ($vo[0]); ?>" alt="Image" class="img-fluid">
                                </figure>
                                <div class="p-3">
                                    <h3><?php echo (msubstr($vo[1],0,24,'utf-8')); ?></h3>
                                    <span class="position"><?php echo (msubstr($vo[2],0,24,'utf-8')); ?></span>
                                </div>
                            </div>
                        </div><?php endforeach; endif; endif; ?>

            </div>
        </div>
    </section>
    

    <!--关于我们-->
    <div class="site-section cta-big-image" id="about-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">关于我们</h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100"><?php echo ($list["menu_summary"]["about"]); ?></p>
                </div>
            </div>
            <?php if(!empty($list[about])): ?><div class="row">
                <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                    <figure class="circle-bg">
                        <img src="<?php echo ($upWholeUrl); echo ($list["about"]["picture"]); ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
                    </figure>
                </div>
                
                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

                    <h3 class="text-black mb-4"><?php echo ($list["about"]["title"]); ?></h3>

                    <?php echo (msubstr($list["about"]["content"],0,320,'utf-8')); ?>

                </div>
                
            </div><?php endif; ?>
        </div>
    </div>

<!--    底部-->
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
                                    <font>联系我们：<?php echo ($site["SITE_INFO"]["tel"]); ?>  &nbsp; </font>
                                    <font style="margin-left: 10px;">招商合作：<?php echo ($site["SITE_INFO"]["fax"]); ?></font>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <ul class="list-inline text-center foot-inline">
                <li><a href="#"><?php echo ($site["SITE_INFO"]["icp"]); ?></a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li><?php echo ($site["SITE_INFO"]["version"]); ?></li>
            </ul>
        </div>
    </footer>

</div>

<script type="text/javascript" src="/Public/Home/Js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/jquery-ui.js"></script>
<script type="text/javascript" src="/Public/Home/Js/popper.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/owl.carousel.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/Public/Home/Js/aos.js"></script>
<script type="text/javascript" src="/Public/Home/Js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/jquery.sticky.js"></script>
<script type="text/javascript" src="/Public/Home/Js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/swiper.min.js"></script>
<script type="text/javascript" src="/Public/Home/Js/main.js"></script>

<script>
    document.addEventListener("scroll",function () {
		if ($(this).scrollTop()>0){
			$(".site-logo>a>img").attr("src","/Uploads/Logo/logo2.png")
		}else{
			$(".site-logo>a>img").attr("src","/Uploads/Logo/logo1.png")
		}
	});
	var swiper = new Swiper('#swiper1', {
        autoplay:true,
        loop:true,
        pagination: {
            el: '#swiper1 .swiper-pagination',
        },
    });

    $(document).ready( function(){
        if (window.innerWidth>800){
            new Swiper('#swiper2',{
                slidesPerView: 3,
            });
        }else{
            new Swiper('#swiper2',{
                slidesPerView: 1,
            });
        }
    } );

</script>

</body>
</html>