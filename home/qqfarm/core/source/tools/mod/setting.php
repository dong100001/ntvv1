<?php
/**
 * 游戏设置
 * Modify by seaif@zealv.com
 */


$Tips = $_QFG['db']->result("select tips FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$Tips = qf_decode($Tips);

if($_GET['do'] == "save") {
	$ncTips = array(
		'water_b' => 'Cảm ơn bạn đã giúp đỡ！',
		'weed_b' => 'Cảm ơn bạn đã giúp đỡ',
		'pest_b' => 'Cảm ơn bạn đã giúp đỡ',
		'weed_a' => 'Bạn là người xấu',
		'pest_a' => 'Bạn là người xấu'
	);
	$tip_type = $_POST['type'];
	$tip_value = $_POST['value'];
	if(array_key_exists($tip_type, $ncTips)) {
		$Tips[$tip_type] = $_POST['value'] ? $_POST['value'] : $ncTips[$tip_type];
		$result = $_QFG['db']->query("UPDATE app_qqfarm_nc set tips ='" . qf_encode($Tips) . "' where uid=" . $_QFG['uid']);
		if($result) {
			die('1|&|Lưu thành công.|&|null|&|' . $Tips[$tip_type]);
		} else
			die('2|&|Lưu thất bại.');
	} else
		die('3|&|Vui lòng điền nội dung.');
} else {
	qf_getView("tools/setting");
}

?>