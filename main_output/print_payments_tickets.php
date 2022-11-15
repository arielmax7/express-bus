<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/seventh_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
date_default_timezone_set($zone);
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
//recuperamos la informacion del usuario
recover_info_user($con, $valid_user);
//mostramos todos los registros correspondientes a la fecha
if(isset($_POST["limit"])){
				$limit=$_POST["limit"];
				}
				else{
					
				$limit = false;	
				}
if(isset($_POST["datei1"])){
				$datei_1=$_POST["limit"];
				}
				else{
					
				$datei_1 = false;	
				}
if(isset($_POST["datei2"])){
				$datei_2=$_POST["datei2"];
				}
				else{
					
				$datei_2 = false;	
				}
if(isset($_POST["op_sa"])){
				$op_sa = $_POST["op_sa"];
				}
				else{
					
				$op_sa = false;	
				}

//configura la paginacion y vistas
view_payments_bus($con, $limit, $datei_1, $datei_2, $op_sa, $valid_user); 
//verificamos la fecha
if($ft==""){
//asignamos la fecha de hoy	
$ft=date("Y-m-d");	
}
if($num_reg==""){
//asignamos valor por defecto
$num_reg=50;	
}

include_once("paginacion.php"); //incluimos el archivo donde esta  nuestra clase paginacion
$link = $con; // pasamos los parametros de nuestra conexion	
//verificamos el nivel
	if($level=="sa"){ //mostramos la cantidad de registros de todas las sucursales
		//verificamos si selecciono vista por sucursal
		if($v_branch=="Todos"){

		//mostramos todas las sucursales	
		$query = "SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.confirm_pay='si' AND record_customers_buses.dni_client=clients.dni_client AND record_customers_buses.date_register BETWEEN '$ft' AND '$ft2'"; //consulta para saber la cantidad de registros
		//calculamos el total de voletos y el dinero acumulado
		calculate_items_pays($link,$query);	
		}
		else{
		//mostramos por sucursal	
		 $query = "SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.confirm_pay='si' AND record_customers_buses.branch='$v_branch'  AND record_customers_buses.dni_client=clients.dni_client AND record_customers_buses.date_register BETWEEN '$ft' AND '$ft2'"; //consulta para saber la cantidad de registros	
		//calculamos el total de voletos y el dinero acumulado
		calculate_items_pays($link,$query);
		 
		}
	}
	else{ //mostramos la cantidad de registros solo de su sucursal admin
	$query = "SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.confirm_pay='si' AND record_customers_buses.branch='$location'  AND record_customers_buses.dni_client=clients.dni_client AND record_customers_buses.date_register BETWEEN '$ft' AND '$ft2'";
	calculate_items_pays($link,$query);
	}
	
		
	$rsT =  $link->query($query); 
	
	$total = $rsT->num_rows; 
	
	if(isset($_GET['page'])){
				$pg = $_GET['page'];	
				}
				else{
					
				$pg = 0;	
				}
	$cantidad = $num_reg; //Cantidad de registros que se desea mostrar por pagina, Para probar solo le coloque 3
	
	$paginacion = new paginacion($cantidad, $pg); //  llamo a mi clase paginacion y por defecto le paso 2 variables.
	$desde = $paginacion->getFrom();
	//verificamos el nivel
	if($level=="sa"){ //mostramos la cantidad de registros de todas las sucursales
		//verificamos si selecciono vista por sucursal
		if($v_branch=="Todos"){
		//mostramos tadas las sucursales
		$query = "SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.confirm_pay='si'  AND record_customers_buses.dni_client=clients.dni_client AND record_customers_buses.date_register BETWEEN '$ft' AND '$ft2' LIMIT $desde, $cantidad"; //consulta para mostrar los datos de acuerdo ala cantidad	
		}
		else{
		//mostramos por sucursal	
		$query = "SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.confirm_pay='si' AND record_customers_buses.branch='$v_branch'  AND record_customers_buses.dni_client=clients.dni_client AND record_customers_buses.date_register BETWEEN '$ft' AND '$ft2' LIMIT $desde, $cantidad"; //consulta para mostrar los datos de acuerdo ala cantidad	
		}
		
	}
	else{ //mostraos la cantidad de resgistors solo de su sucursal
	$query = "SELECT * FROM record_customers_buses, clients WHERE record_customers_buses.confirm_pay='si' AND record_customers_buses.branch='$location'  AND record_customers_buses.dni_client=clients.dni_client AND record_customers_buses.date_register BETWEEN '$ft' AND '$ft2' LIMIT $desde, $cantidad"; //consulta para mostrar los datos de acuerdo ala cantidad	
		
	}
	//recuperamos los registros deacuerdo al tipo de usuario
	$rs = $link->query($query)

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Imprimir Informe Económico | <?php default_title(); ?></title>
  <link rel="shortcut icon" href="favicon.ico">
   <link href="templates/css/template.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js_mudules/calendar/js/calendar-setup.js"></script>
  <script type="text/javascript" src="js_mudules/prints/print.js"></script>
  

