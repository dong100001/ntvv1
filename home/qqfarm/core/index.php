<?php
# More plugins, skin, mod for Discuz, Ucenter Home at http://www.gohooh.com/forum/


include('common.php');
$auth = qf_checkauth(); //检查登录状态

//计划任务
if($_GET['mod'] == 'cron') {
	include("source/cron/run.php");
}

?>