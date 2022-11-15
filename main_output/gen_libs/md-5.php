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
//cambia en funcion al modelo de bus
while ($a < 28){
	
$a++;

check_status_places_a($bus, $dt, $a, $handle, $hrs, $branch); $c++; 
	 if ($c < $num_places){
	 $a++;
	 
	 check_status_places_b($bus, $dt, $a, $handle, $hrs, $branch);  $c++; 
	 }


	if ($c==26 || $c==28){
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/entry.png"><br>';	// muestra la escalera de ingreso al bus
		}
	    else{
	    $a=$a+2;
		
	    check_status_places_c($bus, $dt, $a, $handle, $hrs, $branch); $c++; 
	$a=$a-1;	
	    
	    check_status_places_d($bus, $dt, $a, $handle, $hrs, $branch); $c++; 
	$a=$a+1;
		}




//Generar los textos para cada asiento	
	$b++;
	
	recover_info_destinations_a($bus, $dt, $b, $handle, $hrs, $branch); $d++; 
	$b++;
	
	recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch); $d++; 
	   if ($d==26 || $d==28 ){
		   echo '<br>';
	   }
	   else{
	   $b=$b+2;
	   
	   recover_info_destinations_c($bus, $dt, $b, $handle, $hrs, $branch); $d++;  
	   $b=$b-1;
	    
	   recover_info_destinations_d($bus, $dt, $b, $handle, $hrs, $branch); $d++;  
	   $b=$b+1;
       }

}

// creamos otro ciclo para la utilma secuencia
$a = $a+3;
$b = $b+3;
while ($a < $num_places) {
	
	check_status_places_a($bus, $dt, $a, $handle, $hrs, $branch); 
	$a++;
	check_status_places_b($bus, $dt, $a, $handle, $hrs, $branch);  
	$a=$a-2; 
	check_status_places_c($bus, $dt, $a, $handle, $hrs, $branch);  
	$a=$a-1;
	check_status_places_d($bus, $dt, $a, $handle, $hrs, $branch); 
	$a=$a+6;
	
	 //Generar los textos para cada asiento	

	recover_info_destinations_a($bus, $dt, $b, $handle, $hrs, $branch);
	$b++; 
	recover_info_destinations_b($bus, $dt, $b, $handle, $hrs, $branch); 
	$b=$b-2;  
	recover_info_destinations_c($bus, $dt, $b, $handle, $hrs, $branch);   
	$b=$b-1;
	recover_info_destinations_d($bus, $dt, $b, $handle, $hrs, $branch);   
	$b=$b+6;
     
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
				window.location.replace('md-5.php');
			}
			setTimeout('redirect();', 40000);
		</script>";
?>