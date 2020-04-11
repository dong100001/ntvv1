<?php
//全站使坏


//农场草
qf_getCache('cropstime', '/nc/');;
$lists = $_QFG['db']->fetchAll("SELECT C.uid,C.tianqi,N.status FROM app_qqfarm_user C Left JOIN app_qqfarm_nc N ON N.uid=C.uid");
foreach($lists as $list) {
	$farm = qf_decode($list['status']);
	foreach($farm as $key =>$value) {
		if(($_QFG['timestamp'] - $value['q']) < $cropstime[$value['a']][4]) {
			if($value['f'] == 0) {
				$suiji = mt_rand(0, 100);
				if($suiji < 10) {
					if($suiji < 4) {
						if($suiji < 2) {
							$value['f'] = 3;
							$fp = array($_QFG['timestamp'] => 2, ($_QFG['timestamp'] + 1) => 2, ($_QFG['timestamp'] + 2) => 2);
						} else {
							$value['f'] = 2;
							$fp = array($_QFG['timestamp'] => 2, ($_QFG['timestamp'] + 1) => 2);
						}
					} else {
						$value['f'] = 1;
						$fp = array($_QFG['timestamp'] => 2);
					}
				}
			}
			if($value['g'] == 0 && ($_QFG['timestamp'] - $value['q']) > $cropstime[$value['a']][2]) {
				$suiji = mt_rand(0, 100);
				if($suiji < 10) {
					if($suiji < 4) {
						if($suiji < 2) {
							$value['g'] = 3;
							$gp = array(($_QFG['timestamp'] + 10) => 1, ($_QFG['timestamp'] + 11) => 1, ($_QFG['timestamp'] + 12) => 1);
						} else {
							$value['g'] = 2;
							$gp = array(($_QFG['timestamp'] + 10) => 1, ($_QFG['timestamp'] + 11) => 1);
						}
					} else {
						$value['g'] = 1;
						$gp = array(($_QFG['timestamp'] + 10) => 1);
					}
				}
			}
			if(($_QFG['timestamp'] - $value['q']) < $cropstime[$value['a']][4]) {
				$suiji = mt_rand(0, 100);
				if($list['tianqi'] == 1) {
					if($value['h'] == 1) {
						if($suiji < 7) {
							$value['h'] = 0;
							$hp = array(($_QFG['timestamp'] + 20) => 3);
						}
					}
				}
			}
			$farm_p = array();
			if($fp) {
				$farm_p = $farm_p + $fp;
			}
			if($gp) {
				$farm_p = $farm_p + $gp;
			}
			if($hp) {
				$farm_p = $farm_p + $hp;
			}
			unset($fp);
			unset($gp);
			unset($hp);
			if($farm_p) {
				$value['p'] = $farm_p;
			}
		}
		$farm[$key] = $value;//回写参数
	}
	$_QFG['db']->query("UPDATE app_qqfarm_nc set status='" . qf_encode(array_values($farm)) . "' where uid=" . $list['uid']);
}


//牧场大便
$_QFG['db']->query("UPDATE app_qqfarm_mc set dabian=dabian+" .mt_rand(1, 2) . " where dabian<8");


//牧场蚊子
$values = $_QFG['db']->fetchAll("select bad from app_qqfarm_mc");
foreach($values as $value) {
	if($value[bad] == '') {
		$add_bad = '0,0';
	} else {
		$bad_array = explode(',', $value['bad']);
		$bad_array_count = count($bad_array);
		if($bad_array_count < 8) {
			$add_bad = $value[bad] . ',0';
		} else {
			exit();
		}
	}
	$_QFG['db']->query("UPDATE app_qqfarm_mc set bad='$add_bad'");
}

?>