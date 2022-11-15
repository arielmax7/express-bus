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

require_once('../core_system/third_lib_query.php');

//validamos al usuario

check_valid_user_user($valid_user);

//conexiona a la BD

$con=db_connect();

recover_info_user($con, $valid_user);

check_valid_function_users($level);

//verificamos si el sitio se encuentra activado

active_system($con, $valid_user);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>

  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <meta name="generator" content="Express Bus 1.2 - Open Source">

  <title>Gestor de Usuarioss | <?php default_title(); ?></title>

  <?php //opciones de vista de registro

 
  
  if(isset($_POST["limit"])){
  $limit=$_POST["limit"];  
  }
  else{
  $limit=false;	  
  }
  if(isset($_POST["op_sa"])){
  $op_sa=$_POST["op_sa"];  
  }
  else{
  $op_sa=false;	  
  }

  view_list_for_user($con,$limit,$op_sa,$valid_user,$level,$location);
   ?>

  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="templates/css/modal.css" type="text/css">

  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>

  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>

  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>

  <script type="text/javascript" src="jquery_libraries/modal.js"></script>

  <script type="text/javascript" src="jquery_libraries/validate_fields.js"></script>

  <script type="text/javascript">

		window.addEvent('domready', function() {

			$$('.hasTip').each(function(el) {

				var title = el.get('title');

				if (title) {

					var parts = title.split('::', 2);

					el.store('tip:title', parts[0]);

					el.store('tip:text', parts[1]);

				}

			});

			var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false});

		});

		window.addEvent('domready', function(){

			actions = $$('a.move_up');

			actions.combine($$('a.move_down'));

			actions.combine($$('a.grid_true'));

			actions.combine($$('a.grid_false'));

			actions.combine($$('a.grid_trash'));

			actions.each(function(a){

				a.addEvent('click', function(){

					args = JSON.decode(this.rel);

					listItemTask(args.id, args.task);

				});

			});

			$$('input.check-all-toggle').each(function(el){

				el.addEvent('click', function(){

					if (el.checked) {

						document.id(this.form).getElements('input[type=checkbox]').each(function(i){

							i.checked = true;

						})

					}

					else {

						document.id(this.form).getElements('input[type=checkbox]').each(function(i){

							i.checked = false;

						})

					}

				});

			});

		});

		window.addEvent('domready', function() {



			SqueezeBox.initialize({});

			SqueezeBox.assign($$('a.modal'), {

				parse: 'rel'

			});

		});

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

<?php require_once('../core_system/top_menu_view.php')?>

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

		  case($msgreturn=="ok_active");

		  echo'<dl id="system-message">

<dt class="message">Mensaje</dt>

<dd class="message message">

	<ul>

		<li>Cuenta activada correctamente.</li>

	</ul>

</dd>

</dl>';

		  break;  

		  case($msgreturn=="no_desactive");

		   echo '

                    <dl id="system-message">

                    <dt class="error">Error</dt>

                    <dd class="error message fade">

	                <ul>

		            <li>No se puede realizar esta operacion al super administrador</li></ul></dd></dl>';

		  break;

		  case($msgreturn=="bad_operation");

		   echo '

                    <dl id="system-message">

                    <dt class="error">Error</dt>

                    <dd class="error message fade">

	                <ul>

		            <li>No se puede realizar esta operacion</li></ul></dd></dl>';

		  break;

		  case($msgreturn=="already_email");

		   echo '

                    <dl id="system-message">

                    <dt class="error">Error</dt>

                    <dd class="error message fade">

	                <ul>

		            <li>El email colocado ya existe</li></ul></dd></dl>';

		  break;

		  case($msgreturn=="already_us");

		   echo '

                    <dl id="system-message">

                    <dt class="error">Error</dt>

                    <dd class="error message fade">

	                <ul>

		            <li>El usuario colocado ya existe</li></ul></dd></dl>';

		  break;

		  case($msgreturn=="ok_desactive");

		  echo'<dl id="system-message">

<dt class="message">Mensaje</dt>

<dd class="message message">

	<ul>

		<li>Cuenta desactivada correctamente.</li>

	</ul>

</dd>

</dl>';

		  break;  

		  case($msgreturn=="ok_unblock");

		  echo'<dl id="system-message">

<dt class="message">Mensaje</dt>

<dd class="message message">

	<ul>

		<li>Mensajeria desbloqueada correctamente.</li>

	</ul>

</dd>

</dl>';

		  break;  

		   case($msgreturn=="ok_add_user");

		  echo'<dl id="system-message">

<dt class="message">Mensaje</dt>

<dd class="message message">

	<ul>

		<li>Nuevo usuarios agregado correctamente.</li>

	</ul>

</dd>

