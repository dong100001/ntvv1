<?php
//我的装饰

$decorative = $_QFG['db']->result("SELECT decorative FROM app_qqfarm_mc where uid=" . $_QFG['uid']);
$decorative = qf_decode($decorative);

foreach($decorative['item1'] as $key => $value1) {
	if($value1['validtime'] > $_QFG['timestamp'] or $value1['validtime'] == 1) {
		if($key == 105) {
			$get_itemName = "碧空绿野";
			$itemValidTime = 0;
		} else {
		    $get_itemName = $itemtype[$key]['itemName'];
			$itemValidTime = $value1['validtime'];
		}
		$decorative_str[] = '{"created":' . $key . ',"itemName":"' . $get_itemName . '","itemId":' . $key . ',"itemValidTime":' . $itemValidTime . ',"status":' . $value1['status'] . '}';
	}
}

echo '[' . implode(',', $decorative_str) . ']';

?>