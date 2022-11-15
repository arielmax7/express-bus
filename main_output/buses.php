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
require_once('../core_system/sixth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
//verificamos si el sitio se encuentra activado
active_system($con, $valid_user);
recover_info_user($con, $valid_user);
check_valid_function_sa_only($level);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Gestor de Buses | <?php default_title(); ?></title>
  <?php check_valid_function_users($level); ?>
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" href="theme_adm/css/modal.css" type="text/css">
  
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
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
		  case($msgreturn=="ok_maintenace");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>El bus fue puesto en mantenimiento correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_operative");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>bus operativo nuevamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_remove");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Bus eliminado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_update");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Los datos fueron actualizados correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  
		  case($msgreturn=="ok_new_bus");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Bus agregado correctamente.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  
		  case($msgreturn=="bad_file");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error El tamño o el formato del archivo de imagen no es valido el tamaño maximo es de 1MB formatos: jpg,png,gif</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="no_support_lib_gen");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error el n&uacute;mero de asientos colocados no es soportado por la libreria de modelado (Gen libs) vuelva a intentarlo.</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="invalid_operation");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error esta operación no esta permitida.</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="already_mat");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error la matricula es incorrecta esta ya existe</li></ul></dd></dl>';
		  
		  
		  break;
		  
		  case($msgreturn=="upload_fail");
		  
		   echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error No se pudo subir el archivo intentelo mas tarde</li></ul></dd></dl>';
		  
		  
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
<a href="new_bus.php" class="toolbar">
<span class="icon-32-new">
</span>
Nuevo
</a>
</li>

<li class="button" id="toolbar-edit">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('edit_bus')}" class="toolbar">
<span class="icon-32-edit">
</span>
Editar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('add_remove_hrs_for_buses.php', 'Ayuda', 450, 370, 1)" rel="help" class="toolbar">
<span class="icon-48-newsfeeds">
</span>
Agregar / Quitar Horarios
</a>
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('add_remove_branch_for_buses.php', 'Ayuda', 450, 370, 1)" rel="help" class="toolbar">
<span class="icon-32-copy">
</span>
Agregar / Quitar Rutas
</a>
</li>
<li class="divider">
</li>


<li class="button" id="toolbar-unpublish">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('maintenace')}" class="toolbar">
<span class="icon-32-unpublish">
</span>
En mantenimiento
</a>
</li>

<li class="button" id="toolbar-unblock">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('operative')}" class="toolbar">
<span class="icon-32-unblock">
</span>
Operativo
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-delete">
<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else if(confirm('¿Está seguro que desea eliminar el bus?')){express.submitbutton('delete_bus')}" class="toolbar">
<span class="icon-32-delete">
</span>
Eliminar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_buses.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-redirect">
					  <h2>Gestor de Buses</h2></div>
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
				
<form action="buses.php" method="post">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search">Bus: </label>
			<input name="filter_search" id="filter_search" title="Buscar Buses " type="text" maxlength="6" onkeypress="return permite(event, 'num')">
			<button type="submit">Buscar</button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();">Reajustar</button>
		</div>
		
	</fieldset>
    </form>
    <form action="execute_buses.php" method="post" name="adminForm" id="adminForm">
	<div class="clr"> </div>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<img src="templates/images/j_arrow_down.png" />
				</th>
				<th class="left">
				  <a href="#">ID Bus</a>			</th>
				<th class="nowrap" width="10%">
					<a href="#">Nº Asientos</a>				</th>
				<th class="nowrap" width="15%">
					<a href="#">Operativo</a>				</th>
				<th class="nowrap" width="10%">
					<a href="#">Modelado</a>				</th>
				<th class="nowrap" width="10%">
					<a href="#">Categoría</a>				</th>
				
				<th class="nowrap" width="15%">
					<a href="#">Descripción	</a>			</th>
				<th class="nowrap" width="10%">
					<a href="#">Fecha Registro</a>			</th>
				<th class="nowrap" width="5%">
					<a href="#">Placa</a></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<div class="container"><div class="pagination">

<div class="limit"><a href="buses.php">Mostrar Todos: <img src="templates/images/admin/start-here-ubuntustudio.png" border="0" align="middle" /></a>
</div>
<div class="limit"></div>

</div></div>				</td>
			</tr>
		</tfoot>
		<tbody>
					<tr class="row0">
				
				
                
                
                
                <?php 
				if(isset($_POST["filter_search"])){
				$filter_search=$_POST["filter_search"];
				}
				else{
					
				$filter_search = false;	
				}
				view_all_buses($con,$level,$filter_search);  ?>
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