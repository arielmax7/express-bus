<?php
session_start();
$valid_user=$_SESSION["valid_user"];
require_once('../core_system/includes.php');
require_once('../core_system/fifth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
$task=$_POST["task"];
$branch_name=$_POST["branch_name"];
$brach_address=$_POST["brach_address"];
$branch_phone=$_POST["branch_phone"];
$operating=$_POST["operating"];
$aut_empty_bus=$_POST["aut_empty_bus"];
$branch_id=$_POST["branch_id"];
$order=$_POST["order_branch"];
//validamos los datos
if(empty($task) || empty($branch_name) || empty($brach_address) || empty($branch_phone) || empty($branch_id) || empty($operating)){
invalid_operation_branch();
exit;	
}
//conexion a la BD
$con=db_connect();

if($task=="save"){ //guardamos la actualizacion

udate_branch_selected($con,$branch_name,$brach_address,$branch_phone,$operating,$aut_empty_bus,$branch_id,$order);
}
?>