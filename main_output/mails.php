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
require_once('../core_system/check_database_info.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexiona a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
//verificamos que exista al menos 2 usuarios en el sistema
check_users_in_table($con);
require_once('../core_system/fourth_lib_query.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Gestor de Mensajes | <?php default_title(); ?></title>
  <?php //llamamos a las funciones principales *// ?>
  <?php recover_info_user($con, $valid_user); ?>
   <?php  
   if(isset($_POST["limit"])){
				$limit=$_POST["limit"];
				}
				else{
					
				$limit = false;	
				}
   
   view_reg_for_user_mails($con, $limit, $valid_user); ?>
 <link rel="shortcut icon" href="favicon.ico">
  
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
 <script>
			function redirect()
			{
				window.location.replace('mails.php');
			}
			setTimeout('redirect();', 60000);
		</script>

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
            
            
   <?php require_once('../core_system/top_menu_view.php'); ?>         

		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
		<div class="clr"></div>
        <?php //switch selector de mesajes de retorno personalizado proveniete de show_system_messages enviando la variable      $msgreturn con un valor 
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
		  case($msgreturn=="ok_read");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>el mensaje fue marcado como leido correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  case($msgreturn=="ok_no_read");
		  
		   echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>el mensaje fue marcado como no leido correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_trash");
		   echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Mensaje enviado a la papelera.</li>
	</ul>
</dd>
</dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="ok_remove");
		  
		   echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Mensaje eliminado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_send");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Mensaje enviado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_send_archive");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Archivo enviado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="no_send_archive");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se pudo enviar el archivo intentelo mas tarde</li></ul></dd></dl>';
		  
		  break;
		  
		  case($msgreturn=="archive_not_exist");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se pudo eliminar el archivo , no se necontro el direcctorio posiblemente fue eliminado externamete</li></ul></dd></dl>';
		  
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
<a href="mails.php" class="toolbar">
<span class="icon-32-refresh">
</span>
Actualizar
</a>
</li>
<li class="button" id="toolbar-new">
<a href="send_message.php" class="toolbar">
<span class="icon-32-new">
</span>
Nuevo
</a>
</li>   
         
<li class="button" id="toolbar-new">
<a href="send_archive.php" class="toolbar">
<span class="icon-32-archive">
</span>
Enviar Archivo
</a>
</li>

<li class="divider">
</li>


<li class="button" id="toolbar-publish">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('read')}" class="toolbar">
<span class="icon-32-publish">
</span>
Marcar como leído
</a>
</li>

<li class="button" id="toolbar-unpublish">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('noread')}" class="toolbar">
<span class="icon-32-unpublish">
</span>
Marcar como no leído
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-trash">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('trash')}" class="toolbar">
<span class="icon-32-trash">
</span>
Papelera
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-delete">
<a class="toolbar" href="javascript:if(document.adminForm.boxchecked.value==0){alert('Por favor seleccione un elemento de la lista para eliminar');}else if(confirm('¿Está seguro que desea eliminar los elementos seleccionados?')){submitbutton('remove');}">
<span class="icon-32-delete">
</span>
Eliminar
</a>
</li>
<li class="divider">
</li>
<li class="button" id="toolbar-help">
  <a href="#" onclick="popupWindow('../help/help_mail.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
  <span class="icon-32-help">
  </span>
    Ayuda
  </a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-inbox">
					  <h2>Gestor de Mensajes</h2></div>
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
				

	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
        <form action="mails.php" method="post">
			
            
             <select id="limit" name="limit" class="inputbox" size="1">
	<option value="" selected="selected"># Registros</option>
	<option value="10">10</option>
	<option value="15">15</option>
	<option value="20">20</option>
	<option value="25">25</option>
	<option value="30">30</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
    <option value="300">300</option>
    <option value="400">400</option>
    <option value="500">500</option>
</select>
<input type="submit" value="Mostrar" />
<font color="#0066FF"><b><?php echo $num_reg; ?></b></font>
            
            
         
            
            
            </form>
		</div>
		<div class="filter-select fltrt">
        <form action="mails.php" method="post">
			<select name="filter_state" class="inputbox" onchange="this.form.submit()">
				<option selected="selected" value="all">- Filtrar Por -</option>
				<option value="read_only">Leidos</option>
<option value="no_read_only">No leido</option>
<option value="recycled">Papelera</option>
<option value="all">Todos</option>
			</select>
            </form>
		</div>
	</fieldset>
    <form action="execute_mails.php" method="post" name="adminForm" id="adminForm">
	<div class="clr"> </div>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<img src="templates/images/j_arrow_down.png" />
				</th>
				<th class="left" width="25%">
					<a href="#">De</a>				</th>
				<th class="left" width="10%">
					<a href="#">Leer</a>			</th>
				<th class="left" width="25%">
					<a href="#">Asunto</a>				</th>
                    <th class="left" width="10%">
					<a href="#">Tipo</a>				</th>
				<th class="left" width="20%">
					<a href="#">Fecha</a>				</th>
			
            <th class="left" width="25%">
					<a href="#">Terminal</a>				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="7">
					<div class="container"><div class="pagination">

<div class="limit"><a href="mails.php">Mostrar Todos: <img src="templates/images/admin/start-here-ubuntustudio.png" border="0" align="middle" /></a>
</div>
</div>
<div class="limit"></div>

</div>				</td>
			</tr>
		</tfoot>
		<tbody>
        <tr class="row0">
        <?php 
		if(isset($_POST["filter_state"])){
				$filter_state = $_POST["filter_state"];
				}
				else{
					
				$filter_state = false;	
				}
		
		
		
		
		view_all_mails_us($con, $filter_state, $valid_user, $num_reg); ?>
        </tr>
				</tbody>
	</table>

	<div>
		<input name="task" value="" type="hidden">
		<input name="boxchecked" value="0" type="hidden">
	
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