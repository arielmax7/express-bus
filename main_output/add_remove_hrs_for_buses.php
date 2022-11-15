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
  <title>Agregar / Quitar Horarios | Express Bus Tickes</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <?php recover_info_user($con, $valid_user); //recupera toda la informacion del usuario ?>
  <script language="JavaScript">
function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
	if(document.getElementById('number').value==60){
	document.getElementById('number').value = value;	
	}
	else{
	value=value+5;	
	document.getElementById('number').value = value;	
	}
}
function decrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
	if(document.getElementById('number').value==0){
	document.getElementById('number').value = value;	
	}
	else{
	value=value-5;
	document.getElementById('number').value = value;	
	}
}

//Codigo ajax para agregar o quitar horarios
//funcion para listar los orarios del bus seleccionado
function operaciones(){
var conexion;
var se=document.padre.opcion.value;
var m=document.padre.m.value;
var h=document.padre.h.value;
var id_h=document.padre.id_hrst.value;
var op=dropdown.options[dropdown.selectedIndex].value;
myrand=parseInt(Math.random()*999999999);

mod="execute_hrs_buses.php?m="+m+"&h="+h+"&op="+op+"&se="+se+"&id_h="+id_h+"&rand="+myrand;

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
		Horarios de Salida	</font>
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

mod="execute_hrs_buses.php?op="+op+"&rand="+myrand;

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
dropdown.onchange = onCatChange;
/* ]]> */
</script>
            
            
            
            
 
           
		</div>

		
		<p>
			 <label > Horas: </label> 
             <select name="h">
             
             <option value="01">1 AM</option>
             <option value="02">2 AM</option>
             <option value="03">3 AM</option>
             <option value="04">4 AM</option>
             <option value="05">5 AM</option>
             <option value="06">6 AM</option>
             <option value="07">7 AM</option>
             <option value="08">8 AM</option>
             <option value="09">9 AM</option>
             <option value="10">10 AM</option>
             <option value="11">11 AM</option>
             <option value="12">12 PM</option>
             <option value="13">13 PM</option>
             <option value="14">14 PM</option>
             <option value="15">15 PM</option>
             <option value="16">16 PM</option>
             <option value="17">17 PM</option>
             <option value="18">18 PM</option>
             <option value="19">19 PM</option>
             <option value="20">20 PM</option>
             <option value="21">21 PM</option>
              <option value="22">22 PM</option>
             <option value="23">23 PM</option>
             <option value="00">24 AM</option>
             </select>:
             <input type="text" id="number" name="m" value="0" readonly="readonly" size="1"/>
             &nbsp;Min &nbsp;
   <input type="button" onclick="incrementValue()" value="+" />
   <input type="button" onclick="decrementValue()" value="-" />
           
				
		</p>
		
        
        <input type="hidden" name="task" value="cr" />
       
        
	
  
     <p>
            <label > Horarios Actuales: </label></p>
            <p>
            <div id="resultado" class="res"></div>
           <br />
           <select name="opcion">
            <option value="add">Agregar</option>
            <option value="del">Eliminar</option>
            
            </select>&nbsp;<button type="button" id="procesar" onclick="operaciones()">> Ejecutar</button>
          
    
    </p>
 </form>
</div>

		</div>
	</div>
</body>
</html>