<?php
session_start(); //iniciamos sesion
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/firts_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
date_default_timezone_set($zone);

$task=$_POST["task"];
$bus=$_POST["bus"];
$dt=$_POST["dt"];
$pl=$_POST["place"];
$hrs=$_POST["hrs"];
$destino=$_POST["destino"];
$ci=$_POST["ci"];
$name_client=$_POST["name_client"];
$last_name_client=$_POST["last_name_client"];
$origin=$_POST["origin"];
$money=$_POST["money"];
$date_reg=$_POST["date_reg"];
$op=$_POST["op"];
$num_travels=$_POST["travelers"];

switch ($task) //contiene el valor de los botones
{
	case ($task=="ok"); //valor enviado por el boton presionado
	
	sale_ticket($con, $bus, $dt, $pl, $hrs, $destino, $valid_user, $ci, $name_client, $last_name_client, $origin, $money, $date_reg, $op, $num_travels); //procedemos a la venta del boleto, su registro e impresion (cambiara el estado del asiento a vendido icono rojo)
	//imprimimos el boleto del pasajero utilizando una plantilla prediseñada esto se importara de la base de datos global config
	
	$template=$con->query("SELECT id_print,id_prints,template_name FROM global_config, template_prints WHERE id_print=id_prints");
	$recover=$template->fetch_assoc();
	$print=$recover["template_name"];
	require_once('templates_prints/'.$print.'.php');
	$template->free();
	//fin de la impresion
	
	break;	
	case ($task=="terminal");
	sale_ticket($con, $bus, $dt, $pl, $hrs, $destino, $valid_user, $ci, $name_client, $last_name_client, $origin, $money, $date_reg, $op, $num_travels); //procedemos a la venta del boleto, su registro e impresion (cambiara el estado del asiento a vendido icono rojo)
	//imprimimos el boleto del pasajero utilizando una plantilla prediseñada esto se importara de la base de datos global config
	
	$template=$con->query("SELECT id_print,id_prints,template_name FROM global_config, template_prints WHERE id_print=id_prints");
	$recover=$template->fetch_assoc();
	$print=$recover["template_name"];
	include_once('templates_prints/'.$print.'.php');
	$template->free();
	
	//fin de la impresion
	break;
	case ($task=="cancel");
	cancel_sale_ticket($con, $bus, $dt, $pl, $hrs, $valid_user); //procedemos a la cancelacion de la operacion el asiento se resetea (libre)
	//redireccionamos y cerramos la ventana
	header('location: cancel.php');
	break;
}
?>