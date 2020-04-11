<?php

# QFarm System Config [QSC]
# Create by seaif@zealv.com


//QSC初始化
is_array($_QSC) || $_QSC = array();

//功能控制开关
$_QSC['apiType'] = 'uchome';//接口类型
$_QSC['friendType'] = 2;//好友列表类型[1:默认好友,2:全站好友]
$_QSC['missionName'] = '0520';//当前活动[填写活动名称,留空则关闭]

//头像参数
$_QSC['avatarReal'] = 0;//使用真实头像[0:关|1:开]
$_QSC['avatarStatic'] = 0;//静态调用头像[0:关|1:开]

//VIP偷菜
$_QSC['vip'] = 0;//VIP偷菜[0:关|1:开]

//模板参数
$_QSC['view']['tplId'] = 'qf_default';//模板名
$_QSC['view']['tplDir'] = 'view/';//模板根目录
$_QSC['view']['cplDir'] = 'data/view/';//编译目录
$_QSC['view']['tplBak'] = 'view/qf_default/';//备用模板
$_QSC['view']['player'] = 1; //音乐播放器[0:关|1:百度播放器]

//Cookie参数
$_QSC['cookie']['prefix'] = 'qqfarm_';//Cookie前缀
$_QSC['cookie']['domain'] = '';//Cookie作用域
$_QSC['cookie']['path'] = '/';//Cookie作用路径

//管理员列表
$_QSC['adminer'] = array(1);//格式为数组

//农场关闭
$_QSC['closefarm'] = 1;//[0:关|1:开]
$_QSC['closeinfo'] = 'Thông báo：<br /><br />　　Nông trại tạm thời đóng cửa, bạn có thể vào http://www.gohooh.com/ để thư giãn.';//关闭农场说明

?>