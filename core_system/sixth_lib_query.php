<?php
//** SEXTA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DE LOS GESTOR DE BUSES *//
// funcion que muestra todos los buses de la empresa este sera visto solo por el super admin
function view_all_buses($handle,$lv,$filter_search)
{
	if(empty($filter_search)){ // busqueda
	if($lv=="sa"){ // solo por seguridad
	$result=$handle->query("SELECT * FROM buses, gen_libs WHERE buses.id_model=gen_libs.id_models ORDER BY id_bus LIMIT 0,500");	
	while ($row=$result->fetch_assoc()){
	$ope=$row["operating"];
	$cat=$row["category"];
	$id=$row["id_bus"]; // numero de identificacion del bus
	echo '<tr class="row0"><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" type="checkbox"></td>';
	echo '<td>'.
	$row["id_bus"].'</td>';
	echo '<td class="center">'.
	$row["num_places"].'</td>';
	echo '<td class="center">';
	      if($ope=="si"){ // verificamos su estado  del pago y mostramos su icono correspondiente
	       echo '<img src="templates/images/admin/tick.png">';
		  }
		  else{
		   echo '<img src="templates/images/admin/publish_r.png">';  
		  }
	echo '</td>';	  
	echo '<td class="center">'.
	$row["name_lib"].'</td>';
	echo '<td class="center">';
	switch($cat)
	{
	case($cat=="1");	
	echo '<img src="templates/images/admin/star.png">';	
	break;	
	case($cat=="2");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	case($cat=="3");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	case($cat=="4");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	case($cat=="5");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	}
	echo '</td>';
	
	echo '<td class="center">'.
	$row["description"].'</td>';
	echo '<td class="center">'.
	$row["registration"].'</td>';
	echo '<td class="center">'.
	$row["enrrollment"].'</td></tr>';
	}	
	$result->free();
	}
	}
	else{  // significa que esta buscando *//		
		
	$result=$handle->query("SELECT * FROM buses, gen_libs WHERE  buses.id_model=gen_libs.id_models AND buses.id_bus like '%$filter_search%' OR buses.description like '%$filter_search%' OR buses.enrrollment like '$filter_search'");	
	while ($row=$result->fetch_assoc()){
	$ope=$row["operating"];
	$cat=$row["category"];
	$id=$row["id_bus"]; // numero de identificacion del bus
	echo '<tr class="row0"><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="'.$row["destina"].'" type="checkbox"></td>';
	echo '<td>'.
	$row["id_bus"].'</td>';
	echo '<td class="center">'.
	$row["num_places"].'</td>';
	echo '<td class="center">';
	      if($ope=="si"){ // verificamos su estado  del pago y mostramos su icono correspondiente
	       echo '<img src="templates/images/admin/tick.png">';
		  }
		  else{
		   echo '<img src="templates/images/admin/publish_r.png">';  
		  }
	echo '</td>';	  
	echo '<td class="center">'.
	$row["name_lib"].'</td>';
	echo '<td class="center">';
	switch($cat)
	{
	case($cat=="1");	
	echo '<img src="templates/images/admin/star.png">';	
	break;	
	case($cat=="2");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	case($cat=="3");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	case($cat=="4");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	case($cat=="5");
	echo '<img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png"><img src="templates/images/admin/star.png">';
	break;
	}
	echo '</td>';
	
	echo '<td class="center">'.
	$row["description"].'</td>';
	echo '<td class="center">'.
	$row["registration"].'</td>';
	echo '<td class="center">'.
	$row["enrrollment"].'</td></tr>';
	}	
	$result->free();
	// fin de la busqueda
	}
}

// funcion que pone en mantenimiento a un bus (no disponible)
function in_maintenace_bus($handle, $id_bus)
{
	// cambiamos el estado del bus
	$handle->query("UPDATE buses SET operating='no' WHERE id_bus='$id_bus'");
    // mostramos mensaje de confirmacion	
	ok_in_maintence_bus();
}

// funcion que pone en operacion a un bus (disponible)
function operative_bus($handle, $id_bus)
{
	// cambiamos el estado del bus
	$handle->query("UPDATE buses SET operating='si' WHERE id_bus='$id_bus'");	
	// mostramos mensaje de confirmacion
	ok_operative_bus();
}

