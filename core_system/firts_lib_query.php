<?php
//** PRIMERA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DE LOS BUSES *//
// funcion que recupera los horarios de salida de los buses
function recover_hours($handle,$id_bus)
{
	// efectuamos la consulta
	$result = $handle->query("SELECT * FROM sunrise WHERE num_buses='$id_bus'");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	//mostramos los horario empleanod un list box html *//
	echo '<select name="hora" >';
	// mostramos utilizando un loop while
	echo '<option value="">- Hora de salida  -</option>';
	while ($row=$result->fetch_assoc()){	
	echo '<option value='.$row["hrs"].'>'.$row["hrs"].'</option>';
	}
	// fin del loop
	// fin del list box
	echo '</select>';
	// liberamos memoria
	 $result->free();
}


// funcion que recupera el numero id del bus (los buses disponibles)
function recover_buses($handle)
{
	// efectuamos la consulta
	$result = $handle->query("SELECT id_bus FROM buses");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	// mostramos los buses empleando un list box html
	//echo '<select name="bus" class="inputbox">';
	echo '<option value="-1">- Seleccione Bus -</option> ';
	// mostramos utilizando un loop while
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["id_bus"].'>'.$row["id_bus"].'</option>';	
	}
	// fin del loop
	// fin del list box
	//echo '</select>';
	// liberamos memoria
	 $result->free();
}

//funcion que agrega horarios a los buses
function add_hrs_buses($handle,$id_bus,$hrs)
{
	//verificamos que el campo bus no este vacio
	if(empty($id_bus) || $id_bus==-1){
	return true;
	}
	else{
	//verificamos que no sean repetidos los horarios
	$result=$handle->query("SELECT hrs,num_buses FROM sunrise WHERE hrs='$hrs' AND num_buses='$id_bus'");
	if($result->num_rows > 0){
	return true;
	}
	else{	
	//significa que esta agregando horarios al bus
	$handle->query("INSERT INTO sunrise (hrs,num_buses) VALUES('$hrs','$id_bus')");		
	}
	}
}

//funcion que elimina horarios de los buses
function remove_hrs_buses($handle,$id_hr)
{
	//significa que esta eliminando horarios del bus
	$handle->query("DELETE FROM sunrise WHERE num_hr='$id_hr'");		
	//mostramos mensaje de confirmacion		
}

//funcion que recupera las terminales o destinos
function recover_destins($handle)
{
	// efectuamos la consulta
	$result = $handle->query("SELECT city FROM branch");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	// mostramos los buses empleando un list box html
	//echo '<select name="bus" class="inputbox">';
	echo '<option value="-1">- Seleccione Destino -</option> ';
	// mostramos utilizando un loop while
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["city"].'>'.$row["city"].'</option>';	
	}
	// fin del loop
	// fin del list box
	//echo '</select>';
	// liberamos memoria
	 $result->free();
}

//funcion que recupera los destions del bus seleccionado
function recovering_destins_bus($handle,$id_bus)
{
	// efectuamos la consulta
	$result = $handle->query("SELECT * FROM destinations_bus WHERE num_bus='$id_bus'");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	//verificamos si el bus ya tenia horarios asignados
	if($result->num_rows == 0){
	// mostramos mensaje indiocando que el bus no tine horarios ahun
	echo '<option value="0">- No existe Destinos -</option> ';
	
	}
	else{

	// mostramos utilizando un loop while
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["num_des"].'>'.$row["des_name"].'</option>';	
	}
	// fin del loop
	// liberamos memoria
	 $result->free();	
	}
	
}

//funcion que agrega destinos al bus
function add_destin_for_buses($handle,$id_bus,$branch)
{
	//verificamos que el campo bus no este vacio
	if(empty($id_bus) || $id_bus==-1){
	return true;
	}
	else{
	//verificamos que no sean repetidos los horarios
	$result=$handle->query("SELECT des_name,num_bus FROM destinations_bus WHERE des_name='$branch' AND num_bus='$id_bus'");
	if($result->num_rows > 0){
	return true;
	}
	else{	
	//significa que esta agregando horarios al bus
	$handle->query("INSERT INTO destinations_bus (des_name,num_bus) VALUES('$branch','$id_bus')");		
	}
	}
}

//funcion que elimina destinos de los buses
function remove_dentin_for_buses($handle,$id_des)
{
	
	$handle->query("DELETE FROM destinations_bus WHERE num_des='$id_des'");	
	
}



