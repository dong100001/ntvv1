<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: profile.php 13217 2009-08-21 06:57:53Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//判断用户是否全部设置了个人资料
$nones = array();
$profile_lang = array(
	'name' => 'Tên',
	'sex' => 'Giới tính',
	'birthyear' => 'Năm sinh',
	'birthmonth' => 'Tháng sinh',
	'birthday' => 'Ngày sinh',
	'blood' => 'Nhóm máu',
	'marry' => 'Tình trạng hôn nhân',
	'birthprovince' => 'Nơi sinh (tỉnh}',
	'birthcity' => 'Nơi sinh (huyện)',
	'resideprovince' => 'Nơi ở (tỉnh)',
	'residecity' => 'Nơi ở (huyện)'
);
foreach (array('name','sex','birthyear','birthmonth','birthday','marry','birthprovince','birthcity','resideprovince','residecity') as $key) {
	$value = trim($space[$key]);
	if(empty($value)) {
		$nones[] = $profile_lang[$key];
	}
}
//站长扩展
@include_once(S_ROOT.'./data/data_profilefield.php');
foreach ($_SGLOBAL['profilefield'] as $field => $value) {
	if($value['required'] && empty($space['field_'.$field])) {
		$nones[] = $value['title'];
	}
}

if(empty($nones)) {

	$task['done'] = 1;//任务完成
	
	//自动找好友
	$findmaxnum = 10;
	$space['friends'][] = $space['uid'];
	$nouids = implode(',', $space['friends']);

	//居住地好友
	$residelist = array();
	$warr = array();
	$warr[] = "sf.resideprovince='".addslashes($space['resideprovince'])."'";
	$warr[] = "sf.residecity='".addslashes($space['residecity'])."'";
	$query = $_SGLOBAL['db']->query("SELECT s.uid,s.username,s.name,s.namestatus FROM ".tname('spacefield')." sf
		LEFT JOIN ".tname('space')." s ON s.uid=sf.uid
		WHERE ".implode(' AND ', $warr)." AND sf.uid NOT IN ($nouids)
		LIMIT 0,$findmaxnum");
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		realname_set($value['uid'], $value['username'], $value['name'], $value['namestatus']);
		$residelist[] = $value;
	}

	//性别好友
	$sexlist = array();
	$warr = array();
	if(empty($space['marry']) || $space['marry'] < 2) {//单身
		$warr[] = "sf.marry='1'";//单身
	}
	if(empty($space['sex']) || $space['sex'] < 2) {//男生
		$warr[] = "sf.sex='2'";//女生
	} else {
		$warr[] = "sf.sex='1'";//男生
	}
	$query = $_SGLOBAL['db']->query("SELECT s.uid,s.username,s.name,s.namestatus FROM ".tname('spacefield')." sf
		LEFT JOIN ".tname('space')." s ON s.uid=sf.uid
		WHERE ".implode(' AND ', $warr)." AND sf.uid NOT IN ($nouids)
		LIMIT 0,$findmaxnum");
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		realname_set($value['uid'], $value['username'], $value['name'], $value['namestatus']);
		$sexlist[] = $value;
	}
	
	realname_get();
	
	if($residelist) {
		$task['result'] .= '<p>Bạn có thể thêm bạn bè 1 cách nhanh chóng.</p>';
		$task['result'] .= '<ul class="avatar_list">';
		foreach ($residelist as $key => $value) {
			$task['result'] .= '<li>
				<div class="avatar48"><a href="space.php?uid='.$value['uid'].'" target="_blank">'.avatar($value['uid'], 'small').'</a></div>
				<p><a href="space.php?uid='.$value['uid'].'" target="_blank">'.$_SN[$value['uid']].'</a></p>
				<p><a href="cp.php?ac=friend&op=add&uid='.$value['uid'].'" id="a_reside_friend_'.$key.'" onclick="ajaxmenu(event, this.id, 1)">Thêm bạn bè</a></p>
				</li>';
		}
		$task['result'] .= '</ul>';
	}
	if($sexlist) {
		$task['result'] .= '<p>Hãy mau tìm cho mình bạn khác giới</p>';
		$task['result'] .= '<ul class="avatar_list">';
		foreach ($sexlist as $key => $value) {
			$task['result'] .= '<li>
				<div class="avatar48"><a href="space.php?uid='.$value['uid'].'" target="_blank">'.avatar($value['uid'], 'small').'</a></div>
				<p><a href="space.php?uid='.$value['uid'].'" target="_blank">'.$_SN[$value['uid']].'</a></p>
				<p><a href="cp.php?ac=friend&op=add&uid='.$value['uid'].'" id="a_sex_friend_'.$key.'" onclick="ajaxmenu(event, this.id, 1)">Thêm bạn</a></p>
				</li>';
		}
		$task['result'] .= '</ul>';
	}

} else {

	//任务完成向导
	$task['guide'] = '
		<strong>Bạn cần điền đầy đủ thông tin profile</strong><br>
		<span style="color:red;">'.implode('<br>', $nones).'</span><br><br>
		<strong>Làm như sau:</strong>
		<ul>
		<li>Vào trang <a href="cp.php?ac=profile" target="_blank">quản lý profile</a>.</li>
		<li>Hoàn chỉnh toàn bộ thông tin và hoàn thành nhiệm vụ.</li>
		</ul>';

}

?>