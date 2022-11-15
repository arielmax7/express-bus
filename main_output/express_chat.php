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
//validamos al usuario
check_valid_user_user($valid_user);
//conexio a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
require_once('../core_system/check_database_info.php');
//verificamos que exista al menos 2 usuarios en el sistema
check_users_in_table_chat($con);
//iniciamos sesion para el chat
if (!isset($_SESSION['userid'])):

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Express Chat | <?php default_title(); ?></title>
    <link rel="shortcut icon" href="favicon.ico">
  <?php //llamamos a las funciones principales *// ?>
  <?php recover_info_user($con, $valid_user); ?>
  <link rel="stylesheet" href="chat_style.css" type="text/css">
<link href="templates/css/template_chat.css" rel="stylesheet" type="text/css">
<script src="jquery_libraries/jquery.min.js?ver=1.3.2" type="text/javascript"></script>
<script type="text/javascript" src="check.js"></script>




</head>
<body id="minwidth-body">
	<div id="header-box">
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




<li class="button" id="toolbar-help">
<a class="toolbar" href="#" onclick="window.open('../help/help_express_chat.html', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=900,height=500,directories=no,location=no');">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-newsfeeds-cat"><h2>Express Chat</h2></div>
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
          
          <div id="section">
        	<form method="post" action="room/jumpin.php">
            	<label>Ingresaras  como:</label>
                <div>
                	<input type="text" id="userid" name="userid"  value="<?php echo $full_name.' ('.$location.')'; ?>" readonly="readonly"/>
                    <input type="submit" value="Ingresar" id="jumpin"/>
            	</div>
            </form>
        </div>
        
        <div id="status">
        	<?php if (isset($_GET['error'])): ?>
        		<!-- Display error when returning with error URL param? -->
        	<?php endif;?>
        </div>
        
   
    
</body>

</html>

<?php 
    else:
	    header('location: room/chatrooms.php');
     
	   exit;
		
    endif; 
?>
          
          
          </div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div></div>
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


<div style="display: none; z-index: 65555; visibility: hidden; opacity: 0;" id="sbox-overlay"></div><div style="display: none; z-index: 65557;" id="sbox-window"><div class="sbox-bg-wrap"><div class="sbox-bg sbox-bg-n"></div><div class="sbox-bg sbox-bg-ne"></div><div class="sbox-bg sbox-bg-e"></div><div class="sbox-bg sbox-bg-se"></div><div class="sbox-bg sbox-bg-s"></div><div class="sbox-bg sbox-bg-sw"></div><div class="sbox-bg sbox-bg-w"></div><div class="sbox-bg sbox-bg-nw"></div></div><div style="visibility: hidden; opacity: 0;" id="sbox-content"></div><a href="#" id="sbox-btn-close"></a></div></body></html>