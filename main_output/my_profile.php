<?php
session_start();
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/third_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexiona a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
date_default_timezone_set($zone);
recover_info_user($con, $valid_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Mi Perfil | <?php default_title(); ?></title>
  <link rel="shortcut icon" href=../main_output/favicon.ico>
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate_fields.js"></script>
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
window.addEvent('domready', function(){ new Accordion($$('div#sliders.pane-sliders > .panel > h3.pane-toggler'), $$('div#sliders.pane-sliders > .panel > div.pane-slider'), {onActive: function(toggler, i) {toggler.addClass('pane-toggler-down');toggler.removeClass('pane-toggler');i.addClass('pane-down');i.removeClass('pane-hide');Cookie.write('jpanesliders_sliders',$$('div#sliders.pane-sliders > .panel > h3').indexOf(toggler));},onBackground: function(toggler, i) {toggler.addClass('pane-toggler');toggler.removeClass('pane-toggler-down');i.addClass('pane-hide');i.removeClass('pane-down');if($$('div#sliders.pane-sliders > .panel > h3').length==$$('div#sliders.pane-sliders > .panel > h3.pane-toggler').length) Cookie.write('jpanesliders_sliders',-1);},duration: 300,opacity: false,alwaysHide: true}); });
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
			<ul id="menu" class="disabled">
<li class="disabled"><a>Sitio</a>
</li>

<li class="disabled"><a>Boletos</a>
</li>

<li class="disabled"><a>Ayuda</a>
</li>
</ul>

		</div>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $valid_user; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Sucursal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout">FINALIZAR</span>		</div>
		<div class="clr">
         
        </div>
	</div>
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
		  case($msgreturn=="bad_password");
		  
		  echo '<dl id="system-message">
                <dt class="error">Error</dt>
                <dd class="error message fade">
	            <ul>
		        <li>Los campos de contrase&ntilde;a y confirmar contrase&ntilde;a no fueron llenados correctamente</li></ul></dd></dl>';
		  
		  break;
		  case($msgreturn=="bad_email"); //muestra el mensaje que la fecha no es correcta */
		  
		  echo '<dl id="system-message">
                <dt class="error">Error</dt>
                <dd class="error message fade">
	            <ul>
		        <li>El email colocado ya esta en uso coloque otro email valido</li></ul></dd></dl>';
		  break;  
		  case($msgreturn=="ok_update");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Los datos fueron actualizados correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
	  }    
?>        
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
<li class="button" id="toolbar-save">
<a href="#" onclick="javascript:express.submitbutton('profile.save')" class="toolbar">
<span class="icon-32-save">
</span>
Guardar &amp; Cerrar
</a>
</li>

<li class="button" id="toolbar-cancel">
<a href="index.php" onclick="express_bus('profile.cancel')" class="toolbar">
<span class="icon-32-cancel">
</span>
Cerrar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_perfil.html', 'Ayuda',900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr">


</div>
</div>


					<div class="pagetitle icon-48-user-profile"><h2>Mi perfil</h2></div>
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
		if (task == 'profile.cancel' || document.formvalidator.isValid(document.id('profile-form'))) {
			express.submitform(task, document.getElementById('profile-form'));
		}
	}
</script>