//funcion que recupera los horarios de los buses
function recover_hrs_buses($handle,$id_bus)
{
// efectuamos la consulta
	$result = $handle->query("SELECT * FROM sunrise WHERE num_buses='$id_bus'");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	//verificamos si el bus ya tenia horarios asignados
	if($result->num_rows == 0){
	// mostramos mensaje indiocando que el bus no tine horarios ahun
	echo '<option value="0">- No existe horarios -</option> ';
	
	}
	else{

	// mostramos utilizando un loop while
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["num_hr"].'>'.$row["hrs"].'</option>';	
	}
	// fin del loop
	// liberamos memoria
	 $result->free();	
	}
	
}

// funcion que recupera la placa del bus
function recover_mat_bus($handle, $id_bus)
{
	$result=$handle->query("SELECT id_bus, enrrollment FROM buses WHERE id_bus='$id_bus'");
	$recover=$result->fetch_assoc();
	global $placa;
	$placa=$recover["enrrollment"];
	$result->free();
}

// funcion que crea una lista de los clientes

function list_user_info($handle, $user, $bus, $week, $hora)
{
		
	// una ves obtenido los datos procedemos a compararlos con la tabla de registro comercial
	$result=$handle->query("SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.date_travel='$week' AND record_customers_buses.time_travel='$hora'".
	" AND record_customers_buses.bus_travel='$bus' AND record_customers_buses.confirm_pay='si' AND record_customers_buses.user_emited='$user' AND clients.dni_client=record_customers_buses.dni_client");
    // generamos la lista utilizando un loop while
	while ($row=$result->fetch_assoc()){
	echo '<tr><td>' .
	$row["names"] .'</td>';
	echo '<td>' .
	$row["last_names"] .'</td>'; 
	echo '<td>' .
	$row["place"] .'</td>';
	echo '<td>' .
	$row["branch"] .'</td>';
	echo '<td>' .
	$row["traveled_to"] .'</td>';
	echo '<td>' .
	$row["dni_client"] .'</td>';
	echo '<td>' .
	'<img src="../main_output/templates/images/square.png">' .'</td></tr>';
	}	
	$result->free();	
}
//funcion que verifica que exista al menos dos destinos y dos horarios para el bus seleccionado
function check_destins_and_hours($handle, $bus)
{
	if(empty($bus)){
	$result=$handle->query("SELECT * FROM destinations_bus");
	$result2=$handle->query("SELECT * FROM sunrise");
		if($result->num_rows >= 2){
		echo"";	
		}
		else{
				ins_de();	
	
		}
		
		
		if($result2->num_rows >= 2){
		return true;	
		}
		else{
		ins_hours();	
		}
			
		
	}
	
	else{
	
	$result=$handle->query("SELECT * FROM destinations_bus WHERE num_bus='$bus'");
	$result2=$handle->query("SELECT * FROM sunrise WHERE num_buses='$bus'");
	if($result->num_rows >= 2){
	echo"";	
	
	}
	else{
	ins_de();	
	
	}
	if($result2->num_rows >= 2){
	return true;	
	}
	else{
	ins_hours();	
	}
	
	}
	
	
}

