<?php
# Modify by http://www.gohooh.com/

include_once('../common.php');
header("Content-Type:text/html; charset=" . FARM_ENCODE);

if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}

$query = $_SGLOBAL['db']->query("SELECT package  FROM ".tname("happyfarm_mc")." where uid=".intval($_SGLOBAL['supe_uid']));//便便
while($value = $_SGLOBAL['db']->fetch_array($query)) {
	$packagelist = $value[package]; 
}

$query = $_SGLOBAL['db']->query("SELECT tools, fruit FROM ".tname("happyfarm_nc")." where uid=".intval($_SGLOBAL['supe_uid']));//化肥
while($value = $_SGLOBAL['db']->fetch_array($query)) {
	$toollist = $value[tools]; 
	$fruitlist = $value[fruit];
}

$packagelist1 = json_decode($packagelist);
$toollist1 = json_decode($toollist);
$fruitlist1 = json_decode($fruitlist);


$i = 1506;	//便便id
$j = 2;		//萝卜id,高速化肥id
$k = 3;		//极速化肥id
if($packagelist1->$i >= 5 and $fruitlist1->$j >= 2) {
	$packagelist1->$i -= 5; //每次兑换化肥减5便便
	$fruitlist1->$j -= 2;
	//随机 rand
	$randnumber = rand(1,100);
	if($randnumber%10 == 0) {
		$toollist1->$k += 1; //第三种化肥
	}
	else {
		$toollist1->$j += 1; //每次兑换加 1 化肥(第二种化肥)
	}
	$package = json_encode($packagelist1);
	$tools = json_encode($toollist1);
	$fruit = json_encode($fruitlist1);
	$_SGLOBAL['db']->query("update ".tname('happyfarm_mc')." set package='".$package."' where uid=".intval($_SGLOBAL['supe_uid']));
	$_SGLOBAL['db']->query("update ".tname('happyfarm_nc')." set tools='".$tools."', fruit='".$fruit."' where uid=".intval($_SGLOBAL['supe_uid']));
	if($randnumber%10 == 0) echo '3|&|Trao đổi thành công một bao phân bón 5 sao.';
	else die('2|&|Trao đổi thành công một bao phân bón.');
}
else die('1|&|Bạn chưa đủ củ cải và phân gia súc.');

?>
