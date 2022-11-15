<?php
//** TERCERA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DE LOS USUARIOS *//

// funcion que muestra todas las terminales al super administrados para poder cambiar en su perfil
function view_branch_for_users($handle, $level, $branch, $id_loc)
{
	// verificamos su nivel si este es usuario o administrador solo se mostrara su sucursal
	if ($level=="ad" || $level=="us"){
	// efectuamos la consulta a la base de datos para recuperar las sucursales
	echo '<option value='.$id_loc.'>'.$branch.'</option>';
	
	}
	else{
		if($level=="sa"){ 
		$result=$handle->query("SELECT city, id_locations FROM branch WHERE city='$branch'");
		// mostramos las terminales utilizando un loop while
		while ($row=$result->fetch_assoc()){	
		echo '<option value='.$row["id_locations"].'>'.$row["city"].'</option>';
		}
	    $result=$handle->query("SELECT city, id_locations FROM branch WHERE not(city='$branch')");
		// mostramos las terminales utilizando un loop while
		while ($row=$result->fetch_assoc()){	
		echo '<option value='.$row["id_locations"].'>'.$row["city"].'</option>';
	}
	$result->free();
		}
	}
}
// funcion que verifica la disponivilidad de un email si este a cambiado o no
function check_email_my_profile($handle, $mail, $us)
{
	// efectuamos la consulta
	$result=$handle->query("SELECT user_name,email FROM users WHERE user_name='$us' AND email='$mail'");
	// verificamos
	if($result->num_rows > 0){ // esto significa que el email no a cambiado  no efectuamos la actualizacion
	$result->free();		
	return true;	
	}
	else{
	// significa que el email ha cambiado verificamos si esta disponible
	    $verify=$handle->query("SELECT email FROM users WHERE email='$mail'");
	    // verificamos
		if($verify->num_rows > 0){
		// significa que el email esta en uso
	    $verify->free();
		already_email();	
		exit;
		}
		else{ // significa que el email esta libre procedemos a actualizar
		$handle->query("UPDATE users SET email='$mail' WHERE user_name='$us'");
		}
	}
}

// funcion que  actualiza las vistas
function view_list_for_user($handle,$limit,$op_sa,$user,$lv,$location)
{

if(!empty($limit)){
	// significa que esta cambiano vista de usuarios
	$handle->query("UPDATE paging_settings SET views='$limit' WHERE id_user='$user'");
	echo "<script>	
		window.location.replace('users.php');
		</script>";
}

global $num_reg; // contiene el numero de registros a mostrar para este usuario
global $v_branch; // contiene la sucursal a mostrar solo para el super admin
// recuperamos la paginacion del usuario si este no establecio un parametro se obtendra el parametro del sistema
$pagin=$handle->query("SELECT * FROM paging_settings WHERE id_user='$user'");
$re=$pagin->fetch_assoc();
$num_reg=$re["views"];
$v_branch=$re["nam_loc"];	
$v_branch=$location;		

}

