<?php
/****************************************/
/*      nông trại vui vẻQQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com
//禁止站外提交
/*if (strspn("MSIE",$_SERVER["HTTP_USER_AGENT"])==4){ 
   if(7 != strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']) OR 7 != strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])){ 
        echo '{"direction":"Vui lòng dùng phương thức POST","errorType":"timeOut","poptype":3}';
		exit();
	}
}*/
//禁止站外提交
include_once( "common.php" );
include_once( "config/farm.php" );

$UID = $_SGLOBAL['supe_uid'];
$space = getspace( $UID );
if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}
if ( empty( $space[name] ) )
{
	$space[name] = $space[username];
}
$spacename = unicode_encode( $space['name'] );
$tudiarr = tudiarr();
$cropstype = cropstype();
$cropstime =cropstime();
$Toolstype = Toolstype();
$itemtype = itemtype();
$randseed = array (49,51,53,57,62,81,82,101,102,103,104,105,106,107);//隐藏种子

//新用户初始化数据
$pf_str = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT uid FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
if ( $pf_str == NULL){
		$Message = "";
		$setting1 = "\\\u8C22\\\u8C22\\\u4F60\\\uFF0C\\\u6742\\\u8349\\\u6E05\\\u9664\\\u5E72\\\u51C0\\\u4E86\\\uFF01";
		$setting2 = "\\\u8C22\\\u8C22\\\u4F60\\\uFF0C\\\u5BB3\\\u866B\\\u6E05\\\u9664\\\u5E72\\\u51C0\\\u4E86\\\uFF01";
		$setting3 = "\\\u7F3A\\\u5FB7\\\u554A\\\uFF01\\\u7ADF\\\u7136\\\u505A\\\u8FD9\\\u79CD\\\u574F\\\u4E8B\\\uFF01";
		$setting4 = "\\\u53EF\\\u6076\\\u554A\\\uFF01\\\u4F60\\\u771F\\\u4E0D\\\u662F\\\u4E2A\\\u597D\\\u4EBA\\\uFF01";
		$setting5 = "";
		$setting6 = "\\\u8C22\\\u8C22\\\u5E2E\\\u5FD9\\\uFF0C\\\u4F60\\\u771F\\\u662F\\\u4E2A\\\u597D\\\u4EBA\\\uFF01";
		$exchange="{\"cost\":[]}";
		$_SGLOBAL['db']->query( "INSERT INTO ".tname( "happyfarm_config" )." (uid,Message,setting1,setting2,setting3,setting4,setting5,setting6,exchange,pf) VALUES(".$UID.",'".$Message."','".$setting1."','".$setting2."','".$setting3."','".$setting4."','".$setting5."','".$setting6."','".$exchange."',0)");
}
$nc_uid = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT uid FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
if ( $nc_uid == NULL){
		$taskid = 1; $package = "{}"; $fruit = "{}"; $tool = "{}";  $dog = "{}"; $Weed = "{}";	$pest="{}";	$repertory = ""; $log = "";   $exp = 0;
		$Status = '{"farmlandstatus":[{"a":2,"b":6,"c":0,"d":0,"e":1,"f":0,"g":0,"h":1,"i":100,"j":0,"k":16,"l":9,"m":16,"n":[],"o":0,"p":[],"q":'.($_SGLOBAL['timestamp'] - 36030).',"r":1251351720},{"a":2,"b":1,"c":0,"d":0,"e":1,"f":1,"g":0,"h":1,"i":100,"j":0,"k":0,"l":0,"m":0,"n":[],"o":0,"p":[],"q":'.($_SGLOBAL['timestamp'] - 14400).',"r":1251351725},{"a":2,"b":1,"c":0,"d":0,"e":1,"f":0,"g":0,"h":0,"i":100,"j":0,"k":0,"l":0,"m":0,"n":[],"o":0,"p":[],"q":'.($_SGLOBAL['timestamp'] - 14400).',"r":1251351725},{"a":2,"b":1,"c":0,"d":0,"e":1,"f":0,"g":2,"h":1,"i":100,"j":0,"k":0,"l":0,"m":0,"n":[],"o":0,"p":[],"q":'.($_SGLOBAL['timestamp'] - 25200).',"r":1251351725},{"a":0,"b":0,"c":0,"d":0,"e":1,"f":0,"g":0,"h":1,"i":100,"j":0,"k":0,"l":0,"m":0,"n":[],"o":0,"p":[],"q":0,"r":1251351725},{"a":0,"b":0,"c":0,"d":0,"e":1,"f":0,"g":0,"h":1,"i":100,"j":0,"k":0,"l":0,"m":0,"n":[],"o":0,"p":[],"q":0,"r":1251351725}]}';
		$decorative = "{\"1\":{\"1\":{\"status\":1,\"validtime\":1}},\"2\":{\"2\":{\"status\":1,\"validtime\":1}},\"3\":{\"3\":{\"status\":1,\"validtime\":1}},\"4\":{\"4\":{\"status\":1,\"validtime\":1}}}";
		$healthmode="{\"beginTime\":0,\"canClose\":1,\"date\":\"1970-01-01|1970-01-07\",\"endTime\":0,\"serverTime\":".$_SGLOBAL['timestamp'].",\"set\":0,\"time\":\"08|00\",\"valid\":0}";
		$_SGLOBAL['db']->query( "INSERT INTO ".tname( "happyfarm_nc" )." (uid,Status,exp,taskid,tools,decorative,Weed,pest,repertory,log,healthmode,package,fruit) VALUES(".$UID.",'".$Status."',".$exp.",".$taskid.",'".$tool."','".$decorative."','".$Weed."','".$pest."','".$repertory."','".$log."','".$healthmode."','".$package."','".$fruit."')" );
		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} chơi game <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
		$body_general = "Hãy tham gia vào Hội Nông Dân NHÀ TUI để có thêm nhiều bạn mới";
		feed_add( $icon, $title_template, NULL, NULL, NULL, $body_general );
}//新用户初始化数据

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "run"){//访问自己和别人农场
	if ( $_REQUEST['ownerId'] == 0 )
	{
	$query = $_SGLOBAL['db']->query( "SELECT C.money,C.uid,C.pf,C.vip,C.yb,C.jb,C.tianqi,N.Status,N.mc_a,N.reclaim,N.nc_d,N.exp,N.taskid,N.badnum,N.dog,N.decorative,N.activeItem,N.healthMode FROM  ".tname( "happyfarm_config" )." C Left JOIN ".tname( "happyfarm_nc" )." N ON N.uid=C.uid where C.uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$healthModestr = json_decode( $list[0][healthMode]);
	if($_SGLOBAL['timestamp'] > $healthModestr->endTime)
	{	$set = 0; $valid = 0; $canClose = 1;
		if($healthModestr->valid !=0){
		$code = 0;
		$healthModestr->beginTime = 0;
		$healthModestr->endTime = 0;
		$healthModestr->set = 0;
		$healthModestr->valid = 0;
		$healthModestr->canClose = 1;
		$healthModestr->date = "1970-01-01|1970-01-07";}
	} else if($_SGLOBAL['timestamp'] < $healthModestr->beginTime && $healthModestr->beginTime !=0){
		$set = 1; $valid = 0; $canClose = 1;
	} else {$set = 1; $valid = 1; $canClose = 0;}

	$code == 0 && $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set healthMode='".json_encode($healthModestr)."' where uid=".$UID );

	$Status = json_decode( $list[0][Status] );	 
	//$Status->farmlandstatus = array_values($Status->farmlandstatus);//修复数据
	$activeItem = $list[0][activeItem];
	$canbad =$list[0][badnum];
	foreach ( $Status->farmlandstatus as $key => $value ){
		if ( $key < $list[0][reclaim] ){
			$Statusarr[] = json_encode( $value );
		}
	}
	$Statusarr = json_encode( $Statusarr );
	$Statusarr = str_replace( "\"{", "{", $Statusarr );
	$Statusarr = str_replace( "}\"", "}", $Statusarr );
	$Statusarr = str_replace( "\\\"", "\"", $Statusarr );
	$decorativearr = (array)json_decode( $list[0][decorative] );
	$decorative_j = json_decode( $list[0][decorative]);
	$decorativesql = 0;
    foreach ( $decorativearr as $itemtype => $value ){
		$value_arr = (array)$value;
    	foreach ( $value_arr as $key => $value1 ){
            if ( $value1->status == 1 ){
                    if ( $_SGLOBAL['timestamp'] < $value1->validtime || $value1->validtime == 1 ){
							$decorativearr_srt[$itemtype]["itemId"]=$key;
                    }else{
                            unset($decorative_j->$itemtype->$key);
                            $decorativesql = 1;
                            $decorative_j->$itemtype->$itemtype->status = 1;
							$decorativearr_srt[$itemtype]["itemId"]=$itemtype;
                    }
            }else{
                    if($value1->validtime != 1 && $_SGLOBAL['timestamp'] >= $value1->validtime){
                            unset($decorative_j->$itemtype->$key);
                            $decorativesql = 1;
               		}
            	}
    		}
    	}
    $decorativesql == 1 && $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set decorative='".json_encode( $decorative_j )."' where uid=".$UID );
	$decorative_srt = str_replace( "\"{", "{", $decorative_srt );
	$decorative_srt = str_replace( "}\"", "}", $decorative_srt );
	$decorative_srt = str_replace( "[", "", $decorative_srt );
	$decorative_srt = str_replace( "]", "", $decorative_srt );

	$dog = ( array )json_decode($list[0][dog]);
	$dogstr["dogId"]=0;
	$dogstr["isHungry"]=0;

	if ( $_SGLOBAL['timestamp'] > $dog[dogFeedTime] ){
		$dogstr["isHungry"] = 1;
	}	else	{
		$dogstr["isHungry"] = 0;
	}
	if($dog) {
		foreach ( $dog[dogs] as $key => $value ){
			if ( $value->status == 1 )
			{
				$decorativearr_srt["8"]["itemId"]=80000+$key;
				$dogstr["dogId"] = $key ;
			}
		}
	}
	if ( $activeItem > 0 ){	$decorativearr_srt["9"]["itemId"]=$activeItem;}

	$taskid = "";
	if ( $list[0][taskid] < 12 ){
		$taskid = ",\"task\":{\"taskId\":".$list[0][taskid].",\"taskFlag\":1}";
	}
	if ( $list[0][taskid] == 1 ){
		$taskid = ",\"task\":{\"taskId\":".$list[0][taskid].",\"taskFlag\":1},\"welcome\":1";
	}
	if ( $list[0][vip] > 0 ){$yellowstatus = 1;	}else{$yellowstatus = 0;}
	$tqq='\u96E8\u5929'; if ($list[0][tianqi]==1){$tqq='\u6674\u5929';}
	$dogstr = json_encode( $dogstr );
	$decorative_srt = json_encode( $decorativearr_srt );

	echo "{\"a\":".$list[0][mc_a].",\"b\":1,\"c\":".$list[0][jb].",\"cacheControl\":{\"diy\":3,\"seed\":11,\"tool\":1},\"d\":".$list[0][nc_d].",\"dog\":".$dogstr.",\"e\":0,\"exp\":".$list[0][exp].",\"farmlandStatus\":".$Statusarr.",\"items\":".$decorative_srt.",\"serverTime\":{\"time\":".$_SGLOBAL['timestamp']."}".$taskid.",\"user\":{\"canbad\":".$canbad.",\"exp\":".$list[0][exp].",\"headPic\":\"".getheadPic( $_SGLOBAL[supe_uid], "small", TRUE )."\",\"healthMode\":{\"beginTime\":".$healthModestr->beginTime.",\"canClose\":".$canClose.",\"date\":\"".$healthModestr->date."\",\"endTime\":".$healthModestr->endTime.",\"serverTime\":".$_SGLOBAL['timestamp'].",\"set\":".$set.",\"time\":\"".$healthModestr->time."\",\"valid\":".$valid."},\"missionTime\":1264662936,\"money\":".$list[0][money].",\"pf\":".$list[0][pf].",\"uId\":".$UID.",\"userName\":\"".$spacename."\",\"yellowlevel\":".$list[0][vip].",\"yellowstatus\":".$yellowstatus."},\"weather\":{\"weatherDesc\":\"".$tqq."\",\"weatherId\":".$list[0][tianqi]."}}";
	exit( );
	}
	else
	{
		$uIdx = $_REQUEST['ownerId'];
	
	$query = $_SGLOBAL['db']->query( "SELECT C.uid,C.money,C.pf,C.vip,C.yb,N.Status,N.reclaim,N.exp,N.taskid,N.badnum,N.dog,N.decorative,N.activeItem,N.healthMode FROM  ".tname( "happyfarm_config" )." C Left JOIN ".tname( "happyfarm_nc" )." N ON N.uid=C.uid where C.uid=".$uIdx );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$healthModestr = json_decode( $list[0][healthMode]);
	if($_SGLOBAL['timestamp'] > $healthModestr->endTime)
	{	$set = 0; $valid = 0; $canClose = 1;
		if($healthModestr->valid !=0){
		$code = 0;
		$healthModestr->beginTime = 0;
		$healthModestr->endTime = 0;
		$healthModestr->set = 0;
		$healthModestr->valid = 0;
		$healthModestr->canClose = 1;
		$healthModestr->date = "1970-01-01|1970-01-07";}
	} else if($_SGLOBAL['timestamp'] < $healthModestr->beginTime && $healthModestr->beginTime !=0){
		$set = 1; $valid = 0; $canClose = 1;
	} else {$set = 1; $valid = 1; $canClose = 0;}

	$Status = json_decode( $list[0][Status] );
	//$Status->farmlandstatus = array_values($Status->farmlandstatus);//修复数据
	$activeItem = $list[0][activeItem];
	foreach ( $Status->farmlandstatus as $key => $value ){
		if ( $key < $list[0][reclaim] ){
			$Statusarr[] = json_encode( $value );
		}
	}
	$Statusarr = json_encode( $Statusarr );
	$Statusarr = str_replace( "\"{", "{", $Statusarr );
	$Statusarr = str_replace( "}\"", "}", $Statusarr );
	$Statusarr = str_replace( "\\\"", "\"", $Statusarr );
	$decorativearr = (array)json_decode( $list[0][decorative] );
	$decorative_j = json_decode( $list[0][decorative]);
	$decorativesql = 0;
    foreach ( $decorativearr as $itemtype => $value ){
		$value_arr = (array)$value;
    	foreach ( $value_arr as $key => $value1 ){
            if ( $value1->status == 1 ){
                    if ( $_SGLOBAL['timestamp'] < $value1->validtime || $value1->validtime == 1 ){
							$decorativearr_srt[$itemtype]["itemId"]=$key;
                    }else{
                            unset($decorative_j->$itemtype->$key);
                            $decorativesql = 1;
                            $decorative_j->$itemtype->$itemtype->status = 1;
							$decorativearr_srt[$itemtype]["itemId"]=$itemtype;
                    }
            }else{
                    if($value1->validtime != 1 && $_SGLOBAL['timestamp'] >= $value1->validtime){
                            unset($decorative_j->$itemtype->$key);
                            $decorativesql = 1;
               		}
            	}
    		}
    	}
    $decorativesql == 1 && $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set decorative='".json_encode( $decorative_j )."' where uid=".$uIdx );
	$decorative_srt = str_replace( "\"{", "{", $decorative_srt );
	$decorative_srt = str_replace( "}\"", "}", $decorative_srt );
	$decorative_srt = str_replace( "[", "", $decorative_srt );
	$decorative_srt = str_replace( "]", "", $decorative_srt );

	$dog = ( array )json_decode($list[0][dog]);
	$dogstr["dogId"]=0;
	$dogstr["isHungry"]=0;
	if ( $_SGLOBAL['timestamp'] > $dog[dogFeedTime] )
	{
		$dogstr["isHungry"] = 1;
	}
	else
	{
		$dogstr["isHungry"] = 0;
	}
	if($dog) {
		foreach ( $dog[dogs] as $key => $value ){
			if ( $value->status == 1 )
			{
				$decorativearr_srt["8"]["itemId"]=80000+$key;
				$dogstr["dogId"] = $key ;
			}
		}
	}
	if ( $activeItem > 0 )
	{
		$decorativearr_srt["9"]["itemId"]=$activeItem;
	}
	$taskid = "";
	if ( $list[0][taskid] < 12 )
	{
		$taskid = ",\"task\":{\"taskId\":".$list[0][taskid].",\"taskFlag\":1}";
	}
	if ( $list[0][taskid] == 1 )
	{
		$taskid = ",\"task\":{\"taskId\":".$list[0][taskid].",\"taskFlag\":1},\"welcome\":1";
	}
	if ( $space['name'] == "" )
	{
		$space['name'] = $space['username'];
	}
	if ( $list[0][vip] > 0 ){$yellowstatus = 1;}else{$yellowstatus = 0;	}

	$dogstr = json_encode( $dogstr );
	$decorative_srt = json_encode( $decorativearr_srt );
		echo "{\"a\":0,\"c\":0,\"dog\":".$dogstr.",\"exp\":".$list[0][exp].",\"farmlandStatus\":".$Statusarr.",\"items\":".$decorative_srt.",\"user\":{\"healthMode\":{\"beginTime\":".$healthModestr->beginTime.",\"canClose\":".$canClose.",\"date\":\"".$healthModestr->date."\",\"endTime\":".$healthModestr->endTime.",\"serverTime\":".$_SGLOBAL['timestamp'].",\"set\":".$set.",\"time\":\"".$healthModestr->time."\",\"valid\":".$valid."},\"pf\":".$list[0][pf]."}}";
	exit( );
	}
}//访问自己和别人农场

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "getOutput" ){//作物输出
	if ( $_REQUEST['ownerId'] == 0 )
	{
	$query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farmarr = json_decode( $list[0][Status] );
	$a = $farmarr->farmlandstatus[$_REQUEST['place']]->a;
	$b = $farmarr->farmlandstatus[$_REQUEST['place']]->b;
	$c = $farmarr->farmlandstatus[$_REQUEST['place']]->c;
	$d = $farmarr->farmlandstatus[$_REQUEST['place']]->d;
	$e = $farmarr->farmlandstatus[$_REQUEST['place']]->e;
	$f = $farmarr->farmlandstatus[$_REQUEST['place']]->f;
	$g = $farmarr->farmlandstatus[$_REQUEST['place']]->g;
	$h = $farmarr->farmlandstatus[$_REQUEST['place']]->h;
	$i = $farmarr->farmlandstatus[$_REQUEST['place']]->i;
	$j = $farmarr->farmlandstatus[$_REQUEST['place']]->j;
	$k = $farmarr->farmlandstatus[$_REQUEST['place']]->k;
	$l = $farmarr->farmlandstatus[$_REQUEST['place']]->l;
	$m = $farmarr->farmlandstatus[$_REQUEST['place']]->m;
	$n = $farmarr->farmlandstatus[$_REQUEST['place']]->n;
	$o = $farmarr->farmlandstatus[$_REQUEST['place']]->o;
	$p = $farmarr->farmlandstatus[$_REQUEST['place']]->p;
	$q = $farmarr->farmlandstatus[$_REQUEST['place']]->q;
	$r = $farmarr->farmlandstatus[$_REQUEST['place']]->r;
	$p = (array)$farmarr->farmlandstatus[$_REQUEST['place']]->p;
	$zuowutime = $_SGLOBAL['timestamp'] - $q;
	if ( $zuowutime < $cropstype[$a][growthCycle] ){
		exit( );
	}
	$b = 6;
	$c = 0;
	$d = 0;
	$e = 1;
	$f = 0;
	$g = 0;
	$h = 1;
	$j = $farmarr->farmlandstatus[$_REQUEST['place']]->j;
	$k = $cropstype[$a][output];
	foreach($p as $pk=>$pv){if($pv == 1 or $pv == 2) {$cnt += ceil(($_SGLOBAL['timestamp'] - $pk)/300)+1;} else if($pv == 3) {$cnt += ceil(($_SGLOBAL['timestamp'] - $pk)/300)*2+2;	}}
	if($cnt > 50){$cnt = 50;}
    $k = ceil($k*(100-$cnt)/100);
	$l = floor ($k * 0.6);
	$m = $k;
	$farmarr->farmlandstatus[$_REQUEST['place']]->b = $b;
	$farmarr->farmlandstatus[$_REQUEST['place']]->c = $c;
	$farmarr->farmlandstatus[$_REQUEST['place']]->d = $d;
	$farmarr->farmlandstatus[$_REQUEST['place']]->e = $e;
	$farmarr->farmlandstatus[$_REQUEST['place']]->f = $f;
	$farmarr->farmlandstatus[$_REQUEST['place']]->g = $g;
	$farmarr->farmlandstatus[$_REQUEST['place']]->h = $h;
	$farmarr->farmlandstatus[$_REQUEST['place']]->j = $j;
	$farmarr->farmlandstatus[$_REQUEST['place']]->k = $k;
	$farmarr->farmlandstatus[$_REQUEST['place']]->l = $l;
	$farmarr->farmlandstatus[$_REQUEST['place']]->m = $m;
	$farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".json_encode( $farmarr )."' where uid=".$UID );

	echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"status\":{\"action\":".json_encode( $p ).",\"cId\":".$a.",\"cropStatus\":".$b.",\"fertilize\":".$o.",\"harvestTimes\":".$j.",\"health\":".$i.",\"humidity\":".$h.",\"leavings\":".$m.",\"min\":".$l.",\"oldhumidity\":".$e.",\"oldpest\":".$d.",\"oldweed\":".$c.",\"output\":".$k.",\"pest\":".$g.",\"plantTime\":".json_encode( $q ).",\"thief\":".json_encode( $n ).",\"updateTime\":".json_encode( $r ).",\"weed\":".$f."}}";
	exit( );
	}
	else
	{
		$uIdx = $_REQUEST['ownerId'];
    $query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_nc" )." where uid=".$uIdx );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farmarr = json_decode( $list[0][Status] );
	$a = $farmarr->farmlandstatus[$_REQUEST['place']]->a;
	$b = $farmarr->farmlandstatus[$_REQUEST['place']]->b;
	$c = $farmarr->farmlandstatus[$_REQUEST['place']]->c;
	$d = $farmarr->farmlandstatus[$_REQUEST['place']]->d;
	$e = $farmarr->farmlandstatus[$_REQUEST['place']]->e;
	$f = $farmarr->farmlandstatus[$_REQUEST['place']]->f;
	$g = $farmarr->farmlandstatus[$_REQUEST['place']]->g;
	$h = $farmarr->farmlandstatus[$_REQUEST['place']]->h;
	$i = $farmarr->farmlandstatus[$_REQUEST['place']]->i;
	$j = $farmarr->farmlandstatus[$_REQUEST['place']]->j;
	$k = $farmarr->farmlandstatus[$_REQUEST['place']]->k;
	$l = $farmarr->farmlandstatus[$_REQUEST['place']]->l;
	$m = $farmarr->farmlandstatus[$_REQUEST['place']]->m;
	$n = $farmarr->farmlandstatus[$_REQUEST['place']]->n;
	$o = $farmarr->farmlandstatus[$_REQUEST['place']]->o;
	$p = $farmarr->farmlandstatus[$_REQUEST['place']]->p;
	$q = $farmarr->farmlandstatus[$_REQUEST['place']]->q;
	$r = $farmarr->farmlandstatus[$_REQUEST['place']]->r;
	$p = (array)$farmarr->farmlandstatus[$_REQUEST['place']]->p;
	$zuowutime = $_SGLOBAL['timestamp'] - $q;
	if ( $zuowutime < $cropstype[$a][growthCycle] ){
		exit( );
	}
	$b = 6;
	$c = 0;
	$d = 0;
	$e = 1;
	$f = 0;
	$g = 0;
	$h = 1;
	$j = $farmarr->farmlandstatus[$_REQUEST['place']]->j;
	$k = $cropstype[$a][output];
	foreach($p as $pk=>$pv){if($pv == 1 or $pv == 2) {$cnt += ceil(($_SGLOBAL['timestamp'] - $pk)/300)+1;} else if($pv == 3) {$cnt += ceil(($_SGLOBAL['timestamp'] - $pk)/300)*2+2;	}}
	if($cnt > 50){$cnt = 50;}
    $k = ceil($k*(100-$cnt)/100);
	$l = floor ($k * 0.6);
	$m = $k;
	$farmarr->farmlandstatus[$_REQUEST['place']]->b = $b;
	$farmarr->farmlandstatus[$_REQUEST['place']]->c = $c;
	$farmarr->farmlandstatus[$_REQUEST['place']]->d = $d;
	$farmarr->farmlandstatus[$_REQUEST['place']]->e = $e;
	$farmarr->farmlandstatus[$_REQUEST['place']]->f = $f;
	$farmarr->farmlandstatus[$_REQUEST['place']]->g = $g;
	$farmarr->farmlandstatus[$_REQUEST['place']]->h = $h;
	$farmarr->farmlandstatus[$_REQUEST['place']]->j = $j;
	$farmarr->farmlandstatus[$_REQUEST['place']]->k = $k;
	$farmarr->farmlandstatus[$_REQUEST['place']]->l = $l;
	$farmarr->farmlandstatus[$_REQUEST['place']]->m = $m;
	$farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".json_encode( $farmarr )."' where uid=".$uIdx );

	echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"status\":{\"action\":".json_encode( $p ).",\"cId\":".$a.",\"cropStatus\":".$b.",\"fertilize\":".$o.",\"harvestTimes\":".$j.",\"health\":".$i.",\"humidity\":".$h.",\"leavings\":".$m.",\"min\":".$l.",\"oldhumidity\":".$e.",\"oldpest\":".$d.",\"oldweed\":".$c.",\"output\":".$k.",\"pest\":".$g.",\"plantTime\":".json_encode( $q ).",\"thief\":".json_encode( $n ).",\"updateTime\":".json_encode( $r ).",\"weed\":".$f."}}";
	exit( );
	}
}//作物输出

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "harvest" ){//收获作物
	$query = $_SGLOBAL['db']->query( "SELECT Status,fruit,package,tools,dog FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farmarr = json_decode( $list[0][Status] );
	$fruitarr = json_decode( $list[0][fruit]);
	$packagearr = json_decode($list[0][package]);
	$toolsarr = json_decode($list[0][tools]);
	$dogarr = json_decode($list[0][dog]);

	$pieces = explode(",", $_REQUEST['place']);
	foreach ( $pieces as $key => $value )
	{
		$cid = $farmarr->farmlandstatus[$pieces[$key]]->a;
		if ($cid == 0)
		{exit( );}
		if ( $farmarr->farmlandstatus[$pieces[$key]]->b != 6 )
		{exit( );}
		if ($farmarr->farmlandstatus[$pieces[$key]]->j == 0&& $_SGLOBAL['timestamp'] - $farmarr->farmlandstatus[$pieces[$key]]->q < $cropstime[$farmarr->farmlandstatus[$pieces[$key]]->a][4] )
		{exit( );}
		if ($farmarr->farmlandstatus[$pieces[$key]]->j > 0 && $_SGLOBAL['timestamp'] - $farmarr->farmlandstatus[$pieces[$key]]->q < $cropstime[$farmarr->farmlandstatus[$pieces[$key]]->a][4] )
		{exit( );}
		$output = $farmarr->farmlandstatus[$pieces[$key]]->m;
		$fruitarr->$cid = $fruitarr->$cid + $output;
		$harvest = $farmarr->farmlandstatus[$pieces[$key]]->m;

		$farmarr->farmlandstatus[$pieces[$key]]->c = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->d = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->e = 1;
		$farmarr->farmlandstatus[$pieces[$key]]->f = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->g = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->h = 1;
		$farmarr->farmlandstatus[$pieces[$key]]->i = 100;
		$farmarr->farmlandstatus[$pieces[$key]]->k = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->l = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->m = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->n = array( );
		$farmarr->farmlandstatus[$pieces[$key]]->o = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->p = array( );
		$farmarr->farmlandstatus[$pieces[$key]]->q = 0;
		$farmarr->farmlandstatus[$pieces[$key]]->r = $_SGLOBAL['timestamp'];
		if ( $farmarr->farmlandstatus[$pieces[$key]]->j + 1 == $cropstype[$farmarr->farmlandstatus[$pieces[$key]]->a][maturingTime] )
		{
			$farmarr->farmlandstatus[$pieces[$key]]->b = 7;
			$farmarr->farmlandstatus[$pieces[$key]]->j = 0;
		}
		else
		{
			$farmarr->farmlandstatus[$pieces[$key]]->b = 6;
			$farmarr->farmlandstatus[$pieces[$key]]->j = $farmarr->farmlandstatus[$pieces[$key]]->j + 1;
			$farmarr->farmlandstatus[$pieces[$key]]->q = $_SGLOBAL['timestamp'] - $cropstime[$farmarr->farmlandstatus[$pieces[$key]]->a][2];
		}
		$exp_str = $exp_str + $cropstype[$farmarr->farmlandstatus[$pieces[$key]]->a][cropExp];

		/*红包start*/
		$redpackage = rand(1,100);
		if($redpackage < 3){
			if($redpackage < 2){
				$red_gift = "\"gift\":{\"direction\":\"\u60A8\u6253\u5F00\u4E86\u519C\u573A\u65B0\u5E74\u7EA2\u5305\uFF0C\u83B7\u5F97\u4EE5\u4E0B\u5956\u52B1\uFF1A\",\"item\":[{\"eNum\":3,\"eParam\":2,\"eType\":3},{\"eNum\":3,\"eParam\":111,\"eType\":1},{\"eNum\":200,\"eParam\":1,\"eType\":7}],\"title\":\"\u519C\u573A\u65B0\u5E74\u7EA2\u5305\"},";
				$bluerose = 111;
				$huafei = 2;
				$packagearr->$bluerose += 3;
				$toolsarr->$huafei += 3;
				$exp_str=$exp_str+200;

			} else {
				$red_gift = "\"gift\":{\"direction\":\"\u60A8\u6253\u5F00\u4E86\u519C\u573A\u65B0\u5E74\u7EA2\u5305\uFF0C\u83B7\u5F97\u4EE5\u4E0B\u5956\u52B1\uFF1A\",\"item\":[{\"eNum\":1,\"eParam\":3,\"eType\":3},{\"eNum\":2,\"eParam\":114,\"eType\":1},{\"eNum\":1,\"eParam\":9001,\"eType\":909090}],\"title\":\"\u519C\u573A\u65B0\u5E74\u7EA2\u5305\"},";
				$bluerose = 114;
				$huafei = 3;
				$packagearr->$bluerose += 2;
				$toolsarr->$huafei += 1;
				if($_SGLOBAL['timestamp'] < $dogarr->dogFeedTime){
					$dogarr->dogFeedTime += 3600*24;
				} else {
					$dogarr->dogFeedTime = $_SGLOBAL['timestamp']+3600*24;
				}
			}
		} else {
			$red_gift = '';
		}
		/*红包end*/

		$echo_str[] = json_decode("{\"code\":1,\"direction\":\"\",\"exp\":".$cropstype[$farmarr->farmlandstatus[$pieces[$key]]->a][cropExp].",\"farmlandIndex\":".$pieces[$key].",".$red_gift."\"harvest\":".$harvest.",\"levelUp\":false,\"poptype\":4,\"status\":{\"cId\":".$farmarr->farmlandstatus[$pieces[$key]]->a.",\"cropStatus\":".$farmarr->farmlandstatus[$pieces[$key]]->b.",\"fertilize\":".$farmarr->farmlandstatus[$pieces[$key]]->o.",\"harvestTimes\":".$farmarr->farmlandstatus[$pieces[$key]]->j.",\"oldweed\":".$farmarr->farmlandstatus[$pieces[$key]]->c.",\"oldpest\":".$farmarr->farmlandstatus[$pieces[$key]]->d.",\"oldhumidity\":".$farmarr->farmlandstatus[$pieces[$key]]->e.",\"weed\":".$farmarr->farmlandstatus[$pieces[$key]]->f.",\"pest\":".$farmarr->farmlandstatus[$pieces[$key]]->g.",\"humidity\":".$farmarr->farmlandstatus[$pieces[$key]]->h.",\"killer\":".json_encode( $farmarr->farmlandstatus[$pieces[$key]]->i ).",\"output\":".$farmarr->farmlandstatus[$pieces[$key]]->k.",\"min\":".$farmarr->farmlandstatus[$pieces[$key]]->l.",\"leavings\":".$farmarr->farmlandstatus[$pieces[$key]]->m.",\"thief\":{},\"action\":".json_encode( $farmarr->farmlandstatus[$pieces[$key]]->p ).",\"plantTime\":".$farmarr->farmlandstatus[$pieces[$key]]->q.",\"updateTime\":".$farmarr->farmlandstatus[$pieces[$key]]->r."}}");

		$repertory = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT repertory FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID) ), 0 );
		$repertory = json_decode( $repertory);
		$flag=false;
		foreach((array)$repertory ->r as $key=>$val)
		{
			if($cid == $val->cId)
			{
				$flag=true;
				$repertory->r[$key]->harvestNumber=$repertory->r[$key]->harvestNumber + $output;
			}
		}
		if(!$flag)
		{
			$cName=$cropstype[$cid][cName];
			$repertory->r[] = "{\"cId\":".$cid.",\"cName\":\"".$cName."\",\"harvestNumber\":".$output.",\"scroungeNumber\":0}";
		}
		$repertory = json_encode( $repertory );
		$repertory = str_replace( "\"{", "{", $repertory );
		$repertory = str_replace( "}\"", "}", $repertory );
		$repertory = str_replace( "\\u", "\\\u", $repertory );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set repertory='".$repertory."' where uid=".$UID );
	}
	$farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
	$farmarr_str = json_encode( $farmarr );
	$fruitarr = json_encode( $fruitarr );
	$packagearr = json_encode($packagearr);
	$toolsarr = json_encode($toolsarr);
	$dogarr = json_encode($dogarr);
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp=exp+".$exp_str.",Status='".$farmarr_str."',fruit='".$fruitarr."',package='".$packagearr."',tools='".$toolsarr."',dog='".$dogarr."' where uid=".$UID );
	echo json_encode($echo_str);

	include_once( S_ROOT."./source/function_cp.php" );
	$icon = "farm";
	$title_template = "{actor} tưới cây tại <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
	$body_general = "Chăm sóc rau màu để thu hoạch nhiều nhé";
	feed_add( $icon, $title_template );

	exit( );
}//收获作物

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "fertilize" ){//作物加肥
	if ( intval( $_REQUEST['ownerId'] ) == $UID)
	{
		$query = $_SGLOBAL['db']->query( "SELECT tools,Status FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$farmarr = json_decode( $list[0][Status] );
		$fertarr = json_decode( $list[0][tools] );
		if ( $fertarr->$_REQUEST['tId'] == 0 )
		{
			exit( );
		}
		$zuowutime = $_SGLOBAL['timestamp'] - $farmarr->farmlandstatus[$_REQUEST['place']]->q;
		$ii = 0;
		foreach ( $cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a] as $key => $value )
		{
			if ( $value <= $zuowutime )
			{
				$ii = $key + 1;
			}
		}
		if ( $farmarr->farmlandstatus[$_REQUEST['place']]->o == $ii + 1 )
		{
			exit( );
		}
		$zuowutime += $Toolstype[30000 + $_REQUEST['tId']][effect];

		if ( $cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a][$ii] < $zuowutime )
		{
			$zuowutime = $cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a][$ii];
		}
		$farmarr->farmlandstatus[$_REQUEST['place']]->q = $_SGLOBAL['timestamp'] - $zuowutime;
		$farmarr->farmlandstatus[$_REQUEST['place']]->o = $ii + 1;
		$a = $farmarr->farmlandstatus[$_REQUEST['place']]->a;
		if ( $zuowutime >= $cropstype[$a][growthCycle] )
		{
			$farmarr->farmlandstatus[$_REQUEST['place']]->b = 6;
			$farmarr->farmlandstatus[$_REQUEST['place']]->c = 0;
			$farmarr->farmlandstatus[$_REQUEST['place']]->d = 0;
			$farmarr->farmlandstatus[$_REQUEST['place']]->e = 1;
			$farmarr->farmlandstatus[$_REQUEST['place']]->f = 0;
			$farmarr->farmlandstatus[$_REQUEST['place']]->g = 0;
			$farmarr->farmlandstatus[$_REQUEST['place']]->h = 1;
			$farmarr->farmlandstatus[$_REQUEST['place']]->k = $cropstype[$a][output];
			$farmarr->farmlandstatus[$_REQUEST['place']]->l = floor ($cropstype[$a][output] * 0.6);
			$farmarr->farmlandstatus[$_REQUEST['place']]->m = $cropstype[$a][output];
		}

		$fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] - 1;
		$farmarr_str = json_encode( $farmarr );
		foreach($fertarr as $key => $value){
                if($value == 0){unset($fertarr->$key);}
                }
        $farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
		$fertarr = json_encode( $fertarr );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_str."',tools='".$fertarr."' where uid=".$UID );

		$cId = $farmarr->farmlandstatus[$_REQUEST['place']]->a;
		$cropStatus = $farmarr->farmlandstatus[$_REQUEST['place']]->b;
		$oldweed = $farmarr->farmlandstatus[$_REQUEST['place']]->c;
		$oldpest = $farmarr->farmlandstatus[$_REQUEST['place']]->d;
		$oldhumidity = $farmarr->farmlandstatus[$_REQUEST['place']]->e;
		$weed = $farmarr->farmlandstatus[$_REQUEST['place']]->f;
		$pest = $farmarr->farmlandstatus[$_REQUEST['place']]->g;
		$humidity = $farmarr->farmlandstatus[$_REQUEST['place']]->h;
		$health = $farmarr->farmlandstatus[$_REQUEST['place']]->i;
		$harvestTimes = $farmarr->farmlandstatus[$_REQUEST['place']]->j;
		$output = $farmarr->farmlandstatus[$_REQUEST['place']]->k;
		$min = $farmarr->farmlandstatus[$_REQUEST['place']]->l;
		$leavings = $farmarr->farmlandstatus[$_REQUEST['place']]->m;
		$thief = json_encode($farmarr->farmlandstatus[$_REQUEST['place']]->n);
		$fertilize = $farmarr->farmlandstatus[$_REQUEST['place']]->o;
		$action = json_encode($farmarr->farmlandstatus[$_REQUEST['place']]->p);
		$plantTime = $farmarr->farmlandstatus[$_REQUEST['place']]->q;
		$updateTime = $farmarr->farmlandstatus[$_REQUEST['place']]->r;

		echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"code\":1,\"tId\":".$_REQUEST['tId'].",\"status\":{\"cId\":".$cId.",\"cropStatus\":".$cropStatus.",\"oldweed\":".$oldweed.",\"oldpest\":".$oldpest.",\"oldhumidity\":".$oldhumidity.",\"weed\":".$weed.",\"pest\":".$pest.",\"humidity\":".$humidity.",\"health\":".$health.",\"harvestTimes\":".$harvestTimes.",\"output\":".$output.",\"min\":".$min.",\"leavings\":".$leavings.",\"thief\":\"".$thief."\",\"fertilize\":".$fertilize.",\"action\":".$action.",\"plantTime\":".$plantTime.",\"updateTime\":".$updateTime."}}";
		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} tưới cây tại <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
		$body_general = "Cùng tham gia vào hội nông dân Nhà Tui nhé!";
		feed_add( $icon, $title_template, NULL, NULL, NULL, NULL );
		exit( );
	}
}//作物加肥

