<?php
session_start();
// incluimos las librerias principales
require_once('show_system_messages.php');
require_once('../includes/db_system.php');
// configuramos la zona horaria
date_default_timezone_set($zone);
$username=$_POST["username"];
$passwd=$_POST["passwd"];
if (!$username || !$passwd){	
	error_login_empty();
	exit();
}
//definimos  las expresiones regulares permitidas
//$expresion_a="^[a-zA-Z0-9_\.\-]+$";
//$expresion_b="^[a-zA-Z0-9_\.\-]+$";
    // verifica los caracteres introducidos esto para evitar que introduscan codigo malicioso
	if (preg_match("/^[a-zA-Z0-9_\.\-]+$/i", $username) || preg_match("/^[a-zA-Z0-9_\.\-]+$/i", $passwd)){
       // hacemos una consulta a la base de datos comprobamos los datos introducidos
       $mysqli=db_connect();  // llamamos a la conexion
       // ejecutamos la consulta a la base de datos
	   $result = $mysqli->query("SELECT * FROM users WHERE user_name='$username' AND pass= MD5('$passwd')"); 
		  // verifica si existe el usuario
	      if ($result->num_rows > 0){
		  // recupera el nombre de usuario y la guarda en la variable de sesion	  
		  $user=$result->fetch_assoc();
		  $user_name=$user["user_name"]; 
				
		  $valid_user=$user_name;
		  // registramos la sesion
		  $_SESSION['valid_user'] = $valid_user;
		  // liberamos memoria
		  mysqli_free_result($result);
		  // redireccionamos al menu principal
		  header('location: ../main_output/index.php');
	      }
	      else{
		  // liberamos memoria
		  mysqli_free_result($result);
		  // llama a la funcion muestra mensaje que el nombre de usuario y contraseña son incorrectos
	      error_login_no_match();
		  exit;
	      }
	  }
	  else{
	  error_login_invalid_char();	
	  }
?>