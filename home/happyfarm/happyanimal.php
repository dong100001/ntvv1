<?php
/****************************************/
/*      Nông trại vui vẻ QQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com
//禁止站外提交
/*if (strspn("MSIE",$_SERVER["HTTP_USER_AGENT"])==4){ 
   if(7 != strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']) OR 7 != strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])){ 
        echo '{"direction":"请使用POST方法调用","errorType":"timeOut","poptype":3}';
		exit();
	}
}*/
//禁止站外提交
include_once( "common.php" );
include_once( "config/animal.php" );

$UID = $_SGLOBAL['supe_uid'];
if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}
$space = getspace( $UID );
$animaltype = animaltype();
$animaltime = animaltime();
$animalname = animalname();
function grade_animal($grade)
{
        $grade = intval( $grade );
        if ($grade < 1) { return 2; }
        if ($grade == 1) { return 3; }
        return ( intval(ceil($grade/2)) + 3 );
}
if ( empty( $space[name] ) )
{
	$space[name] = $space[username];
}
$spacename = unicode_encode( $space[name] );
function getLevel($exp){
	$sum=0;
	$i=1;
	while($exp>=$sum){
		$sum+=$i*200;
		$i++;
	}
	return $i-2;
}

if ( empty( $UID ) )
{	
	echo "{\"errorContent\":\"\\u8BF7\\u767B\\u9646\\u540E\\u518D\\u8BD5!\",\"errorType\":\"1000\"}";
	exit ();
}

$maxuid = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT uid FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
if ( $maxuid == null )
{
	$userpf = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT pf FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	if ( $userpf == 1 )
	{

		$bad = "";
		$animal = "{\"animalfood\":20,\"animalfeedtime\":".$_SGLOBAL['timestamp'].",";
		$animal = $animal."\"item1\":1,\"item2\":1,\"item3\":0,\"item4\":1,";
		$animal = $animal."\"animal\":[";
		$animal = $animal."{\"buyTime\":1244817632,\"cId\":1002,\"postTime\":0,\"totalCome\":0,\"tou\":\"\",\"feedtime\":0},";
		$animal = $animal."{\"buyTime\":".($_SGLOBAL['timestamp'] - 28800 - 7200).",\"cId\":1002,\"postTime\":0,\"totalCome\":0,\"tou\":\"\",\"feedtime\":0}";
		$animal = $animal."]}";	
		$package = "{}";
		$parade = "{\"i\":\"\\\u60A8\\\u53EF\\\u4EE5\\\u5B9A\\\u4E49\\\u597D\\\u53CB\\\u8BBF\\\u95EE\\\u65F6\\\u52A8\\\u7269\\\u7684\\\u6B22\\\u8FCE\\\u8BED\",\"p\":0,\"v\":1}";
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set pf=1 where uid=".intval( $UID ) );
		$_SGLOBAL['db']->query( "INSERT INTO ".tname( "happyfarm_mc" )." (uid,Status,taskid,package,tools,decorative,bad,parade,repertory) VALUES(".$UID.",'".$animal."','".$taskid."','".$package."','".$tools."','".$decorative."','".$bad."','".$parade."','".$repertory."')" );
	
	}
	else
	{
		exit ();
	}
}


if ( $_REQUEST['mod'] == "cgi_get_notice"){//牧场公告
	$nc_notice = unicode_encode( farmnotice() );
	echo "{\"id\":".$_SGLOBAL['timestamp'].",\"content\":\"".$nc_notice."\",\"time\":".$_SGLOBAL['timestamp'].",\"code\":1}";
	exit( );
}//牧场公告

if ( $_REQUEST['mod'] == "cgi_set_parade" ){//设置队行
	$parade['i'] = $_REQUEST['pinfo'];
	$parade['p'] = $_REQUEST['pid'];
	$parade['v'] = "1";
	$parade = json_encode($parade);
	$parade = str_replace( "\"{", "{", $parade );
	$parade = str_replace( "}\"", "}", $parade );
	$parade = str_replace( "\\u", "\\\\u", $parade );

	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set parade='".$parade."' where uid=".intval( $UID ) );
	echo "{\"code\":1}" ;
	exit( );
}//设置队行

if ( $_REQUEST['mod'] == "cgi_get_parade" ){//读取队行
        $query = $_SGLOBAL['db']->query( "SELECT parade FROM ".tname( "happyfarm_mc" )." where uid=".intval( $UID ) );

	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$parade = json_decode( $list[0][parade] );
	echo "{\"i\":\"".$parade->i."\",\"p\":".$parade->p.",\"v\":".$parade->v."}" ;
	exit( );
}//读取队行

