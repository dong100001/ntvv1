<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if($_SERVER['REQUEST_METHOD'] != 'POST') {
	exit('Error 404');
}

include_once('../common.php');
if ( empty( $_SGLOBAL['supe_uid'] ) )
{
				showmessage( "Vui lòng đăng nhập", "do.php?ac=login" );
}

if( !is_numeric($_REQUEST['fb']) || $_REQUEST['fb']<1 ) { $_REQUEST['fb']=0; } 
$fb=intval($_REQUEST['fb']);
$credit= $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT credit FROM '.tname('space').' where uid='.$_SGLOBAL['supe_uid']),0);
if ($fb*10>$credit)
{
    echo('<HTML>
<HEAD>
<meta http-equiv="refresh" content="2; url=fb.htm">
</HEAD>
<BODY>
Bạn chưa đủ điểm
</BODY>
</HTML>
');
    exit();
}
else if($_REQUEST['fb']<=0)
{
    echo('<HTML>
<HEAD>
<meta http-equiv="refresh" content="2; url=fb.htm">
</HEAD>
<BODY>
Vui lòng nhập số điểm lơn hơn 0 và phải là số nguyên!
</BODY>
</HTML>
');
    exit();
}
$_SGLOBAL['db']->query("UPDATE ".tname('space')." set credit=credit-".($fb*10)." where uid=".$_SGLOBAL['supe_uid']);
$_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set fb=fb+".$fb." where uid=".$_SGLOBAL['supe_uid']);
echo('<HTML>
<HEAD>
<meta http-equiv="refresh" content="2; url=fb.htm">
</HEAD>
<BODY>
Bạn đã đổi '.($fb*10).' điểm để lấy '.$fb.' Gee thành công!
</BODY>
</HTML>
');
exit();
?>
