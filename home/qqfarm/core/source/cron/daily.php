<?php

# 每天(0点)要执行的任务
# Modify by seaif@zealv.com

//限制每天放草、放虫共50次,除草、杀虫共150次、小丑任务3次
$_QFG['db']->query("UPDATE app_qqfarm_nc set badnum=50,zong=150,chris=3");

//限制每天放蚊子25只,打蚊子100只,喂养萝卜30个
$_QFG['db']->query("UPDATE app_qqfarm_mc set badnum=25,zong=100,sfeedleft=30"); 

//VIP升级&每天礼包
$vipgift = true;
include('source/cron/vip.php');

?>