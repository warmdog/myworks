<?php 
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxd5ac9358a3855640&secret=22df116c8436933bbc38af7b0aa31029";
$output_online=file_get_contents($url);
$jsonstr=json_decode($output_online,true);
//设置token为cookie 
$access_token=$jsonstr['access_token'];
echo $access_token;