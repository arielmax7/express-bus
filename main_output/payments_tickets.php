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
				$datei_1=$_POST["datei1"];
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
  <title>Informe Económico | <?php default_title(); ?></title>
  <link rel="shortcut icon" href="favicon.ico">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="js_mudules/calendar/js/calendar.js"></script>
  <script type="text/javascript" src="js_mudules/calendar/js/calendar-es.js"></script>
  <script type="text/javascript" src="js_mudules/calendar/js/calendar-setup.js"></script>
  
<link rel="stylesheet" href="templates/css/system.css" type="text/css">
<link href="templates/css/template.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="js_mudules/calendar/css/calendar-system.css" title="win2k-cold-1" />

<!--[if IE 7]>
<link href="templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="templates/css/rounded.css">



</head>
<body id="minwidth-body">
	<div id="border-top" class="h_blue">
		<div>
			<div>
				<span class="logo"><a href="http://www.arielmax.com.ar/express_bus/" target="_blank"><img src="templates/images/logo.png" alt="Express Bus"></a></span>
				<span class="title"><a href="index.php"><?php company_name($con); ?></a></span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-menu">
			<ul id="menu">
            
            
            
 <?php require_once('../core_system/top_menu_view.php')?>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
		<div class="clr"></div>
	</div>
	<div id="content-box">
		<div class="border">
			<div class="padding">
				<div id="toolbar-box">
				<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<div class="toolbar-list" id="toolbar">
<ul>
<li class="button" id="toolbar-new">
<a href="payments_tickets.php" class="toolbar">
<span class="icon-32-refresh">
</span>
Actualizar
</a>
</li>
<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('print_payments_tickets.php', 'Ayuda', 1020, 800, 1)" rel="help" class="toolbar">
<span class="icon-32-save-copy">
</span>
Imprimir
</a>
</li>
<li class="divider">
</li>
<li class="button" id="toolbar-help">
  <a href="#" onclick="popupWindow('../help/help_pay_ticket.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
  <span class="icon-32-help">
  </span>
    Ayuda
  </a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-featured">
					  <h2>Informe de ventas: Boletos</h2></div>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<div class="clr"></div>
						<div id="submenu-box"></div>
		
				
		<div id="element-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
         <form action="payments_tickets.php" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">  
     

   <div class="filter-search fltlft">
			
  <select id="limit" name="limit" class="inputbox" size="1" onchange="Joomla.submitform();">
	<option value="" selected="selected"># Registros</option>
	<option value="10">10</option>
	<option value="15">15</option>
	<option value="20">20</option>
	<option value="25">25</option>
	<option value="30">30</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
    <option value="300">300</option>
    <option value="400">400</option>
    <option value="500">500</option>
</select>
<font color="#0066FF"><b><?php echo $num_reg; ?></b></font>
		</div>
            
				

		<div class="filter-select fltrt">
		
          <p>
  <input type="text" name="datei2" id="fecha2" readonly="readonly" size="15"/>
  <img src="js_mudules/calendar/001_44.png" id="selector2" style="cursor: pointer; border: 0px;" title="seleccionar fecha"/> 
     
  <input type="submit" value="Visualizar" />      
       <?php 

 if($level=="sa"){
//permite seleccionar sucursales
echo '<select name="op_sa">';

recover_all_branch_for_sa($con,$location);
echo '</select>';
 }
 
         
?>
            
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "selector2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
            
          </div>
        
          
          <div class="filter-select fltrt">
		
          <p>
 <input type="text" name="datei1" id="fecha" readonly="readonly" size="15"/>
  <img src="js_mudules/calendar/001_44.png" id="selector" style="cursor: pointer; border: 0px;" title="seleccionar fecha"/>  
          
 <!--Intervalo por fecha-->
            
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "selector",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
            _
          </div>
          
          
	</fieldset>
   
	<div class="clr"> </div>

	<span class="filter-search fltlft">
	
	</span>
<?php    
if($level=="sa"){
echo '<font color="#0066FF"><b>&nbsp; Sucursal:</b></font> <font color="#FF0033" size="3px">'.$v_branch.'</font>';
 }
?>
 &nbsp;&nbsp;&nbsp; <font color="#0066FF"><b>Total de Boletos:</b></font> <font color="#FF0033" size="3px"><?php echo $total_item; ?></font> &nbsp;&nbsp;&nbsp; <font color="#0066FF"><b>Total Efectivo:</b></font> <font color="#FF0033" size="3px"><?php echo $total_money; ?> <?php recover_type_money($link); ?></font>&nbsp;&nbsp;&nbsp; <font color="#0066FF"><b>Fecha:</b></font> <font color="#FF0033" size="3px"><?php echo $ft; ?></font> AL
 <font color="#FF0033" size="3px"><?php echo $ft2; ?> </font>    
	<table class="adminlist">
		<thead>
			<tr>
				
				<th class="left" width="11%"><a href="#">Cliente</a></th>
				<th class="nowrap" width="10%"><a href="#">Hora</a></th>
				<th class="nowrap" width="12%">
					<a href="#">Asiento</a></th>
				<th class="nowrap" width="12%">
					<a href="#">Bus</a></th>
				<th class="nowrap" width="12%">
					<a href="#">Orígen</a></th>
				<th class="nowrap" width="12%">
					<a href="#">Destino</a>			</th>
                    <th class="nowrap" width="13%">
					<a href="#">Emitido Por</a>			</th>
				
				<th class="nowrap" width="13%">
					<a href="#">Fecha Registro</a>				</th>
				<th class="nowrap" width="13%">
					<a href="#">Efectivo</a>				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
                
                
                
					<div class="container"><div class="pagination">

<div class="paginacion">
<br />
<?php
	$url = "payments_tickets.php?"; //url donde va a cargar de nuevo la pagina
	
	$classCss = "numPages"; //Clase CSS que queremos asignarle a los links 
	
	$back = "&laquo;Atras"; //textos atras
	$next = "Siguiente&raquo;"; //textos siguiente
	
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss); // llamo a mi metodo que es el que contiene la estructura de la paginacion
?>
	</div>




<div class="limit"></div>

</div></div>				</td>
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

	<div>
		<input name="task" value="" type="hidden">
		
			</div>
</form>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<noscript>
			¡Aviso! JavaScript debe estar habilitado para realizar esta operación.		</noscript>
		<div class="clr"></div><?php 
				
				if(isset($status_site)){
				echo $status_site;
				} ?>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
		
	<div id="footer">
		<p class="copyright">
			<?php	view_menu_user_cp_2(); ?></span>
		</p>
	</div>


<div style="display: none; z-index: 65555; visibility: hidden; opacity: 0;" id="sbox-overlay"></div><div style="display: none; z-index: 65557;" id="sbox-window"><div class="sbox-bg-wrap"><div class="sbox-bg sbox-bg-n"></div><div class="sbox-bg sbox-bg-ne"></div><div class="sbox-bg sbox-bg-e"></div><div class="sbox-bg sbox-bg-se"></div><div class="sbox-bg sbox-bg-s"></div><div class="sbox-bg sbox-bg-sw"></div><div class="sbox-bg sbox-bg-w"></div><div class="sbox-bg sbox-bg-nw"></div></div><div style="visibility: hidden; opacity: 0;" id="sbox-content"></div><a href="#" id="sbox-btn-close"></a></div></body></html>