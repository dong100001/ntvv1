<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/*
sqlin 
*/
class sqlin
{
//dowith_sql($value)
function dowith_sql($str)
{
   $str = str_replace("and","",$str);
   $str = str_replace("execute","",$str);
   $str = str_replace("update","",$str);
   $str = str_replace("count","",$str);
   $str = str_replace("chr","",$str);
   $str = str_replace("mid","",$str);
   $str = str_replace("master","",$str);
   $str = str_replace("truncate","",$str);
   $str = str_replace("char","",$str);
   $str = str_replace("declare","",$str);
   $str = str_replace("select","",$str);
   $str = str_replace("create","",$str);
   $str = str_replace("delete","",$str);
   $str = str_replace("insert","",$str);
   $str = str_replace("'","",$str);
   $str = str_replace(" ","",$str);
   $str = str_replace("or","",$str);
   $str = str_replace("=","",$str);
   $str = str_replace("%20","",$str);
   //echo $str;
   return $str;
}
//aticle()
function sqlin()
{
   foreach ($_GET as $key=>$value)
   {
       $_GET[$key]=$this->dowith_sql($value);
   }
   foreach ($_POST as $key=>$value)
   {
       $_POST[$key]=$this->dowith_sql($value);
   }
}
}
function getLevel($exp){
	$sum=0;
	$i=1;
	while($exp>=$sum){
		$sum+=$i*200;
		$i++;
	}
	return $i-2;
}
$dbsql=new sqlin();
include_once('../common.php');
if ( empty( $_SGLOBAL['supe_uid'] ) )
{
                echo "<script language=\"JavaScript\">\r\n"; 
				echo "alert( \"Vui lòng đăng nhập!\");\r\n"; 
                echo "location.href='../do.php?ac=login'";
                echo "</SCRIPT>-->";
}
$groupid  = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT groupid  FROM '.tname('space').' where uid='.$_SGLOBAL['supe_uid']),0);
if ($groupid != "1")
{
				echo "<script language=\"JavaScript\">\r\n"; 
				echo "alert( \"Vui lòng đăng nhập với tài khoản Admin\");\r\n"; 
                echo "location.href='../space.php?do=home'";
                echo "</SCRIPT>-->";
}
if ( $_REQUEST['id'] == "seeall" )
{
?>
<style type="text/css">
<!--
.STYLE1 {color: #0000FF}
.STYLE2 {	font-size: 20px;
	font-weight: bold;}
.STYLE3 {font-size: 14px}
.n{TEXT-DECORATION:none}
.pay_title{height:28px; line-height:28px; padding-left:10px; color:#C00000; font-size:12px; background-color:#ffff99; overflow:hidden; border-bottom:1px solid #ccc;}
.STYLE5 {
	font-size: 24px;
	color: #0000FF;
	font-weight: bold;
}
.STYLE6 {color: #C00000}
.STYLE7 {color: #0000FF}
-->
</style>
<div style="margin:5px; font-size:12px; color:#333333; border:1px solid #CCC000; margin-top:0px; padding-top:0px;">
  <div align="center"><span class="STYLE5">AdminCP Farm | <a target="blank" href="http://www.gohooh.com/">GoHooH.CoM</a></span>
  </div><br>
  <div class="pay_title">
  <div align="center"><span class="STYLE6">Note: ..................... </span><span style="margin-left: 40px;font-weight: bold; "><a href="admin.php">Back to Admin</a></span><span style="margin-left: 50px;font-weight: bold; "><a href="../newfarm.php">Back to Farm</a></span></div>
</div>
         <div align="center">
    <p class="STYLE2">Thông tin nông trại</p>
    <table width="860" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
      <tr align="center" bgcolor="#FFFFFF"> 
        <td width="80" bgcolor="#FFFFFF"><span class="STYLE1">ID người dùng</span></td>
        <td width="80" align="center" bgcolor="#FFFFFF"><span class="STYLE1">User Name</span></td>
        <td width="110" bgcolor="#FFFFFF"><span class="STYLE1"><a class=n href="admin.php?id=seeall&px=1&cc=exp"></a>Farm Level<a class=n href="admin.php?id=seeall&px=0&cc=exp"></a></span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1"><a class=n href="admin.php?id=seeall&px=1&cc=mc_exp"></a>Ranch Level<a class=n href="admin.php?id=seeall&px=0&cc=mc_exp"></a></span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1"><a class=n href="admin.php?id=seeall&px=1&cc=charm"></a>Charm Level<a class=n href="admin.php?id=seeall&px=0&cc=charm"></a></span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1"><a class=n href="admin.php?id=seeall&px=1&cc=reclaim"></a>Số đất<a class=n href="admin.php?id=seeall&px=0&cc=reclaim"></a></span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1"><a class=n href="admin.php?id=seeall&px=1&cc=money"></a>Money<a class=n href="admin.php?id=seeall&px=0&cc=money"></a></span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1"><a class=n href="admin.php?id=seeall&px=1&cc=fb"></a>Gee<a class=n href="admin.php?id=seeall&px=0&cc=fb"></a></span></td>
      </tr>
<?php 
       if ( $_REQUEST['px'] == "1" )
{ $query = $_SGLOBAL['db']->query( "SELECT uid,money,exp,mc_exp,fb,reclaim,charm FROM ".tname( "plug_newfarm" )." where uid order by ".$_REQUEST['cc']." desc"); }
       if ( $_REQUEST['px'] == "0" )
{ $query = $_SGLOBAL['db']->query( "SELECT uid,money,exp,mc_exp,fb,reclaim,charm FROM ".tname( "plug_newfarm" )." where uid order by ".$_REQUEST['cc']." asc"); }
while ( $value = $_SGLOBAL['db']->fetch_array( $query ))
{  
$username = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT username FROM '.tname('space').' where uid='.$value['uid']),0);
   $uid=$value['uid'];
   $reclaim=$value['reclaim'];
   $money=$value['money'];
   $fb=$value['fb'];
   $exp=$value['exp'];
   $nclevel=getLevel($exp);
   $mc_exp=$value['mc_exp'];
   $mclevel=getLevel($mc_exp);
   if ( $value['charm'] < 180 ) $charm=0;
   if ( $value['charm'] >= 180 && $value['charm'] < 440) $charm=1;
   if ( $value['charm'] >= 440 && $value['charm'] < 800) $charm=2;
   if ( $value['charm'] >= 800 && $value['charm'] < 1300) $charm=3;
   if ( $value['charm'] >= 1300 && $value['charm'] < 2000) $charm=4;
   if ( $value['charm'] >= 2000 && $value['charm'] < 2800) $charm=5;
   if ( $value['charm'] >= 2800 && $value['charm'] < 3750) $charm=6;
   if ( $value['charm'] >= 3750 && $value['charm'] < 5000) $charm=7;
   if ( $value['charm'] >= 5000 && $value['charm'] < 6500) $charm=8;
   if ( $value['charm'] >= 6500 && $value['charm'] < 8300) $charm=9;
   if ( $value['charm'] >= 8300 && $value['charm'] < 10400) $charm=10;
   if ( $value['charm'] >= 10400 ) $charm="lớn hơn 10";
   ?>

        <tr align="center" bgcolor="#FFFFFF"> 
        <td width="80" bgcolor="#FFFFFF"><?php echo  $uid; ?></td>
        <td width="120" bgcolor="#FFFFFF"><a href="../space.php?uid=<?php echo $uid;?>"><?php  echo $username; ?></a></td>
        <td width="110" bgcolor="#FFFFFF"><?php  echo $nclevel; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php  echo $mclevel; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php  echo $charm; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php echo $reclaim; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php echo $money; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php echo $fb; ?></td>
      </tr>
	 <?php  } ?>
  </table>
  </div>
  <br>
<?php
 exit();
      }
	?>

<?php
if ( $_REQUEST['user'] == "arr" )
{
	$query = $_SGLOBAL['db']->query( "SELECT uid FROM ".tname( "plug_newfarm" )."  ");
	while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
	{
		$_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set activity =".$_REQUEST['activity']." where uid=".$value['uid']);
	}
	echo "<script language=\"JavaScript\">\r\n"; 
	echo "alert( \"Sửa đổi thành công!\");\r\n"; 
	echo " history.back();\r\n"; 
	echo "</script>"; 
}
?>

<?php
if ( $_REQUEST['user'] == "pd" )
{
   $maxuid = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT uid FROM '.tname('plug_newfarm').' where uid='.$_REQUEST['uid'] ),0);
   if($maxuid != null)
   {
if ( $_REQUEST['id'] == "edit" )
{
if ( $_REQUEST['nclevel'] >= "0"&$_REQUEST['nclevel']!="Enter Number")
{
 
  $_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set exp=".$_REQUEST['nclevel']."*100+100*".$_REQUEST['nclevel']."*".$_REQUEST['nclevel']."  where uid=".$_REQUEST['uid']);
}

if ( $_REQUEST['mclevel'] >= "0"&$_REQUEST['mclevel']!="Enter Number")
{
 
  $_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set mc_exp=".$_REQUEST['mclevel']."*200+100*".$_REQUEST['mclevel']."*".$_REQUEST['mclevel']."-".$_REQUEST['mclevel']."*100  where uid=".$_REQUEST['uid']);
}

if ( $_REQUEST['mllevel'] != "Select Charm Level")
{
  $_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set charm=".$_REQUEST['mllevel']." where uid=".$_REQUEST['uid']);
}

  $_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set exp=exp+".$_REQUEST['exp']." , charm=charm+".$_REQUEST['charm']." , reclaim=reclaim+".$_REQUEST['reclaim']." , money=money+".$_REQUEST['money']." , fb=fb+".$_REQUEST['fb']." , mc_exp=mc_exp+".$_REQUEST['mc_exp']."   where uid=".$_REQUEST['uid']);
  $query = $_SGLOBAL['db']->query( "SELECT reclaim FROM ".tname( "plug_newfarm" )." where uid=".$_REQUEST['uid']);
while ( $value = $_SGLOBAL['db']->fetch_array( $query ))
{ if($value['reclaim']<6)
   {  
     $_SGLOBAL['db']->query("UPDATE ".tname('plug_newfarm')." set reclaim=reclaim-".$_REQUEST['reclaim']." where uid=".$_REQUEST['uid']);
     echo "<script language=\"JavaScript\">\r\n"; 
     echo "alert( \"Số đất trồng không được nhỏ hơn 6!\");\r\n"; 
     echo " history.back();\r\n"; 
     echo "</script>"; 
    }
 }
echo "<script language=\"JavaScript\">\r\n"; 
echo "alert( \"Change success!\");\r\n"; 
echo " history.back();\r\n"; 
echo "</script>"; 
}


if ( $_REQUEST['id'] == "see" )
{
$query = $_SGLOBAL['db']->query( "SELECT money,exp,mc_exp,fb,reclaim,charm FROM ".tname( "plug_newfarm" )." where uid=".$_REQUEST['uid']);
$username = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT username FROM '.tname('space').' where uid='.$_REQUEST['uid']),0);
$uid=$_REQUEST['uid'];
while ( $value = $_SGLOBAL['db']->fetch_array( $query ))
{   
   $uid=$value['uid'];
   $reclaim=$value['reclaim'];
   $money=$value['money'];
   $fb=$value['fb'];
   $exp=$value['exp'];
   $nclevel=getLevel($exp);
   $mc_exp=$value['mc_exp'];
   $mclevel=getLevel($mc_exp);
   if ( $value['charm'] < 180 ) $charm=0;
   if ( $value['charm'] >= 180 && $value['charm'] < 440) $charm=1;
   if ( $value['charm'] >= 440 && $value['charm'] < 800) $charm=2;
   if ( $value['charm'] >= 800 && $value['charm'] < 1300) $charm=3;
   if ( $value['charm'] >= 1300 && $value['charm'] < 2000) $charm=4;
   if ( $value['charm'] >= 2000 && $value['charm'] < 2800) $charm=5;
   if ( $value['charm'] >= 2800 && $value['charm'] < 3750) $charm=6;
   if ( $value['charm'] >= 3750 && $value['charm'] < 5000) $charm=7;
   if ( $value['charm'] >= 5000 && $value['charm'] < 6500) $charm=8;
   if ( $value['charm'] >= 6500 && $value['charm'] < 8300) $charm=9;
   if ( $value['charm'] >= 8300 && $value['charm'] < 10400) $charm=10;
   if ( $value['charm'] >= 10400 ) $charm="Lớn hơn 10";
?>
<style type="text/css">
<!--
.STYLE1 {color: #0000FF}
.STYLE2 {
	font-size: 20px;
	font-weight: bold;
}
.STYLE3 {color: #FF0000}
.STYLE4 {
	font-size: 13px;
	color: #0000FF;
}
.pay_title{height:28px; line-height:28px; padding-left:10px; color:#C00000; font-size:12px; background-color:#ffff99; overflow:hidden; border-bottom:1px solid #ccc;}
.STYLE5 {
	font-size: 24px;
	color: #0000FF;
	font-weight: bold;
}
.STYLE6 {color: #C00000}
.STYLE7 {color: #0000FF}
-->
</style>
<div style="margin:5px; font-size:12px; color:#333333; border:1px solid #CCC000; margin-top:0px; padding-top:0px;">
  <div align="center"><span class="STYLE5">AdminCP Farm  | GoHooH.CoM</span>
  </div><br>
  <div class="pay_title">
  <div align="center"><span class="STYLE6">Note: ....</span><span style="margin-left: 40px;font-weight: bold; "><a href="admin.php">Back To Admin</a></span><span style="margin-left: 50px;font-weight: bold; "><a href="../newfarm.php">Back To Farm</a></span></div>
</div>
<div align="center">
      <p class="STYLE2"><span class="STYLE3"><?php  echo $username; ?></span> Thông tin nông trại</p>
      <table width="750"><tr align="right"><td><span class="STYLE4"><a href="admin.php?id=seeall&cc=uid&px=0"> View all users</a></span></td>
      </tr></table>
      <table width="750" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
      <tr align="center" bgcolor="#FFFFFF"> 
        <td width="80" bgcolor="#FFFFFF"><span class="STYLE1">ID người dùng</span></td>
        <td width="120" bgcolor="#FFFFFF"><span class="STYLE1">User Name</span></td>
        <td width="80" bgcolor="#FFFFFF"><span class="STYLE1">Farm Level</span></td>
        <td width="80" bgcolor="#FFFFFF"><span class="STYLE1">Ranch Level</span></td>
        <td width="80" bgcolor="#FFFFFF"><span class="STYLE1">Charm Level</span></td>
        <td width="80" bgcolor="#FFFFFF"><span class="STYLE1">Số đất</span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1">Money</span></td>
        <td width="100" bgcolor="#FFFFFF"><span class="STYLE1">Gee</span></td>
		<td width="100" bgcolor="#FFFFFF">Back to modify the</td>
      </tr>
 <tr align="center" bgcolor="#FFFFFF"> 
        <td width="80" bgcolor="#FFFFFF"><?php echo $uid; ?></td>
        <td width="120" bgcolor="#FFFFFF"><a href="../space.php?uid=<?php echo $uid;?>"><?php  echo $username; ?></a></td>
        <td width="80" bgcolor="#FFFFFF"><?php  echo $nclevel; ?></td>
        <td width="80" bgcolor="#FFFFFF"><?php  echo $mclevel; ?></td>
        <td width="80" bgcolor="#FFFFFF"><?php  echo $charm; ?></td>
        <td width="80" bgcolor="#FFFFFF"><?php echo $reclaim; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php echo $money; ?></td>
        <td width="100" bgcolor="#FFFFFF"><?php echo $fb; ?></td>
		<td width="100" bgcolor="#FFFFFF"><a href="javascript:window.history.go(-1);">Sửa</a></td>
      </tr>
    </table>
</div>
  <?php
 }
   }
   ?>
 <br></div>  
<?php 
exit(); }
else{
echo "<script language=\"JavaScript\">\r\n"; 
echo "alert( \"No such user!\");\r\n"; 
echo " history.back();\r\n";
echo "</script>"; 
exit();}
}
if ( $_REQUEST['uid'] == null )
{
?>

<head>
<title>AdminCP Farm | GoHooH.CoM</title>
<style type="text/css">
.pay_title{height:28px; line-height:28px; padding-left:10px; color:#C00000; font-size:12px; background-color:#ffff99; overflow:hidden; border-bottom:1px solid #ccc;}
.STYLE22 {
	font-size: 24px;
	color: #0000FF;
	font-weight: bold;
}
.STYLE66 {color: #C00000; font-size: 13px;}
.STYLE77 {color: #0000FF}
</style>
</head>

<body>
<script language="javascript">
function   checkvalue()   
{
  uid=document.form1.uid.value;
  if(document.form1.uid.value == "ID người dùng")
	{
		alert("Vui lòng nhập ID người dùng");
		return false;
	}
  if(document.form1.uid.value == "")
	{
		alert("Vui lòng nhập ID người dùng");
		return false;
	}
  if(document.form1.uid.value.search("^-?\\d+(\\.\\d+)?$")!=0)
    {
        alert("User UID for digital!");
        return false;
    }	
window.open("admin.php?id=see&user=pd&uid="+uid,"_self","");
}
function checkdata()
  {
  if(document.form1.uid.value == "ID người dùng")
	{
		alert("Vui lòng nhập ID người dùng");
		return false;
	}
  if(document.form1.uid.value == "")
	{
		alert("Vui lòng nhập ID người dùng");
		return false;
	}
  if(document.form1.uid.value.search("^-?\\d+(\\.\\d+)?$")!=0)
   {
        alert("User UID for digital!");
        return false;
  }


   }
</script>

<script language="javascript">
function checkdata2()
  {
  if(document.form2.activity.value == "")
	{
		alert("Vui lòng nhập sự kiện!");
		return false;
	}


   }
</script>

<div style="margin:5px; font-size:13px; color:#333333; border:1px solid #CCC000; margin-top:0px; padding-top:0px;">
  <div align="center"><span class="STYLE22">AdminCP Farm | GoHooH.CoM</span>
  </div><br>
<div class="pay_title">
  <div align="center"><span class="STYLE77">Note:................</span><span style="margin-left: 40px;font-weight: bold; "><a href="admin.php?id=seeall&cc=uid&px=0">View all Farm User</a>
  </span><span style="margin-left: 55px;font-weight: bold; "><a href="../newfarm.php">Back To Farm</a></span>  </div>
</div>

<form id="form2" name="form2" method="post" action="admin.php?user=arr" OnSubmit="return checkdata2()" >
  <div align="center"><span style="margin:5px; font-size:13px; color:#333333; solid #CCC000; margin-top:0px; padding-top:0px;">
    <select name="activity" id="activity" >
      <option selected="">Select an activity holiday</option>
      <option value="0">Activities are not open</option>
      <option value="1">Crop Harvest Day</option>
      <option value="2">Experience Harvest Day</option>
      <option value="3">Charm Harvest Day</option>
      <option value="4">Crazy Weeding Day</option>
      <option value="5">Crazy debugging Day</option>
      <option value="6">Crazy watering day</option>
      <option value="7">Fertilizer Efficiency Day</option>
      <option value="8">Dogs Efficiency Day</option>
    </select>
    </span>
    <input type="submit"  class="button2" value="Change" />
  </div>
</form>

<form id="form1" name="form1" method="post" action="admin.php?id=edit&user=pd" OnSubmit="return checkdata()" >
<div align="center"><table width="850" border="0" cellspacing="1">
  <tr width="750">
    <td align="right" width="61"><span class="STYLE66">ID người dùng:</span></td>
	<td width="72" align="left"><input type="text" id="uid"  name="uid" class="input_key" size="10" onFocus="this.value='';this.focus()" value="1"/></td>
	<td width="657" align="left" ><span class="STYLE66"><a href="#" onClick="javascript:return checkvalue();">View this user ranch and farm information</a></span></td>
  </tr> </table>
  <table width="850" border="0" cellspacing="1">
<tr width="750">
<td width="86" align="right"><span class="STYLE66">Farm exp:</span></td>
<td width="70"><input  name="exp" type="text" class="input_key" id="exp"  value="0" size="8"/></td>
<td width="86" align="right" ><span class="STYLE66">Ranch exp:</span></td>
  <td width="70">
  <input  name="mc_exp" type="text" class="input_key" id="mc_exp" value="0" size="8"/>
  </td>
  <td width="86"align="right" ><span class="STYLE66">Charm:</span></td>
  <td width="70"><input  name="charm" type="text" class="input_key" id="charm" value="0" size="8"/></td>
  <td width="86" align="right" ><span class="STYLE66">Land :</span></td>
  <td width="70"><input  name="reclaim" type="text" class="input_key" id="reclaim"  value="0" size="8"/></td>
  <td width="86" align="right" ><span class="STYLE66">Money :</span></td>
  <td width="70"><input  name="money" type="text" class="input_key" id="money" value="0" size="8"/></td>
  <td width="86" align="right" ><span class="STYLE66">Gee:</span></td>
  <td width="70"><input name="fb" type="text" class="input_key" id="fb"  value="0" size="8" /></td>
  </tr>
  </table>
  <table width="850" border="0" cellspacing="1">
  <tr width="750" >
  <td width="160" align="right"><span class="STYLE66">
  Change Farm Level:</span></td>
  <td width="95" align="left">
  <input name="nclevel"  id="nclevel" type="text" value="Enter Number" size="14" onFocus="this.value='';this.focus()"  onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onafterpaste="this.value=this.value.replace(/[^\d]/g,'')" />
   </td>
  <td width="160" align="right"><span class="STYLE66">
 Change Ranch level:</span></td>
  <td width="95" align="left">
  <input name="mclevel"  id="mclevel" type="text" value="Enter Number" size="14" onFocus="this.value='';this.focus()"  onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onafterpaste="this.value=this.value.replace(/[^\d]/g,'')" />
  </td>
  <td width="160" align="right"><span class="STYLE66">
  Change Charm Level:</span></td>
  <td width="95" align="left">
      <select name="mllevel" id="mllevel" >
      <option selected="">Select Charm Level</option>
	  <option value="0">Charm 0 class</option>
      <option value="180">Charm 1</option>
      <option value="440">Charm 2</option>
      <option value="800">Charm 3</option>
      <option value="1300">Charm 4</option>
      <option value="2000">Charm 5</option>
      <option value="2800">Charm 6</option>
      <option value="3750">Charm 7</option>
      <option value="5000">Charm 8</option>
      <option value="6500">Charm 9</option>
      <option value="8300">Charm 10 </option>
      </select>
   </td>
   <td></td><td></td><td></td>
   </tr>
   </table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    <div align="center">
  <input type="submit"  class="button" value="Submit" />
  &nbsp;&nbsp;
      <input type="reset" value="Reset" />
    </div></div>
</form>
<?php } exit();  ?>