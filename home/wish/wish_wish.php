﻿<?php
/*
  $ 2009-4-19����07:24:44 tomyguan $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if(submitcheck('addsubmit')) {
     
    //���û���ϰ
    cknewuser();	
	
    //�ж��Ƿ����̫��
	$waittime = interval_check('post');
	if($waittime > 0) {
		showmessage('operating_too_fast', '', 1, array($waittime));
	}
	
	//��Ը����
	$strContent = getstr($_POST['strContent'], 80, 1, 1, 1);
	
    if(strlen($strContent) < 1) {
		showmessage('should_write_that');
	}	

	//��֤��
	if(checkperm('seccode') && !ckseccode($_POST['seccode'])) {
		showmessage('incorrect_code');
	}
	
	//����ʱ��
	date_default_timezone_set('Etc/GMT-8');
	$sendTime = date("Y-m-d H:i:s");
		
	//���ֽ����ɫ
	$strBGColor = empty($_POST['strBGColor']) ? 'a' : $_POST['strBGColor']; 
	
	//���ֽ��ͼ��
	$strImage = empty($_POST['strImage']) ? '1' : $_POST['strImage'];
	
	//��÷������ǳ�
	$strSendName = empty($_POST['strSendName']) ? '����' : $_POST['strSendName'];
	
	//�Է��ǳ�
	$Sender = "";
	$Receiver = "";
    $ReceiverUid = "";
    $NoticeUid = "";
    
	$oCheckbox = $_POST['oCheckbox'];	
	if($oCheckbox){
	    //����
	    $Sender = "Ai đó";
	}else{
	    //
	    $Sender = $space[username];
	}
	
	$oCheckbox_friend = $_POST['oCheckbox_friend'];
	if($oCheckbox_friend){
	    //�Ӻ����б�ѡ��
	    $selectfriend = empty($_POST['selectfriend']) ? '' : $_POST['selectfriend'];
	    if(empty($selectfriend)){
	        //�������
	    }else{
	        //split ,
	        $res = explode(",", $selectfriend);
	        if(count($res) == 2){
	            $Receiver = $res[1];
	            $ReceiverUid = $res[0];
	        } 
	    }
	    
	    //�Ƿ���֪ͨ
	    $oCheckbox_msg = $_POST['oCheckbox_msg'];
	    if($oCheckbox_msg){
	        $NoticeUid = $ReceiverUid; 
	    }
	}else{
	    //�Լ�����
	    $Receiver = empty($_POST['strReceiverName']) ? '' : $_POST['strReceiverName'];
	}
	
	
	if(empty($Receiver)){
	    //������û�жԱ��˷���Ըֽ���������
	}else{
	    //$s = $Sender." gửi tới ".$Receiver."(ID của người đó: ".$ReceiverUid.") và ước rằng:";
	    if(empty($NoticeUid)){
	        //û�з���֪ͨ���������
	    }else{
	        //$s.=" Đồng thời thông báo cho các ".$NoticeUid;
	        //����֪ͨ
			notification_add($NoticeUid, "wish", " viết lên tường một<a href=\"wishApp.php?do=index\">điều ước</a>");
	    }
	}
	
	//���feed
	if($_POST['oCheckFeed']){
	    $fs['icon'] = 'wish';
	    if($Sender == "Ai đó"){
	         if($Receiver){
	             if($ReceiverUid){
	                 $fs['title_template'] = $Sender." đã ước cho <a href='space.php?uid=$ReceiverUid target='_blank'>".$Receiver."</a> tại vườn ước nguyện";
	             }else{
	                 $fs['title_template'] = $Sender." đã ước cho ".$Receiver." tại vườn ước nguyện";
	             }
	         }else{
	             $fs['title_template'] = $Sender." ước cho bản thân";
	         }
	    }else{
	         if($Receiver){
	             if($ReceiverUid){
	                 $fs['title_template'] = "<a href='space.php?uid=$_SGLOBAL[supe_uid] target='_blank'>".$Sender."</a> đã ước cho <a href='space.php?uid=$ReceiverUid target='_blank'>".$Receiver."</a> tại vườn ước nguyện";
	             }else{
	                 $fs['title_template'] = "<a href='space.php?uid=$_SGLOBAL[supe_uid] target='_blank'>".$Sender."</a> đã ước cho ".$Receiver." tại vườn ước nguyện";
	             }
	         }else{
	             $fs['title_template'] = "<a href='space.php?uid=$_SGLOBAL[supe_uid] target='_blank'>".$Sender."</a> ước cho bản thân";
	         }
	    }
		feed_add($fs['icon'], $fs['title_template']);
	}
	
	
	$setarr = array(
		'uid' => $_SGLOBAL['supe_uid'],
		'username' => $_SGLOBAL['supe_username'],
		'sendTime' => $sendTime,
	    'sendname' => $strSendName,
		'content' => $strContent,
		'color' => $strBGColor,
	    'img' => $strImage,
		'ip' => getonlineip(),
	    'sender' => $Sender,	    
	    'receiver' => $Receiver,
		'receiver_uid' => $ReceiverUid,
	    'notice_uid' => $NoticeUid
	);
	//���
	$newid = inserttable('wish_content', $setarr, 1);
	
	showmessage("Điều ước của bạn là điều ước thứ <b>".$newid."</b> Đây là thông báo từ vườn ước nguyên", 'wishApp.php?do=index', 2);
}


//����URL
$siteurl = getsiteurl();

//����
$query = $_SGLOBAL['db']->query("SELECT fuid, fusername FROM ".tname('friend')." WHERE uid='$space[uid]' AND status='1'");
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	$friends[] = $value;
}


include_once template("wish/html/wish_wish");

?>