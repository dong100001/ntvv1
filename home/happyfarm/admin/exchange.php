<?php

	$_SGLOBAL['db']->query("update ".tname('happyfarm_config')." set exchange='{\"cost\":[]}'");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set log=''");
	FarmMSG('清理用户消费和日志成功. ');

?>