// funcion que verifica y recupera la informacion del bus seleccionada
function recover_and_check_bus_show($handle, $hr, $bus, $dt, $user, $zone) // recuperamos los datos del bus que el usuario haya seleccionado hora , bus, fecha, id usuario *//
{   // verificamos si estan presentes los datos caso contrario pasar por alto
date_default_timezone_set($zone);
if (empty($hr) || empty($bus) || empty($dt)){
	
	// Recuperamos la informacion del bus en caso de que esta ya haya sido preestablecido anteriormente 
	$result = $handle->query("SELECT * FROM bus_for_user WHERE user_name='$user'");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha *//
	// verificamos si existe un bus previamente configurado caso contrario saltar la operacion 
		if ($result->num_rows > 0){
		// recuperamos la informacion relacionando dos tablas
		$recover=$result->fetch_assoc();
		// declaramos variables globales que serviran para mostrar la información del bus
		global $id_bus; // contiene el número del Bus
		global $places; // contiene el numero de asientos que contien el bus 
		global $model; // contiene el modelo de generacion dinamica del bus 
		global $date; // contiene la fecha de salida del bus 
		global $hour;
		global $destinations; //contiene los destinos del bus
		global $cat;
		// recuperamos datos
		$date=$recover["week"];
			  // verificamos que la fecha sea igual o mayor a hoy 
			  if ($date >= date('Y-m')){
		        
				 $id_bus=$recover["id_bus"];
				 $places=$recover["places"];
				 $hour=$recover["time_exit"];
				 // recuperamos el id del bus para recuperar los datos de la otra tabla
				 $ids=$recover["id_bus"];
				 // leberamos memoria
		         mysqli_free_result($result);
				 // efectuamos la recuperacion de informacion de la otra tabla
				 $result = $handle->query("SELECT * FROM buses,gen_libs WHERE buses.id_bus='$ids' AND buses.id_model=gen_libs.id_models");
				 if ($handle->error){ error_query_db(); } //llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha *//
				 // recuperamos la informacion relacionando dos tablas
		         $recover=$result->fetch_assoc();
				 
				 $model=$recover["name_lib"];
				 ///////////////////////////////////////////////
				// recuperamos todos los destions del bus
				$destins = $handle->query("SELECT * FROM buses,destinations_bus WHERE buses.id_bus='$ids' AND buses.id_bus=destinations_bus.num_bus");
				
				while ($row=$destins->fetch_assoc()){
	   			 $destinations=$row["des_name"].'&nbsp;'.$destinations;
	    		}
				//recuperamos la categoria
				$c = $handle->query("SELECT id_bus,category FROM buses WHERE id_bus='$ids'");
				$recover=$c->fetch_assoc();
				$cat=$recover["category"];
			  }
			  // caso contrario detenemos la ejecucion 
		      return false;
		}
		else{
		  // leberamos memoria
		  $result->free();
		  return false;
		}
}
else{
	// verificamos que la fecha sea igual a hoy o adelande caso contrario mostrar error
	if ($dt >= date("Y-m-d")){
		// desmarca este comentario /*  si el bus efectua un viaje por dia a destinos largos
		/*	
		// verificamos que no haya seleccionado un bus ya cerrado perteneciente a la misma fecha que se ceroo
		$ver=$handle->query("SELECT * FROM bus_for_user WHERE id_bus='$bus'AND week='$dt' AND user_name='$user'");
		$cl=$ver->fetch_assoc();
		$cerrado=$cl["close"];
		$hour=$cl["time_exit"];
		// comparamos el estado del bus
		if($cerrado=="si"){
			// mostramos un mensaje indicando que el bus seleccionado ya esta cerrado no puede elegir algo que ya esta derrado
			bus_select_is_close();
		}
		*/
		// efectuamos la consulta recuperamos la informacion del bus utilizando su id 
		$result = $handle->query("SELECT * FROM buses,gen_libs WHERE buses.id_bus='$bus' AND buses.id_model=gen_libs.id_models");
		if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
		// recuperamos la informacion campo por campo 
		$recover=$result->fetch_assoc();
		// declaramos variables globales que serviran para mostrar la información del bus 
		global $id_bus; // contiene el número del Bus
	    global $operating;
		global $places; // contiene el numero de asientos que contien el bus
		global $model; // contiene el modelo de generacion dinamica del bus
		global $date; //contiene la fecha de salida del bus 
		global $destinations; //contiene los destinos del bus
		global $cat;
		global $hour;
		// asignamos el valor obtenido en las variables 
		$mode=$recover["type"];
		$id_bus=$recover["id_bus"];
		$places=$recover["num_places"];
		$model=$recover["name_lib"];
		$operating=$recover["operating"]; // contiene el parametro del estado del bus si este esta operativo o no
		///////////////////////////////////////////////
		// recuperamos todos los destions del bus
		$destins = $handle->query("SELECT * FROM buses,destinations_bus WHERE buses.id_bus='$bus' AND buses.id_bus=destinations_bus.num_bus");
		while ($row=$destins->fetch_assoc()){
	    $destinations=$row["des_name"].'&nbsp;'.$destinations;
	    }
		//recuperamos la categoria
				$c = $handle->query("SELECT id_bus,category FROM buses WHERE id_bus='$bus'");
				$recover=$c->fetch_assoc();
				$cat=$recover["category"];
		
     ///////////////////////////////////////////////////////////////////////////////////////////////
	//verificamos si la libreria de modelado del bus es multimpunto
	if ($mode=="mp"){
	//significa que es un bus multipunto verificamos si la terminal del usuario esta autorizado para iniciar el bus
	$autorized=$handle->query("SELECT * FROM users, branch WHERE users.user_name='$user' AND users.id_location=branch.id_locations");
	//recuperamos los datos
	$recover=$autorized->fetch_assoc();
	$au=$recover["emp_autorized"];
	$order=$recover["order_travel"]; // contiene el numero de orden
	$cl="no";
			if($au=="si"){
			//significa que esta autorizado para iniciar el bus
				// eliminamos otro bus dulicado
				$handle->query("DELETE FROM bus_for_user WHERE user_name='$user'");
				$handle->query("DELETE FROM config_mp WHERE user_name='$user'");
				if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
					//verificamos que orden de viaje tiene
					if($order==1){
					//significa que el bus esta partinedo de la terminal principal A a la terminal final Z
					$operator='<';	//asignamos al operador 
					}
					else{
					//significa que el bus esta partiendo de la terminal principal Z a la terminal final A	
					$operator='>';	
					}
					
					  //verificamos que no existan registros duplicados
					  $count=$handle->query("SELECT * FROM config_mp WHERE id_buses='$bus' AND dates='$dt'");
					  if($count->num_rows>0){
					 //significa que ya existe un regitro en la tabla config_mp
					// insertamos todos los datos en la tabla temporal bus for user
					$result = $handle->query("INSERT INTO bus_for_user (id_bus,places,user_name,week,time_exit,model,operating,close) VALUES('$bus', '$places', '$user', '$dt', '$hr', '$model','$operating', '$cl')");
					if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
					// obtenemos datos de tabla temporal antes insertada
					$result = $handle->query("SELECT week, time_exit FROM bus_for_user WHERE user_name='$user'");
	   	 			if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
					// recuperamos la informacion de los dos campos
					$recover=$result->fetch_assoc();
					// asignamos a las dos variables faltantes
					$date=$recover["week"];
					$hour=$recover["time_exit"];
	    			// liberamos la memoria
					$result->free(); 
					  }
					  else{
						  
					//insertamos en la tabla de configuracion mp
					$handle->query("INSERT INTO config_mp (id_buses,dates,operator,user_name) VALUES('$bus','$dt','$operator','$user')");
             /////////////////
			// insertamos todos los datos en la tabla temporal bus for user
			$result = $handle->query("INSERT INTO bus_for_user (id_bus,places,user_name,week,time_exit,model,operating,close) VALUES('$bus', '$places', '$user', '$dt', '$hr', '$model','$operating', '$cl')");
			if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
			// obtenemos datos de tabla temporal antes insertada
			$result = $handle->query("SELECT week, time_exit FROM bus_for_user WHERE user_name='$user'");
	   	 	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
			// recuperamos la informacion de los dos campos
			$recover=$result->fetch_assoc();
			// asignamos a las dos variables faltantes
			$date=$recover["week"];
			$hour=$recover["time_exit"];
	    	// liberamos la memoria
			$result->free();
					  }
			///////////////////////////////////////////////
			}
			else{
			//significa que no esta autorizado para iniciar el bus pero si puede cargarlo////
			// eliminamos otro bus duplicado
		$handle->query("DELETE FROM bus_for_user WHERE user_name='$user'");
		if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
		
		// insertamos todos los datos en la tabla temporal bus for user
		$close="no"; // variable que indica que el bus no esta cerrado
		$result = $handle->query("INSERT INTO bus_for_user (id_bus,places,user_name,week,time_exit,model,operating,close) VALUES('$bus', '$places', '$user', '$dt', '$hr', '$model','$operating', '$close')");
		if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	
		// obtenemos datos de tabla temporal antes insertada
		$result = $handle->query("SELECT week, time_exit FROM bus_for_user WHERE user_name='$user'");
	    if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
		// recuperamos la informacion de los dos campos
		$recover=$result->fetch_assoc();
		// asignamos a las dos variables faltantes
		$date=$recover["week"];
		$hour=$recover["time_exit"];
	    // liberamos la memoria
		$result->free();
			
			/////////////////////////////////////////////////////////////////////////////////
			}
		
	}
	//significa que no es un bus multipunto
	//qui el esle
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	else{	
		

		// eliminamos otro bus dulicado
		$handle->query("DELETE FROM bus_for_user WHERE user_name='$user'");
		if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
		
		// insertamos todos los datos en la tabla temporal bus for user
		$close="n"; // variable que indica que el bus no esta cerrado
		$result = $handle->query("INSERT INTO bus_for_user (id_bus,places,user_name,week,time_exit,model,operating,close) VALUES('$bus', '$places', '$user', '$dt', '$hr', '$model','$operating', '$close')");
		if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	
		// obtenemos datos de tabla temporal antes insertada
		$result = $handle->query("SELECT week, time_exit FROM bus_for_user WHERE user_name='$user'");
	    if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
		// recuperamos la informacion de los dos campos
		$recover=$result->fetch_assoc();
		// asignamos a las dos variables faltantes
		$date=$recover["week"];
		$hour=$recover["time_exit"];
	    // liberamos la memoria
		$result->free();
		
	}
	}
	else{
	bad_date_selected(); // llamamos a la funcion que muestra un mensaje indicando que la fecha elegida es incorrecta	
	}	
}
}

