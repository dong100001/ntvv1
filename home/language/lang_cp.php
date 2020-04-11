<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: lang_cp.php 12754 2009-07-17 08:57:12Z liguode $
	việt hóa bởi GoHooH.CoM
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['cplang'] = array(

'by' => 'Bởi',
	'tab_space' => ' ',
	'feed_comment_space' => '{actor} trả lời {touser} ở trên tường',
	'feed_comment_image' => '{actor} bình luận hình ảnh của {touser}',
	'feed_comment_blog' => '{actor} bình luận {blog} của {touser}',
	'feed_comment_poll' => '{actor} bình luận bình chọn của{touser}',
	'feed_comment_event' => '{actor} bình luận sự kiện của {touser}',
	'feed_comment_share' => '{actor} bình luận chia sẻ của {touser}',
	'share' => 'Share',
	'share_action' => 'chia sẻ',
	'note_wall' => 'viết lên <a href="\\1" target="_blank">tường</a> của bạn',
	'note_wall_reply' => 'trả lời <a href="\\1" target="_blank">bài viết</a> của bạn',
	'note_pic_comment' => 'bình luận <a href="\\1" target="_blank">ảnh</a> của bạn',
	'note_pic_comment_reply' => 'trả lời <a href="\\1" target="_blank">bình luận ảnh</a> của bạn',
	'note_blog_comment' => 'bình luận blog <a href="\\1" target="_blank">\\2</a>',
	'note_blog_comment_reply' => 'trả lời <a href="\\1" target="_blank">bình luận blog</a> của bạn',
	'note_poll_comment' => 'bình luận bình chọn <a href="\\1" target="_blank">\\2</a> của bạn',
	'note_poll_comment_reply' => 'trả lời<a href="\\1" target="_blank">bình luận bình chọn</a> của bạn',
	'note_share_comment' => 'bình luận <a href="\\1" target="_blank">chia sẽ của bạn</a>',
	'note_share_comment_reply' => 'trả lời <a href="\\1" target="_blank">bình luận chia sẻ</a> của bạn',
	'note_event_comment' => 'bình luận <a href="\\1" target="_blank">sự kiện</a> của bạn',
	'note_event_comment_reply' => 'trả lời <a href="\\1" target="_blank">bình luận sự kiện</a> của bạn',
	'note_show_out' => 'you last point on auction ranking board have been deducted after visiting your space',
	'note_space_bar' => 'Chúc mừng! Không gian của bạn đã được thiết lập yêu cầu như người khác',
'music_collection' => 'Album nhạc của bạn: <a href="space.php?uid=\\1&do=nhacnhatui&mview=mpage&mid=\\2" target="_blank">\\3</a>',
'music_topingfen' => '\\4 đánh giá album <a href="space.php?uid=\\1&do=nhacnhatui&mview=mpage&mid=\\2" target="_blank">\\3</a> của bạn.',
'music_topinglun' => 'bình luận album <a href="space.php?uid=\\1&do=nhacnhatui&mview=mpage&mid=\\2" target="_blank">\\3</a>',
'music_toshare' => 'Chia sẻ bài hát <a href="space.php?uid=\\1&do=nhacnhatui&mview=mpage&mid=\\2" target="_blank">\\3</a>. Mời bạn nghe thử!',

	'note_click_blog' => 'blog của bạn <a href="\\1" target="_blank">\\2</a> có một đánh giá',
	'note_click_thread' => 'thảo luận của bạn <a href="\\1" target="_blank">\\2</a> có một đánh giá',
	'note_click_pic' => '<a href="\\1" target="_blank">Ảnh</a> của bạn có một đánh giá',


	'wall_pm_subject' => 'Hi, Tớ mới viết lên tường nhà cậu nà',
	'wall_pm_message' => 'Tớ mới viết lên tường nhà cậu nà,[url=\\1]Click để xem[/url]',
	'note_showcredit' => 'tặng bạn \\1 đồng như một món quả để tăng <a href="space.php?do=top" target="_blank">thứ hạng của bạn</a> trên bảng tổng sắp',
	'feed_showcredit' => '{actor} tặng bạn {fusername} {credit} tiền để giúp tăng hạng trên <a href="space.php?do=top" target="_blank">Bảng tổng sắp</a>',
	'feed_showcredit_self' => '{actor} tăng {credit} tiền để tăng hạng trên <a href="network.php?ac=space&view=show" target="_blank">Bảng tổng sắp</a>',
	'feed_doing_title' => '{actor}:{message}',	'note_doing_reply' => ' <a href="\\1" target="_blank">trả lời</a>  status của bạn',
	'feed_friend_title' => '{actor} và {touser} trở thành bạn bè',
	'note_friend_add' => 'thành bạn của bạn',
	'note_poll_invite' => 'mời bình chọn cho <a href="\\1" target="_blank">\\2?/a>\\3 Bình chọn',
	'reward' => 'khen thưởng',
	'reward_info' => 'bình chọn và nhận \\1 tiền',
	'poll_separator' => '"?"',

	'feed_upload_pic' => '{actor} up lên ảnh mới',

	'feed_click_blog' => '{actor} gửi {click} cho {touser} ở blog {subject}',
	'feed_click_thread' => '{actor} gửi {click} cho {touser} ở bài {subject}',
	'feed_click_pic' => '{actor} gửi {click} cho ảnh của {touser}',


	'friend_subject' => '<a href="\\2" target="_blank">\\1 gửi yêu cầu kết bạn</a>',
	'comment_friend' =>'<a href="\\2" target="_blank">\\1 để lại bình luận</a>',
	'photo_comment' => '<a href="\\2" target="_blank">\\1 bình luận ảnh của bạn</a>',
	'blog_comment' => '<a href="\\2" target="_blank">\\1 bình luận blog của bạn</a>',
	'poll_comment' => '<a href="\\2" target="_blank">\\1 bình luận bầu chọn của bạn</a>',
	'share_comment' => '<a href="\\2" target="_blank">\\1 bình luận chia sẻ của bạn</a>',
	'friend_pm' => '<a href="\\2" target="_blank">\\1 gửi tin nhắn cho bạn</a>',
	'poke_subject' => '<a href="\\2" target="_blank">\\1 gửi bạn 1 tấm thiệp</a>',
	'mtag_reply' => '<a href="\\2" target="_blank">\\1 trả lời chủ để để bạn</a>',
	'event_comment' => '<a href="\\2" target="_blank">\\1 bình luận sự kiện của bạn</a>',

	'friend_pm_reply' => '\\1 trả lời tin nhắn của bạn',
	'comment_friend_reply' => '\\1 replied your wall message',
	'blog_comment_reply' => '\\1 trả lời bình luận blog của bạn',
	'photo_comment_reply' => '\\1 trả lời bình luận ảnh của bạn',
	'poll_comment_reply' => '\\1 trả lời bình luận bình chọn của bạn',
	'share_comment_reply' => '\\1 trả lời bình luận chia sẻ của bạn',
	'event_comment_reply' => '\\1 trả lời bình luận sự kiện của bạn',

	'invite_subject' => '\\1 mời bạn tham gia vào \\2 và trở thành bạn bè của nhau',
	'invite_massage' => '<table border="0">
		<tr>
		<td valign="top">\\1</td>
		<td valign="top">
		<h3>Hi, tớ là \\2. Tớ muốn mời bạn ghé thăm nhà của tớ \\3 .Và chúng ta có thể giữ liên lạc với nhau</h3><br>
		Chúng ta có thể chia sẻ âm nhạc, hình ảnh, blog và các thông tin của nhau<br>
		<br>
		<br>
		\\4
		<br><br>
		<strong>Click vào link bên dưới và bạn sẽ được tư động thêm vào danh sách bạn bè của tớ </strong><br>
		<a href="\\5">\\5</a><br>
		<br>
		<strong>Nếu bạn đã có tài khoản ở \\3 thì nhớ ghé thăm nhà của tớ tại:</strong><br>
		<a href="\\6">\\6</a><br>
		</td></tr></table>',

	'app_invite_subject' => '\\1 mời tham gia \\2 để giữ liên lạc và vui chơi ở \\3',
	'app_invite_massage' => '<table border="0">
		<tr>
		<td valign="top">\\1</td>
		<td valign="top">
		<h3>Hi,Tớ là \\2 Tớ đến từ \\3 đang chơi \\7 rất vui và muốn mời bạn tham gia </h3><br>
		<br>
		<br>
		\\4
		<br><br>
		<strong>Click vào link bên dưới để chập nhận lời mời kết bạn  \\7 </strong><br>
		<a href="\\5">\\5</a><br>
		<br>
		<strong>Nếu bạn đã có tài khoản ở \\3, vui lòng click vào link để ghé thăm nhà của tớ: </strong><br>
		<a href="\\6">\\6</a><br>
		</td></tr></table>',

	'feed_mtag_add' => '{actor} tạo nhóm mới {mtags}',
	'note_members_grade_-9' => 'khóa bạn tại <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a>',
	'note_members_grade_-2' => 'đặt bạn vào danh sách <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a>',
	'note_members_grade_-1' => 'khóa thảo luận của bạn tại <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a>',
	'note_members_grade_0' => 'chuyển bạn thành thành viên bình thường của <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a>',
	'note_members_grade_1' => 'chuyển bạn thành Super Start của<a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a>',
	'note_members_grade_8' => 'chuyển bạn thành mod của <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> ',
	'note_members_grade_9' => 'changed you to the Admin of <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a>',
	'feed_mtag_join' => '{actor} tham gia nhóm {mtag} ({field})',
	'mtag_joinperm_2' => 'Yêu cầu lời mời tham gia',
	'feed_mtag_join_invite' => '{actor} chấp nhận yêu cầu của {fromusername} tham gia nhóm {mtag} ({field})',
	'person' => 'person',
	'delete' => 'delete',


	'space_update' => '{actor} được hiển thị.',

	'active_email_subject' => 'Email kích hoạt của bạn',
	'active_email_msg' => 'Vui lòng copy và paste đường link vào trình duyệt, và kích hoạt email của bạn, <br>Link kích hoạt: <br><a href="\\1" target="_blank">\\1</a>',
	'share_space' => 'Chia sẻ khong gian',
	'note_share_space' => 'chia sẻ profile của bạn',
	'share_blog' => 'chia sẻ blog của bạn',
	'note_share_blog' => 'chia sẻ blog <a href="\\1" target="_blank">\\2</a> của bạn',
	'share_album' => 'chia sẻ album',
	'note_share_album' => 'Chia sẻ album <a href="\\1" target="_blank">\\2</a> của bạn',
	'default_albumname' => 'Album mặc định',
	'share_image' => 'chia sẻ hình ảnh',
	'album' => 'Album',
	'note_share_pic' => 'chia sẽ ảnh <a href="\\1" target="_blank">\\2</a> của bạn',
	'share_thread' => 'chia sẻ chủ đề',
	'mtag' => 'Nhóm',
	'note_share_thread' => 'chia sẻ chủ đề <a href="\\1" target="_blank">\\2</a> của bạn',
	'share_mtag' => 'chia sẻ một nhóm',
	'share_mtag_membernum' => 'tổng cộng {membernum} thành viên',
	'share_tag' => 'chia sẻ từ khóa',
	'share_tag_blognum' => 'Tổng cộng {blognum} blog',
	'share_link' => 'chia sẻ website',
	'share_video' => 'chia sẻ video',
	'share_music' => 'chia sẻ âm nhạc',
	'share_flash' => 'chia sẻ đoạn Flash',
	'share_event' => 'chia sẻ sự kiên',
	'share_poll' => 'chia sẻ bình chọn',
	'note_share_poll' => 'chia sẻ bình chọn của bạn<a href="\\1" target="_blank">\\2</a>',
	'event_time' => 'Thời gian sự kiện',
	'event_location' => 'Địa điểm sự kiện',
	'event_creator' => 'Tổ chức',
	'feed_task' => '{actor} hoàn thành nhiệm vụ {task}',
	'feed_task_credit' => '{actor} hoàn thành nhiệm vụ {task} nhận được {credit} Gyn',
	'the_default_style' => 'Style mặc định',
	'the_diy_style' => 'Tùy chỉnh Style',
	'feed_thread' => '{actor} tạo chủ đề mới',
	'feed_eventthread' => '{actor} tạo sự kiện mới',

	
	'feed_thread_reply' => '{actor} trả lời thảo luận {thread} của {touser}',
	'note_thread_reply' => 'trả lời thảo luận của bạn',
	'note_post_reply' => 'in <a href=\\"\\1\\" target="_blank">\\2</a> trả lời <a href=\\"\\3\\" target="_blank">bình luận</a> của bạn.',
	'thread_edit_trail' => '<ins class="modify">[Thảo luận \\1 \\2 đã được sửa]</ins>',
	'create_a_new_album' => 'tạo album mới',
	'not_allow_upload' => 'Không được upload',
	'get_passwd_subject' => 'Lấy lại mật khẩu truy cập',
	'get_passwd_message' => 'Click vào link bên dưới để reset lại mật khẩu, link chỉ có tác dụng trong 3 ngày.<br />\\1<br />(copy and paste the link into your browser if the link is not clickable)<br />.',
	'file_is_too_big' => 'File size is too big',
	'feed_blog_password' => '{actor} posted a new secret blog{subject}',
	'feed_blog' => '{actor} gửi Blog mới',
	'feed_poll' => '{actor} tạo bầu chọn',
	'note_poll_finish' => 'your poll<a href="\\1" target="_blank">\\2</a>has been closed,<a href="\\1" target="_blank">give your opinion</a>',
	'take_part_in_the_voting' => '{actor} bầu chọn cho đủ đề <a href="{url}" target="_blank">{subject}</a> của {touser} và nhận được {reward} ',
	'lack_of_access_to_upload_file_size' => 'Upload không thành công',
	'only_allows_upload_file_types' => 'Chỉ hỗ trợ ảnh dạng jpg, gif, png',
	'unable_to_create_upload_directory_server' => 'Không thể tạo thư mục trên server',
	'inadequate_capacity_space' => 'Không gian lưu trữ của bạn đã đầy, có thể mua thêm bằng thẻ magic',
	'mobile_picture_temporary_failure' => 'Không thể di chuyển hình ảnh',
	'ftp_upload_file_size' => 'Upload thất bại',
	'comment' => 'Bình luận',
	'upload_a_new_picture' => 'Ảnh mới đã tải lên',
	'upload_album' => 'Album đã tải lên',
	'the_total_picture' => 'tổng cộng \\1 ảnh',
	'feed_invite' => '{actor} mời {username} trở thành bạn bè',
	'note_invite' => 'chấp nhận yêu cầu kết bạn',
	'space_open_subject' => 'Please log in and design, give nice and clean look to your profile',
	'space_open_message' => 'hi, since long time you did not visited and respond some users, there are some pending tasks. visit and respond it here is you space link\\1space.php',
	'feed_space_open' => '{actor} xây nhà mới, hãy ghé thăm nhé',

	'feed_profile_update_base' => '{actor} Updated their basic information',
	'feed_profile_update_contact' => '{actor} Updated their contact details',
	'feed_profile_update_edu' => '{actor} Updated their Education detials',
	'feed_profile_update_work' => '{actor} Updated their work information',
	'feed_profile_update_info' => '{actor} Updated their personal information',
	
	'apply_mtag_manager' => 'would like to join <a href="\\1" target="_blank">\\2</a> reasons:\\3. (click here to access Contol panel) <a href="\\1" target="_blank"></a>',
	'feed_add_attachsize' => '{actor} used {credit} to obtain more space {size}, Now you can upload more image(stufff) (<a href="cp.php?ac=credit&op=addsize">I want to obtain too more space</a>)',

	
	'event'=>'Sự kiện',
	'event_set_delete' => 'Admin đã xóa sự kiện \\1',
	'event_set_verify' => 'Your event has been approved, visit <a href="\\1" target="_blank">\\2</a>',
	'event_set_unverify' => 'this event rejected by Admin <a href="\\1" target="_blank">\\2</a>',
	'event_set_recommend' => 'Your event featured, recommended to other users <a href="\\1" target="_blank">\\2</a>',
	'event_set_unrecommend' => 'Your event is not recommended by admin to other <a href="\\1" target="_blank">\\2</a>',
	'event_set_open' => 'This event is opened by Admin, <a href="\\1" target="_blank">\\2</a>',
	'event_set_close' => 'This event is closed by Admin, <a href="\\1" target="_blank">\\2</a>',
	'event_add' => '{actor} added new event',
	'event_feed_info' => '<strong>{title}</strong><br/>Location {province} {city} {location} <br/>Time{starttime} - {endtime}',
	'event_join' => '{actor} attending <a href="space.php?uid={uid}" target="_blank">{username}</a> event <a href="space.php?do=event&id={eventid}" target="_blank">{title}</a>',
	'event_join_member' => 'attending evcent <a href="\\1" target="_blank">\\2</a>',
	'event_quit_member' => 'not attending event <a href="\\1" target="_blank">\\2</a>',
	'event_join_verify' => 'waiting for approval <a href="\\1" target="_blank">\\2</a> quickly <a href="\\3" target="_blank">Approv</a>',
	'eventmember_set_verify' => 'you are approved to join this event <a href="\\1" target="_blank">\\2</a>',
	'eventmember_unset_verify' => 'for this event <a href="\\1" target="_blank">\\2</a> you are in waiting list',
	'eventmember_set_admin' => 'You have promoted to event <a href="\\1" target="_blank">\\2</a> Organizer',
	'eventmember_unset_admin' => 'You have been removed to event <a href="\\1" target="_blank">\\2</a> Organizer',
	'eventmember_set_delete' => 'You are not eligible to join <a href="\\1" target="_blank">\\2</a>',
	'event_feed_share_pic_title'=>'{actor} shared the new image to the event album',
	'event_feed_share_pic_info'=>'<b><a href="space.php?do=event&id={eventid}&view=pic" target="_blank">{title}</a></b><br/>total {picnum} images',
	'event_accept_invite' => 'you are invited to join event <a href="\\1" target="_blank">\\2</a> ',
	'event_accept_success' => 'attending this event now you can <a href="\\1" target="_blank">access this event</a>',

	//��ߣ�source/magic/*
	'magicunit' => 'unit',
	'magic_note_wall' => 'để lại <a href="\\1" target="_blank">bình luận</a>',
	'magic_call' => '\\1 you are in this magic board <a href="\\2" target="_blank">click here to View</a>',
	'magicuse_thunder_announce_title' => '<strong>{username} issued THUNDER Shout</strong>',
	'magicuse_thunder_announce_body' => 'Hi all of you.No I got the powerful space<br><a href="space.php?uid={uid}" target="_blank">Please visit and leave your foot prints at my space</a>',
	'magic_present_note' => 'give you one props  \\1, <a href="\\2">Please accept it, view here</a>',
	//common users will receive the upgrade props
	'upgrade_magic_award' => 'Congratulations! on your upgrade/high level Ranking \\1Accept the following props\\2',
	//System presented prop to user
	'present_user_magics' => 'System gifted you this props as reward \\1',
	'has_not_more_doodle' => 'You do not have Graffiti Zone',

	'do_stat_login' => 'Người dùng ghé thăm',
	'do_stat_add' => 'Thông tin',
	'do_stat_comment' => 'Bình luận chi tiết',
	'do_stat_space' => 'Thống kê không gian',
	'do_stat_login' => 'Khách ghé thăm',
	'do_stat_doing' => 'Hoạt động',
	'do_stat_blog' => 'Blog',
	'do_stat_pic' => 'Ảnh',
	'do_stat_poll' => 'Bình chọn',
	'do_stat_event' => 'Sự kiện',
	'do_stat_share' => 'Chia sẻ',
	'do_stat_thread' => 'Chủ để',
	'do_stat_docomment' => 'Comment back',
	'do_stat_blogcomment' => 'Bình luận blog',
	'do_stat_piccomment' => 'Bình luận Ảnh',
	'do_stat_pollcomment' => 'Bình luận bình chọn',
	'do_stat_pollvote' => 'Bình chọn',
	'do_stat_eventcomment' => 'Bình luận sự kiện',
	'do_stat_eventjoin' => 'Sự kiện cũ của tôi',
	'do_stat_sharecomment' => 'Chia sẻ bình luận',
	'do_stat_post' => 'Trả lời chủ đề',
	'do_stat_click' => 'Thống kê',
	'do_stat_wall' => 'Tường',
	'do_stat_poke' => 'Poke',
);

?>