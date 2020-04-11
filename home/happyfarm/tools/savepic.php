<?php
# Modify by http://www.gohooh.com/

include_once('../common.php');
header("Content-Type:text/html; charset=" . FARM_ENCODE);

if($farmdeny_msg = farmdeny(1)) {
	die('{"error":"'.$farmdeny_msg.'","errno":"-900"}');
}

//过滤SQL关键字, 运行一次后直接释放资源
include_once(FARM_ROOT . '/include/sqlin.php');
$dbsql = new sqlin() && $dbsql = null;

//加载UCH图片处理函数
include_once(S_ROOT.'./source/function_image.php');

//定义快照保存相册
$FARM_ALBUMNAME = 'Nông trại vui vẻ';

$get_file = sreadfile('php://input');
$filepath = getfilepath('jpg', true);
$new_name = $_SC['attachdir'].'./'.$filepath;

if(swritefile(S_ROOT.$new_name, $get_file)) {
	$tmp_imagesize = @getimagesize(S_ROOT.$new_name);
	list($tmp_width, $tmp_height, $tmp_type) = (array)$tmp_imagesize;
	$tmp_size = $tmp_width * $tmp_height;
	if($tmp_size > 16777216 || $tmp_size < 4 || empty($tmp_type) || strpos($tmp_imagesize['mime'], 'flash') > 0) {
		@unlink(S_ROOT.$new_name);
		echo "{\"error\":\"\u5BF9\u4E0D\u8D77\uFF0C\u4FDD\u5B58\u5931\u8D25\uFF0C\u6587\u4EF6\u65E0\u6CD5\u4FDD\u5B58\",\"errno\":\"-900\"}";
		exit;
	}
	#make thumb
	$thumbpath = @makethumb(S_ROOT.$new_name);
	$thumb = empty($thumbpath)?0:1;
	#get album
	$albumid = getalbums($_SGLOBAL['supe_uid'], $FARM_ALBUMNAME);
	if(!(intval($albumid) > 0)) {
		#make album
		$setarr = array();
		$setarr['albumname'] = $FARM_ALBUMNAME;
		$setarr['uid'] = $_SGLOBAL['supe_uid'];
		$setarr['username'] = $_SGLOBAL['supe_username'];
		$setarr['dateline'] = $setarr['updatetime'] = $_SGLOBAL['timestamp'];
		$setarr['friend'] = 0;
		$setarr['password'] = "";
		$setarr['target_ids'] = "";
		$setarr['picnum'] = 1;
		$setarr['pic'] = $filepath.".thumb.jpg";
		$setarr['picflag'] = 1;
		$albumid = inserttable('album', $setarr, 1);
	}
	else {
		$albumtop = $filepath.".thumb.jpg";
		$_SGLOBAL['db']->query("UPDATE ".tname("album")." set picnum=picnum+1,pic='{$albumtop}' where albumid={$albumid}");
	}
	#insert photo
	$picarr['albumid'] = $albumid;
	$picarr['uid'] = $_SGLOBAL['supe_uid'];
	$picarr['dateline'] = $_SGLOBAL['timestamp'];
	$picarr['postip'] = getonlineip();
	$picarr['filename'] = FARM_ENCODE == "UTF-8" ? $_GET['picname'] : iconv("UTF-8", FARM_ENCODE, $_GET['picname']);
	$picarr['title'] = FARM_ENCODE == "UTF-8" ? $_GET['desc'] : iconv("UTF-8", FARM_ENCODE, $_GET['desc']);
	$picarr['type'] = "image/pjpeg";
	$picarr['size'] = $tmp_size;
	$picarr['filepath'] = $filepath;
	$picarr['thumb'] = $thumb;
	$picarr['username'] = $_SGLOBAL['supe_username'];
	$picid = inserttable('pic', $picarr, 1);
	echo "{\"url\":\"../space.php?uid={$_SGLOBAL['supe_uid']}&do=album&picid={$picid}\", \"albumid\":\"{$albumid}\", \"lloc\":\"M9ovAADVC0KTpe8xDSNj767GjkUUFRYAAA!!\"}";
	exit;
}
else {
	echo "{\"error\":\"\u5BF9\u4E0D\u8D77\uFF0C\u4FDD\u5B58\u5931\u8D25\uFF0C\u6587\u4EF6\u65E0\u6CD5\u4FDD\u5B58\",\"errno\":\"-900\"}";
	exit;
}


//get upload file name & some path
function getfilepath($fileext, $mkdir = false) {
	global $_SGLOBAL, $_SC;
	$filepath = "{$_SGLOBAL['supe_uid']}_{$_SGLOBAL['timestamp']}".random(4).".{$fileext}";
	$name1 = gmdate('Ym');
	$name2 = gmdate('j');
	if($mkdir) {
		$newfilename = S_ROOT.$_SC['attachdir'].'./'.$name1;
		if(!is_dir($newfilename)) {
			if(!@mkdir($newfilename)) {
				return $filepath;
			}
		}
		$newfilename .= '/'.$name2;
		if(!is_dir($newfilename)) {
			if(!@mkdir($newfilename)) {
				return $name1.'/'.$filepath;
			}
		}
	}
	return $name1.'/'.$name2.'/'.$filepath;
}

//get define albumname's id
function getalbums($uid, $albumname) {
	global $_SGLOBAL;
	$albumid = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT albumid FROM ".tname('album')." WHERE uid='{$uid}' AND albumname='{$albumname}' ORDER BY albumid ASC LIMIT 1"), 0);
	return $albumid;
}
?>