/* 轮播图 */
new Swiper('#swiper1', {
    // autoplay: true,
    // loop: true
});
new Swiper('#swiper2', {
    // autoplay: true,
    // loop: true
});
new Swiper('#swiper3', {
    // autoplay: true,
    // loop: true
});
/* 获取滚动事件 */
let innerWidth = window.innerWidth;
if (innerWidth > 414) {
    $('.gongneng').removeClass('gongnengActive')
    $(window).scroll(function (){
        var st = $(this).scrollTop();
        if (st >= 560) {
            $('.hrefList').addClass('sticky');
            $('.returnTop').css({'display': "block"})
        } else {
            $('.returnTop').css({'display': "none"})
            $('.hrefList').removeClass('sticky');
        }
    });
} else {
    $('.gongneng').addClass('gongnengActive')
    $(window).scroll(function (){
        var st = $(this).scrollTop();
        if (st >= 230) {
            $('.hrefList').addClass('sticky');
            $('.returnTop').css({'display': "block"})
        } else {
            $('.returnTop').css({'display': "none"})
            $('.hrefList').removeClass('sticky');
        }
    });
}


/* 返回顶部 */
$(".returnTop").click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 500);
    return false;
});


/* 点击a标签时添加动画滚动 */
$(".scroll").bind("click touch",function(){
    //根据a标签的href转换为id选择器，获取id元素所处的位置
    $('html,body').animate({scrollTop: ($($(this).attr('href')).offset().top)},1000);
});