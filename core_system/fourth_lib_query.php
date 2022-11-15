<?php
//** CUARTA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DE LOS MENSAJES (MAILS) *//
// funcion que recupera todos los emails segun la opcion seleccionada
function view_all_mails_us($handle, $filter_state, $us, $num_reg)
{
	$filter_search;
	// busqueda
	if(empty($filter_search)){
    // buscamos la opcion seleccionada
	switch($filter_state)
	{
	// mostramos todos los correos en general menos los que fueron enviados a la papelera de reciclaje
	case($filter_state== empty($filter_state) || $filter_state=="all");
	// iniciamos la paginacion
	include_once("paginacion.php"); // incluimos el archivo donde esta  nuestra clase paginacion
    $link = $handle; // pasamos los parametros de nuestra conexion	
	$query = "SELECT * FROM mails WHERE destin='$us' AND NOT(recycling='si')";
	$rsT =  $link->query($query); 
	$total = $rsT->num_rows; 
	if(isset($_GET['page'])){
				$pg=$_GET['page'];
				}
				else{
					
				$pg = 0;	
				}
	
	$cantidad = $num_reg; // Cantidad de registros que se desea mostrar por pagina, Para probar solo le coloque 3
	$paginacion = new paginacion($cantidad, $pg); // llamo a mi clase paginacion y por defecto le paso 2 variables.
	$desde = $paginacion->getFrom();
	
	$query = "SELECT * FROM mails, branch, users WHERE mails.destin='$us' AND mails.mail_location=branch.id_locations AND users.user_name=mails.remit AND NOT(mails.recycling='si') ORDER BY  mails.date_send LIMIT $desde, $cantidad"; // consulta para mostrar los datos de acuerdo ala cantidad	
	// recuperamos los registros deacuerdo al tipo de usuario
	$rs = $link->query($query);	
	// mostramos la informacion utilizando un loop while
	while ($row = $rs->fetch_assoc()){
	$read=$row["read_men"];	// verifica si el mensaje ha sido leido o no
	$file=$row["file_send"]; // verifica si es un email o un archivo enviado	
	$id=$row["id_mail"]; // identificador del email
	echo '<tr class="row0"><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="De '.$row["remit"].'" type="checkbox"></td>';
	echo '<td><a href="open_message.php?msg='.$id.'">' .
	$row["name_user"] .'&nbsp;'.$row["name_user1"].'</a></td>';
	echo '<td>';
	     if($read=="si"){
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/mail-open-send.png"></a>';
		 }
		 else{
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/004.png" border="0"></a>';
		 }
	echo '</td>'; 
	echo '<td>' .
	$row["subject"] .'</td>';
	echo '<td>';
	      if($file=="si"){
			  echo '<img src="templates/images/admin/file_extension_rar.png">';
		  }
		  else{
			  echo '<img src="templates/images/admin/notepad_2.png">';
		  }
	echo '</td>';
	echo '<td>' .
	$row["date_send"] .'</td>';
	echo '<td>' .
	$row["city"] .'</td>';
	echo '<td></tr></a>';
    }	
	echo '<center><div class="paginacion"><br />';
	$url = "mails.php?"; // url donde va a cargar de nuevo la pagina
	$classCss = "numPages"; // Clase CSS que queremos asignarle a los links 
	$back = "&laquo;Atras"; // textos atras
	$next = "Siguiente&raquo;"; // textos siguiente
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss); // llamo a mi metodo que es el que contiene la estructura de la paginacion
	echo '</div></center>';
	break;
	case($filter_state=="read_only"); // muestra todos los mensajes ya leidos
	// mostramos todos los correos en general menos los que fueron enviados a la papelera de reciclaje
	case($filter_state== empty($filter_state) || $filter_state=="all");
		
	$result=$handle->query("SELECT * FROM mails,users,branch WHERE mails.destin='$us' AND mails.read_men='si' AND users.user_name=remit AND mails.mail_location=branch.id_locations AND NOT(mails.recycling='si') ORDER BY mails.date_send LIMIT 0,500");
	while ($row=$result->fetch_assoc()){
	$read=$row["read_men"];	// verifica si el mensaje ha sido leido o no
	$file=$row["file_send"]; // verifica si es un email o un archivo enviado	
	$id=$row["id_mail"]; // identificador del email
	echo '<tr><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="De '.$row["remit"].'" type="checkbox"></td>';
	echo '<td><a href="open_message.php?msg='.$id.'">' .
	$row["name_user"] .'&nbsp;'.$row["name_user1"].'</a></td>';
	echo '<td>';
	     if($read=="si"){
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/mail-open-send.png"></a>';
		 }
		 else{
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/004.png"></a>';
		 }
	echo '</td>'; 
	echo '<td>' .
	$row["subject"] .'</td>';
	echo '<td>';
	      if($file=="si"){
			  echo '<img src="templates/images/admin/file_extension_rar.png">';
		  }
		  else{
			  echo '<img src="templates/images/admin/notepad_2.png">';
		  }
	echo '</td>';
	echo '<td>' .
	$row["date_send"] .'</td>';
	echo '<td>' .
	$row["city"] .'</td>';
	echo '<td></tr>';
    }	
	break;
	case($filter_state=="no_read_only"); // muestra todos los mensajes no leidos
	// mostramos todos los correos en general menos los que fueron enviados a la papelera de reciclaje
	case($filter_state== empty($filter_state) || $filter_state=="all");
	$result=$handle->query("SELECT * FROM mails,users,branch WHERE mails.destin='$us' AND mails.read_men='no' AND mails.remit=users.user_name AND mails.mail_location=branch.id_locations AND NOT(mails.recycling='si') ORDER BY mails.date_send LIMIT 0,500");
	while ($row=$result->fetch_assoc()){
	$read=$row["read_men"];	// verifica si el mensaje ha sido leido o no
	$file=$row["file_send"]; // verifica si es un email o un archivo enviado	
	$id=$row["id_mail"]; // identificador del email
	echo '<tr><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="De '.$row["remit"].'" type="checkbox"></td>';
	echo '<td><a href="open_message.php?msg='.$id.'">' .
	$row["name_user"] .'&nbsp;'.$row["name_user1"].'</a></td>';
	echo '<td>';
	     if($read=="si"){
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/mail-open-send.png"></a>';
		 }
		 else{
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/004.png"></a>';
		 }
	echo '</td>'; 
	echo '<td>' .
	$row["subject"] .'</td>';
	echo '<td>';
	      if($file=="si"){
			  echo '<img src="templates/images/admin/file_extension_rar.png">';
		  }
		  else{
			  echo '<img src="templates/images/admin/notepad_2.png">';
		  }
	echo '</td>';
	echo '<td>' .
	$row["date_send"] .'</td>';
	echo '<td>' .
	$row["city"] .'</td>';
	echo '<td></tr>';
    }	
	break;
	case($filter_state=="recycled"); // muestra los mensajes que estan en la papelera
	//mos tramos todos los correos en general menos los que fueron enviados a la papelera de reciclaje
	case($filter_state== empty($filter_state) || $filter_state=="all");
	$result=$handle->query("SELECT * FROM mails,users,branch WHERE mails.destin='$us' AND mails.recycling='si' AND mails.remit=users.user_name AND mails.mail_location=branch.id_locations ORDER BY mails.date_send LIMIT 0,500");
	
	while ($row=$result->fetch_assoc()){
	$read=$row["read_men"];	// verifica si el mensaje ha sido leido o no
	$file=$row["file_send"]; // verifica si es un email o un archivo enviado	
	$id=$row["id_mail"]; // identificador del email
	echo '<tr><td class="center"><input id="cb0" name="cid" value='.$id.' onclick="isChecked(this.checked);" title="De '.$row["remit"].'" type="checkbox"></td>';
	echo '<td><a href="open_message.php?msg='.$id.'">' .
	$row["name_user"] .'&nbsp;'.$row["name_user1"].'</a></td>';
	echo '<td>';
	     if($read=="si"){
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/mail-open-send.png"></a>';
		 }
		 else{
			 echo '<a href="open_message.php?msg='.$id.'"><img src="templates/images/admin/004.png"></a>';
		 }
	echo '</td>'; 
	echo '<td>' .
	$row["subject"] .'</td>';
	echo '<td>';
	      if($file=="si"){
			  echo '<img src="templates/images/admin/file_extension_rar.png">';
		  }
		  else{
			  echo '<img src="templates/images/admin/notepad_2.png">';
		  }
	echo '</td>';
	echo '<td>' .
	$row["date_send"] .'</td>';
	echo '<td>' .
	$row["city"] .'</td>';
	echo '<td></tr>';
    }	
	break;
}
	}
	
}