<link rel="stylesheet" href="templates/css/system.css" type="text/css">  
<!--[if IE 7]>
<link href="templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="templates/css/rounded.css">

<!--[if IE 7]>
<link href="templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->


</head>
<body>
	

<b>Fecha de impresión: </b><?php echo date("d - m - Y"); ?>&nbsp;&nbsp;&nbsp;<b>Imprimido por: </b><?php echo $full_name; ?>&nbsp;&nbsp;&nbsp;<b>Sucursal: </b><?php echo $location; ?>&nbsp;&nbsp;&nbsp;<b>Total de Boletos Vendidos: </b><?php echo $total_item; ?> &nbsp;&nbsp;&nbsp; <b>Total Efectivo: </b><?php echo $total_money; ?> <?php recover_type_money($link); ?>&nbsp;&nbsp;&nbsp; <b>Fecha: </b> <?php echo $ft; ?> AL
 <?php echo $ft2; ?>  <br />
 <a href="javascript:imprimir()">Imprimir</a>  
 
	<table class="adminlist">
		<thead>
			<tr>
				
				<th class="left" width="11%">Cliente</th>
				<th class="nowrap" width="10%">Hora</th>
				<th class="nowrap" width="12%">
					Asiento</th>
				<th class="nowrap" width="12%">
					Bus</th>
				<th class="nowrap" width="12%">
					Orígen</th>
				<th class="nowrap" width="12%">
					Destino		</th>
                    <th class="nowrap" width="13%">
					Emitido Por			</th>
				
				<th class="nowrap" width="13%">
					Fecha Registro				</th>
				<th class="nowrap" width="13%">
					Efectivo				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
                
                
                
					
<br />
<?php
	$url = "payments_tickets.php?"; //url donde va a cargar de nuevo la pagina
	
	$classCss = "numPages"; //Clase CSS que queremos asignarle a los links 
	
	$back = "&laquo;Atras"; //textos atras
	$next = "Siguiente&raquo;"; //textos siguiente
	
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss); // llamo a mi metodo que es el que contiene la estructura de la paginacion
?>
	</div>




		</td>
			</tr>
		</tfoot>
		<tbody>
					<tr class="row0">
		
<?php

	while ($row = $rs->fetch_assoc()) {

   
    
     echo '<tr class="row0"><td class="left">'.$row['names']." ".$row['last_names'].'</td>'; 
	 
	 echo '<td class="center">'.$row['time_travel'].'</td>';
		
	 echo '<td class="center">'.$row['place'].'</td>';
	 
	 echo '<td class="center">'.$row['bus_travel'].'</td>';
	 
	 echo '<td class="center">'.$row['branch'].'</td>';
	 
	 echo '<td class="center">'.$row['traveled_to'].'</td>';	
		
     echo '<td class="center">'.$row['user_emited'].'</td>';

	 echo '<td class="center">'.$row['date_register'].'</td>';
	 
	 echo '<td class="center">'.$row['payment'].'</td></tr>';

	}
?>         
			</tr>
					</tbody>
	</table>

	

		


</body></html>