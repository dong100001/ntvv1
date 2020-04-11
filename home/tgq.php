<?php
$suijishu=rand(1,9);
require_once './common.php';
require_once './source/function_common.php';

include_once(S_ROOT.'./source/function_cp.php');
$icon = 'tgq';
if($suijishu==1){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==2){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==3){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==4){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==5){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==6){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==7){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==8){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
if($suijishu==9){
	$title_template = '{actor} chơi <a href="tgq.php">piano</a> tại nhà hát Opera <a href="http://www.gohooh.com " target="_blank">GoHooH</a>';
}
feed_add($icon, $title_template);


include template('tgq');

?>