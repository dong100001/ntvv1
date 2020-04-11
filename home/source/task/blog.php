<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: blog.php 11056 2009-02-09 01:59:47Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$blogcount = getcount('blog', array('uid'=>$space['uid']));
if($blogcount) {

	$task['done'] = 1;//任务完成

} else {

	//任务完成向导
	$task['guide'] = '
		<strong>Bạn cần phải làm</strong>
		<ul>
		<li>1. Vào trang <a href="cp.php?ac=blog" target="_blank">viết blog</a></li>
		<li>2. Viết 1 entry mới chia sẽ những gì bạn muốn và quay lại nhận thưởng.</li>
		</ul>';

}

?>