// funcion que resetea un asiento que esta en estado procesando y que este no se pudo completar por alguna razon error de conexion baja de energia etc permite reestablecer el asiento solo por el usuario que se produjo la falla
function reset_place_per_user($handle, $bus, $dates, $place, $hour, $user)
{
	if (empty($place)){
	echo '';	
	}
	else{
	// efectuamos la consulta a la base de datos cambiamos es estado de procesando a desocupado
	$handle->query("DELETE FROM buses_temp WHERE id_bus='$bus' AND dates='$dates' AND place='$place' AND status='p' AND hour='$hour' AND user_name='$user'");
	}
}

// funcion que confirma una reservacion antes hecha actualiza los datos e imprime el boleto
function confirm_reservation_client($handle, $bus, $dates, $hour, $place, $user)
{ 
if (empty($place)){// verificamos que el campo no este vacio
// mostramos un mensaje indicando que el campo esta vacio
empty_box();
}
// si noi esta vacio procedemos a hacer la operacion
   
   // fectuamos la consulata a la base de datos recuperamos y actualizamos los datos
   $rec = $handle->query("SELECT * FROM record_customers_buses WHERE date_travel='$dates' AND time_travel='$hour' AND place='$place' AND bus_travel='$bus' AND user_emited='$user' AND confirm_pay='no'");
   if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
   // recuperamos la informacion
   $recover=$rec->fetch_assoc();
   // declaramos varialbes globales que nos serviran para imprimir el boleto
   global $ci2; // contiene el numero de identificacion del pasajero
   global $name_client2; // contiene el nombre del pasajero
   global $last_name_client2; // contine el apellido del pasajero
   global $origin2; // contiene la terminal de donde parte el pasajero
   global $destino2; // contiene el destino final del pasajero
   global $money2; // contiene el monto economico que pagoi el pasajero
   global $user_emited2; // contiene el nombre del usuario que emitio el boleto
   global $date_register2;  //contiene la fecha de registro que se efectuo la reserva
   global $pl2; // contiene el asiento alternativo
   global $bus2; // contiene el asiento alternativo
   $pl2=$place; 
   $bus2=$bus;
   
   // asignamos a las variables
   $ci2=$recover["dni_client"];
   $origin2=$recover["branch"];
   $destino2=$recover["traveled_to"];
   $money2=$recover["payment"];
   $user_emited2=$recover["user_emited"];
   $date_register2=$recover["date_register"];
   
   //recuperamos los datos del cliente
   $cli=$handle->query("SELECT * FROM clients WHERE dni_client='$ci2'");
   $info=$cli->fetch_assoc();
   $name_client2=$info["names"];
   $last_name_client2=$info["last_names"];
   
   
   // verificamos que todas las varibles no esten vacias coso contrario indica que el numero de asiento es incorrecto
  if (empty($ci2) && empty($name_client2) && empty($last_name_client2) && empty($origin2) && empty($destino2) && empty($money2) && empty($user_emited2) && empty($date_register2)){
	   
	   $rec->free();
	   // mostramos un mensaje de error indicando que el asiento que coloco no esta reservado que coloque un asiento valido
	   bad_place_confirm_reserv();
   }
   else{
	   // actualizamos el estado del asiento de reservado a vendido
	   $handle->query("UPDATE buses_temp SET status='v' WHERE id_bus='$bus' AND dates='$dates' AND place='$place' AND hour='$hour' AND user_name='$user'");
	   //por si significa que la operacion se llevo con exito actualizamo la informacion del registro comercial y  imprimimos el boleto
	   $handle->query("UPDATE record_customers_buses SET confirm_pay='si' WHERE date_travel='$dates' AND time_travel='$hour' AND place='$place'".
	   " AND bus_travel='$bus' AND confirm_pay='no' AND user_emited='$user'");
	    // incrementamos un punto de bonificacion al usuario que vendio
		$handle->query("UPDATE users SET points=points+1 WHERE user_name='$user'");
        // procedemos a imprimir su boleto
   }
}

