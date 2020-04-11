<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: friend.php 11056 2009-02-09 01:59:47Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if($space['friendnum']>=5) {

	$task['done'] = 1;//任务完成

} else {

	//向导
	$task['guide'] = '
		<strong>Bạn cần phải làm</strong>
		<ul>
		<li>1. Vào trang <a href="cp.php?ac=friend&op=find" target="_blank">Bạn bè</a></li>
		<li>2. Hệ thống sẽ cung cấp danh sách người dụng, hãy chọn bạn để thêm vào.</li>
		<li>3. Chờ bạn bè chấp nhận và hoàn thành nhiệm vụ.</li>
		</ul>';

}

?>