<?php
// FUNCIONES DE SEGURIDAD VALIDA A UN USUARIO */
// funcion que verifica que el usuario haya sido logeado correctamente
function check_valid_user_user($valid_user)
{
    if (isset($_SESSION['valid_user'])){
	  return true;
     }
     else{
     restricted_area();
	 exit;
     }
}
// funcion comodin ^_^
function view_menu_user_cp_2(){
	print('&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="http://www.arielmax.com.ar/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;');
}

// funcion que permite el acceso al administrador y super administrador
function check_valid_function_users($lv)
{
	if($lv=="ad" || $lv=="sa"){
	return true;
	}
	else{		
	restricted_area();
	}
}


//funcion que permite el acceso solo al super administrados

function check_valid_function_sa_only($lev)
{
	if($lev=="sa"){
	return true;
	}
	else{		
	restricted_area();
	}
}
// funcion que verifica si el sitio esta activado o desactivado
function active_system($act, $user)
{
	$res=$act->query("SELECT * FROM global_config");
	$site=$res->fetch_assoc();
	$active=$site["active_system"];
	$us=$act->query("SELECT user_name, level FROM users WHERE user_name='$user'");
	$lv=$us->fetch_assoc();
	$lev=$lv["level"];
	if($active=="si"){
	// verificamos su nivel	
		if($lev=="sa"){	
		$res->free();
		global $status_site;
		$status_site='<hr color="#FF0033"><center><h3><font color="red" face="Verdana, Geneva, sans-serif">¡ EXPRESS BUS SE ENCUENTRA DESACTIVADO !</font></h3></center><hr color="#FF0033">';
		}
		else{
		$inf=$act->query("SELECT * FROM global_config");
        $men=$inf->fetch_assoc();
		the_system_is_inactive($men);
		$inf->free();	
		// eliminamos la sesion del usuario 
   		$old_user = $valid_user;  
   		$result = session_unregister("valid_user");
   		session_destroy();
		exit;	
		}
	}
}
// si se quiere crear mas tipos de usuarios solo crea similares solo cambia los valores del if y llamalas en las paginas que deseas controlar */
?>