if ( $_REQUEST['mod'] == "cgi_enter" || $_REQUEST['mod'] == "cgi_enter?" ){//牧场初始化
 	if ( 0 < intval( $_REQUEST['uId'] ) )

  {
    $touarr = array( "1001" => 0, "1002" => 0, "1003" => 0, "1004" => 0, "1005" => 0, "1006" => 0, "1007" => 0, "1008" => 0, "1009" => 0, "1010" => 0, "1011" => 0,"1012" => 0,"1013" => 0,"1014" => 0,"1015" => 0,"1016" => 0,  "1501" => 0, "1502" => 0, "1503" => 0, "1504" => 0, "1505" => 0, "1507" => 0, "1508" => 0, "1509" => 0,"1510" => 0 ,"1511" => 0,"1512" => 0 );
	$query = $_SGLOBAL['db']->query( "SELECT C.uid,C.money,C.vip,M.Status,M.exp,M.taskid,M.bad,M.parade,M.dabian FROM ".tname( "happyfarm_config" )." C Left JOIN ".tname( "happyfarm_mc" )." M ON M.uid=C.uid where C.uid=".intval( $_REQUEST['uId'] ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	
	$parade = json_decode( $list[0][parade] );
	$animal = ( array )json_decode( $list[0][Status] );

   //便便
   $dabian_mynum=0;
   $dabian_num=$list[0][dabian];
	//bad
	$bad_num=0;
	$bad_mynum=0;
	if ($list[0][bad]!="")
	{
		$bad = explode(",",$list[0][bad]);
		$bad_num = count($bad);
		for ($i=0 ; $i < $bad_num ; $i++)
		{ 
			if ($bad[$i]==$UID)
			{
				$bad_mynum = $bad_mynum + 1;
			}
		}
		if($bad_mynum > 8) 
		{
			$bad_mynum = 8;
		} 
	}
	//bad  
		$needfood = 0;
		$hungry=0;
		foreach ( $animal[animal] as $key => $value )
			{
				if ( 0 < $value->cId )
				{
					if ( $touarr[$value->cId] = 3 )
					{
									$touarr[$value->cId] = 3;
									if ( stristr( $value->tou, ",".$_SGLOBAL['supe_uid']."," ) )
									{
													$touarr[$value->cId] = 2;
									}
									if ( $value->totalCome <= $animaltype[$value->cId][output]  / 2  )
									{
													$touarr[$value->cId] = 1;
									}
					}
				
                	$value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                	if($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]){
						$value_feedtime = $animaltime[$value->cId][5];
					} else {
						$value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
					}
					if($_SGLOBAL['timestamp'] - $value->feedtime > 3600*12){
						$value_feedtime = 3600*12;
					}
					$needfood = $value_feedtime / 3600 * $animaltype[$value->cId][consum] / 4;
                	if( $needfood <= $animal[animalfood] ){
                		$value->feedtime = $_SGLOBAL['timestamp'];
                		$animal[animalfood] -= $needfood; 
                		$hungry = 0;
                	}else{
                		$value->feedtime += $animal[animalfood] * 4 / $animaltype[$value->cId][consum] * 3600;
						$hungry = 1;
                		$animal[animalfood] = 0; 
                	}
               
					if ( $value->postTime == 0 )
					{
									$time = $_SGLOBAL['timestamp'] - $value->buyTime;
									if ( $animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time )
									{
													$status = 3;
													$growTimeNext = 12993;
													$statusNext = 6;
									}
									if ( $animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] + $animaltime[$value->cId][1] )
									{
													$status = 2;
													$growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
													$statusNext = 3;
									}
									if ( $time < $animaltime[$value->cId][0] )
									{
													$status = 1;
													$growTimeNext = $animaltime[$value->cId][0] - $time;
													$statusNext = 2;
									}
									if ( $animaltime[$value->cId][5] < $time )
									{
													$status = 6;
													$growTimeNext = 0;
													$statusNext = 6;
									}
									$newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$value->totalCome."}";
					}
					else
					{
									$totalCome = $value->totalCome;
									$time = $_SGLOBAL['timestamp'] - $value->buyTime;
									if ( $animaltime[$value->cId][5] < $time )
									{
													$status = 6;
													$statusNext = 6;
													$growTimeNext = 0;
									}
									if ( $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime )
									{
													$status = 3;
													$statusNext = 6;
													$growTimeNext = 12993;
									}
									if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4] )
									{
													$status = 5;
													$statusNext = 3;
													$growTimeNext = $animaltime[$value->cId][4] - ( $_SGLOBAL['timestamp'] - $value->postTime );
									}
									if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3] )
									{
													$status = 4;
													$statusNext = 5;
													$growTimeNext = $animaltime[$value->cId][3] - ( $_SGLOBAL['timestamp'] - $value->postTime );
													$totalCome -= $animaltype[$value->cId][output];
									}
									if ( $value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] - $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] )
									{
													$status = 5;
													$statusNext = 6;
													$growTimeNext = $animaltime[$value->cId][5] - $time;
									}
									$newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$totalCome."}";
					}
				}
			}
	$newanimal = json_encode( $newanimal );
	$newanimal = str_replace( "\"{", "{", $newanimal );
	$newanimal = str_replace( "}\"", "}", $newanimal );
	$newanimal = str_replace( "null", "[]", $newanimal );
	$animal[animalfeedtime] = $_SGLOBAL['timestamp'];
	$stranimal = json_encode( $animal );
	$animal[animalfood] = ceil( $animal[animalfood] );
	$touyes = ">";
	foreach ( $touarr as $key => $value )
	{
					if ( 0 < $value )
					{
									$touyes = $touyes.",\"".$key."\":".$value."";
					}
	}
	$touyes = str_replace( ">,", "", $touyes );
	$touyes = str_replace( ">", "", $touyes );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."' where uid=".intval( $_REQUEST['uId'] ) );
	$taskFlag = 1;
	if ( $list[0][taskid] == 10 )
	{
		$taskFlag = 0;
	}
	//牧场房子
	$animal[item2] = "\"2\":{\"id\":102,\"lv\":".$animal[item2]."},";
	if ( $animal[item3] == 0 )
	{
					$animal[item3] = "";
	}
	else
	{
					$animal[item3] = "\"3\":{\"id\":103,\"lv\":".$animal[item3]."},";
	}

	echo stripslashes( "{\"animal\":".$newanimal.",\"animalFood\":".$animal[animalfood].",\"badinfo\":[{\"mynum\":".$bad_mynum.",\"num\":".$bad_num.",\"type\":1},{\"mynum\":".$dabian_mynum.",\"num\":".$dabian_num.",\"type\":2}],\"c\":0,\"items\":{\"1\":{\"id\":101,\"lv\":".$animal[item1]."},".$animal[item2].$animal[item3]."\"4\":{\"id\":104,\"lv\":".$animal[item4]."}},\"stealflag\":{".$touyes."},\"parade\":{\"i\":\"".$parade->i."\",\"p\":".$parade->p.",\"v\":".$parade->v."},\"task\":{\"taskFlag\":".$taskFlag.",\"taskId\":".$list[0][taskid]."},\"user\":{\"exp\":".$list[0][exp].",\"money\":".$list[0][money].",\"uId\":".$_REQUEST['uId'].",\"wp\":{\"bq\":12000,\"f\":0,\"lp\":1,\"lq\":20000,\"lv\":3,\"lw\":1,\"xp\":1,\"xq\":8000,\"xw\":2}}}" );
	exit( );

   }

    $query = $_SGLOBAL['db']->query( "SELECT C.uid,C.money,C.vip,C.jb,M.Status,M.exp,M.taskid,M.bad,M.parade,M.dabian FROM ".tname( "happyfarm_config" )." C Left JOIN ".tname( "happyfarm_mc" )." M ON M.uid=C.uid where C.uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$parade = json_decode( $list[0][parade] );
	$animal = ( array )json_decode( $list[0][Status] );

        		//便便
			    $dabian_mynum=0;
				$dabian_num=$list[0][dabian];
				//bad
                $bad_num=0;
                $bad_mynum=0;
                if ($list[0][bad]!="")
		              {
                	$bad = explode(",",$list[0][bad]);
                	$bad_num = count($bad);
		              }
		        //bad
	$needfood = 0;
	$hungry=0;
	foreach ( $animal[animal] as $key => $value )
	{
					if ( 0 < $value->cId )
					{
									//*********************************************
                    				$value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                    				if($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]){
										$value_feedtime = $animaltime[$value->cId][5];
									} else {
										$value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
									}
									if($_SGLOBAL['timestamp'] - $value->feedtime > 3600*12){
										$value_feedtime = 3600*12;
									}
									$needfood = $value_feedtime / 3600 * $animaltype[$value->cId][consum] / 4;
                    				if( $needfood <= $animal[animalfood] ){
                            			$value->feedtime = $_SGLOBAL['timestamp'];
                            			$animal[animalfood] -= $needfood; 
                            			$hungry = 0;
                    				}else{
                            			$value->feedtime += $animal[animalfood] * 4 / $animaltype[$value->cId][consum] * 3600;
										$hungry = 1;
                            			$animal[animalfood] = 0; 
                   					}
                    				//*********************************************
									if ( $value->postTime == 0 )
									{
													$time = $_SGLOBAL['timestamp'] - $value->buyTime;
													if ( $animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time )
													{
																	$status = 3;
																	$growTimeNext = 12993;
																	$statusNext = 6;
													}
													if ( $animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] + $animaltime[$value->cId][1] )
													{
																	$status = 2;
																	$growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
																	$statusNext = 3;
													}
													if ( $time < $animaltime[$value->cId][0] )
													{
																	$status = 1;
																	$growTimeNext = $animaltime[$value->cId][0] - $time;
																	$statusNext = 2;
													}
													if ( $animaltime[$value->cId][5] < $time )
													{
																	$status = 6;
																	$growTimeNext = 0;
																	$statusNext = 6;
													}
													$newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$value->totalCome."}";
									}
									else
									{
													$time = $_SGLOBAL['timestamp'] - $value->buyTime;
													$totalCome = $value->totalCome;
													if ( $animaltime[$value->cId][5] < $time )
													{
																	$status = 6;
																	$statusNext = 6;
																	$growTimeNext = 0;
													}
													if ( $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime )
													{
																	$status = 3;
																	$statusNext = 6;
																	$growTimeNext = 12993;
													}
													if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4] )
													{
																	$status = 5;
																	$statusNext = 3;
																	$growTimeNext = $animaltime[$value->cId][4] - ( $_SGLOBAL['timestamp'] - $value->postTime );
													}
													if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3] )
													{
																	$status = 4;
																	$statusNext = 5;
																	$growTimeNext = $animaltime[$value->cId][3] - ( $_SGLOBAL['timestamp'] - $value->postTime );
																	$totalCome -= $animaltype[$value->cId][output];
													}
													if ( $value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] - $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] )
													{
																	$status = 5;
																	$statusNext = 6;
																	$growTimeNext = $animaltime[$value->cId][5] - $time;
													}
													$newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$totalCome."}";
									}
					}
	}
	$newanimal = json_encode( $newanimal );
	$newanimal = str_replace( "\"{", "{", $newanimal );
	$newanimal = str_replace( "}\"", "}", $newanimal );
	$newanimal = str_replace( "null", "[]", $newanimal );
	$animal[animalfeedtime] = $_SGLOBAL['timestamp'];
	$stranimal = json_encode( $animal );
	$animal[animalfood] = ceil( $animal[animalfood] );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."' where uid=".$UID );

	$taskFlag = 1;
	if ( $list[0][taskid] == 10 )
	{
		$taskFlag = 0;
	}
	//牧场房子
	$animal[item2] = "\"2\":{\"id\":102,\"lv\":".$animal[item2]."},";
	if ( $animal[item3] == 0 )
	{
					$animal[item3] = "";
	}
	else
	{
					$animal[item3] = "\"3\":{\"id\":103,\"lv\":".$animal[item3]."},";
	}
	$image = getheadPic( $UID, "small", true );
	if ( $list[0][vip] > 0 )
	{
		$yellowstatus = 1;
	}
	else
	{
		$yellowstatus = 0;
	}
    $isread = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('happyfarm_mclogs')." WHERE uid = ".$_SGLOBAL['supe_uid']." and isread = 0"), 0);
	if ($isread){ $a = 1; }else { $a = 0;}
    echo stripslashes( "{\"a\":".$a.",\"b\":1,\"c\":".$list[0][jb].",\"d\":0,\"e\":0,\"animal\":".$newanimal.",\"animalFood\":".$animal[animalfood].",\"badinfo\":[{\"mynum\":".$bad_mynum.",\"num\":".$bad_num.",\"type\":1},{\"mynum\":".$dabian_mynum.",\"num\":".$dabian_num.",\"type\":2}],\"items\":{\"1\":{\"id\":101,\"lv\":".$animal[item1]."},".$animal[item2].$animal[item3]."\"4\":{\"id\":104,\"lv\":".$animal[item4]."}},\"parade\":{\"i\":\"".$parade->i."\",\"p\":".$parade->p.",\"v\":".$parade->v."},\"notice\":\"\",\"serverTime\":{\"time\":".$_SGLOBAL['timestamp']."},\"stealflag\":{},\"task\":{\"taskFlag\":".$taskFlag.",\"taskId\":".$list[0][taskid]."},\"user\":{\"exp\":".$list[0][exp].",\"headPic\":\"".$image."\",\"money\":".$list[0][money].",\"uId\":".$UID.",\"userName\":\"".str_replace( "\\u", "\\\\u", $spacename )."\",\"yellowlevel\":".$list[0][vip].",\"yellowstatus\":".$yellowstatus."},\"weather\":{\"weatherDesc\":\"晴天\",\"weatherId\":1},\"wp\":{\"bq\":12000,\"f\":0,\"lp\":1,\"lq\":20000,\"lv\":3,\"lw\":1,\"xp\":1,\"xq\":8000,\"xw\":2}}}" );
	exit( );
}//牧场初始化

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

    $Config = $_SGLOBAL['db']->query( "SELECT C.uid,C.money,C.pf,C.vip,M.exp,S.username,S.name FROM ".tname( "happyfarm_config" )." C Left JOIN ".tname( "happyfarm_mc" )." M ON M.uid=C.uid LEFT JOIN ".tname( "space" )." S ON S.uid=C.uid WHERE C.uid IN (".$space[friend].$UID.")limit 0,300");
    while ( $value = $_SGLOBAL['db']->fetch_array( $Config ) )
    {
       $list[] =$value;
    }
    $jishu = 0;
    foreach ($list as $value) {

		if ($value[exp] == null)
		{
			$value[pf] = 0;
		}
        ++$jishu;
        if ($jishu > 300) {
            break;
        }
		if ( empty( $value[name] ) )
		{
			$value[name] = $value[username];
		}
		$friendavatarimage = getheadPic($value[uid], 'small', true);
			$exp = $value[exp];
			if ($value[pf] == 0 or $value[exp]< 1 )
			{
				$exp = 0;
			}
			if ( $value[vip] > 0 )
			{
				$yellowstatus = 1;
			}
			else
			{
				$yellowstatus = 0;
			}
			$friend_str[] = "{\"userId\":".$value[uid].",\"uin\":".$value[uid].",\"userName\":\"".unicode_encode( $value[name] )."\",\"headPic\":\"".$friendavatarimage."\",\"yellowlevel\":".$value[vip].",\"yellowstatus\":".$yellowstatus.",\"exp\":".$exp.",\"money\":".$value[money].",\"pf\":".$value[pf]."}";
		}
	$friend_str = json_encode( $friend_str );
	$friend_str = str_replace( "\"{", "{", $friend_str );
	$friend_str = str_replace( "}\"", "}", $friend_str );
	$friend_str = str_replace( "\\/", "\\\\/", $friend_str );
	$friend_str = str_replace( ",null,", ",", $friend_str );
	echo stripslashes( $friend_str );
	exit( );
}

if ( $_REQUEST['mod'] == "cgi_get_repertory?target=animal" ){//牧场仓库
	$mc_package = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT package FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
	$mc_package = json_decode( $mc_package );
	foreach ( $mc_package as $key => $value )
	{
								if ( 0 < $value )
								{
												$package[] = "{\"amount\":".$value.",\"cId\":".$key.",\"cName\":\"".$animalname[$key][name]."\",\"price\":".$animalname[$key][price]."}";
					}			
}
	$package = json_encode( $package );
	$package = str_replace( "\\u", "\\\\u", $package );
	$package = str_replace( "\"{", "{", $package );
	$package = str_replace( "}\"", "}", $package );
	$package = str_replace( "null", "[]", $package );
	echo stripslashes( $package );
}//牧场仓库

if ( $_REQUEST['mod'] == "cgi_get_animals" ){//牧场商店
	foreach ( $animaltype as $key => $value )
	{
		$shop_list[] = $value;
	}
	$shop_list_str = json_encode($shop_list);
	$shop_list_str = str_replace( "\\\u", "\u", $shop_list_str );
	echo $shop_list_str;
}//牧场商店

if ( $_REQUEST['mod'] == "cgi_get_food" ){//买草
	$get_food = get_food () ;
	foreach ( $get_food as $key => $value )
	{
		$food_list[] = $value;
	}
	$food_list_str = json_encode($food_list);
	$food_list_str = str_replace( "\\\u", "\u", $food_list_str );
	echo $food_list_str;
}//买草