// funcion que configura lista de registros am  mostrar
function view_reg_for_user_mails($handle, $limit, $user)
{
	
	if(!empty($limit)){
	// significa que esta cambiando la vista numero de registros a mostrar	
	$handle->query("UPDATE paging_settings SET views='$limit' WHERE id_user='$user'");
	echo "<script>	
		window.location.replace('mails.php');
		</script>";
	}
	global $num_reg; // contiene el numero de registros a mostrar para este usuario
	// recuperamos la paginacion del usuario si este no establecio un parametro se obtendra el parametro del sistema
    $pagin=$handle->query("SELECT * FROM paging_settings WHERE id_user='$user'");
    $re=$pagin->fetch_assoc();
    $num_reg=$re["views"];	
}

// funcion que marca un mensaje como leido
function read_message_marck($handle, $id_mail)
{
	// cambiamos el estado del mensaje
	$handle->query("UPDATE mails SET read_men='si' WHERE id_mail='$id_mail'");
	// enviamos un mensaje de confirmacion
	ok_read_mail();
}

// funcion que marca un mensaje como no leido
function no_read_message_marck($handle, $id_mail)
{
	// cambiamos el estado del mensaje
	$handle->query("UPDATE mails SET read_men='no' WHERE id_mail='$id_mail'");
	// enviamos un mensaje de confirmacion
	ok_no_read_mail();
}

