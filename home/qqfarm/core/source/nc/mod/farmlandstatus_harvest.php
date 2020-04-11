<?php

# 作物收获 

qf_getCache('cropstime', '/nc/');;

$list = $_QFG['db']->fetchOne("SELECT status,fruit,package,tools,dog,exp,repertory FROM app_qqfarm_nc where uid=" . $_QFG['uid']);

$status = qf_decode($list['status']);
$fruit = qf_decode($list['fruit']);
$package = qf_decode($list['package']);
$tools = qf_decode($list['tools']);
$dog = qf_decode($list['dog']);
$exp = $list['exp'];
$repertory = qf_decode($list['repertory']);

$place = explode(",", $_REQUEST['place']);
$exp_str = 0;
foreach($place as $id) {
	$cid = $status[$id]['a'];
	if($cid == 0 || $status[$id]['b'] != 6) {
		exit;
	}
	if($status[$id]['j'] >= 0 && $_QFG['timestamp']-$status[$id]['q'] < $cropstime[$status[$id]['a']][4]) {
		exit;
	}
	$output = $status[$id]['m'];
	$fruit[$cid] = $fruit[$cid] + $output;
	$harvest = $status[$id]['m'];
	$status[$id]['c'] = 0;
	$status[$id]['d'] = 0;
	$status[$id]['e'] = 1;
	$status[$id]['f'] = 0;
	$status[$id]['g'] = 0;
	$status[$id]['h'] = 1;
	$status[$id]['i'] = 100;
	$status[$id]['k'] = 0;
	$status[$id]['l'] = 0;
	$status[$id]['m'] = 0;
	$status[$id]['n'] = array();
	$status[$id]['o'] = 0;
	$status[$id]['p'] = array();
	$status[$id]['q'] = 0;
	$status[$id]['r'] = $_QFG['timestamp'];
	if($status[$id]['j'] + 1 == $cropstype[$status[$id]['a']]['maturingTime']) {
		$status[$id]['b'] = 7;
		$status[$id]['j'] = 0;
	} else {
		$status[$id]['b'] = 6;
		$status[$id]['j'] = $status[$id]['j'] + 1;
		$status[$id]['q'] = $_QFG['timestamp'] - $cropstime[$status[$id]['a']][2];
	}
	$status[$id]['bitmap'] = (int)$status[$id]['bitmap'];
	$status[$id]['pId'] = (int)$status[$id]['pId'];
	$exp_str += $cropstype[$status[$id]['a']]['cropExp'];
	$exp_arr = $exp + $cropstype[$status[$id]['a']]['cropExp'];
	//当前活动红包
	if($_QSC['missionName']) {
		@include("source/nc/mission/{$_QSC['missionName']}_gift.php");
	}
	//升级提示
	$levelup = $_QFG['db']->result("SELECT levelup FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
	$levelup_arr = 'false';
	if($exp_arr >= $levelup && $levelup < 93001) {
		include("source/nc/plus/levelup.php"); //升级提示
	}
	$echo_str[] = '{"code":1,"direction":"","levelUp":' . $levelup_arr . ',"exp":' . $cropstype[$status[$id]['a']][cropExp] . ',"farmlandIndex":' . $id . ',' . $red_gift . '"harvest":' . $harvest . ',"poptype":4,"status":{"cId":' . $status[$id]['a'] . ',"cropStatus":' . $status[$id]['b'] . ',"fertilize":' . $status[$id]['o'] . ',"harvestTimes":' . $status[$id]['j'] . ',"oldweed":' . $status[$id]['c'] . ',"oldpest":' . $status[$id]['d'] . ',"oldhumidity":' . $status[$id]['e'] . ',"weed":' . $status[$id]['f'] . ',"pest":' . $status[$id]['g'] . ',"humidity":' . $status[$id]['h'] . ',"killer":' . qf_jsonCode($status[$id]['i']) . ',"output":' . $status[$id]['k'] . ',"min":' . $status[$id]['l'] . ',"leavings":' . $status[$id]['m'] . ',"thief":{},"action":' . qf_jsonCode($status[$id]['p']) . ',"plantTime":' . $status[$id]['q'] . ',"updateTime":' . $status[$id]['r'] . ',"bitmap":' . $status[$id]['bitmap'] . ',"pId":' . $status[$id]['pId'] . '}}';
	$flag = false;
	foreach((array)$repertory as $key => $val) {
		if($cid == $val['cId']) {
			$flag = true;
			$repertory[$key]['harvestNumber'] = $repertory[$key]['harvestNumber'] + $output;
		}
	}
	if(!$flag) {
		$repertory[] = array('cId'=>$cid,'harvestNumber'=>$output,'scroungeNumber'=>0);
	}
}
$_QFG['db']->query("UPDATE app_qqfarm_nc set status='" . qf_encode(array_values($status)) . "', exp=exp+".$exp_str." ,fruit='" . qf_encode($fruit) . "',package='" . qf_encode($package) . "', repertory='" . qf_encode($repertory) . "' ,tools='" . qf_encode($tools) . "',dog='" . qf_encode($dog) . "' where uid=" . $_QFG['uid']);


echo '[' . implode(',', $echo_str) . ']';

qf_addFeed('farmlandstatus_harvest');

?>