if ( $_REQUEST['mod'] == "friend"){//好友列表

	if ( $_REQUEST['false'] == "refresh" )
	{
		echo "{\"code\":0}";
		exit( );
	}
	if ( !empty( $space[friend] ) )
	{
		$space[friend] = $space[friend].",";
	}

    $Config = $_SGLOBAL['db']->query( "SELECT C.uid,C.money,C.pf,C.vip,N.exp,S.username,S.name FROM ".tname( "happyfarm_config" )." C Left JOIN ".tname( "happyfarm_nc" )." N ON N.uid=C.uid LEFT JOIN ".tname( "space" )." S ON S.uid=C.uid WHERE C.uid IN (".$space[friend].$UID.")limit 0,300");
    while ( $value = $_SGLOBAL['db']->fetch_array( $Config ) )
    {
       $list[] =$value;
    }
	$jishu = 0;
	foreach ( $list as $key => $value )
	{
		++$jishu;
		if ( 300 < $jishu )
		{
			break;
		}
		if ( empty( $value[name] ) )
		{
			$value[name] = $value[username];
		}
		$friendavatarimage = getheadPic($value[uid], 'small', true);
		$exp = $value[exp];
		$pf = $value[pf];
		if ($value[exp] < 1)
		{
			$exp = 0;
			$pf = 0;
		}
		if ( $value[vip] > 0 )
		{
			$yellowstatus = 1;
		}
		else
		{
			$yellowstatus = 0;
		}
		$friend_str[] = "{\"userId\":".$value[uid].",\"uin\":".$value[uid].",\"userName\":\"".unicode_encode( $value[name] )."\",\"headPic\":\"".$friendavatarimage."\",\"yellowlevel\":".$value[vip].",\"yellowstatus\":".$yellowstatus.",\"exp\":".$exp.",\"money\":".$value[money].",\"pf\":".$pf."}";
	}
	$friend_str = json_encode( $friend_str );
	$friend_str = str_replace( "\"{", "{", $friend_str );
	$friend_str = str_replace( "}\"", "}", $friend_str );
	$friend_str = str_replace( "\\/", "\\\\/", $friend_str );
	$friend_str = str_replace( ",null,", ",", $friend_str );
	echo stripslashes( $friend_str );
	exit( );
}//好友列表

