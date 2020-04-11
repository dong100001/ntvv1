<?php
# More plugins, skin, mod for Discuz, Ucenter Home at http://www.gohooh.com/forum/

include('common.php');
header('Content-Type:text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

//检查登录状态
if($auth = qf_checkauth()) {
	die($auth);
}

//新用户检查
if(!$_QFG['db']->result("SELECT uid FROM app_qqfarm_mc where uid=" . $_QFG['uid'])) {
	include("source/mc/user_init.php");
}


//定义允许访问的模块
$mod_list = array(
	'cgi_buy_animal', //买动物
	'cgi_clear_log', //清空日志
	'cgi_demolish_pasture', //放蚊子
	'cgi_enter', //牧场初始化
	'cgi_fight', //抓老鼠
	'cgi_feed_food', //帮自己、好友加草
	'cgi_feed_special', //萝卜饲养
	'cgi_get_animals', //牧场商店
	'cgi_get_exp', //好友动作提示
	'cgi_get_food', //买草
	'cgi_get_notice2', //牧场公告
	'gb_buy', //元宝购买
	'cgi_get_items', //装饰商店
	'cgi_buy_food', //金币买草
	'cgi_buy_item', //金币买装饰
	'cgi_get_useritem', //我的装饰
	'cgi_active_item', //装饰牧场
	'cgi_get_repertory', //仓库上锁
	'cgi_get_repertory_animal', //牧场仓库
	'cgi_get_package', //牧场食物
	'cgi_get_parade', //读取队行
	'cgi_get_toollist', //道具商店
	'cgi_get_user_info', //牧场日志
	'cgi_harvest_product', //动物收成
	'cgi_help_pasture', //拍蚊子和扫便便
	'cgi_post_product', //动物生产
	'cgi_sale_product', //卖出产品
	'cgi_set_parade', //设置队行
	'cgi_steal_product', //偷动物
	'cgi_up_animalhouse', //升级房子-入库
	'cgi_up_animalhouse_query', //升级房子
	'cgi_up_task_1', //新手任务1
	'cgi_up_task_2', //新手任务2
	'chat_clearchat', //清空留言
	'chat_getallinfo', //牧场留言
	'chat_sendchat', //给好友留言
	'friend', //好友列表
	'cgi_get_gifts', //VIP礼品提示
	'cgi_accept_gift', //领取礼包
	'cgi_feedcan', //喂养罐头
	'cgi_farm_exchange', //牧场消费
	'cgi_raise_cub', //牧场放动物
	'cgi_donate_animal'//捐赠动物
);

//特殊mod参数映射
$mod_map = array(
	'cgi_clear_log?' => 'cgi_clear_log',
	'cgi_enter?' => 'cgi_enter',
	'cgi_get_repertory?target=animal' => 'cgi_get_repertory_animal',
	'cgi_get_user_info?' => 'cgi_get_user_info'
);

//构造模块名称
$mod_name = $_REQUEST['mod'] ? $_REQUEST['mod'] : '';
if(array_key_exists($mod_name, $mod_map)) {
	$mod_name = $mod_map[$mod_name];
} else {
	$mod_name .= $_REQUEST['act'] ? '_' . $_REQUEST['act'] : '';
}
$mod_name = strtolower($mod_name);

//加载模块
if(in_array($mod_name, $mod_list)) {
	qf_getCache('animaltime', '/mc/');
	qf_getCache('animaltype', '/mc/');
	qf_getCache('itemtype', '/mc/');
	qf_getCache('toolstype', '/mc/');
	include("source/mc/mod/{$mod_name}.php");
} elseif(FARM_DEBUG) {
	error_log($mod_name . "\r\n", 3, 'data/logs/#mcmod_deny.log');
}

?>