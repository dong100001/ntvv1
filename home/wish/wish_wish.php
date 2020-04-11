<?php
/*
  $ 2009-4-19œ¬ŒÁ07:24:44 tomyguan $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if(submitcheck('addsubmit')) {
     
    //–¬”√ªßº˚œ∞
    cknewuser();	
	
    //≈–∂œ «∑Ò≤Ÿ◊˜Ã´øÏ
	$waittime = interval_check('post');
	if($waittime > 0) {
		showmessage('operating_too_fast', '', 1, array($waittime));
	}
	
	//–Ì‘∏ƒ⁄»›
	$strContent = getstr($_POST['strContent'], 80, 1, 1, 1);
	
    if(strlen($strContent) < 1) {
		showmessage('should_write_that');
	}	

	//—È÷§¬Î
	if(checkperm('seccode') && !ckseccode($_POST['seccode'])) {
		showmessage('incorrect_code');
	}
	
	//∑¢ÀÕ ±º‰
	date_default_timezone_set('Etc/GMT-8');
	$sendTime = date("Y-m-d H:i:s");
		
	//ªÒµ√÷ΩÃı—’…´
	$strBGColor = empty($_POST['strBGColor']) ? 'a' : $_POST['strBGColor']; 
	
	//ªÒµ√÷ΩÃıÕº∞∏
	$strImage = empty($_POST['strImage']) ? '1' : $_POST['strImage'];
	
	//ªÒµ√∑¢ÀÕ’ﬂÍ«≥∆
	$strSendName = empty($_POST['strSendName']) ? 'ƒ‰√˚' : $_POST['strSendName'];
	
	//∂‘∑ΩÍ«≥∆
	$Sender = "";
	$Receiver = "";
    $ReceiverUid = "";
    $NoticeUid = "";
    
	$oCheckbox = $_POST['oCheckbox'];	
	if($oCheckbox){
	    //ƒ‰√˚
	    $Sender = "Ai ƒë√≥";
	}else{
	    //
	    $Sender = $space[username];
	}
	
	$oCheckbox_friend = $_POST['oCheckbox_friend'];
	if($oCheckbox_friend){
	    //¥”∫√”—¡–±Ì—°‘Ò
	    $selectfriend = empty($_POST['selectfriend']) ? '' : $_POST['selectfriend'];
	    if(empty($selectfriend)){
	        //≤ª”√¿Ìª·
	    }else{
	        //split ,
	        $res = explode(",", $selectfriend);
	        if(count($res) == 2){
	            $Receiver = $res[1];
	            $ReceiverUid = $res[0];
	        } 
	    }
	    
	    // «∑Ò∑¢ÀÕÕ®÷™
	    $oCheckbox_msg = $_POST['oCheckbox_msg'];
	    if($oCheckbox_msg){
	        $NoticeUid = $ReceiverUid; 
	    }
	}else{
	    //◊‘º∫ ‰»Î
	    $Receiver = empty($_POST['strReceiverName']) ? '' : $_POST['strReceiverName'];
	}
	
	
	if(empty($Receiver)){
	    //∑¢ÀÕ’ﬂ√ª”–∂‘±»À∑¢–Ì‘∏÷Ω£¨≤ª”√¿Ìª·
	}else{
	    //$s = $Sender." g·ª≠i t·ªõi ".$Receiver."(ID c·ªßa ng∆∞·ªùi ƒë√≥: ".$ReceiverUid.") v√† ∆∞·ªõc r·∫±ng:";
	    if(empty($NoticeUid)){
	        //√ª”–∑¢ÀÕÕ®÷™£¨≤ª”√¿Ìª·
	    }else{
	        //$s.=" ƒê·ªìng th·ªùi th√¥ng b√°o cho c√°c ".$NoticeUid;
	        //∑¢ÀÕÕ®÷™
			notification_add($NoticeUid, "wish", " vi·∫øt l√™n t∆∞·ªùng m·ªôt<a href=\"wishApp.php?do=index\">ƒëi·ªÅu ∆∞·ªõc</a>");
	    }
	}
	
	//ÃÌº”feed
	if($_POST['oCheckFeed']){
	    $fs['icon'] = 'wish';
	    if($Sender == "Ai ƒë√≥"){
	         if($Receiver){
	             if($ReceiverUid){
	                 $fs['title_template'] = $Sender." ƒë√£ ∆∞·ªõc cho <a href='space.php?uid=$ReceiverUid target='_blank'>".$Receiver."</a> t·∫°i v∆∞·ªùn ∆∞·ªõc nguy·ªán";
	             }else{
	                 $fs['title_template'] = $Sender." ƒë√£ ∆∞·ªõc cho ".$Receiver." t·∫°i v∆∞·ªùn ∆∞·ªõc nguy·ªán";
	             }
	         }else{
	             $fs['title_template'] = $Sender." ∆∞·ªõc cho b·∫£n th√¢n";
	         }
	    }else{
	         if($Receiver){
	             if($ReceiverUid){
	                 $fs['title_template'] = "<a href='space.php?uid=$_SGLOBAL[supe_uid] target='_blank'>".$Sender."</a> ƒë√£ ∆∞·ªõc cho <a href='space.php?uid=$ReceiverUid target='_blank'>".$Receiver."</a> t·∫°i v∆∞·ªùn ∆∞·ªõc nguy·ªán";
	             }else{
	                 $fs['title_template'] = "<a href='space.php?uid=$_SGLOBAL[supe_uid] target='_blank'>".$Sender."</a> ƒë√£ ∆∞·ªõc cho ".$Receiver." t·∫°i v∆∞·ªùn ∆∞·ªõc nguy·ªán";
	             }
	         }else{
	             $fs['title_template'] = "<a href='space.php?uid=$_SGLOBAL[supe_uid] target='_blank'>".$Sender."</a> ∆∞·ªõc cho b·∫£n th√¢n";
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
	//»Îø‚
	$newid = inserttable('wish_content', $setarr, 1);
	
	showmessage("ƒêi·ªÅu ∆∞·ªõc c·ªßa b·∫°n l√† ƒëi·ªÅu ∆∞·ªõc th·ª© <b>".$newid."</b> ƒê√¢y l√† th√¥ng b√°o t·ª´ v∆∞·ªùn ∆∞·ªõc nguy√™n", 'wishApp.php?do=index', 2);
}


//µ±πÿURL
$siteurl = getsiteurl();

//∫√”—
$query = $_SGLOBAL['db']->query("SELECT fuid, fusername FROM ".tname('friend')." WHERE uid='$space[uid]' AND status='1'");
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	$friends[] = $value;
}


include_once template("wish/html/wish_wish");

?>