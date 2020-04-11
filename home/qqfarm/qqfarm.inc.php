<?php

# More plugins, skin, mod for Discuz, Ucenter Home at http://www.gohooh.com/forum/

realname_set($_SGLOBAL['supe_uid'], $_SGLOBAL['supe_username']);
realname_get();

define('FARM_ROOT', str_replace('\\', '/', dirname(__file__)));
if(!@include(FARM_ROOT . '/core/data/_qsc.php')) {
	@include(FARM_ROOT . '/core/config/_qsc.php');
}

$qf_root = 'qqfarm';
$qf_charset = $_SC['charset'] == 'gbk' ? 'gbk' : 'utf-8';
include template($qf_root . '/template/qqfarm.' . $qf_charset);

?>