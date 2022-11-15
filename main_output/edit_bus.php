<?php
session_start();
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
				
				
require_once('../core_system/includes.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();

$task=$_POST["task"];
$mat=$_POST["enrollment"];
$id_bus=$_POST["id_bus"];
$num_places_bus=$_POST["num_places_bus"];
$operative=$_POST["operative"];
$category_bus=$_POST["category_bus"];
$description_bus=$_POST["description_bus"];
$lib_gen=$_POST["lib_gen"];
$imagen=$_FILES['userfile']['name']; 

if($task=="save"){ //guardamos los nuevos datos
// obtenemos el nombre de la libreria
	$result=$con->query("SELECT * FROM gen_libs WHERE id_models='$lib_gen'");
    $rec=$result->fetch_assoc();
	$nam_lib=$rec["name_lib"];
	$type=$rec["mode"];
//verificamos el numero de asientos si este es aceptado por la librería de generación
require_once('gen_libs/config_'.$nam_lib.'.php');	
	
//funcion que verifica la disponibiliodad de la matricula (editar bus)
function ckeck_mat_bus_edit($link,$mat)
{

	//verificamos la disponibilidad de la matricula
	$result=$link->query("SELECT * FROM buses WHERE enrrollment='$mat'");	
	if($result->num_rows > 0){
	//significa que la matricula esta repetida	
	already_mat_bus();	
	}
}	
	

//verificamos si cambio el la matricula
$handle=$con;
//realizamos la consulata a la base de datos
$result=$handle->query("SELECT * FROM buses WHERE id_bus='$id_bus' AND enrrollment='$mat'");
if($result->num_rows > 0){
//significa que no cambio la matricula	
	//verificamos si tiene una imgen del bus
	$result=$handle->query("SELECT * FROM buses WHERE image='si' AND id_bus='$id_bus'");
	
	if($result->num_rows > 0){
	//significa que tiene ya una imagen	
		//verificamos si esta intentando subir una nueva imagen del bus
		if(empty($imagen)){
		//significa que no esta subiendo una imagen
		$image="si";	
		//procedemos a actualizar los datos	
		$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',type='$type' WHERE id_bus='$id_bus'");
		//mostramos mensaje de confirmacion
		ok_update_bus();
		}
		else{
			//significa que esta subiendo una nueva imagen	
			
			$image="si";
			//se puede recuperar el nombre del archivo y eliminarlo
			$file=$result->fetch_assoc();
			$dir=$file["url_image"];
       		unlink($dir); 
			//efectuamos primero la subida del archivo
			//datos del arhivo 
			$fichero = $_FILES["userfile"];
			$nombre_archivo = "images_buses/";
			// puedes establecer mas restricciones de caracteres
			$tipo=$_FILES["userfile"]["type"];
			$tamano_archivo = $fichero["size"]; 
			//compruebo si las características del archivo son las que deseo 
			if($tipo=="image/jpeg" || $tipo=="image/gif" || $tipo=="image/png") {
    		
			
   		 		if (move_uploaded_file($fichero["tmp_name"], $nombre_archivo.$fichero["name"])){ 
				$nombre_archivo=$nombre_archivo.$fichero["name"];
				//actualizamos la informacion de la nueva imagen
				$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',url_image='$nombre_archivo',type='$type' WHERE id_bus='$id_bus'");
				//mensaje de confirmacion
   				 ok_update_bus();
				}
				else{ 
				//mensjae de confirmacion de error no se pudo subir el archivo
      			imposible_upload_bus(); 
   				} 
			}
			else{
			no_type_file_permited_bus(); 	
			}
			
		
    		 		
		}
	}
	else{
	//significa que no tine una imagen del bus	
		//verificamos si esta intentando subir una nueva imagen del bus
		
		if(empty($imagen)){
			//significa que no esta subiendo una imagen	
			$image="no";
			
			//catualizamos todos los datos menos la de imagen
			$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',url_image='no',type='$type' WHERE id_bus='$id_bus'");
			//mostramos mensaje de confirmacion
			ok_update_bus();
		}
		else{
		//significa que si esta subiendo una imagen del bus	
			$image="si"; 
			
			// puedes establecer mas restricciones de caracteres
			
			$fichero = $_FILES["userfile"];
			$nombre_archivo = "images_buses/";
			// puedes establecer mas restricciones de caracteres
			$tipo=$_FILES["userfile"]["type"];
			$tamano_archivo = $fichero["size"]; 
		
			//compruebo si las características del archivo son las que deseo 
			
			if($tipo=="image/jpeg" || $tipo=="image/gif" || $tipo=="image/png") {
    		 
   		 		if (move_uploaded_file($fichero["tmp_name"], $nombre_archivo.$fichero["name"])){ 
				$nombre_archivo=$nombre_archivo.$fichero["name"];
				//actualizamos la informacion de la nueva imagen
				$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',url_image='$nombre_archivo',type='$type' WHERE id_bus='$id_bus'");
				//mensaje de confirmacion
   				 ok_update_bus();
				}
				else{ 
				//mensjae de confirmacion de error no se pudo subir el archivo
      			imposible_upload_bus(); 
   				} 
    		} 
			else{
									
			no_type_file_permited_bus();
			}
		}
		
		
	}

}
else{
//significa que cambio la matricula	

		//verificamos la disponibilidad de la matricula
		ckeck_mat_bus_edit($con, $enrollment);
		//verificamos si tenia una imagen	
	    $result=$handle->query("SELECT * FROM buses WHERE image='si' AND id_bus='$id_bus'");
		if($result->num_rows > 0){
		//significa que ya tenia una imagen
			//verificamos si esta intentando subir una imagen
			if(empty($imagen)){
				//significa que no esta intentado subir una imagen
				$image="si";	
				//si todo esta bien actualizamos la informacion
				$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',type='$type' WHERE id_bus='$id_bus'");	
				//mostramos mensaje de confirmacion
				ok_update_bus();
			}
			else{
			//significa que esta subiendo una imagen	
			$image="si";	
			//verificamos la disponibilidad de la matricula	
			ckeck_mat_bus_edit($con, $enrollment);
			//subimos el archivo
			//se puede recuperar el nombre del archivo y eliminarlo
			$file=$result->fetch_assoc();
			$dir=$file["url_image"];
       		 unlink($dir); 
			//efectuamos primero la subida del archivo
			
			$fichero = $_FILES["userfile"];
			$nombre_archivo = "images_buses/";
			// puedes establecer mas restricciones de caracteres
			$tipo=$_FILES["userfile"]["type"];
			$tamano_archivo = $fichero["size"]; 
			//compruebo si las características del archivo son las que deseo 
			if($tipo=="image/jpeg" || $tipo=="image/gif" || $tipo=="image/png") {
    	 
			
			
   		 		if (move_uploaded_file($fichero["tmp_name"], $nombre_archivo.$fichero["name"])){ 
				$nombre_archivo=$nombre_archivo.$fichero["name"];
				//actualizamos la informacion de la nueva imagen
				$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',url_image='$nombre_archivo',type='$type' WHERE id_bus='$id_bus'");
				//mensaje de confirmacion
   				 ok_update_bus();
				}
				else{ 
				//mensjae de confirmacion de error no se pudo subir el archivo
      			imposible_upload_bus(); 
   				} 
				
			}
			else{
				no_type_file_permited_bus();	
			}
			
			
			//fin de la subida	
			}
		}
		else{ //significa que no tenia imagen
			//verificamos si esta intentando subir una nueva imagen del bus
		if(empty($imagen)){
			//significa que no esta subiendo una imagen	
			$image="no";
			//catualizamos todos los datos menos la de imagen
			//verificamos la disponibilidad de la matricula
			ckeck_mat_bus_edit($con, $enrollment);
			$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',url_image='no',type='$type' WHERE id_bus='$id_bus'");
			//mostramos mensaje de confirmacion
			ok_update_bus();
		}
		else{
		//significa que si esta subiendo una imagen del bus	
			$image="si";
			//verificamos la disponibilidad de la matricula
			ckeck_mat_bus_edit($con, $enrollment);
			//efectuamos primero la subida del archivo
			//datos del arhivo 
			
			// puedes establecer mas restricciones de caracteres
			$fichero = $_FILES["userfile"];
			$nombre_archivo = "images_buses/";
			// puedes establecer mas restricciones de caracteres
			$tipo=$_FILES["userfile"]["type"];
			$tamano_archivo = $fichero["size"]; 
			//compruebo si las características del archivo son las que deseo 
			if($tipo=="image/jpeg" || $tipo=="image/gif" || $tipo=="image/png") { 
    		 
			
			 
   		 		if (move_uploaded_file($fichero["tmp_name"], $nombre_archivo.$fichero["name"])){ 
				$nombre_archivo=$nombre_archivo.$fichero["name"];
				//actualizamos la informacion de la nueva imagen
				$handle->query("UPDATE buses SET num_places='$num_places_bus',operating='$operative',category='$category_bus',description='$description_bus',image='$image',id_model='$lib_gen',enrrollment='$mat',url_image='$nombre_archivo',type='$type' WHERE id_bus='$id_bus'");
				//mensaje de confirmacion
   				 ok_update_bus();
				}
				else{ 
				//mensjae de confirmacion de error no se pudo subir el archivo
      			imposible_upload_bus(); 
   				} 
    		}
			else{
			no_type_file_permited_bus();	
			}
			
		}
						
		}

}
}
?>