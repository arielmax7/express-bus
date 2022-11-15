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
$siteUrl  	= mosGetParam( $_POST, 'us_name', '' );
$absolutePath = mosGetParam( $_POST, 'absolutePath', '' );
$adminPassword = mosGetParam( $_POST, 'adminPassword', '');


$filePerms = '';
if (mosGetParam($_POST,'filePermsMode',0))
	$filePerms = '0'.
		(mosGetParam($_POST,'filePermsUserRead',0) * 4 +
		 mosGetParam($_POST,'filePermsUserWrite',0) * 2 +
		 mosGetParam($_POST,'filePermsUserExecute',0)).
		(mosGetParam($_POST,'filePermsGroupRead',0) * 4 +
		 mosGetParam($_POST,'filePermsGroupWrite',0) * 2 +
		 mosGetParam($_POST,'filePermsGroupExecute',0)).
		(mosGetParam($_POST,'filePermsWorldRead',0) * 4 +
		 mosGetParam($_POST,'filePermsWorldWrite',0) * 2 +
		 mosGetParam($_POST,'filePermsWorldExecute',0));

$dirPerms = '';
if (mosGetParam($_POST,'dirPermsMode',0))
	$dirPerms = '0'.
		(mosGetParam($_POST,'dirPermsUserRead',0) * 4 +
		 mosGetParam($_POST,'dirPermsUserWrite',0) * 2 +
		 mosGetParam($_POST,'dirPermsUserSearch',0)).
		(mosGetParam($_POST,'dirPermsGroupRead',0) * 4 +
		 mosGetParam($_POST,'dirPermsGroupWrite',0) * 2 +
		 mosGetParam($_POST,'dirPermsGroupSearch',0)).
		(mosGetParam($_POST,'dirPermsWorldRead',0) * 4 +
		 mosGetParam($_POST,'dirPermsWorldWrite',0) * 2 +
		 mosGetParam($_POST,'dirPermsWorldSearch',0));

if ((trim($adminEmail== "")) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $adminEmail )==false)) {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";
	echo "<script>alert('Debe proporcionar una dirección válida de correo electronico super admin.'); document.stepBack.submit(); </script>";
	return;
}

if ($_POST["pass"]==$_POST["ab"]) {
	echo ''; //comodin
}
else{
	
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";
	echo "<script charset='utf-8'>alert('Los campos contraseña no son iguales intentelo de nuevo.'); document.stepBack.submit(); </script>";
	return;
	
	
	
}


if($DBhostname && $DBuserName && $DBname) {
	$configArray['DBhostname']	= $DBhostname;
	$configArray['DBuserName']	= $DBuserName;
	$configArray['DBpassword']	= $DBpassword;
	$configArray['DBname']	 	= $DBname;
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('Los detalles de la base de datos proporcionados son incorrectos y / o vacíos'); document.stepBack.submit(); </script>";
	return;
}

if ($sitename) {
	if (!get_magic_quotes_gpc()) {
		$configArray['sitename'] = addslashes($sitename);
	} else {
		$configArray['sitename'] = $sitename;
	}
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('El nombre de la empresa es incorrecto'); document.stepBack2.submit();</script>";
	return;
}

if (file_exists( '../includes/db_system.php' )) {
	$canWrite = is_writable( '../includes/db_system.php' );
} else {
	$canWrite = is_writable( '..' );
}

