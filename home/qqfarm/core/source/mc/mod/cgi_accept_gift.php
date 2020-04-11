<?php

# 领取礼包根据VIP级别送不同的

$vip = $_QFG['db']->result("SELECT vip FROM app_qqfarm_user where uid=" . $_QFG['uid']);
$vip = qf_decode($vip);
$fruit = $_QFG['db']->result("SELECT fruit FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$fruit = qf_decode($fruit);
$list = $_QFG['db']->fetchOne("SELECT goods,tools FROM app_qqfarm_mc where uid=" . $_QFG['uid']);
$goods = qf_decode($list['goods']);
$tools = qf_decode($list['tools']);
$vip_level = (int)qf_toVipLevel($vip['exp']);

if((int)$vip['gift_mc'] == 0) {
	exit();
}

switch($vip_level) {
	case 1:
		$item = '[{"eNum":40,"eParam":40,"eType":4},{"eNum":1,"eParam":1,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草40，普通罐头1
		$fruit["40"] += 40;
		$tools["1"] += 1;
		$goods["1512"] += 1;
		break;
	case 2:
		$item = '[{"eNum":50,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草50，普通罐头2
		$fruit["40"] += 50;
		$tools["1"] += 2;
		$goods["1512"] += 2;
		break;
	case 3:
		$item = '[{"eNum":50,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草50，普通罐头2
		$fruit["40"] += 60;
		$tools["1"] += 2;
		$tools["2"] += 1;
		$goods["1512"] += 3;
		break;
	case 4:
		$item = '[{"eNum":50,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草50，普通罐头2
		$fruit["40"] += 70;
		$tools["1"] += 2;
		$goods["1512"] += 4;
		break;
	case 5:
		$item = '[{"eNum":50,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草50，普通罐头2
		$fruit["40"] += 80;
		$tools["1"] += 2;
		$tools["2"] += 3;
		$goods["1512"] += 5;
		break;
	case 6:
		$item = '[{"eNum":90,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":3,"eParam":2,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草90，普通罐头2,高速罐头3,极速罐头1
		$fruit["40"] += 90;
		$tools["1"] += 2;
		$tools["2"] += 3;
		$tools["3"] += 1;
		$goods["1512"] += 6;
		break;
	case 7:
		$item = '[{"eNum":100,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":3,"eParam":2,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草100，普通罐头2,高速罐头3,极速罐头2

		$fruit["40"] += 100;
		$tools["1"] += 2;
		$tools["2"] += 3;
		$tools["3"] += 2;
		$goods["1512"] += 7;
		break;
}
$vip['gift_mc'] = 0;


$_QFG['db']->query("UPDATE app_qqfarm_user set vip='".qf_encode($vip)."' where uid=" . $_QFG['uid']);
$_QFG['db']->query("UPDATE app_qqfarm_nc set fruit='" . qf_encode($fruit) . "' where uid=" . $_QFG['uid']);
$_QFG['db']->query("UPDATE app_qqfarm_mc set tools='" . qf_encode($tools) . "',goods='" . qf_encode($goods) . "' where uid=" . $_QFG['uid']);

echo '{"code":0,"direction":"","item":' . $item . ',"title":"","vip":'.$vip_level.'}';


?>