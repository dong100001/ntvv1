<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/*********************/
/*                   */
/*  Version : 3.2.0  */
/*  Author  : SAM…Ωƒ∑  */
/*  Comment : 100111 */
/* 	GoHooH.CoM       */
/*********************/
include_once( "./common.php" );
require_once('./source/function_common.php');
$uid=$_SGLOBAL['supe_uid'];
$space=getspace($_SGLOBAL['supe_uid']);
//--------------------------------------------------------------------------------------
session_start();
$_SESSION['SessUID']=$uid;
$acs = array('index','invite','invite1','set','newfarm');
$ac = (!empty($_GET['ac']) && in_array($_GET['ac'], $acs)) ? $_GET['ac'] : 'newfarm';
//----------------------------------------------------------------------------------------
if ( empty( $_SGLOBAL['supe_uid'] ) )
{
				showmessage( "Vui l√≤ng ƒëƒÉng nh·∫≠p", "do.php?ac=login" );
}
$newfarm = "yes";
$maxuid = $_SGLOBAL['db']->result( $_SGLOBAL['db']->query( "SELECT uid FROM ".tname( "plug_newfarm" )." where uid=".$_SGLOBAL['supe_uid'] ), 0 );
if ( $maxuid == NULL )
{
				$farmlandstatus = "{\"farmlandstatus\":[{\"a\":2,\"b\":6,\"f\":0,\"g\":0,\"h\":1,\"i\":[],\"j\":0,\"k\":16,\"l\":9,\"m\":16,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":1251315720,\"r\":1251351720,\"s\":0,\"t\":0,\"u\":0},{\"a\":2,\"b\":3,\"f\":1,\"g\":0,\"h\":1,\"i\":[],\"j\":0,\"k\":16,\"l\":9,\"m\":16,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":1251337325,\"r\":1251351725,\"s\":0,\"t\":0,\"u\":0},{\"a\":2,\"b\":3,\"f\":0,\"g\":0,\"h\":0,\"i\":[],\"j\":0,\"k\":16,\"l\":9,\"m\":16,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":1251337325,\"r\":1251351725,\"s\":0,\"t\":0,\"u\":0},{\"a\":2,\"b\":3,\"f\":0,\"g\":2,\"h\":1,\"i\":[],\"j\":0,\"k\":16,\"l\":9,\"m\":16,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":1251326525,\"r\":1251351725,\"s\":0,\"t\":0,\"u\":0},{\"a\":2,\"b\":7,\"f\":0,\"g\":0,\"h\":1,\"i\":[],\"j\":0,\"k\":16,\"l\":9,\"m\":16,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725,\"s\":0,\"t\":0,\"u\":0},{\"a\":2,\"b\":7,\"f\":0,\"g\":0,\"h\":1,\"i\":[],\"j\":0,\"k\":16,\"l\":9,\"m\":16,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725,\"s\":0,\"t\":0,\"u\":0}]}";
				$farmlandstatus = ( array )json_decode( $farmlandstatus );
				foreach ( $farmlandstatus[farmlandstatus] as $key => $value )
				{
								if ( $key == 0 )
								{
												$value->q = $_SGLOBAL['timestamp'] - 36000;
								}
								if ( $key == 1 )
								{
												$value->q = $_SGLOBAL['timestamp'] - 14400;
								}
								if ( $key == 2 )
								{
												$value->q = $_SGLOBAL['timestamp'] - 14400;
								}
								if ( $key == 3 )
								{
												$value->q = $_SGLOBAL['timestamp'] - 25200;
								}
				}
				$farmlandstatus = json_encode( $farmlandstatus );
				
				//◊∞ Œ
				$decorative = "{\"1\":{\"1\":{\"status\":1,\"validtime\":0}},\"2\":{\"2\":{\"status\":1,\"validtime\":0}},\"3\":{\"3\":{\"status\":1,\"validtime\":0}},\"4\":{\"4\":{\"status\":1,\"validtime\":0}}}";
				
				//ª® ¯
				$nosegay = "{}";
				
				//œ˚œ¢
				$message = "{\"a\":[],\"b\":[],\"c\":[],\"d\":[],\"e\":[]}";
				
				//ƒ¡≥°∂ØŒÔ
				$animal = "{\"animalfood\":20,\"animalfeedtime\":".$_SGLOBAL['timestamp'].",\"item1\":1,\"item2\":1,\"item3\":0,\"item4\":1,\"animal\":[{\"buyTime\":1244817632,\"cId\":1002,\"postTime\":0,\"totalCome\":0,\"tou\":\"\",\"feedtime\":0},{\"buyTime\":0,\"cId\":0,\"postTime\":0,\"totalCome\":0,\"tou\":\"\",\"feedtime\":0}]}";
				

				//º”‘ÿ”√ªß√˚
				$usernames = $space[name];
        		if ( empty( $usernames ) || $space[namestatus] ==0 ){ 
                	$usernames = $space[username];
        		}

				$_SGLOBAL['db']->query( "INSERT INTO ".tname( "plug_newfarm" )." (uid,username,farmlandstatus,decorative,nosegay,message,animal) VALUES(".$_SGLOBAL['supe_uid'].",'".$usernames."','".$farmlandstatus."','".$decorative."','".$nosegay."','".$message."','".$animal."')" );
				include_once( S_ROOT."./source/function_cp.php" );
				$icon = "farm";
				$title_template = "{actor} ch∆°i game n√¥ng tr·∫°i vui v·∫ª <a href=\"newfarm.php\">Newfarm</a> ·ªü <a href=\"http://www.gohooh.com/nhatui\" target=\"blank\">Nh√† Tui</a> r·∫•t vui";
				$body_general = "Tham gia v√†o h·ªôi n√¥ng d√¢n Nh√† Tui v·ªõi t·ªõ nh√©!";
				feed_add( $icon, $title_template, NULL, NULL, NULL, $body_general );
}
$_TPL['titles'] = array(
				$space['username'],
				"GoHooH.CoM"
);
//include( template( "newfarm" ) );
//--------------------------------------------------------------------------------------
include_once(S_ROOT."./newfarm/{$ac}.php");
//----------------------------------------------------------------------------------------
?>