if ( $_REQUEST['mod'] == "cgi_buy_animal" ){//买动物

	$query = $_SGLOBAL['db']->query( "SELECT uid,Status,exp FROM ".tname( "happyfarm_mc" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$animal = ( array )json_decode( $list[0][Status] );

	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
	$exchange = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT exchange FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );

	$money_1 = $animaltype[$_REQUEST['cId']][price] * $_REQUEST['number'];
	if ( $money < $money_1 )
	{
		exit( );
	}
    $anicount = 0;
    $item2count = 0;
    $item3count = 0;
    if ( 3 > $animal[item2] ){ $item2 = $animal[item2] + 1; }else{ $item2 = $animal[item2] + 2; }
	if ( 0 == $animal[item3] ){ $item3 = 0; }else{ $item3 = $animal[item3] + 2; }
    $animalnum = $item2 + $item3;
    $gradea = 0;
    foreach ($animal[animal] as $key => $value) {
        if ($value->cId != 0) {
            ($value->cId > 1500) ? $item3count++ : $item2count++;
        }
        //自动压缩数据
        if ($key >= $animalnum) {
            unset($animal[animal][$key]);
        } else {
            $gradea++;
        }
    }
    for ($i = 0; $i < $animalnum - $gradea; $i++) {
        $gradea <= 20 && $animal[animal][] = json_decode("{\"buyTime\":0,\"cId\":0,\"postTime\":0,\"totalCome\":0,\"tou\":\"\",\"feedtime\":0}");
    }
    $anicount = $item2count + $item3count;
    //echo "{\"errorContent\":\"".($item3)."\",\"errorType\":\"1011\"}";
    if ($_REQUEST['number'] > $animalnum) {
        echo "{\"errorContent\":\"\\u4F60\\u73B0\\u5728\\u7684\\u7B49\\u7EA7\\u53EA\\u80FD\\u518D\\u9972\\u517B" . ($animalnum -
            $anicount) . "\\u53EA\\u52A8\\u7269\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    if ($_REQUEST['cId'] > 1500 && $_REQUEST['number'] > ($item3 - $item3count)) {
        echo "{\"errorContent\":\"\\u4F60\\u7684\\u68DA\\u53EA\\u80FD\\u518D\\u517B" . ($item3 -
            $item3count) . "\\u53EA\\u52A8\\u7269\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    if ($_REQUEST['cId'] > 1000 && $_REQUEST['cId'] < 1500 && $_REQUEST['number'] >
        ($item2 - $item2count)) {
        echo "{\"errorContent\":\"\\u4F60\\u7684\\u7A9D\\u53EA\\u80FD\\u518D\\u517B" . ($item2 -
            $item2count) . "\\u53EA\\u52A8\\u7269\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    $number = 0;
    foreach ($animal[animal] as $key => $value) {
        if (($value->cId == 0) && ($number < $_REQUEST['number'])) {
            $value->buyTime = $_SGLOBAL['timestamp'];
            $value->cId = $_REQUEST['cId'];
            $value->tou = "";
            ++$number;
            $buyanimal[] = (("{\"buyTime\":" . $_SGLOBAL['timestamp'] . ",\"cId\":" . $_REQUEST['cId'] .
                ",\"createTime\":0,\"feedTime\":" . ($_SGLOBAL['timestamp'] - 14400)) . ",\"growTime\":0,\"growTimeNext\":" .
                ($animaltime[$_REQUEST['cId']][0] - 1)) . ",\"postTime\":" . $_SGLOBAL['timestamp'] .
                ",\"productNum\":0,\"serial\":" . $key . ",\"status\":1,\"statusNext\":2,\"totalCome\":0}";
        }
    }
    $money11=$money-$money_1;
	$farm_log = json_decode( $exchange );
	$log_msg="\u5728\u5546\u5E97\u8D2D\u4E70".$_REQUEST['number']."\u53EA".$animaltype[$_REQUEST['cId']][cName]."\u5D3D\u3002\u82B1\u8D39".$money_1."\u91D1\u5E01,\u8FD8\u5269".$money11."\u91D1\u5E01";
	$farm_log->cost[]= "{\"time\":".$_SGLOBAL['timestamp'].",\"msg\":\"".$log_msg."\"}";
	$farm_log = json_encode($farm_log);
	$farm_log = str_replace( "\"{", "{", $farm_log );
	$farm_log = str_replace( "}\"", "}", $farm_log );
	$farm_log = str_replace( "\\u", "\\\\u", $farm_log );
	$farm_log = str_replace( "\\\"#009900\\\"", "\\\\\\\"#009900\\\\\\\"", $farm_log );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set exchange='".$farm_log."' where uid=".$UID );

	$animal = json_encode( $animal );
	$animal = str_replace( "\"{", "{", $animal );
	$animal = str_replace( "}\"", "}", $animal );
	$_SGLOBAL['db']->query( ( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$animal."',exp=exp+".$_REQUEST['number'] * 5 )." where uid=".$UID );
	$_SGLOBAL['db']->query( ( "UPDATE ".tname( "happyfarm_config" )." set money = money - ".$animaltype[$_REQUEST['cId']][price] * $_REQUEST['number'] )." where uid=".$UID );
	$buyanimal = json_encode( $buyanimal );
	$buyanimal = str_replace( "\"{", "{", $buyanimal );
	$buyanimal = str_replace( "}\"", "}", $buyanimal );
	echo stripslashes( ( "{\"addExp\":".$_REQUEST['number'] * 5 ).",\"animal\":".$buyanimal.",\"code\":0,\"money\":".$animaltype[$_REQUEST['cId']][price] * $_REQUEST['number'].",\"msg\":\"success\",\"num\":".$_REQUEST['number'].",\"uin\":\"\"}" );
	exit( );
}//买动物

if ( $_REQUEST['mod'] == "cgi_get_repertory?target=package" ){//牧场食物
	$fruit = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT fruit FROM ".tname( "happyfarm_nc" )." where uid=".$UID ), 0 );
	$fruit = json_decode( $fruit );
	$id = 40;
	$id1 = 3;
	if ( $fruit->$id1 == null )
	{
		$fruit->$id1 = 0;
	}
	if ( $fruit->$id == null )
	{
		$fruit->$id = 0;
	}
	echo "[{\"amount\":".$fruit->$id.",\"tId\":40,\"tName\":\"\\u7267\\u8349\",\"type\":4},{\"amount\":".$fruit->$id1.",\"tId\":3,\"tName\":\"\\u80e1\\u841d\\u535c\",\"type\":4}]";
    exit( );
}//牧场食物

if ( $_REQUEST['mod'] == "cgi_feed_food" ){//帮自己、好友加草

if( !is_numeric($_REQUEST['foodnum']) || $_REQUEST['foodnum']<1 ) { exit(); }
        $_REQUEST['foodnum']>401 && $_REQUEST['foodnum']=400; 

        if ( $_REQUEST['type'] == "0" )
        {
			$fruit = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT fruit FROM ".tname( "happyfarm_nc" )." where uid=".$_SGLOBAL['supe_uid'] ), 0 );
			$fruit = json_decode( $fruit );
			$id = 40;
			if($fruit->$id<1 || $fruit->$id<$_REQUEST['foodnum']){
				echo "{\"errorContent\":\"\\u80CC\\u5305\\u4E2D\\u7267\\u8349\\u6570\\u91CF\\u4E0D\\u8DB3\\uFF0C\\u8BF7\\u5237\\u65B0\\u67E5\\u770B\\u4F60\\u5B9E\\u9645\\u7267\\u8349\\u6570\\uFF01\",\"errorType\":\"1011\"}";
				exit();
			}else{
				if ( $_REQUEST['uId'] == NULL )
				{
								$GLOBALS['_REQUEST']['uId'] = $_SGLOBAL['supe_uid'];
				}
				$fruit = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT fruit FROM ".tname( "happyfarm_nc" )." where uid=".$_SGLOBAL['supe_uid'] ), 0 );
				$fruit = json_decode( $fruit );
				$mucaoid = 40;
				$query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) );
				while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
				{
								$list[] = $value;
				}
				$animal = ( array )json_decode( $list[0][Status] );
				if ( 401 < $animal[animalfood] + $_REQUEST['foodnum'] )
				{
								$GLOBALS['_REQUEST']['foodnum'] = ceil( 400 - $animal[animalfood] );
				}
				$animal[animalfood] = $animal[animalfood] + $_REQUEST['foodnum'];
				$fruit->$mucaoid = $fruit->$mucaoid - $GLOBALS['_REQUEST']['foodnum'];
				if($GLOBALS['_REQUEST']['foodnum']==0){
					echo "{\"errorContent\":\"\\u5927\\u54E5\\uFF5E\\u5DF2\\u7ECF\\u52A0\\u5230\\u4E0A\\u9650\\u4E86\\uFF0C\\u6709\\u591A\\u7684\\u8349\\u7ED9\\u670B\\u53CB\\u52A0\\u70B9\\u5427\\u2026\\u2026\",\"errorType\":\"1011\"}";
					exit();
				}
				$needfood = 0;
				$hungry=0;
				foreach ( $animal[animal] as $key => $value )
				{
								if ( 0 < $value->cId )
								{
									//*********************************************
                                	$value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                                	
									if($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]){
										$value_feedtime = $animaltime[$value->cId][5];
									} else {
										$value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
									}
									if($_SGLOBAL['timestamp'] - $value->feedtime > 3600*12){
										$value_feedtime = 3600*12;
									}

                                	$needfood = $value_feedtime / 3600 * $animaltype[$value->cId][consum] / 4;
                                	if( $needfood <= $animal[animalfood] ){
                                        $value->feedtime = $_SGLOBAL['timestamp'];
                                        $animal[animalfood] -= $needfood; 
                                        $hungry = 0;
                                	}else{
                                        $value->feedtime += $animal[animalfood] * 4 / $animaltype[$value->cId][consum] * 3600;
                                        $hungry = 1;
                                        $animal[animalfood] = 0; 
                                	}
                                	//*********************************************
												$needfood += $animaltype[$value->cId][consum];
												if ( $value->postTime == 0 )
												{
																$time = $_SGLOBAL['timestamp'] - $value->buyTime;
																if ( $animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time )
																{
																				$status = 3;
																				$growTimeNext = 12993;
																				$statusNext = 6;
																}
																if ( $animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] + $animaltime[$value->cId][1] )
																{
																				$status = 2;
																				$growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
																				$statusNext = 3;
																}
																if ( $time < $animaltime[$value->cId][0] )
																{
																				$status = 1;
																				$growTimeNext = $animaltime[$value->cId][0] - $time;
																				$statusNext = 2;
																}
																if ( $animaltime[$value->cId][5] < $time )
																{
																				$status = 6;
																				$growTimeNext = 0;
																				$statusNext = 6;
																}
																$newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$value->totalCome."}";
												}
												else
												{
																$totalCome = $value->totalCome;
																$time = $_SGLOBAL['timestamp'] - $value->buyTime;
																if ( $animaltime[$value->cId][5] < $time )
																{
																				$status = 6;
																				$statusNext = 6;
																				$growTimeNext = 0;
																}
																if ( $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime )
																{
																				$status = 3;
																				$statusNext = 6;
																				$growTimeNext = 12993;
																}
																if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4] )
																{
																				$status = 5;
																				$statusNext = 3;
																				$growTimeNext = $animaltime[$value->cId][4] - ( $_SGLOBAL['timestamp'] - $value->postTime );
																}
																if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3] )
																{
																				$status = 4;
																				$statusNext = 5;
																				$growTimeNext = $animaltime[$value->cId][3] - ( $_SGLOBAL['timestamp'] - $value->postTime );
																				$totalCome -= $animaltype[$value->cId][output];
																}
																if ( $value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] - $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] )
																{
																				$status = 5;
																				$statusNext = 6;
																				$growTimeNext = $animaltime[$value->cId][5] - $time;
																}
																$newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$totalCome."}";
												}
								}
				}
				$newanimal = json_encode( $newanimal );
				$newanimal = str_replace( "\"{", "{", $newanimal );
				$newanimal = str_replace( "}\"", "}", $newanimal );
				$newanimal = str_replace( "null", "[]", $newanimal );
				$stranimal = json_encode( $animal );
				$animal[animalfood] = ceil( $animal[animalfood] );
				$addExp=0;
				if($_POST['uId']!=$_SGLOBAL['supe_uid']){
					$addExp=floor($GLOBALS['_REQUEST']['foodnum']/10);
				}
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."' where uid=".intval( $_REQUEST['uId'] ) );
				$fruit = json_encode( $fruit );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set fruit='".$fruit."' where uid=".$_SGLOBAL['supe_uid'] );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+".$addExp." where uid=".$_SGLOBAL['supe_uid'] );
				//包内加草日志
				if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
					$sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
						intval($_REQUEST['uId']) . " AND type = 3 AND time > " . ($_SGLOBAL['timestamp'] -
						3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
					$query = $_SGLOBAL['db']->query($sql);
					while ($value = $_SGLOBAL['db']->fetch_array($query)) {
						if (($value[type] == 3) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['foodnum'] >
							0)) {
							// && ($value[iid]) && ($value[count])
							$scount = $value[count];
							$stime = $value[time];
							$scount = $scount + $_REQUEST['foodnum'];
							$sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set count ='" . $scount .
								"', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
								" AND type = 3 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
								$_SGLOBAL['supe_uid'];
						}
					}
					if ((!$sql1) && ($_REQUEST['foodnum'] > 0)) {
						$sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
							" (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
							$_REQUEST['uId'] . ", 3," . $_REQUEST['foodnum'] . ", " . $_SGLOBAL['supe_uid'] .
							", " . $_SGLOBAL['timestamp'] . ", 40, 0, 0);";
					}
					$query = $_SGLOBAL['db']->query($sql1);
				}
				//包内加草日志

				echo stripslashes( "{\"addExp\":".$addExp.",\"added\":".$_REQUEST['foodnum'].",\"animal\":".$newanimal.",\"alert\":\"\\\\u6210\\\\u529F\\\\u6DFB\\\\u52A0".$_REQUEST['foodnum']."\\\\u68F5\\\\u7267\\\\u8349\",\"money\":0,\"total\":".$animal[animalfood].",\"type\":0,\"uId\":".intval( $_REQUEST['uId'] )."}" );
				exit( );
			}
		}
		if ( $_REQUEST['type'] == "1" )
	{
                $mc_price = 60;
				$mc_id = 40;
                $money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$_SGLOBAL['supe_uid'] ), 0 );
                if ( $money < $mc_price * $_REQUEST['foodnum'] ){
                        echo "{\"errorContent\":\"\\u4F60\\u7684\\u91D1\\u5E01\\u4E0D\\u8DB3\\uFF0C\\u8D2D\\u4E70".$_REQUEST['foodnum']."\\u68F5\\u7267\\u8349\\uFF0C\\u5171\\u9700\\u8981".($mc_price * $_REQUEST['foodnum'])."\\u4E2A\\u91D1\\u5E01\\u3002\",\"errorType\":\"1011\"}";
			exit();
                }
                $fruit->$mc_id = $fruit->$mc_id + $_POST['foodnum'];
                $fruit = json_encode( $fruit );
                $money = $money - ($mc_price * $_REQUEST['foodnum']);
				$query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_SGLOBAL['supe_uid'] ) );
                while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
                {
                        $list[] = $value;
                }
                $animal = ( array )json_decode( $list[0]['Status'] );
				$animal[animalfood] = $animal[animalfood] + $_REQUEST['foodnum'];
				$fruit->$mucaoid = $fruit->$mucaoid - $GLOBALS['_REQUEST']['foodnum'];
				$needfood = 0;
				$hungry=0;
                foreach ( $animal['animal'] as $key => $value )
                {
                    if ( 0 < $value->cId ) {
						//*********************************************
                        $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                        if($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]){
							$value_feedtime = $animaltime[$value->cId][5];
						} else {
							$value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
						}
						if($_SGLOBAL['timestamp'] - $value->feedtime > 3600*12){
							$value_feedtime = 3600*12;
						}
                        $needfood = $value_feedtime / 3600 * $animaltype[$value->cId][consum] / 4;
                        if( $needfood <= $animal[animalfood] ){
                              $value->feedtime = $_SGLOBAL['timestamp'];
                              $animal[animalfood] -= $needfood; 
                              $hungry = 0;
                         }else{
                             $value->feedtime += $animal[animalfood] * 4 / $animaltype[$value->cId][consum] * 3600;
                             $hungry = 1;
                             $animal[animalfood] = 0; 
                         }
                        //*********************************************
                        if ( $value->postTime == 0 )
                        {
                                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                                if ( $animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time )
                                {
                                        $status = 3;
                                        $growTimeNext = 12993;
                                        $statusNext = 6;
                                }
                                if ( $animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] + $animaltime[$value->cId][1] )
                                {
                                        $status = 2;
                                        $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                                        $statusNext = 3;
                                }
                                if ( $time < $animaltime[$value->cId][0] )
                                {
                                        $status = 1;
                                        $growTimeNext = $animaltime[$value->cId][0] - $time;
                                        $statusNext = 2;
                                }
                                if ( $animaltime[$value->cId][5] < $time )
                                {
                                        $status = 6;
                                        $growTimeNext = 0;
                                        $statusNext = 6;
                                }
                                $newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$value->totalCome."}";
                        }
                        else
                        {
                                $totalCome = $value->totalCome;
                                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                                if ( $animaltime[$value->cId][5] < $time )
                                {
                                        $status = 6;
                                        $statusNext = 6;
                                        $growTimeNext = 0;
                                }
                                if ( $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime )
                                {
                                        $status = 3;
                                        $statusNext = 6;
                                        $growTimeNext = 12993;
                                }
                                if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4] )
                                {
                                        $status = 5;
                                        $statusNext = 3;
                                        $growTimeNext = $animaltime[$value->cId][4] - ( $_SGLOBAL['timestamp'] - $value->postTime );
                                }
                                if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3] )
                                {
                                        $status = 4;
                                        $statusNext = 5;
                                        $growTimeNext = $animaltime[$value->cId][3] - ( $_SGLOBAL['timestamp'] - $value->postTime );
                                        $totalCome -= $animaltype[$value->cId][output];
                                }
                                if ( $value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] - $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] )
                                {
                                        $status = 5;
                                        $statusNext = 6;
                                        $growTimeNext = $animaltime[$value->cId][5] - $time;
                                }
                                $newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$totalCome."}";
                        }
                    }
                }
                $newanimal = json_encode( $newanimal );
                $newanimal = str_replace( "\"{", "{", $newanimal );
                $newanimal = str_replace( "}\"", "}", $newanimal );
                $newanimal = str_replace( "null", "[]", $newanimal );
				$stranimal = json_encode( $animal );
				$animal[animalfood] = ceil( $animal[animalfood] );
				$_SGLOBAL['db']->query("UPDATE ".tname( "happyfarm_config" )." set money=".$money." where uid=".$_SGLOBAL['supe_uid'] );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."' where uid=".$_SGLOBAL['supe_uid'] );
				//给自己买草日志
				$sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
					intval($_SGLOBAL['supe_uid']) . " AND type = 4 AND time > " . ($_SGLOBAL['timestamp'] -
					3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
				$query = $_SGLOBAL['db']->query($sql);
				while ($value = $_SGLOBAL['db']->fetch_array($query)) {
					if (($value[type] == 4) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['foodnum'] >
						0)) {
						// && ($value[iid]) && ($value[count])
						$money = $value[money];
						$scount = $value[count];
						$stime = $value[time];
						$money = $money + ($mc_price * $_REQUEST['foodnum']);
						$scount = $scount + $_REQUEST['foodnum'];
						$sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set money = '" . $money .
							"', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
							", isread = 0 where uid = " . intval($_SGLOBAL['supe_uid']) .
							" AND type = 4 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
							$_SGLOBAL['supe_uid'];
					}
				}
				if ((!$sql1) && ($_REQUEST['foodnum'] > 0)) {
					$sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
						" (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
						$_SGLOBAL['supe_uid'] . ", 4," . $_REQUEST['foodnum'] . ", " . $_SGLOBAL['supe_uid'] .
						", " . $_SGLOBAL['timestamp'] . ", 40, 0, " . ($mc_price * $_REQUEST['foodnum']) .
						");";
				}
				$query = $_SGLOBAL['db']->query($sql1);
				//给自己买草日志
		echo stripslashes("{\"addExp\":0,\"added\":".$_REQUEST['foodnum'].",\"animal\":".$newanimal.",\"alert\":\"\\\\u6210\\\\u529f\\\\u8d2d\\\\u4e70".$_REQUEST['foodnum']."\\\\u68f5\\\\u7267\\\\u8349\\\\uff0c\\\\u5171\\\\u82b1\\\\u8d39\\\\u91d1\\\\u5e01".($mc_price * $_REQUEST['foodnum'])."\\\\uff0c\\\\u5df2\\\\u653e\\\\u5165\\\\u60a8\\\\u7684\\\\u9972\\\\u6599\\\\u673A\\\\u5185\\\\u3002\",\"money\":".($mc_price * $_REQUEST['foodnum']).",\"total\":".$animal[animalfood].",\"type\":1,\"uId\":".intval( $_SGLOBAL['supe_uid'] )."}");
                exit();
        }
		if ( $_REQUEST['type'] == "2" )
	{
                $mc_price = 60;
                $money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$_SGLOBAL['supe_uid'] ), 0 );
                if ( $money < $mc_price * $_REQUEST['foodnum'] ){
                        echo "{\"errorContent\":\"\\u4F60\\u7684\\u91D1\\u5E01\\u4E0D\\u8DB3\\uFF0C\\u8D2D\\u4E70".$_REQUEST['foodnum']."\\u68F5\\u7267\\u8349\\uFF0C\\u5171\\u9700\\u8981".($mc_price * $_REQUEST['foodnum'])."\\u4E2A\\u91D1\\u5E01\\u3002\",\"errorType\":\"1011\"}";
			exit();
                }
                $money = $money - ($mc_price * $_REQUEST['foodnum']);
				$query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) );
                while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
                {
                        $list[] = $value;
                }
                $animal = ( array )json_decode( $list[0]['Status'] );
				if ( $animal[animalfood] >= 200 ){
					echo "{\"errorContent\":\"\\u5927\\u54E5\\uFF5E\\u5DF2\\u7ECF\\u52A0\\u5230\\u4E0A\\u9650\\u4E86\\uFF0C\\u6709\\u591A\\u7684\\u8349\\u7ED9\\u522B\\u7684\\u670B\\u53CB\\u52A0\\u70B9\\u5427\\u2026\\u2026\",\"errorType\":\"1011\"}";
					exit();
				}
				$animal[animalfood] = $animal[animalfood] + $_REQUEST['foodnum'];
				$needfood = 0;
				$hungry=0;
                foreach ( $animal['animal'] as $key => $value )
                {
                    if ( 0 < $value->cId ) {
						//*********************************************
                        $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                        if($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]){
							$value_feedtime = $animaltime[$value->cId][5];
						} else {
							$value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
						}
						if($_SGLOBAL['timestamp'] - $value->feedtime > 3600*12){
							$value_feedtime = 3600*12;
						}
                        $needfood = $value_feedtime / 3600 * $animaltype[$value->cId][consum] / 4;
                        if( $needfood <= $animal[animalfood] ){
                              $value->feedtime = $_SGLOBAL['timestamp'];
                              $animal[animalfood] -= $needfood; 
                              $hungry = 0;
                         }else{
                             $value->feedtime += $animal[animalfood] * 4 / $animaltype[$value->cId][consum] * 3600;
                             $hungry = 1;
                             $animal[animalfood] = 0; 
                         }
                        //*********************************************
                        if ( $value->postTime == 0 )
                        {
                                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                                if ( $animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time )
                                {
                                        $status = 3;
                                        $growTimeNext = 12993;
                                        $statusNext = 6;
                                }
                                if ( $animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] + $animaltime[$value->cId][1] )
                                {
                                        $status = 2;
                                        $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                                        $statusNext = 3;
                                }
                                if ( $time < $animaltime[$value->cId][0] )
                                {
                                        $status = 1;
                                        $growTimeNext = $animaltime[$value->cId][0] - $time;
                                        $statusNext = 2;
                                }
                                if ( $animaltime[$value->cId][5] < $time )
                                {
                                        $status = 6;
                                        $growTimeNext = 0;
                                        $statusNext = 6;
                                }
                                $newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$value->totalCome."}";
                        }
                        else
                        {
                                $totalCome = $value->totalCome;
                                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                                if ( $animaltime[$value->cId][5] < $time )
                                {
                                        $status = 6;
                                        $statusNext = 6;
                                        $growTimeNext = 0;
                                }
                                if ( $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime )
                                {
                                        $status = 3;
                                        $statusNext = 6;
                                        $growTimeNext = 12993;
                                }
                                if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4] )
                                {
                                        $status = 5;
                                        $statusNext = 3;
                                        $growTimeNext = $animaltime[$value->cId][4] - ( $_SGLOBAL['timestamp'] - $value->postTime );
                                }
                                if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3] )
                                {
                                        $status = 4;
                                        $statusNext = 5;
                                        $growTimeNext = $animaltime[$value->cId][3] - ( $_SGLOBAL['timestamp'] - $value->postTime );
                                        $totalCome -= $animaltype[$value->cId][output];
                                }
                                if ( $value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] - $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] )
                                {
                                        $status = 5;
                                        $statusNext = 6;
                                        $growTimeNext = $animaltime[$value->cId][5] - $time;
                                }
                                $newanimal[] = "{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":".$hungry.",\"serial\":".$key.",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$totalCome."}";
                        }
                    }
                }
                $newanimal = json_encode( $newanimal );
                $newanimal = str_replace( "\"{", "{", $newanimal );
                $newanimal = str_replace( "}\"", "}", $newanimal );
                $newanimal = str_replace( "null", "[]", $newanimal );
				$stranimal = json_encode( $animal );
				$addExp=0;
				if($_POST['uId']!=$_SGLOBAL['supe_uid']){
					$addExp=floor($GLOBALS['_REQUEST']['foodnum']/10);
				}
				$_SGLOBAL['db']->query("UPDATE ".tname( "happyfarm_config" )." set money=".$money." where uid=".$_SGLOBAL['supe_uid'] );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."' where uid=".intval( $_REQUEST['uId'] ) );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+".$addExp." where uid=".$_SGLOBAL['supe_uid'] );
				//给好友买草日志
					if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
					$sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
						intval($_REQUEST['uId']) . " AND type = 5 AND time > " . ($_SGLOBAL['timestamp'] -
						3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
					$query = $_SGLOBAL['db']->query($sql);
					while ($value = $_SGLOBAL['db']->fetch_array($query)) {
						if (($value[type] == 5) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['foodnum'] >
							0)) {
							// && ($value[iid]) && ($value[count])
							$money = $value[money];
							$scount = $value[count];
							$stime = $value[time];
							$money = $money + ($mc_price * $_REQUEST['foodnum']);
							$scount = $scount + $_REQUEST['foodnum'];
							$sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set money = '" . $money .
								"', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
								", isread = 0 where uid = " . intval($_REQUEST['uId']) .
								" AND type = 5 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
								$_SGLOBAL['supe_uid'];
						}
					}
					if ((!$sql1) && ($_REQUEST['foodnum'] > 0)) {
						$sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
							" (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
							$_REQUEST['uId'] . ", 5," . $_REQUEST['foodnum'] . ", " . $_SGLOBAL['supe_uid'] .
							", " . $_SGLOBAL['timestamp'] . ", 40, 0, " . ($mc_price * $_REQUEST['foodnum']) .
							");";
					}
					$query = $_SGLOBAL['db']->query($sql1);
				   } //给好友买草日志
		echo stripslashes("{\"addExp\":".$addExp.",\"added\":".$_REQUEST['foodnum'].",\"animal\":".$newanimal.",\"alert\":\"\\\\u6210\\\\u529f\\\\u8d2d\\\\u4e70".$_REQUEST['foodnum']."\\\\u68f5\\\\u7267\\\\u8349\\\\uff0c\\\\u5171\\\\u82b1\\\\u8d39\\\\u91d1\\\\u5e01".($mc_price * $_REQUEST['foodnum'])."\\\\uff0c\\\\u5df2\\\\u653e\\\\u5165\\\\u60a8\\\\u7684\\\\u9972\\\\u6599\\\\u673A\\\\u5185\\\\u3002\",\"money\":".($mc_price * $_REQUEST['foodnum']).",\"total\":".$animal[animalfood].",\"type\":2,\"uId\":".intval( $_REQUEST['uId'] )."}");
                exit();
        }
}//帮自己、好友加草

