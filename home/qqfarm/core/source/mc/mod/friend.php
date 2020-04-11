<?php
//好友列表


//查询条件
$condition = ' limit 0,1000';
if($_QSC['friendType'] == 1) {
	$friends = qf_getFriends(0);
	$friends .= (empty($friends) ? '' : ',') . $_QFG['uid'];
	$condition = " WHERE N.uid IN({$friends}) group by N.uid " . $condition;
} else {
	$condition = " group by N.uid ".$condition;
}

$list = $_QFG['db']->fetchAll("SELECT C.uid,C.username,C.regname,C.money,C.vip,C.pf,N.exp FROM app_qqfarm_user C Left JOIN app_qqfarm_mc N ON N.uid=C.uid" . $condition);
foreach($list as $key => $value) {
	$friendheadPic = qf_getheadPic($value['uid'], 'small');
	$exp = $value['exp'];
	$pf = $value['pf'];
	if($value['exp'] < 1) {
		$exp = 0;
		$pf = 0;
	}
	$username=$value['username'];
	if(!$username){
		$username=$value['regname'];
		if(!$username){
			$username='牧场玩家';
		}
	}
	$vip = qf_decode($value['vip']);
	$friend_str[] = '{"uId":' . $value['uid'] . ',"uin":' . $value['uid'] . ',"userName":"' . $username . '","headPic":"' . $friendheadPic . '","yellowlevel":' . qf_toVipLevel($vip['exp']) . ',"yellowstatus":' .(int)$vip['status']. ',"exp":' . $exp . ',"money":' . $value['money'] . ',"pf":' . $pf . '}';
}
$friend_str = '[' . implode(',', $friend_str) . ']';

echo $friend_str;

?>