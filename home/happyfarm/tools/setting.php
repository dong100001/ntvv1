<?php
# Modify by http://www.gohooh.com/

include_once('../common.php');
header("Content-Type:text/html; charset=" . FARM_ENCODE);

if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}

if($_GET['act'] == "setting" && $_GET['submit'] == 1) {
	$setting_str = $_POST['value'];
	if($setting_str) {
		$setting_str = json_encode($setting_str);
		$setting_str = str_replace("\"", "", $setting_str);
		$setting_str = str_replace("\\u", "\\\u", $setting_str);
		if($setting_str && $setting_str != "null") {
			$_SGLOBAL['db']->query("UPDATE ".tname("happyfarm_config")." set setting".$_REQUEST['id']." ='".$setting_str."' where uid=".intval($_SGLOBAL['supe_uid']));
			$setting_str = json_decode('"'.str_replace("\\\u", "\\u", $setting_str).'"');
			die('1|&|Sửa đổi thành công.|&|null|&|'.$setting_str);
		}
		else die('2|&|JSON mã lỗi.');
	}
	else die('3|&|Thông điệp không thể để trống.');
}
else die('4|&|Tham số lỗi.');

?>
