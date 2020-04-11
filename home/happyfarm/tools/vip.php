<?php
# Modify by http://www.gohooh.com/

include_once('../common.php');
header("Content-Type:text/html; charset=" . FARM_ENCODE);

if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}

$query = $_SGLOBAL['db']->query("SELECT yb  FROM ".tname("happyfarm_config")." where uid=".intval($_SGLOBAL['supe_uid']));
while($value = $_SGLOBAL['db']->fetch_array($query)) {
	$yb1 = $value[yb]; 
}

$query = $_SGLOBAL['db']->query("select vip  FROM ".tname("happyfarm_config")." where uid=".intval($_SGLOBAL['supe_uid']));
while($value = $_SGLOBAL['db']->fetch_array($query)) {
	$vipNow = $value[vip]; 
}
$vipNext = $vipNow + 1;

switch($vipNext) {
	case 1: $vipYB = 0; break;
	case 2: $vipYB = 50; break;
	case 3: $vipYB = 100; break;
	case 4: $vipYB = 200; break;
	case 5: $vipYB = 400; break;
	case 6: $vipYB = 1000; break;
	case 7: $vipYB = 1500; break;
	default: die('3|&|Lỗi hoạt động.');
}
if($yb1 >= $vipYB) {
	$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_config')." set yb=yb-".$vipYB.", vip=".$vipNext." where uid=".$_SGLOBAL['supe_uid']);
	$query = $_SGLOBAL['db']->query("SELECT vip  FROM ".tname("happyfarm_config")." where uid=".intval($_SGLOBAL['supe_uid']));
	while($value = $_SGLOBAL['db']->fetch_array($query)) {
		$vip1 = $value[vip]; 
	}
	die('2|&|Xin chúc mừng, nâng cấp thành công.');
}
else die('1|&|Chưa đủ Gee để nâng cấp.');

?>