if ( $_REQUEST['cmd'] == "1" || $_REQUEST['cmd'] == "3" ){  //好友状态
	if ( !empty( $space[friend] ) )
	{
		$space[friend] = $space[friend].",";
	}
	$query = $_SGLOBAL['db']->query( "SELECT uid,Status FROM ".tname( "happyfarm_nc" )." WHERE uid IN (".$space[friend].$UID.")limit 0,300");

	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
    {
       $list[] =$value;
    }
	$jishu = 0;
	foreach ( $list as $key => $value )
	{
		++$jishu;
		if ( 300 < $jishu ){
			break;
		}
		$farm_Status = json_decode( $value[Status]);
		foreach ($farm_Status->farmlandstatus as $key => $value_1 )
		{
			$cId = intval($value_1->a);
			if ( $cId > 0 )
			{
				$time1 = $cropstime[$cId][4];
				$time3 = $_SGLOBAL['timestamp'] - $value_1->q;
                $flag = $time3 >= $time1;
				if ( $flag && $value_1->q > 0){
					if($value_1->m == 0){
						$temp = $value_1->q + $time1;
						$n = $value_1->n;
						if ( !isset($n->$UID) )	{
							$exp[$value['uid']]["1"] = $temp;	
						}
					} else {
						if($value_1->m > $value_1->l){
							$temp = $value_1->q + $time1;
							$n = $value_1->n;
							if ( !isset($n->$UID) )	{
								$exp[$value['uid']]["1"] = $temp;	
							}
						}
					}
				}else if(!$flag && $value_1->a!='0'){
					if ( $value_1->f > 0){
						$exp[$value['uid']]["2"] = 1;
					}
					if ( $value_1->g > 0){
						$exp[$value['uid']]["3"] = 1;
					}
				}
			}
		}
	}
	$exp = json_encode( $exp );
	$int = strlen($exp);
	$str = substr( $exp, $int-1, 1 ); 
	if ( $str == "," ){
		$exp = substr( $exp, 0, $int-1 ); 
	}
	echo "{\"status\":".$exp."}";
	exit( );
}//好友状态

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "scrounge" ){//偷取作物
	$query = $_SGLOBAL['db']->query( "SELECT Status,log,dog FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) ){
		$list[] = $value;
	}
	$query = $_SGLOBAL['db']->query( "SELECT fruit,repertory FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) ){
		$list[] = $value;
	}
	$farm_Status = json_decode( $list[0][Status] );
	$farm_dog = json_decode( $list[0][dog] );
	$farm_log = json_decode( $list[0][log] );
	$farm_fruit = json_decode( $list[1][fruit] );
	$farm_repertory = json_decode( $list[1][repertory] );

	$pieces = explode(",", $_REQUEST['place']);
	foreach ( $pieces as $key => $value )
	{
		$id = $pieces[$key];
		$a = $farm_Status->farmlandstatus[$id]->a;
		$b = $farm_Status->farmlandstatus[$id]->b;
		$c = $farm_Status->farmlandstatus[$id]->c;
		$d = $farm_Status->farmlandstatus[$id]->d;
		$e = $farm_Status->farmlandstatus[$id]->e;
		$f = $farm_Status->farmlandstatus[$id]->f;
		$g = $farm_Status->farmlandstatus[$id]->g;
		$h = $farm_Status->farmlandstatus[$id]->h;
		$i = $farm_Status->farmlandstatus[$id]->i;
		$j = $farm_Status->farmlandstatus[$id]->j;
		$k = $farm_Status->farmlandstatus[$id]->k;
		$l = $farm_Status->farmlandstatus[$id]->l;
		$m = $farm_Status->farmlandstatus[$id]->m;
		$n = (array)$farm_Status->farmlandstatus[$id]->n;
		$o = $farm_Status->farmlandstatus[$id]->o;
		$p = (array)$farm_Status->farmlandstatus[$id]->p;
		$q = $farm_Status->farmlandstatus[$id]->q;
		$r = $farm_Status->farmlandstatus[$id]->r;
		$n_temp = array_flip($n);
		if (in_array($UID,$n_temp))	{
			echo "{\"errorContent\":\"unknow act\",\"errorType\":\"act\"}";
			exit ();
		}
		else
		{
			if ( $_SGLOBAL['timestamp'] < $farm_dog->dogFeedTime )
			{
				foreach ( (array)$farm_dog->dogs as $key => $value )
				{
					if ( $value->status == 1 )
					{
						$int1_temp = rand(1,10);
						if($int1_temp > 10 - $key) {
							$dog_money = $cropstype[$a][sale];
							$int2_temp=rand(1,10);
							if($int2_temp > 8){
								$dog_money = $dog_money + round(20 * rand(1,30) / 5 ) * rand(1,2);
							}else{
								$dog_money = $dog_money + round(10 * rand(1,20) / 5);
							}
							$n[$UID]=0;
							$farm_Status->farmlandstatus[$id]->a = $a;
							$farm_Status->farmlandstatus[$id]->b = $b;
							$farm_Status->farmlandstatus[$id]->c = $c;
							$farm_Status->farmlandstatus[$id]->d = $d;
							$farm_Status->farmlandstatus[$id]->e = $e;
							$farm_Status->farmlandstatus[$id]->f = $f;
							$farm_Status->farmlandstatus[$id]->g = $g;
							$farm_Status->farmlandstatus[$id]->h = $h;
							$farm_Status->farmlandstatus[$id]->i = $i;
							$farm_Status->farmlandstatus[$id]->j = $j;
							$farm_Status->farmlandstatus[$id]->k = $k;
							$farm_Status->farmlandstatus[$id]->l = $l;
							$farm_Status->farmlandstatus[$id]->m = $m;
							$farm_Status->farmlandstatus[$id]->n = $n;
							$farm_Status->farmlandstatus[$id]->o = $o;
							$farm_Status->farmlandstatus[$id]->p = $p;
							$farm_Status->farmlandstatus[$id]->q = $q;
							$farm_Status->farmlandstatus[$id]->r = $r;
							$dog_str ="\\u4F60\\u5728\\u5077\\u7A83\\u8FC7\\u7A0B\\u4E2D\\u88ABTA\\u7684\\u72D7\\u72D7\\u53D1\\u73B0\\uFF0C\\u5728\\u9003\\u8DD1\\u8FC7\\u7A0B\\u4E2D\\u4E22\\u5931".$dog_money."\\u91D1\\u5E01\\u3002"; 
							$farm_Status->farmlandstatus = array_values($farm_Status->farmlandstatus);//修复数据
	                        $farmarr_str = json_encode($farm_Status);
							$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money = money + ".$dog_money." where uid=".intval( $_REQUEST['ownerId'] ) );
							$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money = money - ".$dog_money." where uid=".$UID );
                            $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_str."' where uid=".intval( $_REQUEST['ownerId'] ) );
						} else {
							$dog_str = '';
						}
					}
				}
			}

			if ( $dog_str == null )
			{
				$rand_number = rand(1,100);
				if($rand_number>0 and $rand_number<=50){$n[$UID]=1;	}else if($rand_number>50 and $rand_number<=70){	$n[$UID]=2;	}else if($rand_number>70 and $rand_number<=80){$n[$UID]=3;}else if($rand_number>80 and $rand_number<=95){$n[$UID]=4;}else{$n[$UID]=5;}
				$farm_fruit->$a += $n[$UID];
				$m -= $n[$UID];
				if ( $m < $l ){	exit( );}
				if (array_key_exists($a,(array)$msg_temp)){
					$msg_temp[$a] = $msg_temp[$a] + 1;
				}
				else{$msg_temp[$a] = 1;}
				$echo_str[]=json_decode("{\"code\":1,\"direction\":\"".$dog_str."\",\"farmlandIndex\":".$id.",\"harvest\":$n[$UID],\"poptype\":4,\"status\":{\"action\":".json_encode($p).",\"cId\":".$a.",\"cropStatus\":".$b.",\"fertilize\":".$o.",\"harvestTimes\":".$j.",\"health\":".$i.",\"humidity\":".$h.",\"leavings\":".$m.",\"min\":".$l.",\"oldhumidity\":".$e.",\"oldpest\":".$d.",\"oldweed\":".$c.",\"output\":".$k.",\"pest\":".$g.",\"plantTime\":".$q.",\"thief\":".json_encode($n).",\"updateTime\":".$r.",\"weed\":".$f."}}");
			}
			else
			{//被狗盯上了~~
				//$n[$UID]=0;
				if ( $m < $l ){	exit( );}
				if (array_key_exists (0,(array)$msg_temp)){
					$msg_temp[0] = $msg_temp[0] + $dog_money;
				}
				else{$msg_temp[0] = $dog_money;	}
				$echo_str[]=json_decode("{\"code\":1,\"direction\":\"".$dog_str."\",\"farmlandIndex\":".$id.",\"harvest\":0,\"poptype\":3,\"money\":-".$dog_money."}");
			}
			$farm_Status->farmlandstatus[$id]->a = $a;
			$farm_Status->farmlandstatus[$id]->b = $b;
			$farm_Status->farmlandstatus[$id]->c = $c;
			$farm_Status->farmlandstatus[$id]->d = $d;
			$farm_Status->farmlandstatus[$id]->e = $e;
			$farm_Status->farmlandstatus[$id]->f = $f;
			$farm_Status->farmlandstatus[$id]->g = $g;
			$farm_Status->farmlandstatus[$id]->h = $h;
			$farm_Status->farmlandstatus[$id]->i = $i;
			$farm_Status->farmlandstatus[$id]->j = $j;
			$farm_Status->farmlandstatus[$id]->k = $k;
			$farm_Status->farmlandstatus[$id]->l = $l;
			$farm_Status->farmlandstatus[$id]->m = $m;
			$farm_Status->farmlandstatus[$id]->n = $n;
			$farm_Status->farmlandstatus[$id]->o = $o;
			$farm_Status->farmlandstatus[$id]->p = $p;
			$farm_Status->farmlandstatus[$id]->q = $q;
			$farm_Status->farmlandstatus[$id]->r = $r;
		}
	}
	foreach ( $msg_temp as $key_log => $value )
	{
		if ( $key_log < 10000 )
		{
			if ( $key_log == 0 )
			{
				$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."<\/b><\/font> \\u6765\\u519C\\u573A\\u6458\\u53D6\\u88AB\\u72D7\\u72D7\\u53D1\\u73B0\\u4E86\\uFF0C\\u5B83\\u4E3A\\u4E3B\\u4EBA\\u6293\\u83B7".$value."\\u4E2A\\u91D1\\u5E01\\u3002";
			}
			else
			{
				$cName=$cropstype[$key_log][cName];
				$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."<\/b><\/font> \\u6765\\u519C\\u573A\\u6458\\u53D6\\uFF0C\\u6458\\u8D70".$value."\\u4E2A".$cName;

				foreach((array)$farm_repertory->r as $key_1=>$value_1)
				{
					if($key_log == $value_1->cId)
					{
						$flag=true;
						$farm_repertory->r[$key_1]->scroungeNumber += $value;
					}
				}
				if(!$flag)
				{
					$farm_repertory->r[] = "{\"cId\":".$key_log.",\"cName\":\"".$cName."\",\"harvestNumber\":0,\"scroungeNumber\":".$value."}";
				}
			}
			$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";
		}
	}
	$farm_Status->farmlandstatus = array_values($farm_Status->farmlandstatus);//修复数据
	$farmarr_str = json_encode($farm_Status);
	$fruitarr = json_encode( $farm_fruit );
	$farm_log = json_encode( $farm_log );
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );

	$repertory = json_encode( $farm_repertory );
	$repertory = str_replace( "\"{", "{", $repertory );
	$repertory = str_replace( "}\"", "}", $repertory );
	$repertory = str_replace( "\\u", "\\\u", $repertory );

	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_str."',log='".$farm_log."' where uid=".intval( $_REQUEST['ownerId'] ) );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set fruit='".$fruitarr."',repertory='".$repertory."' where uid=".$UID );


	echo json_encode($echo_str);
	exit( );
}//偷取作物

