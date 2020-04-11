<?php

# 牧场仓库

$mc_package = $_QFG['db']->result('SELECT package FROM app_qqfarm_mc where uid=' . $_QFG['uid']);

$mclock = $_QFG['db']->result('SELECT mclock FROM app_qqfarm_mc where uid=' . $_QFG['uid']);

$mc_package = qf_decode($mc_package);
$mclock_arr = explode(',',$mclock);

foreach($mc_package as $key => $value) {
	if(0 < $value) {
			if(in_array($key, $mclock_arr)){
				$lock = ',"lock":1';
			} else {
				$lock = '';
			}	

			$cName = '';
			if($key<10000){
				if($key==1506){
					$cName = '便便';
					$cLevel = 0;
					$price = 30;
				} elseif(array_key_exists($key, $animaltype)) {
					$cName = $animaltype[$key]['bName'];
					$cLevel = $animaltype[$key]['cLevel'];
					$price = $animaltype[$key]['byproductprice'];
				} else {
					unset($mc_package[$key]);
				}
			} elseif(array_key_exists(($key-10000), $animaltype))  {
				$key1 = $key - 10000;
                $cName = $animaltype[$key1]['cName'];
				$cLevel = $animaltype[$key1]['cLevel'];
				$price = $animaltype[$key1]['productprice'];
			} else {
				unset($mc_package[$key]);
			}

			if($cName) {
				$package[] = '{"amount":' . $value . ',"cId":' . $key . ',"cName":"' . $cName . '"'.$lock.',"lv":' . $cLevel . ',"price":' . $price . '}';
			}
	}
}

$_QFG['db']->query("update app_qqfarm_mc set package='".qf_encode($mc_package)."' where uid=" . $_QFG['uid']);
echo '[' . implode(',', $package) . ']';

?>