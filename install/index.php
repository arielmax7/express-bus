<?php
//** INSTALADOR DE EXPRESS BUS *//
//** POR RAZONES DE COPYRIGHT ESTE ARCHIVO NO SERA COMENTADO *//
define( '_VALID_MOS', 1 );

if (file_exists( '../includes/db_system.php' ) && filesize( '../includes/db_system.php' ) > 10) {
	header( "Location: ../index.php" );
	exit();
}
require( '../globals.php' );
require_once( '../includes/version.php' );
include_once( 'common.php' );
view();

function view() {	
	$sp 		= ini_get( 'session.save_path' );
	
	$_VERSION 		= new express_bus_Version();				 	
	$versioninfo 	= $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '. $_VERSION->DEV_STATUS;
	$version 		= $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '. $_VERSION->DEV_STATUS.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
	
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Instalar | Express Bus</title>
	
	<link rel="shortcut icon" href="../main_output/favicon.ico" />
	<link rel="stylesheet" href="install.css" type="text/css" />
	</head>
	<body>
	
	<div id="wrapper">
		<div id="header">
			<div id="exp">
				<img src="header_install.png" alt="Express Bus Installation" />
			</div>
		</div>
	</div>
	
	<div id="ctr" align="center">
		<div class="install">
			<div id="stepbar">
				<div class="step-on">pre-instalaci&oacute;n</div>
				<div class="step-off"><span class="numbers">1</span> &nbsp;&nbsp;licencia</div>
				<div class="step-off"><span class="numbers">2</span> &nbsp;&nbsp;Base de Datos</div>
				<div class="step-off"><span class="numbers">3</span> &nbsp;&nbsp;Empresa</div>
				<div class="step-off"><span class="numbers">4</span> &nbsp;&nbsp;Sistema</div>
				<div class="step-off"><span class="numbers">5</span> &nbsp;&nbsp;Finalizar</div>
			</div>
	
			<div id="right">
				<div id="step">comprobar pre-instalaci&oacute;n</div>
	
				<div class="far-right">
					<input name="Button2" type="submit" class="button" value="Siguiente >>" onclick="window.location='install.php';" />
					<br/>
					<br/>
					<input type="button" class="button" value="comprobar" onclick="window.location=window.location" />
				</div>
				<div class="clr"></div>				
					
				<h1 style="text-align: center; border-bottom: 0px;">
					<?php echo $version; ?>
				</h1>
	
				<h1>
					Requerimientos Necesarios:
				</h1>
				
				<div class="install-text">
					<p>
					Si cualquiera de estos elementos aparece resaltado en rojo, debe tomar medidas oportunas para corregirlo.
  
					</p>
					<p>
						El no hacerlo podr&iacute;a conducir a Express Bus a que no funciona correctamente.
					</p>
					<div class="ctr"></div>
				</div>
	
				<div class="install-form">
					<div class="form-block">
						<table class="content">
						<tr>
							<td class="item">
								PHP version >= 5.6
							</td>
							<td align="left">
								<?php echo phpversion() < '5.6' ? '<b><font color="red">No</font></b>' : '<b><font color="green">Si</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - compresi&oacute;n zlib
							</td>
							<td align="left">
								<?php echo extension_loaded('zlib') ? '<b><font color="green">Disponible</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - Soporte XML
							</td>
							<td align="left">
								<?php echo extension_loaded('xml') ? '<b><font color="green">Disponible</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - Soporte MySQL
							</td>
							<td align="left">
								<?php echo function_exists( 'mysqli_connect' ) ? '<b><font color="green">Disponible</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td valign="top" class="item">
								db_system.php
							</td>
							<td align="left">
								<?php
								if (@file_exists('../includes/db_system.php') &&  @is_writable( '../includes/db_system.php' )){
									echo '<b><font color="green">Escribible</font></b>';
								} else if (is_writable( '..' )) {
									echo '<b><font color="green">Escribible</font></b>';
								} else {
									echo '<b><font color="red">No Grabable</font></b><br /><span class="small">Usted puede seguir la instalacin como la configuracin se mostrar al final, slo tienes que copiar y pegar este y cargar.</span>';
								} 
								?>
							</td>
						</tr>
						
						</table>
					</div>
				</div>
				<div class="clr"></div>
				
				<h1>
					Compruebe la versi&oacute;n:
				</h1>
				
				<div class="install-text">
					<p>
						Es importante instalar siempre la &uacute;ltima versi&oacute;n estable de Express Bus

 
					</p>
					<p>
						M&aacute;s informaci&oacute;n siempre se puede encontrar en <a href="https://www.arielmax.com" target="_blank">www.arielmax.com</a>						
					</p>
					<div class="ctr"></div>
				</div>
						
				<div class="install-form">
					<div class="form-block" style="text-align: center;">
						<table class="content">
						<tr>
							<td class="item">
								<?php
								$link 			= 'https://www.arielmax.com/express-bus-tickets-v2/';
								$status 		= 'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,resizable=yes,directories=yes,location=yes';
								
								$release 		= strtotime($_VERSION->RELDATE);
								$now	 		= strtotime('now');
								$age			= ($now - $release) / 86400;	
								$age			= round($age);		
								?>
								<div style="clear: both; margin: 3px; padding: 0px 0px; display: block; float: left;">
									<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminheading">
									<tr>
										<td colspan="2" style="text-align: center;">
											<h3 style="font-size: 12px;">
												<?php
												if ($age > 1) {							
													?>
													<p style="font-weight: normal; padding: 0px; margin: 0px; font-size: 11px;">
														Versi&oacute;n de Express Bus [ <?php echo $versioninfo; ?> ] 
													</p>
													
													<?php
												}
												?>
												<div style="margin-top: 10px;">
													<input name="Button3" type="submit" value="Comprobar si hay nuevas versiones" onclick="window.open('<?php echo $link; ?>','win2','<?php echo $status; ?>'); return false;" />							
												</div>
											</h3>
										</td>
									</tr>
								    </table>
								</div>
							</td>
						</tr>
						</table>
					</div>
				</div>	
				<div class="clr"></div>		
				
				<?php
				$wrongSettingsTexts = array();
				
				if ( ini_get('magic_quotes_gpc') != '1' ) {
					$wrongSettingsTexts[] = 'Configuraci&oacute;n magic_quotes_gpc es `OFF` en lugar de `ON`';
				}
				if ( ini_get('register_globals') == '1' ) {
					$wrongSettingsTexts[] = 'Configuraci&oacute;n register_globals es `ON` en vez de `OFF`';
				}
				if ( RG_EMULATION != 0 ) {
					$wrongSettingsTexts[] = 'Express Bus RG_EMULATION es `ON` en lugar de `OFF` en globals.php <br /><span style="font-weight: normal; font-style: italic; color: #666;">`ON` by default for compatibility reasons</span>';
				}	
	
				if ( count($wrongSettingsTexts) ) {
					?>							
					<h1>
						Revisi&oacute;n de Seguridad:
					</h1>
					
					<div class="install-text">
						<p>
							Despu&eacute;s de Configuraci&oacute;n del servidor PHP si no son &oacute;ptimos para la <strong>Seguridad</strong> se recomienda cambiarlos:
						</p>
						
						<div class="ctr"></div>
					</div>
							
					<div class="install-form">
						<div class="form-block" style=" border: 1px solid #cc0000; background: #ffffcc;">
							<table class="content">
							<tr>
								<td class="item">
									<ul style="margin: 0px; padding: 0px; padding-left: 5px; text-align: left; padding-bottom: 0px; list-style: none;">
										<?php
										foreach ($wrongSettingsTexts as $txt) {
											?>	
											<li style="min-height: 25px; padding-bottom: 5px; padding-left: 25px; color: red; font-weight: bold; background-image: url(../includes/js/ThemeOffice/warning.png); background-repeat: no-repeat; background-position: 0px 2px;" >
												<?php
												echo $txt;
												?>
											</li>
											<?php
										}
										?>
									</ul>
								</td>
							</tr>
							</table>
						</div>
					</div>
					<div class="clr"></div>
					<?php
				}
				?>
												
				<h1>
					Configuraci&oacute;n recomendada:
				</h1>
				
				<div class="install-text">
					<p>
						Estos ajustes se recomienda para PHP con el fin de garantizar la plena
 compatibilidad con Express Bus.
					</p>					
					<p>
						Sin embargo, Express Bus seguir&aacute; funcionando si su configuraci&oacute;n no concuerdan exactamente con las recomendadas
					</p>
					<div class="ctr"></div>
				</div>
		
				<div class="install-form">
					<div class="form-block">
		
						<table class="content">
						<tr>
							<td class="toggle" width="500px">
								Directiva
							</td>
							<td class="toggle">
								Recomendado
							</td>
							<td class="toggle">
								Actual
							</td>
						</tr>
						<?php
						$php_recommended_settings = array(array ('Safe Mode','safe_mode','OFF'),
							array ('Display Errors','display_errors','ON'),
							array ('File Uploads','file_uploads','ON'),
							array ('Magic Quotes GPC','magic_quotes_gpc','ON'),
							array ('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
							array ('Register Globals','register_globals','OFF'),
							array ('Output Buffering','output_buffering','OFF'),
							array ('Session auto start','session.auto_start','OFF'),
						);
						
						foreach ($php_recommended_settings as $phprec) {
							?>
							<tr>
								<td class="item">
									<?php echo $phprec[0]; ?>:
								</td>
								<td class="toggle">
									<?php echo $phprec[2]; ?>:
								</td>
								<td>
									<b>
										<?php
										if ( get_php_setting($phprec[1]) == $phprec[2] ) {
											?>
											<font color="green">
											<?php
										} else {
											?>
											<font color="red">
											<?php
										}
										echo get_php_setting($phprec[1]);
										?>
										</font>
									</b>
								<td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td class="item">
								Register Globals Emulation:
							</td>
							<td class="toggle">
								OFF:
							</td>
							<td>
								<?php
								if ( RG_EMULATION ) {
									?>
									<font color="red"><b>
									<?php
								} else {
									?>
									<font color="green"><b>
									<?php
								}
								echo ((RG_EMULATION) ? 'ON' : 'OFF');
								?>
								</b>
								</font>
							<td>
						</tr>
						</table>
					</div>
				</div>
				<div class="clr"></div>
		
				<h1>
					Permisos de directorio y archivo de comprobaci&oacute;n:
				</h1>
				
				<div class="install-text">
					<p>
						Para que Express Bus funcione correctamente debe ser capaz de acceder o escribir en ciertos archivos o directorios. 
					</p>
					<p>
						Si aparece "No escribible" es necesario cambiar los permisos en el archivo o carpeta para permitir que Express Bus pueda escribir en &eacute;l.
					</p>
					<div class="clr">&nbsp;&nbsp;</div>
					<div class="ctr"></div>
				</div>
		
				<div class="install-form">
					<div class="form-block">	
						<table class="content">
						<?php
						writableCell( 'install' );
						writableCell( 'install/sql' );
						writableCell( 'core_system' );
						writableCell( 'includes' );
						writableCell( 'main_output/gen_libs' );
						writableCell( 'main_output/images_buses' );
						writableCell( 'main_output/jquery_libraries' );
						writableCell( 'main_output/js_mudules' );
						writableCell( 'main_output/templates' );
						writableCell( 'main_output/templates_prints' );
						writableCell( 'main_output/dict' );
						writableCell( 'main_output/room' );
						writableCell( 'main_output/uploads' );
						?>
						</table>
					</div>
					<div class="clr"></div>
				</div>
	
				
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	
	<div class="ctr">
    <?php
echo '		&#69;&#120;&#112;&#114;&#101;&#115;&#115;&#32;&#66;&#117;&#115; &#84;&#105;&#99;&#107;&#101;&#116;&#115;&#32;&#169;&#32;&#101;&#115;&#32;&#115;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#108;&#105;&#98;&#114;&#101;&#32;&#100;&#105;&#115;&#116;&#114;&#105;&#98;&#117;&#105;&#100;&#111;&#32;&#98;&#97;&#106;&#111;&#32;&#108;&#105;&#99;&#101;&#110;&#99;&#105;&#97;&#32;&#71;&#78;&#85;&#47;&#71;&#80;&#76;&#46;<br /><a href="https://www.arielmax.com/"> 
&#83;&#111;&#102;&#116;&#119;&#97;&#114;&#101;&#32;&#99;&#114;&#101;&#97;&#100;&#111;&#32;&#112;&#111;&#114;&#32;&#65;&#114;&#105;&#101;&#108;&#32;&#77;&#97;&#120;&#32;&#45;&#32;&#50;&#48;&#49;&#50;';
?>
	</div>
	
	</body>
	</html>
	<?php
}

function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? 'ON' : 'OFF';
}

function writableCell( $folder, $relative=1, $text='' ) {
	$writeable 		= '<b><font color="green">Escribible</font></b>';
	$unwriteable 	= '<b><font color="red">No escribible</font></b>';
	
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="right">';
	if ( $relative ) {
		echo is_writable( "../$folder" ) 	? $writeable : $unwriteable;
	} else {
		echo is_writable( "$folder" ) 		? $writeable : $unwriteable;
	}
	echo '</tr>';
}
?>