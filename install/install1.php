<?php
//** INSTALADOR DE EXPRESS BUS *//
//** POR RAZONES DE COPYRIGHT ESTE ARCHIVO NO SERA COMENTARIADO *//
define( "_VALID_MOS", 1 );
require_once( 'common.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname  	= mosGetParam( $_POST, 'DBname', '' );
$DBDel  	= intval( mosGetParam( $_POST, 'DBDel', 0 ) );
$DBBackup  	= intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$DBSample  	= intval( mosGetParam( $_POST, 'DBSample', 1 ) );

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Instalar | Express Bus | Base de Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../main_output/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script  type="text/javascript">
<!--
function check() {
	// form validation check
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) {
		alert('Por favor, introduzca el nombre del host');
		f.DBhostname.focus();
		formValid=false;
	} else if ( f.DBuserName.value == '' ) {
		alert('Por favor, introduzca el nombre de usuario de la base de datos');
		f.DBuserName.focus();
		formValid=false;
	} else if ( f.DBname.value == '' ) {
		alert('Por favor, introduzca un nombre para su nueva base de datos');
		f.DBname.focus();
		formValid=false;
	} else if ( f.DBPrefix.value == '' ) {
		alert('Debe introducir un prefijo de la tabla MySQL para que Express Bus funcione correctamente.');
		f.DBPrefix.focus();
		formValid=false;
	} else if ( f.DBPrefix.value == 'old_' ) {
		alert('No se puede utilizar "old_" como el prefijo de la tabla MySQL, porque Express Bus utiliza este prefijo para las tablas de copia de seguridad.');
		f.DBPrefix.focus();
		formValid=false;
	} else if ( confirm('¿Estas seguro que esta configuracion es correcta? | Express Bus ahora tratara de rellenar una base de datos con los ajustes que ha suministrado')) {
		formValid=true;
	}

	return formValid;
}
//-->
</script>
</head>
<body onload="document.form.DBhostname.focus();">
<div id="wrapper">
	<div id="header">
		<div id="exp"><img src="header_install.png" alt="Joomla Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
	<div class="install">
		<div id="stepbar">
			<div class="step-off">
				pre-instalaci&oacute;n
			</div>
			<div class="step-off">
				<span class="numbers">1</span> &nbsp;&nbsp;licencia
			</div>
			<div class="step-on">
				<span class="numbers_st">2</span> &nbsp;&nbsp;Base de Datos
			</div>
			<div class="step-off">
				<span class="numbers">3</span> &nbsp;&nbsp;Empresa
			</div>
			<div class="step-off">
				<span class="numbers">4</span> &nbsp;&nbsp;Sistema
			</div>
			<div class="step-off">
				<span class="numbers">5</span> &nbsp;&nbsp;Finalizar
			</div>
		</div>
		<div id="right">
			<div class="far-right">
				<input class="button" type="submit" name="next" value="Siguiente >>"/>
  			</div>
	  		<div id="step">
	  			Base de Datos
	  		</div>
  			<div class="clr"></div>
  			<h1>Configuraci&oacute;n de MySQL Base de Datos:</h1>
	  		<div class="install-text">
  				<p>Configuraci&oacute;n de Express Bus a ejecutar en el servidor consiste en 4 sencillos pasos ...</p>
  				<p>Por favor, introduzca el nombre del servidor de Express bus se va a instalar en.</p>
				<p>Escriba el nombre de usuario de MySQL, contrase&ntilde;a y nombre de la base de datos que desea usar con Express Bus.</p>
				
				
		  </div>
			<div class="install-form">
  				<div class="form-block">
  		 			<table class="content2">
  		  			<tr>
  						<td></td>
  						<td></td>
  						<td></td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							Nombre del Host
  							<br/>
  							<input class="inputbox" type="text" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
  						</td>
			  			<td>
			  				<em>Esto es por lo general "localhost"</em>
			  			</td>
  					</tr>
					<tr>
			  			<td colspan="2">
			  				Nombre de usuario MySQL
			  				<br/>
			  				<input class="inputbox" type="text" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
			  			</td>
			  			<td>
			  				<em>algo como "root" o un nombre de usuario dado por el host</em>
			  			</td>
  					</tr>
			  		<tr>
			  			<td colspan="2">
			  				MySQL Contrase&ntilde;a
			  				<br/>
			  				<input class="inputbox" type="password" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
			  			</td>
			  			<td>
			  				<em>Para la seguridad del sitio es obligatorio el uso de una contrase&ntilde;a para la cuenta de mysql.</em>
			  			</td>
					</tr>
  		  			<tr>
  						<td colspan="2">
  							Nombre de base de datos MySQL
  							<br/>
  							<input class="inputbox" type="text" name="DBname" value="<?php echo "$DBname"; ?>" />
  						</td>
			  			<td>
			  				<em>Algunos hosts permiten s&oacute;lo un determinado nombre de DB para el sitio. .</em>
			  			</td>
  					</tr>
  		  			
		  		 	</table>
  				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<?php
echo '		&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="http://www.arielmax.com.ar/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;';
?>
</div>
</body>
</html>