// funcion que muestra todos los usuarios con sus datos mas relebantes
function view_branch_users_sa_all($handle, $level, $branch, $us, $search, $num_reg, $v_branch, $id_loc)
{		
	

	if($search==1){
		
	switch($level)
	{
	case($level=="ad" || $level=="sa"); // solo seran mostrados los usuarios correspondientes a la terminal de dicho administrador por seguridad el administrador no sera visializado
	// creamos la paginacion
	include_once("paginacion.php"); // incluimos el archivo donde esta  nuestra clase paginacion
    $link = $handle; // pasamos los parametros de nuestra conexion	
	$query = "SELECT * FROM users WHERE id_location='$id_loc' AND NOT(user_name='$us') AND NOT(level='sa') ORDER BY user_name";
	$rsT =  $link->query($query); 
	$total = $rsT->num_rows; 
	if(isset($_GET['page'])){
				$pg = $_GET['page'];
				}
				else{
					
				$pg = 0;	
				}
	$cantidad = 50; // Cantidad de registros que se desea mostrar por pagina, Para probar solo le coloque 50
	$paginacion = new paginacion($cantidad, $pg); // llamo a mi clase paginacion y por defecto le paso 2 variables.
	$desde = $paginacion->getFrom();
	// consulta para mostrar los datos de acuerdo ala cantidad	
	$query = "SELECT * FROM users, branch WHERE users.id_location='$id_loc' AND users.id_location=branch.id_locations AND NOT(users.user_name='$us') AND NOT(users.level='sa')  ORDER BY users.user_name LIMIT $desde, $cantidad"; 
	// recuperamos los registros deacuerdo al tipo de usuario
	$rs = $link->query($query);
	// Fin de la paginacion
		// mostramos utilizando un loop while *//
        while ($row = $rs->fetch_assoc()){
		$id=$row["dni"]; // identificador del usuario
		echo '<td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="Comprobación para fila 1" type="checkbox"></td>';
		echo '<td class="left">'.
	    $row["name_user"].'&nbsp;&nbsp;'.$row["name_user1"].'&nbsp;&nbsp;'.$row["name_user2"].'</td>';
		echo '<td class="center">'.
		$row["user_name"].'</td>';
		echo '<td class="center">';
		echo $row["dni"];
		echo '</td>';
		echo '<td class="center">';
		echo $row["address_user"];
		echo '</td>';
		echo '<td class="center">'.
		$row["email"].'</td>';
	    echo '<td class="center">'.
		$row["level"].'</td>';
		echo '<td class="center">'.
		$row["points"].'</td>';
		echo '<td class="center">'.
		$row["phone_user"].'</td>';
		echo '<td class="center">'.
		$row["registered_user"].'</td>';
		echo '<td class="center">'.
		$row["city"].'</td></tr>';
		echo '<tr class="row1">';
		}
		// mostramos los links de la paginacion
		echo '<div class="paginacion"><br />';
		$url = "users.php?"; // url donde va a cargar de nuevo la pagina
		$classCss = "numPages"; // Clase CSS que queremos asignarle a los links 
		$back = "&laquo;Atras"; // textos atras
		$next = "Siguiente&raquo;"; // textos siguiente
	    $paginacion->generaPaginacion($total, $back, $next, $url, $classCss); // llamo a mi metodo que es el que contiene la estructura de la paginacion
	    echo '</div>';
		break;
		case($level=="sa"); // muestra todos los usuarios de todas las terminales incluyebdo el super admin
		// creamos la paginacion
		include_once("paginacion.php"); //incluimos el archivo donde esta  nuestra clase paginacion
  	  	$link = $handle; // pasamos los parametros de nuestra conexion	
	
		if(empty($v_branch)){
		// significa que no esta seleccinando por terminal
		$query = "SELECT * FROM users";	
	}
    else{
	// significa que esta filtrando por terminal
	
	$query = "SELECT * FROM users WHERE id_location='$id_loc'";		
	}
	$rsT =  $link->query($query); 
	$total = $rsT->num_rows; 
	if(isset($_GET['page'])){
				$pg = $_GET['page'];
				}
				else{
					
				$pg = 0;	
				}
	
	$cantidad = $num_reg; // Cantidad de registros que se desea mostrar por pagina, Para probar solo le coloque 50
	$paginacion = new paginacion($cantidad, $pg); //  llamo a mi clase paginacion y por defecto le paso 2 variables.
	$desde = $paginacion->getFrom();
	if(empty($v_branch) || $v_branch=="all"){
	// significa que no esta filtrando por sucursal	
	$query = "SELECT * FROM users, branch WHERE users.id_location=branch.id_locations ORDER BY user_name LIMIT $desde, $cantidad"; // consulta para mostrar los datos de acuerdo ala cantidad		
	}
	else{
	// significa que esta filtrando por sucursal	
	$query = "SELECT * FROM users, branch WHERE users.id_location='$v_branch' AND branch.id_locations='$v_branch' ORDER BY users.name_user LIMIT $desde, $cantidad"; // consulta para mostrar los datos de acuerdo ala cantidad		
	}
	// recuperamos los registros deacuerdo al tipo de usuario
	$rs = $link->query($query);
	// Fi de la Paginacion
		// mostramos utilizando un loop while *//
        while ($row = $rs->fetch_assoc()){
		$id=$row["dni"]; // identificador del usuario
		echo '<td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="Comprobación para fila 1" type="checkbox"></td>';
		echo '<td class="left">'.
	    $row["name_user"].'&nbsp;&nbsp;'.$row["name_user1"].'&nbsp;&nbsp;'.$row["name_user2"].'</td>';
		echo '<td class="center">'.
		$row["user_name"].'</td>';
		echo '<td class="center">';
		echo $row["dni"];
		echo '</td>';
		echo '<td class="center">';
		echo $row["address_user"];
		echo '</td>';
		echo '<td class="center">'.
		$row["email"].'</td>';
	    echo '<td class="center">'.
		$row["level"].'</td>';
		echo '<td class="center">'.
		$row["points"].'</td>';
		echo '<td class="center">'.
		$row["phone_user"].'</td>';
		echo '<td class="center">'.
		$row["registered_user"].'</td>';
		echo '<td class="center">'.
		$row["city"].'</td></tr>';
		echo '<tr class="row1">';
		}
		// mostramos los links de la paginacion
		echo '<center><div class="paginacion"><br />';
		$url = "users.php?"; // url donde va a cargar de nuevo la pagina
		$classCss = "numPages"; // Clase CSS que queremos asignarle a los links 
		$back = "&laquo;Atras"; // textos atras
		$next = "Siguiente&raquo;"; // textos siguiente
		$paginacion->generaPaginacion($total, $back, $next, $url, $classCss); // llamo a mi metodo que es el que contiene la estructura de la paginacion
		echo '</div></center><br>';
		break;
	}
	}
	else{
	// significa que esta buscando	
	switch($level)
	{
		case($level=="sa" || $level=="ad"); // muestra todos los usuarios de todas las terminales incluyebdo el super admin
		$result=$handle->query("SELECT * FROM users, branch WHERE users.id_location=branch.id_locations AND name_user like '%$search%' OR name_user1 like '%$search%' OR name_user2 like '%$search%'");
		// mostramos utilizando un loop while *//
        while ($row=$result->fetch_assoc()){
		$id=$row["dni"]; // identificador del usuario
		echo '<td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="Comprobación para fila 1" type="checkbox"></td>';
		echo '<td class="left">'.
	    $row["name_user"].'&nbsp;&nbsp;'.$row["name_user1"].'&nbsp;&nbsp;'.$row["name_user2"].'</td>';
		echo '<td class="center">'.
		$row["user_name"].'</td>';
		echo '<td class="center">';
		echo $row["dni"];
		echo '</td>';
		echo '<td class="center">';
		echo $row["address_user"];
		echo '</td>';
		echo '<td class="center">'.
		$row["email"].'</td>';
	    echo '<td class="center">'.
		$row["level"].'</td>';
		echo '<td class="center">'.
		$row["points"].'</td>';
		echo '<td class="center">'.
		$row["phone_user"].'</td>';
		echo '<td class="center">'.
		$row["registered_user"].'</td>';
		echo '<td class="center">'.
		$row["city"].'</td></tr>';
		echo '<tr class="row1">';
		}
		$result->free();
		break;
	}	
	// fin de la busqueda	
	}
}

