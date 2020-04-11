<?php
/*
	Game siêu thị bạn bè được phát triển bởi GoHooH.CoM
	Vui lòng giữ bản quyền Việt hóa của GoHooH.Com
	Cám ơn bạn đã sử dụng sản phẩm của GoHooH.CoM
*/
function comchecklisense( $comname )
{
	global $_SGLOBAL;
	$license = "SELECT * FROM ".tname( "com_licenses" );
	$query = $_SGLOBAL['db']->query( $license );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		if ( $value[name] == $comname )
		{
			$mylicense = $value[key];
		}
	}
	$domain = $_SERVER['HTTP_HOST'];
	$domainarr = explode( ".", $domain );
	$number = count( $domainarr );
	$domainlist = array( "127.0.0.1", "64.191.81.86", "gohooh.com/nhatui", "www.gohooh.com/nhatui" );
	foreach ( $domainlist as $pdomain )
	{
		if ( $domain == $pdomain )
		{
			$licensepass = 1;
		}
	}
	if ( $licensepass = 1 )
	{
		$domainname = $domainarr[$number - 2].".".$domainarr[$number - 1];
		if ( $domainarr[$number - 2] == "com" )
		{
			$domainname = $domainarr[$number - 3].".".$domainarr[$number - 2].".".$domainarr[$number - 1];
		}
		$domainkey = $domainname.mren2008.$comname;
		$key = crypt( $domainkey, "\$1\$rasmusle\$" );
		$key = md5( $key );
	}
}

function comslavecheckuseractivation( $uid )
{
	global $_SGLOBAL;
	$query = "SELECT uid, created FROM ".tname( "com_slave_main" ).( " WHERE uid='".$uid."'" );
	$query = $_SGLOBAL['db']->query( $query );
	$value = $_SGLOBAL['db']->fetch_array( $query );
	if ( !empty( $value ) )
	{
		if ( 0 < $value[created] )
		{
			return 2;
		}
		return 1;
	}
}

function comslavegetuserinfo( $userid, $format = 0 )
{
	global $_SGLOBAL;
	global $SConfig;
	$query = "SELECT *, (SELECT count( * ) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid\r\n) AS totalslave FROM ".tname( "com_slave_main" ).( " AS main WHERE main.uid='".$userid."'" );
	$query = $_SGLOBAL['db']->query( $query );
	$value = $_SGLOBAL['db']->fetch_array( $query );
	if ( !empty( $value ) )
	{
		$vaverage = ( $value[education] + $value[experience] + $value[health] + $value[loyalty] + $value[mood] ) / 5;
		$value[added] = round( $value[pvalue] * ( $vaverage / 100 ) );
		$value[asset] = comslavegetuserasset( $userid ) + $value[cash];
		$value[services_charge] = round( $value[pvalue] * ( $SConfig[services_charge] / 100 ) );
		$value[tax] = round( $value[services_charge] * ( $SConfig[tax] / 100 ) );
		$value[total] = $value[pvalue] + $value[added] + $value[services_charge] + $value[tax];
		if ( $format == 1 )
		{
			$value[added] = number_format( $value[added] );
			$value[total] = number_format( $value[total] );
			$value[pvalue] = number_format( $value[pvalue] );
			$value[cash] = number_format( $value[cash] );
			$value[tax] = number_format( $value[tax] );
			$value[services_charge] = number_format( $value[services_charge] );
			$value[asset] = number_format( $value[asset] );
			return $value;
		}
	}
	else
	{
		$query = "SELECT * FROM ".tname( "space" ).( " WHERE uid='".$userid."'" );
		$query = $_SGLOBAL['db']->query( $query );
		$value = $_SGLOBAL['db']->fetch_array( $query );
		$value[uplineuid] = 0;
		$value[asset] = $SConfig[initial_fund];
		$value[slave] = 0;
		$value[education] = $SConfig[initial_education];
		$value[experience] = $SConfig[initial_experience];
		$value[health] = $SConfig[initial_health];
		$value[loyalty] = $SConfig[initial_loyalty];
		$value[mood] = $SConfig[initial_mood];
		$value[cash] = $SConfig[initial_fund];
		$value[pvalue] = $SConfig[initial_value];
		$value[services_charge] = round( $value[pvalue] * ( $SConfig[services_charge] / 100 ) );
		$value[tax] = round( $value[services_charge] * ( $SConfig[tax] / 100 ) );
		$vaverage = ( $value[education] + $value[experience] + $value[health] + $value[loyalty] + $value[mood] ) / 5;
		$value[added] = round( $value[pvalue] * ( $vaverage / 100 ) );
		$value[total] = $value[pvalue] + $value[added] + $value[services_charge] + $value[tax];
		if ( $format == 1 )
		{
			$value[total] = number_format( $value[total] );
			$value[pvalue] = number_format( $value[pvalue] );
			$value[cash] = number_format( $value[cash] );
			$value[tax] = number_format( $value[tax] );
			$value[services_charge] = number_format( $value[services_charge] );
			$value[asset] = number_format( $value[asset] );
		}
	}
	return $value;
}

