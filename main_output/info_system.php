<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
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
  <link rel="stylesheet" href="templates/css/system.css" type="text/css">
  <title>Información del Sistema | <?php default_title(); ?></title>
  <?php check_valid_function_users($level); ?>
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/switcher.js"></script>
  <script type="text/javascript">

			document.switcher = null;
			window.addEvent('domready', function(){
				toggler = document.id('submenu');
				element = document.id('config-document');
				if (element) {
					document.switcher = new JSwitcher(toggler, element, {cookieName: toggler.getProperty('class')});
				}
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
			<ul id="menu">
            
            
            
<?php require_once('../core_system/top_menu_view.php')?>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
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
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-systeminfo"><h2>Información Sistema</h2></div>
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
	<div class="t"><div class="t"><div class="t"></div></div></div>
	<div class="m">
		<div class="submenu-box">
			<div class="submenu-pad">
				<ul id="submenu" class="information">
					<li>
						<a href="#" onclick="return false;" id="site" class="active">
							Información Sistema</a>
					</li>
					
						<a></a>
					
					
						<a></a>
					
				
						<a></a>
					
					<li>
						<a href="show_php.php" target="_blank">
							Información PHP</a>
					</li>
				</ul>
				<div class="clr"></div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="b"><div class="b"><div class="b"></div></div></div>
</div>


				
		<div id="element-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div id="config-document">
		<div style="display: block;" id="page-site" class="tab">
			<div class="noshow">
				<div class="width-100">
					<fieldset class="adminform">
	<legend>Información Sistema</legend>
	<table class="adminlist">
		
		<tfoot>
			<tr>
				<td colspan="2">&nbsp;
				</td>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td>
					<strong>Construido sobre PHP:</strong>
				</td>
				<td>
				<?php	echo php_uname(); ?></td>
			</tr>
			<tr>
				<td>
					<strong>versión Base de datos:</strong>
				</td>
				<td>
					<?php echo @ mysql_get_server_info (); ?>				</td>
			</tr>
			
			<tr>
				<td>
					<strong>Vesión PHP:</strong>
				</td>
				<td>
					<?php echo phpversion (); ?>				</td>
			</tr>
			<tr>
				<td>
					<strong>Web Server:</strong>
				</td>
				<td>
					<?php  echo apache_get_version();  ?>				</td>
			</tr>
			
			<tr>
				<td>
					<strong>Versión Express Bus:</strong>
				</td>
				<td>
					<?php recover_version_system($con); ?>				</td>
			</tr>
            <tr>
            
            <td><strong>Fecha y Hora de Instalación</strong></td>
            <td><?php recover_time_installation($con); ?></td>
            </tr>
            <tr>
				<td>
					<strong>Autor:</strong>
				</td>
				<td>
					ArielMax  &copy; 2012	-   <a href="http://www.arielmax.com.ar" target="_blank">www.arielmax.com.ar</a>			</td>
			</tr>
            <tr>
				<td>
					<strong>Idiomas:</strong>
				</td>
				<td>
					Español				</td>
			</tr>
			<tr>
				<td>
					<strong>Navegador:</strong>
				</td>
				<td>
					<?php 
echo $_SERVER [ 'HTTP_USER_AGENT' ] . "\n\n" ; 
 
?> 			</td>
			</tr>
		</tbody>
	</table>
</fieldset>

				</div>
			</div>
		</div>

		<div style="display: none;" id="page-phpsettings" class="tab">
			
		</div>

		<div style="display: none;" id="page-config" class="tab">
			
		</div>

		<div style="display: none;" id="page-directory" class="tab">
			
		</div>

		<div style="display: none;" id="page-phpinfo" class="tab">
			<div class="noshow">
				<div class="width-100">
					<fieldset class="adminform">
	<legend>Información PHP</legend>

</fieldset>
			</div>
		</div>
	</div>

	<div class="clr"></div>
</form>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
                    </
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
			<?php	view_menu_user_cp_2(); ?></span>
		</p>
	</div>


</body></html>