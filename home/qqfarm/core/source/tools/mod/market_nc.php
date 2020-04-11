<?php

//农贸市场

$type = in_array($_GET['type'],array('index','myitem','myproduct','saleitem','cancelitem','buyitem'))?$_GET['type']:'index';

qf_getCache('cropstype','/nc/');
qf_getCache('itemtype','/nc/');
qf_getCache('toolstype','/nc/');

if($type == "myitem") {
	$list = $_QFG['db']->fetchOne("select package,tools from app_qqfarm_nc where uid=".$_QFG['uid']);
	$package = qf_decode($list['package']);
	$tools = qf_decode($list['tools']);
	qf_getView("tools/market_nc_myitem");
} elseif($type == "myproduct") {
	$fruit = $_QFG['db']->result("select fruit from app_qqfarm_nc where uid=".$_QFG['uid']);
	$fruit = qf_decode($fruit);
	$fruitarr = array();
	qf_getView("tools/market_nc_myproduct");
} elseif($type == "saleitem") {
	//添加出售信息
	$cid = (int)$_GET["cid"];
	$cName = iconv("GBK","UTF-8",$_GET["cName"]);
	$cprice = (int)$_GET["price"];
	$cnumber = (int)$_GET["number"];
	$mclass = (int)$_GET["mclass"];
	if($cnumber <= 0) {
		die('1|&|数量必须大于0');
	}
	if($mclass == 1) {
		$mprice = $cropstype[$cid]['price'];
	} elseif($mclass == 2) {
		$mprice = $toolstype[$cid + 30000]['price'];
	} elseif($mclass == 3) {
		$mprice = $cropstype[$cid]['sale'];
	}
	if($cprice <= 0 || $cprice/$mprice > 1.1 || $cprice/$mprice < 0.9) {
		die('1|&|价格必须大于0且不能高于或低于市场价10%');
	}
	if($mclass == 1) {
		$packagearr = $_QFG['db']->result("select package from app_qqfarm_nc where uid=".$_QFG['uid']);
		$packagearr = qf_decode($packagearr);
		if($cnumber > $packagearr[$cid]) {
			die('1|&|你没有那么多的数量！');
		}
		$packagearr[$cid] = $packagearr[$cid] - $cnumber;
		foreach($packagearr as $key => $value) {
			if($value == 0) {
				unset($packagearr[$key]);
			}
		}
		$_QFG['db']->query("update app_qqfarm_nc set package='".qf_encode($packagearr)."' where uid=".$_QFG['uid']);
	} elseif($mclass == 2) {
		$fertarr = $_QFG['db']->result("select tools from app_qqfarm_nc where uid=".$_QFG['uid']);
		$fertarr = qf_decode($fertarr);
		if($cnumber > $fertarr[$cid]) {
			die('1|&|你没有那么多的数量！');
		}
		$fertarr[$cid] = $fertarr[$cid] - $cnumber;
		foreach($fertarr as $key => $value) {
			if($value == 0) {
				unset($fertarr[$key]);
			}
		}
		$_QFG['db']->query("update app_qqfarm_nc set tools='".qf_encode($fertarr)."' where uid=".$_QFG['uid']);
	} elseif($mclass == 3) {
		$fruit = $_QFG['db']->result("select fruit from app_qqfarm_nc where uid=".$_QFG['uid']);
		$fruit = qf_decode($fruit);
		if($cnumber > $fruit[$cid]) {
			exit('1|&|你没有那么多的数量！');
		}
		$fruit[$cid] = $fruit[$cid] - $cnumber;
		foreach($fruit as $key => $value) {
			if($value == 0) {
				unset($fruit[$key]);
			}
		}
		$_QFG['db']->query("UPDATE app_qqfarm_nc set fruit='".qf_encode($fruit)."' where uid=".$_QFG['uid']);
	}
	$sql = "insert into app_qqfarm_market (`cid`, `cname`, `cnumber`, `cprice`, `mclass`, `selluid`) values ('$cid', '".$cName."', '$cnumber','$cprice', '$mclass', ".$_QFG['uid'].");";
	$_QFG['db']->query($sql);
	$suiji = mt_rand(0,100);
	if($suiji <= 33) {
		include ("source/tools/mod/market_rand.inc.php");
	}
	die('3|&|'.$suijihua.'成功发布出售！|&|refresh');
} elseif($type == "cancelitem") {
	$marketlist = $_QFG['db']->fetchAll("select * from app_qqfarm_market where id=".$_GET['id']);
	if($_QFG['uid'] != $marketlist[0]['selluid']) {
		die('1|&|这不是你卖的无法取消！');
	}
	if($marketlist[0]['mclass'] == 1) {
		$package = $_QFG['db']->result("select package from app_qqfarm_nc where uid=".$_QFG['uid']);
		$package = qf_decode($package);
		$package[$marketlist[0]['cid']] = $package[$marketlist[0]['cid']] + $marketlist[0]['cnumber'];
		$_QFG['db']->query("update app_qqfarm_nc set package='".qf_encode($package)."' where uid=".$_QFG['uid']);
	} elseif($marketlist[0]['mclass'] == 2) {
		$tools = $_QFG['db']->result("select tools from app_qqfarm_nc where uid=".$_QFG['uid']);
		$tools = qf_decode($tools);
		$tools[$marketlist[0]['cid']] = $tools[$marketlist[0]['cid']] + $marketlist[0]['cnumber'];
		$_QFG['db']->query("update app_qqfarm_nc set tools='".qf_encode($tools)."' where uid=".$_QFG['uid']);
	} elseif($marketlist[0]['mclass'] == 3) {
		$fruit = $_QFG['db']->result("select fruit from app_qqfarm_nc where uid=".$_QFG['uid']);
		$fruit = qf_decode($fruit);
		$fruit[$marketlist[0]['cid']] = $fruit[$marketlist[0]['cid']] + $marketlist[0]['cnumber'];
		$_QFG['db']->query("update app_qqfarm_nc set fruit='".qf_encode($fruit)."' where uid=".$_QFG['uid']);
	}
	$_QFG['db']->query("DELETE FROM app_qqfarm_market WHERE id = ".$_GET['id']." and mclass !=4 ");
	die('3|&|成功取消出售！|&|refresh');
} elseif($type == "buyitem") {
	$money = $_QFG['db']->result("select money frOM app_qqfarm_user where uid=".$_QFG['uid']);
	$marketlist = $_QFG['db']->fetchAll("select * from app_qqfarm_market where id=".$_GET['id']." and mclass !=4 ");
	$cnumber = (int)$_GET['number'];
	if($cnumber > $marketlist[0]['cnumber']) {
		die('1|&|没有那么多的数量！');
	}
	if($cnumber < 0) {
		die('1|&|不能为负数！');
	}
	$money_1 = $cnumber * $marketlist[0]['cprice'];
	if($money < $money_1) {
		die('1|&|你的金币不足！');
	}
	if($marketlist[0]['mclass'] == 1) {
		$package = $_QFG['db']->result("select package from app_qqfarm_nc where uid=".$_QFG['uid']);
		$package = qf_decode($package);
		$package[$marketlist[0]['cid']] = $package[$marketlist[0]['cid']] + $cnumber;
		$_QFG['db']->query("update app_qqfarm_nc set package='".qf_encode($package)."' where uid=".$_QFG['uid']);
	} elseif($marketlist[0]['mclass'] == 2) {
		$tools = $_QFG['db']->result("select tools from app_qqfarm_nc where uid=".$_QFG['uid']);
		$tools = qf_decode($tools);
		$tools[$marketlist[0]['cid']] = $tools[$marketlist[0]['cid']] + $cnumber;
		$_QFG['db']->query("update app_qqfarm_nc set tools='".qf_encode($tools)."' where uid=".$_QFG['uid']);
	} elseif($marketlist[0]['mclass'] == 3) {
		$fruit = $_QFG['db']->result("select fruit from app_qqfarm_nc where uid=".$_QFG['uid']);
		$fruit = qf_decode($fruit);
		$fruit[$marketlist[0]['cid']] = $fruit[$marketlist[0]['cid']] + $cnumber;
		$_QFG['db']->query("update app_qqfarm_nc set fruit='".qf_encode($fruit)."' where uid=".$_QFG['uid']);
	}
	if($cnumber < $marketlist[0]['cnumber']) {
		$_QFG['db']->query("update app_qqfarm_market set cnumber='".($marketlist[0]['cnumber'] - $cnumber)."' WHERE id=".$_GET['id']." and mclass !=4 ");
	} elseif($cnumber = $marketlist[0]['cnumber']) {
		$_QFG['db']->query("delete from app_qqfarm_market where id = ".$_GET['id']." and mclass !=4 ");
	}
	if($money_1 < 1) {
		$money_1 = 1;
	}
	$_QFG['db']->query("update app_qqfarm_user set money=money-".$money_1." where uid=".$_QFG['uid']);
	$_QFG['db']->query("update app_qqfarm_user set money=money+".$money_1." where uid=".$marketlist[0]['selluid']);
	$suiji = mt_rand(0,100);
	if($suiji <= 33) {
		include ("source/tools/mod/market_rand.inc.php");
	}
	die('3|&|'.$suijihua.'成功购买！花去'.$money_1.'金币|&|refresh');
} else {
	//分页参数
	$psize = 19;
	$pid = (int)$_GET['pid'];
	$pid = $pid < 1?1:$pid;
	$start = ($pid - 1) * $psize;
	$purl = "tools.php?mod=market&act=nc";
	$count = $_QFG['db']->result("SELECT COUNT(*) FROM app_qqfarm_market where mclass !=4");
	//处理查询
	$list = array();
	if($count) {
		$list = $_QFG['db']->fetchAll("select m.*,s.username from app_qqfarm_market m, app_qqfarm_user s where m.selluid=s.uid and mclass !=4 order by s.uid asc LIMIT {$start},{$psize}");
	}
	qf_getView("tools/market_nc");
}

?>