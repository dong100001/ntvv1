<?php
/****************************************/
/*      Nông trại vui vẻ QQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com

include_once('common.php');
header('Content-Type:text/html; charset=' . FARM_ENCODE);

farmdeny();

$query = $_SGLOBAL['db']->query('select yb,money FROM '.tname('happyfarm_config').' where uid='.intval($_SGLOBAL['supe_uid']));
while($value = $_SGLOBAL['db']->fetch_array($query)) {
	$yb = $value[yb]; 
	$money = $value[money]; 
}


//顶部菜单参数
$showMenu = true;
$act = $_GET['act'] ? $_GET['act'] : 'nmc';

if($act == 'nmc') {
	include(template('happyfarm/view/nmc'));
}
elseif($act == 'full') {
	$showMenu = false;
	include(template('happyfarm/view/nmc'));
}
elseif($_REQUEST['act'] == 'help') {
	$type = in_array($_GET['type'], array('nc','mc')) ? $_GET['type'] : 'nc';
	include(template('happyfarm/view/help'));
}
else die('Tham số lỗi');

?>