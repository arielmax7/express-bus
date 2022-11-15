<?php
session_start();
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/fourth_lib_query.php');
//conexion a la BD
$con=db_connect();
$task=$_POST["task"];
if(isset($_POST["cid"])){
				$cid = $_POST["cid"];
				}
				else{
					
				$cid = false;	
				}  
if(isset($_POST["for_user"])){
				$for_user = $_POST["for_user"];
				}
				else{
					
				$for_user = false;	
				}  
if(isset($_POST["subject"])){
				$subject = $_POST["subject"];
				}
				else{
					
				$subject = false;	
				}  
if(isset($_POST["message"])){
				$message = $_POST["message"];
				}
				else{
					
				$message = false;	
				}  	
if(isset($_POST["remite"])){
				$remit = $_POST["remite"];
				}
				else{
					
				$remit = false;	
				}  	
if(isset($_POST["branch"])){
				$branch = $_POST["branch"];
				}
				else{
					
				$branch = false;	
				}  				
				  

switch($task)
{
	
	case($task=="read"); //marcar como leido
	
	read_message_marck($con, $cid);
	
	break;
	
	case($task=="noread"); //marcar como no leido
	
	no_read_message_marck($con, $cid);
	
	break;
	
	case($task=="trash"); //envia el mensaje a la papelera
	
	trash_message_marck($con, $cid);
	
	break;
	
	case($task=="remove"); //elimina el mensaje de forma permanente
	
	remove_message_marck($con, $cid);
	
	break;
	
	case($task=="send"); //envia el mensaje
	
	send_message_for_user($con, $for_user, $subject, $message, $remit, $branch, $zone); //guarda y envia el mail
	
	break;
	
	case($task=="send_archive"); //envia un archivo
	
	
	
	$fichero = $_FILES["userfile"];
	//efectuamos primero la subida del archivo
	//datos del arhivo 
	$nombre_archivo = "uploads/";
	// puedes establecer mas restricciones de caracteres
	
	$tamano_archivo = $fichero["size"]; 
	//compruebo si las características del archivo son las que deseo 
	
	
	
		
    	if (move_uploaded_file($fichero["tmp_name"], $nombre_archivo.$fichero["name"])){ 
	    $nombre_archivo=$nombre_archivo.$fichero["name"];
	    
		send_archive_for_user($con, $for_user, $subject, $message, $remit, $branch, $nombre_archivo, $tamano_archivo, $zone);
	

		}else{ 
	//mensjae de confirmacion de error no se pudo subir el archivo
	  
      imposible_send_archive(); 
	   
    	}
	
    
	
	break;
	
}
?>