if ( $_REQUEST['mod'] == "cgi_harvest_product" ){//动物收成
				if ( $_REQUEST['harvesttype'] == "1" )
				{
								$query = $_SGLOBAL['db']->query( "SELECT Status,package FROM ".tname( "happyfarm_mc" )." where uid=".$UID );
								while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
								{
												$list[] = $value;
								}
								$animal = ( array )json_decode( $list[0][Status] );
								$totalCome = 0;
								$exp = 0;
								foreach ( $animal[animal] as $key => $value )
								{
									if ( $value->cId == $_REQUEST['type'] )
									{
										$totalCome += $value->totalCome;
										//成果
										$mc_repertory = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT repertory FROM ".tname( "happyfarm_mc" )." where uid=".intval( $UID) ), 0 );
										$mc_repertory = json_decode( $mc_repertory);
										$flag=false;
										foreach($mc_repertory ->r as $key=>$val){
        									if($_REQUEST['type'] == $val->cId){
               								$flag=true;
               								$mc_repertory->r[$key]->harvest=$mc_repertory->r[$key]->harvest+$value->totalCome;
        										}
											}
											if(!$flag){
        									$cName=$animalname[$_REQUEST['type']][name];
                                            $mc_repertory->r[] = "{\"cId\":".$_REQUEST['type'].",\"cName\":\"".$cName."\",\"harvest\":".$value->totalCome.",\"scrounge\":0}";
                                            }
                                			$mc_repertory = json_encode( $mc_repertory );
                                			$mc_repertory = str_replace( "\"{", "{", $mc_repertory );
                                			$mc_repertory = str_replace( "}\"", "}", $mc_repertory );
                                			$mc_repertory = str_replace( "\\u", "\\\\u", $mc_repertory );
											$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set repertory='".$mc_repertory."' where uid=".$UID );
											//成果
											$value->totalCome = 0;
											$value->tou = "";
											++$exp;
									}
								}
								if ( $totalCome == 0 )
								{
												exit( );
								}
								$animal = json_encode( $animal );
								$mc_package = json_decode( $list[0][package] );
								$mc_package->$_REQUEST['type'] = $mc_package->$_REQUEST['type'] + $totalCome;
								$mc_package = json_encode( $mc_package );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set repertory='".$mc_repertory."',Status='".$animal."',exp=exp+".$exp * $animalname[$_REQUEST['type']][exp].",package='".$mc_package."' where uid=".$UID );
								echo "{\"addExp\":".$exp * $animalname[$_REQUEST['type']][exp].",\"cId\":".$_REQUEST['type'].",\"code\":0,\"harvestnum\":".$totalCome.",\"msg\":\"success\",\"serial\":-1}";
								exit( );
				}
				if ( $_REQUEST['harvesttype'] == "2" )
				{
								$query = $_SGLOBAL['db']->query( "SELECT Status,package FROM ".tname( "happyfarm_mc" )." where uid=".$_SGLOBAL['supe_uid'] );
								while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
								{
												$list[] = $value;
								}
								$animal = ( array )json_decode( $list[0][Status] );
								if ( $_SGLOBAL['timestamp'] - $animal[animal][$_REQUEST['serial']]->buyTime < $animaltime[$animal[animal][$_REQUEST['serial']]->cId][5] ){
                        echo "{\"errorContent\":\"\\u8FD8\\u6CA1\\u5230\\u6536\\u83B7\\u65F6\\u95F4\\u5462\\uFF0C\\u8BF7\\u4E0D\\u8981\\u7740\\u6025\",\"errorType\":\"1011\"}";
                        exit( );
                } //防加速齿轮
								if ( ceil($animal[animalfood]) == 0 ){
                        		echo "{\"errorContent\":\"\\u7F3A\\u5C11\\u7267\\u8349\\u4E0D\\u80FD\\u6536\\u83B7\\uFF0C\\u5FEB\\u53BB\\u6DFB\\u52A0\",\"errorType\":\"1011\"}";
                       			 exit( );
                				}//生产期加1粒草即可操作的BUG修改
								$cid = "1".$animal[animal][$_REQUEST['serial']]->cId;
								$cid1 = $animal[animal][$_REQUEST['serial']]->cId;
								$animal[animal][$_REQUEST['serial']]->totalCome > 0 && exit("{\"errorContent\":\"\\u8BF7\\u5148\\u6536\\u83B7\\u526F\\u4EA7\\u54C1\\u201C".$animalname[$cid1][name]."\\u201D\",\"errorType\":\"1011\"}");
								$mc_package = json_decode( $list[0][package] );
								$mc_package->$cid = $mc_package->$cid + 1;
								$mc_package = json_encode( $mc_package );
								$animal[animal][$_REQUEST['serial']]->buyTime = 0;
								$animal[animal][$_REQUEST['serial']]->cId = 0;
								$animal[animal][$_REQUEST['serial']]->postTime = 0;
								$animal[animal][$_REQUEST['serial']]->totalCome = 0;
								$animal[animal][$_REQUEST['serial']]->tou = "";
								$animal = json_encode( $animal );

								//成果
								$mc_repertory = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT repertory FROM ".tname( "happyfarm_mc" )." where uid=".intval( $UID) ), 0 );
       				 			$mc_repertory = json_decode( $mc_repertory);
        						$flag=false;
        						foreach($mc_repertory ->r as $key=>$val){
        							if($cid == $val->cId){
        								$flag=true;
        								$mc_repertory->r[$key]->harvest=$mc_repertory->r[$key]->harvest+1;
        							}
        						}
        						if(!$flag){
       						 	$cName=$animalname[$cid][name];
        						$mc_repertory->r[] = "{\"cId\":".$cid.",\"cName\":\"".$cName."\",\"harvest\":1,\"scrounge\":0}";
        						}
        						$mc_repertory = json_encode( $mc_repertory );
     							$mc_repertory = str_replace( "\"{", "{", $mc_repertory );
    	 						$mc_repertory = str_replace( "}\"", "}", $mc_repertory );
     							$mc_repertory = str_replace( "\\u", "\\\\u", $mc_repertory );
     							$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set repertory='".$mc_repertory."',Status='".$animal."',exp=exp+".$animalname[$cid][exp].",package='".$mc_package."' where uid=".$UID );
								//成果
								echo "{\"addExp\":".$animalname[$cid][exp].",\"cId\":".$cid1.",\"code\":0,\"harvestnum\":0,\"msg\":\"success\",\"serial\":".$_REQUEST['serial']."}";
								exit( );
				}
}//动物收成