// funcion que verifica el nivel del usuario utilizando su id esto para evitar la eliminacion del super administrador
function ckeck_sa_user($handle, $id)
{	
	$result=$handle->query("SELECT level,dni FROM users WHERE dni='$id'");
	$com=$result->fetch_assoc();
	$sa=$com["level"];
	if($sa=="sa"){
	// significa que se esta intentado bloquear, eliminar al super admin	
	no_deactive_sa();	
	}
	else{
	// continua su paso
	// cerramos la conexion
	$result->free();
	}
}

// funcion que elimina permanentemente a un usuario
function remove_user_for_system($handle, $id_user)
{
	ckeck_sa_user($handle, $id_user);
	//recuperamos el usuario para eleliminar el resto de perfiles del usuario	
	$result=$handle->query("SELECT user_name, dni FROM users WHERE dni='$id_user'");
	$com=$result->fetch_assoc();
	$us=$com["user_name"];
	// efectuamos la eliminaciones necesarias
	$handle->query("DELETE FROM paging_settings WHERE id_user='$us'");
	$handle->query("DELETE FROM users_online WHERE id_user='$us'");
	$handle->query("DELETE FROM users WHERE dni='$id_user'");
	$handle->query("DELETE FROM bus_for_user WHERE user_name='$id_user'");
	$handle->query("DELETE FROM chat_users WHERE username='$id_user'");
	$handle->query("DELETE FROM config_mp WHERE user_name='$id_user'");
	// mostramos mensaje de confirmacion
	ok_remove_user();
}

