<?php
//** GENERA UN PASSWORD ALEATORIO Y LA ENVIA RECUPERARA CONTRASEÑA *//
require_once('../includes/db_system.php');
date_default_timezone_set($zone);
$user_mail=$_POST["user_email"];
if(empty($user_mail)){
?>		
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El Campo Usuario Esta Vacío</title>
    <link rel="shortcut icon" href="../main_output/Information.ico">
	<link rel="stylesheet" href="../main_output/templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="../main_output/templates/bus_20/css/personal.css" type="text/css" />
    <script type="text/javascript" src="../main_output/js_mudules/open_url/open_url_button.js"></script>
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/notification_warning.png"><h4><Font color="#FF0000">¡ El campo email esta vacío !</Font></h4>
    El campo de email esta vacio Coloque su correo electrónico.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div
   	><div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;	
}
else{
	
$handle=db_connect();	
// verificamos si el email corresponde al usuario	
$result=$handle->query("SELECT email, user_name FROM users WHERE email='$user_mail'");	
$idf=$result->fetch_assoc();
$your_name= $idf["user_name"];
if($result->num_rows > 0){
// significa que es valido	
// generamos una contraseña nueva aleatoria para este usuario	
	$min_length=4;
	$max_length=6;
// generate a random word
  $pass = "";
  $dictionary = "words_tkpas.dat";  // imprtamos el diccionario
  $fp = fopen($dictionary, "r");
  $size = filesize($dictionary);
  // ubicamos una palabra en forma aleatiroa en el diccionario
  srand ((double) microtime() * 1000000);
  $rand_location = rand(0, $size);
  fseek($fp, $rand_location);
  // La palabre debera estar conprendida entre un rango especifico
  while (strlen($pass)< $min_length || strlen($pass)>$max_length)
  {
     if (feof($fp))
        fseek($fp, 0);        
     $pass = fgets($fp, 80);  
     $pass = fgets($fp, 80);
  };
  $pass=trim($pass); 
// fin de la generacion aleatoria
// significa que enviara la nueva oontraseña a su correo electrónico		
// actualizamos el campo password del usuario
$handle->query("UPDATE users SET pass = MD5('$pass') WHERE user_name='$your_name'");	
// enviamos el nuevo password a su email
$date_reg=date("d-m-Y");

// express mailer
//*********************************************************************************************

		$to = $user_mail; // contiene el email al que se enviara
		$subject="Mensaje Enviado por Express Bus Tickets, nuevo passsword"; //asunto del mensaje
		$from = $user_mail; // para
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''; // recuperamos los datos del server SMTP
		$body = "<p><font color='#F7B707' size='5'>Express Bus Mailer:</p>".
		"<p><strong>Para:</strong> $your_name </p>".
		"<p><strong>Email:</strong> $user_mail </p>".
		"<p><strong>Fecha:</strong> $date_reg <p/>".
		"<p><strong>Message:</strong> <p/> ".
		"<fieldset style='width:50%'><p>Este es su nuevo password:<font size='3' color='#0066FF'> $pass </font></p>".
		"<p><b>Recuerde que puede cambiar su password en la opcion Editar Perfil. </b></p>".
		"<p>Generado desde IP: $ip</p></fieldset>";	
		$headers = "MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: "; // permite el el envio en formato html
		$headers .= "From: $from \r\n";

		mail($to, $subject, $body,$headers);

//***********************************************************************************************
// mostramos un mensaje de confirmacion
}
else{
// significa que no es valido mensaje de error	
?>		
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El email no es Válido</title>
    <link rel="shortcut icon" href="../main_output/Information.ico">
	<link rel="stylesheet" href="../main_output/templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="../main_output/templates/bus_20/css/personal.css" type="text/css" />
    <script type="text/javascript" src="../main_output/js_mudules/open_url/open_url_button.js"></script>
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/notification_warning.png"><h4><Font color="#FF0000">¡ El correo electronico no es válido !</Font></h4>
    Coloca un correo electronico válido.
    <div class="mailto-close">
		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div
   	><div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;	
}


}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nuva Contraseña Eviada</title>
    <link rel="shortcut icon" href="../main_output/Information.ico">
	<link rel="stylesheet" href="../main_output/templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="../main_output/templates/bus_20/css/personal.css" type="text/css" />
    <script type="text/javascript" src="../main_output/js_mudules/open_url/open_url_button.js"></script>
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/ok_aply.png"><h4><Font color="#75AA1A">¡ La nueva contraseña fue enviado a su Email !</Font></h4>
    Su nueva contraseña fue enviada correctamente, ingrese a la bandeja de entrada de su email.
    <div class="mailto-close">
		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div
   	><div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
