﻿<?php
/*
  $ 2009-5-1����05:09:57 tomyguan $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//Ȩ��
if(!$allowmanage = checkperm('admin')) {
	showmessage('Yêu cầu không hợp lệ');
}

if(submitcheck('deletesubmit')) {	
	if(!empty($_POST['ids']) && deletewishes($_POST['ids'])) {
		showmessage('Xóa thành công!', "wishApp.php?do=index&view=list");
	} else {
		showmessage('Chưa xóa được, hjc ha!', "wishApp.php?do=index&view=list");;
	}
}

//ɾ��
function deletewishes($wishids) {
	global $_SGLOBAL;

	//��ȡ��Ը��Ϣ
	$wishes = $newwishids = array();
	$allowmanage = checkperm('admin');
	$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." WHERE id IN (".simplode($wishids).")");
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		if($allowmanage) {
		    $wishes[] = $value;
			$newwishids[] = $value['id'];
		}
	}
	if(empty($newwishids)) return array();
	
	//����ɾ��
	$_SGLOBAL['db']->query("DELETE FROM ".tname('wish_content')." WHERE id IN (".simplode($newwishids).")");
	
	//ɾ����̬
		
	return $wishes;
}

?>