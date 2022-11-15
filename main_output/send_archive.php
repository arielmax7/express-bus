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
require_once('../core_system/fourth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
recover_info_user($con, $valid_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Envíar nuevo Archivo | <?php default_title(); ?></title>
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="templates/css/modal.css" type="text/css">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
  <script type="text/javascript" src="jquery_libraries/modal.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate_fields.js"></script>


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
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
		<div class="clr">
        
        </div>
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
          
		  case($msgreturn=="no_archive");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No selecciono un archivo valido</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="bad_archive");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>EL tama&ntilde;o o la extensi&oacute;n del archivo son incorrectos (solo se permite un tama&ntilde;o maximo de 5MB | Extesiones permitidas: .pdf .jpeg .zip .png )</li></ul></dd></dl>';
		  
		  
		  break;
      }
?>
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
<li class="button" id="toolbar-save">
<a href="#" onclick="javascript:express.submitbutton('send_archive')" class="toolbar">
<span class="icon-32-save">
</span>
Enviar
</a>
</li>

<li class="button" id="toolbar-cancel">
<a href="mails.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_mail3.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-new-privatemessage"><h2>Enviar Archivo</h2></div>
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
				<script type="text/javascript">
	express.submitbutton = function(task) {
		if (task == 'message.cancel' || document.formvalidator.isValid(document.id('message-form'))) {
			express.submitform(task, document.getElementById('message-form'));
		}
	}
</script>
<form action="execute_mails.php" method="post" name="adminForm" id="message-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-100">
		<fieldset class="adminform">
		<ul class="adminformlist">
			<li><label id="jform_user_id_to-lbl" for="jform_user_id_to" class="hasTip required" title="">Para<span class="star">&nbsp;*</span></label>			
            
            


	
<select name="for_user">	
<?php recover_users_and_branch($con, $valid_user); ?>
</select>	


			<li><label id="jform_subject-lbl" for="jform_subject" class="hasTip required" title="">Asunto<span class="star">&nbsp;*</span></label>			<input name="subject" id="jform_subject" value="Hola" class="required" type="text" onkeypress="return permite(event, 'num_car')"></li>

			<li><label id="jform_message-lbl" for="jform_message" class="hasTip required" title="">Archivo max 5MB<span class="star">&nbsp;*</span></label>			<input name="userfile" type="file" ></li>
		</ul>
		</fieldset>
		<input name="task" value="" type="hidden">
		
        
        <input name="branch" value="<?php echo $id_location_us; ?>" type="hidden" />
        <input name="remite" value="<?php echo $user_name; ?>" type="hidden" />
        <input name="message" value="Tienes un archivo para descargar" type="hidden" />
        
        
        </div>
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


<div style="display: none; z-index: 65555; visibility: hidden; opacity: 0;" id="sbox-overlay"></div><div style="display: none; z-index: 65557;" id="sbox-window"><div class="sbox-bg-wrap"><div class="sbox-bg sbox-bg-n"></div><div class="sbox-bg sbox-bg-ne"></div><div class="sbox-bg sbox-bg-e"></div><div class="sbox-bg sbox-bg-se"></div><div class="sbox-bg sbox-bg-s"></div><div class="sbox-bg sbox-bg-sw"></div><div class="sbox-bg sbox-bg-w"></div><div class="sbox-bg sbox-bg-nw"></div></div><div style="visibility: hidden; opacity: 0;" id="sbox-content"></div><a href="#" id="sbox-btn-close"></a></div></body></html>