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
require_once('../core_system/fifth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Gestor  - Sucursales | <?php default_title(); ?></title>
  <?php //llamamos a las funciones principales *// ?>
  <?php recover_info_user($con, $valid_user); ?>
 
  <link rel="shortcut icon" href="favicon.ico">
  
  <link rel="stylesheet" href="templates/css/modal.css" type="text/css">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>


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
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout"><a href="../core_system/logout.php">FINALIZAR</a></span>		</div>
		<div class="clr"></div>
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
		  case($msgreturn=="ok_update");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Datos actualizados correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_remove_branch");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Sucursal eliminada correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_insert_new_branch");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Sucursal Agregada.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="bad_operation");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Esta operacion no esta permitidad</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="already_branch");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>La sucursal ya existe coloque una nobre de sucursal valido</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="already_users_branch");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>No se puede eliminar la terminal, existen usuarios relacionados a esta, cambie ó elimine los usuarios de la terminal</li></ul></dd></dl>';
		  
		  
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
<li class="button" id="toolbar-new">
<a href="new_branch.php" class="toolbar">
<span class="icon-32-new">
</span>
Nuevo
</a>
</li>

<li class="button" id="toolbar-edit">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('edit')}" class="toolbar">
<span class="icon-32-edit">
</span>
Editar
</a>
</li>

<li class="divider">
</li>






<li class="button" id="toolbar-delete">
<a class="toolbar" href="javascript:if(document.adminForm.boxchecked.value==0){alert('Por favor seleccione un elemento de la lista para eliminar');}else if(confirm('¿Está seguro que desea eliminar la sucursal seleccionada?')){submitbutton('delete');}">
<span class="icon-32-delete">
</span>
Eliminar
</a>
</li>

<li class="divider">
</li>


<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_branch.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-module"><h2>Gestor Terminales</h2></div>
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
				
<form action="execute_branch.php" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
	  <div class="filter-select fltrt"></div>
	</fieldset>
	<div class="clr"> </div>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<img src="templates/images/j_arrow_down.png" />
				</th>
				<th class="left">
					<a href="#">Nombre - Ciudad</a>		</th>
				
				<th class="nowrap" width="15%"><a href="#">Operativo</a></th>
				<th class="nowrap" width="15%">
					<a href="#">Teléfono</a>				</th>
				<th class="nowrap" width="15%">
					<a href="#">Nº Orden de Terminal</a>			</th>
				
				<th class="nowrap" width="20%">
				<a href="#">Dirección</a>				</th>
				<th class="nowrap" width="12%">
					<a href="#">Fecha Registro</a>				</th>
				<th class="nowrap" width="5%">
				  <a href="#">Vaciar Bus</a>				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<div class="container"><div class="pagination">
					  <div class="limit"></div>
<input name="limitstart" value="0" type="hidden">
</div></div>				</td>
			</tr>
		</tfoot>
		<tbody>
					<tr class="row0">
				<?php view_all_estations($con); ?>
			</tr>
					</tbody>
	</table>

	<div>
		<input name="task" value="" type="hidden">
		<input name="boxchecked" value="0" type="hidden">
		<input name="filter_order" value="a.name" type="hidden">
		<input name="filter_order_Dir" value="asc" type="hidden">
		<input name="cff1982236c38552a8d96f4d6bde89c1" value="1" type="hidden">	</div>
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