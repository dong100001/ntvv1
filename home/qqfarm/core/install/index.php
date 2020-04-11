<?php
/* 【安装工具】
 *     请将此文件放在 x/qfarm/core/install/
 *     浏览器里运行 http://您的域名/x/qfarm/core/install/
 */

@header('Content-Type:text/html; charset=utf-8');
@header('Cache-Control: no-cache, must-revalidate');

chdir('../');
if(!file_exists('config/_qsc.php')) {
	die('Path lỗi, xin vui lòng tải lên các tập tin cài đặt */qfarm/core/install/ để tiếp tục');
}

if(file_exists('data/install.lock')) {
	die('Cài đặt là bị cấm, xin vui lòng xóa */qfarm/core/data/install.lock');
}

if(!$sql = @file_get_contents('install/qfarm.sql')) {
	die('Đọc dữ liệu không thành công, xin vui lòng tải lên tập tin dữ liệu qfarm.sql vào trong */qfarm/core/install/ ');
}


include_once('common.php');
if(runquery($sql)) {
	touch('data/install.lock');
	echo "Cài đặt thành công, xin vui lòng xóa các thư mục sau đây và các tập tin：*/qfarm/core/install/ Bạn đang dùng gói cài đặt Nông trại vui vẻ Version GoHooH Gold 1 tại http://www.gohooh.com/";
} else {
	echo 'Cài đặt không thành công, các lỗi SQL thực hiện tuyên bố, thông tin thêm xem */qfarm/core/data/#mysql_error.log';
}

///////////////////////////////////////////////////////////////////////////
# 支持函数

function runquery($sql) {
	global $_QFG, $_QSC;
	$dbcharset = $_QSC['db']['charset'];
	//构造SQL查询
	$num = 0;
	$query = array();
	$sql = explode(";\n", str_replace("\r", "\n", $sql));
	array_pop($sql);
	foreach($sql as $v) {
		$vs = explode("\n", trim($v));
		foreach($vs as $v) {
			$query[$num] .= $v[0] == '#' || $v[0].$v[1] == '--' ? '' : $v;
		}
		$num++;
	}
	unset($sql);
	//执行SQL查询
	foreach($query as $sql) {
		if($sql = trim($sql)) {
			$tbName = '';
			if(strtoupper(substr($sql, 0, 12)) == 'CREATE TABLE') {
				//设置表的引擎、字符集
				$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
				$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
				$sql  = preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql);
				$sql .= mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=$dbcharset" : " TYPE=$type";
				//取得表的名称
				$tbName = preg_replace("/CREATE TABLE IF NOT EXISTS ([a-z0-9_]+) .*/is", "\\1", str_replace('`', '', $sql));
				$tbName = str_replace('app_', $_QSC['db']['tbprefix'], $tbName);
			}
			if($_QFG['db']->query($sql)) {
				if($tbName) echo "<p>Tạo bảng： {$tbName}</p>";
			}
			else {
				return false;
			}
		}
	}
	return true;
}

?>