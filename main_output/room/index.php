<?php
session_start(); //iniciamos sesion *//
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
//importamos las librerias principales *//
require_once('../../core_system/show_system_messages.php');
require_once('../../core_system/show_cr.phtml');
require_once('../../includes/db_system.php');
require_once('../../core_system/info_sys.php');
require_once('../../core_system/check_valid_user.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
 
if (isset($_GET['name']) && isset($_SESSION['userid'])): 
       
      require_once("dbcon.php");
  
      $name = cleanInput($_GET['name']);

      $getRooms = "SELECT *
  			           FROM chat_rooms
  		             WHERE name = '$name'";
  		         
      $roomResults = mysql_query($getRooms);
		
	  	if (mysql_num_rows($roomResults) < 1) {
  			header("Location: ../chatrooms.php");
  			die();
  		}
        	
      while ($rooms = mysql_fetch_array($roomResults)) {
          $file =  $rooms['file'];
      }
	  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Express Chat | <?php default_title(); ?></title>
    <link rel="shortcut icon" href="../favicon.ico">
  <link rel="stylesheet" type="text/css" href="../chat_style.css"/>
  
<link href="../templates/css/template_chat.css" rel="stylesheet" type="text/css">
<script src="../jquery_libraries/jquery.min.js?ver=1.3.2" type="text/javascript"></script>
<script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    	var chat = new Chat('<?php echo $file; ?>');
    	chat.init();
    	chat.getUsers(<?php echo "'" . $name ."','" .$_SESSION['userid'] . "'"; ?>);
    	var name = '<?php echo $_SESSION['userid'];?>';
    </script>
    <script type="text/javascript" src="settings.js"></script>

<!--[if IE 7]>
<link href="../templates/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="../templates/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="../templates/css/rounded.css">



</head>
<body id="minwidth-body">
	<div id="header-box">
		<div id="module-menu">
		
            
            
            


</div>
	<div id="content-box">
	  <div class="border">
			<div class="padding">
				<div id="toolbar-box"></div>
		<div class="clr"></div>
		<div id="element-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
		  </div>
		  <div class="m">
           <div id="page-wrap"> 
    <div align="right"><a href="../logout_chat.php"><img src="../templates/images/modal/closebox.png" title="Cerrar sesión"/></a></div>
    <div align="right">Salir &nbsp;</div>
    
    	<div id="header">
    	
        	<h1><a href="http://www.arielmax.com.ar">Express Bus Chat</a></h1>
        	
        	<div id="you"><span>Logeado como:</span> <?php echo $_SESSION['userid']?></div>
        	
        </div>
        
    	<div id="section">
    
            <h2><?php echo $name; ?></h2>
                     
            <div id="chat-wrap">
                <div id="chat-area"></div>
            </div>
            
            <div id="userlist"></div>
                
                <form id="send-message-area" action="">
                    <textarea id="sendie" maxlength='100'></textarea>
                </form>
            
        </div>
        
    </div>
        
</body>

</html>

<?php
    else:
            header('Location: http://www.arielmax.com.ar');
    endif; 
?>
          
          
          
          </div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
		<noscript>
			¡Aviso! JavaScript debe estar habilitado para realizar esta operación.		</noscript>
		<div class="clr"></div><?php 
				
				if(isset($status_site)){
				echo $status_site;
				} ?>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
		
	<div id="footer">
		<p class="copyright">
			<?php	confirm_user_cp_1(); ?></span>
		</p>
	</div>


<div style="display: none; z-index: 65555; visibility: hidden; opacity: 0;" id="sbox-overlay"></div><div style="display: none; z-index: 65557;" id="sbox-window"><div class="sbox-bg-wrap"><div class="sbox-bg sbox-bg-n"></div><div class="sbox-bg sbox-bg-ne"></div><div class="sbox-bg sbox-bg-e"></div><div class="sbox-bg sbox-bg-se"></div><div class="sbox-bg sbox-bg-s"></div><div class="sbox-bg sbox-bg-sw"></div><div class="sbox-bg sbox-bg-w"></div><div class="sbox-bg sbox-bg-nw"></div></div><div style="visibility: hidden; opacity: 0;" id="sbox-content"></div><a href="#" id="sbox-btn-close"></a></div></body></html>