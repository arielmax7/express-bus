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
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Administración - <?php default_title(); ?></title>
    <?php //recuperamos la informacion del usuario
recover_info_user($con, $valid_user); ?>
  <link rel="shortcut icon" href="favicon.ico">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript">
window.addEvent('domready', function(){ new Accordion($$('div#panel-sliders.pane-sliders > .panel > h3.pane-toggler'), $$('div#panel-sliders.pane-sliders > .panel > div.pane-slider'), {onActive: function(toggler, i) {toggler.addClass('pane-toggler-down');toggler.removeClass('pane-toggler');i.addClass('pane-down');i.removeClass('pane-hide');Cookie.write('jpanesliders_panel-sliders',$$('div#panel-sliders.pane-sliders > .panel > h3').indexOf(toggler));},onBackground: function(toggler, i) {toggler.addClass('pane-toggler');toggler.removeClass('pane-toggler-down');i.addClass('pane-hide');i.removeClass('pane-down');if($$('div#panel-sliders.pane-sliders > .panel > h3').length==$$('div#panel-sliders.pane-sliders > .panel > h3.pane-toggler').length) Cookie.write('jpanesliders_panel-sliders',-1);},duration: 300,opacity: false,alwaysHide: true}); });
  </script>


<link rel="stylesheet" href="templates/css/system.css" type="text/css">
<link href="templates/css/template.css" rel="stylesheet" type="text/css">

<!--[if IE 7]>
<link href="templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/css/ie6.css" rel="stylesheet" type="text/css" />
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
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
		<div id="module-menu">
			<ul id="menu">
  <?php require_once('../core_system/top_menu_view.php'); ?>
		<div class="clr"></div>
        
        <?php	
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
		  case($msgreturn=="ok_update");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Datos actualizados correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_apply");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Datos guardados correctamente.</li>
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
				<div id="element-box">
					
					<div class="t">
						<div class="t">
							<div class="t"></div>
						</div>
					</div>
					<div class="m">
					<div class="adminform">
						<div class="cpanel-left">
							<div id="cpanel">   
        
     <div class="icon-wrapper">
	 <div class="icon">
		<a href="tickets.php">
		<img src="templates/images/header/icon-48-article.png" alt=""><span>Gestor de Boletos</span></a>
	 </div></div> 

<div class="icon-wrapper">
	<div class="icon">
		<a href="#" onclick="popupWindow('express_chat.php', 'Ayuda', 678, 650, 1)">
			<img src="templates/images/header/icon-48-newsfeeds-cat.png" alt="">			<span>Express Chat</span></a>
	</div>
</div>

<div class="icon-wrapper">
	<div class="icon">
		<a href="my_profile.php">
			<img src="templates/images/header/icon-48-info.png" alt="">			<span>Editar Perfil</span></a>
	</div>
</div>
<div class="icon-wrapper">
	  <div class="icon">
		<a href="mails.php">
		<img src="templates/images/header/icon-messaging.png" alt=""><span>Gestor de Mensajes</span></a>
	  </div></div>
<?php //este boton solo puede ser visto y accedido por el (super admin , administrador) *//
      if ($level=="sa" || $level=="ad"){
	  //muestra el boton con su respectivo enlace *//  
      echo '<div class="icon-wrapper">
	  <div class="icon">
		<a href="users.php">
		<img src="templates/images/header/icon-48-user.png" alt=""><span>Gestor de Usuarios</span></a>
	  </div></div>'; //muestra el boton de gestor de usuarios *//
	  }
?>
<?php //este boton solo puede ser visto y accedido por el (super admin) *//
      if ($level=="sa"){
	  //muestra el boton con su respectivo enlace *//	  
      echo '<div class="icon-wrapper">
	  <div class="icon">
		<a href="branch.php">
		<img src="templates/images/header/icon-48-module.png" alt=""><span>Gestor de Terminales</span></a>
	  </div></div>'; //muestra el boton de gestor de terminales *//
	  }
?>
<?php //este boton solo puede ser visto y accedido por el (super admin) *//
      if ($level=="sa"){
	  //muestra el boton con su respectivo enlace *//  
      echo '<div class="icon-wrapper">
	  <div class="icon">
		<a href="buses.php">
		<img src="templates/images/header/icon-48-redirect.png" alt=""><span>Gestor de Buses</span></a>
	  </div></div>'; //muestra el boton de gestro de buses *//
	  }
?>
<?php //este boton solo puede ser visto y accedido por el (super admin , admin) *//
      if ($level=="sa" || $level=="ad"){
	  //muestra el boton con su respectivo enlace *//	  
      echo '<div class="icon-wrapper">
	  <div class="icon">
		<a href="payments_tickets.php">
		<img src="templates/images/header/icon-48-featured.png" alt=""><span>Informe Boletos</span></a>
	  </div></div>'; //muestra el boton de informe economico *//
	  }
?>

<?php //este boton solo puede ser visto y accedido por el (super admin) *//
      if ($level=="sa"){
	  //muestra el boton con su respectivo enlace *//	  
      echo '<div class="icon-wrapper">
	  <div class="icon">
		<a href="global_config.php">
		<img src="templates/images/header/icon-48-config.png" alt=""><span>Configuración Global</span></a>
	  </div></div>'; //muestra el boton configuracion global *//
	  }
?>
<?php //este boton solo puede ser visto y accedido por el (super admin) *//
      if ($level=="sa"){
	  //muestra el boton con su respectivo enlace *//
      echo '<div class="icon-wrapper">
      <div class="icon">
		<a href="install_unistall.php">
		<img src="templates/images/header/icon-48-levels.png" alt=""><span>Gestor de Instalación</span></a>
	  </div></div>'; //muestra el boton de gestor de plantillas *//
	  }
?>
</div>
						</div>
						<div class="cpanel-right">
							
<div id="panel-sliders" class="pane-sliders"><div class="panel"><h3 class="title pane-toggler" id="cpanel-panel-logged"><a href="javascript:void(0);"><span>Usuarios en línea</span></a></h3><div style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;" class="pane-slider content pane-hide"><table class="adminlist">
	<thead>
		<tr>
			<th>
				<strong>Usuario</strong>				</th>
			<th>
				<strong>Localización</strong>
			</th>
			<th>
				<strong>Tipo</strong>
			</th>
			<th>
				<strong>Última vez activo.</strong>
			</th>
			<th>
				<strong>Registrado</strong>
			</th>
            <th>
				<strong>Ventas</strong>
			</th>
		</tr>
	</thead>
	<tbody>
<?php  insert_and_show_users_info($con, $user_name, $location, $level, $registered, $full_name, $points, $zone); // insertamos y mostramos datos del usuario logeado *//  ?>		
			</tbody>
</table>
</div></div>
	

						
				
						</div>
					</div>
				</div>
				<noscript>
					¡Aviso! JavaScript debe estar habilitado para realizar esta operación.				</noscript>
				<div class="clr">
            
                
                </div><?php 
				
				if(isset($status_site)){
				echo $status_site;
				}
				
				
				 ?>
			</div>
		</div>
	</div>
	<div id="border-bottom"><div><div></div></div></div>
		
	<div id="footer">
		<p class="copyright">
			<?php	view_menu_user_cp_2(); ?></span>
		</p>
	</div>


</body></html>