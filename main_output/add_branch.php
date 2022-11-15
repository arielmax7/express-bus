<?php
session_start();
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
require_once('../core_system/includes.php');
require_once('../core_system/fifth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
$task=$_POST["task"];
$branch_name=$_POST["branch_name"];
$brach_address=$_POST["brach_address"];
$branch_phone=$_POST["branch_phone"];
$register_date=$_POST["register_date"];
$operating=$_POST["operating"];
$aut_empty_bus=$_POST["aut_empty_bus"];
$order=$_POST["order_branch"];

//validamos los campos
if(empty($task) || empty($branch_name) || empty($brach_address) || empty($branch_phone) || empty($register_date) || empty($operating) || empty($order)){
invalid_operation_branch();
exit;	
}
//conexion a la base de datos
$con=db_connect();
recover_info_user($con, $valid_user);

switch($task)
{
	
	case($task=="save"); //guarda y redirecciona a branch
	
	register_new_branch($con,$task,$branch_name,$brach_address,$branch_phone,$register_date,$operating,$aut_empty_bus,$order);
	
	break;
	case($task=="save_new"); //guarda  y redirecciona a la misma ventana para agregar otro
	register_new_branch($con,$task,$branch_name,$brach_address,$branch_phone,$register_date,$operating,$aut_empty_bus,$order);
	break;	
}
?>