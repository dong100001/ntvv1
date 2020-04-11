<?php
/*
	悬赏问答插件 for UCH 1.5 正式版
	版权所有： www.TechWeb.com.cn
	由"毛琳"改版 http://www.discuz.net/space.php?uid=1040662 
*/

if ( !defined( "IN_UCHOME" ) )
{
    exit( "Access Denied" );
}

$op = $_GET['op'];
$ask_id = intval($_GET['id']);
if($_GET['op'] == 'edit')
{
   $sql = " select * from ".tname('app_ask')." where id = ".$ask_id." ";
   $query = $_SGLOBAL['db']->query( $sql );
   $info = $_SGLOBAL['db']->fetch_array( $query );
   if (empty($info))
   {
        showmessage("Thông tin không tồn tại hoặc đã bị xoá", 'gohoohhoidap.php?do=ask');
   }
}

include_once( template( "ask/view/ask_post" ) );
?>