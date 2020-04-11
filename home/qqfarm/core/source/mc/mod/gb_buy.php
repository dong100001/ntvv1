<?php

# Y币购买

$value = $_QFG['db']->fetchOne("SELECT yb,vip FROM app_qqfarm_user where uid=" . $_QFG['uid']);
$fb = (int)$value['yb'];
$vip = qf_decode($value['vip']);
$activeitem = $_REQUEST['payitem'];
list($ai, $number) = explode("-", $activeitem);

$type = intval($ai / 10000);


if($type == 7) {
	
	$fertarr = $_QFG['db']->result("SELECT tools FROM app_qqfarm_mc where uid=" . $_QFG['uid']);
	$fertarr = qf_decode($fertarr);
	$wid = $ai-70000;
	if($vip['status']) {
		$buy_fb = $toolstype[$wid]["yqdprice"] * $number;
	} else {
		$buy_fb = $toolstype[$wid]["qdprice"] * $number;
	}

	$name = $toolstype[$wid]['name'];
	if($buy_fb == 0) {
		die('{"code":50,"payresultcode":0,"payerrorcode":0,"msg":"系统出错啦，请刷新以后重试！","payqb":0,"payqp":0,"dnaurl":""}');
	}
	if($fb < $buy_fb) {
		die('{"code":50,"payresultcode":0,"payerrorcode":0,"msg":"余额不足,请先充值","payqb":0,"payqp":0,"dnaurl":""}');
	}
	

	$fertarr[$wid] = $fertarr[$wid] + $number;

	$_QFG['db']->query("UPDATE app_qqfarm_mc set tools='" . qf_encode($fertarr) . "' where uid=" . $_QFG['uid']);
	$_QFG['db']->query("UPDATE app_qqfarm_user set yb=" . ($fb-$buy_fb) . " where uid=" . $_QFG['uid']);


//消费日志
$values = $_QFG['db']->fetchAll("SELECT * FROM app_qqfarm_mclogs WHERE uid = " . intval($_QFG['uid']) . " AND type = 11 AND time > " . ($_QFG['timestamp'] - 3600) . " AND fromid =" . $_QFG['uid']);
foreach($values as $value) {
	if (($value['type'] == 11) && ($value['fromid'] == $_QFG['uid']) && ($number > 0)) {
		$list = $value['iid'];
		$money = $value['money'];
		$scount = $value['count'];
		$stime = $value['time'];
		$sy=explode(",",$list);
		$ct=explode(",",$scount);
		if(in_array(($activeitem+10000),$sy)){
			for($i=0;$i<count($sy);$i++){
				if($sy[$i]==($activeitem+10000)){
					$ct[$i] = $ct[$i]+$number;
				}
			}
			$scount = implode(",",$ct);
			$list = $list;
		}else{
			$list = $list . "," . ($activeitem+10000);
			$scount = $scount . "," . $number;
		}
		$money = $money + $buy_fb;
		$sql1 = "UPDATE app_qqfarm_mclogs set iid = '" . $list .
		"', money = '" . $money . "', count ='" . $scount . "', time = " . $_QFG['timestamp'] .
		", isread = 1 where uid = " . intval($_QFG['uid']) .
		" AND type = 11 AND time > " . ($_QFG['timestamp'] - 3600) . " AND fromid =" .
		$_QFG['uid'];
	}
}
if(!$sql1 && $number > 0) {
	$sql1 = "INSERT INTO app_qqfarm_mclogs (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
	$_QFG['uid'] . ", 11," . $number . ", " . $_QFG['uid'] . ", " . $_QFG['timestamp'] . ", " . 
	($activeitem+10000) . ", 1, " . $buy_fb . ");";
}
$query = $_QFG['db']->query($sql1);


	echo '{"tId":' . $wid . ',"name":"' . $name . '","code":1,"msg":"购买成功。","num":' . $number . ',"fb":-' . $buy_fb . ',"money":0,"type":' . $type . '}';
}


?>