<?php
session_start(); //iniciamos sesion *//
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/firts_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion BD
$con=db_connect();

if(isset($_GET["op"])){
	$num_bus=$_GET["op"];
				
				}
				else{
				$num_bus=false;		
				}
if(isset($_GET["se"])){
	$opt=$_GET["se"];
				
				}
				else{
				$opt=false;		
				}
if(isset($_GET["h"])){
	$h=$_GET["h"];
				
				}
				else{
				$h=false;		
				}
if(isset($_GET["m"])){
	$m=$_GET["m"];
				
				}
				else{
				$m=false;		
				}
if(isset($_GET["id_h"])){
	$id_h=$_GET["id_h"];
				
				}
				else{
				$id_h=false;		
				}




$horas=$h.':'.$m.':'.'00';

if(empty($horas) || empty($num_bus)){
invalid_operation_buses();
exit;	
}


if(empty($opt)){
$opt=0;
}
switch($opt)
{
case($opt=="add");
//añadimos  y listamos
add_hrs_buses($con,$num_bus,$horas);
break;

case($opt=="del");
//eliminamos y listamos
remove_hrs_buses($con,$id_h);
break;


}


echo '<select name="id_hrst" multiple="multiple">';
//listamos
recover_hrs_buses($con,$num_bus);
echo "</select>";


?>




