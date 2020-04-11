<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_config')." set tianqi=3 where tianqi<4");
exit();
?>