function comslavegetuserfriendsinslave( )
{
	global $_SGLOBAL;
	global $space;
	$query = "SELECT * FROM ".tname( "com_slave_main" ).( " WHERE uid IN (".$space['friend'].")" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$friendinslave[] = $value[uid];
	}
	return $friendinslave;
}

function comslavelistallusers( $start, $perpage )
{
	global $_SGLOBAL;
	global $space;
	global $SConfig;
	global $range;
	global $sort;
	global $sex;
	global $cat;
	global $searchuser;
	if ( $cat == "discount" )
	{
		$discount = 1;
	}
	else if ( $cat == "friends" )
	{
		$myfriend = $space[friend];
		if ( empty( $myfriend ) )
		{
			$myfriend = 0;
		}
		$friendsql = "AND main.uid IN (".$myfriend.")";
	}
	$services_charge = $SConfig[services_charge] / 100;
	$tax = $SConfig[tax] / 100;
	if ( $range == "affordable" )
	{
		$user = comslavegetuserinfo( $space[uid] );
		$rangesql = " HAVING total < ".$user['cash']." ";
	}
	if ( $sort == "expensive" )
	{
		$ordersql = "total DESC,";
	}
	else
	{
		$ordersql = "main.updatetime DESC,";
	}
	if ( $sex != 0 )
	{
		$sexsql = "AND spacefield.sex = ".$sex;
	}
	if ( !empty( $discount ) )
	{
		$discountsql = "AND main.discount = 1";
	}
	if ( !empty( $searchuser ) )
	{
		$searchusersql = "AND main.username like '%".$searchuser."%'";
	}
	$calcsql = "round(main.pvalue * ".$services_charge.") as services_charge, \r\n\t\t\t\tround(main.pvalue * {$services_charge} * {$tax}) as tax, \r\n\t\t\t\tround(main.pvalue * ((main.education+main.experience+main.health+main.loyalty+main.mood)/5)/100) as added, \r\n\t\t\t\tround((main.pvalue * {$services_charge}) + (main.pvalue * {$services_charge} * {$tax}) + pvalue + (main.pvalue * ((main.education+main.experience+main.health+main.loyalty+main.mood)/5)/100)) as total, ";
	$query = "SELECT main.*, ".$calcsql." spacefield.sex, \r\n\t\t\t\t(SELECT count( * ) FROM ".tname( "com_slave_main" )." AS sub2 WHERE sub2.uplineuid = main.uid\r\n\t\t\t\t) AS totalslave,  \r\n\t\t\t\tif(( SELECT sum( pvalue ) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid )>0, ( SELECT sum( pvalue ) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid )+main.cash, main.cash) AS asset \r\n\t\t\t\tFROM ".tname( "com_slave_main" )." AS main, ".tname( "spacefield" ).( " as spacefield \r\n\t\t\t\tWHERE main.uid = spacefield.uid AND main.uid != ".$space['uid']." AND main.level != 1 AND main.uplineuid != {$space['uid']} {$friendsql} {$sexsql} {$discountsql} {$rangesql} {$searchusersql} \r\n\t\t\t\tORDER BY {$ordersql} main.cash DESC LIMIT {$start}, {$perpage}" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
		$value[count] = $count;
		$friendsuid[] = $value[uid];
		if ( empty( $value[asset] ) )
		{
			$value[asset] = $value[cash];
		}
		$value[pvalue] = number_format( $value[pvalue] );
		$value[cash] = number_format( $value[cash] );
		$value[asset] = number_format( $value[asset] );
		$userinfo[] = $value;
	}
	$activecount = count( $userinfo );
	if ( !empty( $activecount ) )
	{
		if ( $activecount < $perpage )
		{
			$perpage -= $activecount;
			$start = 0;
		}
		else
		{
			$perpage = 0;
		}
	}
	$services_charge = round( $SConfig[initial_value] * ( $SConfig[services_charge] / 100 ) );
	$tax = round( $services_charge * ( $SConfig[tax] / 100 ) );
	$total = $SConfig[initial_value] + $services_charge + $tax;
	$vaverage = ( $SConfig[initial_education] + $SConfig[initial_experience] + $SConfig[initial_health] + $SConfig[initial_loyalty] + $SConfig[initial_mood] ) / 5;
	$added = round( $SConfig[initial_value] * ( $vaverage / 100 ) );
	if ( $sort == "active" )
	{
		$ordersql2 = " ORDER BY updatetime DESC ";
	}
	if ( $sex != 0 )
	{
		$sexsql2 = "AND spacefield.sex = ".$sex;
	}
	if ( !empty( $searchuser ) )
	{
		$searchusersql = "AND space.username like '%".$searchuser."%'";
	}
	if ( $friendsql )
	{
		$SConfignumber = comslavegetslavenumber( $space[uid] );
		if ( empty( $SConfignumber ) )
		{
			$SConfignumber = array( );
		}
		$spacelist = explode( ",", $space[friend] );
		$difflist2 = array_diff( $spacelist, $SConfignumber );
		$finslave = comslavegetuserfriendsinslave( );
		if ( $finslave )
		{
			$difflist = array_diff( $difflist2, $finslave );
		}
		$difflist = implode( ",", $difflist );
		if ( empty( $difflist ) )
		{
			$difflist = 0;
		}
		$uidlist = $difflist;
		$uidsql = "AND space.uid IN (".$uidlist.")";
	}
	else
	{
		$uidlist = comslavegetslavemainusersidlist( );
		$uidsql = "AND space.uid NOT IN (".$uidlist.")";
	}
	if ( empty( $uidlist ) )
	{
		$uidlist = 0;
	}
	$query = "\r\n\t\t\t\tSELECT space.*, spacefield.sex  \r\n\t\t\t\tFROM ".tname( "space" )." AS space, ".tname( "spacefield" ).( " AS spacefield   \r\n\t\t\t\tWHERE space.uid = spacefield.uid AND space.uid != ".$space['uid']." {$uidsql} {$sexsql2} \r\n\t\t\t\t{$ordersql2} {$searchusersql} \r\n\t\t\t\tLIMIT {$start}, {$perpage}" );
	if ( $discount != 1 )
	{
		if ( $range == "affordable" )
		{
			if ( $total < $user[cash] )
			{
				$query = $_SGLOBAL['db']->query( $query );
				while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
				{
					$value[slave] = 0;
					$value[pvalue] = $SConfig[initial_value];
					$value[cash] = $SConfig[initial_fund];
					$value[asset] = $SConfig[initial_fund];
					$value[services_charge] = $services_charge;
					$value[tax] = $tax;
					$value[total] = $total;
					$vaverage = $vaverage;
					$value[added] = $added;
					$value[pvalue] = number_format( $value[pvalue] );
					$value[cash] = number_format( $value[cash] );
					$value[asset] = number_format( $value[asset] );
					++$count;
					$value[count] = $count;
					$userinfo[] = $value;
				}
			}
		}
		else
		{
			$query = $_SGLOBAL['db']->query( $query );
			while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
			{
				$value[slave] = 0;
				$value[pvalue] = $SConfig[initial_value];
				$value[cash] = $SConfig[initial_fund];
				$value[asset] = $SConfig[initial_fund];
				$value[services_charge] = $services_charge;
				$value[tax] = $tax;
				$value[total] = $total;
				$vaverage = $vaverage;
				$value[added] = $added;
				$value[pvalue] = number_format( $value[pvalue] );
				$value[cash] = number_format( $value[cash] );
				$value[asset] = number_format( $value[asset] );
				++$count;
				$value[count] = $count;
				$userinfo[] = $value;
			}
		}
	}
	return $userinfo;
}

