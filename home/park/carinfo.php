<?php
include_once 'ClassParkInfo.php'; 
$uid=$_POST['uId'];
$myCar= new CmyCar($uid);
$arrMycar=$myCar->arrMyCar;

echo '<?xml version="1.0" encoding="utf-8" ?> ';
echo "<root>";
echo "<loginUser>".$myCar->loginuser."</loginUser>"; 
for($i=0;$i<count($arrMycar);$i++){
echo "<mycar>"; 
echo "<carimg>".$arrMycar[$i]['carimg']."</carimg>"; 
echo "<carid>".$arrMycar[$i]['carid']."</carid>"; 
$desc=$arrMycar[$i][parkStatus].",".$arrMycar[$i]['parktime'].",".$arrMycar[$i]['parkCredit'];
echo "<cardescript>".$desc."</cardescript>"; 
echo "</mycar>";
}
echo "</root>";


?>
