<?php

//��ʾ����
$_PERPAGE = 18; //��Ʒ�б�ÿҳ��ʾ������
$_VPERPAGE = 10; //�����յ���Ʒ��ÿҳ��ʾ����

include_once('./common.php');
include_once(S_ROOT.'./gift/source/common.php');
//�Ƿ�ر�վ��
checkclose();

//����rewrite
if($_SCONFIG['allowrewrite'] && isset($_GET['rewrite'])) {
	$rws = explode('-', $_GET['rewrite']);
	if($rw_uid = intval($rws[0])) {
		$_GET['uid'] = $rw_uid;
	} else {
		$_GET['do'] = $rws[0];
	}
	if(isset($rws[1])) {
		$rw_count = count($rws);
		for ($rw_i=1; $rw_i<$rw_count; $rw_i=$rw_i+2) {
			$_GET[$rws[$rw_i]] = empty($rws[$rw_i+1])?'':$rws[$rw_i+1];
		}
	}
	unset($_GET['rewrite']);
}

//������
$dos = array('index','list','send','view');

//��ȡ����
$isinvite = 0;
$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';

if( @file_exists(S_ROOT."./gift/gift_install.php") ) {
	$do = "install";
}

//�Ƿ񹫿�
if(empty($isinvite) && empty($_SCONFIG['networkpublic'])) {
	checklogin();//��Ҫ��¼
}

//��ȡ�ռ�
if(empty($_SGLOBAL['supe_uid'])) {
	ssetcookie('_refer', rawurlencode($_SERVER['REQUEST_URI']));
	showmessage('to_login', 'do.php?ac=login', 0);
} else {
	$space = getspace($_SGLOBAL['supe_uid']);
}


//���»session
if($_SGLOBAL['supe_uid']) {
	updatetable('session', array('lastactivity' => $_SGLOBAL['timestamp']), array('uid'=>$_SGLOBAL['supe_uid']));
}


//����
include_once(S_ROOT."./gift/gift_{$do}.php");

?>