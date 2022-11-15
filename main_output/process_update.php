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
// validamos al usuario
check_valid_user_user($valid_user);
$task=$_POST["task"];
$name_user=$_POST["name_user"];
$last_name_user1=$_POST["last_name_user1"];
$last_name_user2=$_POST["last_name_user2"];
$address_user=$_POST["address_user"];
$phone_user=$_POST["phone_user"];
$id_user=$_POST["id_user"];
$email_user=$_POST["email_user"];
$level_user=$_POST["level_user"];
$branch=$_POST["branch"];
$us=$_POST["us"];
//validamos todos los campos
if(empty($task) || empty($name_user) || empty($last_name_user1) || empty($address_user) || empty($email_user) || empty($id_user) || empty($branch) || empty($level_user)){
invalid_operation();
exit;	
}
// conexiona a la BD
$con=db_connect();

	if($task=="update_user"){ // actualiza los datos del usuario
	
	process_update_user($con, $name_user, $last_name_user1, $last_name_user2, $address_user, $phone_user, $id_user, $email_user, $level_user, $branch, $us);
	
	}
?>