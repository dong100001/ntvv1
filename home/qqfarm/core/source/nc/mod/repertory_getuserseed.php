<?php

# 用户背包

$list = $_QFG['db']->fetchOne("SELECT package,tools FROM app_qqfarm_nc where uid=" . $_QFG['uid']);

$package = qf_decode($list['package']);
foreach($package as $key => $value) {
	$hour = ($cropstype[$key]['growthCycle']) / 3600;
	if(0 < $value) {
		$packagearr[] = '{"type":1,"cId":' . $key . ',"cName":"' . $cropstype[$key]['cName'] . '","amount":' . $value . ',"lifecycle":' . $hour . ',"level":' . $cropstype[$key]['cLevel'] . '}';
	}
}

$tools = qf_decode($list['tools']);
foreach($tools as $key => $value) {
	if(0 < $value && $key < 500) {
		$packagearr[] = '{"type":3,"tId":' . $key . ',"tName":"' . $toolstype[30000 + $key]['tName'] . '","amount":' . $value . ',"depict":"' . $toolstype[30000 + $key]['depict'] . '"}';
	}
}

echo '[' . implode(',', (array)$packagearr) . ']';

?>