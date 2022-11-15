<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/firts_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Liberar Asiento | Express Bus</title>
  <link rel="shortcut icon" href="favicon.ico">
  <?php recover_info_user($con, $valid_user); //recupera toda la informacion del usuario ?>
  <?php recover_info_bus_for_user($con, $valid_user); ?>
  <?php check_open_or_close_bus($con, $bus, $dt, $hrs, $valid_user, $location); //verificamos si el bus se encuentra cerrado ?>
	<link rel="stylesheet" href="templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
	
	<link rel="stylesheet" href="templates/bus_20/css/personal.css" type="text/css" />	

<!--[if lte IE 6]>
	<link href="templates/bus_20/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body class="contentpane">
	<div id="all">
		<div id="main">
<div id="mailto-window">
	<h2>
		Liberar Asiento	</h2>
        <h4><Font color="#FF0000">¡ PRECAUSION NO LIBERE EL ASIENTO A MENOS QUE ESTE SEGURO EL CAMBIO ES IRREVERSIBLE !</Font></h4>
	<div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
	
	<form action="execute_selected_process.php" method="post">
		<div class="formelm">
			<label for="mailto_field">Número de Asiento: </label>
			<input type="text" name="place" class="inputbox" size="10" />
		</div>

		
		<p>
			<input type="submit" value="> Confirmar" />&nbsp;&nbsp;
			<button class="button" onclick="window.close();return false;">
				Cancelar			</button>
		</p>
        
        <input type="hidden" name="task" value="va" />
        <input type="hidden" name="branch" value="<?php echo $location; ?>" />
        <input type="hidden" name="bus" value="<?php echo $bus;  ?>" />
        <input type="hidden" name="dt" value="<?php echo $dt; ?>" />
        <input type="hidden" name="hrs" value="<?php echo $hrs; ?> " />
        
	</form>
</div>

		</div>
	</div>
</body>
</html>