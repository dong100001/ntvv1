<?php
/*
	悬赏问答插件 for UCH 1.5 正式版
	版权所有： www.TechWeb.com.cn
	由"毛琳"改版 http://www.discuz.net/space.php?uid=1040662 
*/

$op = $_GET['op'];
if (empty($op)) {
	showmessage('Không xác định phương pháp');
}
if ('post' == $op) {	
	$title = trim($_POST['title']);
	if (empty($title) || empty($_POST['content'])) {
		showmessage("Vui lòng điền nội dung và tiêu đề");
	}
	$post_ask_id = intval($_POST['ask_id']);
	//修改
	if ($post_ask_id > 0) {
		$data = array(
			'title' => shtmlspecialchars($title),
			'content' => trim($_POST['content']),
			'typeid' =>  intval($_POST['typeid'])
		 );
		 updatetable("app_ask", $data, "id = {$post_ask_id}");
		 showmessage("Sửa đổi thành công", "gohoohhoidap.php?do=ask&ac=view&id={$post_ask_id}");
	}
	
	$score = intval(trim($_POST['score']));
	if ($score < 1 || $score > $gMaxScore ) {
		showmessage("Điểm thưởng phải từ 1~{$gMaxScore} điểm");
	}
	getmember();
	if ($_SGLOBAL['member']['credit'] < $score) {
		showmessage("Rất tiếc, bạn chưa đủ điểm");
	}

	$data = array(
		'uid' => $_SGLOBAL['supe_uid'],
		'username' => $_SGLOBAL['supe_username'],
		'title' => shtmlspecialchars($title),
		'content' => trim($_POST['content']),
		'typeid' =>  intval($_POST['typeid']),
		'score' => $score,
		'dateline' => $_SGLOBAL['timestamp'],
		'status' => 1
	 );

	$ask_id = inserttable('app_ask', $data, 1);

	//事件feed
	$fs = array();
	$fs['icon'] = 'gohoohhoidap';
    $fs['title_template'] = "{actor} đăng câu hỏi: <b>{subject}</b> ({score} điểm thưởng)";
	
	$fs['title_data'] = array(
		'subject' => "<a href=\"gohoohhoidap.php?do=ask&ac=view&id={$ask_id}\">{$title}</a>",
		'score' => $score
	);
	$fs['body_template'] = '';
	$fs['body_data'] = array();
	
	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], $fs['friend']);

	updatecredit($_SGLOBAL['supe_uid'], $score, '-');
	showmessage("Đăng câu hỏi thành công. Bạn đã bị trừ {$score} điểm.", "gohoohhoidap.php?do=ask&ac=view&id={$ask_id}");

}
elseif ('reply' == $op )	
{
	$ask_id = intval($_POST['ask_id']);
	$ask_title = trim($_POST['ask_title']);
	$ask_uid = intval($_POST['ask_uid']);
	if (empty($ask_id)) {
		showmessage("Tham số lỗi");
	}
	$content = trim($_POST['content']);
	if (empty($content) ) {
		showmessage("Vui lòng điền nội dung trả lời");
	}

	$data = array(
		'uid' => $_SGLOBAL['supe_uid'],
		'username' => $_SGLOBAL['supe_username'],
		'content' => trim($_POST['content']),
		'ask_id' => $ask_id,
		'dateline' => $_SGLOBAL['timestamp']
	 );
	$reply_id = inserttable('app_ask_reply', $data, 1);
	
	//更新回复数
	$sql = "UPDATE ".tname("app_ask")." SET reply_count = reply_count + 1 WHERE id = ".$ask_id;
	$_SGLOBAL['db']->query( $sql );
	
	if ($ask_uid !=  $_SGLOBAL['supe_uid']) {		
		//通知
		include_once(S_ROOT.'./source/function_cp.php');
		$message = "Câu trả lời về <a href=\"gohoohhoidap.php?do=ask&ac=view&id={$ask_id}\">{$ask_title}</a> của bạn đã được đăng";
	    notification_add($ask_uid, "app", $message );
	}
	
    
    //事件feed
	$fs = array();
	$fs['icon'] = 'gohoohhoidap';
    $fs['title_template'] = "{actor} trả lời câu hỏi: <b>{subject}</b>";	
	$fs['title_data'] = array(
		'subject' => "<a href=\"gohoohhoidap.php?do=ask&ac=view&id={$ask_id}\">{$ask_title}</a>"
	);
	$fs['body_template'] = '';
	$fs['body_data'] = array();
	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], $fs['friend']);	
	
    
	showmessage("Trả lời thành công", $theurl, 1);		
}
elseif ('finish' == $op)
{
	$ask_id = intval($_POST['ask_id']);
	$theurl = trim($_POST['theurl']);
	
	//获取信息
	$sql = "SELECT * FROM ".tname("app_ask")." WHERE id= $ask_id AND uid = ".$_SGLOBAL['supe_uid'] ;
	$query = $_SGLOBAL['db']->query( $sql );
	$ask = $_SGLOBAL['db']->fetch_array( $query );
	if (empty($ask)) {
		showmessage("Thông tin không tồn tại hoặc đã bị xoá", 'gohoohhoidap.php?do=ask');
	}	
	if (2 == $ask['status']) {
		showmessage("Vấn đề này đã được giải quyết, bạn không thể trả lời nữa");
	}
	$pscore = $_POST['score'];
	if ($ask['score'] != array_sum($pscore) ) {
		showmessage("Điểm thưởng không phù hợp");
	}
	
	foreach ($pscore as $key => $val) {
		$sql = "UPDATE ".tname('app_ask_reply')." SET score = ".intval($val)." WHERE id =".$key;
		$_SGLOBAL['db']->query($sql);
	}	

	$sql = "SELECT * FROM ".tname('app_ask_reply')." WHERE ask_id = $ask_id ";
	$query = $_SGLOBAL['db']->query($sql);
	$list = array( );
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$list[$value['uid']]['fen'] = intval($list[$value['uid']]['fen']) +  $value['score'];
		$list[$value['uid']]['username'] = $value['username'];
	}
	
	$arr_fedd_str = "";
	include_once(S_ROOT.'./source/function_cp.php');
	foreach ($list as $key => $val) {
		if (empty($val['fen'])) {
			continue;
		}
		updatecredit($key, $val['fen'], '+');
		
		$arr_fedd_str[] =  "<a href='space.php?uid={$key}'>{$val['username']}</a>: {$val['fen']} điểm";
		
		$message = "Trả lời đúng câu hỏi <a href=\"gohoohhoidap.php?do=ask&ac=view&id={$ask_id}\">{$ask['title']}</a> bạn sẽ được {$val['fen']} điểm";
    	notification_add($key, "app", $message );
	}
	
	$sql = "UPDATE ".tname("app_ask")." SET status='2', msg='". addslashes(implode(",", $arr_fedd_str))."' WHERE id = $ask_id ";
	$_SGLOBAL['db']->query($sql);
	
	
	//事件feed
	$fs = array();
	$fs['icon'] = 'gohoohhoidap';
    $fs['title_template'] = "{actor} xem câu hỏi <b>{subject}</b> trên GoHooH hỏi đáp". implode(",", $arr_fedd_str);
	
	$fs['title_data'] = array(
		'subject' => "<a href=\"gohoohhoidap.php?do=ask&ac=view&id={$ask_id}\">{$ask['title']}</a>"
	);
	$fs['body_template'] = '';
	$fs['body_data'] = array();
	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], $fs['friend']);
	
	
	showmessage("Dán câu hỏi thành công", $theurl);
}
elseif ('delete' == $op)
{
	$ask_id = intval($_GET['id']);
	if (empty($ask_id)) {
		showmessage("Tham số lỗi");
	}
	$sql = " select * from ".tname('app_ask')." where id = ".$ask_id." ";
	$query = $_SGLOBAL['db']->query( $sql );
	$info = $_SGLOBAL['db']->fetch_array( $query );
	if (empty($info))
	{
		showmessage("Thông tin không tồn tại hoặc đã bị xoá", 'gohoohhoidap.php?do=ask');
	}
	if ( $_SGLOBAL['supe_uid'] != $info['uid'] &&  $_SGLOBAL['supe_uid'] != ADMIN_ID ) {
		showmessage("Bạn không được phép xóa bỏ lời hỏi đáp này", 'gohoohhoidap.php?do=ask');
	}

	$sql = "DELETE FROM ".tname('app_ask')." WHERE id = {$ask_id} ";
	$query = $_SGLOBAL['db']->query($sql);
	$sql = "DELETE FROM ".tname('app_ask_reply')." WHERE ask_id = {$ask_id} ";
	$query = $_SGLOBAL['db']->query($sql);	
	showmessage("Đã xoá thành công!", "gohoohhoidap.php?do=ask", 0);
}
elseif ('replydelete' == $op)
{
	$ask_id = intval($_GET['ask_id']);
	$id = intval($_GET['id']);
	if (empty($ask_id) || empty($id)) {
		showmessage("Tham số lỗi");
	}

	$sql = " select * from ".tname('app_ask_reply')." where id = ".$id." ";
	$query = $_SGLOBAL['db']->query( $sql );
	$info = $_SGLOBAL['db']->fetch_array( $query );
	if (empty($info))
	{
		showmessage("Thông tin không tồn tại hoặc đã bị xoá", 'gohoohhoidap.php?do=ask');
	}
	if ( $_SGLOBAL['supe_uid'] != $info['uid'] &&  $_SGLOBAL['supe_uid'] != ADMIN_ID ) {
		showmessage("Bạn không được phép xóa bỏ lời hỏi đáp này", 'gohoohhoidap.php?do=ask');
	}

	$sql = "DELETE FROM ".tname('app_ask_reply')." WHERE id = {$id} ";
	$query = $_SGLOBAL['db']->query($sql);	
	showmessage("Đã xoá thành công!", "gohoohhoidap.php?do=ask&ac=view&id={$ask_id}");
}