function comslavelistranking( $start, $perpage )
{
	global $_SGLOBAL;
	global $space;
	global $SConfig;
	global $range;
	global $sort;
	global $sex;
	global $cat;
	if ( $cat == "friends" )
	{
		$myfriend = $space[friend];
		if ( empty( $myfriend ) )
		{
			$myfriend = $space[uid];
		}
		$friendsql = "AND main.uid IN (".$myfriend.")";
	}
	$services_charge = $SConfig[services_charge] / 100;
	$tax = $SConfig[tax] / 100;
	if ( $sort == "expensive" )
	{
		$ordersql = "total DESC";
	}
	else if ( $sort == "asset" )
	{
		$ordersql = "asset DESC";
	}
	else if ( $sort == "cash" )
	{
		$ordersql = "main.cash DESC";
	}
	else if ( $sort == "slave" )
	{
		$ordersql = "totalslave DESC";
	}
	else if ( $sort == "active" )
	{
		$ordersql = "main.updatetime DESC";
	}
	if ( $sex != 0 )
	{
		$sexsql = "AND spacefield.sex = ".$sex;
	}
	$calcsql = "round(main.pvalue * ".$services_charge.") as services_charge, \r\n\t\t\t\tround(main.pvalue * {$services_charge} * {$tax}) as tax, \r\n\t\t\t\tround(main.pvalue * ((main.education+main.experience+main.health+main.loyalty+main.mood)/5)/100) as added, \r\n\t\t\t\tround((main.pvalue * {$services_charge}) + (main.pvalue * {$services_charge} * {$tax}) + pvalue + (main.pvalue * ((main.education+main.experience+main.health+main.loyalty+main.mood)/5)/100)) as total, ";
	$query = "SELECT main.*, ".$calcsql." spacefield.sex, \r\n\t\t\t\t(SELECT count( * ) FROM ".tname( "com_slave_main" )." AS sub2 WHERE sub2.uplineuid = main.uid\r\n\t\t\t\t) AS totalslave,  \r\n\t\t\t\tif(( SELECT sum( pvalue ) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid )>0, ( SELECT sum( pvalue ) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid )+main.cash, main.cash) AS asset \r\n\t\t\t\tFROM ".tname( "com_slave_main" )." AS main, ".tname( "spacefield" ).( " as spacefield \r\n\t\t\t\tWHERE main.uid = spacefield.uid ".$friendsql." {$sexsql}  \r\n\t\t\t\tORDER BY {$ordersql} LIMIT {$start}, {$perpage}" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
		$value[count] = $count;
		$friendsuid[] = $value[uid];
		if ( empty( $value[asset] ) )
		{
			$value[asset] = $value[cash];
		}
		$value[pvalue] = number_format( $value[pvalue] );
		$value[cash] = number_format( $value[cash] );
		$value[asset] = number_format( $value[asset] );
		$userinfo[] = $value;
	}
	return $userinfo;
}