// funcion que envia el mesaje a la papelera
function trash_message_marck($handle, $id_mail)
{
	 // cambiamos el estado del mensaje
	 $handle->query("UPDATE mails SET recycling='si' WHERE id_mail='$id_mail'");
	 // enviamos un mensaje de confirmacion
	 ok_trash_message();
}

// funcion que elimina de forma permanete el mensaje
function remove_message_marck($handle, $id_mail)
{
	// si este un un archivo tambien lo eliminamos primero recuperamos su direccion de url
	$result=$handle->query("SELECT id_mail,url_archive FROM mails WHERE id_mail='$id_mail'");
	$delete=$result->fetch_assoc();
	$file=$delete["url_archive"];
	if($file=="no"){
	// significa que no es un archivo	
	// eliminamos el mensaje
	$handle->query("DELETE FROM mails WHERE id_mail='$id_mail'");
	$result->free();
	// enviamos un mensaje de confirmacion
	ok_remove_message();
	}
	else{
	// significa que es un archivo lo eliminamos	
    $dir=$file; // puedes usar dobles comillas si quieres 
	// eliminamos de la base de datos
	$handle->query("DELETE FROM mails WHERE id_mail='$id_mail'");
    if(file_exists($dir)) 
    { 
    if(unlink($dir)) 
	// enviamos un mensaje de confirmacion
	ok_remove_message();
    } 
    else 
    no_precess_remove_file();
	}
}

