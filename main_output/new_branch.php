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
require_once('../core_system/fifth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect(); 
date_default_timezone_set($zone);
recover_info_user($con, $valid_user);
check_valid_function_users($level); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Nueva Terminal |
  <?php default_title(); ?>
</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
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
<li class="disabled"><a>Usuarios</a>
</li>
<li class="disabled"><a>Boletos</a>
</li>
<li class="disabled"><a>Ayuda</a>
</li>
</ul>

		</div>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout">FINALIZAR</span>		</div>
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
		  case($msgreturn=="already_name");
		  
		 echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>El nombre de sucursal ya esta en uso</li></ul></dd></dl>';
		  
		  break;
		  
		   case($msgreturn=="already_email");
		  
		 echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>El Email ya esta en uso coloque un email valido</li></ul></dd></dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_insert_new_branch");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Sucursal Agregada Puede Continuar agregando mas sucursales.</li>
	</ul>
</dd>
</dl>';
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


<li class="button" id="toolbar-save">
<a href="#" onclick="javascript:express.submitbutton('save')" class="toolbar">
<span class="icon-32-save">
</span>
Guardar &amp; Cerrar
</a>
</li>

<li class="button" id="toolbar-save-new">
<a href="#" onclick="javascript:express.submitbutton('save_new')" class="toolbar">
<span class="icon-32-save-new">
</span>
Guardar &amp; Nuevo
</a>
</li>

<li class="button" id="toolbar-cancel">
<a href="branch.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_branch2.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-module"><h2>Gestor de Terminales: Añadir Nueva Terminal</h2></div>
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
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
			express.submitform(task, document.getElementById('user-form'));
		}
	}
</script>

<form action="add_branch.php" method="post" name="adminForm" id="user-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>Detalles de Sucursal</legend>
			<ul class="adminformlist">
							<li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Coloca el nombre de la Terminal (ciudad)">Nombre<span class="star">&nbsp;*</span></label>				<input name="branch_name" id="jform_name" class="inputbox required" size="30" maxlength="20" type="text" onkeypress="return permite(event, 'car')"></li>
							
							<li>
                            <li>
							  <label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Coloca la Dirección de la Terminal">Dirección<span class="star">*</span></label>				<input name="brach_address" id="jform_username" class="inputbox required" size="30"  maxlength="30" type="text" onkeypress="return permite(event, 'num_car')"></li>
				  <li>
<label id="jform_password-lbl" for="jform_password" class="hasTip" title="Coloca el Número de Teléfono de la Terminal">Teléfono<span class="star">&nbsp;*</span></label>
<input name="branch_phone" id="jform_password" autocomplete="off" class="inputbox required" size="30" maxlength="15" type="text" onkeypress="return permite(event, 'num')"></li>
							
							
							<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Fecha Registro</label>				<input title="" name="register_date" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo date("Y-m-d") ?>"></li>
							
							<li>
<label id="jform_sendEmail-lbl" for="jform_sendEmail" class="hasTip" title="Esta Terminal esta operativa">Operativo</label>
<fieldset id="jform_sendEmail" class="radio">

	
<input id="jform_sendEmail0" name="operating" value="no" type="radio"><label for="jform_sendEmail0">No</label>
<input id="jform_sendEmail1" name="operating" value="si" type="radio" checked="checked"><label for="jform_sendEmail1">Si</label>

</fieldset></li>

<li><label id="jform_block-lbl" for="jform_block" class="hasTip" title="Esta Terminal esta autorizada para Vaciar los Buses ">Autorizado para vaciar Bus</label>				
<fieldset id="jform_block" class="radio">
	
<input id="jform_block0" name="aut_empty_bus" value="no"  checked="checked" type="radio"><label for="jform_block0">No</label>
<input id="jform_block1" name="aut_empty_bus" value="si"  type="radio"><label for="jform_block1">Si</label>
	

</fieldset></li>
<li><label id="jform_id-lbl" for="jform_id" class="hasTip" title="Número de Identificación de la Terminal">ID</label><input title="" name="id_branch" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="Automático"></li>
						</ul>
                        
                        <li><label id="jform_id-lbl" for="jform_id" class="hasTip" title="Número de orden de la Terminal">Nº Orden de Ruta</label><input name="order_branch" id="jform_password" autocomplete="off" class="inputbox required" size="5" maxlength="2" type="text" onkeypress="return permite(event, 'num')"></li>
                        <li>
                        <label id="jform_id-lbl" for="jform_id" class="hasTip" title="Número de orden de la Terminal">Ejemplo Orden de Ruta:</label>
                        

                        </li>
        <img src="templates/images/route.jpg" width="660" height="200"/>               
		</fieldset>
         

                      
        
        
<input name="task" value="" type="hidden">
		<input name="cff1982236c38552a8d96f4d6bde89c1" value="1" type="hidden">
				
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
		<div class="clr"></div>
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
    