function comslavegetslavelist( $userid )
{
	global $_SGLOBAL;
	global $SConfig;
	$query = "SELECT *, (SELECT count(*) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid\r\n) AS totalslave FROM ".tname( "com_slave_main" ).( " as main WHERE main.uplineuid='".$userid."' ORDER BY main.pvalue DESC" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
		$value[asset] = comslavegetuserasset( $value[uid] ) + $value[cash];
		$value[slavecount] = $count;
		$vaverage = ( $value[education] + $value[experience] + $value[health] + $value[loyalty] + $value[mood] ) / 5;
		$value[added] = number_format( round( $value[pvalue] * ( $vaverage / 100 ) ) );
		$value[pvalue] = number_format( $value[pvalue] );
		$value[cash] = number_format( $value[cash] );
		$value[asset] = number_format( $value[asset] );
		$SConfiglist[] = $value;
	}
	return $SConfiglist;
}

function comslavegetcollectionlist( $collection, $uid )
{
	global $_SGLOBAL;
	global $SConfig;
	global $space;
	$collectionarr = explode( ",", $collection );
	foreach ( $collectionarr as $cvalue )
	{
		$query = "SELECT *, (SELECT count(*) FROM ".tname( "com_slave_main" )." AS sub WHERE sub.uplineuid = main.uid\r\n) AS totalslave FROM ".tname( "com_slave_main" ).( " AS main WHERE main.uid='".$cvalue."'" );
		$query = $_SGLOBAL['db']->query( $query );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
			++$count;
			$value[asset] = comslavegetuserasset( $value[uid] ) + $value[cash];
			$value[slavecount] = $count;
			$vaverage = ( $value[education] + $value[experience] + $value[health] + $value[loyalty] + $value[mood] ) / 5;
			$value[added] = round( $value[pvalue] * ( $vaverage / 100 ) );
			$value[pvalue] = number_format( $value[pvalue] );
			$value[cash] = number_format( $value[cash] );
			$value[asset] = number_format( $value[asset] );
			$value[cuplineuid] = $uid;
			$clist[] = $value;
		}
	}
	return $clist;
}

function comslavegetslavenumber( $userid )
{
	global $_SGLOBAL;
	global $SConfig;
	$query = "SELECT * FROM ".tname( "com_slave_main" ).( " WHERE uplineuid='".$userid."'" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$SConfignumber[] = $value[uid];
	}
	return $SConfignumber;
}

function comslavegetslavemainusersidlist( )
{
	global $_SGLOBAL;
	$query = "SELECT uid FROM ".tname( "com_slave_main" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$uidlist .= $value[uid].",";
	}
	$uidlist = substr( $uidlist, 0, -1 );
	return $uidlist;
}

function comslavecheckisslave( $uid )
{
	global $_SGLOBAL;
	global $SConfig;
	global $space;
	$query = "SELECT * FROM ".tname( "com_slave_main" )." WHERE uplineuid='".$space[uid]."'";
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		if ( $value[uid] == $uid )
		{
			$check = 1;
		}
	}
	return $check;
}

function comslaveprintlevel( $id, $indent = "" )
{
	global $_SGLOBAL;
	$query = "SELECT * FROM ".tname( "com_slave_main" )." WHERE uplineuid = ".$id;
	$result = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $result ) )
	{
		$asset += $value[pvalue];
		comslaveprintlevel( $value['uid'], $indend."  " );
	}
	return $asset;
}

function comslavegetcommission( $uid )
{
	global $_SGLOBAL;
	global $SConfig;
	$query = "SELECT pvalue FROM ".tname( "com_slave_main" ).( " WHERE uid='".$uid."'" );
	$query = $_SGLOBAL['db']->query( $query );
	$value = $_SGLOBAL['db']->fetch_array( $query );
	$services_charge = round( $value[pvalue] * ( $SConfig[services_charge] / 100 ) );
	$commission = $services_charge / 2;
	return $commission;
}

