<?php

# More plugins, skin, mod for Discuz, Ucenter Home at http://www.gohooh.com/forum/

function qf_getFeed($type, $oid = 0) {
	global $_QFG;
	//应用链接
	$app = "<a href='qqfarm.php'>QQ Farm</a>";
	$nhatui = "<a target='blank' href='http://www.gohooh.com/nhatui/'>Nhà Tui</a>";
	//自己链接
	$actor = "<a href='qqfarm.php?uid={$_QFG['uid']}'>" . $_QFG['uname'] . "</a>";
	//好友链接
	if($oid > 0) {
		$owner = "<a href='qqfarm.php?uid={$oid}'>" . qf_getUserName($oid) . "</a>";
	}
	//事件信息
	switch($type) {
		case 'user_init':
			$title = "{$actor} chơi game nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstaus_clearweed1':
			$title = "{$actor} thu hoạch nông sản trong nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Mùa này bội thu rồi!";
			break;
		case 'farmlandstaus_clearweed2':
			$title = "{$actor} ghé thăm nông trại {$app} của {$owner} trên mạng xã hội {$nhatui}";
			$body = "Thêm bạn thêm vui!";
			break;
		case 'farmlandstatus_fertilize':
			$title = "{$actor} bán nông sản tại nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Tớ là nông dân chính hiệu.";
			break;
		case 'farmlandstatus_harvest':
			$title = "{$actor} gieo trồng nông sản tại nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_planting':
			$title = "{$actor} chơi game nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_scarify':
			$title = "{$actor} thu hoạch nông sản trong nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_spraying1':
			$title = "{$actor} ghé thăm nông trại {$app} của {$owner} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_spraying2':
			$title = "{$actor} gieo trồng nông sản tại nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_water1':
			$title = "{$actor} chơi game nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_water2':
			$title = "{$actor} thu hoạch nông sản trong nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_sale':
			$title = "{$actor} ghé thăm nông trại {$app} của {$owner} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		case 'farmlandstatus_saleall':
			$title = "{$actor} chơi game nông trại vui vẻ {$app} trên mạng xã hội {$nhatui}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
		default:
			$title = "{$type}";
			$body = "Hãy trở thành nông dân thực thụ";
			break;
	}
	return array($title, $body);
}

?>