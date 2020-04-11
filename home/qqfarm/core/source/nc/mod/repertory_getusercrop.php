<?php

# 用户仓库

$fruit = $_QFG['db']->result("SELECT fruit FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
$fruit = qf_decode($fruit);

$fruitarr = array();
foreach($fruit as $key => $value) {
	if(0 < $value) {
		$fruitarr[] = '{"cId":' . $key . ',"cName":"' . $cropstype[$key]['cName'] . '","level":"' . $cropstype[$key]['cLevel'] . '","amount":' . $value . ',"price":"' . $cropstype[$key]['sale'] . '"}';
	}
}

if($fruitarr) {
	$fruitarr = '[' . implode(',', $fruitarr) . ']';
} else {
	$fruitarr = '[]';
}

echo '{"allFlower":' . qf_jsonCode(array_values($allflower)) . ',"crop":' . $fruitarr . ',"flowerPath":"module/ui/flower"}';

?>