if ( $_REQUEST['mod'] == "cgi_up_task" ){//新手任务
				$taskid = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT taskid FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
				if ( $_REQUEST['act'] == "1" )
				{
								echo "{\"taskFlag\":1,\"taskId\":".$taskid."}";
								exit( );
				}
				if ( $taskid == 0 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+50 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+50,taskid=1 where uid=".$UID );
								echo "{\"addExp\":50,\"item\":[{\"num\":50,\"type\":7},{\"num\":50,\"type\":6}],\"money\":50,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F9750\\u4E2A\\u7ECF\\u9A8C\\u548C50\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":1}}";
				}
				if ( $taskid == 1 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+100 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=2 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":100,\"type\":6}],\"money\":100,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C100\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":2}}";
				}
				if ( $taskid == 2 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+150 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=3 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":150,\"type\":6}],\"money\":150,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C150\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":3}}";
				}
				if ( $taskid == 3 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+200 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=4 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":200,\"type\":6}],\"money\":200,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C200\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":4}}";
				}
				if ( $taskid == 4 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+250 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=5 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":250,\"type\":6}],\"money\":250,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C250\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":5}}";
				}
				if ( $taskid == 5 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+300 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=6 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":300,\"type\":6}],\"money\":300,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C300\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":6}}";
				}
				if ( $taskid == 6 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+350 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=7 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":350,\"type\":6}],\"money\":350,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C350\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":7}}";
				}
				if ( $taskid == 7 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+400 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=8 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":400,\"type\":6}],\"money\":400,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C400\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":8}}";
				}
				if ( $taskid == 8 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+450 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=9 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":450,\"type\":6}],\"money\":450,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C450\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":9}}";
				}
				if ( $taskid == 9 )
				{
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+500 where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+100,taskid=10 where uid=".$UID );
								echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":500,\"type\":6}],\"money\":500,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C500\\u4E2A\\u91D1\\u5E01\\uFF01\",\"taskFlag\":1,\"taskId\":10}}";
				}
}//新手任务

if ( $_REQUEST['mod'] == "cgi_up_animalhouse" ){//升级房子

				if ( $_REQUEST['act'] == "query" )
				{
								if ( $_REQUEST['type'] == "1" )
								{
												switch ( $_REQUEST['level']  )
												{
												case 0 :
																echo "{\"level\":0,\"money\":0}";
																break;
												case 1 :
																echo "{\"level\":1,\"money\":3000}";
																break;
												case 2 :
																echo "{\"level\":4,\"money\":20000}";
																break;
												case 3 :
																echo "{\"level\":8,\"money\":60000}";
																break;
												case 4 :
																echo "{\"level\":12,\"money\":120000}";
																break;
												case 5 :
																echo "{\"level\":16,\"money\":210000}";
																break;
												case 6 :
																echo "{\"level\":20,\"money\":300000}";
																break;
												case 7 :
																echo "{\"level\":24,\"money\":400000}";
												}
								}
								else
								{
												switch ( $_REQUEST['level']  )
												{
												case 0 :
																echo "{\"level\":2,\"money\":5000}";
																break;
												case 1 :
																echo "{\"level\":6,\"money\":40000}";
																break;
												case 2 :
																echo "{\"level\":10,\"money\":90000}";
																break;
												case 3 :
																echo "{\"level\":14,\"money\":160000}";
																break;
												case 4 :
																echo "{\"level\":18,\"money\":250000}";
																break;
												case 5 :
																echo "{\"level\":22,\"money\":350000}";
																break;
												case 6 :
																echo "{\"level\":26,\"money\":500000}";
																break;
												case 7 :
																echo "{\"level\":28,\"money\":700000}";
												}
								}
				}
				else
				{
							    $money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$UID ), 0 );
								$query = $_SGLOBAL['db']->query( "SELECT Status,exp FROM ".tname( "happyfarm_mc" )." where uid=".$UID );
								while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
								{
												$list[] = $value;
								}
								$animal = ( array )json_decode( $list[0][Status] );
								$exp = $list[0][exp];
								if ( $_REQUEST['type'] == "1" )
								{
												$item = "item2";
												$itemarr = array( "1" => 0, "2" => 3000, "3" => 20000, "4" => 60000, "5" => 120000, "6" => 210000, "7" => 300000, "8" => 400000 );
												$levelarr = array( "1" => 0, "2" => 1, "3" => 4, "4" => 8, "5" => 12, "6" => 16, "7" => 20, "8" => 24 );
								}
								else
								{
												$item = "item3";
												$itemarr = array( "1" => 5000, "2" => 40000, "3" => 90000, "4" => 160000, "5" => 250000, "6" => 350000, "7" => 500000, "8" => 700000 );
												$levelarr = array( "1" => 2, "2" => 6, "3" => 10, "4" => 14, "5" => 18, "6" => 22, "7" => 26, "8" => 28 );
								}
								$animal[$item] = $animal[$item] + 1;
								if ( $money < $itemarr[$animal[$item]] || $animal[$item] > 8 || getLevel($exp)<$levelarr[$animal[$item]])
								{
									echo "{\"errorContent\":\"\\u8BF7\\u4E0D\\u8981\\u91C7\\u7528\\u975E\\u6CD5\\u624B\\u6BB5\\uFF01\",\"errorType\":\"1011\"}";
												exit( );
								}
								$money = $money - $itemarr[$animal[$item]];
								$money1 = $itemarr[$animal[$item]];
								$srtanimal = json_encode( $animal );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=".$money." where uid=".$UID );
								$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$srtanimal."' where uid=".$UID );
								$animal[item2] = "\"2\":{\"id\":102,\"lv\":".$animal[item2]."},";
								if ( $animal[item3] == 0 )
								{
												$animal[item3] = "";
								}
								else
								{
												$animal[item3] = "\"3\":{\"id\":103,\"lv\":".$animal[item3]."},";
								}
								echo "{\"1\":{\"id\":101,\"lv\":".$animal[item1]."},".$animal[item2].$animal[item3]."\"4\":{\"id\":104,\"lv\":".$animal[item4]."},\"code\":1,\"money\":-".$money1."}";
				}
}//升级房子

