<?php

#礼包提示

//读VIP级别，根据VIP级别送不同的礼物
$vip = $_QFG['db']->result("SELECT vip FROM app_qqfarm_user where uid=" . $_QFG['uid']); 
$vip = qf_decode($vip);
$vip_level = qf_toVipLevel($vip['exp']);
switch($vip_level) {
	case 1:
		$item = '[{"eNum":40,"eParam":40,"eType":4},{"eNum":1,"eParam":1,"eType":7},{"eNum":1,"eParam":1512,"eType":9}]';//草40，普通罐头1
		break;
	case 2:
		$item = '[{"eNum":50,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":2,"eParam":1512,"eType":9}]';//草50，普通罐头2
		break;
	case 3:
		$item = '[{"eNum":60,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":1,"eParam":2,"eType":7},{"eNum":3,"eParam":1512,"eType":9}]';//草60，普通罐头2,高速罐头1
		break;
	case 4:
		$item = '[{"eNum":70,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":2,"eParam":2,"eType":7},{"eNum":4,"eParam":1512,"eType":9}]';//草70，普通罐头2,高速罐头2
		break;
	case 5:
		$item = '[{"eNum":80,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":3,"eParam":2,"eType":7},{"eNum":5,"eParam":1512,"eType":9}]';//草80，普通罐头2,高速罐头3,
		break;
	case 6:
		$item = '[{"eNum":90,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":3,"eParam":2,"eType":7},{"eNum":1,"eParam":3,"eType":7},{"eNum":6,"eParam":1512,"eType":9}]';//草90，普通罐头2,高速罐头3,极速罐头1
		break;
	case 7:
		$item = '[{"eNum":100,"eParam":40,"eType":4},{"eNum":2,"eParam":1,"eType":7},{"eNum":3,"eParam":2,"eType":7},{"eNum":2,"eParam":3,"eType":7},{"eNum":7,"eParam":1512,"eType":9}]';//草100，普通罐头2,高速罐头3,极速罐头2
		break;

	default:
		$item = '';
}
echo '{"code":0,"direction":"恭喜您获赠VIP用户牧场大赠送活动之每日礼包：罐头+牧草<br>【罐头是缩短成长时间的道具，每个成长阶段可使用2个。】<br>活动时间: 5月27日--6月24日<br><font color=\"#FF0000\">您的VIP级别为：<font color=\"#CC3300\"><B>' . $vip_level . '</B> 级</font> ，获得以下奖励：<br>","item":' . $item . ',"title":"VIP用户每日礼包","vip":1}';


?>