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
//switch selector enviado pro las ventanas pop up 

if(isset($_POST["place"])){
				$place = $_POST["place"];	
				}
				else{
					
				$place = false;	
				}
if(isset($_POST["branch"])){
				$branch = $_POST["branch"];	
				}
				else{
					
				$branch = false;	
				}
if(isset($_POST["autorized"])){
				$autorized = $_POST["autorized"];	
				}
				else{
					
				$autorized = false;	
				}
if(isset($_POST["pl"])){
				$pl = $_POST["pl"];	
				}
				else{
					
				$pl = false;	
				}


$task=$_POST["task"];
$bus=$_POST["bus"];
$dt=$_POST["dt"];
$hrs=$_POST["hrs"];



switch ($task) //varible emviado desde las popup
{
	
	case ($task=="cr"); //confirmar reserva se actualiza la informacion y se procede a imprimir el boleto pasa de reserva a vendido
	
	//llamamos a la funcion que recupera la informacion del asiento reservado
	confirm_reservation_client($con, $bus, $dt, $hrs, $pl, $valid_user);
    //imprimimos el boleto del pasajero utilizando una plantilla prediseñada esto se importara de la base de datos global config
	//iportamos la plantilla de impresion pre diseñada escogida en configuracion global
	
	$template=$con->query("SELECT id_print,id_prints,template_name FROM global_config, template_prints WHERE id_print=id_prints");
	$recover=$template->fetch_assoc();
	$print=$recover["template_name"];
	include_once('templates_prints/'.$print.'.php');
	$template->free();

	break;
	
	case ($task=="ar");
	//lama a la funcion que ejecuta la cancelacion de una reserva
	cancel_reservation($con, $bus, $dt, $hrs, $place, $branch, $valid_user, $zone);
	
	break;
	
	case ($task=="vbu");
	
    //llama a la funcion que ejecuta el vaciado total del bus una ves arribado a destino final preparandolo para una nueva partida
	empty_bus_final_destin($con, $bus, $dt, $autorized, $branch, $valid_user, $zone);
	
	
	break;
	
	case ($task=="cb");
	//llama a la funcion que ejecuta el cierre del bus por el usuario
	close_bus_for_user($con, $bus, $dt, $hrs, $branch, $valid_user, $zone);
	
	break;
}
?>