if ($siteUrl) {
	$configArray['siteUrl']=$siteUrl;
	$absolutePath= str_replace("\\\\","/", $absolutePath);
	$configArray['absolutePath']=$absolutePath;
	$configArray['filePerms']=$filePerms;
	$configArray['dirPerms']=$dirPerms;
	$config = "<?php\n";
	$config .= "//*******FUNCION PRINCIPAL PARA LA CONEXION A LA BASE DE DATOS MySQL*********//";
	$config .= "\n";
	$config .= "function db_connect()\n{ \n";
	$config .= "// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** // \n";
	$config .= "global \$DB_HOST; \n";
	$config .= "global \$DB_USER; \n";
	$config .= "global \$DB_PASSWORD; \n";
	$config .= "global \$DB_NAME; \n";
	$config .= "/** Host de MySQL (es muy probable que no necesites cambiarlo) */ \n";
	$config .= "\$DB_HOST = '{$configArray['DBhostname']}';\n";
	$config .= "/** Tu nombre de usuario de MySQL */ \n";
	$config .= "\$DB_USER = '{$configArray['DBuserName']}';\n";
	$config .= "/** Tu password de MySQL */ \n";
	$config .= "\$DB_PASSWORD = '{$configArray['DBpassword']}';\n";
	$config .="/** El nombre de tu base de datos */ \n";
	$config .= "\$DB_NAME = '{$configArray['DBname']}';\n";
	$config .= "//Fin de la configuracion de la base de datos apartir de qui no modifiques nada podrias afectar el funcionamiento del sistema */ \n";
	$config .= "\$mysqli = @new mysqli(\$DB_HOST, \$DB_USER, \$DB_PASSWORD, \$DB_NAME); \n if (mysqli_connect_errno()) {
    printf(error_db_connect());
    exit();
    }
    return \$mysqli;\n}";
	$config .= "\n";
	$config .= "//****** COFIGURACION De ZONA HORARIA **//";
	$config .= "\n";
	$config .= "\$zone = '{$configArray['absolutePath']}';\n";
	$config .= "\n?>";

	if ($canWrite && ($fp = fopen("../includes/db_system.php", "w"))) {
		fputs( $fp, $config, strlen( $config ) );
		fclose( $fp );
	} else {
		$canWrite = false;
	} 
	
	////////////////////
	
	$mysqli = @new mysqli($DBhostname, $DBuserName, $DBpassword, $DBname); 
	
	if (mysqli_connect_errno()) {
		printf(error_db_connect());
		exit();
	}

	$us_name=$_POST["us_name"];
	$name_us=$_POST["name_us"];
	$ap_us=$_POST["ap_us"];
	$address=$_POST["address"];
	$phone=$_POST["phone"];
	$pass=$_POST["pass"];
	$id_us=$_POST["id_us"];
	$money=$_POST["money"];
	
	$registered= date('Y-m-d');
	$query = "INSERT INTO users VALUES('$us_name', '$name_us', '$ap_us', 'null', '$address', '$phone', '$adminEmail', '1', MD5('$pass'), '$id_us', 'sa', '$registered', '0')";
	$mysqli->query($query);
	
	
	$query = "INSERT INTO paging_settings VALUES ('$us_name',10,'$registered','$registered','1')";
	$mysqli->query($query);
	
	
	$query = "INSERT INTO global_config VALUES ('$sitename','$registered','no','El sistema esta desactivado por razones de mantenimiento','$money','1','2.0.1 Beta')";
	$mysqli->query($query);
	
	
	$chmod_report = "Permisos de directorios y archivos sin cambios.";
	if ($filePerms != '' || $dirPerms != '') {
		$mosrootfiles = array(
			'includes',
		);
		$filemode = NULL;
		if ($filePerms != '') $filemode = octdec($filePerms);
		$dirmode = NULL;
		if ($dirPerms != '') $dirmode = octdec($dirPerms);
		$chmodOk = TRUE;
		foreach ($mosrootfiles as $file) {
			if (!mosChmodRecursive($absolutePath.'/'.$file, $filemode, $dirmode)) {
				$chmodOk = FALSE;
			}
		}
		if ($chmodOk) {
			$chmod_report = 'Permisos de archivos y directorios cambiado correctamente.';
		} else {
			$chmod_report = 'Los permisos de archivos y el directorio no se puede cambiar.<br />'.
							'Por favor, configure CHMOD archivos de Express Bus y directorios de forma manual.';
		}
	} 
} else {
?>
	<form action="install3.php" method="post" name="stepBack3" id="stepBack3">
	  <input type="hidden" name="DBhostname" value="<?php echo $DBhostname;?>" />
	  <input type="hidden" name="DBusername" value="<?php echo $DBuserName;?>" />
	  <input type="hidden" name="DBpassword" value="<?php echo $DBpassword;?>" />
	  <input type="hidden" name="DBname" value="<?php echo $DBname;?>" />
	  
	  <input type="hidden" name="DBcreated" value="1" />
	  <input type="hidden" name="sitename" value="<?php echo $sitename;?>" />
	  <input type="hidden" name="adminEmail" value="$adminEmail" />
	  <input type="hidden" name="siteUrl" value="$siteUrl" />
	  <input type="hidden" name="absolutePath" value="$absolutePath" />
	  <input type="hidden" name="filePerms" value="$filePerms" />
	  <input type="hidden" name="dirPerms" value="$dirPerms" />
	</form>
	<script>alert('The site url has not been provided'); document.stepBack3.submit();</script>
<?php
}
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Instalar | Express Bus Tickets | Felicitaciones Express Bus Tikets fue Instalado con exito !</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../main_output/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />



