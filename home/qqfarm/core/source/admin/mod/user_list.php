<?php

//分页参数
$psize = 25;
$pid = intval($_GET['pid']);
$pid = $pid < 1 ? 1 : $pid;
$start = ($pid - 1) * $psize;

//处理查询
$purl = "admin.php?mod=user_list";
$user_list = array();
$count = $_QFG['db']->result("SELECT COUNT(*) FROM app_qqfarm_user");
if($count) {
	$lists = $_QFG['db']->fetchAll(
		"SELECT s.*,c.exp as exp_nc,c.reclaim,c.redland,d.exp as exp_mc FROM(
			(app_qqfarm_user s
				LEFT JOIN app_qqfarm_nc c ON c.uid=s.uid
			) LEFT JOIN app_qqfarm_mc d ON d.uid=s.uid
		) order by s.uid asc LIMIT {$start},{$psize}"
	);
	foreach($lists as $value) {
		$value['level_nc'] = qf_toLevel($value['exp_nc']);
		$value['level_mc'] = qf_toLevel($value['exp_mc']);
		$value['visittime'] = date("Y-m-d",($value['visittime']));
		$value['vip'] = qf_decode($value['vip']);
		$value['vip']['level'] = qf_toVipLevel($value['vip']['exp'], $value['vip']['status']);
		$user_list[] = $value;
	}
}

qf_getView("admin/user_list");

?>