// funcion que muestra el contenido el mensaje seleccionado de la lista
function open_message($handle, $id_mail)
{
	// efectuamos la consulta
	$result = $handle->query("SELECT * FROM mails, branch, users WHERE mails.id_mail='$id_mail' AND mails.mail_location=branch.id_locations AND users.user_name=mails.remit");
	$recover=$result->fetch_assoc();
	// declaramos variables globales
	global $from1; // contiene al remitente o quien envio el mensaje
	global $from;
	global $date_send; // contiene la fecha en el que fue enviado
	global $subject; // contiene el asunto del mensaje
	global $message; // contiene el mensaje
	global $loc; // contiene la terminal de deonde fue enviado
	global $file; // contiene si es un archi o no
	global $url_file; // contiene la url de descarga del archivo
	global $file_size; // contiene el tamaño del archivo
    // asignamos los datos recuperados
	$from1=$recover["name_user"].'&nbsp;'.$recover["name_user1"];
	$from=$recover["remit"];
	$date_send=$recover["date_send"];
	$subject=$recover["subject"];
	$message=$recover["message"];
	$loc=$recover["city"];
	$file=$recover["file_send"];
	$url_file=$recover["url_archive"];
	$file_size=$recover["size_file"];
	$result->free();
}

// funcion que cambia el estado del mensaje cuando este ha sido abierto
function open_message_for_user($handle, $id_mail)
{
	// efecuamos el cambio de estado a leido
	$handle->query("UPDATE mails SET read_men='si' WHERE id_mail='$id_mail'");	
}

// funcion que recupera los usuarios y su terminal
function recover_users_and_branch($handle, $user)
{
	// efectuamos la consulta
	$result=$handle->query("SELECT user_name,name_user,name_user1,id_location,id_locations,city FROM users, branch WHERE users.id_location=branch.id_locations AND NOT(user_name='$user')");
	// recuperamos en un list box html
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["user_name"].'>'.$row["name_user"].'&nbsp;'.$row["name_user1"].'&nbsp;&nbsp;('.$row["city"].')</option>';	
	}
	$result->free();
}

// funcion que guarda el mensaje (envia)
function send_message_for_user($handle, $send_to, $subject, $message, $user_remit, $branch ,$zone)
{
	date_default_timezone_set($zone);
	// recuperamos el email de usuario
	$user=$handle->query("SELECT user_name,email FROM users WHERE user_name='$send_to'");
	// recuperamos u email y la guardamos en una variable
	$recover=$user->fetch_assoc();
	$your_email=$recover["email"];
	$date_reg=date("Y-m-d"); // fecha de envio
	// procedemos a insertar la informacion en la base de datos
	$handle->query("INSERT INTO mails (subject,file_send,read_men,remit,date_send,message,destin,mail_location,recycling,url_archive,size_file) VALUES('$subject','no','no','$user_remit','$date_reg','$message','$send_to','$branch','no','no','no')");	
	// una ves insertado enviamos el mensaje al correro electronico del usuario
	
//********************************************************************************	
// express mailer

        $to = $your_email; // contiene el email al que se enviara
		$subject="Mensaje Enviado por Express Bus, $subject"; //asunto del mensaje
		$from = $your_email; // para
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''; // recuperamos los datos del server SMTP
		$body = "<p><font color='#F7B707' size='5'>Express Bus Mailer:</p>".
		"<p><strong>Para:</strong> $send_to </p>".
		"<p><strong>Email:</strong> $your_email </p>".
		"<p><strong>De:</strong> $user_remit </p>".
		"<p><strong>Terminal:</strong> $branch </p>".
		"<p><strong>Fecha:</strong> $date_reg <p/>".
		"<p><strong>Message:</strong> <p/> ".
		"<fieldset style='width:50%'><p><font size='3' color='#0066FF'> $message </font></p>".
		"<p>Generado desde IP: $ip</p></fieldset>";	
		$headers = "MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: "; // permite el el envio en formato html
		$headers .= "From: $from \r\n";

		@mail($to, $subject, $body,$headers);

//*****************************************************************************
$user->free();

// redireccionamos indicando que el mensaje fue enviado correctamente
ok_send_message();
// fin del envio de email		
}

