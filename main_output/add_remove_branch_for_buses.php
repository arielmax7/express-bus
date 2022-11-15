<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/firts_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion BD
$con=db_connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Agregar / Quitar Destinos | Express Bus Tickets</title>
  <link rel="shortcut icon" href="favicon.ico">
  <?php recover_info_user($con, $valid_user); //recupera toda la informacion del usuario ?>
<script language="JavaScript">

//Codigo ajax para agregar o quitar horarios
//funcion para listar los orarios del bus seleccionado
function operaciones(){
var conexion;
var se=document.padre.opcion.value;
var d=document.padre.destinatios.value;
var id_d=document.padre.id_hrst.value;
var op=dropdown.options[dropdown.selectedIndex].value;
myrand=parseInt(Math.random()*999999999);

mod="execute_branch_buses.php?d="+d+"&op="+op+"&se="+se+"&id_d="+id_d+"&rand="+myrand;

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
	document.getElementById('resultado').innerHTML="<img src=\"main_output/templates/images/wainting.gif\">";
}
	
}

conexion.open("GET",mod,true);
conexion.send(null);
	
}
//fin de la funcion para listar

//funcion para gregar





</script>
  
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
	<font size="4" color="#0099CC">
		Rutas - Destinos	</font>
	<div class="mailto-close">

		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
	
	<form name="padre">
		<div class="formelm">
			<label for="mailto_field">Número de Bus: </label>
			
            <select name="num_bus" id="bus" class="wide">
            <?php
			
			
			recover_buses($con);
			
			?>
            </select>
            
            <script type='text/javascript'>
/* <![CDATA[ */
var dropdown = document.getElementById("bus");
function onCatChange(){
if (dropdown.options[dropdown.selectedIndex].value > 0)  
var conexion;
var op=dropdown.options[dropdown.selectedIndex].value;
myrand=parseInt(Math.random()*999999999);

mod="execute_branch_buses.php?op="+op+"&rand="+myrand;

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
            
            
            
		</div>
<br />
            <label for="mailto_field">Lugar de destino: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
            <select name="destinatios">
            <?php
			
			recover_destins($con);
			?>
            
            </select>
            <p>
            Destinos Actules:
            </p>
            <div id="resultado" class="res"></div>
            
            <br />
            
		<p>
			<select name="opcion">
            <option value="add">Agregar</option>
            <option value="del">Eliminar</option>
            
            </select>&nbsp;<button type="button" id="procesar" onclick="operaciones()">> Ejecutar</button>
			
		</p>
		
        
        <input type="hidden" name="task" value="cr" />
        <input type="hidden" name="bus" value="<?php echo $bus;  ?>" />
        <input type="hidden" name="dt" value="<?php echo $dt; ?>" />
        <input type="hidden" name="hrs" value="<?php echo $hrs; ?> " />
	</form>
</div>

		</div>
	</div>
</body>
</html>