function comslaveaddnewuser( $uid, $created = 1 )
{
	global $_SGLOBAL;
	global $SConfig;
	$query = "SELECT username FROM ".tname( "space" ).( " WHERE uid='".$uid."'" );
	$query = $_SGLOBAL['db']->query( $query );
	$value = $_SGLOBAL['db']->fetch_array( $query );
	if ( $created == 1 )
	{
		$created = $_SGLOBAL['timestamp'];
	}
	$setarr = array(
		"uid" => $uid,
		"username" => addslashes( sstripslashes( $value['username'] ) ),
		"pvalue" => $SConfig[initial_value],
		"education" => $SConfig[initial_education],
		"experience" => $SConfig[initial_experience],
		"health" => $SConfig[initial_health],
		"loyalty" => $SConfig[initial_loyalty],
		"mood" => $SConfig[initial_mood],
		"cash" => $SConfig[initial_fund],
		"created" => $created
	);
	inserttable( "com_slave_main", $setarr );
}

function comslavegetuserasset( $uid )
{
	global $_SGLOBAL;
	$query = "SELECT sum(pvalue) AS total FROM ".tname( "com_slave_main" )." WHERE uplineuid = ".$uid;
	$result = $_SGLOBAL['db']->query( $query );
	$value = $_SGLOBAL['db']->fetch_array( $result );
	return $value[total];
}

function comslaveaddhistory( $uid, $taskid = 0, $cat = 1, $message )
{
	global $_SGLOBAL;
	global $space;
	$setarr = array(
		"uid" => $uid,
		"muid" => $space[uid],
		"cat" => $cat,
		"taskid" => $taskid,
		"message" => addslashes( sstripslashes( $message ) ),
		"created" => $_SGLOBAL['timestamp']
	);
	inserttable( "com_slave_history", $setarr );
}

function comslaveds( $amount )
{
	global $SConfig;
	if ( $amount < 0 )
	{
		$amount *= -1;
	}
	$amount = $SConfig[dollar_sign].$amount;
	return $amount;
}

function comslavegethistorylist( $uid )
{
	global $_SGLOBAL;
	global $SConfig;
	$query = "SELECT * FROM ".tname( "com_slave_history" ).( " WHERE uid='".$uid."' ORDER BY id DESC LIMIT 0,30" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
		$historylist[] = $value;
	}
	return $historylist;
}

function comslavedoluck( )
{
	global $_SGLOBAL;
	global $SConfig;
	global $space;
	$query = "SELECT * FROM ".tname( "com_slave_luck" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$pdcount = comslavecheckperday( $value[id], 1, $space[uid] );
		if ( empty( $value[perday] ) )
		{
			$value[perday] = 9999;
		}
		if ( $pdcount < $value[perday] )
		{
			$valuestr = "";
			$vcalsign ="+";
			$randno = rand( 1, 100 );
			if ( $randno <= $value[percent] )
			{
				$range1 = $value[amount] - $value[range];
				$range2 = $value[amount] + $value[range];
				$myamount = rand( $range1, $range2 );
				$amount = comslaveds( $myamount );
				$valuearr = array( "education", "experience", "health", "loyalty", "mood" );
				$updatefields = "";
				foreach ( $valuearr as $key )
				{
					$$key = 0;
					if ( 0 <= $value[$key] )
					{
						$vcalsign = "+";
					}
					else
					{
						$vcalsign = "-";
					}
					if ( 0 <= $value[range] )
					{
						if ( !empty( $value[$key] ) )
						{
							if ( 0 <= $value[$key] )
							{
								$vcalsign = "+";
							}
							else
							{
								$vcalsign = "-";
							}
							$$key = comslavecountvalue( $value[amount], $value[range], $value[$key], $myamount );
							if ( $$key <= 0 )
							{
								$$key *= -1;
								$skey = "slave".$key;
								$$skey = $slave[$key] - $$key;
							}
							else
							{
								$skey = "slave".$key;
								$$skey = $slave[$key] + $$key;
							}
							if ( $$key == 0 )
							{
								$$key = 1;
							}
							$$key = $vcalsign.$$key;
						}
					}
					else
					{
						if ( $value[amount] <= 0 )
						{
							$vcalsign = "-";
							$$key = $value[$key] * -1;
						}
						else
						{
							$vcalsign = "+";
							$$key = $value[$key];
						}
						if ( (!empty( $key )) || ($key==0) ) 
						{
							$$key = $vcalsign.$$key;
						}

					}
					$value[name] = str_replace( "[".$key."]", $$key, $value[name] );

					if ( !empty( $key ) )
					{
						$valuestr .= comlang( $key )." ".$$key.", ";
if ($$key==0)
{
$$key="+0";
}
						$updatefields .= "{$key} = ".( "if((".$key ).$$key.( ")>100,100,".$key ).$$key."), ";
					}
					$calsign = "";
					$vcalsign = "";
				}
				if ( 0 <= $value[amount] )
				{
					$calsign = "+";
				}
				$updatefields .= "cash = cash".$calsign.$myamount;
				$value[name] = str_replace( "[money]", $amount, $value[name] );
				$valuestr = substr( $valuestr, 0, -2 );
				$value[name] .= "[".$valuestr."]";
				comslaveaddhistory( $space[uid], $value[id], 1, $value[name] );
				$mainquery = "UPDATE ".tname( "com_slave_main" ).( " SET ".$updatefields." WHERE uid=" ).$space[uid];
				$_SGLOBAL['db']->query( $mainquery );
				$statusmsg .= $value[name]."<BR><BR>";
			}
		}
	}
	return $statusmsg;
}

