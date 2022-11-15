<?php
session_start();
$valid_user=$_SESSION["valid_user"];
require_once('../core_system/includes.php');
require_once('backup_process.php');
// validamos al usuario
check_valid_user_user($valid_user);
// estabelcemos la zona horaria
date_default_timezone_set($zone);

if(isset($_POST["task"])){
$task=$_POST["task"];	
}else{
$task=false;	
}
if(isset($_POST["cid"])){
$cid=$_POST["cid"];	
}else{
$cid=false;	
}


switch($task)
{
	case($task=="backup");
	db_connect();
	// funcion que realiza la copia de seguridad de la base de datos
	backupDatabase('backups_db/' .'backup_express_bus_'. date('d-m-Y') . '.sql', $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
	// mostramos mensaje de confirmación si la operacion fue exitoza
	ok_backup_data_base();
	
	break;
	
	case($task=="delete");
	// funcion que elimina una backup del sistema
	unlink("backups_db/$cid");  
	// mostramos mensa de conirmacion si la operacion fue exitosa
	ok_remove_backup();
	break;
}
?>