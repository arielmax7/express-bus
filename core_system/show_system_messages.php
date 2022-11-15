<?php
//** FUNCIONES DE MENSAJES DE CONFIRMACION O ERRROR *//
//** Inicio de funciones de mensajes de  error login
// funcion que muestra un mensaje de error, nombre de usuario o contraseña estan vacios (mesaje tipo retorno)
function error_login_empty()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="../index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="emp" />
    </form></body></html>';
}

// funcion que muestra un mensaje de error, se introdujo caracteres no permitidos  (mensaje tipo retorno)
function error_login_invalid_char()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="../index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="inv" />
    </form></body></html>';
}

// funcion que muestra un mensaje de error, usuario y contraseña son incorrectos intentelo denuevo (mensaje tipo retorno)
function error_login_no_match()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="../index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no" />
    </form></body></html>';
}

// Fin de funciones de mensajes de error login *//


//** Inicio de funciones de mensajes de error para el bus
// funcion que muestra un mensaje de error indicando que el bus esta en mantenimiento 
function bus_in_maintenase()
{
?>	
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El Bus se encuentra en mantenimiento</title>
	<link rel="stylesheet" href="../templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="../templates/bus_20/css/personal.css" type="text/css" />
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../templates/images/header/bus_maintenace.png"><Font color="#FF0000" size="4">¡ El bus se encuentra en mantenimiento no esta habilitado !</Font></div>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

//funcion que muestra un mensaje indicando que no hay suficientes terminales para utilizar esta libreria


function no_terminal()
{
?>	
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El Bus no cuenta con suficientes terminales</title>
	<link rel="stylesheet" href="../templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="../templates/bus_20/css/personal.css" type="text/css" />
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <Font color="#FF0000" size="4">¡ Error el bus no cuenta con suficientes destinos ó terminales !</Font></div>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}
// funcion que muestra un mensaje indicando que no es posible el uso de boletos ya que no hay sucursales
function no_permitted_use_paxkages()
{
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No puedes ingresar a esta area</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ No puedes ingresar a esta área, no hay suficientes terminales registradas en el sistema, debe existir al menos 2 terminales registradas !</Font></h4>
    Que desea hacer.<br /><br />
    <button class="button"  onClick="MM_goToURL('parent','branch.php');return document.MM_returnValue">
				Registrar Terminales			</button>
                
    <button class="button"  onClick="MM_goToURL('parent','index.php');return document.MM_returnValue">
				Ir a Menú			</button>  
   
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;
}

// funcion que muestra un mensaje indicando que el asiento esta en uso general mente producido cuado dos usuarios ingresan al mismo tiempo en un asiento
function the_place_is_used()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El asiento esta en uso</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ Acceso denegado el asiento seleccionado ya esta en uso, actualize la página y seleccione otro asiento !</Font></h4>
    El asiento esta en uso.<br /><br />
    <button class="button" onClick="window.close();return false;">
				Cerrar			</button>
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;
}

// Fin de funciones de mensajes de error para el bus


//** Inicio de funciones de mesajes de seguridad
// funcion que muestra un mensaje de error, cuando una persona ajena al sistema intenta acceder a cualquier pagina del sitio
function restricted_area()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No puedes ingresar a esta area</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ Acceso denegado estas intentando ingresar a un área no permitida !</Font></h4>
    Acceso denegado.<br /><br />
    <button class="button"  onClick="MM_goToURL('parent','../index.php');return document.MM_returnValue">
				Ir a Inicio			</button>
   
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;
}

// funcion que muestra un mensaje indicando que no es posible enviar un email ya que es el unico usuario en el sistema
function no_permitted_use_mail()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No puedes ingresar a esta area</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ No puedes ingresar a Mensajes, no hay suficientes usuarios registrados en el sistema, debe existir al menos 2 usuarios registrados !</Font></h4>
    Que desea hacer.<br /><br />
    <button class="button"  onClick="MM_goToURL('parent','users.php');return document.MM_returnValue">
				Registrar Usuarios			</button>
                
    <button class="button"  onClick="MM_goToURL('parent','index.php');return document.MM_returnValue">
				Ir a Menú			</button>  
   
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;	
}
//funcion que muestra un mensaje de error indicano que no se cunta con suficientes destinos para el bus
function ins_de()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No puedes ingresar a esta area</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ Error, no hay suficientes rutas registradas para el bus, debe existir al menos 2 rutas registradas !</Font></h4>
    Que desea hacer.<br /><br />
    
                
    <button class="button"  onClick="MM_goToURL('parent','index.php');return document.MM_returnValue">
				Ir a Menú			</button>  
   
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;
				
	
}