if ( $_REQUEST['mod'] == "dog" && $_REQUEST['act'] == "feedMoney" ){
	$query = $_SGLOBAL['db']->query( "SELECT dog FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$dog = (array) json_decode( $list[0][dog] );
	$Feed = $dog[dogFeedTime] - $_SGLOBAL['timestamp'];
	$hours = floor( $Feed / 3600);
	if ( $hours < 0 )
	{
		$hours = 0;
	}
	echo "{\"hours\":".$hours.",\"saleOut\":false}";
	exit( );
}

if ( $_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "getSeedInfo" ){
	foreach ( $cropstype as $key => $value )
	{
				if ( !in_array($value['cId'], $randseed) ) {
			$shop_list[] = $value;
		}
	}
	$shop_list_str = json_encode($shop_list);
	$shop_list_str = str_replace( "\\\u", "\u", $shop_list_str );
	echo $shop_list_str;
	exit( );
}

if ( $_REQUEST['mod'] == "usertool" && $_REQUEST['act'] == "getTools" ){
	foreach ( $Toolstype as $key => $value )
	{
		$Tools_list[] = $value;
	}
	$Tools_list_str = json_encode($Tools_list);
	$Tools_list_str = str_replace( "\\\u", "\u", $Tools_list_str );
	echo $Tools_list_str;
	exit( );
}

if ( $_REQUEST['mod'] == "item" && $_REQUEST['act'] == "shop" ){
	foreach ( $itemtype as $key => $value )
	{
		$item_list[] = $value;
	}
	$item_list_str = json_encode($item_list);
	$item_list_str = str_replace( "\\\u", "\u", $item_list_str );
	echo $item_list_str;
	exit( );
}

if ( $_REQUEST['mod'] == "pf" && $_REQUEST['act'] == "ok" ){
	$vip = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT vip FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	if ( $vip > 0)
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set pf=1 where uid=".$UID );
		echo "{\"code\":1}";
	}
	else{
		echo "{\"code\":0}";
	}
	exit();
}

if ( $_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "getUserCrop" ){
	$fruit = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT fruit FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
	$fruit = ( array )json_decode( $fruit );
	$fruitarr = array( );
	foreach ( $fruit as $key => $value )
	{
		if ( 0 < $value )
		{
			$fruitarr[] = "{\"cId\":".$key.",\"cName\":\"".$cropstype[$key][cName]."\",\"level\":\"".$cropstype[$key][cLevel]."\",\"amount\":".$value.",\"price\":\"".$cropstype[$key][sale]."\"}";
		}
	}
    if( join($fruitarr) != '' ){ 
    $fruitarr = json_encode( $fruitarr );
    $fruitarr = str_replace( "\"{", "{", $fruitarr );
    $fruitarr = str_replace( "}\"", "}", $fruitarr );
        }else{
                $fruitarr = '[]';
        }
	echo stripslashes( $fruitarr );
	exit();
}


if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "scarify" ){//起地作物
	$query = $_SGLOBAL['db']->query( "SELECT Status,exp,package FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )      
	{
		$list[] = $value;
	}
	$farm_arr = json_decode( $list[0][Status] );

	if ( 0 < $farm_arr->farmlandstatus[$_REQUEST['place']]->a )
	{
		if (7 <= $farm_arr->farmlandstatus[$_REQUEST['place']]->b) {
			$jj = rand(1,10);
		    $scarifyexp = 3;
		} else {
			$scarifyexp = 0;
			$jj=2;
		}
		$farm_arr->farmlandstatus[$_REQUEST['place']]->a = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->b = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->c = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->d = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->e = 1;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->f = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->g = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->h = 1;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->i = 100;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->j = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->k = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->l = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->m = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->n = array( );
		$farm_arr->farmlandstatus[$_REQUEST['place']]->o = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->p = array( );
		$farm_arr->farmlandstatus[$_REQUEST['place']]->q = 0;
		$farm_arr->farmlandstatus[$_REQUEST['place']]->r = 0;
		$farm_arr->farmlandstatus = array_values($farm_arr->farmlandstatus);//修复数据
		$farm_arr = json_encode( $farm_arr );
		if ($jj==1 ) {
			$package = json_decode($list[0][package]);
			srand ((float) microtime() * 10000000);
			$input = $randseed;
			$rand_keys = array_rand ($input, 2);
			$zhongzi=$input[$rand_keys[1]];
			
			$num=rand(1,2);
			$package->$zhongzi = $package->$zhongzi + $num;
			$package = json_encode( $package );
			
			$cName=$cropstype[$zhongzi][cName];
			$maturingTime=$cropstype[$zhongzi][maturingTime];
			$output=$cropstype[$zhongzi][output];
			$exp=$cropstype[$zhongzi][cropExp];
			$sale=$cropstype[$zhongzi][sale];
			$growTime=$cropstype[$zhongzi][growthCycle];
			$up=$cropstype[$zhongzi][cLevel];
			$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set package='".$package."' where uid=".$UID );
			
			echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"code\":1,\"direction\":\"\",\"exp\":".$scarifyexp.",\"levelUp\":false,\"randsend\":{\"desc\":\"".$cName."\",\"id\":\"".$zhongzi."\",\"name\":\"".$cName."\",\"harvestTimes\":\"".$maturingTime."\",\"output\":\"".$output."\",\"exp\":\"".$exp."\",\"sale\":\"".$sale."\",\"growTime\":\"".$growTime."\",\"num\":".$num.",\"level\":\"".$up."\",\"type\":1}}";
		}else{	
		    echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"code\":1,\"direction\":\"\",\"exp\":".$scarifyexp.",\"levelUp\":false}";
		}	
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farm_arr."',exp=exp+'".$scarifyexp."' where uid=".$UID );
	
	}else{
		echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"code\":0,\"poptype\":1,\"direction\":\"\\u5df2\\u7ecf\\u9504\\u8fc7\\u8fd9\\u5757\\u5730\\u4e86\\u54df\\uff01\"}";
	}
	include_once( S_ROOT."./source/function_cp.php" );
	$icon = "farm";
	$title_template = "{actor} thu hoạch <a href=\"happyfarm.php\">nông sản</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
	$body_general = "Cùng tham gia vào hội nông dân Nhà Tui nhé!";
	feed_add( $icon, $title_template );
	exit( );
}//起地作物

if ( $_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "sale" ){//单个卖出
	$fruit = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT fruit FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
	$fruitarr = json_decode( $fruit );
	if ( $fruitarr->$_REQUEST['cId'] < $_REQUEST['number'] )
	{
		echo "{\"cId\":0,\"code\":0,\"direction\":\"\\u8BF7\\u786E\\u8BA4\\u6570\\u503C\\uFF01\"}";
		exit( );
	}
	$fruitarr->$_REQUEST['cId'] = $fruitarr->$_REQUEST['cId'] - $_REQUEST['number'];
	foreach($fruitarr as $key => $value){
        if($value == 0){unset($fruitarr->$key);}
     }
	$fruitarr = json_encode( $fruitarr );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+".$cropstype[$_REQUEST['cId']][sale] * $_REQUEST['number']." where uid=".$UID );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set fruit='".$fruitarr."' where uid=".$UID );

	$farm_log = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT log FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) ), 0 );
	$farm_log = json_decode( $farm_log );

	$log_msg="\\u5356\\u51FA\\u4E86\\u4ED3\\u5E93\\u91CC\\u5DF2\\u6536\\u83B7\\u7684".$_REQUEST['number']."\\u4E2A"; 
	$log_msg=$log_msg.$cropstype[$_REQUEST['cId']][cName]."\\u3002"; 
	$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}"; 
	$farm_log = json_encode( $farm_log );
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set mc_a=1,log='".$farm_log."' where uid=".intval( $UID ) );

	include_once( S_ROOT."./source/function_cp.php" );
	$icon = "farm";
	$title_template = "{actor} xuống giống <a href=\"happyfarm.php\">nông sản</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
	$body_general = "Cùng tham gia vào hội nông dân Nhà Tui nhé!";
	feed_add( $icon, $title_template );
	echo "{\"cId\":".$_REQUEST['cId'].",\"code\":1,\"direction\":\"\\u6210\\u529f\\u5356\\u51fa<font color='#0099FF'> <b>".$_REQUEST['number']."<\\/b> <\\/font>\\u4e2a".$cropstype[$_REQUEST['cId']][cName]."\\uff0c\\u5f97\\u5230\\u91d1\\u5e01<font color='#FF6600'> <b>".$cropstype[$_REQUEST['cId']][sale] * $_REQUEST['number']."<\\/b> <\\/font>\",\"money\":".$cropstype[$_REQUEST['cId']][sale] * $_REQUEST['number']."}";

	exit( );
}//单个卖出

if ( $_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "saleAll" ){//全部卖出
	$query = $_SGLOBAL['db']->query( "SELECT fruit,log FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$fruitarr = json_decode( $list[0][fruit] );
	$farm_log = json_decode( $list[0][log] );

	$money = 0;

	$log_msg="\\u5356\\u51FA\\u4E86\\u4ED3\\u5E93\\u91CC\\u5DF2\\u6536\\u83B7\\u7684";
    $sellary=explode(',',$_REQUEST['cIds']);
	foreach ( $fruitarr as $key => $value )
	{
		if ( 0 < $value && $cropstype[$key][cType] == 1 && in_array($key,$sellary))
		{
			$money = $money + $cropstype[$key][sale] * $value;
			$fruitarr->$key = 0;
			$log_msg = $log_msg.$value."\\u4E2A"; 
			$log_msg = $log_msg.$cropstype[$key][cName]." "; 
		}
	}
	$log_msg=$log_msg."\\u3002"; 

	$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}"; 
	$farm_log = json_encode( $farm_log );
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
    foreach($fruitarr as $key => $value){
            if($value == 0){unset($fruitarr->$key);}
                }
	$fruitarr = json_encode( $fruitarr );

	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+".$money." where uid=".$UID );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set mc_a=1,log='".$farm_log."',fruit='".$fruitarr."' where uid=".$UID );
	echo "{\"code\":1,\"direction\":\"\",\"money\":".$money."}";
	include_once( S_ROOT."./source/function_cp.php" );
	$icon = "farm";
	$title_template = "{actor} tham gia <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
	$body_general = "Cùng tham gia vào hội nông dân Nhà Tui nhé!";
	feed_add( $icon, $title_template );
	exit( );
}//全部卖出

