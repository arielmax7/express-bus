<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/firts_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion BD
$con=db_connect();

$num_bus=$_GET["op"]; //numero de bus




echo '<select name="hora">';
//listamos


$result = $con->query("SELECT * FROM sunrise WHERE num_buses='$num_bus'");
	if ($handle->error){ error_query_db(); } // llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
	//verificamos si el bus ya tenia horarios asignados
	if($result->num_rows == 0){
	// mostramos mensaje indiocando que el bus no tine horarios ahun
	echo '<option value="0">- No existe horarios -</option> ';
	
	}
	else{

	// mostramos utilizando un loop while
	echo '<option value="">- Hora de salida -</option> ';
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["hrs"].'>'.$row["hrs"].'</option>';	
	}
	// fin del loop
	// liberamos memoria
	 $result->free();	
	}





echo "</select>";

//listamos los destinos del bus


?>
