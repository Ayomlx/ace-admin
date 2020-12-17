<?php
//$config_arr1 = include_once APP_PATH . 'Common/Conf/config.php';
$DB_PREFIX = C('DB_PREFIX');
return array(
    
    'PAGE_SIZE' =>13,//分页数量
    
    /*
     * 以下是关于广告图片配置
     */
    'ADV_PICPATH'=>'Advertising',//广告图片上传路径（相对于根路径下）
    'ADV_MAX_WIDTH'=>'1400',//广告图片最大宽度
    'ADV_MAX_HEIGHT'=>'700',//广告图片最大高度
    /*
     * 以下是关于editor文章图片上传配置
     */
    'ART_MAX_WIDTH'=>'1000',//广告图片最大宽度
    /*
     * 以下是关于分类图标图片上传配置
     */
    'CATE_PICPATH'=>'Category',//分类图标上传路径（相对于根路径下）
    'CATE_ICO_WIDTH'=>'100',//分类图标宽度
    'CATE_ICO_HEIGHT'=>'100',//分类图标高度

    /*
     * 以下是关于友情链接图标图片上传配置
     */
    'LINK_PICPATH'=>'Link',//友情链接图标上传路径（相对于根路径下）
    'LINK_ICO_WIDTH'=>'128',//友情链接图标宽度
    'LINK_ICO_HEIGHT'=>'48',//友情链接图标高度
	
	/*
     * 以下是关于我们图标图片上传配置
     */
    'ABOUT_PICPATH'=>'About',//关于我们图标上传路径（相对于根路径下）
    'ABOUT_ICO_WIDTH'=>'240',//关于我们图标宽度
    'ABOUT_ICO_HEIGHT'=>'158',//关于我们图标高度
	
	/*
     * 以下是网站LOGO上传配置
     */
    'LOGO_PICPATH'=>'Logo',//网站LOGO上传路径（相对于根路径下）
    'LOGO_ICO_WIDTH'=>'160',//网站LOGO宽度
    'LOGO_ICO_HEIGHT'=>'48',//网站LOGO高度

    /*
     * 以下是关于文章标题图片上传配置
     */
    'ARTICLE_PICPATH'=>'Article',//文章图标上传路径（相对于根路径下）
    'ARTICLE_ICO_WIDTH'=>'590',//文章图标宽度
    'ARTICLE_ICO_HEIGHT'=>'330',//文章图标高度

    //以下是关于产品标题图片上传配置
    'PRODUCT_PICPATH'=>'Product',//文章图标上传路径（相对于根路径下）
    'PRODUCT_ICO_WIDTH'=>'120',//文章图标宽度
    'PRODUCT_ICO_HEIGHT'=>'120',//文章图标高度
	
	//以下是关于技术团队/案例标题图片上传配置
    'TEAMCASE_PICPATH'=>'Teamcase',//技术团队/案例图标上传路径（相对于根路径下）
    'TEAMCASE_ICO_WIDTH'=>'120',//技术团队/案例图标宽度
    'TEAMCASE_ICO_HEIGHT'=>'120',//技术团队/案例图标高度
	
	/*
	 * 以下是网站图片上传配置
	 */
	'INDEX_PICPATH'=>'Index',

    /*
     * 以下是RBAC认证配置信息
     */
    'USER_AUTH_ON' => true,
    'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
//    'ADMIN_AUTH_KEY' => '1772703372@qq.com',
    'USER_AUTH_MODEL' => 'Admin', // 默认验证数据表模型
    'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式encrypt
    'USER_AUTH_GATEWAY' => '/admin/Public/index', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Public,Upload', // 默认无需认证模块
    'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
    'NOT_AUTH_ACTION' => 'search,getcate,getFilt,getExtends,checkNewsTitle,goodPicOrder,del_pic,cutview,cutoper,delIco,order_filtrate,getChild,order_fields,onOff_fields,region_fields,region,sort,order_advertising,forbid,order_navigation,search_special,del_specpic,search_meeting,del_meetpic,search_sms', // 默认无需认证操作
    'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
    'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
    'GUEST_AUTH_ID' => 0, // 游客的用户ID
    'RBAC_ROLE_TABLE' => $DB_PREFIX . 'role',
    'RBAC_USER_TABLE' => $DB_PREFIX . 'role_user',
    'RBAC_ACCESS_TABLE' => $DB_PREFIX . 'access',
    'RBAC_NODE_TABLE' => $DB_PREFIX . 'node',

    'LOCK_ID'=>array(
        'link'=>'1,2,3',
        'article'=>'1,2,3',
        'goods'=>'1,2,3',
        'art_sun'=>'1,2,3'
        ),
    /*
     * 系统备份数据库时每个sql分卷大小，单位字节
     */
    'sqlFileSize' => 5242880, //该值不可太大，否则会导致内存溢出备份、恢复失败，合理大小在512K~10M间，建议5M一卷
        //10M=1024*1024*10=10485760
        //5M=5*1024*1024=5242880
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public',
        '__IMG__'    => __ROOT__ . '/Public/Admin/Img',
        '__CSS__'    => __ROOT__ . '/Public/Admin/Css',
        '__JS__'     => __ROOT__ . '/Public/Admin/Js',
        '--PUBLIC--'=>__ROOT__ . '/Public',
        '__WEBSOCKET__'=>__ROOT__ . '/Public/WebSocketMain'
    ),
);

//return array_merge($config_arr1, $config_arr2);
?>