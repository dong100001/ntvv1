<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}
$_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set sfeedleft=10");
$_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set bad=0");
?>