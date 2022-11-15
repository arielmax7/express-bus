<?php 
//** muestra todo el menu superior (Barra de menus) esto se aplica a todos las paginas en el sitio a su ves verifica tipo de usuario *// ?>
<li class="node"><a class="" href="#">Sitio</a><ul>
<li><a class="icon-16-cpanel" href="index.php">Panel de Control</a></li>
<li class="separator"><span></span></li>
<li><a class="icon-16-help-this" href="my_profile.php">Mi perfil</a></li>
<li class="separator"><span></span></li>
<li class="separator"><span></span></li>
<li class="node">
<?php 
//** Bloque de codigo que muestra el menu respectivo al usuario *//
    // creamos una variable global la que contendra los menus respectivos
    global $menu;
	// Comparamos el nivel del usuario en base a eso se muestra su respectivo menu ( super admin )
?>
<ul id="menu-mantenimiento" class="menu-component">
</ul>
</li>
<li class="separator"><span></span></li>
<?php   
	// Comparamos el nivel del usuario en base a eso se muestra su respectivo menu ( super admin )
	if ($level=="sa"){
		// menu del super administrador html
		// asignamos el icono y su respectivo enlace y mostramos
	    $menu= '<li><a class="icon-16-info" href="info_system.php">Información del Sistema</a></li>'; // muestra la opcion infromacion del sistema
		echo $menu;
		// fin del menu 
	}
?>

<?php   
	// Comparamos el nivel del usuario en base a eso se muestra su respectivo menu ( super admin )
	if ($level=="sa"){
		// menu del super administrador html
		// asignamos el icono y su respectivo enlace y mostramos
	    $menu= '<li class="separator"><span></span></li><li><a class="icon-16-backup" href="backup_system_db.php">Realizar Backups</a></li>'; // muestra la opcion infromacion del sistema
		echo $menu;
		// fin del menu 
	}
?>

<li class="separator"><span></span></li>
<li><a class="icon-16-logout" href="../core_system/logout.php">FINALIZAR</a></li>
</ul>
</li>
<li class="node">
<?php 
	// Comparamos el nivel del usuario en base a eso se muestra su respectivo menu ( super admin y administrador )
	if ($level=="sa" || $level=="ad"){
		// menu del super administrador y administrador html
	    // asignamos el icono y su respectivo enlace y mostramos
	    $menu= '<a class="" href="#">Usuarios</a>'; // muestra la opcion de usuarios
		echo $menu;
		//fin del menu
	}
?><ul>
<li class="node"><a class="icon-16-user" href="users.php">Gestor de Usuarios</a><ul id="menu-gestor-de-usuarios" class="menu-component">
<li><a class="icon-16-newarticle" href="new_user.php">Añadir Nuevo Usuario</a></li>
</ul>
</li>
<li class="node"><ul id="menu-grupos" class="menu-component">
</ul>
</li>
<li class="node">
<ul id="menu-niveles-de-accesos" class="menu-component">
</ul>
</li>
<li class="separator"><span></span></li>
</ul>
</li>
 
      <li class="node"><a class="" href="#">Boletos</a><ul>
<li><a class="icon-16-menumgr" href="tickets.php">Vender Boletos</a><ul id="menu-gestor-de-menu" class="menu-component">
</ul>
</li>
<li class="separator"><span></span></li>
<li class="node"></span>
</li>
</ul>
</li>


<li class="node">
<?php 
	// Comparamos el nivel del usuario en base a eso se muestra su respectivo menu ( super admin )
	if ($level=="sa"){
		// menu del super administrador html
	    // asignamos el icono y su respectivo enlace y mostramos 
	    $menu= '<a class="" href="#">Gestionar</a>'; // muetra la opcion de gestionar 
		echo $menu;
		// fin del menu 
	}
?>
<ul>
<li class="node"><a class="icon-16-banners" href="buses.php">Buses</a><ul id="menu-banners" class="menu-component">
<li><a class="icon-16-newarticle" href="new_bus.php">Añadir Bus</a></li>
</ul>
</li>
<li class="node"><a class="icon-16-back-user" href="branch.php">Terminales</a><ul id="menu-contactos" class="menu-component">
<li><a class="icon-16-newarticle" href="new_branch.php">Añadir Terminal</a></li>
</ul>
</li>
<li class="node"><a class="icon-16-weblinks" href="payments_tickets.php">Informe Económico</a><ul id="menu-enlaces-web" class="menu-component">


</ul>
</li>
<li class="node"><a class="icon-16-messages" href="mails.php">Mensajería</a><ul id="menu-mensajer�a" class="menu-component">
<li><a class="icon-16-messages-add" href="send_message.php">Nuevo Mensaje Privado</a></li>
</ul>
</li>
<li class="node"><ul id="menu-noticias-externas" class="menu-component">
</ul>
</li>
</ul>
</li>
<li class="node"><a class="" href="#">Ayuda</a><ul>
<li><a class="icon-16-help-jrd" href="../help/manual.html" target="_blank">Manual de Usuario</a></li>
<li><a class="icon-16-help-forum" href="#" onclick="popupWindow('../help/about.html', 'recuperar', 910, 230, 1)">Acerca de Express Bus Tickets</a></li>
<li class="separator"><span></span></li>
</ul>
</li>
</ul>
</li>
</ul>
</div>