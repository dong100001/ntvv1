<?php

	$_SGLOBAL['db']->query("update ".tname('happyfarm_config')." set exchange='{\"cost\":[]}'");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set log=''");
	FarmMSG('�����û����Ѻ���־�ɹ�. ');

?>