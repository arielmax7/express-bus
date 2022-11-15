<?php //********************************* PLATILLA DE IMPRESION DEFAULT ****************************************//
$valid_user=$_SESSION["valid_user"];
require_once('../core_system/pay_to_string.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Imrprimir boleto | Express Bus Tickets</title>
<script type="text/javascript" src="js_mudules/prints/print.js"></script>
<script type="text/javascript" src="js_mudules/navigator/detect_tickets.js"></script>
</head>
<body bgcolor="#FFFFFF">
<br />
<?php
//ejecutamos previamente una consulta a la base de datos para saver el numero de factura
//separmos la fecha en componentes
$dt=$_POST["dt"];
$bus=$_POST["bus"];
$fecha=$dt; //asignamos la fecha
list($anyo,$mes,$dia) = explode("-",$fecha);
//declaramos las tres variables de tipo global para poder llamar
//echo $dia; // Imprime 12
//echo $mes; // Imprime 01
//echo $anyo; // Imprime 2005
//comparamos el mes y lo combertimos a un string
switch ($mes)
{
	case($mes==1);
  	//mes de enero
	$week="enero";
	break;
	case($mes==2);
	//mes de febrero
	$week="febrero";
	break;
	case($mes==3);
	//mes de marzo
	$week="marzo";
	break;
	case($mes==4);
	//mes de abril
	$week="abril";
	break;
	case($mes==5);
	//mes de mayo
	$week="mayo";
	break;
	case($mes==6);
	//mes de junio
	$week="junio";
	break;
	case($mes==7);
	//mes de julio
	$week="julio";
	break;
	case($mes==8);
	//mes de agosto
	$week="agosto";
	break;
	case($mes==9);
	//mes de septiembre
	$week="septiembre";
	break;
	case($mes==10);
	//mes de octubre
	$week="octubre";
	break;
	case($mes==11);
	//mes de noviembre
	$week="noviembre";
	break;
	case($mes==12);
	//mes de diciembre
	$week="diciembre";
	break;
}

 if(isset($_POST["destino"])){
				$destino = $_POST["destino"];	
				}
				else{
					
				$destino = false;	
				}
if(isset($_POST["origin"])){
				$origin = $_POST["origin"];	
				}
				else{
					
				$origin = false;	
				}
if(isset($_POST["name_client"])){
				$name_client = $_POST["name_client"];	
				}
				else{
					
				$name_client = false;	
				}
if(isset($_POST["last_name_client"])){
				$last_name_clien = $_POST["last_name_client"];	
				}
				else{
					
				$last_name_clien = false;	
				}
if(isset($_POST["ci"])){
				$ci = $_POST["ci"];	
				}
				else{
					
				$ci = false;	
				}				 
 if(isset($_POST["money"])){
				$money = $_POST["money"];	
				}
				else{
					
				$money = false;	
				}
 



//$pl=$_POST["place"];
////
global $origin2;
global $destino2;
global $money2;
global $name_client2;
global $last_name_client2;
global $pl2;
global $ci2;
if(!isset($last_name_client)){
				$last_name_client = false;	
				}
				

?>
<div>
<div id="apDiv1"><?php  echo $origin; echo $origin2; ?></div>
<div id="apDiv2"><?php echo $destino; echo $destino2; ?></div>
<div id="apDiv3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dia; ?>&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $week; ?>&nbsp;&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $anyo; ?></div>
<div id="apDiv4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $name_client; echo $name_client2; ?> &nbsp;&nbsp;<?php echo $last_name_client; echo $last_name_client2; ?></div>
<div id="apDiv5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ci; echo $ci2; ?></div>
<div id="apDiv6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 
	
if(empty($money)){
echo convertirNumeroLetra($money2);
}
else{
echo convertirNumeroLetra($money); 
}

?></div>
<div id="apDiv7">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $money; echo $money2; ?></div>
<div id="apDiv8"><?php echo $pl; echo $pl2; ?></div>
<div id="apDiv9"><?php echo $hrs; ?></div>
<div id="apDiv10"><?php echo ''.$dia.'/'.$mes.'/'.$anyo.''; ?></div>
<div id="apDiv11"><?php echo $valid_user; ?></div>

<div id="apDiv15"><?php echo $money; echo $money2; ?></div>
<div id="apDiv16"><?php echo $pl; echo $pl2; ?></div>
<div id="apDiv17"><?php echo ''.$dia.'/'.$mes.'/'.$anyo.''; ?></div>
<div id="apDiv18"><?php echo $bus; ?></div>
</div>
<script language="Javascript">
	javascript:imprimir();
</script>
</body>
</html>