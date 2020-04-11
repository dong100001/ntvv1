<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
function vipPoint($vipobj,$nowtime){
	if($vipobj[endtime]==0)
		$vipobj[endtime]=$vipobj[jointime];
	if($vipobj[validtime]>$nowtime){
		$daynum=floor(($nowtime-$vipobj[endtime])/86400);
		$vipobj[vippoint]=$vipobj[vippoint]+$daynum*15;
		$vipobj[endtime]=$vipobj[endtime]+$daynum*86400;
	}else{
		if($vipobj[endtime]<$vipobj[validtime]){
			$daynum=floor(($vipobj[validtime]-$vipobj[endtime])/86400);
			$vipobj[vippoint]=$vipobj[vippoint]+$daynum*15;
			$vipobj[endtime]=$vipobj[endtime]+$daynum*86400;
			$daynum1=ceil(($nowtime-$vipobj[endtime])/86400);
			$vipobj[vippoint]=$vipobj[vippoint]-$daynum1*5;
			$vipobj[endtime]=$vipobj[endtime]+$daynum1*86400;
		}else{
			$daynum=ceil(($nowtime-$vipobj[endtime])/86400);
			$vipobj[vippoint]=$vipobj[vippoint]-$daynum*5;
			$vipobj[endtime]=$vipobj[endtime]+$daynum*86400;
		}
		if($vipobj[vippoint]<=0){
			$vipobj[vippoint]=0;
			$vipobj[jointime]=0;
		}
		if($vipobj[vipstatus]==1)$vipobj[vipstatus]=0;
	}
	return $vipobj;
}
function verifyVip($db,$now,$vipObj){
	if($vipObj[jointime]!=0){
		$vipObj=vipPoint($vipObj,$now);
		if($vipObj[vippoint]<450){
			$lv=1;
			$lastPoint=450-$vipObj[vippoint];
		}elseif($vipObj[vippoint]<1125){
			$lv=2;
			$lastPoint=1125-$vipObj[vippoint];
		}elseif($vipObj[vippoint]<2025){
			$lv=3;
			$lastPoint=2025-$vipObj[vippoint];
		}elseif($vipObj[vippoint]<3150){
			$lv=4;
			$lastPoint=3150-$vipObj[vippoint];
		}elseif($vipObj[vippoint]<4500){
			$lv=5;
			$lastPoint=4500-$vipObj[vippoint];
		}elseif($vipObj[vippoint]<6075){
			$lv=6;
			$lastPoint=6075-$vipObj[vippoint];
		}else{
			$lv=7;
			$lastPoint=0;
		}
		$lastday=ceil($lastPoint/15);
		$vipObj[level]=$lv;
		$db->query( "UPDATE ".tname( "plug_newfarm_vip" )." set vipstatus=".$vipObj[vipstatus].",jointime=".$vipObj[jointime].",vippoint=".$vipObj[vippoint].",level=".$lv.",endtime=".$vipObj[endtime]." where uid=".intval( $vipObj[uid] ) );
	}
	return $vipObj[vipstatus].",".$lv.",".$vipObj[vippoint].",".$lastday.",".$vipObj[validtime];
}
function getVipGift($viplv,$uid,$theDt,$db){
	$fertarr = $db->query( "SELECT fertilizer FROM ".tname( "plug_newfarm" )." where uid=".$uid );
	while ( $value = $db->fetch_array( $fertarr ) )
	{
		$list1[] = $value;
	}
	$fertarr = json_decode( $list1[0][fertilizer] );
	if($viplv<3){
		$ferN=1;
		$fertarr->$ferN = $fertarr->$ferN + 1*$viplv;
	}elseif($viplv<5){
		$ferN=2;
		$fertarr->$ferN = $fertarr->$ferN + 1*($viplv-2);
	}elseif($viplv<7){
		$ferN=3;
		$fertarr->$ferN = $fertarr->$ferN + 1*($viplv-4);
	}else{
		$ferN=7;
		$fertarr->$ferN = $fertarr->$ferN + $viplv-4;
	}
	$fertarr = json_encode( $fertarr );
	$db->query( "UPDATE ".tname( "plug_newfarm_vip" )." set rsign='".$theDt."' where uid=".$uid );
	$db->query( "UPDATE ".tname( "plug_newfarm" )." set fertilizer='".$fertarr."' where uid=".$uid );
	return;
}

?>