<?php

include_once 'ClassParkInfo.php'; 
$fID=intval($_POST['fId']);
$uid=intval($_POST['my_sig_uId']);
$carID=intval($_POST['carId']);
$lot=intval($_POST['carpos']);
$stopCar=new CstopCar($uid,$fID,$lot,$carID);

echo '<?xml version="1.0" encoding="utf-8" ?> ';
echo "<root>";
echo "<carmessages>".$stopCar->carmessages."</carmessages>"; 
echo "<carerrorstr>".$stopCar->carerrorstr."</carerrorstr>"; 
echo "</root>";
//ob_start();
//var_dump($_REQUEST);
//$content=ob_get_contents();
//ob_end_clean();
//$p=$content;
//$test=$stopCar->newrec;
//$_SGLOBAL['db']->query("insert into test (test) value ('$test')"); 
?>