<?php
//** FUNCIONES QUE COMPRUEBAN LA EXISTENCIA DE AL MENOS UN REGISTRO EN LA TABLA *//
// funcion que verifica que exista al menos dos usuarios en la tabla usuarios para poder hacer uso de modulo (mail)
function check_users_in_table($handle)
{
	$result=$handle->query("SELECT * FROM users");
	if($result->num_rows > 1){
	return true;	
	}
	else{
	// significa que solo hay un usuario  mostramos mensaje de denegado	
	no_permitted_use_mail();	
	}
}

// funcion que verifica que exista al menos dos usuarios en la tabla usuarios para poder hacer uso de modulo (chat)
function check_users_in_table_chat($handle)
{
	$result=$handle->query("SELECT * FROM users");
	if($result->num_rows > 1){
	return true;	
	}
	else{
	// significa que solo hay un usuario  mostramos mensaje de denegado	
	no_permitted_use_chat();	
	}
}

// funcion que verifica que exista al menos dos terminales en la tabla branch
function check_branch_in_table($handle)
{
	$result=$handle->query("SELECT * FROM branch");
	if($result->num_rows > 1){
	return true;	
	}
	else{
	// significa que solo hay una sola terminal mostramos mensaje de denegado	
	no_permitted_use_paxkages();	
	}
}
?>