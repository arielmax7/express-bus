<?php
session_start();
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/ckeck_forms.php');
require_once('../core_system/third_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexiona a la BD
$con=db_connect();
$pass1=$_POST["pass1"];
$pass2=$_POST["pass2"];
$mail=$_POST["mail"];
$name1=$_POST["name1"];
$name2=$_POST["name2"];
$name3=$_POST["name3"];
$loc=$_POST["loc"];
//verificamos la contraseña si esta vacio no modificamos nada

check_password($pass1, $pass2);
if($sta_pass=="no"){ //si esto es asi significa que el usuario esta cambiando su contraseña si todo ha sido llenado correctamente se procede a la atualizacion	
//efectuamos la consulta
//efectuamos la actualizacion
$con->query("UPDATE users SET pass= MD5('$pass1') WHERE user_name='$valid_user'");		
//verificamos el email si este a cambiado o no
check_email_my_profile($con, $mail, $valid_user);
//actualizamos los demas datos

$con->query("UPDATE users SET name_user='$name1',name_user1='$name2',name_user2='$name3',id_location='$loc' WHERE user_name='$valid_user'");
//mostramos mensaje de confirmacio
ok_update_my_profile();

}
else{  
        
       //significa que no desea cambiar su contraseña	
       //verificamos el email si este a cambiado o no
	   check_email_my_profile($con, $mail, $valid_user);
	   //mostramos mensaje de confirmacio
	   //actualizamos los demas datos
       $modify=date("d-m-Y");
       $con->query("UPDATE users SET name_user='$name1',name_user1='$name2',name_user2='$name3',id_location='$loc' WHERE user_name='$valid_user'");
       //mostramos mensaje de confirmacio
       ok_update_my_profile();
	
}
?>