<?php

# 管理首页

$farmTest = array();

//版本检查
$VERScript = '?p=QFarm&v=' . FARM_VERSION . '&' . rand();
$farmTest['农场版本号'][0] = FARM_VERSION;
$farmTest['农场版本号'][1] = <<<TPL
	<script type="text/javascript" src="http://version.phpye.com/{$VERScript}"></script>
TPL;

//环境检查
$farmTest['服务器平台'][0] = PHP_OS . ' / PHP v' . PHP_VERSION;
$farmTest['数据库版本'][0] = mysql_get_server_info();
if(function_exists('json_encode') && function_exists('json_decode')) {
	$farmTest['Json函数库'][0] = true;
	if(@version_compare(PHP_VERSION, '5.2.0', '<')) {
		$farmTest['Json函数库'][1] = "(由PEAR支持,可能存在缺陷)";
	}
} else {
	$farmTest['Json函数库'][0] = false;
}

qf_getView("admin/home");

?>