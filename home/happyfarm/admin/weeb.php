<?php

	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set weed='{}'");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set pest='{}'");
	FarmMSG('初始化用户放草、虫记录成功. ');

?>