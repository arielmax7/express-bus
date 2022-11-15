<?php
//** INSTALADOR DE EXPRESS BUS *//
//** POR RAZONES DE COPYRIGHT ESTE ARCHIVO NO SERA COMENTARIADO *//
define( "_VALID_MOS", 1 );

if (file_exists( '../includes/db_system.php' ) && filesize( '../includes/db_system.php' ) > 100) {
	header( 'Location: ../index.php' );
	exit();
}

include_once( 'common.php' );
function writableCell( $folder ) {
	echo "<tr>";
	echo "<td class=\"item\">" . $folder . "/</td>";
	echo "<td align=\"left\">";
	echo is_writable( "../$folder" ) ? '<b><font color="green">Escribible</font></b>' : '<b><font color="red">No Escribible</font></b>' . "</td>";
	echo "</tr>";
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Instalar | Express Bus | Licencia</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../main_output/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="exp"><img src="header_install.png" alt="Joomla Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install1.php" method="post" name="adminForm" id="adminForm">
	<div class="install">
	<div id="stepbar">
		<div class="step-off">pre-instalaci&oacute;n</div>
		<div class="step-on"><span class="numbers_st">1</span> &nbsp;&nbsp;licencia</div>
		<div class="step-off"><span class="numbers">2</span> &nbsp;&nbsp;Base de Datos</div>
		<div class="step-off"><span class="numbers">3</span> &nbsp;&nbsp;Empresa</div>
		<div class="step-off"><span class="numbers">4</span> &nbsp;&nbsp;Sistema</div>
		<div class="step-off"><span class="numbers">5</span> &nbsp;&nbsp;Finalizar</div>
	</div>
	<div id="right">
		<div id="step">licencia</div>
		<div class="far-right">
		<input class="button" type="submit" name="next" value="Siguiente &gt;&gt;"/>
		</div>
		<div class="clr"></div>
		<h1>GNU/GPL License:</h1>
		<div class="licensetext">
				<a href="http://www.arielmax.com.ar">Express Bus </a> es Software libre bajo la licencia GNU/GPL.
		</div>
		<div class="clr"></div>
		<div class="license-form">
			<div class="form-block" style="padding: 0px;">
				<iframe src="gpl.html" class="license" frameborder="0" scrolling="auto"></iframe>
			</div>
		</div>
		<div class="clr"></div>
		<div class="clr"></div>
		</div>
		<div id="break"></div>
	<div class="clr"></div>
	<div class="clr"></div>
	</div>
	</form>
</div>
<div class="ctr">
	<?php
echo '&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="http://www.arielmax.com.ar/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;';
?>
</div>
</body>
</html>