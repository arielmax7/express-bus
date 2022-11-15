<?php
session_start(); //iniciamos sesion *//
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
//importamos las librerias principales *//
require_once('../core_system/includes.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
$dni=$_GET['getClientId'];

//obtememos datos del cliente si este ya habia viajado
$result=$con->query("SELECT * FROM clients WHERE dni_client='$dni'");
//verificamos que esta en la tabla
if($result->num_rows > 0){
//significa que si esta en el registro recuperamos sus datos
$recover=$result->fetch_assoc();
echo "formObj.name_client.value = '".$recover["names"]."';\n";
echo "formObj.last_name_client.value = '".$recover["last_names"]."';\n";
echo "formObj.travelers.value = '".$recover["num_travelers"]."';\n"; 
}
else{	
//significa que no esta en el registro no completamos el formulario
 echo "formObj.name_client.value = '';\n";    
 echo "formObj.last_name_client.value = '';\n";    
 echo "formObj.travelers.value = '';\n";  	
}
?> 