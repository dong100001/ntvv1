<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: admincp_gift_category.php 7078 2008-04-14 08:35:08Z liguode $
	Game siêu thị bạn bè được phát triển bởi GoHooH.CoM
	Vui lòng giữ bản quyền Việt hóa của GoHooH.Com
	Cám ơn bạn đã sử dụng sản phẩm của GoHooH.CoM
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//Ȩ��
if(!checkperm('manageprofield')) {
	cpmessage('no_authority_management_operation');
}

//��ҳ
$start = empty($_GET['start'])?0:intval($_GET['start']);
$perpage = 30;

$op = $_GET[op];
$id = $_GET[id];

if(!empty($_GET['ordermode'])){
	if($_GET['ordermode'] == 'ASC'){
		$ordermode = 'DESC';
	} else {
		$ordermode = 'ASC';
	}
} else {
	$ordermode = 'ASC';
}

if(!empty($_GET['order'])){
	$order = $_GET['id'];
} else {
	$order = 'id';
	$ordermode = 'DESC';
}

if (submitcheck('renewsubmit')) {
	
	foreach ($_POST['rid'] as $id => $value) {
		$setstr = "";
		if(!empty($_POST['name'][$id])){ $setstr .= "name = '".$_POST['name'][$id]."', "; }
		if(!empty($_POST['amount'][$id])){ $setstr .= "amount = '".$_POST['amount'][$id]."', "; } else {$setstr .= "amount = '0', "; }
		if(!empty($_POST['range'][$id])){ $setstr .= "range = '".$_POST['range'][$id]."', "; } else {$setstr .= "range = '0', "; }
		if(!empty($_POST['percent'][$id])){ $setstr .= "percent = '".$_POST['percent'][$id]."', "; } else {$setstr .= "percent = '0', "; }
		if(!empty($_POST['perday'][$id])){ $setstr .= "perday = '".$_POST['perday'][$id]."', "; } else {$setstr .= "perday = '0', "; }
		if(!empty($_POST['education'][$id])){ $setstr .= "education = '".$_POST['education'][$id]."', "; } else {$setstr .= "education = '0', "; }
		if(!empty($_POST['experience'][$id])){ $setstr .= "experience = '".$_POST['experience'][$id]."', "; } else {$setstr .= "experience = '0', "; }
		if(!empty($_POST['health'][$id])){ $setstr .= "health = '".$_POST['health'][$id]."', "; } else {$setstr .= "health = '0', "; }
		if(!empty($_POST['loyalty'][$id])){ $setstr .= "loyalty = '".$_POST['loyalty'][$id]."', "; } else {$setstr .= "loyalty = '0', "; }
		if(!empty($_POST['mood'][$id])){ $setstr .= "mood = '".$_POST['mood'][$id]."', "; } else {$setstr .= "mood = '0', "; }

		$setstr = substr($setstr, 0, -2);
		$query = "UPDATE ".tname('com_slave_luck')." SET $setstr WHERE id=".$id;
		$_SGLOBAL['db']->query($query);
	}
	
	cpmessage('do_success', 'admincp.php?ac=slaveluck');
}

//���ɾ������
if (submitcheck('deletesubmit')) {
	foreach ($_POST['rid'] as $id => $value) {
		if(empty($_POST['delete'][$id])){ 
			$count++;
		} else {
			$_SGLOBAL['db']->query("DELETE FROM ".tname('com_slave_luck')." WHERE id = $id");
		}
	}
	if(empty($count)){
		cpmessage("Bạn chưa chọn các nhiệm vụ để xóa!");
	}
	cpmessage('do_success', 'admincp.php?ac=slaveluck');
}

//����ɾ������
if ($op=="delete" && $id!=0) {
	$_SGLOBAL['db']->query("DELETE FROM ".tname('com_slave_luck')." WHERE id = $id");
	cpmessage('do_success', 'admincp.php?ac=slaveluck');
}

//---------------------�����������---------------------
if(empty($_GET['op'])) {
	//�б�

	//��鿪ʼ��
	ckstart($start, $perpage);

	$query = "SELECT * FROM ".tname('com_slave_luck')." ORDER BY $order $ordermode LIMIT $start,$perpage";

	$query = $_SGLOBAL['db']->query($query);
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		$list[] = $value;
		$count++;
	}

	//��ҳ
	$multi = smulti($start, $perpage, $count, "admincp.php?ac=slaveluck");

} elseif($_GET['op'] == 'add') {
	//���������ҳ��

} elseif($_GET['op'] == 'edit') {
	// �༭����ҳ��

	// ����
	$query = "SELECT * FROM ".tname('com_slave_luck')." WHERE id = $id";
	$query = $_SGLOBAL['db']->query($query);
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		$task = $value;
		$count++;
	}
	return $task;
}

if (submitcheck('addsubmit') OR submitcheck('editsubmit')) {
	$task = $_POST[task];
	checkSubmitValue($task);
	$setarr = array(
		'name' => $task[name],	
		'amount' => $task[amount],	
		'range' => $task[range],	
		'percent' => $task[percent],	
		'perday' => $task[perday],	
		'education' => $task[education],	
		'experience' => $task[experience],	
		'health' => $task[health],	
		'loyalty' => $task[loyalty],	
		'mood' => $task[mood],	
	);
	if(submitcheck('editsubmit')){
		updatetable('com_slave_luck', $setarr, array('id' => $task[id]));
	} else {
		inserttable('com_slave_luck', $setarr, 'admincp.php?ac=slaveluck');
	}
	cpmessage('do_success', 'admincp.php?ac=slaveluck');
}

function checkSubmitValue($task){
	if($task[amount] < 0){
		$amount = $task[amount] * -1;
	} else {
		$amount = $task[amount];
	}

	if(empty($task[name])) {
		cpmessage('Vui lòng điền tên nhiệm vụ');
	}
	if ($task[range] < 0){
		cpmessage('Phạm vi không thể nhỏ hơn 0');
	}
	if ($task[range] > $amount){
		cpmessage('Phạm vi phải nhỏ hơn số tiền');
	}
}
?>