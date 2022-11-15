<?php
session_start(); //inisiamos session
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="Express Bus 1.2 - Open Source">
<title>Lista de pasajeros del bus actual | Express Bus Tickets</title>
<link rel="shortcut icon" href="favicon.ico">
<?php 


recover_info_user($con, $valid_user); //recupera toda la informacion del usuario ?>
<?php 
if(!isset($bus)){
	$bus=false;
				}
recover_info_bus_for_user($con, $valid_user,$bus); ?>
<?php check_open_or_close_bus($con, $bus, $dt, $hrs, $valid_user, $location); //verificamos si el bus se encuentra cerrado ?>
<link href="templates/css/template.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link href="templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="templates/css/rounded.css">

<script type="text/javascript" src="js_mudules/prints/print.js"></script>
</head>

<body>

<br />
<h1><?php company_name($con); ?></h1>
<strong>Bus:</strong>
<?php echo $bus.'&nbsp;&nbsp;&nbsp;';
 recover_mat_bus($con, $bus);?>
<strong>Matrícula:</strong> <?php echo $placa; ?> &nbsp;&nbsp;&nbsp;<strong>Origen:</strong> <?php echo $location; ?>&nbsp;&nbsp;&nbsp;<strong>Destinos:</strong> <?php echo $destinations; ?>&nbsp;&nbsp;&nbsp;<strong>Fecha de viaje:</strong> <?php echo $dt; ?> &nbsp;&nbsp;&nbsp;<strong>Hora de viaje:</strong> <?php echo $hrs; ?>
<h2>Lista de Pasajeros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2> <a href="javascript:imprimir()">Imprimir</a>
<table class="adminlist" border="1">
<thead>
		<tr>
			<th class="left">
				<strong>Nombres	</strong>			</th>
			<th class="left">
				<strong>Apellidos</strong>
			</th>
			<th class="left">
				<strong>Asiento</strong>
			</th>
			<th class="left">
				<strong>Origen</strong>
			</th>
			<th class="left">
				<strong>Destino</strong>
			</th>
            <th class="left">
             <strong>DNI</strong>
            </th>
            <th class="left" width="5%">
             <strong>Presente</strong>
            </th>
		</tr>
	</thead>
	<tbody>
<?php list_user_info($con, $valid_user, $bus, $dt, $hrs); ?>
</tbody>
</table>
</body>
</html>