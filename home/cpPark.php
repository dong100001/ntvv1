<?php

include_once('./common.php');
include_once(S_ROOT.'./source/function_cp.php');
//����ķ���
$acs = array('park','stage');
$ac = (empty($_GET['ac']) || !in_array($_GET['ac'], $acs))?'park':$_GET['ac'];
$op = empty($_GET['op'])?'':$_GET['op'];

//Ȩ���ж�
if(empty($_SGLOBAL['supe_uid'])) {
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		ssetcookie('_refer', rawurlencode($_SERVER['REQUEST_URI']));
	} else {
		ssetcookie('_refer', rawurlencode('cpPark.php?ac='.$ac));
	}
	showmessage('to_login');
}

//�Ƿ�ر�վ��
if(!in_array($ac, array('common', 'pm'))) {
	checkclose();
}

//��ȡ�ռ���Ϣ
$space = getspace($_SGLOBAL['supe_uid']);
if(empty($space)) {
	showmessage('space_does_not_exist');
}

//�˵�
$actives = array($ac => ' class="active"');

include_once(S_ROOT.'./park/cp_'.$ac.'.php');

?>