// funcion que evita realizar operaciones albus si este fue cerrado solo valido para la terminal que lo cerro
function check_open_or_close_bus($handle, $bus, $dates, $hour, $user, $terminal)
{
	// realizamos la consulta
	$result=$handle->query("SELECT * FROM bus_for_user WHERE id_bus='$bus' AND user_name='$user' AND week='$dates' AND time_exit='$hour'");	
	// recolectamos la informacion 
	$recover=$result->fetch_assoc();
	// creamos una variable de comparacion
	$view=$recover["close"];
	// verificamos si esta habilitado
	$result->free();
	if ($view=="si"){
	// significa que el us esta cerrado por lo tanto evitamos que realize cualquier operacion mostramos un mensaje indicando que no puede hacer nada
	no_process_bus_is_close();	
	}
	// si no esta cerrado puede seguir operando
}

// funcion que verifica si el asiento esta en uso (pp)
function check_is_ocupied_place_pp($handle, $bus, $dates, $place, $branch)
{
	// efectuamos la consulta
	$result=$handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND dates='$dates' AND place='$place' AND in_branch='$branch'");
	// verificamos si esta en uso
	if($result->num_rows >0){
	// mostramos mensaje indiocando que el asiento esta en uso actualmente
	$result->free();
	the_place_is_used();	
	}
	// caso de no aver uso procede normalmente
}

