<?php

//ÿ��(0��)Ҫ��ʼ�����ֶΣ�

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set badnum=50");//�Ųݡ�����
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set zong=0 ");//����150��ɱ�ݡ�����
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set sfeedleft=30");//ι��30���ܲ�
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set zong=0 ");//���ƴ�100ֻ����
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set badnum=0");//������25ֻ
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set nc_d=1");//ÿ�����

?>
