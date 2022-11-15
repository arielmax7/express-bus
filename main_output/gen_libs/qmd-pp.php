<?php
//** Libreria principal de consulta de generacion de asientos a la base de datos mostrando el estado de cada asiento *//
//funcion que recupera el status de las primeras filas asientos impares izquierdos cada asiento generado por gen libs  punto a punto (pp)
function check_status_places_a($bus, $dates, $place, $handle, $hr, $branch) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo a) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates' AND hour='$hr' AND in_branch='$branch'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contiEne el estado del asiento
			if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
    		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
    		}
			if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
			} 
			if ($status=="r"){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">';
			}
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_pp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser   
}
}

//funcion nuero 2  recupera el status de las segundas filas de asientos pares pasillo cada asiento generado por gen libs (mdx)
function check_status_places_b($bus, $dates, $place, $handle, $hr, $branch) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo b) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates' AND hour='$hr' AND in_branch='$branch'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	
			if ($status=="p"){
			 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';		
			}
       		if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       		echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	        }
	   	    if ($status=="r"){
		           //por si significa que el asiento esta reservado mostramos el icono verde limon
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado	
		   }
		        
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_pp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser vendido
}
}

//funcion numero 3  recupera el status de las terceras filas de asientos pares pasillo cada asiento generado por gen libs (mdx)
function check_status_places_c($bus, $dates, $place, $handle, $hr, $branch) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo c) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates' AND hour='$hr' AND in_branch='$branch'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	
			 if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
   			 }
			 		 
      		  if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       		  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
			  }
	          if ($status=="r"){
		           //por si significa que el asiento esta reservado mostramos el icono verde limon
			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado
			}
					   	
}
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_pp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser vendido
}
}

//funcion numero 4  recupera el status de las cuartas filas de asientos impares ventana cada asiento generado por gen libs (mdx)
function check_status_places_d($bus, $dates, $place, $handle, $hr, $branch) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo d) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates' AND hour='$hr' AND in_branch='$branch'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    //precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	
	       if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO..."><br>';
           }
		   
                 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
                 echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO"><br>'; //ocupado el asiento no puede ser vendido
	             }
	             if ($status=="r"){
		         //por si significa que el asiento esta reservado mostramos el icono verde limon
			     echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO"><br>'; //ocupado el asiento esta en estado de reservado
			     }	   
		  
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_pp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>'; //el asiento esta libre puede ser vendido
}
}

//funcion numero 5  recupera el status de la fila central de asientos generado por gen libs (mdx)
function check_status_places_e($bus, $dates, $place, $handle, $hr, $branch) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo e) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates' AND hour='$hr' AND in_branch='$branch'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
   
   
				if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO...">';
                }
				
    	
       			  if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO">'; //ocupado el asiento no puede ser vendido
	              }
	   			  if ($status=="r"){
		    	  //por si significa que el asiento esta reservado mostramos el icono verde limon
				  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO">'; //ocupado el asiento esta en estado de reservado
				  }	   
		   
	
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_pp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a>'; //el asiento esta libre puede ser vendido//libera
}
}

//funcion numero 6  recupera el status de la fila dercha final ventana de asientos generado por gen libs (mdx)
function check_status_places_f($bus, $dates, $place, $handle, $hr, $branch) //ingresan datos el numero de bus, fecha, asiento, terminal provenientes del generador (grupo e) *//
{
  $result = $handle->query("SELECT * FROM buses_temp WHERE id_bus='$bus' AND place='$place' AND dates='$dates' AND hour='$hr' AND in_branch='$branch'");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
  
			if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'s.png" border="0" title="EN PROCESO..."><br>';
            }
       			  if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
       			  echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'r.png" border="0" title="VENDIDO"><br>'; //ocupado el asiento no puede ser vendido
	   			  }
	   			  if ($status=="r"){
		    	  //por si significa que el asiento esta reservado mostramos el icono verde limon
				  echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/'.$place.'g.png" border="0" title="RESERVADO"><br>'; //ocupado el asiento esta en estado de reservado	 
				  }	   
		   
    
}
else{  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../ticket_pp.php?pl='.$place.'" target="_blank"><img src="images_bus/'.$place.'.png" border="0" title="LIBRE"></a><br>'; //el asiento esta libre puede ser vendido
}
}

//** Libreria principal de consulta de generacion de texto a la base de datos mostrando el destino de cada asiento *//
//funcion que recupera la información de las primeras filas de asientos impares ventana izquierda
function recover_info_destinations_a($bus, $dates, $place, $handle, $hr, $branch)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.hour='$hr' AND buses_temp.in_branch='$branch' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["city"];	//contine el destino del viaje que realizara el bus
	
			
	
    	   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
           }
   		   
       	        if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	            }
	            if ($status=="r"){
		        //por si significa que el asiento esta reservado mostramos el icono verde limon
	            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
				}	   
		   
     
}
else{ //fin del num rows  
// si no encuentra nigun resultado por logica el asiento estaradesocupado
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="Libre" style="color:#19629E" class="ji">'; //el asiento esta libre puede ser vendido
}
}

