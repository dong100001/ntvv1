<?php
include_once './park/ClassParkInfo.php';
//实名
realname_get();
//获取当前用户的空间信息
$space = getspace($_SGLOBAL['supe_uid']);
$ac=empty($_GET[ac])?"help":$_GET[ac];
$parkCfg=new CParkCfg();
$cfgColor = $parkCfg->cfgColor;
$cfgCarType = $parkCfg->cfgCarType;
$cfgCarLevel =$parkCfg->cfgCarLevel;
$cfgStopLimit=$parkCfg->cfgStopLimit;
$driveCredit=$cfgStopLimit[maxStopTime]*$cfgStopLimit[DriveCredit];
include_once( template( "park/view/park_help" ));
?>