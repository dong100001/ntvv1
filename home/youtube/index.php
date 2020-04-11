﻿<?php
include("config.php");
include("functions.php");
$dz = explode("/",$_SERVER['PATH_INFO']);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uchome youtube video download</title>
<style type="text/css">
body {padding:1px;margin: 0px;color: #333;font-size: 11px;font-family: arial, helvetica, sans-serif;background-color:#ffffff;}
img{border:0px;}
h2 {border-left: 10px solid #636563;font-size: 18px;padding:5px;margin:5px;}
a{color: #000000;text-decoration: none; font-weight:bold}
a:hover{text-decoration: none;color: #cc0000;}
.content {padding:0px;border: #9c9c9c 1px solid;background: #fff;margin:auto;}
.mytop { height:52px;padding:5px 0px 0px 2px; background-color:#000000;margin: 0px;}
.mytop h1{font-size: 26px;padding: 10px 26px 10px 26px;color: #ffffff;text-decoration:none;margin:0px;}
.mytop h1 a {text-decoration:none;color:#fff;}
.center {padding:5px 2px 5px 5px;float: left;margin: 0px;width: 750px;}
.left {padding:5px 2px 5px 5px;float: right;margin: 0px;width: 150px;}
.footer {background-color:#ffffff;text-align: center;color:#fff;clear: both;padding: 10px 0px 0px 10px;
margin:10px 0px 0px 0px;border-top: #FFFFFF 2px dashed;min-height:20px;}
#results{border-bottom:#ffffff 1px dashed; padding:5px; font-size:12px;float:left; height:150px;}
</style>
<script>function mousOverImage(name,id,nr){if(name)imname = name;imname.src = "http://img.youtube.com/vi/"+id+"/"+nr+".jpg";nr++;if(nr > 3)nr = 1;timer =  setTimeout("mousOverImage(false,'"+id+"',"+nr+");",1000);}</script>
</head>
<body>
<img src="http://www.gohooh.com/nhatui/image/app/youtube.gif"> Tìm kiếm , xem, download video trên Youtube miễn phí
<div class="content">
<div class="mytop"><h1><a>Ucenter home - YouTube Home</a></div></h1></div>
<div class="center">
<div align="center">
<form action="<?=$_URL;?>/index.php" id="content" method="post" name="v">
<div><?=$_text['lang01'];?></div><input name="search_query" value="<?=urldecode($_GET['search_query']);?>" type="text" style="width:200px; font-size:16px; font-weight:bold" />
<input name="search" type="hidden" value="v" />
<input name="" value="<?=$_text['lang02'];?>" type="submit" /></form>
</div>
<?php
    if((isset($_POST['search'])) || ($dz['1']=="search")){if(isset($_POST['search'])){$_POST['search_query']=$_POST['search_query'];}else{$_POST['search_query']=$dz['2'];}if (empty($_POST['search_query'])){echo "<div id=\"error\">".$_text['lang04']."</div>";}else{
    ?>
<h2><?=$_text['lang03']." ".$_POST['search_query'];?></h2>
<div id="allres">
    <?php
    $_out=get_vid(urlencode($_POST['search_query']),'50');
    $_n=count($_out);
    for($i=0;$i<$_n;$i++)
      {
    echo "<div id=\"results\"> <a href=\"".$_URL."/index.php/view/".$_out[$i]['id']."\"><img src=\"".($_out[$i]['thumb'])."\"  onmouseout=\"clearTimeout(timer)\"  onmouseover=\"mousOverImage(this,'".$_out[$i]['id']."','1')\"><p>".substr($_out[$i]['title'],0,20)."</p></a> </div>";
      }
    ?>
    </div>
    <?php
      }}if($dz['1']=="view"){youtube_t($dz['2']);}if((empty($dz['1'])) && (empty($_POST['search']))){$_out=get_vid($_dv,"20");$_n=count($_out);for($i=0;$i<$_n;$i++){echo "<div id=\"results\"> <a href=\"".$_URL."/index.php/view/".$_out[$i]['id']."\"><img src=\"".($_out[$i]['thumb'])."\"  onmouseout=\"clearTimeout(timer)\"  onmouseover=\"mousOverImage(this,'".$_out[$i]['id']."','1')\"><p>".substr($_out[$i]['title'],0,20)."</p></a> </div>";}}
?></div>
<div class="left"></div>
<div class="footer"></div></div>
</body></html>