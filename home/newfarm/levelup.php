<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
function toExp($num){ //用于将级别转换成经验
        $toExp = 0;
        for($i=1;$i<=$num;$i++){
                $toExp += $i;
        }
        return $toExp * 200;
}

function toGrade($num){//用于将经验转换成级别
        $num = floor($num / 200);
        $toGrade = 0;
        while($toGrade < $num){
                $toGrade++;
                $num -= $toGrade;
        }
        return $toGrade;
}

//升级提示
$levelup_exp = $list[0][levelup]; //include之前必须的查询出来levelup值
$nextExp = toExp( toGrade( $levelup_exp ) + 1 ); //下一级别的经验值
$levelup_sql = "";
        $up = $_SGLOBAL['db']->query( "SELECT package,fertilizer,decorative,dog FROM ".tname( "plug_newfarm" )." where uid=".$_SGLOBAL['supe_uid'] );
        while ( $value = $_SGLOBAL['db']->fetch_array( $up ) ){
                $listup[] = $value;
        }
        $packagearr = json_decode( $listup[0][package] );
        $fertilizerarr = json_decode( $listup[0][fertilizer] );
        $decorativearr = json_decode( $listup[0][decorative] );
        $dogarr = json_decode( $listup[0][dog] );
        $levelup_arr="{\"title\":\"Upgrade award \",\"eDesc\":\" Bạn đã được nâng cấp lên level ".$levelups[$levelup_exp][level]." phần thưởng dành cho bạn là ".$levelups[$levelup_exp][eDesc].", Click vào túi dồ để xem. \",\"item\":[{\"eType\":\"".$levelups[$levelup_exp][eType]."\",\"eParam\":\"".$levelups[$levelup_exp][eParam]."\",\"eNum\":\"".$levelups[$levelup_exp][eNum]."\",\"name\":\"".$levelups[$levelup_exp][name]."\"}],\"level\":".$levelups[$levelup_exp][level]."}";
        if( 1 == $levelups[$list[0][levelup]][eType] ){
                $zhongzi = $levelups[$levelup_exp][eParam];
                $packagearr->$zhongzi = $packagearr->$zhongzi + $levelups[$levelup_exp][eNum];
                $package_srt = json_encode( $packagearr );
                $levelup_sql = ",package='{$package_srt}'";
        }elseif ( 2 == $levelups[$levelup_exp][eType] ){
				$decorativesql = 0;
                foreach ( $decorativearr as $itemtype => $value1 ){
                        foreach ( $value1 as $key1 => $value2 ){
                                if ( $key1 == $levelups[$levelup_exp][eParam] ){
										$decorativesql = 1;
                                        $value2->validtime = $_SGLOBAL['timestamp'] + $decorative[$key1][itemValidTime];
                                }
                        }
                }
				if($decorativesql == 0){
					$ids_id = $levelups[$levelup_exp][eParam];
					$keyid = $decorative[$ids_id][itemType];
					$decorativearr->$keyid->$ids_id->status = 0;
					$decorativearr->$keyid->$ids_id->validtime = $_SGLOBAL['timestamp'] + $decorative[$ids_id][itemValidTime];
				}
                $decorative_srt = json_encode( $decorativearr );
                $levelup_sql = ",decorative='{$decorative_srt}'";
        }elseif ( 3 == $levelups[$levelup_exp][eType] ){
                $gongju = $levelups[$levelup_exp][eParam];
                $fertilizerarr->$gongju = $fertilizerarr->$gongju + $levelups[$levelup_exp][eNum];
                $fertilizer_srt = json_encode( $fertilizerarr );
                $levelup_sql = ",fertilizer='{$fertilizer_srt}'";
        }elseif ( 4 == $levelups[$levelup_exp][eType] ){
                $chongwu = $levelups[$levelup_exp][eParam];
				$dogsql = 0;
				foreach ( $dogarr as $key => $value )
				{
					if ( $key == $chongwu )
					{
                		$value->status = 1;
						$value->dogFeedTime = $_SGLOBAL['timestamp'] + 172800;
						$dogsql = 1;
					}else{$value->status = 0;}
				}
				if($dogsql == 0){
				$dogarr->$chongwu->id = $chongwu;
				$dogarr->$chongwu->dogValidTime = 1;
				$dogarr->$chongwu->status = 1;
				$dogarr->$chongwu->dogFeedTime = $_SGLOBAL['timestamp'] + 172800;
				$dogarr->$chongwu->dogUnWorkTime = 0;
				}
                $dog_srt = json_encode( $dogarr );
                $levelup_sql = ",dog='{$dog_srt}'";
        }
        $levelup_arr = json_encode( $levelup_arr );
        $levelup_arr = str_replace(array("\"{","}\""), array("{","}"), $levelup_arr );
        $levelup_arr = str_replace( "null", "false", $levelup_arr );
        $_SGLOBAL['db']->query( "UPDATE ".tname( "plug_newfarm" )." set levelup={$nextExp}{$levelup_sql} where uid=".$_SGLOBAL['supe_uid'] );
//升级提示

?>