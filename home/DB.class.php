﻿<?php 

/*********************/
/*                   */
/*  Version : 1.0.0  */
/*	GoHooH.CoM		 */
/*********************/

class DBAccess {

//Ucenter Home ���ò��� 

private $dbhost= 'localhost';

//��������ַ 

private $dbuser= 'username';

//�û� 

private $dbpw= 'password';

 //���� 

private $dbname= 'dbname';

//���ݿ� 

public  $con="";

public $result=array();

public $query ;

public $sql;

//__construct(),���캯��,�������ݿ������ 

function __construct(){

$this -> con = @mysql_connect ($this -> dbhost,$this -> dbuser, $this -> dbpw);


mysql_select_db($this -> dbname,$this->con);

mysql_query("SET NAMES gbk");


} 

//__destruct�������������Ͽ����� 

function __destruct(){

mysql_close($this->con);




} 

//ִ����� 

function query($sql){


return mysql_query($sql);


} 

//���ؽ���� ARRAY 

function fetch_all($sql) {

$arr = array();

$query = $this->query($sql);

while($data = $this->fetch_array($query)) {

$arr[] = $data;


} 

return $arr;


} 

function fetch_array($query) {

return @mysql_fetch_array($query);

} 



function fetch_first($sql) {

$query = $this->query($sql);

return $this->fetch_array($query);


} 



function first($sql) {


$query = $this->query($sql);

$query = $this->fetch_array($query);

return $query [0];


} 


} 

?>
