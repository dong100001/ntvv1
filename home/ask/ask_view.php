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

$id = (int)$_GET['id'];
if (empty($id)) {
	showmessage('Tham số lỗi', 'gohoohhoidap.php');
}
$ask_id = & $id;

//获取信息
$sql = "SELECT * FROM ".tname("app_ask")." WHERE id= $id ";
$query = $_SGLOBAL['db']->query( $sql );
$ask = $_SGLOBAL['db']->fetch_array( $query );
if (empty($ask)) {
	showmessage("Thông tin không tồn tại hoặc đã bị xoá", 'gohoohhoidap.php?do=ask');
}
//更新点击数
$sql = "UPDATE ".tname("app_ask")." SET view_count = view_count + 1, reply_count ={$ask['reply_count']} WHERE id = ".$id;
$_SGLOBAL['db']->query( $sql );

//评论
$theurl = "gohoohhoidap.php?do=ask&ac=view&id={$ask_id}";

$reply = array();
$sql = "SELECT * FROM ".tname('app_ask_reply')." WHERE ask_id = $ask_id ORDER BY id ";
$query = $_SGLOBAL['db']->query($sql);
$count = 0;
$arr_ids = array();
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	$value['content'] = nl2br(htmlspecialchars($value['content'])) ;
	$reply[] = $value;
	$arr_ids[] = $value['id'];
	$count++;
}

//$sql = "UPDATE ".tname("app_ask")." SET reply_count ={$count} WHERE id = ".$id;
//$_SGLOBAL['db']->query( $sql );

$str_ids = implode(",", $arr_ids);
include_once( template( "ask/view/ask_view" ) );
?>