// funcion que recupera toda la informacion del usuario seleccionado utilizando su id
function recover_all_info_user_selected($handle, $id_user)
{
	// efectuamos la consulta 
	$result=$handle->query("SELECT * FROM users, branch WHERE dni='$id_user' AND users.id_location=branch.id_locations");
	$recover=$result->fetch_assoc();
	// declaramos variables globales que tendran toda la info del usuario
	global $name_user; // contiene el nombre real del usuario
	global $last_name_user1; // contiene el apelido del usuario
	global $last_name_user2; // contiene el apelido del usuario
	global $address_user; // contiene la direcion del usuario
	global $phone_user; // contiene el numero telefonico del usuario
	global $access_name; // contiene el nombre de usuario
	global $email_user; // contiene el correo electronico del usuario
	global $registered_user; // contiene la fecha de registro del usuario
	global $level_user; // contiene el nivel de sistema del usuario
	global $location_user; // contiene la teerminal o sucursal del usuario
	// recupermos y almacenamos
	$name_user=$recover["name_user"];
	$last_name_user1=$recover["name_user1"];
	$last_name_user2=$recover["name_user2"];
	$address_user=$recover["address_user"];
	$phone_user=$recover["phone_user"];
	$access_name=$recover["user_name"];
	$email_user=$recover["email"];
	$registered_user=$recover["registered_user"];
	$level_user=$recover["level"];
	$location_user=$recover["city"];
	$result->free();
}

// funcione que verifica la disponibilidad del id //**
function check_free_user($link, $user)
{
	$free=$link->query("SELECT * FROM users WHERE user_name='$user'"); 
	if($free->num_rows > 0){
	already_user();	
	}
	$free->free();
}

// funcion que verifica la disponibilidad del email //**
function check_free_mail_user($link, $mail)
{
	$free=$link->query("SELECT * FROM users WHERE email='$mail'"); 
	if($free->num_rows > 0){
	already_email_user();	
	}
	$free->free();
}

// funcion que realiza la acuatilazion de la informacion del usuario
function process_update_user($handle, $name_user, $last_name_user1, $last_name_user2, $address_user, $phone_user, $id_user, $email_user, $level_user, $branch, $us)
{ 
	// verificamos si cambio el nombre de usuario
	$result = $handle->query("SELECT * FROM users WHERE user_name='$us' AND dni='$id_user'");
	if($result->num_rows > 0){
	// significa que no cambio el nombre de usuario
							// verifiacmo si cambio el email
							$result=$handle->query("SELECT * FROM users WHERE dni='$id_user' AND email='$email_user'");	
							if($result->num_rows > 0){
							// significa que no cambio el email
							//** Actualizamos los datos menos user_name ni email
							$handle->query("UPDATE users SET name_user='$name_user',name_user1='$last_name_user1',name_user2='$last_name_user2',address_user='$address_user',phone_user='$phone_user',id_location='$branch',level='$level_user' ".
							"WHERE dni='$id_user'");
							$result->free();
							ok_update_user_selected();	
							}
							else{
							// significa que cambio el email
							// verificamos su disponibilidad
							check_free_mail_user($handle, $email_user);	
							//** Actualizamos email menos el user_name
							$handle->query("UPDATE users SET name_user='$name_user',name_user1='$last_name_user1',name_user2='$last_name_user2',address_user='$address_user',".
							"phone_user='$phone_user',email='$email_user',id_location='$branch',level='$level_user' ".
							"WHERE dni='$id_user'");
							ok_update_user_selected();
							}
	}
	else{
	// significa que cambio el nombre de usuario	
							// verificamos si cambio el email
							$result=$handle->query("SELECT * FROM users WHERE dni='$id_user' AND email='$email_user'");
							if($result->num_rows > 0){
							// significa que no cambio el mail
							// verificamos la disponibilidad del usuario
							check_free_user($handle, $us);
							//** Actualizamos los datos menos el email	
							$handle->query("UPDATE users SET name_user='$name_user',name_user1='$last_name_user1',name_user2='$last_name_user2',address_user='$address_user',".
							"phone_user='$phone_user',id_location='$branch',level='$level_user' ".
							"WHERE dni='$id_user'");
							$result->free();
							ok_update_user_selected();
							}
							else{
							// significa que cambio el mail y el usuario	
							// verificamos la disponibilidad de ambos
							// verificamos la disponibilidad del usuario
							check_free_user($handle, $us);
							// verificamos su disponibilidad
							check_free_mail_user($handle, $email_user);
							//** Actualizamos todos los datos
							$handle->query("UPDATE users SET user_name='$us',name_user='$name_user',name_user1='$last_name_user1',name_user2='$last_name_user2',address_user='$address_user',".
							"phone_user='$phone_user',email='$email_user',id_location='$branch',level='$level_user'".
							"WHERE dni='$id_user'");	
							ok_update_user_selected();	
							}
	}
}

