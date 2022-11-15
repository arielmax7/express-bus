<?php
//** LIBRERIA QUE VERIFICA LA VALIDES DE LOS CUADROS DE TEXTO EN FORMULARIO *//

// funcion que verifica si los campos de contraseñas estan vacias o incorrectas (editar perfil)
function check_password($pas1, $pas2)
{
	// declaramos variables globales de configuracion
	global $sta_pass; // indica si los cuadros de texto estan vacios
	// verificamos que si estos estan vacios
	if (!$pas1 || !$pas2){
	// colocamos un valor de false  ya que los dos o uno de los cuadros estan vacios
	$sta_pass="si";	
	}
	else{ // significa que los cuadros de texto no estan vacios
	       // verificamos que ambas casillas tengan la misma contraseña
	       if($pas1==$pas2){
			// significa que todo esta correcto   
			  $sta_pass="no"; 
		   }
		   else{
			// significa que no son iguales 
			  bad_mach_password();  		   
		   }
	}
}

// funcion que verifica que las contraseñas colocadas sean correctas
function check_box_password($pass1, $pass2)
{
	if($pass1==$pass2){
	echo '';	
	}
	else{
    // mensaje de error
    no_mactch_password_new_user();		
	}
}
?>