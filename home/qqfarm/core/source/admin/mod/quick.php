<?php

# 快速管理

$go = $_GET['go'];

if($go == "cache_clean") {
	qf_delCache('data/*.php');
	qf_delCache('data/nc/*.php');
	qf_delCache('data/mc/*.php');
	qf_delCache('data/view/*.php');
	die('1|&|清理缓存成功.');
} elseif($go == "exchange_clean") {
	$_QFG['db']->query("DELETE FROM app_qqfarm_nclogs ");
	$_QFG['db']->query("DELETE FROM app_qqfarm_mclogs ");
	$_QFG['db']->query("DELETE FROM app_qqfarm_message");
	die('1|&|清理消费日志成功.');
} elseif($go == "mc_clean") {
	$_QFG['db']->query("update app_qqfarm_mc set bad='',dabian=0");
	die('1|&|清理牧场蚊子和便便成功.');
} elseif($go == "repertory_clean") {
	$_QFG['db']->query("update app_qqfarm_nc set repertory=''");
	$_QFG['db']->query("update app_qqfarm_mc set repertory=''");
	die('1|&|初始化成果.');
} elseif($go == "add_exp") {
	$_QFG['db']->query("update app_qqfarm_nc set exp=exp+" . intval($_GET["nc"]));
	$_QFG['db']->query("update app_qqfarm_mc set exp=exp+" . intval($_GET["mc"]));
	die('1|&|增加经验成功.');
} elseif($go == "healthmode") {
	$hm = '{"beginTime":0,"canClose":1,"date":"1970-01-01|1970-01-07","endTime":0,"serverTime":1266900062,"set":0,"time":"08|00","valid":0}';
	$_QFG['db']->query("update app_qqfarm_nc set healthmode='{$hm}'");
	die('1|&|修复健康模式成功.');
} elseif($go == "sendgift") {
	include('source/admin/mod/quick_gift.php');
} elseif($go == "sendmsg") {
	$name = $_GET["name"];
	$msg = $_POST["msg"];
	if(!$name || !$msg) {
		die('0|&|操作失败：管理员名称或留言不能为空.');
	}
	$users = $_QFG['db']->fetchAll("SELECT uid FROM app_qqfarm_user");
	foreach($users as $v) {
		$_QFG['db']->query("INSERT INTO app_qqfarm_message (`toid`, `toname`, `fromid`, `fromname`, `msg`, `time`, `isreply`, `isread`) VALUES ({$v['uid']}, '". qf_getUserName($v['uid'])."', {$_QFG['uid']}, '{$name}', '{$msg}', {$_QFG['timestamp']}, 0, 0)");
	}
	die('1|&|管理员留言成功.');
} elseif($go == "delmsg") {
	$name = $_GET["name"];
	if(!$name) {
		die('0|&|操作失败：管理员名称不能为空.');
	}
	$_QFG['db']->query("DELETE FROM app_qqfarm_message where fromname ='{$name}'");
	die('1|&|删除管理员名为“'. $name .'”的所有留言成功.');
} elseif($go == "farmland") {
	qf_getCache('cropstype', '/nc/');
	$_QFG['db']->query("update app_qqfarm_nc set weed='',pest=''");
	$list = $_QFG['db']->fetchAll("SELECT uid, status, package, reclaim,redland FROM app_qqfarm_nc");
	foreach($list as $key => $value) {
		//修复种子
		$package = qf_decode($value['package']);
		foreach($package as $pk=>$pv) {
			if(!in_array($pk, array_keys($cropstype))) {
				unset($package[$pk]);
			}
		}
		//获取农田参数
		$status = qf_decode($value['status']);
		//获取实际开垦农田数
		$farmlandCount = count($status);
		//添加需开垦的农田
		if($farmlandCount < $value['reclaim']) {
			for($i = $farmlandCount; $i < $value[reclaim]; $i++) {
				$status[$i] = array("a"=>0,"b"=>0,"c"=>0,"d"=>0,"e"=>1,"f"=>0,"g"=>0,"h"=>1,"i"=>100,"j"=>0,"k"=>0,"l"=>0,"m"=>0,"n"=>array(),"o"=>0,"p"=>array(),"q"=>0,"r"=>1251351725,"bitmap"=>0,"pId"=>0);
			}
		}
		//删除多开垦的农田
		elseif($farmlandCount > $value['reclaim']) {
			foreach($status as $k => $v) {
				if($k >= $value['reclaim']) {
					unset($status[$k]);
				}
			}
		}
		//红土地
		if($value['redland']>0 && $value['redland']<19 && $value['reclaim']==18) {
			foreach($status as $sk=>$sv) {
				if($sk<$value['redland']) {
					$status[$sk]['bitmap'] = 1;
				} else {
					$status[$sk]['bitmap'] = 0;
				}
			}
		}
		//保存农田参数
		$_QFG['db']->query("UPDATE app_qqfarm_nc set status='" . qf_encode(array_values($status)) . "',package='" . qf_encode($package) . "' where uid=" . $value['uid']);
	}
	die('1|&|修复农田参数,种子,背包成功.');
} else {
	qf_getCache('cropstype', '/nc/');
	$nc_itemtype = qf_getCache('itemtype', '/nc/');
	qf_getCache('toolstype', '/nc/');
	$mc_itemtype = qf_getCache('itemtype', '/mc/');
	qf_getCache('animaltype', '/mc/');
	qf_getView("admin/quick");
}

?>