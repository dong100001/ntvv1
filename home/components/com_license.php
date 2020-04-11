<?php
/*
	Game siêu thị bạn bè được phát triển bởi GoHooH.CoM
	Vui lòng giữ bản quyền Việt hóa của GoHooH.Com
	Cám ơn bạn đã sử dụng sản phẩm của GoHooH.CoM
*/

include_once('./common.php');
include_once(S_ROOT.'./components/shared/function_common.php');

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if(empty($_SGLOBAL['supe_uid'])) {
        showmessage('to_login');
}

$op = $_GET[op];

if(empty($op)){
	$license = "SELECT * FROM ".tname('com_licenses');
	$query = $_SGLOBAL['db']->query($license);
	WHILE($value = $_SGLOBAL['db']->fetch_array($query)){
		$licenses[] = $value;
	}
}

if($_POST[submitsetup]){
	foreach($_POST['id'] as $id => $value){
		$setstr="";

		if(!empty($_POST['name'][$id])){ $setstr .= "`name` = '".$_POST['name'][$id]."', "; }
		if(!empty($_POST['key'][$id])){ $setstr .= "`key` = '".$_POST['key'][$id]."', "; }

		$setstr = substr($setstr, 0, -2);
		$query = "UPDATE ".tname('com_licenses')." SET $setstr WHERE id=".$id;
		$_SGLOBAL['db']->query($query);
	}

	if(!empty($_POST[newname]) && !empty($_POST[newkey]) ){
		inserttable('com_licenses', array('name'=>$_POST[newname], 'key' => $_POST[newkey]));
	}

	showmessage('Lưu thành công', 'sieuthigoer.php?com=license', 3);
}

include template('com_license');
?>