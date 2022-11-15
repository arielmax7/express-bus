<?php
//** VERIFICA SI YA SE INSTALO LA APLICACION *//
if (file_exists("includes/db_system.php") && filesize( 'includes/db_system.php' ) > 200){ 
// si el fichero existe verificamos si las tablas fueron creadas asi como el usuario por defecto
   return true; 
}else{ 
// si no existe procedemos a la instalación redireccionamos
   header('location: install/index.php');
} 
?>