<form action="update_my_profile.php" method="post" name="adminForm" id="profile-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>Detalles de mi perfil</legend>
			<ul class="adminformlist">
             
							<li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="">Nombre<span class="star">&nbsp;*</span></label>				<input name="name1" id="jform_name" value= "<?php echo $name; ?>" class="inputbox required" size="30" type="text" maxlength="20" onkeypress="return permite(event, 'car')"></li>
                            
 <li><label id="jform_name-lbl" for="jform_name" class="hasTip" title="">Apellido Paterno<span class="star">&nbsp;*</span></label>				<input name="name2" id="jform_name" value= "<?php echo $last_name; ?>" class="inputbox required" size="30" type="text"  maxlength="20" onkeypress="return permite(event, 'car')"></li><li><label id="jform_name-lbl" for="jform_name" class="hasTip" title="">Apellido Materno</label>				<input name="name3" id="jform_name" value= "<?php echo $last_name2; ?>" class="inputbox" size="30" type="text" maxlength="20" onkeypress="return permite(event, 'car')"></li>                           
                            
							<li><label id="jform_username-lbl" for="jform_username" class="hasTip required" title="No puedes cambiar el usuario">Nombre de usuario<span class="star"></span></label>				<input name="us_name" id="jform_username" value="<?php echo $valid_user; ?>" class="inputbox required" size="30" type="text" disabled="disabled"></li>
							<li><label id="jform_password-lbl" for="jform_password" class="hasTip" title="">Nueva Contraseña</label>				<input name="pass1" id="jform_password" value="" autocomplete="off" class="inputbox" size="30" type="password" maxlength="20"></li>
							<li><label id="jform_password2-lbl" for="jform_password2" class="hasTip" title="">Confirme la contraseña</label>				<input name="pass2" id="jform_password2" value="" autocomplete="off" class="inputbox" size="30" type="password" maxlength="20"></li>
							<li><label id="jform_email-lbl" for="jform_email" class="hasTip required" title="">Email<span class="star">&nbsp;*</span></label>				<input name="mail" class="validate-email inputbox required" id="jform_email" value="<?php echo $email; ?>" size="30"></li>
                           
<li><label id="jform_params_admin_style-lbl" for="jform_params_admin_style" class="hasTip" title="">Sucursal actual: </label><select id="jform_params_admin_style" name="loc">
<?php view_branch_for_users($con, $level, $location, $id_location_us); ?>
</select></li><li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Fecha de registro</label>				<input title="Miércoles, 04 Mayo 2011" name="jform[registerDate]" id="jform_registerDate" value="<?php  echo $registered; ?>" size="22" class="readonly" readonly="readonly" type="text"></li>
							<li><label id="jform_lastvisitDate-lbl" for="jform_lastvisitDate" class="hasTip" title="">Fecha de última visita</label><input title="Jueves, 13 Mayo 2011" name="jform[lastvisitDate]" id="jform_lastvisitDate" value="<?php echo date("d/m/Y"); ?>" size="22" class="readonly" readonly="readonly" type="text"></li>
							<li>
                            <label id="jform_lastvisitDate-lbl" for="jform_lastvisitDate" class="hasTip" title="">Tipo de usuario</label><li>
                          <input title="Jueves, 13 Mayo 2011" name="jform[lastvisitDate]" id="jform_lastvisitDate" value="<?php echo $level; ?>" size="22" class="readonly" readonly="readonly" type="text"></li>  	
                          
                         <li>
                            <label id="jform_lastvisitDate-lbl" for="jform_lastvisitDate" class="hasTip" title="">Sucursal</label><li>
                          <input title="Jueves, 13 Mayo 2011" name="jform[lastvisitDate]" id="jform_lastvisitDate" value="<?php echo $location; ?>" size="22" class="readonly" readonly="readonly" type="text"></li>  	 
                          
                         
                          
                          <li>
                            <label id="jform_lastvisitDate-lbl" for="jform_lastvisitDate" class="hasTip" title="">Puntuación</label><li>
                          <input title="Jueves, 13 Mayo 2011" name="jform[lastvisitDate]" id="jform_lastvisitDate" value="<?php echo $points; ?>" size="22" class="readonly" readonly="readonly" type="text"></li>  	
                          
                          
                            <label id="jform_id-lbl" for="jform_id" class="hasTip" title="">DNI</label>				<input name="idn" id="jform_id" value="<?php echo $id; ?>" class="readonly" readonly="readonly" type="text"></li>
				</ul>
		</fieldset>
	</div>
    
    

<div class="width-40 fltrt">
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


<div style="position: absolute; top: 239px; left: 118px; display: none;" class="tip-wrap"><div class="tip-top"></div><div class="tip"><div class="tip-title">Nombre</div><div class="tip-text">Inserte el nombre de usuario</div></div><div class="tip-bottom"></div></div></body></html>