<?php
session_start();
$valid_user=$_SESSION["valid_user"];
require_once('../core_system/includes.php');
require_once('../core_system/third_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
recover_info_user($con, $valid_user); 
check_valid_function_users($level); 
$task=$_POST["task"];
$cid=$_POST["cid"];
switch($task)
{
	
	
	case($task=="remove"); // elimina un usuario permanentemente
	
	remove_user_for_system($con, $cid);
	
	
	break;
	
	case($task=="edit"); // edita los datos del usuario seleccionado
	//abrimos el formulario recuperando toda la informcion del usuario
	
?>	
	
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Editar - Usuario | <?php default_title(); ?></title>
  
  <link rel="shortcut icon" href="favicon.ico" />
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
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout">FINALIZAR</span>		</div>
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
<li class="button" id="toolbar-save">
<a href="#" onclick="javascript:express.submitbutton('update_user')" class="toolbar">
<span class="icon-32-save">
</span>
Guardar
</a>
</li>
<li class="button" id="toolbar-cancel">
<a href="users.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cerrar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_users3.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-user-add"><h2>Gestor Usuarios: Editar Usuario</h2></div>
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
<?php recover_all_info_user_selected($con, $cid); ?>

<form action="process_update.php" method="post" name="adminForm" id="user-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>Detalles Cuenta</legend>
			<ul class="adminformlist">
							<li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Nombre real de Usuario">Nombre<span class="star">&nbsp;*</span></label>				<input name="name_user" id="jform_name" value='<?php echo $name_user; ?>' class="inputbox required" size="30" maxlength="20" type="text" onkeypress="return permite(event, 'car')"></li>
                            
                            <li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Apellidos de Usuario">Apellido Paterno<span class="star">&nbsp;*</span></label>				<input name="last_name_user1" id="jform_name" value='<?php echo $last_name_user1; ?>' class="inputbox required" size="30" maxlength="20" type="text" onkeypress="return permite(event, 'car')"></li>
                            
                            <li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Apellidos de Usuario">Apellido Materno</label>				<input name="last_name_user2" id="jform_name" value='<?php echo $last_name_user2; ?>' class="inputbox" size="30" maxlength="20" type="text" onkeypress="return permite(event, 'car')"></li>
                            
                  <li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Dirección de Usuario">Dirección<span class="star">&nbsp;*</span></label>				<input name="address_user" id="jform_name" value='<?php echo $address_user; ?>' class="inputbox required" size="30" maxlength="32" type="text" onkeypress="return permite(event, 'num_car')"></li>
                            
                            <li><label id="jform_name-lbl" for="jform_name" class="hasTip" title=" Teléfono de Usuario (Opcional)">Teléfono</label>					<input name="phone_user" id="jform_name" value='<?php echo $phone_user; ?>' class="text" maxlength="15" size="30" type="text" onkeypress="return permite(event, 'num')"></li>
                            
                            <li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="No puede Cambiar el número de documento de Usuario">DNI<span class="star">&nbsp;*</span></label>				<input title="<?php echo $registered_user; ?>" name="id_user" id="jform_registerDate" value='<?php echo $cid ; ?>' size="22" class="readonly" readonly="readonly" type="text"></li>
                            
							<li><label id="jform_username-lbl" for="jform_username" class="hasTip required" title="No puedes Cambiar el Nombre Usuario">Nombre Acceso<span class="star">&nbsp;*</span></label>
                            
                         <input title="<?php echo $registered_user; ?>" name="us" id="jform_registerDate" value='<?php echo $access_name; ?>' size="22" class="readonly" readonly="readonly" type="text">
                            </li>
                            
                            
							
							<li><label id="jform_email-lbl" for="jform_email" class="hasTip required" title="Email de Usuario">Email<span class="star">&nbsp;*</span></label>				<input name="email_user" class="validate-email inputbox required" id="jform_email" value='<?php echo $email_user; ?>' size="30" type="text"></li>
							<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Fecha Registro</label>				
<input title="" id="jform_lastvisitDate" value='<?php echo $registered_user; ?>' size="22" class="readonly" readonly="readonly" type="text">                            
                            
                            </li>
                            
                            <li><label id="jform_params_admin_style-lbl" for="jform_params_admin_style" class="hasTip" title="Terminal del Usuario">Terminal</label>				<select id="jform_params_admin_style" name="branch">
                                           
	<?php view_branch_for_users($con, $level, $location_user); ?>
    
</select></li>
					
</ul>
</fieldset>

<fieldset id="user-groups" class="adminform">    
<legend>Niveles Asignados</legend>
<ul class="checklist usergroups">


<?php 
//verificamos los check box
if ($level_user=="sa"){ 
			
echo '<li>
<input value="sa" id="1group_6" rel="1group_1" type="radio" checked="checked" disabled="disabled">
<label for="1group_6">
<span class="gi">|—----</span>Super Administrador
</label>
</li>';  
echo '<input name="level_user" value="sa" type="hidden">';      

      
}
else{

	    if($level_user=="us"){
		
		 echo'<li>
		<input name="level_user" value="usuario" id="1group_1" type="radio" checked="checked">
		<label for="1group_1">
		Usuario
		</label>
		</li>';
		
			if($level=="sa"){
				
			echo '<li>        
			<input name="level_user" value="administrador" id="1group_6" rel="1group_1" type="radio">
			<label for="1group_6">
			<span class="gi">|—</span>Administrador
			</label>
			</li>';
			
			}
					
			
		}
		else{
    
	    if($level=="sa"){
	    echo'<li>
		<input name="level_user" value="usuario" id="1group_1" type="radio">
		<label for="1group_1">
		Usuario
		</label>
		</li>';
		}
		
		echo '<li>        
		<input name="level_user" value="administrador" id="1group_6" rel="1group_1" type="radio" checked="checked">
		<label for="1group_6">
		<span class="gi">|—</span>Administrador
		</label>
		</li>	';
	
		}
	
	
}
	    
?>        
        

        
 
        
</ul>		</fieldset>
			</div>

	<div class="width-40 fltrt">
	  <input name="task" value="" type="hidden">
		<input name="0ac0b3649221945d2cf9410d5857e479" value="1" type="hidden">	</div>
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


<div style="position: absolute; top: 239px; left: 118px; display: none;" class="tip-wrap"><div class="tip-top"></div><div class="tip"><div class="tip-title">Nombre</div><div class="tip-text">Inserte el nombre de usuario</div></div><div class="tip-bottom"></div></div></body></html>
	
<?php	
	
	//FIN DE LA EDICION
	break;
	
}
?>