// funcion que recupera todos los usuarios al super admin menos asi mismo
function list_users_all($handle, $lv, $user, $branch)
{
	if($lv=="super-administrador"){ // muestra todos los usuarios ecepto el
	$result=$handle->query("SELECT * FROM users WHERE NOT(user_name='$user')");
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["user_name"].'>'.$row["user_name"].' ('.$row["location"].')</option>';	
	}
	$result->free();	
	}
	else{
	$result=$handle->query("SELECT * FROM users WHERE location='$branch' AND NOT(user_name='$user')");
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["user_name"].'>'.$row["user_name"].' ('.$row["location"].')</option>';	
	}
	$result->free();
	}
}

// funcion que verifica la disponibilidad del nuevo usuario (2)
function exist_new_user($link, $user)
{
	$result=$link->query("SELECT user_name FROM users WHERE user_name='$user'"); 
	if($result->num_rows > 0){
	// significa que el nombre de usuario ya esta en uso	
	already_user_new();	
	}
}

// funcion que verifica la disponibilidad del nuevo email (2)
function exist_new_email($link, $mail)
{
	$result=$link->query("SELECT email FROM users WHERE email='$mail'");
	if($result->num_rows > 0){
	// significa que el email ya esta en uso o es incorrecto
	already_user_email_new();	
	}	
}

// funcion que verifica la disponibilidad del nuevo id (2)
function exist_new_id($link, $id)
{
	$result=$link->query("SELECT dni FROM users WHERE dni='$id'");
	if($result->num_rows > 0){
	// significa que el id ya esta en uso
	already_user_id_new();
	}
	$result->free();	
}

// funcion que guarda un nuevo usuario en la base de datos
function add_new_user($handle, $task, $name_user, $last_name_user,$last_name_user2, $address_user, $phone_user, $acces_name, $password1, $password2, $email_user, $register_date, $id_user, $branch, $level_user)
{
	// efectuamos la insertcion de los datos en la tabla users
	// verificamos si tiene telefono
	if(empty($phone_user)){
	// significa que no tiene telefono
	$phone_user=0;	
	}
	// verificamos los campor de contraseña
	check_box_password($password1, $password2);
	// verificamos la disponibilidad del usuario
    exist_new_user($handle, $acces_name);
	// verificamos la disponibilidad del email
	exist_new_email($handle, $email_user);
	// verificamos la disponibilidad del ID
	exist_new_id($handle, $id_user);

	// si todo esta correcto procedemos a realizar la insercion del nuevo usuario
	$handle->query("INSERT INTO users VALUES('$acces_name','$name_user','$last_name_user','$last_name_user2','$address_user','$phone_user','$email_user','$branch',MD5('$password1'),".
	"'$id_user','$level_user','$register_date','0')");
	// insertamos los datos de paginacion que tendra el usuario por defecto
	$handle->query("INSERT INTO paging_settings (id_user,views,view_date,view_date_to,nam_loc) VALUES('$acces_name','50','$register_date','$register_date','$branch')");
	// verificamos el valor del task
	if($task=="save"){
	// mostramos mensaje de confirmacion redireccionamos a la ventana principal users
	ok_add_new_user();
	}
	else{
	// redireccionamos a la misma ventana new user para agregar otro usuario
	ok_add_new_user_2();
	// colocar aqui la funcion
	}
}
?>