//funcion que muestra un mensaje de error indicando que no se cuenta con suficientes horarios para el bus
function ins_hours()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No puedes ingresar a esta area</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ Error, no hay suficientes horarios registrados para el bus, debe existir al menos 2 horarios registradas !</Font></h4>
    Que desea hacer.<br /><br />
    
                
    <button class="button"  onClick="MM_goToURL('parent','index.php');return document.MM_returnValue">
				Ir a Menú			</button>  
   
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;
}


// funcion que muestra un mensaje indicando que no es posible el chat ya que es el unico usuario en el sistema
function no_permitted_use_chat()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No puedes ingresar a esta area</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ No puedes ingresar al Chat, no hay suficientes usuarios registrados en el sistema, debe existir al menos 2 usuarios registrados !</Font></h4>
    Acceso denegado.<br /><br />
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
    <button class="button"  onClick="window.close();return false;">
				Cerrar			</button>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php  	
exit;
}

// funcion que muestra un mensaje indicando que la operacion es ilegal (Usuarios)
function invalid_operation(){
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="users.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_operation" />
    </form></body></html>';
}
// funcion que muestra un mensaje indicando que la operacion es ilegal (Terminales)
function invalid_operation_branch(){
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_operation" />
    </form></body></html>';
}
// funcion que muestra un mensaje indicando que no es posible eliminar la terminal al existir relacion con los usuarios
function invalid_operation_branch_users(){
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_users_branch" />
    </form></body></html>';
}
// funcion que muestra un mensaje indicando que la operacion es ilegal (buses)
function invalid_operation_buses(){
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="invalid_operation" />
    </form></body></html>';
}
// Fin de funciones de mensajes de seguridad


//** Inicio de funciones den mensajes de confirmacion
// funcion que muestra un mensaje indicando que la fecha seleccionada es menor a la actual no se puede vender boletos al pasado  (mensaje tipo retorno)
function bad_date_selected()
{
    echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="tickets.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_date" />
    </form></body></html>';
}

//funcion que muestra un mensaje indicando que el bus seleccionado no se puede cargar porque no esta autorizada la terminal
function bad_bus_terminal_emp()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="tickets.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_bus" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el bus es del dia anterior  no se puede vender boletos al pasado 
function bad_date_bus()
{   
	print ('<html><head><title>ERROR: La fecha del bus a expirado!</title></head>');
	echo '<font color="#FF3300" size="5"><body><b>Error: La fecha del bus ha expirado coloque nuna fecha actual!</b></font><br><br>';
	exit;
}

// funcion que muestra un mensaje indicando que el asiento colocado de reserva es incorrecto coloque un asiento valido
function bad_place_reserv()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No se pudo Anular</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ No se pudo anular, el asiento colocado no esta reservado coloque un asiento reservado !</Font></h4>
    Intententelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje indicando que el asiento es incorrecto confirmar reserva
function bad_place_confirm_reserv()
{
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No se pudo confirmar</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ No se pudo confirmar, el asiento colocado no esta reservado coloque un asiento reservado !</Font></h4>
    Intententelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funciion que muestra un mensaje indicando que no se coloco la fecha para ver las reservas (mensaje tipo retorno)
function no_date_input()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="view_reservation.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="empty_date" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje que el campo esta vacio
function empty_box()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El campo de asiento esta vacio</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ Usted no coloco el número de asiento, por favor coloque un número de asiento valido !</Font></h4>
    Intententelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra que el campo de dexto esta vacio utilizado en vaciar bus
function empty_box_bus()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El campo de bus esta vacio</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ Usted no coloco el número de bus por favor coloque un número de bus valido !</Font></h4>
    Intententelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;	
}

// funcion que muestra un mensje que el numero de asieto es incorrexto
function bad_place_empty()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El n&uacute;mero de asiento no es valido</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ El número de asiento es incorrecto, coloque el número de asiento que este en estado vendido !</Font></h4>
    Intententelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;	
}

