<?php
include_once './park/ClassParkInfo.php';
//ʵ��
realname_get();
//��ȡ��ǰ�û��Ŀռ���Ϣ
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