if ( $_REQUEST['mod'] == "cgi_sale_product" ){
	$package = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT package FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
	$package = json_decode( $package );

	if ( $_REQUEST['saleAll'] == "1" )
	{
		$money = 0;
		foreach ( $package as $key => $value )
		{
		if ( 0 < $value )
												{
																$money += $animalname[$key][price] * $value;
																$package->$key = 0;
												}
												unset($package->$key);
		}
		$package = json_encode( $package );

		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+".$money." where uid=".$UID );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set package='".$package."' where uid=".$UID );
		echo "{\"direction\":\"\\u64CD\\u4F5C\\u6210\\u529F\\uFF0C\\u5171\\u83B7\\u5F97\\u6536\\u5165\\u548C\\u611F\\u8C22\\u91D1<font color=\\\"#FF6600\\\"> <b>".$money."</b> </font>\\u91D1\\u5E01\",\"money\":".$money."}";
	}
	else
	{
		
								if ( $package->$_REQUEST['cId'] < $_REQUEST['num'] )
								{
												exit( );
								}
								$money = 0;
								$money = $animalname[$_REQUEST['cId']][price] * $_REQUEST['num'];
								$package->$_REQUEST['cId'] = $package->$_REQUEST['cId'] - $_REQUEST['num'];
								foreach($package as $key => $value){
										if($value == 0){unset($package->$key);}
								}
								$package = json_encode( $package );

		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set money=money+".$money." where uid=".$UID );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set package='".$package."' where uid=".$UID );
		echo "{\"cId\":".$_REQUEST['cId'].",\"direction\":\"\\u6210\\u529F\\u5356\\u51FA<font color=\\\"#0099FF\\\"> <b>".$_REQUEST['num']."</b> </font>\\u4E2A".$animalname[$_REQUEST['cId']][name]."\\uFF0C\\u8D5A\\u5230\\u91D1\\u5E01<font color=\\\"#FF6600\\\"> <b>".$money."</b> </font>\",\"money\":".$money."}";
	}
}

if ( $_REQUEST['mod'] == "cgi_demolish_pasture" ){//放蚊子
	$badnum = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT badnum FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );

	if ( $badnum > 24 )//此处输出使坏次数已满提示
	{
		echo "{\"errorContent\":\"\\u6BCF\\u5929\\u6700\\u591A\\u4F7F\\u574F25\\u6B21\",\"errorType\":-2005}" ;
	}
	if ( $_REQUEST['num'] + $badnum > 25)
	{
		$GLOBALS['_REQUEST']['num'] = floor( 25 - floor($badnum) );
	}	
	else
	{
		$badnum = 0;
		$bad = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT bad FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) ), 0 );

		if ( $bad != "" )
		{
			$wenzi = explode(",",$bad);
			$badnum = count($wenzi);
		}
		if ( (intval( $_REQUEST['num'] )+ $badnum) < 9 )
		{
			$num=intval( $_REQUEST['num']);
		}
		else
		{
			$num = 8-$badnum;        
		}
		for ($i=0;$i<$num;$i++)
		{
			if($bad=="")
			{
				$bad=$UID;
			}
			else
			{
				$bad=$bad.",".$UID;
			}
		}

		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set bad = '".$bad."',badtime = ".$_SGLOBAL['timestamp']." where uid=".intval( $_REQUEST['uId'] ) );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set badnum = badnum+'".$num."' where uid=".$UID );
		//放蚊子日志
		$sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
			intval($_REQUEST['uId']) . " AND type = 6 AND time > " . ($_SGLOBAL['timestamp'] -
			3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
		$query = $_SGLOBAL['db']->query($sql);
		while ($value = $_SGLOBAL['db']->fetch_array($query)) {
			if (($value[type] == 6) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($num >
				0)) {
				$scount = $value[count];
				$stime = $value[time];
				$scount = $scount + $num;
				$sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set count ='" . $scount .
					"', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
					" AND type = 6 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
					$_SGLOBAL['supe_uid'];
			}
		}
		if ((!$sql1) && ($num > 0)) {
			$sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
				" (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
				$_REQUEST['uId'] . ", 6," . $num . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
				", 0, 0, 0);";
		}
		$query = $_SGLOBAL['db']->query($sql1);
		//放蚊子日志
		echo "{\"cId\":1,\"leftnum\":11,\"num\":".$num.",\"total\":".($badnum + $num)."}"  ;
	}
	exit ();
}//放蚊子

if ( $_REQUEST['mod'] == "cgi_help_pasture" ){//拍蚊子和扫便便
	if($_REQUEST['type']==1){
		 $query = $_SGLOBAL['db']->query( "SELECT exp,bad FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}

	if ($list[0][bad] == "")
	{

		exit ();
	}
	else
	{
		$wenzi = explode(",",$list[0][bad]);
		$bad_num = count ($wenzi);
		$pasture = 0 ;
		$number = $_REQUEST["num"];
		if ( $number > $bad_num )
		{
			$number = $bad_num;
		}
		for ($i=0 ; $i < $bad_num ; $i++)
		{
			if ($wenzi[$i] != $UID && $pasture != $number)
			{
				unset($wenzi[$i]);
				$pasture = $pasture + 1;
			}
			else
			{
				$bad_all = $bad_all.$wenzi[$i];
				if ($i < $bad_num -1 )
				{
					$bad_all = $bad_all.",";
				}
			}
		}
		$number = $pasture;
    	}

	$int = strlen($bad_all);
	if ( $int == 0 )
	{
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set badtime=0 where uid=".intval( $_REQUEST['uId'] ) );
	}
	else
	{
		$str = substr( $bad_all, $int-1, 1 ); 
		if ( $str == "," )
		{
			$bad_all = substr( $bad_all, 0, $int-1 ); 
		}
	}
	$exp = 3 * $number;
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set bad='".$bad_all."' where uid=".intval( $_REQUEST['uId'] ) );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp = exp + $exp where uid=".$UID );
    //拍蚊子日志
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
            $sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
                intval($_REQUEST['uId']) . " AND type = 7 AND time > " . ($_SGLOBAL['timestamp'] -
                3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
            $query = $_SGLOBAL['db']->query($sql);
            while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                if (($value[type] == 7) && ($value[fromid] == $_SGLOBAL['supe_uid'])) {
                    $scount = $value[count];
                    $stime = $value[time];
                    $scount = $scount + 1;
                    $sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set count ='" . $scount .
                        "', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                        " AND type = 7 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                        $_SGLOBAL['supe_uid'];
                }
            }
            if ((!$sql1)) {
                $sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
                    " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                    $_REQUEST['uId'] . ", 7,1, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0, 0);";
            }
            $query = $_SGLOBAL['db']->query($sql1);
        } //拍蚊子日志
	echo "{\"addExp\":".$exp.",\"cId\":1,\"num\":".$number.",\"pos\":".$_REQUEST['pos']."}";

	}

	if($_REQUEST['type']==2){
		$cId="1506";
		 $bb = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT dabian FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) ), 0 );
		$mc_package = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT package FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
		$mc_package = json_decode( $mc_package );
		if($bb<=0){
			echo "{\"errorContent\":\"\\u60A8\\u4E0B\\u624B\\u592A\\u6162\\uFF0C\\u4FBF\\u4FBF\\u5DF2\\u7ECF\\u88AB\\u6E05\\u7406\\u4E86\",\"errorType\":\"1004\"}";
			exit();
		}
		//便便成果
		$mc_repertory = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT repertory FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
		$mc_repertory = json_decode( $mc_repertory);
		$flag=false;
		foreach($mc_repertory ->r as $key=>$val){
        if(1506 == $val->cId){
                $flag=true;
                $mc_repertory->r[$key]->harvest=$mc_repertory->r[$key]->harvest+1;
        }
   }                                                                                                                                                        
   if(!$flag){
          $mc_repertory->r[] = "{\"cId\":1506,\"cName\":\"\\u4FBF\\u4FBF\",\"harvest\":1,\"scrounge\":0}";
                                                                                                                                                                }
     $mc_repertory = json_encode( $mc_repertory );
     $mc_repertory = str_replace( "\"{", "{", $mc_repertory );
     $mc_repertory = str_replace( "}\"", "}", $mc_repertory );
     $mc_repertory = str_replace( "\\u", "\\\\u", $mc_repertory );
     $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set repertory='".$mc_repertory."' where uid=".$UID );
//便便成果
		$bb=$bb-1;
		$mc_package->$cId = $mc_package->$cId +1;
		$mc_package = json_encode( $mc_package );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set dabian=".$bb."  where uid=".intval( $_REQUEST['uId'] ) );
		$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set package='".$mc_package."' where uid=".$UID );
        //帮忙扫便日志
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
            $sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
                intval($_REQUEST['uId']) . " AND type = 8 AND time > " . ($_SGLOBAL['timestamp'] -
                3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
            $query = $_SGLOBAL['db']->query($sql);
            while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                if (($value[type] == 8) && ($value[fromid] == $_SGLOBAL['supe_uid'])) {
                    $scount = $value[count];
                    $stime = $value[time];
                    $scount = $scount + 1;
                    $sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set count ='" . $scount .
                        "', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                        " AND type = 8 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                        $_SGLOBAL['supe_uid'];
                }
            }
            if ((!$sql1)) {
                $sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
                    " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                    $_REQUEST['uId'] . ", 8,1, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0, 0);";
            }
            $query = $_SGLOBAL['db']->query($sql1);
        } //帮忙扫便日志
		echo "{\"num\":1,\"pos\":".$_REQUEST['pos'].",\"repNum\":1,\"type\":2}";
	}
}//拍蚊子和扫便便

if ( $_REQUEST['mod'] == "cgi_get_Exp" ){//好友动作提示
	if ( !empty( $space[friend] ) )
	{
		$space[friend] = $space[friend].",";
	}
	$query = $_SGLOBAL['db']->query( "SELECT uid,Status,badtime,dabian FROM ".tname( "happyfarm_mc" )." WHERE uid IN (".$space[friend].$UID.")" );

	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$animal = ( array ) json_decode( $value[Status]);
		$exp[$value['uid']]["p"] = $value[badtime];
		$exp[$value['uid']]["b"] = $value[dabian];
		$exp[$value['uid']]["g"] = 0;
		$exp[$value['uid']]["t"] = 0;

		foreach ($animal[animal] as $key => $value_1 )
		{
			$cId = intval($value_1->cId);
			if ( $cId > 0 )
			{
				$time1 = $animaltime[$value_1->cId][0] + $animaltime[$value_1->cId][1];
				$time2 = $animaltime[$value_1->cId][2];
				$time3 = $_SGLOBAL['timestamp'] - $value_1->buyTime;
				$time4 = $_SGLOBAL['timestamp'] - $value_1->postTime; 

				if ( $time3 > $time1 && $time3 < $time2 )
				{
					if ( $time4 > $animaltime[$value_1->cId][4] or $value_1->postTime == 0 )
					{
						$temp = $value_1->buyTime + $time1;
						if ( $temp < $g or $g == 0 )
						{
							$exp[$value['uid']]["g"] = $temp;
						}
					}
				}
				if ( !stristr( $value_1->tou, ",".$UID.","))
				{
					if ( $value_1->totalCome > $animaltype[$cId][output]  / 2 )

					{
						$exp[$value['uid']]["t"] = $value_1->postTime ;
					}
				}
			}
		}
	}
	$exp = json_encode( $exp );
	$int = strlen($exp);
	$str = substr( $exp, $int-1, 1 ); 
	if ( $str == "," )
	{
		$exp = substr( $exp, 0, $int-1 ); 
	}
	echo "{\"msg\":\"success\",\"result\":0,\"serverTime\":".$_SGLOBAL['timestamp'].",\"userFlag\":".$exp."}";
	exit( );
}//好友动作提示

