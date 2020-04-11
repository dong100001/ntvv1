<?php
include_once('../common.php');

//·µ»ØÀà
Class result
{
	public $status=1;
	public $msg="asdfasd";
};
function getStayTime($dateParkStartTime)  //0Äê0ÔÂ1ÈÕ10Ê±0·Ö
{

  $nowtime=date("Y-m-d H:i:s"); 
  $time_diff=abs(strtotime($nowtime)-strtotime($dateParkStartTime));
  $diff_time = array(); 
  $diff_time["year"] = 0;
  if($time_diff > 31536000) //Ò»Äê31536000Ãë
    $diff_time["year"] = floor($time_diff / 31536000);
  $time_diff = $time_diff - $diff_time["year"] * 31536000;
  $diff_time["month"] = 0;
  if($time_diff > 2592000) //Ò»ÔÂ2592000Ãë
    $diff_time["month"] = floor($time_diff / 2592000);
  $time_diff = $time_diff - $diff_time["month"] * 2592000;
  $diff_time["day"] = 0;
  if($time_diff > 86400) //Ò»Ìì86400Ãë
    $diff_time["day"] = floor($time_diff / 86400);
  $time_diff = $time_diff - $diff_time["day"] * 86400;  
  $diff_time["hour"] = 0;
  if($time_diff > 3600) //Ò»Ð¡Ê±3600Ãë
    $diff_time["hour"] = floor($time_diff / 3600);
  $time_diff = $time_diff - $diff_time["hour"] * 3600;    
  $diff_time["minute"] = 0;
  if($time_diff > 60) //Ò»·Ö60Ãë
    $diff_time["minute"] = floor($time_diff / 60);
  $time_diff = $time_diff - $diff_time["minute"] * 60;     
   $diff_time["sencond"] = floor($time_diff);
   
  if($diff_time["day"]==0) {
      $diff_time["strday"]="";
	  if($diff_time["hour"]==0){
	    $diff_time["strhour"]="";
	    if($diff_time["minute"]==0){
		   $diff_time["strminute"]="";
	       if($diff_time["second"]==0 ){
		      $diff_time["strsecond"]=""; 
			}else{
			   $diff_time["strsecond"]=$diff_time["second"].'giây';
			} 		   
		 }else{
		   $diff_time["strminute"]=$diff_time["minute"].'phút'; 
		 }		
	  }else{
	    $diff_time["strhour"]=$diff_time["hour"].'giờ';
	  }
	}else {
 	  $diff_time["strday"]=$diff_time["day"].'ngày';
	}
   
  $retStr=$diff_time["strday"].$diff_time["strhour"].$diff_time["strminute"].$diff_time["strsencond"];
  if(empty($retStr)) $retStr="bây giờ";
  return $retStr;
} 
$myresult = new result;     //·µ»Ø½á¹û¶ÔÏóÊµÀý
$myresult->msg="<ul>";
$op=empty($_GET[op])?"0":$_GET[op];

if($op==1){
   $sql="SELECT * FROM ".tname('feed')." WHERE uid=".$_SGLOBAL['supe_uid']." and (icon='park' or icon='drive') ORDER BY dateline DESC LIMIT 0,10";
}elseif($op==2){
   $sql="SELECT * FROM ".tname('feed')." WHERE uid in (select uid  from ".tname('friend')." where fuid=".$_SGLOBAL['supe_uid'].") and icon='park' ORDER BY dateline DESC LIMIT 0,10";
}elseif($op==3){
   $sql="SELECT * FROM ".tname('feed')." WHERE uid=".$_SGLOBAL['supe_uid']." and icon='stick' ORDER BY dateline DESC LIMIT 0,10";
}else{
  showmessage("Data call failed");
}
$feedlist = array();
if(ckprivacy('feed')) {
	$query = $_SGLOBAL['db']->query($sql);
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		if(ckfriend($value)) {
			realname_set($value['uid'], $value['username']);
			$feedlist[] = $value;
		}
	}
	$feednum = count($feedlist);
}

foreach ($feedlist as $key => $value) {
	$feedlist[$key] = mkfeed($value);
	$dateline=date('Y-m-d H:i:s',$value[dateline]);
	$dateline=getStayTime($dateline)."Ç°";
	$myresult->msg.='<LI style="CLEAR: both; PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; OVERFLOW: hidden; PADDING-TOP: 5px; BORDER-BOTTOM: #f0f0f0 1px dotted">';
	$myresult->msg.='<LABEL  style="PADDING-LEFT: 20px; BACKGROUND: url('.$feedlist[$key][icon_image].') no-repeat left center; FLOAT: left; WIDTH: 450px">'.$feedlist[$key][title_template];
	$myresult->msg.='</LABEL> ';
	$myresult->msg.='<LABEL  style="FLOAT: right; COLOR: gray"><span class="time">'.$dateline.'</span></LABEL>';
	$myresult->msg.='</LI>';

}
$myresult->msg.='</UL>';
$myresult->msg=$myresult->msg;
//$json_result = json_encode($myresult);
echo $myresult->msg;
?>


