<?php
session_start(); //iniciamos sesion *//
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/firts_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
recover_info_user($con, $valid_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="templates/css/system.css" type="text/css">
  <title>Anular Reserva | Express Bus Tickets</title>
  <link rel="shortcut icon" href="favicon.ico">
  <?php
  if(!isset($bus)){
	$bus=false;
				}
   recover_info_bus_for_user($con, $valid_user,$bus); ?>
  <?php check_open_or_close_bus($con, $bus, $dt, $hrs, $valid_user, $location); //verificamos si el bus se encuentra cerrado ?>
	<link rel="stylesheet" href="templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="templates/bus_20/css/personal.css" type="text/css" />
    <link rel="stylesheet" href="templates/css/consolidated_common.css" type="text/css" />
    <script type="text/javascript" src="jquery_libraries/livevalidation_standalone.js"></script>	
    <!--[if lte IE 6]>
	<link href="templates/bus_20/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->

</head>

<body class="contentpane">
	<div id="all">
		<div id="main">
<div id="mailto-window">
	<font size="4" color="#0099CC">
		Anular Reserva	</font>
        
	<div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
	
	<form action="execute_selected_process.php" method="post">
		<div class="formelm">
			<label for="mailto_field"><font size="2">Número de Asiento:</font> </label>
			<input type="text" name="place" id="f3" class="inputbox" size="10" maxlength="2"/>
            <script type="text/javascript">
		            var f3 = new LiveValidation('f3');
		            f3.add(Validate.Numericality);
		          </script>
		</div>

		
		<p>
        
			<input type="submit" value="> Confirmar" />&nbsp;&nbsp;

			
			<button class="button" onclick="window.close();">
				Cancelar			</button>
		</p>
        
        <input type="hidden" name="task" value="ar" />
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


