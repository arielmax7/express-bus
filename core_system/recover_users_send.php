<?php 
//** RECUPERA LA CONTRASELA PERDIDA DEL USUARIO *// 
require_once('../includes/db_system.php');
$users=db_connect();
$send=$users->query("SELECT user_name FROM users");
while ($row=$send->fetch_assoc()){	
echo '<option value='.$row["user_name"].'>'.$row["user_name"].'</option>';
}
?>