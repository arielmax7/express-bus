<?php
//** OCTAVA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DE CONFIGURACION GLOBAL Y GESTOR DE INSTALACION *//
// funcion que recupera los valores de configuracion global
function recover_info_global_config($handle)
{
   $result=$handle->query("SELECT * FROM global_config");	
   $recover=$result->fetch_assoc();	
   // declaramos variables globales
   global $company_name; // contiene el nombre de la empresa
   global $active_site; // contiene el valor de activado o desactivado
   global $message_inactive; // contiene el mensaje que mostrara si esta inactivo
   global $type_money; // contiene el tipo de moneda
   global $print_tickets; // contiene la plantilla de impresion de boletos
   global $installed;
   global $sis_ver;
   // guardamos en las variables
   $company_name=$recover["company_name"];	
   $active_site=$recover["active_system"];
   $message_inactive=$recover["message_sys_off"];
   $type_money=$recover["type_money"];
   $print_tickets=$recover["id_print"];
   $installed=$recover["installed"];
   $sis_ver=$recover["ver_sis"];
   $result->free();	
}

// funcion que ejecuta la configuracion establecida
function apply_config_system($handle,$task,$company_name,$offline,$offline_message,$type_money,$empty_tickets,$reset_system,$reset_log,$print_tickets)
{
	// verificamos la opcion de resetear registro comercial de boletos
	if($empty_tickets=="si"){
	// significa que realizara el reseteo total del registro de boletos	
	$handle->query("TRUNCATE TABLE record_customers_buses");	
	}
	// verificamos la opcion de reseteo de sistema
	if($reset_system=="si"){
	// significa que el sistema volvera al estado de la instalacion 
	$handle->query("TRUNCATE TABLE record_customers_buses");	
	$handle->query("TRUNCATE TABLE buses");
	$handle->query("TRUNCATE TABLE buses_temp");
	$handle->query("TRUNCATE TABLE bus_for_user");
	$handle->query("TRUNCATE TABLE logs");	
	$handle->query("TRUNCATE TABLE mails");
	$handle->query("TRUNCATE TABLE sunrise");
	//$handle->query("TRUNCATE TABLE travel_personal_exit");
	$handle->query("TRUNCATE TABLE users_online");
	$handle->query("DELETE FROM users WHERE NOT(level='sa')");
	$handle->query("DELETE FROM gen_libs WHERE NOT(name_lib='md-1')");
	$handle->query("TRUNCATE TABLE branch");
	}
	// verificamos la opcion de reseteo de log
	if($reset_log=="si"){
	// significa que reseteara el log
	$handle->query("TRUNCATE TABLE logs");		
	}
	// actualizamos los demas datos
	$handle->query("UPDATE global_config SET company_name='$company_name',active_system='$offline',message_sys_off ='$offline_message'". 
	               ",type_money='$type_money',id_print ='$print_tickets',ver_sis='v 2.0.1'");
	// comparamos la opcion task
	if($task=="apply"){ // redireccionamos a la misma pagina
	// mostramos mensaje de confirmacion	
	ok_apply_config_new();	
	}
	else{
	// mostramos mensaje de confirmacion	
	ok_apply_config_close();	
	}
}

// funcion que recupera todas las librerias instaladas
function recover_install_gen_libs($handle)
{
	$result=$handle->query("SELECT * FROM gen_libs");
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["id_models"].'>'.$row["name_lib"].'</option>';
	}
	$result->free();
}

// funcion que instala la libreria md (gen libs)
function install_lib_gen($handle, $file_name, $mode)
{
	
	$handle->query("INSERT INTO gen_libs (name_lib, mode) VALUES('$file_name', '$mode')");
	if($handle->affected_rows > 0){
	// mostrmaos mensaje de confirmacion	
	ok_install_gen_lib();
	}
	else{
	// mostramos menesaje de confirmacion 	
	error_install_gen_lib();	
	}
}

// funcion que desinstala una libreria de la base de datos
function unistall_lib_ge($handle, $file_name)
{
	$handle->query("DELETE FROM gen_libs WHERE id_models='$file_name'");
	if($handle->affected_rows > 0){
	// mensaje de confirmacione desinstalacion correcta	
	ok_unistall_mod();
	}
	else{
	// mensaje de confirmacion no se pude desinstalar	
	error_unistall_mod();	
	}
}
?>