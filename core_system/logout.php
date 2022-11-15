<?php
session_start(); // cerrar la aplicacion hacer logout *//
	// borramos los datos del usuario de la tabla temporal users_info
	$valid_user=$_SESSION["valid_user"];
	require_once('../includes/db_system.php');
	$handle = db_connect(); // llamamos a la conexion
	// hacemos la consulta y eliminamos los tados del usuario en la tabla temporal users_info
	$handle->query("DELETE FROM users_online WHERE id_user='$valid_user'");
	// verificamos si la consulta se efectuo con exito (sintaxis sql es correcta)
	if ($handle->error){ error_query_db(); }// llamamos a la funcion que muestra un mensaje de error de consulta se muestra si la consulta no fue hecha
    // eliminamos la sesion del usuario 
    $old_user = $valid_user;  
    
    session_destroy();
	$old_user = session_get_cookie_params(); 
    setcookie(session_name(),0,1,$old_user["path"]);
    // verificamos que haya sido eliminado los datos correctamente de la session  
  	if (!empty($old_user))
  	{
	// redireccionamos al login si todo se realizo correctamente	
    header('location: ../index.php'); 
  	}
  	else
  	{
    // si ellos no estaban logged in pero llegan a esta página de algún modo
    echo "No estas logged in, y por tanto no puedes hacer logged out.<br>";
  	}
?>