function comslavecountvalue( $amount, $range, $tvalue, $myamount )
{
	if ( $amount < 0 )
	{
		$conamount = $amount * -1;
		$conmood = $tvalue * -1;
		$myamount *= -1;
	}
	else
	{
		$conamount = $amount;
		$conmood = $tvalue;
	}
	$range1 = $conamount - $range;
	$totalamount = $conamount + $range - ( $conamount - $range );
	$temprange = $totalamount / 5;
	$acamount = $myamount - $range1;
	$percentage = $acamount / $temprange;
	$myvalue = round( $conmood / 5 * $percentage );
	if ( $myvalue == 0 )
	{
		$myvalue = 1;
	}
	return $myvalue;
}

function comslavedotask( $uid, $taskid )
{
	global $_SGLOBAL;
	global $SConfig;
	global $space;
	$query = "SELECT * FROM ".tname( "com_slave_task" ).( " WHERE id=".$taskid );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$pdcount = comslavecheckperday( $value[id], 2, $uid );
		if ( empty( $value[perday] ) )
		{
			$value[perday] = 9999;
		}
		$actionperiod = comslavecheckactionperday( 2, $uid );
		if ( $SConfig[action_period] <= $actionperiod[count] )
		{
			$status[actionlimit] = $actionperiod;
			return $status;
		}
		if ( !( $pdcount < $value[perday] ) )
		{
			break;
		}
		$slave = comslavegetuserinfo( $uid );
		$master = comslavegetuserinfo( $space[uid] );
		$valuestr = "";
		$cash = empty( $value[mcash] ) ? $value[scash] : $value[mcash];
		$valuearr = array( "education", "experience", "health", "loyalty", "mood" );
		if ( !empty( $cash ) )
		{
			if ( $cash < 0 )
			{
				$cash *= -1;
			}
			$range1 = $cash - $value[range];
			$range2 = $cash + $value[range];
			$myamount = rand( $range1, $range2 );
			$totalamount = $range2 - $range1;
			$percent = ( $myamount - ( $cash - $value[range] ) ) / $totalamount * 100;
			if ( $value[catid] == 2 )
			{
				$extrabonus = $slave[pvalue] * ( ( $slave[education] + $slave[experience] + $slave[health] + $percent ) / 4 / 100 );
				$myamount = round( $extrabonus / 5 );
				if ( $myamount < 10 )
				{
					$myamount = 10;
				}
			}
			if ( $value[scash] )
			{
				if ( $value[catid] == 2 )
				{
					$slavecash = round( $value[scash] * $percent / 100 );
					$fslavecash = comslaveds( $slavecash );
				}
				else
				{
					$slavecash = $myamount;
					$fslavecash = comslaveds( $slavecash );
				}
			}
			$supdatefields = "";
			foreach ( $valuearr as $key )
			{
				$$key = 0;
				if ( 0 < $value[range] && !empty( $value[$key] ) )
				{
					if ( 0 < $value[$key] )
					{
						$calsign = "+";
					}
					else
					{
						$calsign = "-";
					}
					$$key = round( $value[$key] * $percent / 100 );
					if ( $$key < 0 )
					{
						$$key *= -1;
						$skey = "slave".$key;
						$$skey = $slave[$key] - $$key;
					}
					else
					{
						$skey = "slave".$key;
						$$skey = $slave[$key] + $$key;
					}
					if ( $slavehealth < 0 || $slaveloyalty < 0 )
					{
						$runaway = true;
						if ( $$skey < 0 )
						{
							$$skey = 0;
						}
					}
					if ( $$key == 0 )
					{
						$$key = 1;
					}
					$$key = $calsign.$$key;
				}
				$value[mastertext] = str_replace( "[".$key."]", $calsign.$value[$key], $value[mastertext] );
				if ( !empty( $key ) )
				{
	if (empty($$skey))
					{
						$$skey="{$key}+0";
					}
					else
					{
						if ($$key==0)
						{
							$$skey="{$key}+0";
						}
						else
						{
							$$skey="{$key}".$$key;
						}
					}


					$valuestr .= comlang( $key )." ".$$key.", ";
					$supdatefields .= "{$key}"." = if((".$$skey.")>100,1000,".$$skey."), ";
				}
			}
		}
		else
		{
			foreach ( $valuearr as $key )
			{
				if ( !empty( $value[$key] ) )
				{
					if ( 0 < $value[$key] )
					{
						$calsign = "+";
						$$key = rand( 1, $value[$key] );
						$skey = "slave".$key;
						$$skey = $slave[$key] + $$key;
					}
					else
					{
						$calsign = "-";
						$$key = rand( -1, $value[$key] );
						$$key *= -1;
						$skey = "slave".$key;
						$$skey = $slave[$key] - $$key;
					}
					if ( $slavehealth < 0 || $slaveloyalty < 0 )
					{
						$runaway = true;
						if ( $$skey < 0 )
						{
							$$skey = 0;
						}
					}
	
					$calvalue = $calsign.$$key;
					$value[mastertext] = str_replace( "[".$key."]", $calvalue, $value[mastertext] );
					$valuestr .= comlang( $key )." ".$calvalue.", ";
					$supdatefields .= "{$key}"." = if((".$$skey.")>100,100,".$$skey."), ";
				}
			}
		}
		$amount = comslaveds( $myamount );
		$value[mastertext] = str_replace( "[money]", $amount, $value[mastertext] );
		$valuestr = substr( $valuestr, 0, -2 );
		if ( $value[slavetext] )
		{
			$value[slavetext] .= "[".$valuestr."]";
		}
		else
		{
			$value[slavetext] = $value[mastertext].( "[".$valuestr."]" );
		}
		$mastername = comslaveuserlink( $master[uid], $master[username] );
		$slavename = comslaveuserlink( $slave[uid], $slave[username] );
		$value[slavetext] = str_replace( "[money]", $fslavecash, $value[slavetext] );
		$value[slavetext] = str_replace( "[master]", $mastername, $value[slavetext] );
		$value[slavetext] = str_replace( "[slave]", $slavename, $value[slavetext] );
		$value[mastertext] = str_replace( "[master]", $mastername, $value[mastertext] );
		$value[mastertext] = str_replace( "[slave]", $slavename, $value[mastertext] );
		$supdatefields = substr( $supdatefields, 0, -2 );
		if ( $slavecash )
		{
			if ( $value[scash] < 0 )
			{
				$slavecash = "-".$slavecash;
			}
			else
			{
				$slavecash = "+".$slavecash;
			}
			$supdatefields .= ", cash = cash ".$slavecash;
		}
		if ( 0 < $value[mcash] )
		{
			$calsign = "+";
		}
		else
		{
			$calsign = "-";
		}
		if ( $myamount < 0 )
		{
			$myamount *= -1;
		}
		if ( 0 < $myamount )
		{
			$mupdatefields = " cash = cash ".$calsign.$myamount;
		}
		comslaveaddhistory( $master[uid], $value[id], 2, $value[mastertext] );
		comslaveaddhistory( $slave[uid], $value[id], 2, $value[slavetext] );
		if ( $master[sfeed] == 1 )
		{
			$message = "<B>[<a href=sieuthigoer.php?com=slave>".$SConfig[gamename]."</a>]</B> ".$value[mastertext];
			feed_add( "thread", $message );
		}
		if ( $mupdatefields )
		{
			$masterquery = "UPDATE ".tname( "com_slave_main" ).( " SET ".$mupdatefields." WHERE uid=" ).$master[uid];
			$_SGLOBAL['db']->query( $masterquery );
		}
		if ( $runaway )
		{
			$supdatefields .= ", uplineuid = 0";
		}
		$slavequery = "UPDATE ".tname( "com_slave_main" ).( " SET ".$supdatefields." WHERE uid=" ).$slave[uid];
		$_SGLOBAL['db']->query( $slavequery );
		$status[msg] = $value[mastertext]."<BR><BR>";
		if ( $runaway )
		{
			$srunawaymsg = comlang( "slave_srunawaymsg", array(
				$slavename,
				$mastername
			) );
			$mrunawaymsg = comlang( "slave_mrunawaymsg", array(
				$slavename,
				$mastername
			) );
			$status[msg] = $value[mastertext]."<BR><BR>".$mrunawaymsg."<BR><BR>";
			comslaveaddhistory( $master[uid], 0, 0, $mrunawaymsg );
			comslaveaddhistory( $slave[uid], 0, 0, $srunawaymsg );
		}
	}
	$status[limit] = $value[perday];
	return $status;
	return $status;
}

