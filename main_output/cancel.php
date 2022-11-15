<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Operacion cancelada</title>'; //cabercera del sitio
	include('../core_system/error_styles.php'); //inportamos los estilos
?>	
    </head><body class="contentpane">
	<div id="all">
	<div id="main">
    <div id="mailto-window">
    <img src="../main_output/templates/images/header/notification_warning.png"><h4><Font color="#FF0000">¡ Operación Canceldata !</Font></h4>
    La operación fue cancelada, cierre esta ventana.
    <br /><br />
    <button class="button" onclick="window.close();return false;">
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


