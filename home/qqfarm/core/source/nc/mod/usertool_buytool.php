<?php

# 狗粮购买
$tid = (int)$_REQUEST['tId'];
$number = (int)$_REQUEST['number'];
if($_REQUEST['type'] == 3) {
	$rtid = 30000 + $tid;
} elseif($_REQUEST['type'] == 4) {
	$rtid = 40000 + $tid;
} else {
	$rtid = $tid;
}

if($toolstype[$rtid]["saleOut"] == true) {
	die('{"code":0,"direction":"已经售完咯，请及时关注农场公告！","payqb":0,"payqp":0,"dnaurl":""}');
}

$money = $_QFG['db']->result("SELECT money FROM app_qqfarm_user where uid=" . $_QFG['uid']);

if($_REQUEST['type'] == 3) {
	$tools = $_QFG['db']->result("SELECT tools FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
	$buy_money = $toolstype[30000 + $tid]["price"] * $number;
	$tName = $toolstype[30000 + $tid]["tName"];
	if($money < $buy_money) {
		exit();
	}
	$fertarr = qf_decode($tools);
	$fertarr[$tid] = $fertarr[$tid] + $number;
	$_QFG['db']->query("UPDATE app_qqfarm_nc set tools='" . qf_encode($fertarr) . "' where uid=" . $_QFG['uid']);
	//消费日志
	$sql = "INSERT INTO app_qqfarm_nclogs (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread`, `money` ) VALUES (" . $_QFG['uid'] .
			", 12, ".$number.", " . $_QFG['uid'] . ", " . $_QFG['timestamp'] .
			", '" . (30000+$tid) . "', 1, '".$buy_money."');";
	$_QFG['db']->query($sql);
} elseif($_REQUEST['type'] == 4) {
	$dogstr = $_QFG['db']->result("SELECT dog FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
	$dogstr = qf_decode($dogstr);
	
	$i = $dogstr['dogs'][$tid]['dogUnWorkTime'];
	if($tid < 9000) {
		$buy_money = $toolstype[40000 + $tid]['price'] * $number;
		if($money < $buy_money) {
			exit();
		}			
		if($dogstr['dogFeedTime'] < $_QFG['timestamp']) {
				$dogstr['dogFeedTime'] = $_QFG['timestamp'] + 86400;
		} else {
				$dogstr['dogFeedTime'] = $dogstr['dogFeedTime'] + 86400;
		}
		foreach((array)$dogstr as $key => $value) {
			foreach((array)$value as $k => $v){
				if($k == $tid) {
					die('{"code":50,"direction":"只能购买一只狗哟"}');
				} else {
					$dec = 1;
					$dogstr["dogs"][$tid]['status'] = 1;
					$dogstr["dogs"][$tid]['dogUnWorkTime'] = 1;

				}
			}
			if($dec) {
				foreach((array)$value as $k => $v){
					if($k != $tid) $dogstr[$key][$k]['status'] = 0;
				}
			}
		}
		
	} else {
		$buy_money = $toolstype[$tid]["price"] * $number;
		if($money < $buy_money) {
			exit();
		}
		$tName = $toolstype[$tid]["tName"];
		if($tid == 9001) {
			$dogFeed = 86400;
		} elseif($tid == 9002) {
			$dogFeed = 604800;
		} else {
			$dogFeed = 0;
		}
		if($dogstr["dogFeedTime"] < $_QFG['timestamp']) {
			$dogstr["dogFeedTime"] = $_QFG['timestamp'] + $dogFeed;
		} else {
			$dogstr["dogFeedTime"] = $dogstr["dogFeedTime"] + $dogFeed;
		}
	}
	$_QFG['db']->query("UPDATE app_qqfarm_nc set dog='" . qf_encode($dogstr) . "' where uid=" . $_QFG['uid']);
}

$_QFG['db']->query("UPDATE app_qqfarm_user set money=money - " . $buy_money . " where uid=" . $_QFG['uid']);

echo '{"tId":' . $tid . ',"tName":"' . $tName . '","code":1,"direction":"购买成功。","num":1,"money":-' . $buy_money . ',"FB":0,"type":' . $_REQUEST['type'] . '}';

?>