if ( $_REQUEST['mod'] == "task" && $_REQUEST['act'] == "update" ){ //新手任务
        $query = $_SGLOBAL['db']->query( "SELECT taskid,exp FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
        while ( $value = $_SGLOBAL['db']->fetch_array( $query ) ){
                $list[] = $value;
        }
        $taskid = $list[0][taskid];
		if ( $taskid >= 0 && $taskid <=11 ){
                $upmoney = $taskid * 50;
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+{$upmoney} where uid=".$UID );
                $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp=exp+100,taskid=taskid+1 where uid=".$UID );
                $taskFlag = 2;
                if( $taskid ==11 ){
                        $taskFlag =0;
                        $taskid = 0;
                }
                echo stripslashes("{\"direction\":\"\\\\u606d\\\\u559c\\\\u60a8\\\\u5b8c\\\\u6210\\\\u4efb\\\\u52a1,\\\\u83b7\\\\u5f97100\\\\u4e2a\\\\u7ecf\\\\u9a8c\\\\u548c{$upmoney}\\\\u4e2a\\\\u91d1\\\\u5e01\",\"item\":[{\"eType\":7,\"eParam\":0,\"eNum\":100},{\"eType\":6,\"eParam\":0,\"eNum\":{$upmoney}}],\"levelUp\":false,\"task\":{\"taskId\":{$taskid},\"taskFlag\":{$taskFlag}}}");
        }
        exit( );
} //新手任务

if ( $_REQUEST['mod'] == "task" && $_REQUEST['act'] == "accept" ){
	$taskid = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT taskid FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
	echo "{\"taskId\":".$taskid."}";
}

if ( $_REQUEST['mod'] == "task" && $_REQUEST['act'] == "accept" ){
	$taskid = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT taskid FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
	echo "{\"taskId\":".$taskid."}";
}

if ( $_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "buySeed"){
	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	$exchange = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT exchange FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	$query = $_SGLOBAL['db']->query( "SELECT exp,package,log FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$money_1 = $cropstype[$_REQUEST['cId']][price] * $_REQUEST['number'];
	if ( $money < $money_1 )
	{
		echo "{\"cId\":0,\"code\":0,\"direction\":\"\u60A8\u7684\u91D1\u5E01\u4E0D\u8DB3\uFF01\"}";
		exit( );
	}
	$mylevel = round((sqrt($list[0]['exp']/100+0.25)-0.5), 2);
	if ( $mylevel < $cropstype[$_REQUEST['cId']][cLevel] )
	{
		echo "{\"cId\":0,\"code\":0,\"direction\":\"\u60A8\u7684\u7B49\u7EA7\u65E0\u6CD5\u8D2D\u4E70\u8BE5\u79CD\u5B50\uFF01\"}";
		exit( );
	}
	if ( in_array($_REQUEST['cId'], $randseed) )
	{
		echo "{\"cId\":0,\"code\":0,\"direction\":\"\u60A8\u65E0\u6743\u8D2D\u4E70\u6B64\u79CD\u5B50\uFF01\"}";
		exit( );
	}
	$package = json_decode( $list[0][package]);
    $money11=$money-$money_1;
	$farm_log = json_decode( $exchange );
	$log_msg="\u5728\u5546\u5E97\u8D2D\u4E70".$_REQUEST['number']."\u4E2A".$cropstype[$_REQUEST['cId']][cName]."\u79CD\u5B50\u3002\u82B1\u8D39".$money_1."\u91D1\u5E01,\u8FD8\u5269".$money11."\u91D1\u5E01";
	$farm_log->cost[]= "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";
	$farm_log = json_encode($farm_log);
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
    
	$package->$_REQUEST['cId'] = $package->$_REQUEST['cId'] + $_REQUEST['number'];
	$package = json_encode( $package );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set exchange='".$farm_log."',money=money-".$money_1." where uid=".$UID );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set package='".$package."' where uid=".$UID );
	echo "{\"code\":1,\"cId\":".$_REQUEST['cId'].",\"cName\":\"".$cropstype[$_REQUEST['cId']][cName]."\",\"num\":".$_REQUEST['number'].",\"money\":-".$money_1."}";
	exit( );
}

if ( $_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "getUserSeed" ){

	$query = $_SGLOBAL['db']->query( "SELECT package,tools FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$package = ( array )json_decode( $list[0][package] );
	foreach ( $package as $key => $value )
	{
		$hour=( $cropstype[$key][growthCycle] )/3600;
		if ( 0 < $value )
		{
			$packagearr[] = "{\"type\":1,\"cId\":".$key.",\"cName\":\"".$cropstype[$key][cName]."\",\"amount\":".$value.",\"lifecycle\":".$hour.",\"level\":".$cropstype[$key][cLevel]."}";
		}
	}

	$tools = ( array )json_decode( $list[0][tools] );
	foreach ( $tools as $key => $value )
	{
		if ( 0 < $value && $key < 500 )
		{
			
			$packagearr[] = "{\"type\":3,\"tId\":".$key.",\"tName\":\"".$Toolstype[30000 + $key][tName]."\",\"amount\":".$value.",\"depict\":\"".$Toolstype[30000 + $key][depict]."\"}";
		}
	}
	$package = json_encode( $packagearr );
	$package = str_replace( "\"{", "{", $package );
	$package = str_replace( "}\"", "}", $package );
	$package = str_replace( "null", "[]", $package );

	echo stripslashes( $package );
	exit( );
}

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "planting" ){//播种作物
	$query = $_SGLOBAL['db']->query( "SELECT package,exp,Status FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farmarr = json_decode( $list[0][Status] );
	$packagearr = json_decode( $list[0][package] );
	if ( $packagearr->$_REQUEST['cId'] == 0 )
	{
		exit( );
	}
	if ( $farmarr->farmlandstatus[$_REQUEST['place']]->a != 0 )
	{
		exit( );
	}
	$packagearr->$_REQUEST['cId'] = $packagearr->$_REQUEST['cId'] - 1;
	$farmarr->farmlandstatus[$_REQUEST['place']]->a = (int)$_REQUEST['cId'];
	$farmarr->farmlandstatus[$_REQUEST['place']]->b = 1;
	$farmarr->farmlandstatus[$_REQUEST['place']]->c = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->d = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->e = 1;
	$farmarr->farmlandstatus[$_REQUEST['place']]->f = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->g = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->h = 1;
	$farmarr->farmlandstatus[$_REQUEST['place']]->i = 100;
	$farmarr->farmlandstatus[$_REQUEST['place']]->j = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->k = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->l = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->m = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->n = array( );
	$farmarr->farmlandstatus[$_REQUEST['place']]->o = 0;
	$farmarr->farmlandstatus[$_REQUEST['place']]->p = array( );
	$farmarr->farmlandstatus[$_REQUEST['place']]->q = $_SGLOBAL['timestamp'];
	$farmarr->farmlandstatus[$_REQUEST['place']]->r = $_SGLOBAL['timestamp'];
	$farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
	$farmarr = json_encode( $farmarr );
    foreach($packagearr as $key => $value){
        if($value == 0){unset($packagearr->$key);}
     }
	$packagearr = json_encode( $packagearr );

	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp=exp+2,Status='".$farmarr."',package='".$packagearr."' where uid=".$UID );

	echo "{\"cId\":".$_REQUEST['cId'].",\"farmlandIndex\":".$_REQUEST['place'].",\"code\":1,\"poptype\":0,\"direction\":\"\",\"exp\":2,\"levelUp\":false}";

	include_once( S_ROOT."./source/function_cp.php" );
	$icon = "farm";
	$title_template = "{actor} xuống giống <a href=\"happyfarm.php\">nông sản</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
	$body_general = "Vụ này sẽ trúng to!";
	feed_add( $icon, $title_template );
	exit( );
}//播种作物

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "water" ){//作物浇水
	$farm = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
	$farm = json_decode( $farm );
	$farm_pw = $farm->farmlandstatus[$_REQUEST['place']]->p;
	$farm_arr = (array)$farm_pw;
		foreach($farm_arr as $key_pw=>$value_pw)
			{
				if($value_pw==3){
					unset($farm_pw->$key_pw);
					break;
				}
				
			}
	$farm->farmlandstatus[$_REQUEST['place']]->p = $farm_pw;
	if ( $farm->farmlandstatus[$_REQUEST['place']]->h == 1 )
	{
		exit( );
	}
	$farm->farmlandstatus[$_REQUEST['place']]->h = 1;
	$farm->farmlandstatus = array_values($farm->farmlandstatus);//修复数据
	$farm_srt = json_encode( $farm );
	if ( intval( $_REQUEST['ownerId'] ) == $UID )
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+2 where uid=".$UID );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp=exp+2,Status='".$farm_srt."' where uid=".$UID );
		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} tưới cây tại <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
		$body_general = "Chăm sóc cây trồng để thu hoạch nhiều!";
		feed_add( $icon, $title_template );
	}
	else
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+2 where uid=".intval( $UID ) );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farm_srt."',exp=exp+2 where uid=".$_REQUEST['ownerId'] );
		$Tips_water_b = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT setting6 FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
		$farm_log = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT log FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
		$farm_log = json_decode( $farm_log );
		$log_msg="";
                                
		$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."<\/b><\/font> \\u6765\\u519C\\u573A\\u5E2E\\u5FD9\\u6D47\\u6C34\\u3002";
                                                                
		$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";                                                
		$farm_log = json_encode( $farm_log );
		$farm_log = str_replace( "\"{", "{", $farm_log );
		$farm_log = str_replace( "}\"", "}", $farm_log );
		$farm_log = str_replace( "\\u", "\\\\u", $farm_log );
		$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );

		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set mc_a=1,log='".$farm_log."' where uid=".intval( $_REQUEST['ownerId'] ) );
		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} ghé thăm <a href=\"happyfarm.php\">nông trại</a> của {touser}";
		$touserspace = getspace( intval( $_REQUEST['ownerId'] ) );
		if ( empty( $touserspace[name] ) )
		{
			$touserspace[name] = $touserspace[username];
		}
		$title_data = array( "touser" => "<a href=\"space.php?uid=".intval( $_REQUEST['ownerId'] )."\">".$touserspace[name]."</a>");
		$body_general = "Giúp đỡ nhau mới là nông dân Nhà Tui";
		feed_add( $icon, $title_template, $title_data );
	}
	echo "{\"farmlandIndex\":".$_REQUEST['place'].",\"code\":1,\"poptype\":0,\"direction\":\"".$Tips_water_b."\",\"money\":0,\"exp\":2,\"levelUp\":false,\"humidity\":".$farm->farmlandstatus[$_REQUEST['place']]->h."}";
	exit();
}//作物浇水

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "clearWeed" ){//除草
	$touserspace = getspace( intval( $_REQUEST['ownerId'] ) );
	if ( empty( $touserspace[name] ) )
	{
		$touserspace[name] = $touserspace[username];
	}
	$query = $_SGLOBAL['db']->query( "SELECT Status,exp,weed,log,dog FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}

	$farm = json_decode( $list[0][Status] );
	$farmweed = json_decode($list[0][weed]);
	$farm_log = json_decode( $list[0][log] );
	$pieces = explode(",", $_REQUEST['place']);
	if ( intval( $_REQUEST['ownerId'] ) != $UID )
	{
		$Tips_weed_b = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT setting1 FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
	}

		$ZONG = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT zong FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );


	foreach ( $pieces as $key => $value )
	{
		$id = $pieces[$key];
		$f = $farm->farmlandstatus[$id]->f;
		$g = $farm->farmlandstatus[$id]->g;
		$farm_pw = $farm->farmlandstatus[$id]->p;
		$farm_arr = (array)$farm_pw;
		if ( $f > 0 )
		{
			
			$cnt_all = array_count_values((array)$farmweed->$id);
			$cnt_you = $cnt_all[$UID]; //得到你在此地种草的数目
			
			if($f<=$cnt_you){
					
					echo '{"code":0,"direction":"\\u8BC1\\u636E\\u662F\\u4E0D\\u80FD\\u6BC1\\u706D\\u7684\\uFF01","farmlandIndex":'.$id.',"poptype":1,"weed":'.$f.'}';
					exit( );
			} else {
				
				unset($farmweed->$id->$f);
				if($f==1){
					unset($farmweed->$id);
				}
			}
			$f -= 1;
			$money += 2;

			if($ZONG>150)//限制除草
			{
				$exp += 0;
				$echo_str[] = json_decode("{\"code\":1,\"direction\":\"".$Tips_weed_b."\",\"exp\":0,\"farmlandIndex\":".$id.",\"levelUp\":false,\"money\":2,\"poptype\":0,\"weed\":".$f."}");
			}
			else
			{
			    $exp += 2;	
				$echo_str[] = json_decode("{\"code\":1,\"direction\":\"".$Tips_weed_b."\",\"exp\":2,\"farmlandIndex\":".$id.",\"levelUp\":false,\"money\":2,\"poptype\":0,\"weed\":".$f."}");
            }
		}
			
			foreach($farm_arr as $key_pw=>$value_pw)
			{
				if($value_pw==2){
					unset($farm_pw->$key_pw);
					break;
				}
				
			}
			$farm->farmlandstatus[$id]->p = $farm_pw;
			$farm->farmlandstatus[$id]->f = $f;
	}
	$farm->farmlandstatus = array_values($farm->farmlandstatus);//修复数据
	$farm_srt = json_encode( $farm );
	$weed_srt = json_encode($farmweed);
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money = money + ".$money." where uid=".$UID );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp = exp + ".$exp.",zong=zong+1 where uid=".$UID );

	if ( intval( $_REQUEST['ownerId'] ) == $UID )
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farm_srt."',weed='".$weed_srt."' where uid=".$UID );

		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} làm đất cho <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
		$body_general = "Bắt đầu mùa vụ mới nhé";
		feed_add( $icon, $title_template );
	}
	else
	{
		$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."<\/b><\/font> \\u6765\\u519C\\u573A\\u5E2E\\u5FD9\\u9664\\u8349\\u3002";
		$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";                                                
		$farm_log = json_encode( $farm_log );
		$farm_log = str_replace( "\"{", "{", $farm_log );
		$farm_log = str_replace( "}\"", "}", $farm_log );
		$farm_log = str_replace( "\\u", "\\\\u", $farm_log );
		$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farm_srt."',mc_a=1,log='".$farm_log."',weed='".$weed_srt."' where uid=".$_REQUEST['ownerId'] );
		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} ghé thăm <a href=\"happyfarm.php\">nông trại</a> của {touser}";

		$title_data = array(
			"touser" => "<a href=\"space.php?uid=".intval( $_REQUEST['ownerId'] )."\">".$touserspace[name]."</a>"
		);
		$body_general = "Giúp đỡ nhau mới là nông dân Nhà Tui";
		feed_add( $icon, $title_template, $title_data );
	}
	echo json_encode($echo_str);
	exit();
}//除草