//funcion que verifica si el asiento esta en uso (mp)
function check_is_ocupied_place_mp($handle, $bus, $dates, $place)
{
	// efectuamos la consulta
	$result=$handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND dates='$dates' AND place='$place'");
	// verificamos si esta en uso
	if($result->num_rows >0){
	// mostramos mensaje indiocando que el asiento esta en uso actualmente
	$result->free();
	the_place_is_used();	
	}
	// caso de no aver uso procede normalmente
}


// funcion que verifica si el asiento esta en uso si el destino es igual a la terminal este pasa por alto
function check_is_ocupìed_place_terminal($handle, $bus, $dates, $place, $terminal)
{
	// efectuamos la consulta
	$result=$handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND destination='$terminal'");
	if($result->num_rows > 0){ // significa que el destino final es mi sucursal por lo tanto esta libre
	return true;
	}
	else{
	// efectuamos la consulta
	$result=$handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND dates='$dates' AND place='$place'");
	// verificamos si esta en uso
	if($result->num_rows >0){
	// mostramos mensaje indiocando que el asiento esta en uso actualmente
	$result->free();
	the_place_is_used();	
	}	
	}
}

// funcion que anula una reserva
function cancel_reservation($mysqli, $bus, $dates, $hour, $place, $branch, $user, $zone)
{
	date_default_timezone_set($zone);
	if(empty($place)){
	// mostramos mensje de erro indicando que el campo de texto esta vacio
	empty_box();	
	}
	else{
		    $cf=$mysqli;
	 		// efectuamos la eliminacion
		 	$mysqli->query("DELETE FROM buses_temp WHERE id_bus='$bus' AND status='r' AND dates='$dates' AND place='$place' AND hour='$hour' AND user_name='$user'");
			//eliminamos registro comercial
			$cf->query("DELETE FROM record_customers_buses WHERE date_travel='$dates' AND time_travel='$hour' AND bus_travel='$bus' AND place='$place' AND user_emited='$user' AND confirm_pay='no'");
	 		// verificamos que haya eliminado
	 			if($mysqli->affected_rows > 0){
	 			 // registramos en el log que el asiento ha sido vaciado por el usuario esto por razones de control ya que sin esto no sabriamos quien vacio el asiento
				 $reg_day=date("Y-m-d  H:i:s"); //registra fecha y hora en que fue hecha la operacion
	 			 $c=$mysqli->query("INSERT INTO logs (register_time,id_user,nam_locations,event) VALUES('$reg_day','$user','$branch','anular reserva asiento $place')");
	 			 // mostramos un mensaje de confirmacion
	 			 ok_place_cancel_reservation();
	 			 }
	 			 else{
				  // mostramos un mensaje indicando que coloco un asiento incorrecto
				 bad_place_reserv(); 
	 			 }
	}
}

// funcion que cierra el bus una ves que esta aya partido de la terminal del usuario
function close_bus_for_user($handle, $bus, $dates, $hour, $branch, $user, $zone)
{
	date_default_timezone_set($zone);
	if(empty($bus)){
	// mostramos un mensaje indicando que el campo de texto esta vacio
	empty_box_bus();	
	}
	else{
		 // realizamos la consulta
		 $result = $handle->query("SELECT * FROM bus_for_user WHERE id_bus='$bus' AND user_name='$user' AND week='$dates' AND time_exit='$hour'");
		 // verificamos si uvo cohinsidencia
		 if ($result->num_rows > 0){	 
			 // actualizamos la configuracion del bus
			 $handle->query("UPDATE bus_for_user SET close='si' WHERE user_name='$user'  AND id_bus='$bus' AND time_exit='$hour' AND week='$dates' ");
			 // registramos el evendo el la tabla log
			 $reg_day=date("Y-m-d  H:i:s");// registra fecha y hora en que fue hecha la operacion
			 $handle->query("INSERT INTO logs (register_time,id_user,nam_locations,event) VALUES('$reg_day','$user','$branch','cerrar bus $bus')");
			 // mostramos mensaje de confirmacion indicando que la operacion se llevo con exito
			 ok_close_bus();
			 $result->free();
		}
		 else{
			 // mostramos un mensaje indicando que el bus colocado es incorrecto
			 $result->free();
			 bad_number_bus_close();
		 }
	}
}

// funcion que verifica si la terminal tiene permiso para vaciar un bus
function is_autorized_empty_bus($handle, $terminal)
{
	
	// efectuamos la consulta
	$result = $handle->query("SELECT city, emp_autorized FROM branch WHERE city='$terminal'");
	// recuperamos el valor
	$recover=$result->fetch_assoc();
	// declaramos una varialbe global y asignamos el valor obtenido
	global $aut;
	$aut=$recover["emp_autorized"];
	$result->free();
}

