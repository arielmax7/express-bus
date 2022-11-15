<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Recuperar contraseña | Express Bus Tickets</title>
  <link rel="shortcut icon" href="../main_output/favicon.ico">
	<link rel="stylesheet" href="../main_output/templates/bus_20/css/layout.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="../main_output/templates/bus_20/css/personal.css" type="text/css" />	
    <link rel="stylesheet" href="../main_output/templates/css/consolidated_common.css" type="text/css" />
    <script type="text/javascript" src="../main_output/jquery_libraries/livevalidation_standalone.js"></script>
    
    <!--[if lte IE 6]>
	<link href="../main_output/templates/bus_20/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="contentpane">
	<div id="all">
		<div id="main">
<div id="mailto-window">
	<font size="4" color="#0099CC">
		Recuperar Contraseña	</font>
	<div class="mailto-close">
		<a href="javascript: void window.close()" title="Cerrar Ventana">
		 <span>Cerrar Ventana </span></a>
	</div>
	<form action="send_new_pass.php" method="post">
		<div class="formelm">
			<label for="mailto_field"><font size="2">Tu correo electrónico:</font> </label>
			<input type="text" name="user_email" id="f20" class="inputbox" maxlength="35" size="50"/>
            
           
            <script type="text/javascript">
		            var f20 = new LiveValidation('f20');
		            f20.add(Validate.Email );
		          </script>
		</div>
       
		<p> 
			<input type="submit" value="Enviar" />&nbsp;&nbsp;
		
        
        </p>
	</form>
</div>
		</div>
	</div>
</body>
</html>