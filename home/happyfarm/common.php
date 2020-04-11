<?php
/****************************************/
/*      Nông trại vui vẻ QQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com

//some global config
define('FARM_VERSION', '3.0');
define('FARM_ENCODE', 'UTF-8');//文件编码(UTF-8 or GBK)
define('FARM_BGSOUND', false);//是否显示播放器(开-true,关-false)
define('FARM_REALNAME', false);//是否开启实名认证(开-true,关-false)
define('FARM_ROOT', dirname(str_replace('\\', '/', __FILE__)));

//用绝对路径加载UCH的common.php
include_once(dirname(FARM_ROOT) . "/common.php");

//debug
//error_reporting(7);

//compatibility for PHP Version < 5.2.1
if(version_compare(PHP_VERSION, '5.2.1', '<')) {
	include_once(FARM_ROOT ."/include/json.php");
}

//返回字符串的unicode编码
function unicode_encode($input, $encoding = FARM_ENCODE) {
	$input = iconv($encoding, 'UCS-2BE', $input);
	$len = strlen($input);
	$output = '';
	for($i = 0; $i < $len-1; $i = $i+2) {
		$c1 = $input[$i];
		$c2 = $input[$i+1];
		if(ord($c1) > 0) {
			$s1 = base_convert(ord($c1), 10, 16);
			$output .= '\\u'.(hexdec($s1) > 0xF ? '' : '0').$s1;
			$s2 = base_convert(ord($c2), 10, 16);
			$output .= (hexdec($s2) > 0xF ? '' : '0').$s2;
		}
		elseif(ord($c2) < 127) {
			$output .= $c2;
		}
	}
	return $output;
}

//获取头像地址
function getheadPic($uid, $size='small') {
	global $_SCONFIG;
	$type = empty($_SCONFIG['avatarreal'])?'virtual':'real';
	if(empty($_SCONFIG['uc_dir'])) {
		return UC_API.'/avatar.php?uid='.$uid.'&size='.$size.'&type='.(empty($_SCONFIG['avatarreal'])?'virtual':'real');
	} 
	else {
		if(ckavatar($uid)) {
			return UC_API.'/data/avatar/'.avatarfile($uid, $size, $type);
		} 
		else {
			return UC_API."/images/noavatar_$size.gif";
		}
	}
}

//禁止访问
function farmdeny($return = 0) {
	global $_SGLOBAL, $_SCONFIG;
	$message = $msgkey = '';
	//站点是否关闭
	if($_SCONFIG['close'] && !ckfounder($_SGLOBAL['supe_uid']) && !checkperm('closeignore')) {
		$msgkey = empty($_SCONFIG['closereason']) ? 'site_temporarily_closed' : $_SCONFIG['closereason'];
	}
	//IP访问检查
	if(!$msgkey && (!ipaccess($_SCONFIG['ipaccess']) || ipbanned($_SCONFIG['ipbanned'])) && !ckfounder($_SGLOBAL['supe_uid']) && !checkperm('closeignore')) {
		$msgkey = 'ip_is_not_allowed_to_visit';
	}
	//检查是否登录
	if(!$msgkey && empty($_SGLOBAL['supe_uid'])) {
		$msgkey = 'to_login';
	}
	//要求实名认证
	if(!$msgkey && FARM_REALNAME && $_SCONFIG['realname'] && empty($_SGLOBAL['member']['namestatus'])) {
		$msgkey = 'no_privilege_realname';
	}
	//处理结果
	if($msgkey) {
		include_once(S_ROOT.'./language/lang_showmessage.php');
		$message = isset($_SGLOBAL['msglang'][$msgkey]) ? $_SGLOBAL['msglang'][$msgkey] : $msgkey;
		$message = preg_replace('/href=(\'|")([^(https?:)].+)(\'|")/iUs','href=\\1../\\2\\3', $message);
		$return || die($message);
	}
	return $message;
}

header("Cache-Control: no-cache, must-revalidate");

?>
