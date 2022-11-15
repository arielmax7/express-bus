<?php
//** Libreria principal que recupera la informacion del usuario logeado utilizando su varialbe de sesion *//
// funcion que recibe la varible de sesion y la envia a una consulta y recupera toda la informacion necesaria del usuario
function recover_info_user($handle, $user)
{
	// ejecutamos la consulta a la base de datos
	$result = $handle->query("SELECT * FROM users, branch WHERE users.user_name='$user' AND users.id_location=branch.id_locations");
	if ($handle->error){ error_query_db(); }//llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	    // recuperamos la informacion campo por campo
		$recover=$result->fetch_assoc();
	   // declaramos variables globales que se utiulizaran a lo largo del sistema 
	   global $user_name; // contiene el nombre de usuario 
	   global $name; // contiene el nombre real del usuario 
	   global $last_name; // contiene el apellido paterno del usuario 
	   global $last_name2; // contiene el apellido materno del usuario
	   global $address; // contiene la direccion del usuario 
	   global $phone; // contiene el númerotelefonico del usuario
	   global $email; // contiene el email del usuario
	   global $location; // contiene la sucursal donde esta ubicado el usuario 
	   global $id_location_us;
	   global $id; // contiene el número de identificación del usuario (número de documento de identificación) 
	   global $level; // contiene el nivel de acceso del usuario 
	   global $registered ; // contiene la fecha de registro del usuario   
	   global $points; // contiene los puntos acumulados por el usuario (refleja el nivel de ventas) 
	   global $full_name; // contine el nombre completo del usuario obtenemos mediante la concatenacion de variables (nombre y apellido)
	   global $order_branch; //contiene el orden de recorrido del bus
	   // Recuperamos la informacion y la guardamos en las variables globales
	   $user_name=$recover["user_name"];
	   $name=$recover["name_user"];
	   $last_name=$recover["name_user1"];
	   $last_name2=$recover["name_user2"];
	   $address=$recover["address_user"];
	   $phone=$recover["phone_user"];
	   $email=$recover["email"];
	   $location=$recover["city"];
	   $id_location_us=$recover["id_location"];
	   $id=$recover["dni"];
	   $level=$recover["level"];
	   $registered=$recover["registered_user"]; 
	   $points=$recover["points"];
	   $full_name="$name"." $last_name";
	   $order_branch=$recover["order_travel"];
	   // liberamos memoria
	   $result->free();
}

// funcion que efectua la insercion de datos del usuario en la tabla temporal user info muestra los usuarios online y alguno de sus datos 
function insert_and_show_users_info($handle, $user_name, $branch, $level, $registered, $full_name, $points, $zone) // recuperamos la informacion mas relevante del usuario para ser mostrado *//
{   
	date_default_timezone_set($zone);
    // obtenemos la fecha y hora dekl sistema para ver en que momento ingreso el usuario
    $entry=date("Y-m-d:H:i:s"); 
	
	// eliminamos datos del usuario duplicados producido por una falla de energia o que el usuario no haya cerrado sesion correctamente liberamos memoria 
	$result = $handle->query("DELETE FROM users_online WHERE id_user='$user_name'");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha 
	// ejecutamos la consulta a la base de datos actualizamos los datos *//
	$result = $handle->query("INSERT INTO users_online VALUES('$user_name', '$branch', '$level', '$entry', '$points', '$registered', '$full_name')");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha 
	// recuperamos la informacion ya actualizada y la mostramos 
	$result= $handle->query("SELECT * FROM users_online");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha 
	// mostramos utilizando un loop while
	while ($row=$result->fetch_assoc()){
	// utilizamos el formato de tablas html  
	echo '<tr><td class="center">' .
	$row["show_name"] .'</td>';
	echo '<td class="center">' .
	$row["location"] .'</td>'; 
	echo '<td class="center">' .
	$row["type"] .'</td>';
	echo '<td class="center">' .
	$row["entry"] .'</td>';
	echo '<td class="center">'.
	$row["registered"] .'</td>';
	echo '<td class="center">'.
	$row["points"].
	'</td></tr>';
   }	
   // fin del loop
   // liberamos la memoria
   $result->free();
}

?>