<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/eighth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
$task=$_POST["task"];
$company_name=$_POST["company_name"];
$offline=$_POST["offline"];
$offline_message=$_POST["offline_message"];
$type_money=$_POST["type_money"];
$empty_tickets=$_POST["empty_tickets"];
$reset_system=$_POST["reset_system"];
$reset_log=$_POST["reset_log"];
$print_tickets=$_POST["print_tickets"];

if(empty($task) || empty($company_name) || empty($offline) || empty($offline_message) || empty($type_money) || empty($print_tickets)){
invalid_operation_buses();
exit;	
}

switch($task) //ejecutamos deacuredo al boton presionado
{
	
	case($task=="apply"); //aplicamos la configuracion  y redireccionamos a la misma pagina	
	
	apply_config_system($con,$task,$company_name,$offline,$offline_message,$type_money,$empty_tickets,$reset_system,$reset_log,$print_tickets);
	
	break;
	
	case($task=="save"); //aplicamos la configuracion y redireccionamos a la ventana principal
	
	apply_config_system($con,$task,$company_name,$offline,$offline_message,$type_money,$empty_tickets,$reset_system,$reset_log,$print_tickets);
		
	break;
	
}
?>