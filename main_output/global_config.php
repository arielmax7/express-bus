<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/eighth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion con la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
recover_info_user($con, $valid_user);
check_valid_function_sa_only($level);
//incluimos el archivo donde esta  nuestra clase paginacion
include_once("paginacion.php"); 
$link = $con; // pasamos los parametros de nuestra conexion	

	$query = "SELECT * FROM logs";
		
	$rsT =  $link->query($query); 
	
	$total = $rsT->num_rows; 
	
	if(isset($_GET['page'])){
				$pg = $_GET['page'];	
				}
				else{
					
				$pg = 0;	
				}
	$cantidad = 50; //Cantidad de registros que se desea mostrar por pagina, Para probar solo le coloque 3
	
	$paginacion = new paginacion($cantidad, $pg); //  llamo a mi clase paginacion y por defecto le paso 2 variables.
	$desde = $paginacion->getFrom();
	
	$query = "SELECT * FROM logs ORDER BY register_time DESC LIMIT $desde, $cantidad"; //consulta para mostrar los datos de acuerdo ala cantidad	
		
	//recuperamos los registros deacuerdo al tipo de usuario
	$rs = $link->query($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Configuración Global | <?php default_title(); ?></title>
  <?php recover_info_global_config($con); ?>
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
  <script type="text/javascript" src="jquery_libraries/switcher.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate_fields.js"></script>
  <script type="text/javascript">

			document.switcher = null;
			window.addEvent('domready', function(){
				toggler = document.id('submenu');
				element = document.id('config-document');
				if (element) {
					document.switcher = new JSwitcher(toggler, element, {cookieName: toggler.getProperty('class')});
				}
			});
		window.addEvent('domready', function() {
			$$('.hasTip').each(function(el) {
				var title = el.get('title');
				if (title) {
					var parts = title.split('::', 2);
					el.store('tip:title', parts[0]);
					el.store('tip:text', parts[1]);
				}
			});
			var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false});
		});
