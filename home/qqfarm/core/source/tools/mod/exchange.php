<?php
/**
 * 积分兑换
 * Modify by seaif@zealv.com
 */


if($_GET['do'] == 'save') {
	//获取当前用户积分
	$credit = qf_userCredit(0);
	$number = (int)$_GET['number'];
	$number = (!is_numeric($number) || $number < 1) ? 0 : $number;
	$type = $_GET['type'];
	if($type == "yb") {
		if($number * 10 > $credit)
			die('0|&|Bạn chưa đủ điểm.');
		elseif($number <= 0)
			die('0|&|Vui lòng điền số nguyên dương.');
		else {
			qf_userCredit(0, "-" . ($number * 10));
			$_QFG['db']->query("UPDATE app_qqfarm_user set yb=yb+" . $number . " where uid=" . $_QFG['uid']);
			die('3|&|Trao đổi điểm thành công.|&|refresh');
		}
	} elseif($type == "jb") {
		if($number > $credit)
			echo '0|&|Bạn chưa đủ điểm.';
		elseif($number <= 0)
			echo '0|&|Vui lòng điền số nguyên dương.';
		else {
			qf_userCredit(0, "-" . $number);
			$_QFG['db']->query("UPDATE app_qqfarm_user set money=money+" . ($number * 100) . " where uid=" . $_QFG['uid']);
			die('3|&|Trao đổi điểm thành công.|&|refresh');
		}
	}
} else {
	qf_getView("tools/exchange");
}

?>