<?php 

/*********************/
/*                   */
/*  Version : 1.0.0  */
/*	GoHooH.CoM		 */
/*********************/

class DBAccess {

//Ucenter Home 配置参数 

private $dbhost= 'localhost';

//服务器地址 

private $dbuser= 'username';

//用户 

private $dbpw= 'password';

 //密码 

private $dbname= 'dbname';

//数据库 

public  $con="";

public $result=array();

public $query ;

public $sql;

//__construct(),构造函数,建立数据库的连接 

function __construct(){

$this -> con = @mysql_connect ($this -> dbhost,$this -> dbuser, $this -> dbpw);


mysql_select_db($this -> dbname,$this->con);

mysql_query("SET NAMES gbk");


} 

//__destruct：析构函数，断开连接 

function __destruct(){

mysql_close($this->con);




} 

//执行语句 

function query($sql){


return mysql_query($sql);


} 

//返回结果集 ARRAY 

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
