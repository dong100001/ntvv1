<?php

	$id = intval($_GET['id']);
	if($id == 0) {
		die('2|&|参数错误.');
	}

	if($_GET['op']=='save') {
		$vip = intval($_REQUEST['vip']);
		$nc_reclaim = intval($_REQUEST['nc_reclaim']);
		if($nc_reclaim >18){
			$nc_reclaim = 18;
		}
		$query = $_SGLOBAL['db']->query( "SELECT Status, reclaim  FROM  ".tname( "happyfarm_nc" )." where uid=".$id);
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$Status = json_decode( $list[0][Status] );
		if($nc_reclaim > $list[reclaim]){ 
			$Status->farmlandstatus = array_values($Status->farmlandstatus);//修复数据
			for($ii=count($Status->farmlandstatus); $ii<$nc_reclaim;$ii++){
				$Status->farmlandstatus[$ii] = json_decode("{\"a\":0,\"b\":0,\"c\":0,\"d\":0,\"e\":1,\"f\":0,\"g\":0,\"h\":1,\"i\":100,\"j\":0,\"k\":0,\"l\":0,\"m\":0,\"n\":[],\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725}");
			}
		}
		foreach ( $Status->farmlandstatus as $k => $v ){
			if( $k >= $nc_reclaim ){
				unset($Status->farmlandstatus[$k]);
			}
		}
		$nc_exp = intval($_REQUEST['nc_exp']);
		$mc_exp = intval($_REQUEST['mc_exp']);
		$money = intval($_REQUEST['money']);
		$YB = intval($_REQUEST['YB']);
		$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_config')." set YB=".$YB.",vip=".$vip.",money=".$money." where uid=".$id);
		$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set exp=".$nc_exp.",reclaim=".$nc_reclaim.", Status='".json_encode($Status)."' where uid=".$id);
		$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set exp=".$mc_exp." where uid=".$id);
		if(intval($_REQUEST['nc_reclaim'])>18){
			die('1|&|修改用户UID：'.$id.'的信息成功,由于农田数目大于18,系统已默认将农田数目修改为18.');
		} else {
			die('1|&|修改用户UID：'.$id.'的信息成功. ');
		}
	}
	else {
		$ncvalue = $mcvalue = $allvalue = array();
		$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname("happyfarm_nc")." where uid=".$id);
		while($value = $_SGLOBAL['db']->fetch_array($query)) {
			$ncvalue = $value;
		}
		$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname("happyfarm_mc")." where uid=".$id);
		while($value = $_SGLOBAL['db']->fetch_array($query)) {
			$mcvalue = $value;
		}
		$query = $_SGLOBAL['db']->query("SELECT a.*,b.username,b.name as truename FROM (".tname("happyfarm_config")." a LEFT JOIN ".tname('space')." b ON a.uid=b.uid) where a.uid=".$id);
		while($value = $_SGLOBAL['db']->fetch_array($query)) {
			$allvalue = $value;
		}
		$ncvalue['expexp'] = getstr(number_format((sqrt(($ncvalue['exp']-$ncvalue['exp']%200)/100+0.25)-0.5), 0, ".", ""),0);
		$mcvalue['expexp'] = getstr(number_format((sqrt(($mcvalue['exp']-$mcvalue['exp']%200)/100+0.25)-0.5), 0, ".", ""),0);
		include(template("happyfarm/view/admin/edit"));
	}

?>