function comslaveuserlink( $uid, $username, $bbcode = 0 )
{
	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	if ( $bbcode == 1 )
	{
		$link = "[url=".$url."?com=slave&uid={$uid}]".$username."[/url]";
		return $link;
	}
	$link = "<a href=sieuthigoer.php?com=slave&uid=".$uid.">{$username}</a>";
	return $link;
}

function comslavecheckperday( $taskid, $cat = 1, $uid )
{
	global $_SGLOBAL;
	global $space;
	$query = "SELECT * FROM ".tname( "com_slave_history" ).( " WHERE taskid = ".$taskid." AND cat={$cat} AND uid=" ).$uid." AND muid=".$space[uid];
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		if ( $_SGLOBAL['today'] < $value[created] )
		{
			++$pdcount;
		}
	}
	return $pdcount;
}

function comslavecheckactionperday( $cat = 1, $uid )
{
	global $_SGLOBAL;
	global $space;
	global $SConfig;
	$query = "SELECT * FROM ".tname( "com_slave_history" ).( " WHERE cat=".$cat." AND uid=" ).$uid." AND muid=".$space[uid];
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		if ( $cat == 2 )
		{
			$checktime = $value[created] + 3600 * $SConfig[action_hour];
			if ( $_SGLOBAL['timestamp'] < $checktime )
			{
				$actionlist[taskid] .= $value[taskid].",";
				++$actionlist[count];
			}
		}
		else if ( $_SGLOBAL['today'] < $value[created] )
		{
			$actionlist[taskid] .= $value[taskid].",";
			++$actionlist[count];
		}
	}
	return $actionlist;
}

