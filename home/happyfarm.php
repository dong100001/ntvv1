<?php
# QQfarm
# Modify by http://www.gohooh.com

include_once("happyfarm/common.php" );

checkclose();
checklogin();

//要求实名认证
if(FARM_REALNAME && $_SCONFIG['realname'] && empty($_SGLOBAL['member']['namestatus'])) {
	showmessage('no_privilege_realname');
}

include(template("happyfarm/view/happyfarm"));

?>