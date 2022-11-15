<?php
//** SEPTIMA LIBRERIA DE CONSULTAS SQL EXCLUSIVO DEl INFORME ECONOMICO *//
// funcion que muestra el informe economico solo a la sucursal encargada
function view_payments_bus($handle, $limit, $se_date, $se_date2, $op_sa, $user)
{    
    if(!empty($limit)){
	// significa que esta cambiando la vista numero de registros a mostrar	
	$handle->query("UPDATE paging_settings SET views='$limit' WHERE id_user='$user'");
	echo "<script>	
		window.location.replace('payments_tickets.php');
		</script>";
	
    }
	if(!empty($se_date) && !empty($se_date2)){
		//significa que desea ver por intervalo de fechas
		
		
		
			$handle->query("UPDATE paging_settings SET view_date='$se_date', view_date_to='$se_date2' WHERE id_user='$user'");
			//recargamos la pagina con los nuevos datos
			echo "<script>	
			window.location.replace('payments_tickets.php');
			</script>";
	
	
	}
	if(!empty($se_date) && empty($se_date2)){
		
		
		//significa que desea ver de una fecha especifica
		$handle->query("UPDATE paging_settings SET view_date='$se_date', view_date_to='$se_date' WHERE id_user='$user'");
			//recargamos la pagina con los nuevos datos
			echo "<script>	
			window.location.replace('payments_tickets.php');
			</script>";
	}
    if(!empty($op_sa)){
		
		
	// significa que esta cambiano la vista por sucursal
	$handle->query("UPDATE paging_settings SET nam_loc='$op_sa' WHERE id_user='$user'");
	echo "<script>	
		window.location.replace('payments_tickets.php');
		</script>";
    }
	
	
	global $num_reg; // contiene el numero de registros a mostrar para este usuario
	global $ft; // contiene la fecha de registros a mostrar para el usuario
	global $ft2; //contiene la otra fecha de intervalo a mostrar
	global $v_branch; // contiene la sucursal a mostrar solo para el super admin
	// recuperamos la paginacion del usuario si este no establecio un parametro se obtendra el parametro del sistema
	$pagin=$handle->query("SELECT * FROM paging_settings WHERE id_user='$user'");
	$re=$pagin->fetch_assoc();
	$num_reg=$re["views"];
	$ft=$re["view_date"];
	$ft2=$re["view_date_to"];
	$v_branch=$re["nam_loc"];
	
	
	
}

// funcion que calcula el total de items vendidos de acuerdo a la opcion seleccionada
function calculate_items_pays($con,$query) 
{
	$result=$con->query($query);
	// declaramos variables globles para ser mostrados en la pagina
	global $total_item; // contiene la contidad de items vendidos
	global $total_money; // contiene el total de dinero acumulado
	$total_item=$result->num_rows;
	while($row=$result->fetch_assoc()){
	$total_money=$total_money+$row["payment"];
	} // fin del loop
}

// funcion que recupera todas las terminales para el super admin
function recover_all_branch_for_sa($handle,$branch)
{
	
	$result=$handle->query("SELECT * FROM branch WHERE NOT(city='$branch')");
	echo '<option value="'.$branch.'" selected="selected">'.$branch.'</option>';
	while ($row=$result->fetch_assoc()){
	echo '<option value='.$row["city"].'>'.$row["city"].'</option>';
	}
	echo '<option value="Todos">Todos</option>';
	// fin del list box	
	echo '</select>';
}

// funcion que registra en el log que se esta imprimiendo un registro comercial
function register_log_print_payments($handle, $event, $user, $branch, $zone)
{
	 date_default_timezone_set($zone);
	 $reg_day=date("Y-m-d  H:i:s"); // registra fecha y hora en que fue hecha la operacion
	 $handle->query("INSERT INTO logs (register_time,id_user,nam_locations,event) VALUES('$reg_day','$user','$branch','$event')");
}
?>