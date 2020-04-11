<?php
//农场杀虫

$uid = (int)$_REQUEST['ownerId'];
$list = $_QFG['db']->fetchOne("SELECT status,tips,dog,zong FROM app_qqfarm_nc where uid=" . $uid);
$farmarr = qf_decode($list['status']);
if($uid != $_QFG['uid']) {
	$Tips = qf_decode($list['tips']);
}

$place = explode(",", $_REQUEST['place']);
foreach($place as $pid) {
	if($_REQUEST['tId'] == 0) {//普通杀虫
		$g = $farmarr[$pid]['g'];
		$farm_arr = $farmarr[$pid]['p'];
		if($g > 0) {
			$cnt_you = array_key_exists($_QFG['uid'], $farmarr[$pid]['pest']) ? $farmarr[$pid]['pest'][$_QFG['uid']] : 0;//得到你在此地放虫的数目
			if($g <= $cnt_you) {
				die('{"code":0,"direction":"证据是不能毁灭的！","farmlandIndex":' . $pid . ',"poptype":1,"pest":' . $g . '}');
			} else {
				foreach($farmarr[$pid]['pest'] as $wk=>$wv) {
				if($wk != $_QFG['uid']) {
					$farmarr[$pid]['pest'][$wk] -= 1;
					if($farmarr[$pid]['pest'][$wk]<1) { 
						unset($farmarr[$pid]['pest'][$wk]);
					}
					if(count($farmarr[$pid]['pest'])==0) {
						unset($farmarr[$pid]['pest']);
					}
					break;
				}
			}
			}
			$g -= 1;
			if($list['zong'] < 1) {
				//限制杀虫
				$echo_str[] = '{"code":1,"direction":"' . $Tips['pest_b'] . '","farmlandIndex":' . $pid . ',"poptype":1,"money":2,"exp":0,"levelUp":false,"pest":' . $farmarr[$pid]['g'] . '}';
			} else {
				$_QFG['db']->query("UPDATE app_qqfarm_nc set exp = exp+2,zong=zong-1 where uid=" . $_QFG['uid']);
				$exp_arr = $_QFG['db']->result("SELECT exp FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
				$levelup = $_QFG['db']->result("SELECT levelup FROM app_qqfarm_nc where uid=" . $_QFG['uid']);
				$levelup_arr = 'false';
				if($exp_arr >= $levelup && $levelup < 93001) {
					include("source/nc/plus/levelup.php"); //升级提示
				}
				$echo_str[] = '{"code":1,"direction":"' . $Tips['pest_b'] . '","farmlandIndex":' . $pid . ',"poptype":1,"money":2,"exp":2,"levelUp":' . $levelup_arr . ',"pest":' . $farmarr[$pid]['g'] . '}';
			}
		}
		foreach($farm_arr as $key_pw => $value_pw) {
			if($value_pw == 1) {
				unset($farm_arr[$key_pw]);
				break;
			}
		}
		$farmarr[$pid]['p'] = $farm_arr;
		$farmarr[$pid]['g'] = $g;
	} else {
		die('{"tId":' . $_REQUEST['tId'] . ',"farmlandIndex":' . $pid . ',"code":0,"poptype":1,"direction":"' . $Tips['pest_b'] . '"}');
	}
}

$_QFG['db']->query("UPDATE app_qqfarm_user set money = money + 2 where uid=" . $_QFG['uid']);

if($uid == $_QFG['uid']) {
	$_QFG['db']->query("UPDATE app_qqfarm_nc set status='" . qf_encode(array_values($farmarr)) . "' where uid=" . $_QFG['uid']);
	qf_addFeed('farmlandstatus_spraying1');
} else {
	$_QFG['db']->query("UPDATE app_qqfarm_nc set status='" . qf_encode(array_values($farmarr)) . "'  where uid=" . $uid);
	qf_addFeed('farmlandstatus_spraying2');
	//帮忙杀虫日志
	$result = $_QFG['db']->fetchOne("SELECT `id`,`counts` FROM  app_qqfarm_nclogs WHERE fromid = " . $_QFG['uid'] . " and type=2 and uid = " . $uid . " and time > " . ($_QFG['timestamp'] - 3600));
	if($result != null) {
		if (strpos($result['counts'], ':') !== false) {
			$counts_ = explode(':', $result['counts']);
			$counts_[1]++;
			$counts_all = join(':', $counts_);
		} else {
			$counts_all = "0:1:0";
		}
		$sql = "UPDATE app_qqfarm_nclogs set count = count+1,counts='{$counts_all}',time = " . $_QFG['timestamp'] . " where id = " . $result['id'];
	 } else {
		$sql = "INSERT INTO app_qqfarm_nclogs (`uid`, `type`, `count`,`counts`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $uid . ", 2, 1,'0:1:0', " . $_QFG['uid'] . ", " . $_QFG['timestamp'] . ", 0, 0);";
	}
	$_QFG['db']->query($sql);
}

echo '[' . implode(',', $echo_str) . ']';

?>