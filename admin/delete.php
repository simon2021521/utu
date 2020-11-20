<?php
require_once('../inc/db_class.php');
require_once('../inc/config.php');
require_once('../inc/tool.inc.php');
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('father_module.php','error','Sorry, you inputted wrong parameter');
}//防止有人直接进入delete页面，所以判断如果id没有传过来，不会执行程序。但是传过来一个错误的id，也可以执行，affected rows
//判断是否为数字或数字字符串，id=1 or 1 这种不是数字字符串，也不可以。
 
$connection = new dbController(HOST,USER,PASS,DB,PORT);//use $conn to retrive the return object.
$sql = "delete from crypto_historical_data where id={$_GET[id]}";
$connection->executeResult($sql);

if($connection->conn->affected_rows){//查看是否numbers of rows is 1.
    skip('father_module.php','ok','Congraduations, Delete successfully');
}else{
    skip('father_module.php','error','Sorry, Delete failed');
    //如果有人直接输入？id=100，自己随意传id号过来，则会出现此信息
}
?>

