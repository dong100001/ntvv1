<?php

	$_SGLOBAL['db']->query("update ".tname('happyfarm_mc')." set bad=''");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_mc')." set dabian=0");
	FarmMSG('Xóa phân, muỗi của trang trại thành công. ');

?>