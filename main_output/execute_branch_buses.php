<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];//importamos las librerias principales *//
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
if(isset($_GET["op"])){
	$num_bus=$_GET["op"];
				
				}
				else{
				$num_bus=false;		
				}
if(isset($_GET["d"])){
	$d=$_GET["d"];
				
				}
				else{
				$d=false;		
				}
if(isset($_GET["id_d"])){
	$id_h=$_GET["id_d"];
				
				}
				else{
				$id_h=false;		
				}



if(empty($num_bus)){
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
add_destin_for_buses($con,$num_bus,$d);
break;

case($opt=="del");
//eliminamos y listamos
remove_dentin_for_buses($con,$id_h);
break;


}


echo '<select name="id_hrst" multiple="multiple">';
//listamos
recovering_destins_bus($con,$num_bus);
echo "</select>";


?>