// funcion que indica al usuario que no esta autorizado para vaciar un bus
function no_autorized_empty_bus()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No estas autorizado para realizar esta operacion</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ Usted no esta autorizado para realizar esta operación !</Font></h4>
    Esta Terminal no esta autorizada para la operación solicitada.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje indicando que el numero de bus colocado es incorrecto
function bad_number_bus()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El número de bus no es valido</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ Usted coloco un número de bus incorrecto o este no tiene suficientes ventas !</Font></h4>
    Intentelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}
// funcion comodin ^_^
function confirm_user_cp_1(){
print('&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115;&#32; &#84;&#105;&#99;&#107;&#101;&#116;&#115; &#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="http://www.arielmax.com.ar/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;
');
}

// funcion que muestra un mensaje indicando que el numero de bus colocado es incorrecto cerrar bus
function bad_number_bus_close()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El número de bus no es correcto</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ Usted coloco un número de bus incorrecto, coloque el número del bus que desea cerrar !</Font></h4>
    Intententelo de nuevo.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje indicando que el bus esta cerrado
function no_process_bus_is_close()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El bus esta cerrado</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/alto.png"><h4><Font color="#FF0000">¡ El bus ya partio de su terminal no puedes realizar ninguna operación !</Font></h4>
    De momento no podras utilizar el bus.
    <br /><br />
    <input type="button" onclick="void window.close()"  value="Cerrar ventana"/>
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// Fin de funciones de mensajes de confirmacion


//** Inicio de funciones de mensjaes de confirmacion OK
// funcion que muestra un mensjae de confirmacion de ok
function ok_place_empty()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El asiento fue liberado con exito</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/ok_aply.png"><h4><Font color="#75AA1A">¡ Asiento liberado exitosamente !</Font></h4>
    Liberación exitosa, este asiento esta disponible para la venta.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje de confirmacion ok que fue un exito
function ok_emp_bus()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El bus fue vaciado con exito</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/ok_aply.png"><h4><Font color="#75AA1A">¡  Bus vaciado exitosamente !</Font></h4>
    Bus vacido con exito, este bus esta listo para una nueva partida.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje de confirmacion de ok fue un exito
function ok_place_cancel_reservation()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reserva anulada con exito</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/ok_aply.png"><h4><Font color="#75AA1A">¡ Reserva anulada exitosamente !</Font></h4>
    La reserva fue anulada, este asiento esta disponible para la venta.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje de confirmacion ok fue un exito
function ok_close_bus()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Bus Cerrado con exito</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/ok_aply.png"><h4><Font color="#75AA1A">¡ El bus fue Cerrado correctamente !</Font></h4>
    La operación fue exitosa.
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje de confirmacion ok fue un exito la reserva  (mensaje tipo retorno)
function ok_reservation_place()
{
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reserva exitosa</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/ok_aply.png"><h4><Font color="#75AA1A">¡ El asiento fue reservado correctamente !</Font></h4>
    La reserva fue exitosa.<br /><br />
    <button class="button" onClick="window.close();return false;">
				Cerrar	ventana		</button>
    <div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span> Cerrar Ventana </span></a>
	</div>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
	exit;	
}

//** Inicio de funciones de mensajes de la base de datos Queries
// funcion que muestra un mensaje de error de conexion con la base de datos
function error_db_connect()
{
?>	
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No se puede conectar con el servidor MySQL</title>
	<link rel="shortcut icon" href="main_output/Information.ico">
	<link rel="stylesheet" href="main_output/templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="main_output/templates/bus_20/css/personal.css" type="text/css" />
    <script type="text/javascript" src="main_output/js_mudules/open_url/open_url_button.js"></script>
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="main_output/templates/images/header/Database_2.png"><h4><Font color="#FF0000">¡ No se puede conectar con el servidor MySQL !</Font></h4>
    verifique los datos del servidor en el archivo db_system.php ubicado en la carpeta includes de la raíz.<br /><br />
    Informe de error: <br />
    <table><tr><td>
    <font color="#339900" size="3"> <?php echo mysqli_connect_error(); ?></font>
    </td></tr></table><br />
    <font color="#0066FF" size="3">Acceso denegado</font><br /><br />
    
   <button class="button" onClick="MM_goToURL('parent','help/help_no_connect_db.html');return document.MM_returnValue">
				Ayuda		</button>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje de error de consulta a la base de datos
function error_query_db()
{
?>
	 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No se puede ejecutar la consulta servidor MySQL</title>
	<link rel="shortcut icon" href="../main_output/Information.ico">
	<link rel="stylesheet" href="../main_output/templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
    <link rel="stylesheet" href="../main_output/templates/bus_20/css/personal.css" type="text/css" />
    <script type="text/javascript" src="../main_output/js_mudules/open_url/open_url_button.js"></script>
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Database_2.png"><h4><Font color="#FF0000">¡ No se puede ejecutar la consulta a la base de datos MySQL !</Font></h4>
    verifique la consulta "query" <br />
   <br />
    <font color="#0066FF" size="3">Acceso denegado</font><br /><br />
    
   <button class="button" onClick="MM_goToURL('parent','../index.php');return document.MM_returnValue">
				Ir a Inicio		</button>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje indicado que la copia de seguridad de la base de datos fue exitosa (mensaje tipo retorno)
function ok_backup_data_base()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="backup_system_db.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_backup" />
    </form></body></html>';
	exit;
}

// fincion que muestra un mensaje indicando que el backup fue eliminado exitosamente (mensaje tipo retorno)
function ok_remove_backup()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="backup_system_db.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_remove_backup" />
    </form></body></html>';
	exit;
}

// Fin de funciones de mensajes de la base de datos Queries

//** Inicio de funciones de mensajes para gestor de usuarios
// funccion que muestra un mensaje indicando que no fueron llenados los campos de contraseña correctamnete (mensaje tipo retorno)
function bad_mach_password()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="my_profile.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_password" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el email ya esta en uso (mensaje tipo retorno)
function already_email()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="my_profile.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_email" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de confirmacion idicando que la actualizacion se llevo correctamente (mensaje tipo retorno)
function ok_update_my_profile()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_update" />
    </form></body></html>';
	exit;
}


