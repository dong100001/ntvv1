<?php

# 单个卖出

$fruit = $_QFG['db']->result("SELECT fruit FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$fruit = qf_decode($fruit);
$number = (int)$_REQUEST['number'];
$cid = (int)$_REQUEST['cId'];
if($fruit[$cid] < $number) {
	die('{"cId":0,"code":0,"direction":"请确认数值！"}');
}

$fruit[$cid] -= $number;
foreach($fruit as $key => $value) {
	if($value == 0) {
		unset($fruit[$key]);
	}
}
$_QFG['db']->query("UPDATE app_qqfarm_user set money=money+" . $cropstype[$cid][sale] * $number . " where uid=" . $_QFG['uid']);
$_QFG['db']->query("UPDATE app_qqfarm_nc set fruit='" . qf_encode($fruit) . "' where uid=" . $_QFG['uid']);


//出售日志
$_QFG['db']->query("INSERT INTO app_qqfarm_nclogs (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread`) VALUES (" . $_QFG['uid'] . ", 6, " . $number . ", " . $_QFG['uid'] . ", " . $_QFG['timestamp'] . ", " . $cid . ", 1);");

echo '{"cId":' . $cid . ',"code":1,"direction":"成功卖出<font color=\"#0099FF\"> <b>' . $number . '<\/b> <\/font>个' . $cropstype[$cid]['cName'] . '，得到金币<font color=\"#FF6600\"> <b>' . $cropstype[$cid]['sale'] * $number . '<\/b> <\/font>","money":' . $cropstype[$cid]['sale'] * $number . '}';

qf_addFeed('farmlandstatus_sale');

?>