<?php
session_start();
$valid_user=$_SESSION["valid_user"];
//validamos al usuario
require_once('../../core_system/show_system_messages.php');
require_once('../../core_system/check_valid_user.php');
require_once('../../includes/db_system.php');
require_once('../../core_system/eighth_lib_query.php');
//valor de comprovacion del sun: 45rgts7qswmax
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
//verificamos si intenta instalar una libreria

	//significa que esta instalando una libreria
	//verificamos el archivo
	//efectuamos primero la subida del archivo
	//datos del arhivo 
	
    $fichero=$_FILES['userfile'];
	$tipo_archivo = $_FILES['userfile']['type']; 
	$tamano_archivo = $_FILES['userfile']['size']; 
	//compruebo si las características del archivo son las que deseo 
    if (move_uploaded_file($fichero['tmp_name'], $fichero["name"])){ 
	$nombre_archivo=$fichero["name"];
	//descomprimimos el archivo zip
	require_once('pclzip.lib.php');
	$archive = new PclZip(''.$nombre_archivo.'');
	if ($archive->extract() == 0) {
	die("Error : ".$archive->errorInfo(true));
	}
	//eliminamos el archivo zip
	unlink($nombre_archivo);

	//eliminamos la extension del nombre
	$md_name = str_replace(".zip","",$nombre_archivo);
	
	$sun_file= str_replace(".zip",".php",$nombre_archivo);

	$types="pp"; // cambiar esta variable por mp si la libreria es multiterminal, por defecto se encuentra en pp terminal a terminal punto a punto.
	install_lib_gen($con, $md_name, $types);
    //actualizamos los datos de configuracion global
	}else{ 
	//mensjae de confirmacion de error no se pudo subir el archivo
      error_upload_install();
    } 
    	
	
	
	//significa que no esta instalando una libreria*/
?>