if ( $_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "spraying" ){//杀虫

	$touserspace = getspace( intval( $_REQUEST['ownerId'] ) );
	if ( empty( $touserspace[name] ) )
	{
		$touserspace[name] = $touserspace[username];
	}
	$query = $_SGLOBAL['db']->query( "SELECT Status,pest,log,dog FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farmarr = json_decode($list[0][Status] );
	$farmpest = json_decode($list[0][pest]);
	$farmarr_log = json_decode( $list[0][log] );
	$pieces = explode(",", $_REQUEST['place']);
	if ( intval( $_REQUEST['ownerId'] ) != $UID )
	{
		$Tips_pest_b = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT setting2 FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
	}
		$ZONG = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT zong FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );

	foreach ( $pieces as $key => $value )
	{
		$id = $pieces[$key];
		if ($_REQUEST['tId'] == 0)//普通杀虫
		{
			$g = $farmarr->farmlandstatus[$id]->g;
			$farm_pw = $farmarr->farmlandstatus[$id]->p;
			$farm_arr = (array)$farm_pw;
			if ( $g > 0 )
			{ //farmpest
				$cnt_all = array_count_values((array)$farmpest->$id);
				$cnt_you = $cnt_all[$UID];
				if($g <= $cnt_you){
					
					echo '{"code":0,"direction":"\\u8BC1\\u636E\\u662F\\u4E0D\\u80FD\\u6BC1\\u706D\\u7684\\uFF01","farmlandIndex":'.$id.',"poptype":1,"pest":'.$g.'}';
					exit( );
			}
			else{
				unset($farmpest->$id->$g);
				if($g==1){
					unset($farmpest->$id);
				}
			}
				$g -= 1;
				$money += 2;

			if($ZONG>150)//限制除草
			{
				$exp += 0;
				$echo_str[] = json_decode("{\"farmlandIndex\":".$id.",\"code\":1,\"poptype\":1,\"direction\":\"".$Tips_pest_b."\",\"money\":2,\"exp\":0,\"levelUp\":false,\"pest\":".$farmarr->farmlandstatus[$id]->g."}" );
			}
			else
			{
			    $exp += 2;	
				$echo_str[] = json_decode("{\"farmlandIndex\":".$id.",\"code\":1,\"poptype\":1,\"direction\":\"".$Tips_pest_b."\",\"money\":2,\"exp\":2,\"levelUp\":false,\"pest\":".$farmarr->farmlandstatus[$id]->g."}" );
            }
				
			}
			foreach($farm_arr as $key_pw=>$value_pw)
			{
				if($value_pw==1){
					unset($farm_pw->$key_pw);
					break;
				}
				
			}

			$farm->farmlandstatus[$id]->p = $farm_pw;
			$farmarr->farmlandstatus[$id]->g = $g;
		}
		else
		{
				echo "{\"tId\":".$_REQUEST['tId'].",\"farmlandIndex\":".$id.",\"code\":0,\"poptype\":1,\"direction\":\"".$Tips_pest_b."\"}";
				exit( );
		}
	}
	$farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
	$farmarr_srt = json_encode( $farmarr );
	$pest_srt = json_encode($farmpest);
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money = money + ".$money." where uid=".$UID );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp = exp + ".$exp.",zong=zong+1 where uid=".$UID );

	if ( intval( $_REQUEST['ownerId'] ) == $UID )
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_srt."',pest='".$pest_srt."' where uid=".$UID );

		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} làm cỏ cho <a href=\"happyfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\" target=\"_blank\" >Nhà Tui</a>";
		$body_general = "Cỏ sẽ làm tăng thời gian thu hoạch!";
		feed_add( $icon, $title_template );
	}
	else
	{
		$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."<\/b><\/font> \\u6765\\u519C\\u573A\\u5E2E\\u5FD9\\u6740\\u866B\\u3002";
		$farmarr_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";
		$farmarr_log = json_encode( $farmarr_log );
		$farmarr_log = str_replace( "\"{", "{", $farmarr_log );
		$farmarr_log = str_replace( "}\"", "}", $farmarr_log );
		$farmarr_log = str_replace( "\\u", "\\\\u", $farmarr_log );
		$farmarr_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farmarr_log );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_srt."',mc_a=1,log='".$farmarr_log."',pest='".$pest_srt."' where uid=".$_REQUEST['ownerId'] );
		include_once( S_ROOT."./source/function_cp.php" );
		$icon = "farm";
		$title_template = "{actor} ghé thăm <a href=\"happyfarm.php\">nông trại</a> của {touser}";
		$title_data = array( "touser" => "<a href=\"space.php?uid=".intval( $_REQUEST['ownerId'] )."\">".$touserspace[name]."</a>" );
		$body_general = "Giúp đỡ nhau mới là nông dân Nhà Tui";
		feed_add( $icon, $title_template, $title_data );
	}
	echo json_encode($echo_str);
	exit();
}//杀虫

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "reclaimPay" ){//开地提示
	$reclaim = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT reclaim FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
	echo "{\"money\":".$tudiarr[$reclaim][money].",\"level\":".$tudiarr[$reclaim][level]."}";
	exit();
}//开地提示

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "reclaim" ){//开垦土地
	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	$query = $_SGLOBAL['db']->query( "SELECT Status,reclaim,exp FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	if ( $money < $tudiarr[$list[0][reclaim]][money] || $list[0][exp] < $tudiarr[$list[0][reclaim]][exp] )
	{
		exit( );
	}
	$farmarr = json_decode( $list[0][Status] );
    foreach($farmarr->farmlandstatus as $key => $value){
                if( $key >= $list[0][reclaim] ){unset($farmarr->farmlandstatus[$key]);}
        }
    $farmarr->farmlandstatus[$list[0][reclaim]] = json_decode("{\"a\":0,\"b\":0,\"c\":0,\"d\":0,\"e\":1,\"f\":0,\"g\":0,\"h\":1,\"i\":100,\"j\":0,\"k\":0,\"l\":0,\"m\":0,\"n\":[],\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725}");
	$farmarr->farmlandstatus = array_values($farmarr->farmlandstatus);//修复数据
    $farmarr_str = json_encode( $farmarr );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money = money - ".$tudiarr[$list[0][reclaim]][money]." where uid=".$UID );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_str."',reclaim = reclaim + 1 where uid=".$UID );
	echo "{\"code\":1,\"direction\":\"\",\"money\":-".$tudiarr[$list[0][reclaim]][money]."}";
	exit();
}//开垦土地

if ( $_REQUEST['mod'] == "chat" && $_REQUEST['act'] == "getAllInfo" ){
	$uidspace = getspace( $_REQUEST['uId'] );
	if ( empty( $uidspace[name] ) )
	{
		$uidspace[name] = $uidspace[username];
	}
	$uidspace[name] = unicode_encode( $uidspace[name] );

	$Config = $_SGLOBAL['db']->query( "SELECT money,Message FROM ".tname( "happyfarm_config" )." where uid=".$_REQUEST['uId'] );
	while ( $value_1 = $_SGLOBAL['db']->fetch_array( $Config ) )
	{
		$list_1[] = $value_1;
	}
	$money = $list_1[0][money];
	$chat = json_decode ($list_1[0][Message]);
	$query = $_SGLOBAL['db']->query( "SELECT exp,repertory,log FROM ".tname( "happyfarm_nc" )." where uid=".$_REQUEST['uId'] );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$log =(array)json_decode ($list[0][log]);

	$repertory = (array)json_decode ($list[0][repertory]);
	$tempChat=$chat->c;
	foreach((array)$tempChat as $val)
	{
		$tempecho=json_encode($val).",".$tempecho;
	}
	$tempecho=substr($tempecho,0,-1);
	$user_str = "{\"headPicBig\":\"".getheadPic($_REQUEST['uId'],"big")."\",\"homePage\":\"".str_ireplace( "happyfarm/", "space.php?uid=", $_SC['siteurl'] ).$_REQUEST['uId']."\",\"money\":".$money.",\"FBPrice\":4,\"uExp\":".$list[0][exp].",\"uId\":".$_REQUEST['uId'].",\"uLevel\":".floor( sqrt( $list[0][exp] / 100 + 0.25 ) - 0.5 ).",\"uName\":\"".$uidspace[name]."\"}";
	//信息提示
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set mc_a=0 where uid=".intval( $_REQUEST['uId'] ) );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set jb=0 where uid=".intval( $_REQUEST['uId'] ) );
	if ($log[l]!=null){
	array_multisort($log[l],SORT_DESC);}
	$log_str = json_encode ($log[l]);
	$chat_str = "[".$tempecho."]";
	$repertory_str = json_encode ($repertory["r"]);
	$repertory_str = str_replace( "null", "[]", $repertory_str );

	echo "{\"user\":".$user_str.",\"log\":".$log_str.",\"chat\":".$chat_str.",\"repertory\":".$repertory_str."}";
	exit();
}

if ( $_REQUEST['mod'] == "chat" && $_REQUEST['act'] == "sendChat" ){
	$chat = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT Message FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['toId'] ) ), 0 );
	$chat = json_decode( $chat );

	$uidspace = getspace( $_REQUEST['toId'] );
	if ( empty( $uidspace[name] ) )
	{
		$uidspace[name] = $uidspace[username];
	}
	$uidspace[name] = unicode_encode( $uidspace[name] );
	$chat->c[] = "{\"fromId\":\"".$UID."\",\"fromName\":\"".$spacename."\",\"toId\":\"".intval($_REQUEST['toId'])."\",\"toName\":\"".$uidspace[name]."\",\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$_REQUEST['msg']."\",\"isReply\":".$_REQUEST['isReply']."}";	
	$chat = json_encode( $chat );
	$chat = str_replace( "\"{", "{", $chat );
	$chat = str_replace( "}\"", "}", $chat );
	$chat = str_replace( "\\u", "\\\\u", $chat );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set jb=1,Message='".$chat."' where uid=".intval( $_REQUEST['toId'] ) );	
	$tempecho="";
	$chat = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT Message FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['toId'] ) ), 0 );
	$chat = json_decode( $chat );
	$tempChat=$chat->c;
	foreach((array)$tempChat as $val)
	{
		$tempecho=json_encode($val).",".$tempecho;
	}
	$tempecho=substr($tempecho,0,-1);
	echo "{\"code\":1,\"chat\":[".$tempecho."]}";	
	exit( );	
}

