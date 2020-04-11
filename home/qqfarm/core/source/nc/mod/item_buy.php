<?php

# 金币购买装饰

$activeItem = (int)$_REQUEST['itemId'];
$money = $_QFG['db']->result("SELECT money FROM app_qqfarm_user where uid=" . $_QFG['uid']);
$decorative = $_QFG['db']->result("SELECT decorative FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$decorative = qf_decode($decorative);
$buy_money = $itemtype[$activeItem]['price'];
$buy_time = $itemtype[$activeItem]['itemValidTime'];
$buy_type = $itemtype[$activeItem]['itemType'];
$buy_exp = $itemtype[$activeItem]['exp'];
if($money < $buy_money) {
	exit();
}

foreach((array)$decorative as $item_type => $value) {
	if($buy_type == $item_type) {
		foreach((array)$value as $key => $value1) {
			if($key == $activeItem) {
				die('{"direction":"你已经购买过了，不必重复购买！"}');
			} else {
				$dec = 1;
				$decorative[$item_type][$activeItem]['status'] = 1;
				$decorative[$item_type][$activeItem]['validtime'] = $_QFG['timestamp'] + $buy_time;
			}
		}
		if($dec) {
			foreach((array)$value as $key => $value1) {
				if($key != $activeItem) $decorative[$item_type][$key]['status'] = 0;
			}
		}
	}
}

$_QFG['db']->query("UPDATE app_qqfarm_nc set exp = exp + " . $buy_exp . ",decorative='" . qf_encode($decorative) . "' where uid=" . $_QFG['uid']);
$_QFG['db']->query("UPDATE app_qqfarm_user set money=money - " . $buy_money . " where uid=" . $_QFG['uid']);

//升级
$exp_arr = $_QFG['db']->result("SELECT exp FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$levelup = $_QFG['db']->result("SELECT levelup FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$levelup_arr = 'false';
if($exp_arr >= $levelup && $levelup < 93001) {
	include("source/nc/plus/levelup.php"); //升级提示
}

//消费日志
$_QFG['db']->query("INSERT INTO app_qqfarm_nclogs (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread`, `money` ) VALUES (" . $_QFG['uid'] . ", 11, 1, " . $_QFG['uid'] . ", " . $_QFG['timestamp'] . ", '" . $activeItem . "', 1, '".$buy_money."');");

echo '{"code":1,"exp":' . $buy_exp . ',"money":-' . $buy_money . ',"levelUp":' . $levelup_arr . '}';

?>