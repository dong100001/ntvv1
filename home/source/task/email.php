<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: email.php 12304 2009-06-03 07:29:34Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if($space['emailcheck']) {

	$task['done'] = 1;//任务完成

} else {

	//任务完成向导
	$task['guide'] = '
		<strong>Bạn cần phải làm</strong>
		<ul>
		<li>Vào trang<a href="cp.php?ac=profile&op=contact" target="_blank">quản lý profile</a></li>
		<li>Điền địa chỉ email đang sử dụng rồi click vào nút "Xác nhận"</li>
		<li>Sẽ có mail kích hoạt gửi đến email của bạn. Click vào link kích hoạt để hoàn thành nhiệm vụ.</li>
		</ul>';

}

?>