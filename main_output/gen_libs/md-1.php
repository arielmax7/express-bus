<?php
session_start();
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
//** GENERA LOS ASIENTOS LIBRERIA MD1 *//
//importamos las librerias principales *// 
//valor del sun  a45rgts7qswmax
//type lib point_to_point
require_once('../../includes/db_system.php');
require_once('../../core_system/show_system_messages.php');
require_once('../../core_system/check_valid_user.php');
require_once('qmd-pp.php'); //libreria principal de generacion de consultas asiento por asiento en tiempo real
//validamos al usuario
check_valid_user_user($valid_user);
//importamos la hoja de estilos
echo '<html> 
<head> <LINK REL="stylesheet" HREF="general_style.css" TYPE="text/css"></head><body>';
//Importamos el bus escogido por el usuario y aplicamos la libreria de generacion
  $handle= db_connect();
  $result = $handle->query("SELECT * FROM bus_for_user WHERE user_name='$valid_user'");
  //recuperamos la sucursal del usuario
  $ter = $handle->query("SELECT user_name, id_location FROM users WHERE user_name='$valid_user'");
  $terminal= $ter->fetch_assoc();
  //recuperamos la terminal y la guardamos
  $branch=$terminal["id_location"];
  //recuperamos la informacion campo por campo
	  $recover=$result->fetch_assoc();
	  global $num_places;
	  $num_places=$recover["places"];
	  $model_gen=$recover["model"];
	  $dt=$recover["week"];
	  $hrs=$recover["time_exit"];
	  $bus=$recover["id_bus"];
	  $operating=$recover["operating"]; //obtenemos la informacion si el bus esta operativo caso contrario no se genera nada y se muestra un mensaje de error
	  //verificamos el estado del bus
	  if ($operating=="no"){  //por si significa que el bus no esta habilitado se encuentra en mantenimiento
	  bus_in_maintenase(); //llamamos a la funcion que muestra un mensaje indicando que el bus esta en mantenimiento
	  }
		  //verificamos la fecha de salida con la fecha actual
		  
	  	  if ($dt >= date("Y-m")){
		  echo ''; 
	      }
	  	  else{
		  bad_date_bus(); //llamamos a la funcion que muestra un mensaje de errror indicando que la fecha del bus ya ha expirado
		  }