// funcion que vacia el bus utilizado cuando el bus haya llegado a destino final i se prepara para un nuevo viaje
function empty_bus_final_destin($handle, $bus, $dates, $autorized, $branch, $user, $zone)
{
	date_default_timezone_set($zone);
	if (empty($bus)){
	// mostramos un mensaje de que el campo de texto esta vacio	
	empty_box_bus();	
	}
	else{
		// comprobamos si la sucursal tine el permiso para vaciar el bus solo las sucursales (principio y final del recorrido tienen permiso las sucursales intermedias no pueden hacer esto)
		if ($autorized=="si"){
			// significa que esta autorizado procedemos a vaciar el bus	
			// procedemos a eliminar todos los asientos del bus sin importar su estado
			$handle->query("DELETE FROM buses_temp WHERE id_bus='$bus' AND dates='$dates'");	
					// verificamos si se elimino
					if($handle->affected_rows > 0){
					// procedemos a guardar en el registro log
					$reg_day=date("Y-m-d  H:i:s");//registra fecha y hora en que fue hecha la operacion
					$handle->query("INSERT INTO logs (register_time,id_user,nam_locations,event) VALUES('$reg_day','$user','$branch','vaciar bus: $bus')");
					// mostramos un mesaje de confirmacion indicando que el bus fue vaciodo correcatamente
					ok_emp_bus();
					}
					else{
					// mostramos mensaje indicando que el numero de bus o la fecha son incorrectos
					bad_number_bus();
					}	
		}
		else{
		// mostramos un mensaje indicando que no esta autorizado para vaciar el bus	
		no_autorized_empty_bus();
		}		
	}
}

// funcion que recupera todas las terminales valido para elegir en un list box  que sera usado en proces tickets
function recover_terminals_for_tickets($handle, $id_bus, $branch)
{
	// hacemos la consulta a la base de datos
	$result=$handle->query("SELECT * FROM destinations_bus WHERE num_bus='$id_bus' AND NOT(des_name='$branch')");
	// generamos las sucusales menos la nuestra en un list box (html)
	echo '<select name="destino" id="jform_username" >';
	// generamos las sucursales en el loop while
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["des_name"].'>'.$row["des_name"].'</option>';
	}
	// fin del list box
	echo '</select>';
	$result->free();
}

// funcion que recupera la informacion del bus seleccionado por el usuario
function recover_info_bus_for_user($handle, $us_name,$bus)
{ 
	// hacemos la consultas a la base de datos
	$result=$handle->query("SELECT * FROM bus_for_user WHERE user_name='$us_name'");
	// recuperamos la informacion campo por campo
	$recover=$result->fetch_assoc();
	// declaramos variables globales
	global $bus;
	global $dt;
	global $hrs;
	global $destinations;
	$bus=$recover["id_bus"]; // contiene el número de bus
	$dt=$recover["week"]; // contiene la fecha de viaje
	$hrs=$recover["time_exit"]; // contiene la hora de viaje
	//recuperamos los destinos de el bus
	$destins = $handle->query("SELECT * FROM buses,destinations_bus WHERE buses.id_bus='$bus' AND buses.id_bus=destinations_bus.num_bus");
				while ($row=$destins->fetch_assoc()){
	   			 $destinations=$row["des_name"].'&nbsp;'.$destinations;
				}
	
	$result->free();
}

// funcion que realiza la insercion del asiento cuando se hace click en el 
function inser_place_temp($handle, $bus, $dates, $place, $hour, $user_name, $brach)
{
	// ejecutamos la peticion insertamos los datos
	$handle->query("INSERT INTO buses_temp (id_bus,dates,place,status,hour,user_name,in_branch) VALUES('$bus','$dates','$place','p','$hour','$user_name','$brach')");
}

// funcion que actualiza el asiento si el destino cohincide con la terminal para volver a vender el asiento al siguiente destino
function update_place_temp($handle, $bus, $dates, $place, $hour, $us_name)
{
	// ejecutamos la consulta de actualizacion para un nuevo uso
	$handle->query("UPDATE buses_temp SET status='p', hour='$hour', user_name='$us_name' WHERE id_bus='$bus' AND dates='$dates' AND place='$place'");	
}

