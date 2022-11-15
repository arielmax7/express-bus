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
require_once('../../core_system/check_valid_user.php');
require_once('../../includes/db_system.php');
require_once('../../core_system/info_sys.php');
require_once('../../core_system/show_cr.phtml');
require_once('../../core_system/user_recover_info.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexiona a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
require_once("dbcon.php");

    if (checkVar($_SESSION['userid'])): 
 
        $getRooms = "SELECT *
        			 FROM chat_rooms";
        $roomResults = mysql_query($getRooms);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Express Chat | <?php default_title(); ?></title>
  <link rel="shortcut icon" href="../favicon.ico">
  <?php //llamamos a las funciones principales *// ?>
  <?php recover_info_user($con, $valid_user); ?>
  <link rel="stylesheet" href="../chat_style.css" type="text/css">
  
<link href="../templates/css/template_chat.css" rel="stylesheet" type="text/css">
<script src="../jquery_libraries/jquery.min.js?ver=1.3.2" type="text/javascript"></script>
<script type="text/javascript" src="check.js"></script>

	



</head>
<body id="minwidth-body">
<div id="header-box">
	<div id="module-menu">
			
            
            
            

	
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




<li class="button" id="toolbar-help">
<a class="toolbar" href="#" onclick="window.open('../../help/help_express_chat2.html', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=900,height=500,directories=no,location=no');">
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
		<div class="clr">
        
        
        </div>
        
		<div id="element-box">
        
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
		  </div>
          
          <div class="m">
				<ul id="submenu">
		<li>
	<a class="active" href="#">Logeado como:</span> <?php echo $_SESSION['userid']?></a>	</li>
		
	</ul>				<div class="clr"></div>
		  </div>
          
          
		 <div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
		  </div>
		</div>
		<br>
				
		<div id="element-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
          <div id="section">
    	
            <div id="rooms">
            	<h3>SECCIONES:</h3>
                <ul>
                    <?php 
                        while($rooms = mysql_fetch_array($roomResults)):
                            $room = $rooms['name'];
                            $query = mysql_query("SELECT * FROM `chat_users_rooms` WHERE `room` = '$room' ") or die("Cannot find data". mysql_error());
                            $numOfUsers = mysql_num_rows($query);
                    ?>
                    <li>
                       <h3> <a href="index.php?name=<?php echo $rooms['name']?>"><?php echo $rooms['name'] . "<span>Usuarios conectados: <strong>" . $numOfUsers . "</strong></span>" ?></a></h3>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        
    </div>
       
          
          
        
			<div class="b">
				<div class="b">
					<div class="b"></div>
              </div>
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
<?php 

    else: 
	   header('Location: http:www.arielmax.com.ar');
	   
	endif;
	
?>