// funcion que unvia un archivo a un usuario
function send_archive_for_user($handle, $send_to, $subject, $message, $user_remit, $branch, $nombre_archivo, $tamano_archivo, $zone)
{
	date_default_timezone_set($zone);
	$file_name=str_replace("uploads/",": ",$nombre_archivo);
	// recuperamos el email del usuario
	$user=$handle->query("SELECT user_name,email FROM users WHERE user_name='$send_to'");
	// recuperamos u email y la guardamos en una variable
	$recover=$user->fetch_assoc();
	$your_email=$recover["email"];
	$date_reg=date("Y-m-d"); // fecha de envio
	// procedemos a insertar la informacion en la base de datos
	$handle->query("INSERT INTO mails (subject,file_send,read_men,remit,date_send,message,destin,mail_location,recycling,url_archive,size_file) VALUES('$subject','si','no','$user_remit','$date_reg','$message $file_name','$send_to','$branch','no','$nombre_archivo','$tamano_archivo')");	
	// una ves insertado enviamos el mensaje al correro electronico del usuario
	
//***************************************************************************
// express mailer

		$to = $your_email; // contiene el email al que se enviara
		$subject="Mensaje Enviado por Express Bus, $subject"; //asunto del mensaje
		$from = $your_email; // para
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''; // recuperamos los datos del server SMTP
		$body = "<p><font color='#F7B707' size='5'>Express Bus Mailer:</p>".
		"<p><strong>Para:</strong> $send_to </p>".
		"<p><strong>Email:</strong> $your_email </p>".
		"<p><strong>De:</strong> $user_remit </p>".
		"<p><strong>Terminal:</strong> $branch </p>".
		"<p><strong>Fecha:</strong> $date_reg <p/>".
		"<p><strong>Message:</strong> <p/> ".
		"<fieldset style='width:50%'><p><font size='3' color='#0066FF'> $message  </font> $file_name</p><p>Descargalo ingresando a Express Bus con tu cuenta.</p>".
		"<p>Generado desde IP: $ip</p></fieldset>";	
		$headers = "MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: "; // permite el el envio en formato html
		$headers .= "From: $from \r\n";

		@mail($to, $subject, $body,$headers);
		
//**************************************************************************
	$user->free();
	// mensaje de confirmacion indicando que la subida fue exitosa
    ok_send_archive();
}

// funcion que verifica que la id del email no este repetido en la base de datos
function ckek_id_mail($handle, $id_mail)
{
	// verificamos
	$result=$handle->query("SELECT id_mail FROM mails WHERE id_mail='$id_mail'");
	if($result->num_rows > 0){
	// significa que esta repetido volvemos a generar recargamos la pagina
	// cerrramos la conexion
		$handle->close();
		echo "<script>
			function redirect()
			{
				window.location.replace('send_message.php');
			}
			setTimeout('redirect();', 1000);
		</script>";	
	}
	else{
		// significa que es unico retornamos verdadero
	    $result->free();
		return true;
	}
}

// funcion que verifica que la id del email no este repetido caso contrario genera otro id para el archivo
function ckek_id_mail_for_send_file($handle, $id_mail)
{
	// verificamos
	$result=$handle->query("SELECT id_mail FROM mails WHERE id_mail='$id_mail'");
	if($result->num_rows > 0){
	// significa que esta repetido volvemos a generar recargamos la pagina
	// cerrramos la conexion
		$handle->close();
		echo "<script>
			function redirect()
			{
				window.location.replace('send_archive.php');
			}
			setTimeout('redirect();', 1000);
		</script>";	
	}
	else{
		// significa que es unico retornamos verdadero
	    $result->free();
		return true;
	}
}
?>