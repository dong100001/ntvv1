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

if( !is_numeric($_REQUEST['jf']) || $_REQUEST['jf']<1 ) { $_REQUEST['jf']=0; } 
$jf=intval($_REQUEST['jf']);
$money= $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT money FROM '.tname('plug_newfarm').' where uid='.$_SGLOBAL['supe_uid']),0);
if ($jf*100>$money)
{
    echo('<HTML>
<HEAD>
<meta http-equiv="refresh" content="2; url=jf.htm">
</HEAD>
<BODY>
Bạn chưa đủ điểm.
</BODY>
</HTML>
');
    exit();
}
else if($_REQUEST['jf']<=0)
{
    echo('<HTML>
<HEAD>
<meta http-equiv="refresh" content="2; url=jf.htm">
</HEAD>
<BODY>
Vui lòng nhập số điểm nguyên dương.
</BODY>
</HTML>
');
    exit();
}
$_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set money=money-".($jf*100)." where uid=".$_SGLOBAL['supe_uid']);
$_SGLOBAL['db']->query("UPDATE ".tname('space')." set credit=credit+".$jf." where uid=".$_SGLOBAL['supe_uid']);
echo('<HTML>
<HEAD>
<meta http-equiv="refresh" content="2; url=jf.htm">
</HEAD>
<BODY>
Đổi '.$jf.' điểm thành công.
</BODY>
</HTML>
');
exit();
?>