if ( $_REQUEST['mod'] == "cgi_post_product" ){//动物生产
				$needlog = 1;
				if ( $_REQUEST['uId'] == NULL )
				{
								$GLOBALS['_REQUEST']['uId'] = $_SGLOBAL['supe_uid'];
								$needlog = 0;
				}
				$GLOBALS['_REQUEST']['serial'] = intval( $_REQUEST['serial'] );
				$query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) );
				while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
				{
								$list[] = $value;
				}
				$animal = json_decode( $list[0][Status] );
				if ($animal->animalfood == 0) {
					echo "{\"errorContent\":\"\\u52A8\\u7269\\u6328\\u997F\\u5566\\uFF0C\\u7F3A\\u5C11\\u7267\\u8349\\u4F1A\\u505C\\u6B62\\u751F\\u4EA7\\uFF0C\\u5FEB\\u53BB\\u6DFB\\u52A0\",\"errorType\":\"1011\"}";
					exit();
				}
				if (($animal->animal[$_REQUEST['serial']]->postTime + 3600) > $_SGLOBAL['timestamp']) {
					echo "{\"errorContent\":\"\\u8BF7\\u4E0D\\u8981\\u91C7\\u7528\\u975E\\u6CD5\\u624B\\u6BB5\\uFF01\",\"errorType\":\"1011\"}";
					exit();
				}
				if ($animal->animal[$_REQUEST['serial']]->postTime == 0) 
				{
					$chk_time = $_SGLOBAL['timestamp'] - $animal->animal[$_REQUEST['serial']]->buyTime;
					if ($chk_time < $animaltime[$animal->animal[$_REQUEST['serial']]->cId][0] + $animaltime[$animal-> animal[$_REQUEST['serial']]->cId][1]) 
					{
						echo "{\"errorContent\":\"\\u8FD8\\u6CA1\\u5230\\u751F\\u4EA7\\u7684\\u65F6\\u95F4\\u5462\\uFF0C\\u8BF7\\u4E0D\\u8981\\u7740\\u6025\",\"errorType\":\"1011\"}";
						exit();
					}
				} else {
					if ($_SGLOBAL['timestamp'] - $animal->animal[$_REQUEST['serial']]->postTime < $shop[$animal->animal[$_REQUEST['serial']]->cId][4]) {
						echo "{\"errorContent\":\"\\u8FD8\\u6CA1\\u5230\\u751F\\u4EA7\\u7684\\u65F6\\u95F4\\u5462\\uFF0C\\u8BF7\\u4E0D\\u8981\\u7740\\u6025\",\"errorType\":\"1011\"}";
						exit();
					}
				} //防加速齿轮
				$animal->animal[$_REQUEST['serial']]->postTime = $_SGLOBAL['timestamp'];
				$animal->animal[$_REQUEST['serial']]->tou = "";
				$animal->animal[$_REQUEST['serial']]->totalCome = $animal->animal[$_REQUEST['serial']]->totalCome + $animaltype[$animal->animal[$_REQUEST['serial']]->cId][output];
				$stranimal = json_encode( $animal );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."' where uid=".intval( $_REQUEST['uId'] ) );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set exp=exp+5 where uid=".$_SGLOBAL['supe_uid'] );
				//帮产日志
				if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
					$sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
						intval($_REQUEST['uId']) . " AND type = 2 AND time > " . ($_SGLOBAL['timestamp'] -
						3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
					$query = $_SGLOBAL['db']->query($sql);
					while ($value = $_SGLOBAL['db']->fetch_array($query)) {
						if (($value[type] == 2) && ($value[fromid] == $_SGLOBAL['supe_uid'])) {
							// && ($value[iid]) && ($value[count])
							$list = explode(",", $value[iid]);
							$scount = explode(",", $value[count]);
							$stime = $value[time];
							$listo = "";
							$scounto = "";
							$flag = 0;
							for ($i = 0; $i < count($list); $i++) {
								if ($list[$i] == $animal->animal[$_REQUEST['serial']]->cId) {
									$flag = 1;
									$scount[$i] = $scount[$i] + 1;
								}
							}
							if ($flag == 0) {
								$list[count($list)] = $animal->animal[$_REQUEST['serial']]->cId;
								$scount[count($list)] = 1;
							}
							for ($i = 0; $i < (count($list)) - 1; $i++) {
								$listo = $listo . $list[$i] . ",";
								$scounto = $scounto . $scount[$i] . ",";
							}
							$listo = $listo . $list[count($list) - 1];
							$scounto = $scounto . $scount[count($list) - 1];
							$sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set iid = '" . $listo .
								"', count = '" . $scounto . "', time = " . $_SGLOBAL['timestamp'] .
								", isread = 0 where uid = " . intval($_REQUEST['uId']) .
								" AND type = 2 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
								$_SGLOBAL['supe_uid'];
						}
					}
					if (($listo == "") || ($scounto == "")) {
						$listo = $animal->animal[$_REQUEST['serial']]->cId;
						$scounto = 1;
					}
					if (!$sql1) {
						$sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
							" (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
							$_REQUEST['uId'] . ", 2, " . $scounto . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
							", " . $listo . ", 0, 0);";
					}
					$query = $_SGLOBAL['db']->query($sql1);
				}
				//帮产日志
				echo "{\"addExp\":5,\"animal\":{\"buyTime\":".$animal->animal[$_REQUEST['serial']]->buyTime.",\"cId\":".$animal->animal[$_REQUEST['serial']]->cId.",\"createTime\":0,\"feedTime\":".( $_SGLOBAL['timestamp'] - $animaltime[$animal->animal[$_REQUEST['serial']]->cId][0] ).",\"growTime\":".( $_SGLOBAL['timestamp'] - $animal->animal[$_REQUEST['serial']]->buyTime ).",\"growTimeNext\":".$animaltime[$animal->animal[$_REQUEST['serial']]->cId][3].",\"postTime\":".$_SGLOBAL['timestamp'].",\"productNum\":2,\"serial\":".$_REQUEST['serial'].",\"status\":4,\"statusNext\":5,\"totalCome\":".$animaltype[$animal->animal[$_REQUEST['serial']]->cId][output]."}}";
				exit( );
}//动物生产

if ( $_REQUEST['mod'] == "cgi_steal_product" ){//偷动物
	$query = $_SGLOBAL['db']->query( "SELECT Status FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$animal = ( array )json_decode( $list[0][Status] );
	$tounum = 0;
	foreach ( $animal[animal] as $key => $value )
	{
		if ( $_REQUEST['type'] == $value->cId )
		{
			if ( !stristr( $value->tou, ",".$UID."," ) )
			{
				if ( $animaltype[$_REQUEST['type']][output] / 2  < $value->totalCome )
				{
					$value->totalCome--;
					++$tounum;
					$value->tou = $value->tou.",".$UID.",";
					//成果
					$mc_repertory = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT repertory FROM ".tname( "happyfarm_mc" )." where uid=".intval( $UID) ), 0 );
                	$mc_repertory = json_decode( $mc_repertory);
					$flag=false;
                    foreach($mc_repertory ->r as $key=>$val){
                    if($_REQUEST['type'] == $val->cId){
                    $flag=true;
                     $mc_repertory->r[$key]->scrounge++;
                       }
                                                                                                                                                                        					}
      				if(!$flag){
                    $cName=$animalname[$_REQUEST['type']][name];
					$mc_repertory->r[] = "{\"cId\":".$_REQUEST['type'].",\"cName\":\"".$cName."\",\"harvest\":0,\"scrounge\":".$tounum."}";
				   }
        			$mc_repertory = json_encode( $mc_repertory );
         			$mc_repertory = str_replace( "\"{", "{", $mc_repertory );
					$mc_repertory = str_replace( "}\"", "}", $mc_repertory );
					$mc_repertory = str_replace( "\\u", "\\\\u", $mc_repertory );
					$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set repertory='".$mc_repertory."' where uid=".$UID );
					//成果
					
				}
			}
		}
	}
	
	$tounum == 0 && exit("{\"errorContent\":\"\\u4F60\\u6765\\u7684\\u4E5F\\u592A\\u665A\\u4E86\\u5427...\",\"errorType\":\"1011\"}");

	$package = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT package FROM ".tname( "happyfarm_mc" )." where uid=".$UID ), 0 );
	$package = json_decode( $package );
	$package->$_REQUEST['type'] = $package->$_REQUEST['type'] + $tounum;
	$animal = json_encode( $animal );
	$package = json_encode( $package );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$animal."' where uid=".intval( $_REQUEST['uId'] ) );
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set package='".$package."' where uid=".$UID );
    //偷日志
    $sql = "SELECT * FROM " . tname("happyfarm_mclogs") . " WHERE uid = " .
        intval($_REQUEST['uId']) . " AND type = 1 AND time > " . ($_SGLOBAL['timestamp'] -
        3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
    $query = $_SGLOBAL['db']->query($sql);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if (($value[type] == 1) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($tounum >
            0)) {
            // && ($value[iid]) && ($value[count])
            $list = $value[iid];
            $scount = $value[count];
            $stime = $value[time];
            $list = $list . "," . $_REQUEST['type'];
            $scount = $scount . "," . $tounum;
            $sql1 = "UPDATE " . tname("happyfarm_mclogs") . " set iid = '" . $list .
                "', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
                ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                " AND type = 1 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                $_SGLOBAL['supe_uid'];
        }
    }
    if ((!$sql1) && ($tounum > 0)) {
        $sql1 = "INSERT INTO " . tname("happyfarm_mclogs") .
            " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
            $_REQUEST['uId'] . ", 1," . $tounum . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
            ", " . $_REQUEST['type'] . ", 0, 0);";
    }
    $query = $_SGLOBAL['db']->query($sql1);
	//偷日志
	echo "{\"cId\":".$_REQUEST['type'].",\"harvestnum\":".$tounum."}";
	exit( );
}//偷动物