function the_system_is_inactive($msg)
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>El Sitio Esta Desactivado</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/icon-48-config.png"><h4><Font color="#FF0000">¡ EXPRESS BUS TICKETS SE ENCUAENTRA DESACTIVADO POR RAZONES DE MANTENIMIENTO !</Font></h4>
    Intente ingresar m&aacute;s tarde, m&aacute;s informaci&oacute;n contacte con su administrador.<br /><br />
   <button class="button" onClick="MM_goToURL('parent','../index.php');return document.MM_returnValue">
				Ir a Inicio			</button>
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
}

// funcion igual al anterio este sera utilizado en caso de bulnerar la url (mensaje tipo retorno)
function no_acces_site_denied_url()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="../index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_acces" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje indicando que las dos contraseñas no son iguales (mensaje tipo retorno)
function no_mactch_password_new_user()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_user.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_match_pass" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje de confirmacion indicando que el usuario se registro con exito (mensaje tipo retorno)
function ok_add_new_user()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="users.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_add_user" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje indicando que no tiene permiso para ver esta area (mensaje tipo retorno)
function no_authorized_area_user()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_authorized" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje de confirmacion indicando que se ha eliminado correctamente al usuario (mensaje tipo retorno)
function ok_remove_user()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="users.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_remove" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje indicando que el id ya esta en uso (mensaje tipo retorno)
function already_user()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="users.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_us" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje de confirmacion idicando que se actualizo los datos correctamente (mensaje tipo retorno)
function ok_update_user_selected()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="users.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_update" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un menaje indicando que el email no es valido o ya esta en uso (mensaje tipo retorno)
function already_email_user()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="users.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_email" />
    </form></body></html>';
	exit;	
}

// funcion que muestra un mensaje indicando que los campos estan vacios
function no_data_box()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>No se pudo aplicar los cambios</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ No Selecciono toda la información vuelva a intentarlo !</Font></h4>
    Intententelo de nuevo.
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje indicando quye la fecha no es correcta ya expiro
function the_date_as_expired()
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Fecha no valida</title>'; //cabercera del sitio
	include('error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/Stop3.png"><h4><Font color="#FF0000">¡ La fecha que selecciono no es valida, ya expiró !</Font></h4>
    Intententelo de nuevo.
   	<div class="mailto-close">
	</div>	
    </div>
    </div>
	</div>	
	</body></html>
<?php
exit;
}