function comslavechecktaskactionperday( $uid )
{
	global $_SGLOBAL;
	global $space;
	global $SConfig;
	$query = "SELECT * FROM ".tname( "com_slave_history" )." WHERE cat=2 AND uid=".$uid." AND muid=".$space[uid];
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		if ( $_SGLOBAL['today'] < $value[created] )
		{
			$actionlist[taskid] .= $value[taskid].",";
			++$actionlist[count];
		}
	}
	return $actionlist;
}

function comslavegetusername( $uid )
{
	global $_SGLOBAL;
	global $space;
	$query = "SELECT username FROM ".tname( "com_slave_main" ).( " WHERE uid = ".$uid );
	$query = $_SGLOBAL['db']->query( $query );
	$value = $_SGLOBAL['db']->fetch_array( $query );
	return $value[username];
}

function comslavelisttask( $catid )
{
	global $_SGLOBAL;
	global $uid;
	if ( !empty( $catid ) )
	{
		$wheresql = " WHERE catid = ".$catid." ";
	}
	$query = "SELECT * FROM ".tname( "com_slave_task" ).( " ".$wheresql." ORDER BY catid" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$actionlist = comslavechecktaskactionperday( $uid );
		$taskarr = explode( ",", $actionlist[taskid] );
		if ( !in_array( $value[id], $taskarr ) )
		{
			$tasklist[] = $value;
		}
	}
	return $tasklist;
}

function comslaveupdateinvitorcash( $uid, $sign = "+" )
{
	global $SConfig;
	global $_SGLOBAL;
	print_r( $SConfig[invite_amount] );
	$updatefields = "cash = cash ".$sign." ".$SConfig[invite_amount];
	$mainquery = "UPDATE ".tname( "com_slave_main" ).( " SET ".$updatefields." WHERE uid=" ).$uid;
	$_SGLOBAL['db']->query( $mainquery );
}

function comslavecheckslavesellperday( $uid )
{
	global $SConfig;
	global $_SGLOBAL;
	$sotday = $_SGLOBAL['today'];
	$eotday = $_SGLOBAL['today'] + 86400;
	$query = "SELECT * FROM ".tname( "com_slave_history" )." WHERE cat=3 AND uid=".$uid.( " AND created BETWEEN ".$sotday." AND {$eotday}" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
	}
	return $count;
}

function comslavecheckslavediscountperday( $uid )
{
	global $SConfig;
	global $_SGLOBAL;
	$sotday = $_SGLOBAL['today'];
	$eotday = $_SGLOBAL['today'] + 86400;
	$query = "SELECT * FROM ".tname( "com_slave_history" )." WHERE cat=4 AND uid=".$uid.( " AND created BETWEEN ".$sotday." AND {$eotday}" );
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
	}
	return $count;
}

function comslavecheckinvitecount( $uid, $all = 0 )
{
	global $SConfig;
	global $_SGLOBAL;
	$sotday = $_SGLOBAL['today'];
	$eotday = $_SGLOBAL['today'] + 86400;
	if ( $all == 0 )
	{
		$allsql = " AND created BETWEEN ".$sotday." AND {$eotday}";
	}
	$query = "SELECT * FROM ".tname( "com_slave_history" )." WHERE cat=5 AND uid=".$uid.$allsql;
	$query = $_SGLOBAL['db']->query( $query );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		++$count;
	}
	return $count;
}

comchecklisense( "slavepro_1_0" );
?>
