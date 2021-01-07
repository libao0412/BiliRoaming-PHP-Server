<?php

// 模块请求都会带上X-From-Biliroaming的请求头，为了防止被盗用，可以加上请求头判断
$headerStringValue = $_SERVER['HTTP_X_FROM_BILIROAMING'];
if ($headerStringValue==""){
    header('Content-Type: application/json; charset=utf-8');
    echo '{"code":-10403,"message":"抱歉您所在地区不可观看"}';
    exit();
}

// 转发到b站服务器
$url = "https://api.global.bilibili.com/intl/gateway/v2/ogv/playurl?".$_SERVER['QUERY_STRING'];
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,false); 
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($ch);
curl_close($ch);
print($output);
?>