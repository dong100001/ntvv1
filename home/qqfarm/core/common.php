<?php
# More plugins, skin, mod for Discuz, Ucenter Home at http://www.gohooh.com/forum/

@error_reporting(0);
define('FARM_SET', 1); //内部标示符,请勿修改
define('FARM_DEBUG', 1); //调试模式[=0:关闭|>0:记录MySQL错误|=2:记录PHP错误]
define('FARM_VERSION', '4.6 Final Build 20100712.2030'); //系统版本,请勿修改
define('FARM_ROOT', str_replace('\\', '/', dirname(__file__))); //QF安装路径
function_exists("date_default_timezone_set") && date_default_timezone_set('PRC');
chdir(FARM_ROOT);//切换工作目录

//for PHP of Version < 5.2.0
if(version_compare(PHP_VERSION, '5.2.0', '<')) {
	if(version_compare(PHP_VERSION, '5.0.0', '<')) {
		die('您的PHP版本不被支持');
	}
	include('source/json.func.php');
}

//加载缓存
include('source/cache.func.php');
qf_getCache('_QSC');
qf_getCache('_VIP');
qf_getCache('_NOTICE');

//全局变量
$_QFG = array();
$_QFG['uid'] = 0;
$_QFG['timestamp'] = time();

//加载公共函数
include('source/common.func.php');
error_reporting(FARM_DEBUG == 3 ? 2037 : 0);
FARM_DEBUG == 2 && set_error_handler('qf_error_handler');

//取消魔术引用
if(get_magic_quotes_gpc()) {
	$_GET = qf_stripslashes($_GET);
	$_POST = qf_stripslashes($_POST);
	$_COOKIE = qf_stripslashes($_COOKIE);
}
if(get_magic_quotes_runtime()) {
	set_magic_quotes_runtime(0);
}


///////////////////////////////////////////////////////////////////////

//加载接口配置
define('API_ROOT', 'api/' . $_QSC['apiType']);
include('config/api/'.$_QSC['apiType'].'.php');

//关闭农场提示
if($_QSC['closefarm'] == 0 && basename($_SERVER['PHP_SELF']) != 'admin.php') {
	qf_getView('closed');
	exit;
}

//连接数据库
include('source/mysql.class.php');
$_QFG['db'] = new dbstuff($_QSC['db']);
FARM_DEBUG ||$_QSC['db']->logFile = null;
if(isset($_QSC['db']['tbprefix'])) {
	$_QFG['db']->tbPrefix = array(
		array('app_qqfarm_', 'pap_tbpre_'),
		array($_QSC['db']['tbprefix'].'qqfarm_', $_QSC['db']['tbprefix'])
	); 
}

//加载接口函数
include(API_ROOT . '/main.php');

?>