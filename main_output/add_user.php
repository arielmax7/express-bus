<?php
session_start();
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
require_once('../core_system/includes.php');
require_once('../core_system/third_lib_query.php');
require_once('../core_system/ckeck_forms.php');
//validamos al usuario
check_valid_user_user($valid_user);
$task=$_POST["task"];
$name_user=$_POST["name_user"];
$last_name_user=$_POST["last_name_user"];
$last_name_user2=$_POST["last_name_user2"];
$address_user=$_POST["address_user"];
$phone_user=$_POST["phone_user"];
$acces_name=$_POST["acces_name"];
$password1=$_POST["password1"];
$password2=$_POST["password2"];
$email_user=$_POST["email_user"];
$register_date=$_POST["register_date"];
$id_user=$_POST["id_user"];
$branch=$_POST["branch"];
$level_user=$_POST["level_user"];
// verificamos que los campos no esten vacios
if(empty($task) || empty($name_user) || empty($last_name_user) || empty($address_user) || empty($acces_name) || empty($password1) || empty($id_user) || empty($branch) || empty($level_user)){
invalid_operation();
exit;	
}
//conexion a la Base de datos
$con=db_connect();
recover_info_user($con, $valid_user);
check_valid_function_users($level); 
//conprobacion del boton
switch ($task)
{
	
	case($task=="save"); //guarda el usuario y redirecciona al gestor de usuarios
	
	add_new_user($con, $task, $name_user, $last_name_user, $last_name_user2, $address_user, $phone_user, $acces_name, $password1, $password2, $email_user, $register_date, $id_user, $branch, $level_user);
	
	
	
	break;
	
	case($task=="save_new");  //guarda el usuario y redireccina a un nuevo registro
 	
	add_new_user($con, $task, $name_user, $last_name_user, $last_name_user2, $address_user, $phone_user, $acces_name, $password1, $password2, $email_user, $register_date, $id_user, $branch, $level_user);
	
	break;
	
	
}

?>