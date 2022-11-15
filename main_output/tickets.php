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
require_once('../core_system/check_database_info.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
date_default_timezone_set($zone);
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
//funcion que verifica si almenos hay dos sucursales
check_branch_in_table($con);
require_once('../core_system/firts_lib_query.php');
if(isset($_POST["hora"])){
	$hora=$_POST["hora"];
				
				}
				else{
				$hora=false;		
				}
if(isset($_POST["bus"])){
	$bus=$_POST["bus"];
				
				}
				else{
				$bus=false;	
				}
if(isset($_POST["hora"])){
	$hora=$_POST["hora"];
				
				}
				else{
				$hora=false;		
				}
if(isset($_POST["datei"])){
	$datei=$_POST["datei"];
				
				}
				else{
				$datei=false;		
				}
if(isset($_POST["reset"])){
	$reset=$_POST["reset"];
				
				}
				else{
				$reset=false;		
				}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Gestor de Boletos | Tickets | <?php default_title(); ?> </title>
  <?php //llamamos a las funciones principales *// ?>
  <?php recover_info_user($con, $valid_user); ?>
  <?php recover_and_check_bus_show($con, $hora, $bus, $datei, $user_name, $zone); //establecemos parametros al bus a ser visualizado *// ?>
  <?php if(!isset($id_bus)){
	$id_bus = false;
				}
  ?>
  <?php check_destins_and_hours($con,$id_bus); ?>
  <?php if(!isset($date)){
	$date = false;
				}
	if(!isset($hour)){
	$hour = false;
				}
  ?>
  <?php reset_place_per_user($con, $id_bus, $date, $reset, $hour, $valid_user); //funcion que sirve para resetear un asiento en estado procesando solo por el usuario esto en caso que se produjera un error ?>
   
	
	
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="templates/css/modal.css" type="text/css">
  <link rel="stylesheet" type="text/css" media="all" href="js_mudules/calendar/css/calendar-system.css" title="win2k-cold-1" />
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="js_mudules/calendar/js/calendar.js"></script>
  <script type="text/javascript" src="js_mudules/calendar/js/calendar-es.js"></script>
  <script type="text/javascript" src="js_mudules/calendar/js/calendar-setup.js"></script>
  <script type="text/javascript" src="js_mudules/clock/clock.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate_fields.js"></script>
<link rel="stylesheet" href="templates/css/system.css" type="text/css">
<link href="templates/css/template.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link href="templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="templates/css/rounded.css">

</head>
<body id="minwidth-body" onload="mueveReloj()">
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
            
<?php require_once('../core_system/top_menu_view.php'); ?>  
            
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
		<div class="clr"></div>
<?php //switch selector de mesajes de retorno personalizado proveniete de show_system_messages enviando la variable $msgreturn con un valor 
      if(isset($_POST["msgreturn"])){
				$msgreturn = $_POST["msgreturn"];	
				}
				else{
					
				$msgreturn = false;	
				}
		
	  switch ($msgreturn)
	  {
		  case($msgreturn== empty($msgreturn));
		  echo '';  
		  break;
		  case($msgreturn=="bad_date"); //muestra el mensaje que la fecha no es correcta */
		  echo '<dl id="system-message">
                <dt class="error">Error</dt>
                <dd class="error message fade">
	            <ul>
		        <li>La fecha seleccionada no es correcta seleccione una fecha diferente!</li></ul></dd></dl>';
		  break;  
		  case($msgreturn=="bad_bus_is_closed");
		  
		  echo '<dl id="system-message">
                <dt class="error">Error</dt>
                <dd class="error message fade">
	            <ul>
		        <li>No puedes seleccionar el bus que acabas de cerrar, la fecha de salida no es valida!</li></ul></dd></dl>';
		  break;
		  case($msgreturn=="bad_bus");
		  
		  echo '<dl id="system-message">
                <dt class="error">Error</dt>
                <dd class="error message fade">
	            <ul>
		        <li>No puedes seleccionar el bus , Tu terminal no esta autorizada!</li></ul></dd></dl>';
		  break;
		  
		  
		  
	
		  
		  
		 
	  }    
?>        
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
<a class="toolbar" href="tickets.php">
<span class="icon-32-refresh">
</span>
Actualizar
</a>
</li>
<li class="divider">
</li>
<li class="button" id="toolbar-edit">
<a href="#" onclick="popupWindow('confirm_reserv.php', 'Ayuda', 700, 175, 1)" rel="help" class="toolbar">
<span class="icon-32-publish">
</span>
Confirmar Reserva
</a>
</li>




<li class="button" id="toolbar-archive">
<a href="#" onclick="popupWindow('dredge_place.php', 'Ayuda', 450, 175, 1)" rel="help" class="toolbar">
<span class="icon-32-remove">
</span>
Anular Reserva
</a>
</li>


<li class="divider">
</li>

<li class="button" id="toolbar-edit">
<a href="#" onclick="popupWindow('list_clients.php', 'Ayuda', 750, 800, 1)" rel="help" class="toolbar">
<span class="icon-32-list">
</span>
Generar Lista
</a>
</li>

<li class="button" id="toolbar-edit">
<a href="#" onclick="popupWindow('express_chat.php', 'Ayuda', 678, 650, 1)" rel="help" class="toolbar">
<span class="icon-32-unarchive">
</span>
Express Chat
</a>
</li>

<li class="divider">
</li>






<li class="divider">
</li>

<li class="button" id="toolbar-popup-options">
<a href="#" onclick="popupWindow('free_bus.php', 'Ayuda', 470, 225, 1)" rel="help" class="toolbar">
<span class="icon-32-empbuss">
</span>
Vaciar Bus
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_ticket.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-article">
					  <h2>Gestor de Boletos</h2></div>
              
				<div class="clr"></div>
			</div>
			<div class="b">
            
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<div class="clr">
        
        </div>
						<div id="submenu-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<ul id="submenu">
		<li><a href="#">Información</a></li>
    <font color="#0099CC"><b>
   
    
    
    <li>&nbsp;&nbsp;Bus elegido: <font color="#000000"><?php echo $id_bus; ?></font>&nbsp;|</li>
    <?php
	
	if(!isset($fecha)){
	$fecha = false;
				}
	if(!isset($destinations)){
	$destinations = false;
				}
	if(!isset($model)){
	$model = false;
				}
	if(!isset($places)){
	$places = false;
				}
	if(!isset($cat)){
	$cat = false;
				}
	
	
	
	
	?>
    
    <li>&nbsp;&nbsp;Fecha Elegida: <font color="#000000"><?php $fecha=$date;  @list($anyo,$mes,$dia) = @explode("-",$fecha); echo $dia.'/ '.$mes.'/ '.$anyo; ?></font>&nbsp;|
    </li>
    <li>&nbsp;&nbsp;Horario de salida: <font color="#000000"><?php echo $hour; ?></font>&nbsp;|</li>
    <li>&nbsp;&nbsp;Clase: <font color="#000000"><?php echo $cat.' estrellas'; ?></font>&nbsp;|</li>
    <li>&nbsp;&nbsp;Asientos: <font color="#000000"><?php echo $places; ?></font>&nbsp;|</li>
    <li>&nbsp;&nbsp;Destinos: <font color="#000000"><?php echo $destinations; ?></font>&nbsp;|</li>
    <li>&nbsp;&nbsp;Lib-Gen: <font color="#000000"><?php echo $model; ?></font></li>
    </b></font>
	</ul>				<div class="clr">
    
    
    </div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		
				
		<div id="element-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
            <fieldset>
				
          
<form name="form_reloj">
<input type="text" value="Hora"  size="2" readonly="readonly"/><input type="text" name="reloj" size="10" readonly="readonly"> 
<?php $ad=date("d/m/Y"); echo "<input type='text' value='Fecha: $ad' size='17' maxlength='25' readonly='readonly'>"; ?>
</form> 
<br />
<br />
<form action="tickets.php" method="post">
	
		
			<label class="filter-search-lbl" for="filter_search">Nº Asiento:</label>
<input name="reset" id="texto" title="restablecer asiento coloque el número de asiento" type="text" size="1" maxlength="2" onkeypress="return permite(event, 'num')">
         
			<button type="submit" class="btn">Restablecer</button>
			
            </form>


       
<form action="tickets.php" method="post" name="conf" id="adminForm">

<select name="bus" id="buses">
<?php recover_buses($con); //muestra todos los buses el id_bus extraido de la base de datos ?>
</select>


<script type='text/javascript'>
/* <![CDATA[ */
var dropdown = document.getElementById("buses");
function onCatChange(){
if (dropdown.options[dropdown.selectedIndex].value > 0)  
var conexion;
var op=dropdown.options[dropdown.selectedIndex].value;
myrand=parseInt(Math.random()*999999999);

mod="execute_conf_buses.php?op="+op+"&rand="+myrand;

if(window.XMLHttpRequest){
conexion=new XMLHttpRequest();	
}
else{
conexion=new ActiveXObject();	
}
conexion.onreadystatechange=function(){
if(conexion.readyState==4){
	if(conexion.status==200){
	document.getElementById('resultado').innerHTML=conexion.responseText;	
	}
	else{
		document.getElementById('resultado').innerHTML="Uvo un error en el servidor";	
	}	
}
else{
	document.getElementById('resultado').innerHTML="<img src=\"templates/images/wainting.gif\">";
}
	
}

conexion.open("GET",mod,true);
conexion.send(null);
}
dropdown.onchange = onCatChange;
/* ]]> */
</script>


<div id="resultado" class="res"></div>

<input type="text" name="datei" id="fecha" readonly="readonly" value="Fecha de viaje" size="13"/>
 &nbsp;<img src="js_mudules/calendar/001_44.png" id="selector" style="cursor: pointer; border: 0px;" title="seleccionar fecha"/>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "selector",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<input type="submit" value="Aplicar cambios" />

           
 

</form>

            		
	</fieldset>
	<div class="clr"> </div>
   <br />
   <br />
   <br />
<?php

if (!empty($model)){ //oculta el baner informativo de asientos esto en caso que el usuario no haya seleccionado un bus *//
?>	   
<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<img src="gen_libs/images_bus/i1.png" />
</td>
<td>
<img src="gen_libs/images_bus/i2.png" />
</td>
<td>
<img src="gen_libs/images_bus/i3.png" />
</td>
<td>
<img src="gen_libs/images_bus/i4.png" />
</td>
</tr>
</table><br />
	<table class="bus" align="center">
		<thead>
			<tr>
		<tfoot>
			<tr class="bus">
				<td colspan="15" class="bus">
              
                <table border="0" align="center">
                <tr class="bus">
                
                <td class="bus">
                
                <?php  } //fin del if de control *// 
			    if (empty($model)){ //verifica que el usuario seleccione un bus caso contrario mostrara un mensaje deerror *//
	
					echo "<iframe id='localscene' name='localscene' src='bus_is_not_selected.php' frameborder='0' framespacing='0' scrolling='auto' border='0' width='600' height='200' >";
				}
				else{ //si el usuario ya ya habia seleccionado previamnete se mostrara el respectivo modelo de generacion *//
                ?>        
                <?php
				
				if(file_exists('gen_libs/'.$model.'.php')){
echo '<iframe id="localscene" name="localscene" src="gen_libs/'.$model.'.php" frameborder="0" framespacing="0" scrolling="auto" border="0" width="600" height="2200" >
                </iframe>  ';	
}
else{
	
echo '<iframe id="localscene" name="localscene" src="load_error.php" frameborder="0" framespacing="0" scrolling="auto" border="0" width="600" height="2200" >
                </iframe>';	
	
}
				
				?>
                        

                <?php
				}
				?>
                     
                </td>
  
                
                </tr>
         
                </table>				

				</td>
			</tr>
		</tfoot>
		<tbody>
				</tbody>
	</table>

	<div>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<noscript>
			¡Aviso! JavaScript debe estar habilitado para realizar esta operación en el panel de administración.		</noscript>
		<div class="clr"></div><?php 
				
				if(isset($status_site)){
				echo $status_site;
				}
				
				
				 ?>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
		
	<div id="footer">
		<p class="copyright">
			<?php	view_menu_user_cp_2(); ?> </span>
		</p>
	</div>


<div style="display: none; z-index: 65555; visibility: hidden; opacity: 0;" id="sbox-overlay"></div><div style="display: none; z-index: 65557;" id="sbox-window"><div class="sbox-bg-wrap"><div class="sbox-bg sbox-bg-n"></div><div class="sbox-bg sbox-bg-ne"></div><div class="sbox-bg sbox-bg-e"></div><div class="sbox-bg sbox-bg-se"></div><div class="sbox-bg sbox-bg-s"></div><div class="sbox-bg sbox-bg-sw"></div><div class="sbox-bg sbox-bg-w"></div><div class="sbox-bg sbox-bg-nw"></div></div><div style="visibility: hidden; opacity: 0;" id="sbox-content"></div><a href="#" id="sbox-btn-close"></a></div></body></html>