// funcion que muestra un mensaje indicando que se registro el usuario  (continuar agregando) (mensaje tipo retorno)
function ok_add_new_user_2()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="new_user.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_add_user_2" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el nombre de usuario ya existe (2) (mensaje tipo retorno)
function already_user_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_user.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_user" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el email colocado ya esta en uso (2) (mensaje tipo retorno)
function already_user_email_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_user.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_email" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el id ya esta en uso (2) (mensaje tipo retorno)
function already_user_id_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_user.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_id" />
    </form></body></html>';
	exit;
}

// Fin de funciones de mesjes de para el gestor de usuarios

//** Inicio de funciones de mensajes para gestor de terminales
// funcion que muestra un mensje de confiramcion indicando que se actualizo correctamente (mensaje tipo retorno)
function ok_update_branch()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_update" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el email ya existe (mensaje tipo retorno)
function already_email_branch()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_mail" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el nombre de la terminal ya esta en uso (nueva terminal) (mensjae tipo retorno)
function already_name_brach_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="new_branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_name" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el email de la terminal ya esta en uso (nueva terminal) (mensaje tipo retorno)
function alrealdy_email_branch_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_email" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el nombre de la terminal ya existe (mensaje tipo retorno)
function already_branch()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_branch" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el registro de nueva terminal fue exitosa (mensaje tipo retorno)
function ok_insert_new_branch()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_insert_new_branch" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el registro de nueva terminal fue exitosa puede agreagar otro (mensaje tipo retorno)
function ok_insert_save_and_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="new_branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_insert_new_branch" />
    </form></body></html>';
	exit;
}

// funcion que muestra un menjaje indicando que la terminal fue eliminada correctamente (mensaje tipo retorno)
function ok_remove_branch()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="branch.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_remove_branch" />
    </form></body></html>';
	exit;
}

// Fin de funciones de mesjes de para el gestor de terminales

//** Inicio de funciones de mensajes para gestor de buses
// funcion que muestra un mensaje de confirmacion indicando que se puso en mantenimiento el bus (mensaje tipo retorno)
function ok_in_maintence_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_maintenace" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de error indicando que le numero de asientos no es soportado por el modulo de generacion  Nuevo Bus (mensaje tipo retorno
function no_support_lib_gen_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="new_bus.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_support_lib_gen" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de error indicando que el numero de asientos no es soportado por el modulo de generacion  Editar Bus (mensaje tipo retorno)
function no_support_lib_gen_edit()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_support_lib_gen" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de confirmacion indicando que se puso en operacion el bus (mensaje tipo retorno)
function ok_operative_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_operative" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el bus fue eliminado correctamente (mensaje tipo retorno)
function ok_remover_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_remove" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el formato de imagen o el tamaño no estan permitidos (mensaje tipo retorno)
function no_type_file_permited_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_file" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no se pudo subir la imagen intentelo mas tarde (mensaje tipo retorno)
function imposible_upload_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="upload_fail" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que la matricula no es valida (mensaje tipo retorno)
function already_mat_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_mat" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que id del bus esta repetido o es invalido (mensaje tipo retorno)
function already_id_bus_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_bus.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_id" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que la matricula ya esta en uso (mensaje tipo retorno)
function already_mat_bus_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_bus.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="already_mat" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que se registro con exito el nuevo bus (mensaje tipo retorno)
function ok_register_new_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_new_bus" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que la extension o tamaño del archivo de imagen son incorrectos (mensaje tipo retorno)
function no_type_file_permited_new_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="new_bus.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_file" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que se registro con exito el nuevo bus continuar agregando (mensaje tipo retorno)
function ok_register_new_bus_next()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="new_bus.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_new_bus" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no se pudo subir la imagen del bus new bus (mensaje tipo retorno)
function no_upload_image_new_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="new_bus.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="upload_fail" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que se actualizao correctamente los datos del bus (mensaje tipo retorno)
function ok_update_bus()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="buses.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_update" />
    </form></body></html>';
	exit;
}

// Fin de funciones de mensajes del gestor de buses