window.addEvent('domready', function(){ new Accordion($$('div#permissions-sliders.pane-sliders .panel h3.pane-toggler'), $$('div#permissions-sliders.pane-sliders .panel div.pane-slider'), {onActive: function(toggler, i) {toggler.addClass('pane-toggler-down');toggler.removeClass('pane-toggler');i.addClass('pane-down');i.removeClass('pane-hide');Cookie.write('jpanesliders_permissions-sliders',$$('div#permissions-sliders.pane-sliders .panel h3').indexOf(toggler));},onBackground: function(toggler, i) {toggler.addClass('pane-toggler');toggler.removeClass('pane-toggler-down');i.addClass('pane-hide');i.removeClass('pane-down');},duration: 300,display: 0,show: 0,opacity: false}); });
  </script>


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
        
        <?php //switch selector de mesajes de retorno personalizado proveniete de show_system_messages enviando la variable      $msgreturn con un valor 
		if(isset($_POST["msgreturn"])){
				$msgreturn = $_POST["msgreturn"];	
				}
				else{
					
				$msgreturn = false;	
				}
	  switch ($msgreturn)
	  {
		  case($msgreturn == empty($msgreturn));
		  echo '';  
		  break; 
		  case($msgreturn=="ok_apply");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>La configuracion fue aplicada correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  
		  case($msgreturn=="bad_archive");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error El archivo no es válido</li></ul></dd></dl>';
		  
		  
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
<li class="button" id="toolbar-apply">
<a href="#" onclick="javascript:express.submitbutton('apply')" class="toolbar">
<span class="icon-32-apply">
</span>
Guardar
</a>
</li>

<li class="button" id="toolbar-save">
<a href="#" onclick="javascript:express.submitbutton('save')" class="toolbar">
<span class="icon-32-save">
</span>
Guardar &amp; Cerrar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-cancel">
<a href="index.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_global_config.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-config"><h2>Configuración Global</h2></div>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<div class="clr"></div>
				<div id="submenu-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div class="submenu-box">
			<div class="submenu-pad">
				<ul id="submenu" class="configuration">
					<li><a href="#" onclick="return false;" id="site" class="active">General</a></li>
					<a href="#"></a>
					<a href="#"></a>
					<li><a class="" href="#" onclick="return false;" id="permissions">Logs</a></li>
				</ul>
				<div class="clr"></div>
			</div>
		</div>
		<div class="clr"></div>
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
				<script type="text/javascript">
	express.submitbutton = function(task)
	{
		if (task == 'application.cancel' || document.formvalidator.isValid(document.id('application-form'))) {
			express.submitform(task, document.getElementById('application-form'));
		}
	}
</script>

<form action="apply_config.php" id="application-form" method="post" name="adminForm" class="form-validate" enctype="multipart/form-data">
		<div id="config-document">
		<div style="display: block;" id="page-site" class="tab">
			<div class="noshow">
				<div class="width-60 fltlft">
					<div class="width-100">
<fieldset class="adminform">
	<legend>Configuración del Sitio</legend>
	<ul class="adminformlist">
								<li>
								  <label id="jform_sitename-lbl" for="jform_sitename" class="hasTip required" title="Nombre de la Empresa"> Empresa<span class="star">&nbsp;*</span></label>					
								  <input name="company_name" id="jform_sitename" value="<?php echo $company_name; ?>" class="required" size="50" maxlength="30" type="text" onkeypress="return permite(event, 'car')"></li>
<li><label id="jform_offline-lbl" for="jform_offline" class="hasTip" title="">Sitio desactivado</label>					
<fieldset id="jform_offline" class="radio">

<?php

if($active_site=="si"){
echo '	
<input name="offline" value="si" checked="checked" type="radio"><label for="jform_offline0">Si</label>
<input name="offline" value="no" type="radio"><label for="jform_offline1">No</label>';
}
else{
echo '	
<input name="offline" value="si" type="radio"><label for="jform_offline0">Si</label>
<input name="offline" value="no" checked="checked" type="radio"><label for="jform_offline1">No</label>';
	
}

?>
</fieldset></li>
								<li><label id="jform_offline_message-lbl" for="jform_offline_message" class="hasTip" title="">Mensaje para el sitio web desactivado</label>	<textarea name="offline_message" id="jform_offline_message" cols="60" rows="2" onkeypress="return permite(event, 'num_car')"><?php echo $message_inactive; ?></textarea></li>
								<li>
								  <label id="jform_editor-lbl" for="jform_editor" class="hasTip required" title="Código de Moneda">Moneda por defecto<span class="star">&nbsp;*</span></label>
                                  <input name="type_money" id="jform_sitename" value="<?php echo $type_money; ?>" class="required" size="10" maxlength="4" type="text" onkeypress="return permite(event, 'car')">
</li>
								
								
<li>
<label id="jform_access-lbl" for="jform_access" title="">Plantilla de impresión Boletos</label>					
    <select id="jform_access" name="print_tickets">
	
	<?php recover_all_prints_tickets($con,$print_tickets); ?>
</select>
</li>		


								
							
                            	
				</ul>
</fieldset>
</div>					<div class="width-100">

</div>				</div>




				<div class="width-40 fltrt">
					<div class="width-100">
<fieldset class="adminform long">
	<legend>Restablecer Registro de Ventas</legend>
	<ul class="adminformlist">
<li>
<label id="jform_sef_rewrite-lbl" for="jform_sef_rewrite" class="hasTip" title="Resetea todo el registro de boletos">Boletos<em></em></label>
<fieldset id="jform_sef" class="radio">

<input name="empty_tickets" value="si" type="radio"><label for="jform_sef0">Si</label>
<input name="empty_tickets" value="no"  checked="checked" type="radio"><label for="jform_sef1">No</label>

</fieldset></li>

						
					</ul>
</fieldset>
</div>					
<div class="width-100">

<fieldset class="adminform">
	<legend>Restablecer valores del Sistema</legend>
	<ul class="adminformlist">
								<li>
						  <label id="jform_sef_rewrite-lbl" for="jform_sef_rewrite" class="hasTip" title="Precaución esto causara la perdida total de información del sistema">Resetear sistema<em></em></label>			
                          <fieldset id="jform_sef_rewrite" class="radio">
                          <input name="reset_system" value="si" type="radio"><label for="jform_sef_rewrite0">Si</label>
                          <input name="reset_system" value="no" checked="checked" type="radio"><label>No</label>
                          </fieldset></li>

<li>
						  <label id="jform_sef_rewrite-lbl" for="jform_sef_rewrite" class="hasTip" title="Resetea todos eventos registrados del sistema">Resetear log<em></em></label>		
                          <fieldset id="jform_sef_rewrite" class="radio">
                          <input id="jform_sef_rewrite0" name="reset_log" value="si" type="radio"><label for="jform_sef_rewrite0">Si</label>
                          <input id="jform_sef_rewrite1" name="reset_log" value="no" checked="checked" type="radio"><label for="jform_sef_rewrite1">No</label>
                          </fieldset></li>
					</ul>
</fieldset>
</div>				</div>



			</div>
		</div>
		<div style="display: none;" id="page-system" class="tab">
			
		</div>
        
        
		<div style="display: none;" id="page-server" class="tab">
			
		</div>
		<div style="display: none;" id="page-permissions" class="tab">
		
        
        <table class="adminlist">
		<thead>
			<tr>
				
				<th class="left">
				  Evento			</th>
				
				<th class="center">
					Usuario				</th>
				<th class="center">
					Sucursal				</th>
				<th class="center">
					Fecha y hora de registro				</th>
				
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					
<input name="limitstart" value="0" type="hidden">
				</td>
			</tr>
		</tfoot>
		<tbody>
					<tr class="row0">
				
				
                
                
               
               <?php
	while ($row = $rs->fetch_assoc()) {

    
    
     echo '<tr class="row0"><td class="left">'.$row['event'].'</td>'; 
		
	 echo '<td class="center">'.$row['id_user'].'</td>';
	 
	 echo '<td class="center">'.$row['nam_locations'].'</td>';
	 
	 echo '<td class="center">'.$row['register_time'].'</td></tr>';

	}
?>
			</tr>
					</tbody>
	</table>	
    <div class="container"><div class="pagination">
        <div class="paginacion">
<br />
<?php
	$url = "global_config.php?"; //url donde va a cargar de nuevo la pagina
	
	$classCss = "numPages"; //Clase CSS que queremos asignarle a los links 
	
	$back = "&laquo;Atras"; //textos atras
	$next = "Siguiente&raquo;"; //textos siguiente
	
	$paginacion->generaPaginacion($total, $back, $next, $url, $classCss); // llamo a mi metodo que es el que contiene la estructura de la paginacion
?>
	</div>
        
    </div></div>    
        <div style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;" class="pane-slider content pane-hide">
        
            
            </div></div>			
</div>		
		
		<input name="task" value="" type="hidden">
		<input name="404652f381e4fe9d095f4d10861cbc82" value="1" type="hidden">
        
		<div class="clr"></div>
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


</body></html>