// funcion que elimina a un bus
function remove_bus($handle, $id_bus)
{
	// eliminamos el bus
	$handle->query("DELETE FROM buses WHERE id_bus='$id_bus'");
	// eliminamos todas sus dependencias
	$handle->query("DELETE FROM buses_temp WHERE id_bus='$id_bus'");
	$handle->query("DELETE FROM bus_for_user WHERE id_bus='$id_bus'");
	$handle->query("DELETE FROM destinations_bus WHERE num_bus='$id_bus'");
	$handle->query("DELETE FROM sunrise WHERE num_buses='$id_bus'");
	// mostramos mensaje de confirmacion
	ok_remover_bus();
}

// funcion que recupera toda la informacion del bus seleccionado (edicion del bus)
function recover_all_info_bus($handle, $id_bus)
{
  // recuperamos la informacion
  $result=$handle->query("SELECT * FROM buses WHERE id_bus='$id_bus'");
  $recover=$result->fetch_assoc();
  // declaramos variables globales
  global $num_places; // contiene el numero de asientos
  global $category; // contiene el nivel de categoria (estrellas)
  global $operating; // contiene el valor si este esta operativo
  global $description ; // contiene la descripcion del bus
  global $image; // contiene el valor si este posee imagen o no
  global $registration ; // contiene la fecha de registro del bus
  global $enrollment; // contiene el numero de matricula del bus
  global $url_image; // contiene la url de la imgen del bus
  // procedemos a llenar de datos
  $num_places=$recover["num_places"];
  $category=$recover["category"];
  $operating=$recover["operating"];
  $description=$recover["description"];
  $image=$recover["image"];
  $registration=$recover["registration"];
  $enrollment=$recover["enrrollment"];
  $url_image=$recover["url_image"];
  $result->free();
}

// funcion que recupera las librerias de modelado que esta usando el sistema de buses
function recover_gen_libs_edit($handle,$id_bus)
{
	
  if($id_bus==0)
  {
	$result=$handle->query("SELECT id_models, name_lib FROM gen_libs");
  while ($row=$result->fetch_assoc()){
  echo '<option value='.$row["id_models"].'>'.$row["name_lib"].'</option>';	
 
  }
  }
  else{
	  
  $result=$handle->query("SELECT * FROM buses, gen_libs WHERE buses.id_bus='$id_bus' AND buses.id_model=gen_libs.id_models");
  while ($row=$result->fetch_assoc()){
  echo '<option value='.$row["id_models"].'>'.$row["name_lib"].'</option>';	  
  }
  }

  $result->free();	
}

//funcion que recupera todas las terminales diponibles

function recover_all_branch_buses($handle)
{
	$result=$handle->query("SELECT * FROM destinations_bus");
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["num_des"].'>'.$row["des_name"].'</option>';
	}
	echo '</select>';
}

// funcion que recupera los infos de las librerias de generacion instaladas
function recover_info_gen_libs_new($handle)
{
  $result=$handle->query("SELECT * FROM gen_libs");
  while ($row=$result->fetch_assoc()){
  echo '<img src="templates/images/menu/icon-16-component.png" />&nbsp;&nbsp;<a href="gen_libs/info_'.$row["name_lib"].'.html" target="_blank">Librería '.$row["name_lib"].'</a><br /><br />';	
  }
  $result->free();
}

// funcion que verifica la disponibilidad del id bus
function exist_id_bus($link,$id_bus)
{
  $result=$link->query("SELECT id_bus FROM buses WHERE id_bus='$id_bus'");
  if($result->num_rows > 0){
  // significa que el id esta repetido	
  already_id_bus_new();		
  }
}

// funcion que verifica la disponibilidad de la matricula
function exist_mat_bus($link,$mat)
{
  $result=$link->query("SELECT enrrollment FROM buses WHERE enrrollment='$mat'");	
  if($result->num_rows > 0){
  //significa que la matricula esta repetida	  
  already_mat_bus_new();   
  }
}

// funcion que registra el nuevo bus
function add_new_bus($handle,$task,$num_places_bus,$category_bus,$description_bus,$id_bus,$date_reg,$operative,$file_name,$lib_gen,$enrollment,$image)
{
	//recuperamos la informacion del tipo de las librerias mdx
	$result=$handle->query("SELECT * FROM gen_libs WHERE id_models='$lib_gen'");
	$recover=$result->fetch_assoc();
	$type=$recover["mode"];
	$handle->query("INSERT INTO buses VALUES('$id_bus','$num_places_bus','$category_bus','$operative','$description_bus','$image','$lib_gen','$date_reg','$enrollment','$file_name','$type')");
	if($task=="save"){
	// mostramos mensaje de confirmacion gestor de buses
	ok_register_new_bus();
	}
	else{
	// mostramos mensaje de confirmacion misma pagina pude continuar agregando buses	
	ok_register_new_bus_next();	
	}
}
?>