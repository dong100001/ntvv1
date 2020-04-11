<?php

qf_getCache('worldcupmatch', '/mc/'); //世界杯
qf_getCache('team', '/mc/');
qf_getCache('wcresult', '/mc/');
$goalsA = $_REQUEST['goalsA'];
$goalsB = $_REQUEST['goalsB'];
$matchid = intval($_REQUEST['mid']);



if(is_numeric($goalsA) && is_numeric($goalsB)) {
	$wcresult[$matchid]['goalsA'] = $goalsA;
	$wcresult[$matchid]['goalsB'] = $goalsB;
	if($goalsA>$goalsB) {
		$wcresult[$matchid]['result']=1;
	} elseif($goalsA>$goalsB) {
		$wcresult[$matchid]['result']=3;
	} else {
		$wcresult[$matchid]['result']=2;
	}
} else {
	$wcresult[$matchid]['goalsA'] = '';
	$wcresult[$matchid]['goalsB'] = '';
	$wcresult[$matchid]['result']=0;
}	
qf_putCache('wcresult', $wcresult,'/mc/');
qf_getView("admin/worldcup");

?>