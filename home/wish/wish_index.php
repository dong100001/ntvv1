﻿<?php
/*
  $ 2009-4-19����07:24:44 tomyguan $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//��ö�������Ըֽ��
$query = $_SGLOBAL['db']->query("SELECT count(*) c FROM ".tname('wish_content'));
$value = $_SGLOBAL['db']->fetch_array($query);
$count = empty($value['c']) ? 0 : $value['c'];


if($_GET['view'] == 'me') {
    $query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." WHERE uid = ".$_SGLOBAL['supe_uid']." ORDER BY id DESC LIMIT 1000");
}else if($_GET['view'] == 'receive'){
    $query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." WHERE receiver_uid = ".$_SGLOBAL['supe_uid']." ORDER BY id DESC LIMIT 1000");
}else if($_GET['view'] == 'friend'){
    $query = $_SGLOBAL['db']->query("SELECT w.* FROM ".tname('friend')." f LEFT JOIN ".tname('wish_content')." w ON f.fuid = w.uid WHERE w.id > 0 AND f.uid = ".$_SGLOBAL['supe_uid']." ORDER BY w.id DESC LIMIT 1000");
}else if($_GET['view'] == 'list'){ 
    //Ȩ��    
    if(!$allowmanage = checkperm('admin')){
        $allowmanagewish = false; 
    }else{
        $allowmanagewish = true; 
    }
	//��ҳ
	$perpage = 20;
	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$start = ($page-1)*$perpage;
	$count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('wish_content')),0);
	$multi = multi($count, $perpage, $page, "wishApp.php?do=index&view=list");
	
	$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." ORDER BY id DESC LIMIT $start,$perpage");
}else if($_GET['view'] == 'search'){
    $key = empty($_GET['key']) ? '0' : $_GET['key'];
    if(is_numeric($key)){
         $query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." WHERE id = '".$key."' ORDER BY id DESC LIMIT 1000");
    }else{
         showmessage('Ước nguyện chứa ký tự không hợp lệ');
    }
}else{
    $query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('wish_content')." ORDER BY id DESC LIMIT 1000");
}

while ($value = $_SGLOBAL['db']->fetch_array($query)) {
    srand((double)microtime()*1000000);   
    $value['left'] = rand(1, 550);
    srand((double)microtime()*1000000);
    $value['top'] = rand(1, 350);
    $value['sendTime'] = date('Y-m-d H:m',strtotime($value['sendTime']));
    //ת���ǳ�
    $value['somebody'] = '';
    if($value['uid'] == $_SGLOBAL['supe_uid']){
        if($value['username'] == $value['sender']){
            $value['sender'] = 'Người gửi';
        }else{
            $value['somebody'] = '(Ai đó)';
        }
    }
    if($value['receiver_uid'] == $_SGLOBAL['supe_uid']){
        $value['receiver'] = 'Người nhận';
    }
    //�س�����
    $value['content'] = str_replace("\r\n", "<br />", $value['content']);

	$wish[] = $value;
}

//ѡ�е���ʽ
if(empty($_GET['view'])){
    $actives[$do] = ' class=active'; 
}else{
    $actives[$view] = ' class=active';
}

include_once template("wish/html/wish_index");

?>