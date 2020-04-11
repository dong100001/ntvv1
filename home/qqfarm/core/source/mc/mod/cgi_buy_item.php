<?php

# 金币购买装饰

$activeItem = (int)$_REQUEST['itemId'];
$money = $_QFG['db']->result("SELECT money FROM app_qqfarm_user where uid=" . $_QFG['uid']);
$decorative = $_QFG['db']->result("SELECT decorative FROM app_qqfarm_mc where uid=" . $_QFG['uid']);

$decorative = qf_decode($decorative);
$buy_money = $itemtype[$activeItem]['price'];
$buy_time = $itemtype[$activeItem]['itemValidTime'];
$buy_type = $itemtype[$activeItem]['itemType'];
$buy_exp = $itemtype[$activeItem]['exp'];

if($money < $buy_money) {
	die('{"errorContent":"你的金币不够，不能购买！","errorType":"1011"}');
}


foreach($decorative['item1'] as $key => $value1) {
	if($key == $activeItem) {
		die('{"errorContent":"你已经购买过了，不必重复购买！","errorType":"1011"}');
	} else {
		$dec = 1;
		$decorative['item1'][$activeItem]['status'] = 1;
		$decorative['item1'][$activeItem]['validtime'] = $_QFG['timestamp'] + $buy_time;
  }
}

if($dec) {
	foreach($decorative['item1'] as $key => $value1) {
		if($key != $activeItem) $decorative['item1'][$key]['status'] = 0;
	}
}

$_QFG['db']->query("UPDATE app_qqfarm_mc set exp = exp + " . $buy_exp . ",decorative='" . qf_encode($decorative) . "' where uid=" . $_QFG['uid']);
$_QFG['db']->query("UPDATE app_qqfarm_user set money=money - " . $buy_money . " where uid=" . $_QFG['uid']);

echo '{"code":1,"addExp":' . $buy_exp . ',"money":-' . $buy_money . ',"levelUp":false}';

?>