</dl>';

		  break;  

		  case($msgreturn=="ok_block");

		  echo'<dl id="system-message">

<dt class="message">Mensaje</dt>

<dd class="message message">

	<ul>

		<li>Mensajeria bloqueada correctamente.</li>

	</ul>

</dd>

</dl>';

		  break;  

		  case($msgreturn=="ok_remove");

		  echo'<dl id="system-message">

<dt class="message">Mensaje</dt>

<dd class="message message">

	<ul>

		<li>Usuario eliminado correctamente.</li>

	</ul>

</dd>

</dl>';

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

<a href="new_user.php" class="toolbar">

<span class="icon-32-new">

</span>

Nuevo

</a>

</li>



<li class="button" id="toolbar-edit">

<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero haga una selección en la lista');}else{ express.submitbutton('edit')}" class="toolbar" >

<span class="icon-32-edit">

</span>

Editar

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

<a href="#" onclick="popupWindow('../help/help_users.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">

<span class="icon-32-help">

</span>

Ayuda

</a>

</li>



</ul>

<div class="clr"></div>

</div>

					<div class="pagetitle icon-48-user"><h2>Gestor Usuarios</h2></div>

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

<form action="users.php" method="post">



	

		<div class="filter-search fltlft">

        

       

			

			

			<label class="filter-search-lbl" for="filter_search"> Usuario: </label>

			<input name="filter_search" id="filter_search" title="Buscar Usuarios " type="text" onkeypress="return permite(event, 'num_car')"><button type="submit">Buscar</button>

			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();">Reajustar</button></div>

           

        <div class="filter-select fltrt">

			

            

            

            

  <select name="limit" class="inputbox" size="1">

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

</select><input type="submit" value="Mostrar" />



 



<font color="#0066FF"><b><?php echo $num_reg; ?></b></font>









</form>

		</div>

        

          </fieldset>

        

        <div class="clr"> </div>

	       <form action="execute_user.php" method="post" name="adminForm" id="adminForm">

	<table class="adminlist">

		<thead>

			<tr>

				<th width="1%">

					<img src="templates/images/j_arrow_down.png" />

				</th>

				<th class="left">

					<a href="#">Nombre	Completo</a>		</th>

				<th class="nowrap" width="8%">

					<a href="#">Nombre de Usuario</a>				</th>

                    <th class="nowrap" width="12%">

					<a href="#">DNI</a>				</th>

				<th class="nowrap" width="12%">

					<a href="#">Dirección</a>				</th>

				<th class="nowrap" width="10%">

					<a href="#">Correo Electrónico</a></th>

				<th class="nowrap" width="10%">

					<a href="#">Tipo</a>				</th>

				<th class="nowrap" width="10%">

					<a href="#">Ventas</a>				</th>

				<th class="nowrap" width="10%">

					<a href="#">Teléfono</a>				</th>

				<th class="nowrap" width="10%">

					<a href="#">Fecha Registro</a>				</th>

				<th class="nowrap" width="3%">

					<a href="#">Sucursal</a>				</th>

			</tr>

		</thead>

		<tfoot>

			<tr>

				<td colspan="15">

					<div class="container"><div class="pagination">



<div class="limit"><a href="users.php">Actualizar: <img src="templates/images/admin/start-here-ubuntustudio.png" border="0" align="middle" /></a>

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
				$filter_search="1";	
					
				}
				
				
				
					
			
				//$filter_search=$_POST["filter_search"];

				view_branch_users_sa_all($con, $level, $location, $valid_user, $filter_search, $num_reg, $v_branch,$id_location_us); ?>

			</tr>

		  </tbody>

	</table>



	<div>

		<input name="task" value="" type="hidden">

		<input name="boxchecked" value="0" type="hidden">

		

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

<div id="border-bottom"><div><div></div></div></div>

		

	<div id="footer">

		<p class="copyright">

			<?php	view_menu_user_cp_2(); ?></span>

		</p>

	</div>

<div style="display: none; z-index: 65555; visibility: hidden; opacity: 0;" id="sbox-overlay"></div><div style="display: none; z-index: 65557;" id="sbox-window"><div class="sbox-bg-wrap"><div class="sbox-bg sbox-bg-n"></div><div class="sbox-bg sbox-bg-ne"></div><div class="sbox-bg sbox-bg-e"></div><div class="sbox-bg sbox-bg-se"></div><div class="sbox-bg sbox-bg-s"></div><div class="sbox-bg sbox-bg-sw"></div><div class="sbox-bg sbox-bg-w"></div><div class="sbox-bg sbox-bg-nw"></div></div><div style="visibility: hidden; opacity: 0;" id="sbox-content"></div><a href="#" id="sbox-btn-close"></a></div></body></html>