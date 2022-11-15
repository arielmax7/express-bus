<?php
//** FUNCIONES QUE RECUPERAN INFORMACIOM SOBRE EL SISTEMA *//
// funcion que recupera el nombre de la empresa
function company_name($handle)
{
   $result=$handle->query("SELECT company_name FROM global_config");
   $company_name=$result->fetch_assoc();
   echo $company_name["company_name"];
   $result->free();	
}

// funcion que recupera el numero de emails que tiene el usurio
function recover_mails($handle, $user)
{
  $result=$handle->query("SELECT read_men,destin,recycling FROM mails WHERE recycling='no' AND destin='$user' AND read_men='no'");
  if($result->num_rows > 0){
  echo '<img src="templates/images/13-02.gif">&nbsp;';	  
  print($result->num_rows);
  }
  else{
  print($result->num_rows);
  }
  $result->free();
}

// funcion que recupera el tipo de moneda
function recover_type_money($con)
{		
  $result=$con->query("SELECT type_money FROM global_config");
  $tm=$result->fetch_assoc();
  echo $tm["type_money"];
}

// funcion que recupera la verision del sistema
function recover_version_system($handle)
{
  $result=$handle->query("SELECT ver_sis FROM global_config");
  $ver=$result->fetch_assoc();
  echo $ver["ver_sis"];
}

// funcion que recupera la fecha y hora de instalación del sistema
function recover_time_installation($handle)
{
  $result=$handle->query("SELECT installed FROM global_config");
  $installed=$result->fetch_assoc();
  echo $installed["installed"];
}
?>