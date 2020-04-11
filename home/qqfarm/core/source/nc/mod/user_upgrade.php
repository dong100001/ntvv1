<?php
//升级红土地

#升级所需经验和金钱

$list = $_QFG['db']->fetchOne('SELECT C.uid,C.money,N.status,N.reclaim,N.exp,N.redland FROM app_qqfarm_user C Left JOIN app_qqfarm_nc N ON N.uid=C.uid where C.uid=' . $_QFG['uid']);
$money = $list['money'];
$status = qf_decode($list['status']);
$level =  qf_toLevel($list['exp']);
$reclaim = $list['reclaim'];
$redland = $list['redland'];

#获取升级红土地的位置
foreach($status as $key=>$value) {
	if(!$value['bitmap'] || $value['bitmap']==0){
		$place = $key;
		break;
	}
}

if($_REQUEST['confirm'] == 1) {
	if($money < $upgrade[$place]['money'] && $level < $upgrade[$place]['level'] && $reclaim < 18 && $redland <=18){
		die('{"code":0,"direction":"请不要用非法手段升级红土地！"}');
	} else {
		$status[$place]['bitmap'] = 1;
		$status[$place]['pId'] = 0;
		if($status[$place]['k']>0){
			$status[$place]['k'] = intval($status[$place]['k']*(1+0.1)); 
			$status[$place]['m'] = intval($status[$place]['m']*(1+0.1));
		}
		$_QFG['db']->query("UPDATE app_qqfarm_user set money=money-".$upgrade[$place]['money']." where uid=".$_QFG['uid']);
		$_QFG['db']->query("UPDATE app_qqfarm_nc set Status='".json_encode(array_values($status))."' , redland= '".($place+1)."' where uid=".$_QFG['uid']);
		die( '{"code":1,"place":'.$place.',"output":'.$status[$place]['k'].',"leavings":'.$status[$place]['m'].',"min":'.$status[$place]['l'].',"money":-'.$upgrade[$place]['money'].',"direction":"恭喜你，红土地升级成功！"}');
	}
}

if($redland >=18) {
	die('{"code":1,"direction":"<font size=\'18\'><b><font color=\"#FF6600\">　　　　恭喜你，红土地全部升级完成！</font></b>"}');
} elseif($reclaim >=18 && $money >= $upgrade[$place]['money'] && $level >= $upgrade[$place]['level']) {
	die('{"code":1,"direction":"<font size=\'14\'><b>您的土地升级后，将成为肥沃的红土地：</b></font><br />1.珍贵的<font color=\"#FF6600\">高级作物</font>，只能种在红土地上！<br />2.普通作物种在红土地增产<font color=\"#FF6600\">10%</font>！<br />3.神奇变异，红土地上可能出现绝世珍稀的<font color=\"#FF6600\">名贵作物</font>！<br />4.红土地上进行摘取，有更丰富的<font color=\"#FF6600\">奖励</font>，更多有趣的杯具洗具！<br /><br /><b><font color=\"#399200\">本次升级第<font color=\"#FF6600\">'.($place+1).'</font>块地，需要等级<font color=\"#FF6600\">'.$upgrade[$place]['level'].'</font>级，金币<font color=\"#FF6600\">'.$upgrade[$place]['money'].'</font>！</font></b>"}');
} else {
	if($reclaim < 18) {
		$ta='对不起，普通土地开完才能升级红土地哦！';
	}

	if($money < $upgrade[$place]['money'] && $level < $upgrade[$place]['level']) {
		$ta='您的等级与金币均不足！';
	} else {
		$level < $upgrade[$place]['level'] && $ta='您的等级不足！';
		$money < $upgrade[$place]['money'] && $ta='您的金币不足！';
	} 

	die('{"code":888,"direction":"<font size=\'14\'><b>您的土地升级后，将成为肥沃的红土地：</b></font><br />1.珍贵的<font color=\"#FF6600\">高级作物</font>，只能种在红土地上！<br />2.普通作物种在红土地增产<font color=\"#FF6600\">10%</font>！<br />3.神奇变异，红土地上可能出现绝世珍稀的<font color=\"#FF6600\">名贵作物</font>！<br />4.红土地上进行摘取，有更丰富的<font color=\"#FF6600\">奖励</font>，更多有趣的杯具洗具！<br /><br /><b><font color=\"#399200\">对不起，本次升级需要等级<font color=\"#FF6600\">'.$upgrade[$place]['level'].'</font>级，金币<font color=\"#FF6600\">'.$upgrade[$place]['money'].'</font>，'.$ta.'</font></b>"}');
}

?>
