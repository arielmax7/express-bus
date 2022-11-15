<?php
//** INSTALADOR DE EXPRESS BUS *//
//** POR RAZONES DE COPYRIGHT ESTE ARCHIVO NO SERA COMENTARIADO *//
define( "_VALID_MOS", 1 );
require_once( 'common.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname  	= mosGetParam( $_POST, 'DBname', '' );

$sitename  	= mosGetParam( $_POST, 'sitename', '' );
$adminEmail = mosGetParam( $_POST, 'adminEmail', '');
$filePerms	= mosGetParam( $_POST, 'filePerms', '');
$dirPerms	= mosGetParam( $_POST, 'dirPerms', '');
$configArray['siteUrl'] = trim( mosGetParam( $_POST, 'siteUrl', '' ) );
$configArray['absolutePath'] = trim( mosGetParam( $_POST, 'absolutePath', '' ) );
if (get_magic_quotes_gpc()) {
	$configArray['absolutePath'] = stripslashes(stripslashes($configArray['absolutePath']));
	$sitename = stripslashes(stripslashes($sitename));
}

if ($sitename == '') {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install2.php\">
			<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\">
			<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\">
			<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\">
			<input type=\"hidden\" name=\"DBname\" value=\"$DBname\">
		
			<input type=\"hidden\" name=\"DBcreated\" value=1>
		</form>";

	echo "<script>alert('The sitename has not been provided'); document.stepBack.submit();</script>";
	return;
}

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Instalar | Express Bus | Sistema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../main_output/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script type="text/javascript">
<!--
function check() {
	// form validation check
	var formValid = true;
	var f = document.form;
	if ( f.us_name.value == '' ) {
		alert('Por favor coloque un nombre de usuario');
		f.us_name.focus();
		formValid = false;
	} else if ( f.pass.value == '' ) {
		alert('Por favor coloque una contraseña');
		f.pass.focus(); 
		formValid = false;
	} else if ( f.ab.value == '' ) {
		alert('Por favor repita la contraseña');
		f.ab.focus(); 
		formValid = false;	
	} else if ( f.adminEmail.value == '' ) {
		alert('Por favor ingrese correo electrónico del super administrador');
		f.adminEmail.focus();
		formValid = false;
	} else if ( f.name_us.value == '' ) {
		alert('Por favor ingrese nombre real del super administrador');
		f.name_us.focus();
		formValid = false;
	} else if ( f.ap_us.value == '' ) {
		alert('Por favor ingrese apellido del super administrador');
		f.ap_us.focus();
		formValid = false;
	} else if ( f.address.value == '' ) {
		alert('Por favor ingrese la direcxción del super administrador');
		f.address.focus();
		formValid = false;
	} else if ( f.phone.value == '' ) {
		alert('Por favor ingrese el telefono del super administrador');
		f.phone.focus();
		formValid = false;
	} else if ( f.branch.value == '' ) {
		alert('Por favor ingrese la sucursal del super administrador');
		f.branch.focus();
		formValid = false;
	} else if ( f.id_us.value == '' ) {
		alert('Por favor ingrese la sucursal del super administrador');
		f.id_us.focus();
		formValid = false;
	} else if ( f.money.value == '' ) {
		alert('Por favor ingrese el id del super administrador');
		f.money.focus();
		formValid = false;
	}
	

	return formValid;
}

function changeFilePermsMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('filePermsFlags').style.display = 'none';
				break;
			default:
				document.getElementById('filePermsFlags').style.display = '';
		} // switch
	} // if
}

function changeDirPermsMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('dirPermsFlags').style.display = 'none';
				break;
			default:
				document.getElementById('dirPermsFlags').style.display = '';
		} // switch
	} // if
}
//-->
</script>
</head>
<body onload="document.form.siteUrl.focus();">
<div id="wrapper">
	<div id="header">
		<div id="exp"><img src="header_install.png" alt="Express Buses Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install4.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
	<input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
	
	<input type="hidden" name="sitename" value="<?php echo "$sitename"; ?>" />
	<div class="install">
		<div id="stepbar">
			<div class="step-off">pre-instalaci&oacute;n</div>
			<div class="step-off"><span class="numbers">1</span> &nbsp;&nbsp;licencia</div>
			<div class="step-off"><span class="numbers">2</span> &nbsp;&nbsp;Base de Datos</div>
			<div class="step-off"><span class="numbers">3</span> &nbsp;&nbsp;Enpresa</div>
			<div class="step-on"><span class="numbers_st">4</span> &nbsp;&nbsp;Sistema</div>
			<div class="step-off"><span class="numbers">5</span> &nbsp;&nbsp;Finalizar</div>
		</div>
		<div id="right">
			<div id="step">Sistema</div>
			<div class="far-right">
				<input class="button" type="submit" name="next" value="Siguiente >>"/>
			</div>
			<div class="clr"></div>
			<h1>Llenar datos adicionales del Super administrador / directorio chmods</h1>
			<div class="install-text">
				  <p>Es muy importante llenar esta informaci&oacute;n, este debera ser documentado y guardado para evitar futuros inconvenientes.<br/>
				  <br/>
				  Ingrese su direcci&oacute;n de correo electr&oacute;nico, esta ser&aacute; la direcci&oacute;n de correo electr&oacute;nico del SuperAdministrator del sistema.<br />
				  <br/>
				  La configuraci&oacute;n de permisos se utilizar&aacute; durante la instalaci&oacute;n de Express Bus.</p>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table class="content2">
					<tr>
						<td width="100">Usuario </td>
			<td align="center"><input class="inputbox" type="text" name="us_name" size="40"/></td>
					</tr>
					<tr>
						<td>Contrase&ntilde;a</td>
			<td align="center"><input class="inputbox" type="password" name="pass" size="10"/></td>
					</tr>
					<tr>
						<td>Confirmar Contrase&ntilde;a</td>
						<td align="center"><input class="inputbox" type="password" name="ab" size="10" /></td>
					</tr>
					<tr>
						<td>Email</td>
						<td align="center"><input class="inputbox" type="text" name="adminEmail" size="40" /></td>
					</tr>
                    <tr>
						<td>Nombre</td>
						<td align="center"><input class="inputbox" type="text" name="name_us" size="40" /></td>
					</tr>
                    <tr>
						<td>Apellido</td>
						<td align="center"><input class="inputbox" type="text" name="ap_us" size="40" /></td>
					</tr>
                    <tr>
						<td>direcci&oacute;n</td>
						<td align="center"><input class="inputbox" type="text" name="address" size="40" /></td>
					</tr>
                    <tr>
						<td>Tel&eacute;fono</td>
						<td align="center"><input class="inputbox" type="text" name="phone" size="40" /></td>
					</tr>
                    <tr>
						<td>Sucursal</td>
						<td align="center"><input class="inputbox" type="text" name="branch" size="40" value="Default" readonly="readonly" /></td>
					</tr>
                    <tr>
						<td>DNI</td>
						<td align="center"><input class="inputbox" type="text" name="id_us" size="40" /></td>
					</tr>
                    <tr>
                    <td>
                    Zona Horaria
                    </td>
                    <td>
                    <select name="absolutePath">
                    <option value="America/Caracas">America/Caracas</option>
                    <option value="America/Argentina/Buenos_Aires">America/Buenos_Aires</option>
                    <option value="America/Los_Angeles">America/Los_Angeles</option>
                    <option value="America/Sao_Paulo">America/Sao_Paulo</option>
                    <option value="America/Toronto">America/Toronto</option>
                    <option value="America/Santa_Isabel">America/Santa_Isabel</option>
                    <option value="America/Dominica">America/Dominica</option>
                    <option value="America/Monterrey">America/Monterrey</option>
                    <option value="America/New_York">America/New_York</option>
                    <option value="America/Costa_Rica">America/Costa_Rica</option>
                    <option value="America/La_Paz">America/La_Paz</option>
                    <option value="America/Phoenix">America/Phoenix</option>
                    <option value="America/Santiago">America/Santiago</option>
                    <option value="America/Mexico_City">America/Mexico_City</option>
                    <option value="America/Lima">America/Lima</option>
                    <option value="America/Guatemala">America/Guatemala</option>
                    <option value="America/Bogota">America/Bogota</option>
                    <option value="Europe/Madrid">Europe/Madrid</option>
                    <option value="Europe/Moscow">Europe/Moscow</option>
                    <option value="Europe/Paris">Europe/Paris</option>
                    <option value="Indian/Chagos">Indian/Chagos</option>
                    <option value="Indian/Maldives">Indian/Maldives</option>
                    <option value="Indian/Antananarivo">Indian/Antananarivo</option>
                    <option value="Asia/Singapore">Asia/Singapore</option>
                    <option value="Asia/Taipei">Asia/Taipei</option>
                    <option value="Asia/Tokyo">Asia/Tokyo</option>
                    <option value="Africa/Niamey">Africa/Niamey</option>
                    <option value="Africa/Dakar">Africa/Dakar</option>
                    <option value="Africa/Cairo">Africa/Cairo</option>
                    <option value="Africa/Luanda">Africa/Luanda</option>
                
                    </select>
             </td>
                    </tr>
                    
                    <tr>
                    <td>
                    Moneda $</td>
                    <td align="center">
                    <input class="inputbox" type="text" name="money" size="40" />
                    </td>
                    </tr>
                    
                    <td width="100">URL</td>
<?php
	$url = "";
	if ($configArray['siteUrl'])
		$url = $configArray['siteUrl'];
	else {
		$port = ( $_SERVER['SERVER_PORT'] == 80 ) ? '' : ":".$_SERVER['SERVER_PORT'];
		$root = $_SERVER['SERVER_NAME'].$port.$_SERVER['PHP_SELF'];
		$root = str_replace("install/","",$root);
		$root = str_replace("/install3.php","",$root);
		$url = "http://".$root;
	}