if ( $_REQUEST['mod'] == "cgi_get_user_info" || $_REQUEST['mod'] == "cgi_get_user_info?" ){//牧场日志
//1偷；2帮产；3背包加草；4自己买草；5帮好友买草；6放蚊；7拍蚊；8清理便便；9出售；10购买。
	$log_str = "";
	$money = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT money FROM ".tname( "happyfarm_config" )." where uid=".$_REQUEST['uId'] ), 0 );
	$query = $_SGLOBAL['db']->query( "SELECT exp FROM ".tname( "happyfarm_mc" )." where uid=".$_REQUEST['uId'] );
	$space_user = getspace($_REQUEST['uId']);
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
		if ( $space_user['name'] == "" )
	{
		$space_user['name'] = $space_user['username'];
	}
	
	$count1 = $count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname("happyfarm_mclogs")." WHERE uid = ".intval( $_REQUEST['uId'])),0);
	$sql = "SELECT * FROM ".tname("happyfarm_mclogs")." WHERE uid = ".intval( $_REQUEST['uId'])." ORDER BY time DESC limit 0,20";
	$query = $_SGLOBAL['db']->query( $sql );
	$str = "[";
	if ($count >20 ){ $count = 20;}
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) ){
		if ($value[type]==1){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]);
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$scrids = array();
			$scrids = explode(",",$value[iid]);
			$scrcots = array();
			$scrcots = explode(",",$value[count]);
			$scrougestr = "";
			for ($i=0;$i<count($scrids);$i++){
				$scrougestr = $scrougestr.$scrcots[$i].$animalname[$scrids[$i]][liangci].$animalname[$scrids[$i]][name];
				if ($i+1 < count($scrids)){
					$scrougestr = $scrougestr."\\uff0c";
				}else{
					$scrougestr = $scrougestr."\\u3002";
				}
			}
			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u6765\\u7267\\u573a\\u5077\\u8d70\\u4e86".$scrougestr."\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==2){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$helpids = array();
			$helpids = explode(",",$value[iid]);
			$helpcots = array();
			$helpcots = explode(",",$value[count]);
			$helpstr = "";

			for ($i=0;$i<count($helpids);$i++){
				$helpstr = $helpstr.$helpcots[$i].$animalname[10000+$helpids[$i]][liangci].$animalname[10000+$helpids[$i]][name]."\\u8d76\\u53bb".$animalname[10000+$helpids[$i]][act];
				if ($i+1 < count($helpids)){
					$helpstr = $helpstr."\\uff0c";
				}else{
					$helpstr = $helpstr."\\u3002";
				}
			}

			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u5e2e\\u5fd9\\u628a".$helpstr."\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==3){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u6765\\u7267\\u573A\\u4ECE\\u81EA\\u5DF1\\u5305\\u88F9\\u91CC\\u7684".$value[count]."\\u68F5\\u8349\\u6599\\u6DFB\\u52A0\\u5230\\u9972\\u6599\\u673A\\u5185\\u3002\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==4){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$msg = "\"\\u5171\\u82B1\\u4E86".$value[money]."\\u91D1\\u5E01\\u8D2D\\u4E70".$value[count]."\\u68F5\\u8349\\u6599\\u653E\\u5165\\u9972\\u6599\\u673A\\u5185\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==5){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u6765\\u7267\\u573A\\u5E2E\\u5FD9\\u5171\\u82B1\\u4E86".$value[money]."\\u91D1\\u5E01\\u8D2D\\u4E70".$value[count]."\\u68F5\\u8349\\u6599\\u653E\\u5165\\u9972\\u6599\\u673A\\u5185\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==6){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u6765\\u7267\\u573A\\u653E\\u4E86".$value[count]."\\u53EA\\u868A\\u5B50\\uFF0C\\u771F\\u4E0D\\u662F\\u597D\\u4EBA\\uFF01\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==7){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u6765\\u7267\\u573A\\u5E2E\\u5FD9\\u62CD\\u4E86".$value[count]."\\u53EA\\u868A\\u5B50\\uFF01\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==8){
			$query1 = $_SGLOBAL['db']->query( "SELECT uid,username,name FROM ".tname( "space" )." WHERE uid = ".$value[fromid]."");
			$value1 = $_SGLOBAL['db']->fetch_array( $query1 );
			if (!$value1['name']){
				$value1['name']=$value1['username'];
			}
			$msg = "\"<font color=\\\\\"#009900\\\\\"><b>".unicode_encode( $value1['name'])."<\\/b><\\/font> \\u6765\\u7267\\u573A\\u5E2E\\u5FD9\\u6E05\\u626B\\u4E86".$value[count]."\\u4E2A\\u4FBF\\u4FBF\\uFF01\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==9){
			$scrids = array();
			$scrids = explode(",",$value[iid]);
			$scrcots = array();
			$scrcots = explode(",",$value[count]);
			$scrougestr = "";
			for ($i=0;$i<count($scrids);$i++){
				$scrougestr = $scrougestr.$scrcots[$i].$animalname[$scrids[$i]][liangci].$animalname[$scrids[$i]][name];
				if ($i+1 < count($scrids)){
					$scrougestr = $scrougestr."\\uff0c";
				}else{
					$scrougestr = $scrougestr."\\uff0c";
				}
			}
			$msg = "\"\\u5356\\u51FA\\u4E86\\u4ED3\\u5E93\\u91CC\\u7684".$scrougestr."\\u5171\\u6536\\u5165".$value[money]."\\u91D1\\u5E01\\u3002\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if ($value[type]==10){
			$scrids = array();
			$scrids = explode(",",$value[iid]);
			$scrcots = array();
			$scrcots = explode(",",$value[count]);
			$scrougestr = "";
			for ($i=0;$i<count($scrids);$i++){
				$scrougestr = $scrougestr.$scrcots[$i].$animalname[$scrids[$i]][liangci].$animalname[$scrids[$i]][name];
				if ($i+1 < count($scrids)){
					$scrougestr = $scrougestr."\\uff0c";
				}else{
					$scrougestr = $scrougestr."\\uff0c";
				}
			}
			$msg = "\"\\u4ECE\\u5546\\u5E97\\u8D2D\\u4E70\\u4E86".$scrougestr."\\u5171\\u4ED8\\u51FA".$value[money]."\\u91D1\\u5E01\\u3002\"";
			$msg = str_replace( "\\u", "\\\\u",$msg);
			$str = $str."{\"domain\":2,\"msg\":".$msg.",\"time\":".$value['time']."}";
			$count--;
		}
		if (($count-1)>=0){
		$str = $str.",";
		}
	}
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mclogs" )." set isread=1 where uid=".$_SGLOBAL['supe_uid'] );
	$str = $str."]";

    //成果
		$tempecho="";
		$repertory = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT repertory FROM ".tname( "happyfarm_mc" )." where uid=".$_REQUEST['uId'] ), 0 );
		$repertory = json_decode( $repertory );
		$tempRep=$repertory->r;
		foreach($tempRep as $val){
					$tempecho=json_encode($val).",".$tempecho;
							  }
		$tempecho=substr($tempecho,0,-1);
		$tempecho = str_replace( "\\u", "\\\\u",$tempecho);
    
	//成果
    echo stripslashes("{\"log\":".$str.",\"repertory\":[".$tempecho."],\"user\":{\"homePage\":\"".str_ireplace( "happyfarm/", "space.php?uid=", $_SC['siteurl'] ).$_REQUEST['uId']."\",\"money\":".$money.",\"uExp\":".$list[0][exp].",\"uId\":".$_REQUEST['uId'].",\"uLevel\":".floor( sqrt( $list[0][exp] / 100 + 0.25 ) - 0.5 ).",\"uName\":\"".str_replace( "\\u", "\\\\u", unicode_encode( $space_user['name'] ) )."\"}}");
	$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set jb=0 where uid=".intval( $_REQUEST['uId'] ) );
}//牧场日志

if ( $_REQUEST['mod'] == "chat" && $_REQUEST['act'] == "getAllInfo" ){//牧场留言
	$tempecho="";
	$chat = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT Message FROM ".tname( "happyfarm_config" )." where uid=".intval( $_REQUEST['uId'] ) ), 0 );
	$chat = json_decode( $chat );
	$tempChat=$chat->c;
	foreach((array)$tempChat as $val)
	{
		$tempecho=json_encode($val).",".$tempecho;
	}
	$tempecho=substr($tempecho,0,-1);

	echo "{\"chat\":[".$tempecho."]}";
	exit( );
}//牧场留言

if ( $_REQUEST['mod'] == "chat" && $_REQUEST['act'] == "sendChat" ){//给好友留言
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
}//给好友留言

if ( $_REQUEST['mod'] == "cgi_clear_log" || $_REQUEST['mod'] == "cgi_clear_log?" ){//清空日志
	$sql = "DELETE FROM ".tname( "happyfarm_mclogs" )." where uid = ".$_SGLOBAL['supe_uid'];
	$query = $_SGLOBAL['db']->query($sql);
}//清空日志

if ( $_REQUEST['mod'] == "chat"&& $_REQUEST['act'] == "clearChat" ){//清空留言
        $_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_config" )." set Message='' where uid=".$UID );        
        echo "{\"code\":1}";
		exit( );
}

if ( $_REQUEST['mod'] == "cgi_feed_special" ){ //萝卜饲养
				if ( $_REQUEST['uId'] == NULL )
				{
								$GLOBALS['_REQUEST']['uId'] = $_SGLOBAL['supe_uid'];
				}
				$fruit = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT fruit FROM ".tname( "happyfarm_nc" )." where uid=".$_SGLOBAL['supe_uid'] ), 0 );
				$fruit = json_decode( $fruit );
				$luoboid = 3;
	            $query = $_SGLOBAL['db']->query( "SELECT Status,sfeedleft FROM ".tname( "happyfarm_mc" )." where uid=".intval( $_REQUEST['uId'] ) );
                while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
				{
								$list[] = $value;
				}
				$animal = ( array )json_decode( $list[0][Status] );
				$sfeedleft = json_decode( $list[0][sfeedleft] );			
				

				  
				$fruit->$luoboid = $fruit->$luoboid - 1;
				$sfeedleft = $sfeedleft - 1;
				if($list[0][sfeedleft]==0){
					echo "{\"errorContent\":\"\\u5F53\\u524D\\u7267\\u573A\\u4ECA\\u5929\\u5DF2\\u88AB\\u558230\\u4E2A\\u7279\\u6B8A\\u4F5C\\u7269\\uFF0C\\u660E\\u5929\\u518D\\u6765\",\"errorType\":\"1001\",\"serial\":".$GLOBALS['_REQUEST']['serial'].",\"sfeedleft\":".$list[0][sfeedleft]."}";
					exit();
				}

				if($animal[animal][$_REQUEST['serial']]->postTime > 0)
					{
					$animal[animal][$_REQUEST['serial']]->postTime = $animal[animal][$_REQUEST['serial']]->postTime - 300;
				    }
				else{
					$animal[animal][$_REQUEST['serial']]->buyTime = $animal[animal][$_REQUEST['serial']]->buyTime - 300;
				    }

				foreach ( $animal[animal] as $key => $value )
				{
								if ( $key == $_REQUEST['serial'] )
								{
												if ( $value->postTime == 0 )
												{
																$time = $_SGLOBAL['timestamp'] - $value->buyTime;
																if ( $animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time )
																{
																				$status = 3;
																				$growTimeNext = 12993;
																				$statusNext = 6;
																}
																if ( $animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] + $animaltime[$value->cId][1] )
																{
																				$status = 2;
																				$growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
																				$statusNext = 3;
																}
																if ( $time < $animaltime[$value->cId][0] )
																{
																				$status = 1;
																				$growTimeNext = $animaltime[$value->cId][0] - $time;
																				$statusNext = 2;
																}
																if ( $animaltime[$value->cId][5] < $time )
																{
																				$status = 6;
																				$growTimeNext = 0;
																				$statusNext = 6;
																}
																$newanimal = "{\"animal\":{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":0,\"serial\":".$GLOBALS['_REQUEST']['serial'].",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$value->totalCome."},\"serial\":".$GLOBALS['_REQUEST']['serial'].",\"sfeedleft\":".$list[0][sfeedleft]."}";
												}
												else
												{
																$totalCome = $value->totalCome;
																$time = $_SGLOBAL['timestamp'] - $value->buyTime;
																if ( $animaltime[$value->cId][5] < $time )
																{
																				$status = 6;
																				$statusNext = 6;
																				$growTimeNext = 0;
																}
																if ( $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime )
																{
																				$status = 3;
																				$statusNext = 6;
																				$growTimeNext = 12993;
																}
																if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4] )
																{
																				$status = 5;
																				$statusNext = 3;
																				$growTimeNext = $animaltime[$value->cId][4] - ( $_SGLOBAL['timestamp'] - $value->postTime );
																}
																if ( $_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3] )
																{
																				$status = 4;
																				$statusNext = 5;
																				$growTimeNext = $animaltime[$value->cId][3] - ( $_SGLOBAL['timestamp'] - $value->postTime );
																				$totalCome -= $animaltype[$value->cId][output];
																}
																if ( $value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] - $animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] )
																{
																				$status = 5;
																				$statusNext = 6;
																				$growTimeNext = $animaltime[$value->cId][5] - $time;
																}
																$newanimal = "{\"animal\":{\"buyTime\":".$value->buyTime.",\"cId\":".$value->cId.",\"growTime\":".$time.",\"growTimeNext\":".$growTimeNext.",\"hungry\":0,\"serial\":".$GLOBALS['_REQUEST']['serial'].",\"status\":".$status.",\"statusNext\":".$statusNext.",\"totalCome\":".$totalCome."},\"serial\":".$GLOBALS['_REQUEST']['serial'].",\"sfeedleft\":".$list[0][sfeedleft]."}";
												}
								}
				}
				$newanimal = json_encode( $newanimal );
				$newanimal = str_replace( "\"{", "{", $newanimal );
				$newanimal = str_replace( "}\"", "}", $newanimal );
				$newanimal = str_replace( "null", "[]", $newanimal );
				$stranimal = json_encode( $animal );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_mc" )." set Status='".$stranimal."',sfeedleft='".$sfeedleft."' where uid=".intval( $_REQUEST['uId'] ) );
				$fruit = json_encode( $fruit );
				$_SGLOBAL['db']->query( "UPDATE ".tname( "happyfarm_nc" )." set fruit='".$fruit."' where uid=".$_SGLOBAL['supe_uid'] );
				echo stripslashes( "".$newanimal."" );
				exit( );
}//萝卜饲养

if ( $_REQUEST['mod'] == "user" && $_REQUEST['act'] == "exchange"){//牧场消费
	$query = $_SGLOBAL['db']->query( "SELECT exchange FROM ".tname( "happyfarm_config" )." where uid=".$UID );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[] = $value;
	}
	$exchange =(array)json_decode ($list[0][exchange]);
	array_multisort($exchange[cost],SORT_DESC);
    $exchange_str = json_encode ($exchange[cost]);
	echo "{\"code\":1,\"cost\":".$exchange_str."}";
	exit( );
}//牧场消费

?>