//** Inicio de funciones de mensajes para gestor de mensajes
// funcion que muestra un mensaje indicado que el mensaje fue marcado como leido (mensaje tipo retorno)
function ok_read_mail()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_read" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el mensaje fue marcado como no leido (mensaje tipo retorno)
function ok_no_read_mail()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_no_read" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el mensaje fue puesto en la papelera (mensaje tipo retorno)
function ok_trash_message()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_trash" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el mensaje fue eliminado correctamente (mensaje tipo retorno)
function ok_remove_message()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_remove" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el mensaje fue enviado correctamente (mensaje tipo retorno)
function ok_send_message()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_send" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el archivo fue enviado correctamente (mensaje tipo retorno)
function ok_send_archive()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_send_archive" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el archivo no pudo enviarse intentelo mas tarde (mensaje tipo retorno)
function imposible_send_archive()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_send_archive" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no selecciono un archivo (mensaje tipo retorno)
function no_select_file()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="send_archive.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_archive" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el tamaño o extension del archivo no son permitidos (mensaje tipo retorno)
function no_file_permited()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="send_archive.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_archive" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no se pudo eliminar el archivo por que este ya fue eliminado externamente (mensaje tipo retorno)
function no_precess_remove_file()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="mails.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="archive_not_exist" />
    </form></body></html>';
	exit;
}

// Fin de funciones de mensajes del gestor de mensajes

//** Inicio de funciones de mensajes para configuracion global
// funcion que muestra un mensaje indicando que la configuracion fue aplicada correctamente (mensaje tipo retorno)
function ok_apply_config_new()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="global_config.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_apply" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que la configuracion fue aplicada correctamente redireccionamos a la ventana principal (mensaje tipo retorno)
function ok_apply_config_close()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="index.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_apply" />
    </form></body></html>';
	exit;
}

// Fin de mensajes para configuracion global

//********Inicio de funciones de mensajes para gestor de instalacion -------
// funcion que muestra un mensaje indicando que la extensiion del arhivo o el tamaño son incorrecto (gen libs) (mensaje tipo retorno)
function no_file_permited_gen_libs()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="bad_archive" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de confirmacion indicando que se instalo con exito (modulo gen libs) (mensaje tipo retorno)
function ok_install_gen_lib()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_install_gen_libs" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no se pudo instalar el modulo gen libs (mensaje tipo retorno)
function error_install_gen_lib()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="error_install_gen_libs" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no se pudo efectuar la subida (mensaje tipo retorno)
function error_upload_install()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="error_upload" />
    </form></body></html>';
	exit;
}

// funcion que  muestra un mensaje indicando que no selecciono archivo a subir (mensaje tipo retorno)
function error_no_seloected_file()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="empty_file" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que se desistalo correctamente la libreria gen lib (mensaje tipo retorno)
function ok_unistall_mod()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_remove" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que el archivo de zip no es un modulo valido (mensaje tipo retorno)
function the_file_is_not_module()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="error_invalid_mod" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje indicando que no se pudo desinstalar la libreria (mensaje tipo retorno)
function error_unistall_mod()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="error_remove" />
    </form></body></html>';
	exit;
}

// funcion que muestra que no selecciono ningun modulo para la desisntalacion (mensaje tipo retorno)
function no_selected_module_for_unistall()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="no_selected_mod" />
    </form></body></html>';
	exit;
}

// funcion que muestra que se instalo correctamente la plantilla de impresion (mensaje tipo retorno)
function ok_install_template_prints()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_install_prints" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje que no se pudo instalar la plantilla de impresion (mensaje tipo retorno)
function error_install_template_prints()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="../install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="error_install_prints" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de confirmacion indicando que la plantilla fue desinstalada correctamente (mensaje tipo retorno)
function ok_unistall_template_print()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';
	echo '<body>
    <form action="install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="ok_unistall_prints" />
    </form></body></html>';
	exit;
}

// funcion que muestra un mensaje de confirmacion indicando que no se pudo desinstalar la plantilla de impresion (mensaje tipo retorno)
function error_unistall_template_print()
{
	echo '<html><head>
	<script type="text/javascript">
    window.onload = function() { document.getElementById("op").submit(); };
    </script></head>';	
	echo '<body>
    <form action="install_unistall.php" method="POST" name="envio" id="op">
    <input type="hidden" name="msgreturn" value="error_unistall_prints" />
    </form></body></html>';
	exit;
}
?>