<?php
//importamos las librerias principales
require_once('check_install.php'); //verificamos si la aplicacion esta instalada
require_once('core_system/show_cr.phtml');
require_once('core_system/show_system_messages.php');
require_once('includes/db_system.php');
require_once('core_system/info_sys.php');
//control de intentos errados
if (isset($_COOKIE['access_error']) && $_COOKIE['access_error'] >= 3)
header("Location: error.php");  



//conexion a la BD
$con=db_connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Acceso - <?php default_title(); ?></title>
  <link rel="shortcut icon" href="main_output/favicon.ico">
  <script type="text/javascript" src="main_output/jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="main_output/jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript">
function keepAlive() {	var myAjax = new Request({method: "get", url: "index.php"}).send();} window.addEvent("domready", function(){ keepAlive.periodical(840000); });
window.addEvent('domready', function () {if (top != self) {top.location.replace(top.location.href);}});
  </script>
<link rel="stylesheet" href="main_output/templates/css/system.css" type="text/css" />
<link href="main_output/templates/css/template.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="main_output/templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="main_output/templates/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="main_output/templates/css/rounded.css" />
<script type="text/javascript">
	function setFocus() {
		document.getElementById('form-login').username.select();
		document.getElementById('form-login').username.focus();
	}
</script>
</head>
<body onload="javascript:setFocus()">
	<div id="border-top" class="h_blue">
		<div>
			<div>
            <span class="logo"><a href="http://www.arielmax.com.ar/express_bus/" target="_blank"><img src="main_output/templates/images/logo.png" alt="Express Bus"></a></span>
				<span class="title"><a href="index.php"><?php company_name($con); ?></a></span>

			</div>
		</div>
	</div>
	<div id="content-box">
	  <div class="padding">
			<div class="clr"></div>
			<div id="element-box" class="login">
				<div class="t">
					<div class="t">

						<div class="t"></div>
					</div>
				</div>
				<div class="m wbg">
					<h1>Acceso a  Express Bus Tickets!</h1>
<?php  // switch selector de mesajes de retorno personalizado proveniete de show_system_messages enviando la variable $msgreturn con un valor *// 
				if(isset($_POST["msgreturn"])){
				$msgreturn = $_POST["msgreturn"];	
				}
				else{
					
				$msgreturn = false;	
				}
                
				switch($msgreturn)
				{
					case($msgreturn== empty($msgreturn)); //si la variable $msgreturn esta vacio no nuestra nada *//
					echo '';
					break;
					
					case($msgreturn=="emp"); //si el valor es igual a emp muestra muestra que los campos estan vacios *//
					echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Nombre de usuario y contraseña estan vacios introdusca sus datos</li></ul></dd></dl>';
					break;
					
					case($msgreturn=="inv"); //si el valor es igual a inv muestra que los campos fueron llenados con caracteres no permitidos *//
					echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Caracteres no permitidos</li></ul></dd></dl>';		
					break;
					
					case($msgreturn=="no"); //si el valor es igual a no muestra que el nombre o contraseña son incorrectos *//
					echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Nombre de usuario y contraseña no son validos intentelo denuevo</li></ul></dd></dl>';
					break;
					
					case($msgreturn=="no_acces_sys"); //si el valor es igual a no muestra que el nombre o contraseña son incorrectos *//
					echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Tu ha cuenta sido desactivada intentalo de nuevo o contactate con el administrador</li></ul></dd></dl>';
					break;
					
				}
				
?>
							<div id="section-box">
                            
			<div class="t">
				<div class="t">

					<div class="t"></div>
				</div>
			</div>
			<div class="m">
           
				<form action="core_system/login.php" method="post" id="form-login">
	<fieldset class="loginform">

				<label id="mod-login-username-lbl" for="mod-login-username">Nombre Usuario</label>
				<input name="username" id="mod-login-username" type="text" class="inputbox" size="15" maxlength="30" />

				<label id="mod-login-password-lbl" for="mod-login-password">Contrase&ntilde;a</label>
				<input name="passwd" id="mod-login-password" type="password" class="inputbox" size="15"  maxlength="30"/>
				<div class="button-holder">
					<div class="button1">
						<div class="next">
							<a href="#" onclick="document.getElementById('form-login').submit();">
								Acceso</a>
						</div>
				  </div>
				</div>

		<div class="clr"></div>
		<input type="submit" class="hidebtn" value="Acceso" />
		<input type="hidden" name="option" value="com_login" />
		<input type="hidden" name="task" value="login" />
		<input type="hidden" name="return" value="aW5kZXgucGhw" />

		<input type="hidden" name="ab417128e6aebb746771bae293bf0979" value="1" />	</fieldset>
</form>				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>

		</div>
		
					<p>Usar un nombre de usuario y contrase&ntilde;a v&aacute;lido para poder tener acceso al sistema..</p>
					<p><a href="#" onclick="popupWindow('core_system/forgot_password.php', 'recuperar', 540, 190, 1)"> ¿ Perdiste tu contraseña ?</a></p>
                
					<div id="lock"></div>
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">

						<div class="b"></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<div id="border-bottom"><div><div></div></div>
</div>
<div id="footer">
	<p class="copyright">
    <?php	confirm_user_cp_1(); ?>
	</p>

</div>
</body>
</html>