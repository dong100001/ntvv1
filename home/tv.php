<?php
// Mod xem TV online V1 cho Ucenter Home Power by GoHooH.CoM
// GoHooH.CoM không có bất kỳ liên quan nào đến các kênh TV
// Vui lòng giữ bản quyền của GoHooH.CoM & và bản quyền TV
include_once('./common.php');
$gohoohtv = isset($_GET['gohoohtv'])?$_GET['gohoohtv']:'index';
include_once(S_ROOT.'./source/function_cp.php');
include template('tv');
$avatar = UC_API."/data/avatar/".comGetAvatar($space[uid], $size);
?>