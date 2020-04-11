<?php

	//分页
	$perpage = 24;
	$page = empty($_GET['page']) ? 1 : intval($_GET['page']);
	if($page < 1) $page = 1;
	$start = ($page-1)*$perpage;
	//检查开始数
	ckstart($start, $perpage);
	//处理查询
	$theurl = "admin.php?do=list";
	$happyfarm_config_list = array();
	$count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('happyfarm_config')." "), 0);
	if($count) {
		$query = $_SGLOBAL['db']->query(
			"SELECT s.*, sf.*,c.exp as exp1,c.reclaim,d.exp as exp2 FROM (((".tname('happyfarm_config')." s
			LEFT JOIN ".tname('space')." sf ON sf.uid=s.uid)
			LEFT JOIN ".tname('happyfarm_nc')." c ON c.uid=s.uid)
			LEFT JOIN ".tname('happyfarm_mc')." d ON d.uid=s.uid)    
			order by s.id asc LIMIT $start,$perpage"
		);
		while($value = $_SGLOBAL['db']->fetch_array($query)) {
			$value['nc_exp'] = getstr(number_format((sqrt(($value['exp1']-$value['exp1']%200)/100+0.25)-0.5), 0, ".", ""), 0);
			$value['mc_exp'] = getstr(number_format((sqrt(($value['exp2']-$value['exp2']%200)/100+0.25)-0.5), 0, ".", ""), 0);
			$happyfarm_config_list[] = $value;
		}
		$multi = multi($count, $perpage, $page, $theurl);
	}
	include(template("happyfarm/view/admin/list"));

?>