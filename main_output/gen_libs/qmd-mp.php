<?php
//** Libreria principal de consulta de generacion de asientos a la base de datos mostrando el estado de cada asiento *//
//verificamos que existan al menos 3 terminales en el sistema para manejo de multi punto (mp)
function check_numbranch($handle)
{
	$result=$handle->query("SELECT * FROM branch");
	if($result->num_rows >= 3){
	return true;		
	}
	else{
	no_terminal();	
	}
}
//funcion que recupera el status de las primeras filas asientos impares izquierdos cada asiento generado por gen libs (mdx)
function check_status_places_a($bus, $dates, $place, $branch, $handle, $op) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo a) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contiEne el estado del asiento
    $destination=$recover["destination"]; //contiEne el destino del viaje que realizara el bus
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	/////// control de operador ///////
	switch ($op)
	{
		case($op=="<"); //el bus parte del punto A al punto B
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
			
			 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
			 }
			 if($status=="r"){			 
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">';
			 }  
		}
		else{
			if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
   			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
   		    } 
			if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; 
			}
		}
		break;
		case($op==">"); //el bus regrasa del punto B al punto A
		if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
			
			 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
			 }
			 if($status=="r"){			 
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">';
			 }  
		}
		else{
			if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
   			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
   		    } 
			if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; 
			}
		}
		break;
	}//fin del switch
    ///////////////////////////////////	
		
			
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser   
}
}
//funcion nuero 2  recupera el status de las segundas filas de asientos pares pasillo cada asiento generado por gen libs (mdx)
function check_status_places_b($bus, $dates, $place, $branch, $handle, $op) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo b) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
   case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       	 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	     }
		  if ($status=="r"){
		  //por si significa que el asiento esta reservado mostramos el icono verde limon
		  echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado	
		  }
	   }
	   else{
		  if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
   		  echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
		  }
		  if ($status=="v" || $status=="r"){
		   echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>';  
		  }
	   }
	break;
	case($op==">");
	  if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       	 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	     }
		  if ($status=="r"){
		  //por si significa que el asiento esta reservado mostramos el icono verde limon
		  echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado	
		  }
	   }
	   else{
		  if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
   		  echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
		  }
		  if ($status=="v" || $status=="r"){
		   echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>';  
		  }
	   }
	break;   
}//fin del switch
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser vendido
}
}
//funcion numero 3  recupera el status de las terceras filas de asientos pares pasillo cada asiento generado por gen libs (mdx)
function check_status_places_c($bus, $dates, $place, $branch, $handle, $op) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo c) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse  
	    if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	    }
		if($status=="r"){
		//por si significa que el asiento esta reservado mostramos el icono verde limon
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado
		}	 		   
		}	 
		else{	
		if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
   		}		
		if ($status=="v" || $status=="r"){
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>';	
		}
		}	
	break;
	case($op==">");
	if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse  
	    if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	    }
		if($status=="r"){
		//por si significa que el asiento esta reservado mostramos el icono verde limon
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado
		}	 		   
		}	 
		else{	
		if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
   		}		
		if ($status=="v" || $status=="r"){
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>';	
		}
		}	
	break;	
}//fin del switch
}
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser vendido
}
}
//funcion numero 4  recupera el status de las cuartas filas de asientos impares ventana cada asiento generado por gen libs (mdx)
function check_status_places_d($bus, $dates, $place, $branch, $handle, $op) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo d) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		    if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO"><br>'; //ocupado el asiento no puede ser vendido
	        }
			if($status=="r"){
		    //por si significa que el asiento esta reservado mostramos el icono verde limon
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO"><br>'; //ocupado el asiento esta en estado de reservado
			}
	}
	else{			 	 
		   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO..."><br>';
           }
		   if ($status=="v" || $status=="r"){
		   echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>';   
		   } 
	}
	break;
	case($op==">");
	if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		    if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO"><br>'; //ocupado el asiento no puede ser vendido
	        }
			if($status=="r"){
		    //por si significa que el asiento esta reservado mostramos el icono verde limon
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO"><br>'; //ocupado el asiento esta en estado de reservado
			}
	}
	else{			 	 
		   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO..."><br>';
           }
		   if ($status=="v" || $status=="r"){
		   echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>';   
		   } 
	}
	break;
}//fin del switch
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>'; //el asiento esta libre puede ser vendido
}
}
//funcion numero 5  recupera el status de la fila central de asientos generado por gen libs (mdx)
function check_status_places_e($bus, $dates, $place, $branch, $handle, $op) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo e) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
    case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
				  if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	              }	
				  if ($status=="r"){
		    	  //por si significa que el asiento esta reservado mostramos el icono verde limon
				  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado
				  }
	}
	else{
			if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
			}
			if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>';	
			}
	}
	break;
	case($op==">");
	if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
				  if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	              }	
				  if ($status=="r"){
		    	  //por si significa que el asiento esta reservado mostramos el icono verde limon
				  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado
				  }
	}
	else{
			if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
			}
			if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>';	
			}
	}
	break;
}//fin del switch
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser vendido//libera
}
}
//funcion numero 6  recupera el status de la fila dercha final ventana de asientos generado por gen libs (mdx)
function check_status_places_f($bus, $dates, $place, $branch, $handle, $op) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo e) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branchn < $destinatio){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       	 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO"><br>'; //ocupado el asiento no puede ser vendido
	   	 }		
		 if ($status=="r"){
		 //por si significa que el asiento esta reservado mostramos el icono verde limon
		 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO"><br>'; //ocupado el asiento esta en estado de reservado	 
		 }		 
	}
	else{
    	 if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
    	 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO..."><br>';
    	 }		
		 if ($status=="v" || $status=="r"){
		 echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>';	 
		 }
    }
	break;
	case($op==">");
	if($branchn > $destinatio){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       	 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO"><br>'; //ocupado el asiento no puede ser vendido
	   	 }		
		 if ($status=="r"){
		 //por si significa que el asiento esta reservado mostramos el icono verde limon
		 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO"><br>'; //ocupado el asiento esta en estado de reservado	 
		 }		 
	}
	else{
    	 if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
    	 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO..."><br>';
    	 }		
		 if ($status=="v" || $status=="r"){
		 echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>';	 
		 }
    }
	break;
}//fin del switch
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_mp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>'; //el asiento esta libre puede ser vendido
}
}
//** Libreria principal de consulta de generacion de texto a la base de datos mostrando el destino de cada asiento *//
//funcion que recupera la información de las primeras filas de asientos impares ventana izquierda
function recover_info_destinations_a($bus, $dates, $place, $branch, $handle, $op)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	$terminal=$recover["city"];
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	    }
		if ($status=="r"){
		//por si significa que el asiento esta reservado mostramos el icono verde limon
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
		}	
	}
	else{
    	   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
           }
		   if ($status=="v" || $status=="r"){
		   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="Libre" style="color:#19629E" class="ji">';   
		   }
	}
	break;
	case($op==">");
	if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	    }
		if ($status=="r"){
		//por si significa que el asiento esta reservado mostramos el icono verde limon
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
		}	
	}
	else{
    	   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
           }
		   if ($status=="v" || $status=="r"){
		   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="Libre" style="color:#19629E" class="ji">';   
		   }
	}
	break;
}//fin del switch
}
else{ //fin del num rows  
// si no encuentra nigun resultado por logica el asiento libre
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="Libre" style="color:#19629E" class="ji">'; //el asiento esta libre puede ser vendido
}
}
//funcion 2 que recupera la información de las segundas filas de asientos pares pasillo central izquierdo
function recover_info_destinations_b($bus, $dates, $place, $branch, $handle, $op)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
	$terminal=$recover["city"];
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
         echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	     } 
		 if ($status=="r"){
		  //por si significa que el asiento esta reservado mostramos el icono verde limon
		 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
		 }
	}
	else{
          if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
          }  
		  if ($status=="v" || $status=="r"){
		  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji">';  	  
		  }
    }
	break;
	case($op==">");
	if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
		 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
         echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	     } 
		 if ($status=="r"){
		  //por si significa que el asiento esta reservado mostramos el icono verde limon
		 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
		 }
	}
	else{
          if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
          }  
		  if ($status=="v" || $status=="r"){
		  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji">';  	  
		  }
    }
	break;
}//fin switch
}
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado //el asiento esta libre puede ser vendido
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji">'; 
}
}
//funcion 3 que recupera la información de las terceras filas de asientos pares pasillo central derecho
function recover_info_destinations_c($bus, $dates, $place, $branch, $handle, $op)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
	$terminal=$recover["city"];
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
	      if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
		  }
		  if ($status=="r"){
		  //por si significa que el asiento esta reservado mostramos el icono verde limon
	      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
		   }
	}
	else{
    	   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
           }
		   if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7"  value="Libre" class="ji" style="color:#19629E">';    
		   }  		   
	 }
	 break;
	 case($op==">");
	 if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
	      if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
		  }
		  if ($status=="r"){
		  //por si significa que el asiento esta reservado mostramos el icono verde limon
	      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
		   }
	}
	else{
    	   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
           }
		   if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7"  value="Libre" class="ji" style="color:#19629E">';    
		   }  		   
	 }
	 break;
}//fin del switch
}
else{
    // si no encuentra nigun resultado por logica el asiento estaradesocupado //el asiento esta libre puede ser vendido
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7"  value="Libre" class="ji" style="color:#19629E">'; 
}
}
//funcion 4 que recupera la información de las cuartas filas de asientos impares ventana derecho
function recover_info_destinations_d($bus, $dates, $place, $branch, $handle, $op)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
	$terminal=$recover["city"];
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse 
			if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="'.$terminal.'" style="color:#FF0033" class="ji"><br>'; //ocupado el asiento no puede ser vendido
	        } 
			if ($status=="r"){
		    //por si significa que el asiento esta reservado mostramos el icono verde limon
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji"><br>'; //ocupado el asiento esta en estado de reservado
		    }
	}
	else{
            if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji"><br>';
            }  
			if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>';	
			}	   
    }
	break;
	case($op==">");
	if($branch > $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse 
			if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="'.$terminal.'" style="color:#FF0033" class="ji"><br>'; //ocupado el asiento no puede ser vendido
	        } 
			if ($status=="r"){
		    //por si significa que el asiento esta reservado mostramos el icono verde limon
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji"><br>'; //ocupado el asiento esta en estado de reservado
		    }
	}
	else{
            if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji"><br>';
            }  
			if ($status=="v" || $status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>';	
			}	   
    }
	break;
}//fin del switch
} //fin del num rows
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>'; //el asiento esta libre puede ser vendido
}
}
//funcion 5 que recupera la información de la cuarta fila de asiento final impares ventana derecho
function recover_info_destinations_e($bus, $dates, $place, $branch, $handle, $op)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["destination"];	//contine el destino del viaje que realizara el bus
	$terminal=$recover["city"];
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
switch($op)
{	
	case($op=="<");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
			 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji"><br>'; //ocupado el asiento no puede ser vendido
	         }
			 if ($status=="r"){
		     //por si significa que el asiento esta reservado mostramos el icono verde limon
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji"><br>'; //ocupado el asiento esta en estado de reservado
			 }	
	}
	else{
             if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji"><br>';
             }
			 if ($status=="v" || $status=="r"){
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>';	 
			 }
    }
	break;
	case($op==">");
	if($branch < $destination){//por si significa que el destino final del pasajero es mi terminal por lo tando esta libre para venderse
			 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#FF0033" class="ji"><br>'; //ocupado el asiento no puede ser vendido
	         }
			 if ($status=="r"){
		     //por si significa que el asiento esta reservado mostramos el icono verde limon
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$terminal.'" style="color:#99FF00" class="ji"><br>'; //ocupado el asiento esta en estado de reservado
			 }	
	}
	else{
             if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji"><br>';
             }
			 if ($status=="v" || $status=="r"){
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>';	 
			 }
    }
	
	break;
}//fin del switch
} //fin del num rows
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>'; //el asiento esta libre puede ser vendido
}
}
?>