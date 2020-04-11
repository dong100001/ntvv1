<?php
/*
  $ 2009-5-1обнГ05:09:57 tomyguan $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//х╗оч
if(!$allowmanage = checkperm('admin')) {
	showmessage('Yц╙u cА╨╖u khц╢ng hА╩ёp lА╩┤');
}

if(submitcheck('deletesubmit')) {	
	if(!empty($_POST['ids']) && deletewishes($_POST['ids'])) {
		showmessage('XцЁa thц═nh cц╢ng!', "wishApp.php?do=index&view=list");
	} else {
		showmessage('Chф╟a xцЁa д▒ф╟А╩ёc, hjc ha!', "wishApp.php?do=index&view=list");;
	}
}

//и╬ЁЩ
function deletewishes($wishids) {
	global $_SGLOBAL;

	//╩Ях║пМт╦пео╒
	$wishes = $newwishids = array();
	$allowmanage = checkperm('admin');
	$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." WHERE id IN (".simplode($wishids).")");
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		if($allowmanage) {
		    $wishes[] = $value;
			$newwishids[] = $value['id'];
		}
	}
	if(empty($newwishids)) return array();
	
	//йЩ╬щи╬ЁЩ
	$_SGLOBAL['db']->query("DELETE FROM ".tname('wish_content')." WHERE id IN (".simplode($newwishids).")");
	
	//и╬ЁЩ╤╞л╛
		
	return $wishes;
}

?>