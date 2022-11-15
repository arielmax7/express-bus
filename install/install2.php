<?php


//** INSTALADOR DE EXPRESS BUS *//
//** POR RAZONES DE COPYRIGHT ESTE ARCHIVO NO SERA COMENTARIADO *//
define( "_VALID_MOS", 1 );

require_once( 'common.php' );
require_once( 'database.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname  	= mosGetParam( $_POST, 'DBname', '' );
$DBDel  	= intval( mosGetParam( $_POST, 'DBDel', 0 ) );
$DBBackup  	= intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$DBSample	= intval( mosGetParam( $_POST, 'DBSample', 0 ) );
$DBcreated	= intval( mosGetParam( $_POST, 'DBcreated', 0 ) );
$BUPrefix = 'old_';
$configArray['sitename'] = trim( mosGetParam( $_POST, 'sitename', '' ) );

$database = null;

$DBhostname = $DBhostname;
$DBuserName = $DBuserName;
$DBpassword = $DBpassword;
$DBname  	= $DBname;

$Dump = new Installdb();

$Dump->setConnection($DBuserName,$DBpassword,$DBhostname,$DBname);


if($Dump->dumpDB()==true){
	
 $isErr = false;
	
}else{

  db_err ('stepBack3','Los detalles de la base de datos proporcionados son correctos y / o vacios.');
}

$errors = array();


function db_err($step, $alert) {
	global $DBhostname,$DBuserName,$DBpassword,$DBDel,$DBname;
	echo "<form name=\"$step\" method=\"post\" action=\"install1.php\">
	<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\">
	<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\">
	<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\">
	<input type=\"hidden\" name=\"DBDel\" value=\"$DBDel\">
	<input type=\"hidden\" name=\"DBname\" value=\"$DBname\">
	</form>\n";
	//echo "<script>alert(\"$alert\"); window.history.go(-1);</script>";
	echo "<script>alert(\"$alert\"); document.location.href='install1.php';</script>";  
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Instalar | Express Bus | Empresa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../main_output/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script type="text/javascript">
<!--
function check() {
	// form validation check
	var formValid = true;
	var f = document.form;
	if ( f.sitename.value == '' ) {
		alert('Por favor ingrese el nombre de la empresa');
		f.sitename.focus();
		formValid = false
	}
	return formValid;
}
//-->
</script>
</head>
<body onload="document.form.sitename.focus();">
<div id="wrapper">
	<div id="header">
	  <div id="exp"><img src="header_install.png" alt="Express Bus Installation" /></div>
	</div>
</div>

<div id="ctr" align="center">
	<form action="install3.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
	<input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
	
	<input type="hidden" name="DBcreated" value="<?php echo "$DBcreated"; ?>" />
	<div class="install">
		<div id="stepbar">
		  	<div class="step-off">pre-instalaci&oacute;n</div>
	  		<div class="step-off"><span class="numbers">1</span> &nbsp;&nbsp;licencia</div>
		  	<div class="step-off"><span class="numbers">2</span> &nbsp;&nbsp;Base de Datos</div>
		  	<div class="step-on"><span class="numbers_st">3</span> &nbsp;&nbsp;Empresa</div>
	  		<div class="step-off"><span class="numbers">4</span> &nbsp;&nbsp;Sistema</div>
		  	<div class="step-off"><span class="numbers">5</span> &nbsp;&nbsp;Finalizar</div>
		</div>
		<div id="right">
  			<div class="far-right">
<?php if (!$isErr) { ?>
  		  		<input class="button" type="submit" name="next" value="Siguiente >>"/>
<?php } ?>
  			</div>
	  		<div id="step">Nombre de Empresa</div>
  			<div class="clr"></div>

  			<h1>Ingrese nombre de la enpresa:</h1>
			<div class="install-text">
<?php if ($isErr) { ?>
			Parece que ha habido algunos errores con la inserci&oacute;n de datos en su base de datos! <br />
   Usted no puede continuar.
<?php } else { ?>
			<span class="numbers">BASE DE DATOS CREADO CON EXITO!</span>
			<br/>
  			Escriba el nombre de su Empresa. este
 nombre se utilizara en todo el sistema.
<?php } ?>
  		</div>
  		<div class="install-form">
  			<div class="form-block">
  				<table class="content2">
<?php
			if ($isErr) {
				echo '<tr><td colspan="2">';
				echo '<b></b>';
				echo "<br/><br />Error log:<br />\n";
				
				echo '<textarea rows="10" cols="50">';
				foreach($errors as $error) {
					echo "SQL=$error[0]:\n- - - - - - - - - -\n$error[1]\n= = = = = = = = = =\n\n";
				}
				echo '</textarea>';
				echo "</td></tr>\n";
  			} else {
?>
  				<tr>
  					<td width="100">Empresa</td>
  					<td align="center"><input class="inputbox" type="text" name="sitename" size="50" value="<?php echo "{$configArray['sitename']}"; ?>" /></td>
  				</tr>
  				<tr>
  					<td width="100">&nbsp;</td>
  					<td align="center" class="small">Ej: Expreso Panamericano</td>
  				</tr>
  				</table>
<?php
  			} 
?>
  			</div>
  		</div>
  		<div class="clr"></div>
  		<div id="break"></div>
	</div>
	<div class="clr"></div>
	</form>
</div>
<div class="clr"></div>

<div class="ctr">
	<?php
echo '&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="https://www.arielmax.com/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;';
?>
</div>
</body>
</html>