if ( $_REQUEST['mod'] == "usertool" && $_REQUEST['act'] == "buyTool" ){
	if ( $_REQUEST['type'] == 3 ) {
		$rtid = 30000 + $_REQUEST['tId'];
	} elseif ( $_REQUEST['type'] == 4 ) {
		$rtid = 40000 + $_REQUEST['tId'];
	} else {
		$rtid = $_REQUEST['tId'];
	}
	if ( $Toolstype[$rtid]["saleOut"] == true) {
		echo('{"code":0,"direction":"\\u5DF2\\u7ECF\\u552E\\u5B8C\\u54AF\\uFF0C\\u8BF7\\u53CA\\u65F6\\u5173\\u6CE8\\u519C\\u573A\\u516C\\u544A\\uFF01","payqb":0,"payqp":0,"dnaurl":""}');
	exit();
	}
	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );

	if ( $_REQUEST['type'] == 3 )
	{
		$query = $_SGLOBAL['db']->query( "SELECT tools FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
		$buy_money = $Toolstype[30000 + $_REQUEST['tId']]["price"] * $_REQUEST['number'];
		$tName = $Toolstype[30000 + $_REQUEST['tId']]["tName"];
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$fertarr = json_decode($list[0][tools]);
		if ($money < $buy_money)
		{
			exit();
		}
		$fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] + $_REQUEST['number'];
		$fertarr_str = json_encode ($fertarr);
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set tools='".$fertarr_str."' where uid=".intval( $UID ) );
	}
	elseif ( $_REQUEST['type'] == 4 )
	{
		$query = $_SGLOBAL['db']->query( "SELECT dog FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$dogstr = (array)json_decode( $list[0][dog] );
        $i=$dogstr["dogs"]->$_REQUEST['tId']->dogUnWorkTime;
		if ( $_REQUEST['tId'] < 9000 )
		{
			$buy_money = $Toolstype[40000 + $_REQUEST['tId']]["price"] * $_REQUEST['number'];
			if ($money < $buy_money)
			{
				exit();
			}
			$tName = $Toolstype[40000 + $_REQUEST['tId']]["tName"];

			if ( $dogstr["dogFeedTime"] < $_SGLOBAL['timestamp'] )
			{
				$dogstr["dogFeedTime"] = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else if (  $i == 1 )	
			{
			echo "{\"direction\":\"\\u53EA\\u80FD\\u8D2D\\u4E70\\u4E00\\u53EA\\u72D7\\u54DF\"}"; 
			}
			if ( $_REQUEST['tId'] == 1)
			{
				$a = 1;
			}
			else if ( $_REQUEST['tId'] == 3)
			{
				$a = 3;
			}
			$dogstr["dogs"]->$a->status = 0;
			$dogstr["dogs"]->$_REQUEST['tId']->status = 1;
			$dogstr["dogs"]->$_REQUEST['tId']->dogUnWorkTime = 1;
		}
		else
		{
			$buy_money = $Toolstype[$_REQUEST['tId']]["price"] * $_REQUEST['number'];
			if ($money < $buy_money)
			{
				exit();
			}
			$tName = $Toolstype[$_REQUEST['tId']]["tName"];
			if ( $_REQUEST['tId'] == 9001 )
			{
				$dogFeed = 86400;
			}
			elseif ( $_REQUEST['tId'] == 9002 )
			{
				$dogFeed = 604800;
			}
			else
			{
				$dogFeed = 0;
			}

			if ( $dogstr["dogFeedTime"] < $_SGLOBAL['timestamp'] )
			{
				$dogstr["dogFeedTime"] = $_SGLOBAL['timestamp'] + $dogFeed ;
			}
			else
			{
				$dogstr["dogFeedTime"] = $dogstr["dogFeedTime"] + $dogFeed ;
			}
		}
		$dogstr_str = json_encode ($dogstr);
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set dog='".$dogstr_str."' where uid=".intval( $UID ) );
	}
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money - ".$buy_money." where uid=".intval( $UID ) );
	echo "{\"tId\":".$_REQUEST['tId'].",\"tName\":\"".$tName."\",\"code\":1,\"direction\":\"\\u8d2d\\u4e70\\u6210\\u529f\\u3002\",\"num\":1,\"money\":-".$buy_money.",\"FB\":0,\"type\":".$_REQUEST['type']."}";	
	exit();
}

if ( $_REQUEST['mod'] == "item" && $_REQUEST['act'] == "activeItem" ){
	$activeItem = $_REQUEST['id'];

	if ( $activeItem > 90000)
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set activeItem=".$activeItem." where uid=".intval( $UID ) );
	}
	else
	{
		$query = $_SGLOBAL['db']->query( "SELECT dog,decorative FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$decorative = (array)json_decode ($list[0][decorative]);
		$dogstr = (array)json_decode( $list[0][dog] );

		if ( $activeItem > 80000)
		{
			if ( $_REQUEST['id'] == 80001)
			{
				$a = 3;
			}
			elseif ( $_REQUEST['id'] == 80003)
			{
				$a = 1;
			}

			$tid = $_REQUEST['id'] - 80000;
			$dogstr["dogs"]->$tid->status = 1;
			$dogstr["dogs"]->$a->status = 0;
			$dogstr_str = json_encode ($dogstr);
			$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set dog='".$dogstr_str."' where uid=".intval( $UID ) );
		}
		else
		{
			foreach ( $decorative as $item_type => $value )
			{
				foreach ( $value as $key => $value1 )
				{
                 if ( $item_type == $itemtype[$_REQUEST['id']][itemType]){
					if ( $key == $activeItem )
					{
									if ( $_SGLOBAL['timestamp'] < $value1->validtime || $value1->validtime == 0 )
									{
													$value1->status = 1;
									}
									else
									{
													exit( );
									}
					}
					else
					{
									$value1->status = 0;
					}
				

				}}
			}
			$decorative_str = json_encode ($decorative);
			$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set decorative='".$decorative_str."' where uid=".intval( $UID ) );
		}
	}
	echo "{\"code\":1,\"id\":".$activeItem."}";
	exit();
}

if ( $_REQUEST['mod'] == "item" && $_REQUEST['act'] == "deactiveItem" ){
	$activeItem = $_REQUEST['id'];
	if ( $activeItem > 90000)
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set activeItem=0 where uid=".intval( $UID ) );
	}
	else
	{
		$query = $_SGLOBAL['db']->query( "SELECT dog,decorative FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$decorative = (array)json_decode ($list[0][decorative]);
		$dogstr = (array)json_decode ($list[0][dog]);
		if ( $activeItem > 80000)
		{
			$a = $_REQUEST['id'] - 80000;
			$dogstr["dogs"]->$a->status = 0;

			$dogstr_str = json_encode ($dogstr);
			$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set dog='".$dogstr_str."' where uid=".intval( $UID ) );
		}
		else
		{

		}
	}
	echo "{\"code\":1,\"id\":".$activeItem."}";
	exit();
}

if ( $_REQUEST['mod'] == "item" && $_REQUEST['act'] == "buy" ){
	$activeItem = $_REQUEST['itemId'];
	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	$query = $_SGLOBAL['db']->query( "SELECT decorative FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$decorative = (array)json_decode ($list[0][decorative]);
	$decorative1 = json_decode ($list[0][decorative]);
	$buy_money = $itemtype[$activeItem][price];
	$buy_time = $itemtype[$activeItem][itemValidTime];
	$buy_type = $itemtype[$activeItem][itemType];
	$buy_exp = $itemtype[$activeItem][exp];
	if ( $money < $buy_money )
	{
		exit();
	}
	
	foreach ( $decorative as $item_type => $value )
	{
		$value_arr = (array)$value;
		if ( $buy_type == $item_type )
		{
			foreach ( $value_arr as $key => $value1 )
			{
				if ( $key == $activeItem )
				{
						echo "{\"direction\":\"\\u4F60\\u5DF2\\u7ECF\\u8D2D\\u4E70\\u8FC7\\u4E86\\uFF0C\\u4E0D\\u5FC5\\u91CD\\u590D\\u8D2D\\u4E70\\uFF01\"}"; 
						exit();
				}
				else
				{
					$decorative1->$item_type->$activeItem->status=0;
					$decorative1->$item_type->$activeItem->validtime=$_SGLOBAL['timestamp'] + $buy_time;
				}
			}
		}
	}

    $decorative_str = json_encode ($decorative1);
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp = exp + ".$buy_exp.",decorative='".$decorative_str."' where uid=".intval( $UID ) );
    $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money - ".$buy_money." where uid=".intval( $UID ) );
	echo "{\"code\":1,\"exp\":".$buy_exp.",\"money\":-".$buy_money.",\"levelUp\":false}";
	exit();
}

if ( $_REQUEST['mod'] == "item" && $_REQUEST['act'] == "getUserItems" ){

	$query = $_SGLOBAL['db']->query( "SELECT dog,decorative FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$decorative = (array)json_decode ($list[0][decorative]);
	$dog = (array)json_decode ($list[0][dog]);

	foreach ( $decorative as $item_type => $value )
	{

		foreach ( $value as $key => $value1 )
		{
			if ( $value1->validtime > $_SGLOBAL['timestamp'] or $value1->validtime == 1 )
			{
				if ( $key == 1 )
				{
					$get_itemName = "\\u7530\\u56ed\\u98ce\\u5149";
					$get_price = 0;
					$get_exp = 0;
				}
				elseif ( $key == 2 )
				{
					$get_itemName = "\\u8305\\u8349\\u5c4b";
					$get_price = 0;
					$get_exp = 0;
				}
				elseif ( $key == 3 )
				{
					$get_itemName = "\\u6728\\u6869\\u6805\\u680f";
					$get_price = 0;
					$get_exp = 0;
				}
				elseif ( $key == 4 )
				{
					$get_itemName = "\\u8305\\u8349\\u72d7\\u5c4b";
					$get_price = 0;
					$get_exp = 0;
				}
				else
				{
					$get_itemName = $itemtype[$key][itemName];
					$get_price = $itemtype[$key][price];
					$get_exp = $itemtype[$key][exp];
				}
				$decorative_str[]="{\"itemId\":".$key.",\"itemType\":".$item_type.",\"validTime\":".$value1->validtime.",\"status\":".$value1->status.",\"id\":".$key.",\"itemName\":\"".$get_itemName."\",\"price\":".$get_price.",\"exp\":".$get_exp."}";
			}
		}
	}
	foreach ( $dog[dogs] as $key => $value )
	{
		if ( $value->dogUnWorkTime > $_SGLOBAL['timestamp'] or $value->dogUnWorkTime == 1 )
		{
			$get_itemName = $Toolstype[40000+$key][tName];
			$get_price = $Toolstype[40000+$key][price];
			$get_exp = 0;
			$decorative_str[]="{\"itemId\":".(80000+$key).",\"itemType\":8,\"validTime\":".$value->dogUnWorkTime.",\"status\":".$value->status.",\"id\":".(80000+$key).",\"itemName\":\"".$get_itemName."\",\"price\":".$get_price.",\"exp\":".$get_exp."}";
		}
	}
	$decorative_str = json_encode ($decorative_str);
	$decorative_str = str_replace( "\"{", "{", $decorative_str );
	$decorative_str = str_replace( "}\"", "}", $decorative_str );
	$decorative_str = str_replace( "\\\"", "\"", $decorative_str );
	$decorative_str = str_replace( "\\u", "u", $decorative_str);
	echo $decorative_str;
	exit();
}

if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "scatterSeed" ){//恶意种草
	$query = $_SGLOBAL['db']->query( "SELECT Status,dog,weed,log FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) );
	$Tips_weed_a = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT setting3 FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$query = $_SGLOBAL['db']->query( "SELECT badnum FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farm_Status = json_decode( $list[0][Status] );
	$farm_log = json_decode( $list[0][log] );
	$farm_weed = json_decode( $list[0][weed]); //将恶意种草的ID写入到weed字段中	
	$farm_badnum = json_decode( $list[1][badnum] );
	if ( $farm_badnum <= 0)
	{
		exit();
	}
	$pieces = explode(",", $_REQUEST['place']);
	foreach ( $pieces as $key => $value )
	{
		if ( $farm_badnum > 0)
		{
			$id = $pieces[$key];
			$f = $farm_Status->farmlandstatus[$id]->f;
			$farm_w = (array)$farm_Status->farmlandstatus[$id]->p;
			if ( $f < 3 )
			{
				$code_temp = 1;
				$f += 1;
				$farm_weed->$id->$f = $UID; 
				$farm_badnum -= 1;
				$echo_str[] = json_decode( "{\"canbad\":".$farm_badnum.",\"code\":1,\"direction\":\"".$Tips_weed_a."\",\"farmlandIndex\":".$id.",\"poptype\":1,\"weed\":".$f."}" );
		
			}
			$farm_Status->farmlandstatus[$id]->f = $f;
			
			//农作物状态p
			if($farm_w){
				$farm_time =$_SGLOBAL['timestamp'];
				if(isset($farm_w[$farm_time])){
					$farm_time += $f;
				} 
				$farm_w1 = array($farm_time=>2);
				$farm_w = $farm_w+$farm_w1;
			} else {
				$farm_w = array($_SGLOBAL['timestamp']=>2);
			}
			$farm_Status->farmlandstatus[$id]->p = $farm_w;
		}
	}
	if ( $code_temp != 0 )
	{
		$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."</b></font> \\u6765\\u519C\\u573A\\u4F7F\\u574F\\uFF0C\\u4F5C\\u7269\\u201C\\u751F\\u75C5\\u201D\\u4E86\\u3002";
		$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";
	}
	$farm_Status->farmlandstatus = array_values($farm_Status->farmlandstatus);//修复数据
	$farmarr_str = json_encode($farm_Status);
	$farm_weed_arr = json_encode($farm_weed);
	$farm_log = json_encode( $farm_log );
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_str."',mc_a=1,log='".$farm_log."',weed='".$farm_weed_arr."' where uid=".intval( $_REQUEST['ownerId'] ) );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set badnum=".$farm_badnum." where uid=".intval( $UID ) );

	echo json_encode($echo_str);
	exit();
}//恶意种草
 
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "pest" ){//恶意放虫
	$query = $_SGLOBAL['db']->query( "SELECT Status,dog,pest,log FROM ".tname( "happyfarm_nc" )." where uid=".intval( $_REQUEST['ownerId'] ) );
	$Tips_pest_a = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT setting4 FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['ownerId'] ) ), 0 );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$query = $_SGLOBAL['db']->query( "SELECT badnum FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$farm_Status = json_decode( $list[0][Status] );
	$farm_log = json_decode( $list[0][log] );
	$farm_pest = json_decode( $list[0][pest]); //将恶意放虫的ID写入到pest字段中

	$farm_badnum = json_decode( $list[1][badnum] );
	if ( $farm_badnum <= 0)
	{
		exit();
	}
	$pieces = explode(",", $_REQUEST['place']);
	foreach ( $pieces as $key => $value )
	{
		if ( $farm_badnum > 0)
		{
			$id = $pieces[$key];
			$g = $farm_Status->farmlandstatus[$id]->g;
			$farm_p = (array)$farm_Status->farmlandstatus[$id]->p;
			if ( $g < 3 )
			{
				$code_temp = 1;
				$g += 1;
				$farm_pest->$id->$g = $UID; 
				$farm_badnum -= 1;
				$echo_str[] = json_decode( "{\"canbad\":".$farm_badnum.",\"code\":1,\"direction\":\"".$Tips_pest_a."\",\"farmlandIndex\":".$id.",\"poptype\":1,\"pest\":".$g."}" );
			}
			$farm_Status->farmlandstatus[$id]->g = $g;

			//农作物状态p
			if($farm_p){
				$farm_time =$_SGLOBAL['timestamp'];
				if(isset($farm_p[$farm_time])){
					$farm_time += $g;
				} 
				$farm_p1 = array($farm_time=>1);
				$farm_p = $farm_p+$farm_p1;
			} else {
				$farm_p = array($_SGLOBAL['timestamp']=>1);
			}
			$farm_Status->farmlandstatus[$id]->p = $farm_p;
		}
	}
	if ( $code_temp != 0 )
	{
		$log_msg="<font color=\\\"#009900\\\"><b>".$spacename."</b></font> \\u6765\\u519C\\u573A\\u4F7F\\u574F\\uFF0C\\u4F5C\\u7269\\u201C\\u751F\\u75C5\\u201D\\u4E86\\u3002";
		$farm_log->l[] = "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";
	}
	$farm_Status->farmlandstatus = array_values($farm_Status->farmlandstatus);//修复数据
	$farmarr_str = json_encode($farm_Status);
	$farm_pest_arr = json_encode($farm_pest);
	$farm_log = json_encode( $farm_log );
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set Status='".$farmarr_str."',mc_a=1,log='".$farm_log."',pest='".$farm_pest_arr."' where uid=".intval( $_REQUEST['ownerId'] ) );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set badnum=".$farm_badnum." where uid=".intval( $UID ) );
	echo json_encode($echo_str);
	exit();
}//恶意放虫

if ($_REQUEST['act'] == "setting" && $_REQUEST['submit'] == 1 ){
	$setting_str = $_REQUEST['value'];
	if ( $setting_str == "" )
	{
		$setting1 = "\\\u8C22\\\u8C22\\\u4F60\\\uFF0C\\\u6742\\\u8349\\\u6E05\\\u9664\\\u5E72\\\u51C0\\\u4E86\\\uFF01";
		$setting2 = "\\\u8C22\\\u8C22\\\u4F60\\\uFF0C\\\u5BB3\\\u866B\\\u6E05\\\u9664\\\u5E72\\\u51C0\\\u4E86\\\uFF01";
		$setting3 = "\\\u7F3A\\\u5FB7\\\u554A\\\uFF01\\\u7ADF\\\u7136\\\u505A\\\u8FD9\\\u79CD\\\u574F\\\u4E8B\\\uFF01";
		$setting4 = "\\\u53EF\\\u6076\\\u554A\\\uFF01\\\u4F60\\\u771F\\\u4E0D\\\u662F\\\u4E2A\\\u597D\\\u4EBA\\\uFF01";
		$setting5 = "";
		$setting6 = "\\\u8C22\\\u8C22\\\u5E2E\\\u5FD9\\\uFF0C\\\u4F60\\\u771F\\\u662F\\\u4E2A\\\u597D\\\u4EBA\\\uFF01";
		if ( $_REQUEST['id'] == 1){$setting_str = $setting1 ;}
		elseif ( $_REQUEST['id'] == 2){	$setting_str = $setting2 ;}
		elseif ( $_REQUEST['id'] == 3){	$setting_str = $setting3 ;}
		elseif ( $_REQUEST['id'] == 4){	$setting_str = $setting4 ;}
		elseif ( $_REQUEST['id'] == 5){	$setting_str = $setting5 ;}
		elseif ( $_REQUEST['id'] == 6){	$setting_str = $setting6 ;}
	}else{
		$setting_str = json_encode ($setting_str);
		$setting_str = str_replace( "\"", "", $setting_str );
		$setting_str = str_replace( "\\u", "\\\u", $setting_str );
	}
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set setting".$_REQUEST['id']." ='".$setting_str."' where uid=".$UID );
	$setting_str = str_replace( "\\\u", "\\u", $setting_str );
	echo json_decode("\"".$setting_str."\"") ;
	exit();
}

