<?php

if (!defined('THINK_PATH'))
    exit();
// 系统别名定义文件
return array(
    'PHPMailer' => APP_PATH . 'Common/Extend/PHPMailer/phpmailer.class.php',
    'CheckCode' => APP_PATH . 'Common/Extend/CheckCode/Checkcode.class.php',
    'QRCode' => APP_PATH . '/Common/Extend/QRCode.class.php',
    'Category' => APP_PATH . '/Common/Extend/Category.class.php',
);