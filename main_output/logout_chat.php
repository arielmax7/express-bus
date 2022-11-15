<?php
session_start(); 
if(isset($_SESSION["userid"])){
	$userid=$_SESSION["userid"];
				
				}
				else{
				$userid=false;		
				
				}

require_once('../includes/db_system.php');
$handle=db_connect(); //conexion a la base de datos
//efectuamos la eliminacion del usuario en la base de datos
$handle->query("DELETE FROM chat_users WHERE username='$userid'");
$handle->query("DELETE FROM chat_users_rooms WHERE username='$userid'");
//destruimos la session
    
	
	unset( $_SESSION['userid'] );
//cerramos la aplicacion
require_once('finish_chat.php');
?>