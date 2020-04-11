<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: invite.php 12304 2009-06-03 07:29:34Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//用户任务完成标识变量 		$task['done']
//任务完成结果html存储变量 	$task['result']
//用户任务向导html存储变量 	$task['guide']

$query = $_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('invite')." WHERE uid='$space[uid]' AND fuid>'0'");
$count = $_SGLOBAL['db']->result($query, 0);

if($count >= 10) {
	
	$task['done'] = 1;//任务完成

} else {

	//任务完成向导
	if($count) {
		$task['guide'] .= '<p style="color:red;">Bạn đã mời được '.$count.' bạn bè.</p><br>';
	}
	$task['guide'] .= '<strong>Bạn cần phải làm:</strong>
		<ul class="task">
		<li>Vào trang <a href="cp.php?ac=invite" target="_blank">mời bạn bè</a></li>
		<li>Dùng email, nick chat, tin nhắn, di động...để gửi lời mời đến bạn bè.</li>
		<li>Mời 10 bạn bè thành công nhiệm vụ sẽ hoàn thành.</li>
		</ul>';

}

?>