// funcion que realiza la venta de un boleto cambia el estado de procesando a vendido
function sale_ticket($handle, $bus, $dates, $place, $hour, $destin, $us_name, $id_client, $name_client, $last_name_client, $terminal, $pay, $date_register, $op, $total_travels)
{ 
	// recuperamos todas las variables necesarias para esta operacion provenientes del formulario tickets process
	if ($op=="v"){ // confirmamos el pago
	//obtenemos el numero de orden de la terminal
	$num=$handle->query("SELECT * FROM branch WHERE city='$destin'");
	$recover=$num->fetch_assoc();
	$n_travel=$recover["order_travel"];
	// efectuamos la consulta a la base de datos
	$handle->query("UPDATE buses_temp SET status='v', destination='$n_travel' WHERE id_bus='$bus' AND dates='$dates' AND place='$place' AND hour='$hour' AND status='p' AND user_name='$us_name'");	
	// efectuamos el registro comercial del dinero y datos del cliente
	// verificamos que no exista un registro duplicado
	$result=$handle->query("SELECT * FROM record_customers_buses WHERE dni_client='$id_client' AND date_travel='$dates'".
	" AND time_travel='$hour' AND place='$place' AND user_emited='$us_name'");
		if($result->num_rows > 0){
		return true; //comodin significa que ya se ha insertado en el registro comercial por lo tanto no efectuamos nada
		}
		else
		{
			//verificamos si el cliente ya esta registrado en la tabla
			$result=$handle->query("SELECT * FROM clients WHERE dni_client='$id_client'");
			if($result->num_rows > 0){
			//significa que ya esta registrado actualizamos los hits de viaje
			$handle->query("UPDATE clients SET num_travelers=num_travelers+1 WHERE dni_client='$id_client'");
			
			}
			else{
			//agregamos a la tabla al nuevo cliente
			$handle->query("INSERT INTO clients VALUES('$id_client','$name_client','$last_name_client','1')");		
			}

		// efectuamos la insercion en el registro comercial
		$handle->query("INSERT INTO record_customers_buses (date_travel,time_travel,place,bus_travel,branch,traveled_to,payment,user_emited,date_register,dni_client,confirm_pay) VALUES('$dates','$hour','$place','$bus',".
		"'$terminal','$destin','$pay','$us_name','$date_register','$id_client','si')");
		
		//actualizamos la pùntuacion del usuario
		$handle->query("UPDATE users SET points=points+1 WHERE user_name='$us_name'");
		}
	}
	// esto para reservas
	else{
	//obtenemos el numero de orden de la terminal
	$num=$handle->query("SELECT * FROM branch WHERE city='$destin'");
	$recover=$num->fetch_assoc();
	$n_travel=$recover["order_travel"];	
	// efectuamos la consulta a la base de datos
	$handle->query("UPDATE buses_temp SET status='r', destination='$n_travel' WHERE id_bus='$bus' AND dates='$dates' AND place='$place' AND hour='$hour' AND status='p' AND user_name='$us_name'");	
	// efectuamos el registro y datos del cliente de forma temporal hasta su confirmacion mas adelante
	// comprobamos que no se repitan los datos
	$result = $handle->query("SELECT * FROM record_customers_buses WHERE dni_client='$id_client' AND ".
	"date_travel='$dates' AND time_travel='$hour' AND place='$place' AND user_emited='$us_name'");
		if($result->num_rows > 0){
			// detenemos la ejecucion esto para evitar llegar al ventan de impresion mostramos el mensaje que ya se reservo exitosamente
			ok_reservation_place();
		}
		else{	
		
		//verificamos si el cliente ya esta registrado en la tabla
			$result=$handle->query("SELECT * FROM clients WHERE dni_client='$id_client'");
			if($result->num_rows > 0){
			//significa que ya esta registrado actualizamos los hits de viaje
			$handle->query("UPDATE clients SET num_travelers=num_travelers+1 WHERE dni_client='$id_client'");
			
			}
			else{
			//agregamos a la tabla al nuevo cliente
			$handle->query("INSERT INTO clients VALUES('$id_client','$name_client','$last_name_client','1')");		
			}
		
		// efectuamos la insercion en el registro comercial
		$handle->query("INSERT INTO record_customers_buses (date_travel,time_travel,place,bus_travel,branch,traveled_to,payment,user_emited,date_register,dni_client,confirm_pay) VALUES('$dates','$hour','$place','$bus','$terminal','$destin','$pay',".
		"'$us_name','$date_register','$id_client','no')");
		// mostramos un mensaje indicando que la reserva fue echa correctamente
		$result->free();
		ok_reservation_place();
		}
	}
}

// funcion que cansela la operacion el el asiento seleccionado
function cancel_sale_ticket($handle, $bus, $dates, $place, $hour, $us_name)
{
	// efectuamos la consulta a la base de datos
	$handle->query("DELETE FROM buses_temp WHERE id_bus='$bus' AND dates='$dates' AND place='$place' AND hour='$hour' AND status='p' AND user_name='$us_name'");
}
?>