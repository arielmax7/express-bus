<?php
//*******FUNCION PRINCIPAL PARA LA CONEXION A LA BASE DE DATOS MySQL*********//
function db_connect()
{ 
// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** // 
global $DB_HOST; 
global $DB_USER; 
global $DB_PASSWORD; 
global $DB_NAME; 
/** Host de MySQL (es muy probable que no necesites cambiarlo) */ 
$DB_HOST = 'localhost';
/** Tu nombre de usuario de MySQL */ 
$DB_USER = 'root';
/** Tu password de MySQL */ 
$DB_PASSWORD = '';
/** El nombre de tu base de datos */ 
$DB_NAME = 'buses';
//Fin de la configuracion de la base de datos apartir de qui no modifiques nada podrias afectar el funcionamiento del sistema */ 
$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME); 
 if (mysqli_connect_errno()) {
    printf(error_db_connect());
    exit();
    }
    return $mysqli;
}
//****** COFIGURACION De ZONA HORARIA **//
$zone = 'America/La_Paz';

?>