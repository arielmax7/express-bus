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
require_once('../core_system/eighth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
recover_info_user($con, $valid_user);
check_valid_function_sa_only($level);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Gestor de instalación | <?php default_title(); ?></title>
  <?php recover_info_global_config($con); ?>
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
   <script type="text/javascript">
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
				<span class="logo"><a href="http://www.arielmax.com.ar/express_bus/" target="_blank"><img src="templates/images/logo.png" alt="express Bus"></a></span>
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
		  case($msgreturn=="ok_install_gen_libs");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Módulo instalado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_unistall_prints");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Platilla de impresion  Desinstalado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_remove");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Módulo Desinstalado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_install_prints");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Plantilla de impresion instalado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  
		  case($msgreturn=="error_unistall_prints");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se pudo desinstalar la plantilla de impresion</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="error_invalid_mod");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error el archivo no es un modulo de generacion valida.</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="no_selected_mod");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No seleciono un modulo</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="bad_archive");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Archivo no valido</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="error_install_gen_libs");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se pudo instalar el módulo es posible que este no sea válido</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="error_upload");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error al subir el archivo verifique su conexion o espacio en el servidor</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="empty_file");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No selecciono archivo a subir</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="error_remove");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se pudo desinstalar el modulo</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="error_install_prints");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se pudo instalar la platilla de impresion</li></ul></dd></dl>';
		  
		  
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


<li class="button" id="toolbar-delete">
<a href="#" onclick="javascript: if(confirm('¿Está seguro que desea desinstalar?')){express.submitbutton('unistall')}" class="toolbar">
<span class="icon-32-delete">
</span>
Desisntalar
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
<a href="#" onclick="popupWindow('../help/help_install_unistall.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-levels"><h2>Instalar / Desinstalar Módulos</h2></div>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<div class="clr"></div>
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

<form action="remove_modules.php" id="application-form" method="post" name="adminForm" class="form-validate" enctype="multipart/form-data">
		<div id="config-document">
		<div style="display: block;" id="page-site" class="tab">
			<div class="noshow">
				<div class="width-40 fltrt">
					<div class="width-100">
<fieldset class="adminform long">
	<legend>Desinstalar (gen-libs)</legend>
	<ul class="adminformlist">
<li>
<label id="jform_sef_rewrite-lbl" for="jform_sef_rewrite" class="hasTip" title="Seleccione módulo a Desinstalar">Seleccione la librería: <em></em></label>
<fieldset id="jform_sef" class="radio">

<select name="unistall_lib">
<?php  recover_install_gen_libs($con); ?>

</select>
<input name="remove_lib_gen" value="si" type="radio"><label for="jform_sef0">Si</label>
<input name="remove_lib_gen" value="no"  checked="checked" type="radio"><label for="jform_sef1">No</label>

</fieldset></li>

						
				  </ul>
</fieldset>
</div>					
<div class="width-100">


</div>				</div>



<input name="task" value="" type="hidden">
		<input name="404652f381e4fe9d095f4d10861cbc82" value="1" type="hidden">
        </form>
				<div class="width-60 fltlft">
					<div class="width-100">

<form action="gen_libs/install_gen_libs.php" method="post" enctype="multipart/form-data">                   
<fieldset class="adminform long">
	<legend>Instalar (gen-libs)</legend>
	<ul class="adminformlist">
<li><label id="jform_message-lbl" for="jform_message" class="hasTip required" title="Subir módulo de generación extensión .zip">Subir Archivo .zip<span class="star">&nbsp;*</span></label><input name="userfile" type="file">
<input type="submit" value="Subir e Instalar" />
</li>

						
				  </ul>
</fieldset>
</form>
</div>					
<div class="width-100">


</div>				</div>



			</div>
		</div>
		<div style="display: none;" id="page-system" class="tab">
			
		</div>
        
        
		<div style="display: none;" id="page-server" class="tab">
			
		</div>
		<div style="display: none;" id="page-permissions" class="tab">
		
        
       
        
        
        
        <div style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;" class="pane-slider content pane-hide">
        
            
            </div></div>			
</div>		
		
		
        
		<div class="clr"></div>


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
				}
				
				
				 ?>
	<div class="clr"></div>
<div id="border-bottom"><div><div></div></div></div>
		
	<div id="footer">
		<p class="copyright">
			<?php	view_menu_user_cp_2(); ?></span>
		</p>
	</div>


</body></html>