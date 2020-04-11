<?php

	$id = intval($_GET['id']);
	if($id == 0) {
		die('1|&|参数错误. ');
	}

	$_SGLOBAL['db']->query("DELETE FROM ".tname('happyfarm_config')." WHERE uid=".$id);
	$_SGLOBAL['db']->query("DELETE FROM ".tname('happyfarm_nc')." WHERE uid=".$id);
	$_SGLOBAL['db']->query("DELETE FROM ".tname('happyfarm_mc')." WHERE uid=".$id);
	$_SGLOBAL['db']->query("DELETE FROM ".tname('happyfarm_mclogs')." WHERE uid=".$id);
	die('1|&|删除UID为'.$id.'的用户的农牧场成功.|&|refresh');

?>