?>						<td align="center"><input class="inputbox" type="text" name="siteUrl" value="<?php echo $url; ?>" size="40" readonly="readonly"/></td>
					</tr>
					<tr>
						<td>Path</td>
<?php
	$abspath = "";
	if ($configArray['absolutePath'])
		$abspath = $configArray['absolutePath'];
	else {
		$path = getcwd();
		if (preg_match("/\/install/i", "$path"))
			$abspath = str_replace('/install',"",$path);
		else
			$abspath = str_replace('\install',"",$path);
	}
?>						<td align="center"><input class="inputbox" type="text" value="<?php echo $abspath; ?>" size="40" readonly="readonly"/></td>
                    
                    
                    
					<tr>
                    
                    
                   
                    
<?php
	$mode = 0;
	$flags = 0644;
	if ($filePerms!='') {
		$mode = 1;
		$flags = octdec($filePerms);
	} 
?>
						
					</tr>
					<tr>
<?php
	$mode = 0;
	$flags = 0755;
	if ($dirPerms!='') {
		$mode = 1;
		$flags = octdec($dirPerms);
	} 
?>
						<td colspan="2">
  							<fieldset><legend>Configuraci&oacute;n avanzada</legend>
								<table cellpadding="1" cellspacing="1" border="0">
									<tr>
										<td><input type="radio" id="dirPermsMode0" name="dirPermsMode" value="0" onclick="changeDirPermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/></td>
										<td><label for="dirPermsMode0">No utilizar CHMOD en directorios (usar valores predeterminados del servidor)</label></td>
									</tr>
									<tr>
										<td><input type="radio" id="dirPermsMode1" name="dirPermsMode" value="1" onclick="changeDirPermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/></td>
										<td><label for="dirPermsMode1"> Utilizar CHMOD:</label></td>
									</tr>
									<tr id="dirPermsFlags"<?php if (!$mode) echo ' style="display:none"'; ?>>
										<td>&nbsp;</td>
										<td>
											<table cellpadding="1" cellspacing="0" border="0">
												<tr>
													<td>Usuario:</td>
													<td><input type="checkbox" id="dirPermsUserRead" name="dirPermsUserRead" value="1"<?php if ($flags & 0400) echo ' checked="checked"'; ?>/></td>
													<td><label for="dirPermsUserRead">Lectura</label></td>
													<td><input type="checkbox" id="dirPermsUserWrite" name="dirPermsUserWrite" value="1"<?php if ($flags & 0200) echo ' checked="checked"'; ?>/></td>
													<td><label for="dirPermsUserWrite">Escritura</label></td>
													<td><input type="checkbox" id="dirPermsUserSearch" name="dirPermsUserSearch" value="1"<?php if ($flags & 0100) echo ' checked="checked"'; ?>/></td>
													<td width="100%"><label for="dirPermsUserSearch">Busqueda</label></td>
												</tr>
												<tr>
													<td>Grupo:</td>
													<td><input type="checkbox" id="dirPermsGroupRead" name="dirPermsGroupRead" value="1"<?php if ($flags & 040) echo ' checked="checked"'; ?>/></td>
													<td><label for="dirPermsGroupRead">Lectura</label></td>
													<td><input type="checkbox" id="dirPermsGroupWrite" name="dirPermsGroupWrite" value="1"<?php if ($flags & 020) echo ' checked="checked"'; ?>/></td>
													<td><label for="dirPermsGroupWrite">Escritura</label></td>
													<td><input type="checkbox" id="dirPermsGroupSearch" name="dirPermsGroupSearch" value="1"<?php if ($flags & 010) echo ' checked="checked"'; ?>/></td>
													<td width="100%"><label for="dirPermsGroupSearch">Busqueda</label></td>
												</tr>
												<tr>
													<td>Global:</td>
													<td><input type="checkbox" id="dirPermsWorldRead" name="dirPermsWorldRead" value="1"<?php if ($flags & 04) echo ' checked="checked"'; ?>/></td>
													<td><label for="dirPermsWorldRead">Lectura</label></td>
													<td><input type="checkbox" id="dirPermsWorldWrite" name="dirPermsWorldWrite" value="1"<?php if ($flags & 02) echo ' checked="checked"'; ?>/></td>
													<td><label for="dirPermsWorldWrite">Escritura</label></td>
													<td><input type="checkbox" id="dirPermsWorldSearch" name="dirPermsWorldSearch" value="1"<?php if ($flags & 01) echo ' checked="checked"'; ?>/></td>
													<td width="100%"><label for="dirPermsWorldSearch">Busqueda</label></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
					</table>
				</div>
			</div>
			<div id="break"></div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<?php
echo '&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="http://www.arielmax.com.ar/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;';
?>
</div>
</body>
</html>