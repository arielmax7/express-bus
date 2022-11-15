<?php
//** QUINTA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DE LOS SUCURSALES (TERMINALES) *//
// funcion que muestra todas las terminales solo lo podra ver el super administrador
function view_all_estations($handle)
{
	$result=$handle->query("SELECT * FROM branch ORDER BY city LIMIT 0,500");
	while ($row=$result->fetch_assoc()){
	$ope=$row["operating_branch"];
	$aut=$row["emp_autorized"];
	$id=$row["id_locations"];
	echo '<tr class="row0"><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="'.$row["city"].'" type="checkbox"></td>';
	echo '<td>'.
	$row["city"].'</td>';
	echo '<td class="center">';
	      if($ope=="si"){ // verificamos su estado  del pago y mostramos su icono correspondiente
	       echo '<img src="templates/images/admin/tick.png">';
		  }
		  else{
		   echo '<img src="templates/images/admin/publish_r.png">';  
		  }
	echo '</td>';	  
	echo '<td class="center">'.
	$row["phone_branch"].'</td>';
	echo '<td class="center">'.
	$row["order_travel"].'</td>';
	echo '<td class="center">'.
	$row["address_branch"].'</td>';
	echo '<td class="center">'.
	$row["register_branch"].'</td>';
	
	echo '<td class="center">';
	      if($aut=="si"){ // verificamos su estado 
	       echo '<img src="templates/images/admin/tick.png">';
		  }
		  else{
		   echo '<img src="templates/images/admin/publish_r.png">';  
		  }
	echo '</td></tr>';	
	}
	$result->free();
}

// funcion que recupera todos los datos de la terminal seleccionada
function recover_branch_selected($handle, $id_branch)
{
	$result=$handle->query("SELECT * FROM branch WHERE id_locations='$id_branch'");
	$recover=$result->fetch_assoc();
	// declaramos variables globales
	global $brach_name; // contiene el nombre  o nombre de la ubicacion de la terminal
	global $operative; // contiene el valor de si esta operativo
	global $phone_branch; // contiene el numero telefonico de la terminal
	global $address_branch; // contiene la direccion de la terminal
	global $date_reg_branch; // contiene la fecha de registro de la terminal
	global $aut_empty_bus; // contine el valor si esta autorizado a vaciar el bus
	global $id_branch; // contiene el numero de terminal
	global $order_travel;
	// asignamos a las variables
	$brach_name=$recover["city"];
	$operative=$recover["operating_branch"];
	$phone_branch=$recover["phone_branch"];
	$address_branch=$recover["address_branch"];
	$date_reg_branch=$recover["register_branch"];
	$aut_empty_bus=$recover["emp_autorized"];
	$id_branch=$recover["id_locations"];
	$order_travel=$recover["order_travel"];
	// liberamos memoria
	$result->free();
}

// funcion que verifica la disponibilidad del nombre de terminal
function exist_name_branch($link, $name)
{
	$brach=$link->query("SELECT city FROM branch WHERE city='$name'");
	if($brach->num_rows > 0){
	// significa que el nombre ya esta en uso	
	$brach->free();
	already_branch();	
	}
    $brach->free();
}

// funcion que realiza la actualizacion de una terminal
function udate_branch_selected($handle,$branch_name,$brach_address,$branch_phone,$operating,$aut_empty_bus,$branch_id,$order)
{
	// procedemos a la actualizacion de los datos
	// verificamos si no cambio el nombre de la terminal
	$result=$handle->query("SELECT city,id_locations FROM branch WHERE city='$branch_name' AND id_locations='$branch_id'");
	if($result->num_rows > 0){ // significa que no cambio el nombre de la terminal
				// actualizamos todos los campos menos nombre de terminal	
				$handle->query("UPDATE branch SET operating_branch='$operating',address_branch='$brach_address',phone_branch='$branch_phone',".
				"emp_autorized='$aut_empty_bus',order_travel='$order' WHERE id_locations='$branch_id'");	
				$result->free();
				// mostramos mensaje de confirmacion
	            ok_update_branch();	
	}
	else{ // significa que cambio el nombre de la terminal
	
			//** Actualizamos todos los datos menos email
			// verificamos disponivilidad del nombre de la sucursal
	        exist_name_branch($handle, $branch_name);
			$handle->query("UPDATE branch SET city='$branch_name',operating_branch='$operating',address_branch='$brach_address',phone_branch='$branch_phone',".
			"emp_autorized='$aut_empty_bus',order_travel='$order' WHERE id_locations='$branch_id'");	
			$result->free();
			// mostramos mensaje de confirmacion
	        ok_update_branch();
			
	}
}

// funcion que verifica que no exista un nombre duplicado en la base de datos
function exist_name_branch_new($link, $name)
{
	$brach=$link->query("SELECT city FROM branch WHERE city='$name'");
	if($brach->num_rows > 0){
	// significa que el nombre ya esta en uso	
	$brach->free();
	already_name_brach_new();	
	}
    $brach->free();
}

// funcion que realiza la insercion de la nueva terminal
function register_new_branch($handle,$task,$branch_name,$brach_address,$branch_phone,$register_date,$operating,$aut_empty_bus,$order_tr)
{
	// verificamos la disponivilidad del nombre de la terminal
	exist_name_branch_new($handle, $branch_name);
	// si todo esta bien procedemos a insertar
	$handle->query("INSERT INTO branch (city,operating_branch,address_branch,phone_branch,register_branch,emp_autorized,order_travel) VALUES('$branch_name','$operating','$brach_address','$branch_phone','$register_date','$aut_empty_bus','$order_tr')");
	// mostramos mensaje de confirmacion
	if($task=="save"){
	// redireccionamos a la ventana pricipal	
	ok_insert_new_branch();	
	}
	else{
	// redireccionamos asi mismo
    ok_insert_save_and_new();	
	}	
}

// funcion que elimina una terminal permanentemente
function remove_branch($handle, $id_branch)
{	//primero verificamos que no existan usuarios asignados a la terminal
	$brach=$handle->query("SELECT id_location FROM users WHERE id_location='$id_branch'");
	if($brach->num_rows > 0){
	// mensaje de error
	invalid_operation_branch_users();		
	}
	else{
	// efectuamos la eliminacion 
	$handle->query("DELETE FROM branch WHERE id_locations='$id_branch'");
	// mostramos mensaje de confirmacion
	ok_remove_branch();
	}
}
?>