</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="joomla"><img src="header_install.png" alt="Joomla Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="dummy" name="form" id="form">
	<div class="install">
		<div id="stepbar">
			<div class="step-off">pre-instalaci&oacute;n</div>
			<div class="step-off"><span class="numbers">1</span> &nbsp;&nbsp;licencia</div>
			<div class="step-off"><span class="numbers">2</span> &nbsp;&nbsp;Base de Datos</div>
			<div class="step-off"><span class="numbers">3</span> &nbsp;&nbsp;Enpresa</div>
			<div class="step-off"><span class="numbers">4</span> &nbsp;&nbsp;Sistema</div>
			<div class="step-on"><span class="numbers_st">5</span> &nbsp;&nbsp;Finalizar</div>
		</div>
		<div id="right">
			<div id="step">Finalizar</div>
			<div class="far-right">
				<input class="button" type="button" name="runSite" value="Acceder al sistema"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='../index.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/index.php' \"";
				}
?>/>
				<input class="button" type="button" name="Admin" value="Tutorial"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/../../help/manual.html' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."../../help/manual.html' \"";
				}
?>/>
			</div>
			<div class="clr"></div>
			<h1>¡Felicitaciones! Express Bus Tickets se ha instalado con exito</h1>
			<div class="install-text">
				<p>Haga clic en "Acceder al sistema" para ingresar a Express Bus o "Tutorial"
 para conocer paso a paso el funcionamiento del programa ideal para novatos.</p>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table width="100%">
						<tr><td class="error" align="center">POR SEGURIDAD SE RECOMIENDA<br/>ELIMINAR El DIRECTORIO INSTALL<br />
                       
                  
                        <div id="resultado" class="res"></div>
                        </td></tr>
						<tr><td align="center"><h4>Detalles Del Super Administrador</h4></td></tr>
						<tr><td align="center" class="notice"><b>Nombre usuario : <?php echo $us_name; ?></b></td></tr>
						<tr><td align="center" class="notice"><b>Contrase&ntilde;a que elegiste</b></td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td align="right">&nbsp;</td></tr>
<?php						if (!$canWrite) { ?>
						<tr>
							<td class="small">
								Su archivo de configuraci&oacute;n o el directorio no se puede escribir, 
o hubo un problema al crear el archivo de configuración. Vas a tener que 
subir el siguiente c&oacute;digo a mano. Haga clic en la caja de texto para poner de relieve 
todo el c&oacute;digo.
							</td>
						</tr>
						<tr>
							<td align="center">
								<textarea rows="5" cols="60" name="configcode" onClick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo htmlspecialchars( $config );?></textarea>
							</td>
						</tr>
<?php						} ?>
						<tr><td class="small"><?php /*echo $chmod_report*/; ?></td></tr>
					</table>
				</div>
			</div>
			<div id="break"></div>
		</div>
		<div class="clr">
       
        </div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<?php
echo '&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="https://www.arielmax.com/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;';
?>
</div>
</html>