if ( $_REQUEST['mod'] == "gb" && $_REQUEST['act'] == "buy" ){//Y币购买
	$activeitem =$_REQUEST['payitem'];
    $aa=explode("-",$activeitem);

    $fb = $_SGLOBAL['db']->query( "SELECT yb,vip FROM ".tname( "happyfarm_config" )." where uid=".$UID ) ;
     while ( $value = $_SGLOBAL['db']->fetch_array( $fb ) )
	{
		$list[] = $value;
	}
	$fb=$list[0][yb];
	$vip=$list[0][vip];
	$type1=intval($aa[0]/10000);
	$ab=$aa[0];
	$number=$aa[1]; 
	 if ($type1 == 4)
    {   
    	$tid = $ab-40000;	
    	$query = $_SGLOBAL['db']->query( "SELECT dog FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$dogstr = ( array )json_decode( $list[1][dog]);
     
		if ( $tid < 9000 )
		{		
				if ($vip > "0")
				{
				$buy_fb = $Toolstype[$ab]["YFBPrice"];
				}
				else
				{
				$buy_fb = $Toolstype[$ab]["FBPrice"];
				}
			   $tName = $Toolstype[$ab][tName];
               
			if ( $buy_fb == 0 ) {
			
				echo"{\"code\":50,\"msg\":\"\\u7CFB\\u7EDF\\u51FA\\u9519\\u5566\\uFF0C\\u8BF7\\u5237\\u65B0\\u4EE5\\u540E\\u91CD\\u8BD5\\uFF01\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
				exit();
				}
			if ($fb < $buy_fb)
			{
					echo"{\"code\":50,\"msg\":\"\\u4F59\\u989D\\u4E0D\\u8DB3,\\u8BF7\\u5148\\u5145\\u503C\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
                exit();	
			}
			if ($dogstr["dogs"]<>"")
			{
			if ($dogstr["dogs"]->$tid->dogUnWorkTime == 1)
            {
				echo('{"code":50,"msg":"\u4f60\u5df2\u7ecf\u62e5\u6709\u4e86\u8fd9\u6761\u72d7\u4e86\u3002","payqb":0,"payqp":0,"dnaurl":""}');
				exit();            
			}
			}
			if ( $dogstr["dogFeedTime"] < $_SGLOBAL['timestamp'] )
			{
				$dogstr["dogFeedTime"] = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr["dogFeedTime"] = $dogstr["dogFeedTime"] + 86400 ;
			}
			if ( $tid == 1)
			{
				$a = 3;
			}
			else if ($tid == 3)
			{
				$a = 1;
			}
			$dogstr["dogs"]->$a->status = 0;
			$dogstr["dogs"]->$tid->status = 1;
			$dogstr["dogs"]->$tid->dogUnWorkTime = 1;		   
		}
		else
		{
  		if ($vip > "0")
		{
		$buy_fb = $Toolstype[$ab-40000]["YFBPrice"];
		}
		else
		{
		$buy_fb = $Toolstype[$ab-40000]["FBPrice"];
	   	}
			$tName = $Toolstype[$tid]["tName"];

              if ( $buy_fb == 0 ) {
			
				echo"{\"code\":50,\"msg\":\"\\u7CFB\\u7EDF\\u51FA\\u9519\\u5566\\uFF0C\\u8BF7\\u5237\\u65B0\\u4EE5\\u540E\\u91CD\\u8BD5\\uFF01\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
				exit();
				}
			if ($fb < $buy_fb and $fb<=0)
			{
					echo"{\"code\":50,\"msg\":\"\\u4F59\\u989D\\u4E0D\\u8DB3,\\u8BF7\\u5148\\u5145\\u503C\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
                exit();	
			}
			 if ( $ab-40000 == 9001 )
			{
				$dogFeed = 86400;
			}
			elseif ( $ab-40000 == 9002 )
			{
				$dogFeed = 604800;
			}
			else
			{
				$dogFeed = 0;
			}
			if ( $dogstr["dogFeedTime"] < $_SGLOBAL['timestamp'] )
			{
				$dogstr["dogFeedTime"] = $_SGLOBAL['timestamp'] + $dogFeed ;
			}
			else
			{
				$dogstr["dogFeedTime"] = $dogstr["dogFeedTime"] + $dogFeed ;
			}
		}
		$dogstr_str = json_encode ($dogstr);
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set dog='".$dogstr_str."' where uid=".intval( $UID ) );
	    $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set yb=yb - ".$buy_fb." where uid=".intval( $UID ) );
	  echo "{\"tId\":".$tid.",\"tName\":\"".$tName."\",\"code\":0,\"direction\":\"\\u8d2d\\u4e70\\u6210\\u529f\\u3002\",\"num\":".$number.",\"FB\":-".$buy_fb.",\"money\":0,\"type\":".$type1."}";	
    }	
	if ($type1 == 2)
	{
		
	$query = $_SGLOBAL['db']->query( "SELECT decorative FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$decorative = (array)json_decode ($list[1][decorative]);
	$decorative1 = json_decode ($list[1][decorative]);
	    if (vip > "0")
	    {
	    $buy_fb = $itemtype[$ab-20000][YFBPrice];
	    }
	    else
	   {
	    $buy_fb = $itemtype[$ab-20000][FBPrice];
	   }
	$buy_time = $itemtype[$ab-20000][itemValidTime];
	$buy_type = $itemtype[$ab-20000][itemType];
	$buy_exp = $itemtype[$ab-20000][exp];
	if ( $buy_fb == 0 ) {
		echo"{\"code\":50,\"msg\":\"\\u7CFB\\u7EDF\\u51FA\\u9519\\u5566\\uFF0C\\u8BF7\\u5237\\u65B0\\u4EE5\\u540E\\u91CD\\u8BD5\\uFF01\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
		exit();
		}
	if ( $fb < $buy_fb )
	{
	echo"{\"code\":1,\"msg\":\"\\u4F59\\u989D\\u4E0D\\u8DB3,\\u8BF7\\u5148\\u5145\\u503C\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
    exit();
    }
	foreach ( $decorative as $item_type => $value )
	{
		$value_arr = (array)$value;
		if ( $buy_type == $item_type )
			
		{
			foreach ( $value_arr as $key => $value1 )
			{
				if ( $key == $aa[0]-20000 )
				{				    
					echo('{"code":50,"msg":"\u4f60\u5df2\u62e5\u6709\u8fd9\u4e2a\u88c5\u9970\uff0c\u4e0d\u80fd\u91cd\u590d\u8d2d\u4e70\u3002"}');
                    exit();	
				}
				else
				{
					$ab1 = $ab-20000;
					$decorative1->$item_type->$ab1->status=0;
					$decorative1->$item_type->$ab1->validtime=$_SGLOBAL['timestamp'] + $buy_time;
				}
			}
		}
	}
     $decorative_str = json_encode ($decorative1);
	 $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set exp = exp + ".$buy_exp.",decorative='".$decorative_str."' where uid=".intval( $UID ) );
     $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set yb=yb - ".$buy_fb." where uid=".intval( $UID ) );

	echo "{\"code\":0,\"exp\":".$buy_exp.",\"money\":0,\"FB\":-".$buy_fb.",\"levelUp\":false}";
	exit();
	 } 
   	if ($type1 == 3)
   		$did=$ab-30000;
    {
		$query = $_SGLOBAL['db']->query( "SELECT tools FROM ".tname( "happyfarm_nc" )." where uid=".$UID );
		if ($vip > "0")
		{
		$buy_fb = $Toolstype[$ab]["YFBPrice"]*$number;
		}
		else
		{
		$buy_fb = $Toolstype[$ab]["FBPrice"]*$number;
	   	}
		$tName = $Toolstype[$ab][tName];
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			$list[] = $value;
		}
		$fertarr = json_decode( $list[1][tools]); 
		if ( $buy_fb == 0 ) {
		echo"{\"code\":50,\"msg\":\"\\u7CFB\\u7EDF\\u51FA\\u9519\\u5566\\uFF0C\\u8BF7\\u5237\\u65B0\\u4EE5\\u540E\\u91CD\\u8BD5\\uFF01\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
		exit();
		}
		if ($fb < $buy_fb)
		{
		echo"{\"code\":50,\"msg\":\"\\u4F59\\u989D\\u4E0D\\u8DB3,\\u8BF7\\u5148\\u5145\\u503C\",\"payqb\":0,\"payqp\":0,\"dnaurl\":0}";
        exit();
		}
		$fertarr->$did  = $fertarr->$did + $number;
		$fertarr_str = json_encode ($fertarr);
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set tools='".$fertarr_str."' where uid=".intval( $UID ) );
	    $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set yb=yb - ".$buy_fb." where uid=".intval( $UID ) );
	    echo "{\"tId\":".$did.",\"tName\":\"".$tName."\",\"code\":1,\"msg\":\"\\u8d2d\\u4e70\\u6210\\u529f\\u3002\",\"num\":".$number.",\"fb\":-".$buy_fb.",\"money\":0,\"type\":".$type1."}";	
    } 
	exit();
}//Y币购买

if ( $_REQUEST['mod'] == "chat"&& $_REQUEST['act'] == "clearLog" ){
        $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set log='' where uid=".$_SGLOBAL['supe_uid'] );      
        echo "{\"code\":1}";
		exit();
}

if ( $_REQUEST['mod'] == "chat"&& $_REQUEST['act'] == "clearChat" ){
        $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set Message='' where uid=".$_SGLOBAL['supe_uid'] );        
        echo "{\"code\":1}";
		exit();
}

if ( $_REQUEST['mod'] == "item" && $_REQUEST['act'] == "healthMode"){//健康模式
	$query = $_SGLOBAL['db']->query( "SELECT healthMode FROM ".tname( "happyfarm_nc" )." where uid=".intval( $UID ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}  
	$healthModestr = (array)json_decode( $list[0][healthMode]);
	if ($healthModestr["set"]==1)
	{
	$set = $healthModestr["canClose"]=1;
	$set = $healthModestr["set"]=0;
	$set = $healthModestr["valid"]=0;
	$set = $healthModestr["beginTime"]=0;
	$set = $healthModestr["endTime"]=0;
	$set = $healthModestr["serverTime"]=0;
	$set = $healthModestr["time"]="08|00";
    $set = $healthModestr["date"]="1970-01-01|1970-01-07";}

    else
    {
	$set = $healthModestr["set"]=1;
	$set = $healthModestr["valid"]=1;
	$set = $healthModestr["beginTime"]=strtotime('1 day');
	$set = $healthModestr["endTime"]=strtotime('8 day');
	$set = $healthModestr["canClose"]=0;
	$set = $healthModestr["serverTime"]=strtotime('1 day') ;	
	$time = $healthModestr["time"]=$_REQUEST['time'];
	$datetime = date('Y-m-d', strtotime('1 day'));
	$dtak=date("Y-m-d", strtotime('8 day'));
    $date = $healthModestr["date"]="".$datetime."|".$dtak."";
   }
    $healthmode=json_encode($healthModestr);
    $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set healthMode='".$healthmode."' where uid=".$_SGLOBAL['supe_uid'] );        
	echo "{\"code\":1,\"date\":\"".$date."\"}"; 
	exit();
}//健康模式


if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "checkStatus"){//新年任务
	echo "\"\"";
	exit();
}//新年任务

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "exchange"){//消费
	$query = $_SGLOBAL['db']->query( "SELECT exchange FROM ".tname( "happyfarm_config" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$exchange =(array)json_decode ($list[0][exchange]);
	array_multisort($exchange[cost],SORT_DESC );
	$exchange_str = json_encode ($exchange[cost]);
	echo "{\"code\":1,\"cost\":".$exchange_str."}";
	exit();
}//消费

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] =="case") {//加工厂
	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	$query = $_SGLOBAL['db']->query( "SELECT mc.package, nc.tools ,nc.fruit  FROM ".tname( "happyfarm_mc" )." mc,".tname( "happyfarm_nc" )." nc where mc.uid=nc.uid and nc.uid=".$UID );//便便
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value; 
	}
	$mc_package = json_decode($list[0][package]);
	$nc_tools = json_decode($list[0][tools]);
	$nc_fruit = json_decode($list[0][fruit]);
	// 5便便 5红玫瑰 1000金币
	$bbID = 1506;
	$blbID = 41;
	$jshfID = 3;
	if($mc_package->$bbID < 5){
		$msg = '<font color=\"#F47600\"><b>'.(5-$mc_package->$bbID).'\u4E2A\u7267\u573A\u4FBF\u4FBF</b></font> ';
	}
	if($nc_fruit->$blbID < 5){
		$msg .= '<font color=\"#F47600\"><b>'.(5-$nc_fruit->$blbID).'\u6735\u7EA2\u73AB\u7470</b></font> ';
	}
	if($money < 1000){
		$msg .= '<font color=\"#F47600\"><b>'.(1000-$money).'\u4E2A\u91D1\u5E01</b></font>';
	}
	if($msg){
		echo '{"code":0,"direction":"\u60A8\u8FD8\u5DEE'.$msg.'\u3002<br>\u9B54\u6CD5\u5E08\u6CA1\u6CD5\u5E2E\u60A8\u53D8\u51FA\u9AD8\u901F\u5316\u80A5\u54E6\uFF01<br>\u96C6\u9F50\u5FC5\u8981\u7684\u4E1C\u897F\u518D\u6765\u8BD5\u8BD5\u5427\uFF01","poptype":0}';
		exit();
	}
	$mc_package->$bbID -= 5;
	$nc_fruit->$blbID -= 5;
	$nc_tools->$jshfID += 1;
	$_SGLOBAL['db']->query("update ".tname( 'happyfarm_mc' )." set package='".json_encode($mc_package)."' where uid=".$UID);	
	$_SGLOBAL['db']->query("update ".tname( 'happyfarm_config' )." set money=money-1000 where uid=".$UID);	
	$_SGLOBAL['db']->query("update ".tname( 'happyfarm_nc' )." set tools='".json_encode($nc_tools)."', fruit='".json_encode($nc_fruit)."' where uid=".$UID);	
	echo '{"code":1,"direction":"\u54C7\uFF01\u597D\u795E\u5947\uFF01\u9B54\u6CD5\u5E08\u628A\u60A8\u7684<font color=\"#F47600\"><b>5\u4E2A\u7267\u573A\u4FBF\u4FBF</b></font>\u53D8\u6210\u4E86<font color=\"#F47600\"><b>\u4E00\u888B\u6781\u901F\u5316\u80A5</b></font>\uFF01<br>\u540C\u65F6\u60A8\u6D88\u8017\u4E86<font color=\"#F47600\"><b>5\u6735\u7EA2\u73AB\u7470</b></font>\u548C<font color=\"#F47600\"><b>1000\u4E2A\u91D1\u5E01</b></font>\u3002<br>\u9B54\u6CD5\u5E08\u5DF2\u7ECF\u628A\u9AD8\u901F\u5316\u80A5\u6084\u6084\u7684\u653E\u8FDB\u4E86\u60A8\u7684\u519C\u573A\u5305\u88F9\u4E2D\uFF0C\u8D76\u7D27\u53BB\u770B\u770B<br>","money":-1000,"poptype":0}';
	exit();
}//加工厂

if ( $_REQUEST['mod'] == "Feast" && $_REQUEST['act'] == "getPackageList" ){//礼包提示
	//读VIP级别，根据VIP级别送不同的礼物
	$vip = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT vip FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	switch ($vip) {
		case 1:
			$item='[{"eNum":1,"eParam":41,"eType":1}]';
			break;
		case 2:
			$item='[{"eNum":3,"eParam":1,"eType":3}]';
		   break;
		case 3:
			$item='[{"eNum":4,"eParam":1,"eType":3}]';
		   break;
		case 4:
			$item='[{"eNum":4,"eParam":1,"eType":3},{"eNum":1,"eParam":9001,"eType":909090}]';
		   break;
		case 5:
			$item='[{"eNum":5,"eParam":2,"eType":3},{"eNum":1,"eParam":9001,"eType":909090}]';
		   break;
		case 6:
			$item='[{"eNum":5,"eParam":1,"eType":3},{"eNum":5,"eParam":2,"eType":3},{"eNum":1,"eParam":9001,"eType":909090}]';
		   break;
		case 7:
			$item='[{"eNum":5,"eParam":3,"eType":3},{"eNum":5,"eParam":2,"eType":3},{"eNum":1,"eParam":9001,"eType":909090}]';
		   break;
		case 8:
			$item='[{"eNum":5,"eParam":3,"eType":3},{"eNum":5,"eParam":2,"eType":3},{"eNum":1,"eParam":9001,"eType":909090}]';
		   break;
		case 9:
			$item='[{"eNum":5,"eParam":3,"eType":3},{"eNum":5,"eParam":2,"eType":3},{"eNum":1,"eParam":9001,"eType":909090}]';
		   break;
		default:
			$item='';		
	}
	echo '{"direction":"\u60A8\u5F53\u524D\u9886\u53D6\u7684\u662FVIP\u7528\u6237\u6BCF\u65E5\u793C\u5305\u3002<br>\u60A8\u7684VIP\u7EA7\u522B\u4E3A\uFF1A</b><font color=\"#CC3300\">'.$vip.'</font> \uFF0C\u83B7\u5F97\u4EE5\u4E0B\u5956\u52B1\uFF1A <br>","item":'.$item.',"title":"\u6BCF\u65E5\u793C\u5305","vip":'.$vip.',"vipItem":"","vipText":""}';
	exit( );
}//礼包提示

if ( $_REQUEST['mod'] == "Feast" && $_REQUEST['act'] == "getPackage" ){//每日礼包
	$vip = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT vip FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );	
	$query = $_SGLOBAL['db']->query( "SELECT package,tools,nc_d,dog FROM  ".tname( "happyfarm_nc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$package = json_decode($list[0][package]);
	$tools = json_decode($list[0][tools]);
	$dogstr = json_decode($list[0][dog]);

	if($list[0][nc_d]==0){
		exit();
	}
	switch ($vip) {
		case 1:
			$cId = 41;
			$package->$cId = $package->$cId + 1;
			break;
		case 2:
            $cId = 1;
			$tools->$cId = $tools->$cId + 3;
		
		   break;
		case 3:
            $cId = 1;
			$tools->$cId = $tools->$cId + 4;
		   break;
		case 4:
            $cId = 1;
			$tools->$cId = $tools->$cId + 5;
		   	if ( $dogstr->dogFeedTime < $_SGLOBAL['timestamp'] )
			{
				$dogstr->dogFeedTime = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr->dogFeedTime = $dogstr->dogFeedTime + 86400 ;
			}
		   break;
		case 5:
            $cId = 2;
			$tools->$cId = $tools->$cId + 5;
		   	if ( $dogstr->dogFeedTime < $_SGLOBAL['timestamp'] )
			{
				$dogstr->dogFeedTime = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr->dogFeedTime = $dogstr->dogFeedTime + 86400 ;
			}
		   break;
		case 6:
            $cId = 1;
			$tools->$cId = $tools->$cId + 5;
		    $cId1 = 2;
			$tools->$cId1 = $tools->$cId1 + 5;
		   	if ( $dogstr->dogFeedTime < $_SGLOBAL['timestamp'] )
			{
				$dogstr->dogFeedTime = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr->dogFeedTime = $dogstr->dogFeedTime + 86400 ;
			}
		   break;
		case 7:
            $cId = 2;
			$tools->$cId = $tools->$cId + 5;
		    $cId1 = 3;
			$tools->$cId1 = $tools->$cId1 + 5;
		   	if ( $dogstr->dogFeedTime < $_SGLOBAL['timestamp'] )
			{
				$dogstr->dogFeedTime = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr->dogFeedTime = $dogstr->dogFeedTime + 86400 ;
			}
			break;
		case 8:
            $cId = 2;
			$tools->$cId = $tools->$cId + 1;
		    $cId1 = 3;
			$tools->$cId1 = $tools->$cId1 + 1;
		   	if ( $dogstr->dogFeedTime < $_SGLOBAL['timestamp'] )
			{
				$dogstr->dogFeedTime = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr->dogFeedTime = $dogstr->dogFeedTime + 86400 ;
			}
			break;
		case 9:
            $cId = 2;
			$tools->$cId = $tools->$cId + 1;
		    $cId1 = 3;
			$tools->$cId1 = $tools->$cId1 + 1;
		   	if ( $dogstr->dogFeedTime < $_SGLOBAL['timestamp'] )
			{
				$dogstr->dogFeedTime = $_SGLOBAL['timestamp'] + 86400 ;
			}
			else
			{
				$dogstr->dogFeedTime = $dogstr->dogFeedTime + 86400 ;
			}
			break;
	}
	$package_str = json_encode($package);
	$tools_str = json_encode($tools);
	$dog_str = json_encode($dogstr);
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set tools='".$tools_str."', package='".$package_str."', dog='".$dog_str."',nc_d=0 where uid=".$UID );
	exit( );
}//每日礼包

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "getNotice" ){
	$nc_notice = unicode_encode( farmnotice() );
	echo "{\"id\":".$_SGLOBAL['timestamp'].",\"content\":\"".$nc_notice."\",\"time\":".$_SGLOBAL['timestamp'].",\"code\":1}";
	exit( );
}

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "welcome" ){
	echo null;
	exit( );
}
?>