//--------------------------------------------- boque de codigo gen lib (MD-1) encargado de generar los acientos para el bus bus --------------------------------------------------- *//
//valor del sun  a45rgts7qswmax	  
//** Primera libreria que genera asientos del tipo normal asientos pares en el pasillo y asientos imparares en la ventana contempla asiento trasero del final *//
?>
<html>
<head>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="bus">
<tr class="bus">
<td class="bus" background="images_bus/background_bus1.png">
<img src="images_bus/top_bus1.png">
</td>
</tr>
<tr class="bus">
<td class="bus" background="images_bus/background_bus1.png">
<?php
//ingresa el número de asientos generando los respectivos asientos con sus links *//
//declaramos variables auxiliares *//
$a=0;
$b=0;
$c=0;
$d=0;
while ($a < 5){
	$a++;
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido)
	check_status_places_a($bus, $dt, $a, $handle, $hrs, $branch);  $c++; //Grupo (a) asientos impares ventana izquierdo
	$a++;	
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido) 
	check_status_places_b($bus, $dt, $a, $handle, $hrs, $branch);  $c++; //Grupo (b) aientos pares pasillo central izquierdo
		if ($c==6){
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/entry.png"><br>';	// muestra la escalera de ingreso al bus
		}
	    else{
	    $a=$a+2;
		//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido
	    check_status_places_c($bus, $dt, $a, $handle, $hrs, $branch); $c++;	 //Grupo (c) aientos pares pasillo central derecho
	$a=$a-1;	
	    //funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido
	    check_status_places_d($bus, $dt, $a, $handle, $hrs, $branch); $c++;  //Grupo (d) aientos impares ventana derecho
	$a=$a+1;
		}
	//Genera los textos para cada asiento	
	$b++;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	recover_info_destinations_a($bus, $dt, $b, $handle, $hrs, $branch); $d++; //Grupo (a) asientos impares lado izquierdo ventana
	$b++;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch); $d++;  //Grupo (b) asientos pares central pasillo izquierdo
	   if ($d==6){
		   echo '<br>';
	   }
	   else{
	   $b=$b+2;
	   //funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	   recover_info_destinations_c($bus, $dt, $b, $handle, $hrs, $branch); $d++;  //Grupo (c) asientos pares central pasillo derecho
	   $b=$b-1;
	    //funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	   recover_info_destinations_d($bus, $dt, $b, $handle, $hrs, $branch); $d++;  //Grupo (d) asientos impares ventana derecho
	   $b=$b+1;
       }
}
//otro loop while para generar la siguiente secuecia ---------------------
$a=$a+2;
$b=$b+2;
$num_places=$num_places-4;
while ($a <= $num_places){
   	 $a++;
	 //funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido)
	 check_status_places_a($bus, $dt, $a, $handle, $hrs, $branch); //Grupo (a) asientos impares ventana izquierdo 
	 if ($c <= $num_places){
	 $a++;
	 //funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido) 
	 check_status_places_b($bus, $dt, $a, $handle, $hrs, $branch);  $c++; //Grupo (b) aientos pares pasillo central izquierdo
	 }
	 if ($c <= $num_places){
	 $a=$a-2;
	 //funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido
	 check_status_places_c($bus, $dt, $a, $handle, $hrs, $branch); $c++;	 //Grupo (c) aientos pares pasillo central derecho
	 }
	 $a=$a-1;
	 if ($c <= $num_places){
	 //funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido
	 check_status_places_d($bus, $dt, $a, $handle, $hrs, $branch); $c++;  //Grupo (d) aientos impares ventana derecho	 
	 }
	 $a=$a+5;
	 //Genera los textos para cada asiento
	 $b++;
	 //funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	 recover_info_destinations_a($bus, $dt, $b, $handle, $hrs, $branch); $d++; //Grupo (a) asientos impares lado izquierdo ventana
	 $b++;
	 //funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	 recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch); $d++;  //Grupo (b) asientos pares central pasillo izquierdo	 
	 $b=$b-2;	 
	 //funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	   recover_info_destinations_c($bus, $dt, $b, $handle, $hrs, $branch); $d++;  //Grupo (c) asientos pares central pasillo derecho
	 $b=$b-1;
	 //funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	   recover_info_destinations_d($bus, $dt, $b, $handle, $hrs, $branch); $d++;  //Grupo (d) asientos impares ventana derecho
	 $b=$b+5;
}
// otro loop while para generar la siguiente secuencia---------------------------------
$num_places=$num_places+1;
while ($a <= $num_places){
	$a++;
	if ($c < $num_places){
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido)
	 check_status_places_a($bus, $dt, $a, $handle, $hrs, $branch); //Grupo (a) asientos impares ventana izquierdo 
	}
	if ($c < $num_places){
	$a++;
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido) 
	 check_status_places_b($bus, $dt, $a, $handle, $hrs, $branch);  $c++; //Grupo (b) asientos pares pasillo central izquierdo
	}
	if($c < $num_places){
	$a++;	
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido)
	check_status_places_e($bus, $dt, $a, $handle, $hrs, $branch); $c++;	 //Grupo (e) asientos pasillo central 
	}
	if($c < $num_places){
	$a=$a-3;
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido)
	check_status_places_e($bus, $dt, $a, $handle, $hrs, $branch); $c++;	 //Grupo (c) aientos pares pasillo central derecho	
	}
	if($c <= $num_places){
	$a=$a-1;
	//funcion que efectua la consulta a la base de datos obteniendo el estado del asiento (libre, reservado, vendido)
	check_status_places_f($bus, $dt, $a, $handle, $hrs, $branch); $c++;   //Grupo (d) aientos impares ventana derecho
	}
	$b++;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	 recover_info_destinations_a($bus, $dt, $b, $handle, $hrs, $branch);  //Grupo (a) asientos impares lado izquierdo ventana
	$b++;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	 recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch);  //Grupo (b) asientos pares central pasillo izquierdo
	$b++;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch);  //Grupo (e) asientos  central pasillo final
	$b=$b-3;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch);  //Grupo (c) asientos  central pasillo derecho final
	$b=$b-1;
	//funcion que efectua la consulta a la base de datos obteniedo el estado y el destino final de cada asiento (formato texto)
	recover_info_destinations_e($bus, $dt, $b, $handle, $hrs, $branch);  //Grupo (e) asiento  ventana  derecho final
	//interrupcion del loop
	break;
}
?>
</td>
</tr>
<tr class="bus">
<td class="bus">
<img src="images_bus/footer_bus1.png">
</td>
</tr>
</table>
<?php 
//---------------------------------------------Fin del bloque----------------------------------------------------------------------------------------------------------------- *//
	  //liberamos memoria
	  mysqli_free_result($result);
		//actualizamos la pagina cada x segundo puedes el tiempo cambiando el valor en setTimeout('redirect();', 5000) se eactializa cada 5 segundos *//
		echo "<script>
			function redirect()
			{
				window.location.replace('md-1.php');
			}
			setTimeout('redirect();', 40000);
		</script>";
?>