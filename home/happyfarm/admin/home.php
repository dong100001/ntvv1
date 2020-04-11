<?php

$go = $_GET['go'];

if($go == "bed") {
	$_SGLOBAL['db']->query("update ".tname('happyfarm_mc')." set bad=''");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_mc')." set dabian=0");
	die('1|&|修复牧场成功.');
}
if($go == "exchange") {
	$_SGLOBAL['db']->query("update ".tname('happyfarm_config')." set exchange='{\"cost\":[]}'");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set log=''");
	die('1|&|清理日志成功.');
}
if($go == "healthmode"){
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set healthmode='{\"beginTime\":0,\"canClose\":1,\"date\":\"1970-01-01|1970-01-07\",\"endTime\":0,\"serverTime\":1266900062,\"set\":0,\"time\":\"08|00\",\"valid\":0}'");	
	die('1|&|修复健康模式成功.');
}
if($go == "farmland"){
	$query = $_SGLOBAL['db']->query( "SELECT uid, Status, reclaim  FROM  ".tname( "happyfarm_nc" ));
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}

	foreach($list as $key=>$value){
		$Status = json_decode( $value[Status] );
		//是否数组?
		if(!is_array($Status->farmlandstatus)){
			if(count($Status->farmlandstatus)<$value[reclaim]) {
				for($ii=count($Status->farmlandstatus); $ii<$value[reclaim];$ii++){
					$Status->farmlandstatus[$ii] = json_decode("{\"a\":0,\"b\":0,\"c\":0,\"d\":0,\"e\":1,\"f\":0,\"g\":0,\"h\":1,\"i\":100,\"j\":0,\"k\":0,\"l\":0,\"m\":0,\"n\":[],\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725}");
				}
			}
		}
		$Status->farmlandstatus = array_values($Status->farmlandstatus);//修复数据
		foreach ( $Status->farmlandstatus as $k => $v ){
			if( $k >= $value[reclaim] ){
				unset($Status->farmlandstatus[$k]);
			}
		}

		if(count($Status->farmlandstatus)<$value[reclaim]) {
			for($ii=count($Status->farmlandstatus); $ii<$value[reclaim];$ii++){
				$Status->farmlandstatus[$ii] = json_decode("{\"a\":0,\"b\":0,\"c\":0,\"d\":0,\"e\":1,\"f\":0,\"g\":0,\"h\":1,\"i\":100,\"j\":0,\"k\":0,\"l\":0,\"m\":0,\"n\":[],\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725}");
			}
		}
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".json_encode($Status)."' where uid=".$value[uid] );
	}
	die('1|&|修复农田成功.');
}
if($go == "weeb") {
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set weed='{}'");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set pest='{}'");
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set package=(REPLACE(package,'[','{')), package=(REPLACE(package,']','}')), fruit=(REPLACE(fruit,'[','{')), fruit=(REPLACE(fruit,']','}')), tools=(REPLACE(tools,'[','{')), tools=(REPLACE(tools,']','}'))");
	die('1|&|修复农场成功.');
}
else {
	include(template("happyfarm/view/admin/home"));
}

?>