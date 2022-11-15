<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/fourth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexiona a la BD
$con=db_connect();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Ver mensaje |  <?php default_title(); ?></title>
  <?php //llamamos a las funciones principales *// ?>
  <?php recover_info_user($con, $valid_user); ?>
  <?php open_message_for_user($con, $_GET["msg"]); ?>
  <?php open_message($con, $_GET["msg"]); ?>
  <link rel="shortcut icon" href="favicon.ico">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>


<link rel="stylesheet" href="index.php_files/system.css" type="text/css">
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
				<span class="logo"><a href="http://www.arielmax.com.ar/" target="_blank"><img src="templates/images/logo.png" alt="Express Bus"></a></span>
				<span class="title"><a href="index.php"><?php company_name($con); ?></a></span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-menu">
			<ul id="menu">
            
<?php require_once('../core_system/top_menu_view.php')?>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
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
<ul>
<li class="button" id="toolbar-restore">
<a href="#" onclick="javascript:express.submitbutton('message.reply')" class="toolbar">
<span class="icon-32-restore">
</span>
Responder
</a>
</li>

<li class="button" id="toolbar-cancel">
<a href="mails.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>



</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-inbox">
					  <h2>Mensajería privada: Ver Mensaje</h2></div>
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
				<form action="send_message.php" method="post" name="adminForm" id="adminForm">
	<div class="width-60 fltlft">
		<ul class="adminformlist">
		<li><font color="#146295"><b>De:</b>&nbsp;&nbsp;</font><?php echo $from1; ?>		</li>
        <li><font color="#146295"><b>Terminal:</b>&nbsp;&nbsp;</font><?php echo $loc; ?></li>

		<li><font color="#146295"><b>Enviado el:</b>&nbsp;&nbsp;</font><?php echo $date_send; ?></li>

		<li><font color="#146295"><b>Asunto:</b>&nbsp;&nbsp;</font><?php echo $subject; ?></li>

		<li><font color="#146295"><b>Mensaje:</b></font><br /><br /><font size="+1"><?php echo $message; ?>
        <?php 
		
		if($file=="si"){ //significa que es un archivo para descargar
		echo '<br><br><table border="0"><tr><td>';	
			
		$sz=$file_size/1024;
		
		echo '<a href='.$url_file.'>Descargar</a>&nbsp;&nbsp;Tama&ntilde;o: '.number_format($sz,2).'kb.&nbsp;&nbsp;<a href='.$url_file.'><img src="templates/images/arrow_down.gif" border="0" align="middle"></a>';
			
		echo '</td></tr></table>';	
			
		}
        
		?>
        </font></li>
		</ul>
		<input name="task" value="" type="hidden">
        <input name="from1" value="<?php echo $from1; ?>" type="hidden" />
		<input name="reply_id" value="<?php echo $from; ?>" type="hidden">
		<input name="22a6cf8cc2e783e33a58ae4dedf5a4f4" value="1" type="hidden">	</div>
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


</body></html>