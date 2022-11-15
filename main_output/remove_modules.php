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
$remove_lib_gen=$_POST["remove_lib_gen"];
$unistall_lib=$_POST["unistall_lib"];
if($task=="unistall"){
//procedemos a desinstalar los modulos
   //verificamos las opciones
   if($remove_lib_gen=="si"){
   //significa que desinstalara una libreria gen lib
   //obtenemos el nombre del archivo
   $result=$con->query("SELECT * FROM gen_libs WHERE id_models='$unistall_lib'");	
   $nam=$result->fetch_assoc();
   $unistall=$nam["name_lib"];
   	//primero eliminamos los archivos
	$dir=$unistall;
	//eliminamos la libreria
	unlink('gen_libs/'.$dir.'.php');	   
	//eliminamos la imagen miniatura de la libreria   
	unlink('gen_libs/'.$dir.'.png');  
	//eliminamos el archivo de configuracion
	unlink('gen_libs/config_'.$dir.'.php');
	//eliminamos el archivo de informacion
	unlink('gen_libs/info_'.$dir.'.html');
	//eliminamos de la base de datos
	unistall_lib_ge($con, $unistall_lib); 
   }
   
    //significa que no selecciono ningun modulo para su desinstalacion mostramos mensaje de error
	no_selected_module_for_unistall();	
}
?>