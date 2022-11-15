<?php
session_start();
$valid_user=$_SESSION["valid_user"];
require_once('../core_system/includes.php');
require_once('../core_system/sixth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
$task=$_POST["task"];
$id_bus=$_POST["id_bus"];
$lib_gen=$_POST["lib_gen"];
$num_places_bus=$_POST["num_places_bus"];
$option_bar=$_POST["option_bar"];
$enrollment=$_POST["enrollment"];
$category_bus=$_POST["category_bus"];
$description_bus=$_POST["description_bus"];
$date_reg=$_POST["date_reg"];
$operative=$_POST["operative"];
$imagen=$HTTP_POST_FILES['userfile']['name']; 
//validamos los campos
if(empty($task) || empty($id_bus) || empty($lib_gen) || empty($num_places_bus) || empty($enrollment) || empty($category_bus) || empty($description_bus) || empty($date_reg) || empty($operative)){
invalid_operation_buses();
exit;	
}
//conexion a la BD
$con=db_connect();
recover_info_user($con, $valid_user); 

switch($task)
{
	case($task=="save"); //registra el nuevo bus y lo redirecciona al gestor de buses
	//verificamos la disponibilidad del id
	exist_id_bus($con, $id_bus);
	//verificamos la disponibilidad de la matricula
	exist_mat_bus($con, $enrollment);
	// obtenemos el nombre de la libreria
	$result=$con->query("SELECT * FROM gen_libs WHERE id_models='$lib_gen'");
    $rec=$result->fetch_assoc();
	$nam_lib=$rec["name_lib"];
	//verificamos el numero de asientos si este es aceptado por la librería de generación
	require_once('gen_libs/config_'.$nam_lib.'.php');
	
	//verificamos si esta intentado subir una imagen
	if(empty($imagen)){
	//significa que no esta subiendo imagen del bus	
	$image="no";
	$file_name="no";
	//insertamos el registro	
	add_new_bus($con,$task,$num_places_bus,$category_bus,$description_bus,$id_bus,$date_reg,$operative,$file_name,$lib_gen,$enrollment,$image);
	}
	else{
	//significa que esta subiendo una imagen del bus
	$image="si";
	//verificamos la disponibilidad del id
	exist_id_bus($con, $id_bus);
	//verificamos la disponibilidad de la matricula
	exist_mat_bus($con, $enrollment);
	//efectuamos primero la subida del archivo
			//datos del arhivo 
			$nombre_archivo = "images_buses/" . $HTTP_POST_FILES['userfile']['name'];
			$nombre_archivo = str_replace(" ","_",$nombre_archivo); //remplasamos los espacios por (_)
			$nombre_archivo = str_replace("Ñ","n",$nombre_archivo); //remplasamos las ñ por (n)
			$nombre_archivo = str_replace("ñ","n",$nombre_archivo); //remplasamos las ñ por (n)
			$nombre_archivo = str_replace("á","a",$nombre_archivo); //remplasamos los ó por (a)
			$nombre_archivo = str_replace("é","e",$nombre_archivo); //remplasamos los ó por (e)
			$nombre_archivo = str_replace("í","i",$nombre_archivo); //remplasamos los ó por (i)
			$nombre_archivo = str_replace("ó","o",$nombre_archivo); //remplasamos los ó por (o)
			$nombre_archivo = str_replace("ú","u",$nombre_archivo); //remplasamos los ó por (u)
			$nombre_archivo = str_replace("Á","a",$nombre_archivo); //remplasamos los ó por (a)
			$nombre_archivo = str_replace("É","e",$nombre_archivo); //remplasamos los ó por (e)
			$nombre_archivo = str_replace("Í","i",$nombre_archivo); //remplasamos los ó por (i)
			$nombre_archivo = str_replace("Ó","o",$nombre_archivo); //remplasamos los ó por (o)
			$nombre_archivo = str_replace("Ú","u",$nombre_archivo); //remplasamos los ó por (u)
			// puedes establecer mas restricciones de caracteres
			$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
			$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 
			//compruebo si las características del archivo son las que deseo 
			if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    		no_type_file_permited_new_bus(); 
			}
			else{ 
   		 		if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_archivo)){ 
				//realizamos la insercion
				
				add_new_bus($con,$task,$num_places_bus,$category_bus,$description_bus,$id_bus,$date_reg,$operative,$nombre_archivo,$lib_gen,$enrollment,$image);
				
				}
				else{ 
				//mensjae de confirmacion de error no se pudo subir el archivo
      			no_upload_image_new_bus(); 
   				} 
    		} 				
	//fin de la subida	
	}
	
	break;
	
	case($task=="save_new"); //registra el nuevo bus y redirecciona a la misma pagina para segir agregando
	//verificamos la disponibilidad del id
	exist_id_bus($con,$id_bus);
	//verificamos la disponibilidad de la matricula
	exist_mat_bus($con,$enrollment);
	//verificamos si esta intentando subir una imagen
	//verificamos si esta intentado subir una imagen
	if(empty($imagen)){
	//significa que no esta subiendo imagen del bus	
	$image="no";
	$file_name="no";
	//insertamos el registro	
	add_new_bus($con,$task,$num_places_bus,$category_bus,$description_bus,$id_bus,$date_reg,$operative,$file_name,$lib_gen,$enrollment,$image);
	}
	else{
	//significa que esta subiendo una imagen del bus
	$image="si";
	//verificamos la disponibilidad del id
	exist_id_bus($con,$id_bus);
	//verificamos la disponibilidad de la matricula
	exist_mat_bus($con,$enrollment);
	//efectuamos primero la subida del archivo
			//datos del arhivo 
			$nombre_archivo = "images_buses/" . $HTTP_POST_FILES['userfile']['name'];
			$nombre_archivo = str_replace(" ","_",$nombre_archivo); //remplasamos los espacios por (_)
			$nombre_archivo = str_replace("Ñ","n",$nombre_archivo); //remplasamos las ñ por (n)
			$nombre_archivo = str_replace("ñ","n",$nombre_archivo); //remplasamos las ñ por (n)
			$nombre_archivo = str_replace("á","a",$nombre_archivo); //remplasamos los ó por (a)
			$nombre_archivo = str_replace("é","e",$nombre_archivo); //remplasamos los ó por (e)
			$nombre_archivo = str_replace("í","i",$nombre_archivo); //remplasamos los ó por (i)
			$nombre_archivo = str_replace("ó","o",$nombre_archivo); //remplasamos los ó por (o)
			$nombre_archivo = str_replace("ú","u",$nombre_archivo); //remplasamos los ó por (u)
			$nombre_archivo = str_replace("Á","a",$nombre_archivo); //remplasamos los ó por (a)
			$nombre_archivo = str_replace("É","e",$nombre_archivo); //remplasamos los ó por (e)
			$nombre_archivo = str_replace("Í","i",$nombre_archivo); //remplasamos los ó por (i)
			$nombre_archivo = str_replace("Ó","o",$nombre_archivo); //remplasamos los ó por (o)
			$nombre_archivo = str_replace("Ú","u",$nombre_archivo); //remplasamos los ó por (u)
			// puedes establecer mas restricciones de caracteres
			$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
			$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 
			//compruebo si las características del archivo son las que deseo 
			if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 1000000))) { 
    		no_type_file_permited_new_bus(); 
			}
			else{ 
   		 		if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_archivo)){ 
				//realizamos la insercion
				
				add_new_bus($con,$task,$num_places_bus,$category_bus,$description_bus,$id_bus,$date_reg,$operative,$nombre_archivo,$lib_gen,$enrollment,$image);
				
				}
				else{ 
				//mensjae de confirmacion de error no se pudo subir el archivo
      			no_upload_image_new_bus(); 
   				} 
    		} 				
	//fin de la subida	
	}
	break;
	
	
}
?>