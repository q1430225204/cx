<?php defined('IN_DESTOON') or exit('Access Denied'); return array ('chinapay' => array ('percent' => '1','partnerid' => '','order' => '0','name' => '中国银联','enable' => '0',),'chinabank' => array ('percent' => '1','keycode' => '','partnerid' => '','order' => '1','name' => '网银在线','enable' => '0',),'alipay' => array ('percent' => '1','notify' => 'notify.php','service' => 'create_direct_pay_by_user','keycode' => '','partnerid' => '','email' => '','order' => '2','name' => '支付宝','enable' => '0',),'tenpay' => array ('percent' => '1','keycode' => '','order' => '3','partnerid' => '0','name' => '财付通','enable' => '0',),'paypal' => array ('percent' => '0','currency' => 'USD','partnerid' => '','order' => '4','name' => '贝宝','enable' => '0',),'yeepay' => array ('percent' => '1','keycode' => '','partnerid' => '','order' => '4','name' => '易宝支付','enable' => '0',),); ?>