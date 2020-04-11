<?php

# 用户背包

$fruit = $_QFG['db']->result('SELECT fruit FROM app_qqfarm_nc where uid=' . $_QFG['uid']);
$fruit = qf_decode($fruit);
$list = $_QFG['db']->fetchOne("SELECT goods,tools FROM app_qqfarm_mc where uid=" . $_QFG['uid']);
$tools = qf_decode($list['tools']);
$goods = qf_decode($list['goods']);


$fruittype = array(
	"40" => array( "FBPrice" => 0, "consume" => "一只动物每 4 小时消耗 1~5 粒饲料", "depict" => "喂养动物(挨饿会停止成长或生产)", "effect" => 0, "price" => 60, "store" => "商店购买牧草后会自动放入饲料机中", "tId" => 40, "tName" => "牧草", "timeLimit" => 0, "tip" => "高价购买牧草会消耗较多金币不合算，建议去农场种植。", "type" => 4),
	"3" => array( "FBPrice" => 0, "consume" => "特殊作物，供兔子使用可减少生长时间5分钟。", "depict" => "", "effect" => 0, "price" => 0, "store" => "", "tId" => 3, "tName" => "胡萝卜", "timeLimit" => 0, "tip" => "", "type" => 4),
	"18" => array( "FBPrice" => 0, "consume" => "特殊作物，供猴子使用可减少生长时间5分钟。", "depict" => "", "effect" => 0, "price" => 0, "store" => "", "tId" => 18, "tName" => "桃子", "timeLimit" => 0, "tip" => "", "type" => 4),
	"72" => array( "FBPrice" => 0, "consume" => "特殊作物，供松鼠使用可减少生长时间5分钟。", "depict" => "", "effect" => 0, "price" => 0, "store" => "", "tId" => 72, "tName" => "榛子", "timeLimit" => 0, "tip" => "", "type" => 4)
	);



foreach($fruit as $key => $value) {
	if(0 < $value){
		if($key == 3 || $key == 18 || $key == 40 || $key == 72 ) {
				$packagearr[] = '{"type":4,"tId":' . $key . ',"tName":"' . $fruittype[$key]['tName'] . '","amount":' . $value . ',"tDesc":"' . $fruittype[$key]['consume'] . '"}';
		}
	}
}

foreach($tools as $key => $value) {
	if(0 < $value){
		$packagearr[] = '{"type":7,"tId":' . $key . ',"tName":"' . $toolstype[$key]['name'] . '","amount":' . $value . ',"tDesc":"' . $toolstype[$key]['description'] . '"}';
	}
}

foreach($goods as $key => $value) {
	if(0 < $value){
		$packagearr[] = '{"type":9,"tId":' . $key . ',"tName":"' . $animaltype[$key]['cName'] . '","amount":' . $value . ',"tDesc":"' . $animaltype[$key]['cLevel'] . '级动物，' . ($animaltype[$key]['maturingTime']) / 3600 . '小时可生产"}';
	}
}

echo '[' . implode(',', (array)$packagearr) . ']';

?>