//funcion 2 que recupera la información de las segundas filas de asientos pares pasillo central izquierdo
function recover_info_destinations_b($bus, $dates, $place, $handle, $hr, $branch)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.hour='$hr' AND buses_temp.in_branch='$branch' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["city"];	//contine el destino del viaje que realizara el bus
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	
          if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
          }
          
                if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	            }
	            if ($status=="r"){
		        //por si significa que el asiento esta reservado mostramos el icono verde limon
			    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
				}	   
		   
    
}
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado //el asiento esta libre puede ser vendido
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji">'; 
}
}

//funcion 3 que recupera la información de las terceras filas de asientos pares pasillo central derecho
function recover_info_destinations_c($bus, $dates, $place, $handle, $hr, $branch)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.hour='$hr' AND buses_temp.in_branch='$branch' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["city"];	//contine el destino del viaje que realizara el bus
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	
    	   if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
           echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji">';
           }
          
                 if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
                 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#FF0033" class="ji">'; //ocupado el asiento no puede ser vendido
	             }
	             if ($status=="r"){
		         //por si significa que el asiento esta reservado mostramos el icono verde limon
	             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#99FF00" class="ji">'; //ocupado el asiento esta en estado de reservado
				}	   
		   
	 
}
else{
    // si no encuentra nigun resultado por logica el asiento estaradesocupado //el asiento esta libre puede ser vendido
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7"  value="Libre" class="ji" style="color:#19629E">'; 
}
}

//funcion 4 que recupera la información de las cuartas filas de asientos impares ventana derecho
function recover_info_destinations_d($bus, $dates, $place, $handle, $hr, $branch)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.hour='$hr' AND buses_temp.in_branch='$branch' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["city"];	//contine el destino del viaje que realizara el bus
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado	 
            if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji"><br>';
            }
           
                  if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
                  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  size="7" value="'.$destination.'" style="color:#FF0033" class="ji"><br>'; //ocupado el asiento no puede ser vendido
	              }
	              if ($status=="r"){
		          //por si significa que el asiento esta reservado mostramos el icono verde limon
			      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#99FF00" class="ji"><br>'; //ocupado el asiento esta en estado de reservado
				  }	   
		   
    
} //fin del num rows
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>'; //el asiento esta libre puede ser vendido
}
}

//funcion 5 que recupera la información de la cuarta fila de asiento final impares ventana derecho
function recover_info_destinations_e($bus, $dates, $place, $handle, $hr, $branch)
{
  $result = $handle->query("SELECT * FROM buses_temp, branch WHERE buses_temp.id_bus='$bus' AND buses_temp.place='$place' AND buses_temp.dates='$dates' AND buses_temp.hour='$hr' AND buses_temp.in_branch='$branch' AND buses_temp.destination=branch.order_travel");
  //verificamos si existe coincidencia (comprobamos si el asiento esta vacio o ocupado)
if ($result->num_rows > 0){
    //recuperamos la informacion del asiento *//
    $recover=$result->fetch_assoc();	
    $status=$recover["status"]; //contine el estado del asiento
    $destination=$recover["city"];	//contine el destino del viaje que realizara el bus
	//precedemmos a realizar los proceso y comparaciones segun el resultado mostramos un icono adecuado
	
             if ($status=="p"){ //por si significa que el asiento esta en proceso los usuarios no podran efecctuar ninguna accion
             echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Procesando..." style="color:#7F8180" class="ji"><br>';
             }
            
                   if ($status=="v"){ //por si significa que el asiento esta vendido mostramos el icono de asiento en color rojo
                   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#FF0033" class="ji"><br>'; //ocupado el asiento no puede ser vendido
	               }
	               if ($status=="r"){
		           //por si significa que el asiento esta reservado mostramos el icono verde limon
			       echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="'.$destination.'" style="color:#99FF00" class="ji"><br>'; //ocupado el asiento esta en estado de reservado
				   }	   
		     
    
} //fin del num rows
else{
// si no encuentra nigun resultado por logica el asiento estaradesocupado
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="7" value="Libre" style="color:#19629E" class="ji"><br>'; //el asiento esta libre puede ser vendido
}
}
function recover_info_backs_c()
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/left_c.png" width="10" height="14">';	
	
}
function recover_info_backs_d()
{
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images_bus/back.png" width="69" height="81">';	
	
}
?>