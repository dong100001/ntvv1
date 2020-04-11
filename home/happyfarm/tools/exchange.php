<?php
# Modify by http://www.gohooh.com/

include_once('../common.php');
header("Content-Type:text/html; charset=" . FARM_ENCODE);

if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}

//获取当前用户积分
$credit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT credit FROM '.tname('space').' where uid='.$_SGLOBAL['supe_uid']),0);

$number = $_GET['number'];
if(!is_numeric($number) || $number < 1) $number = 0;
else $number = intval($number);

$act = $_GET['act'];

if($act == "yb") {
	if($number*10 > $credit) die('1|&|Bạn chưa đủ điểm.');
	elseif($number <= 0) die('2|&|Vui lòng nhập số điểm phải lớn hơn 0.');
	else {
		$_SGLOBAL['db']->query("UPDATE ".tname('space')." set credit=credit-".($number*10)." where uid=".$_SGLOBAL['supe_uid']);
		$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_config')." set YB=YB+".$number." where uid=".$_SGLOBAL['supe_uid']);
		die('3|&|Đổi điểm thành công.|&|refresh');
	}
}
elseif($act == "jb") {
	if($number > $credit) echo '1|&|Bạn chưa đủ điểm.';
	elseif($number <= 0) echo '2|&|Vui lòng nhập số điểm phải lớn hơn 0.';
	else {
		$_SGLOBAL['db']->query("UPDATE ".tname('space')." set credit=credit-".$number." where uid=".$_SGLOBAL['supe_uid']);
		$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_config')." set money=money+".($number*100)." where uid=".$_SGLOBAL['supe_uid']);
		die('3|&|Đổi điểm thành công.|&|refresh');
	}
}
?>