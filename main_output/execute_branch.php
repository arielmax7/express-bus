<?php
session_start();
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
require_once('../core_system/includes.php');
require_once('../core_system/fifth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
recover_info_user($con, $valid_user);
check_valid_function_users($level);
$task=$_POST["task"];
$cid=$_POST["cid"];
switch($task)
{
	case($task=="edit"); //edita la sucursal seleccionada
	?>
  
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Editar Terminal | Express Bus Tickets</title>
  <?php recover_branch_selected($con, $cid); ?>
 <link rel="shortcut icon" href="favicon.ico" />
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
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
window.addEvent('domready', function(){ new Accordion($$('div#sliders.pane-sliders > .panel > h3.pane-toggler'), $$('div#sliders.pane-sliders > .panel > div.pane-slider'), {onActive: function(toggler, i) {toggler.addClass('pane-toggler-down');toggler.removeClass('pane-toggler');i.addClass('pane-down');i.removeClass('pane-hide');Cookie.write('jpanesliders_sliders',$$('div#sliders.pane-sliders > .panel > h3').indexOf(toggler));},onBackground: function(toggler, i) {toggler.addClass('pane-toggler');toggler.removeClass('pane-toggler-down');i.addClass('pane-hide');i.removeClass('pane-down');if($$('div#sliders.pane-sliders > .panel > h3').length==$$('div#sliders.pane-sliders > .panel > h3.pane-toggler').length) Cookie.write('jpanesliders_sliders',-1);},duration: 300,opacity: false,alwaysHide: true}); });
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
			<ul id="menu" class="disabled">
<li class="disabled"><a>Sitio</a>
</li>
<li class="disabled"><a>Usuarios</a>
</li>
<li class="disabled"><a>Boletos</a>
</li>
<li class="disabled"><a>Gestionar</a>
</li>
<li class="disabled"><a>Ayuda</a>
</li>
</ul>

		</div>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><a href="mails.php"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></a></span>
			<span class="logout">FINALIZAR</span>		</div>
		<div class="clr"></div>
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


<li class="button" id="toolbar-save">
<a href="#" onclick="javascript:express.submitbutton('save')" class="toolbar">
<span class="icon-32-save">
</span>
Guardar &amp; Cerrar
</a>
</li>

<li class="button" id="toolbar-cancel">
<a href="branch.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_branch3.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-module">
					  <h2>Gestor de Terminales: Editar Terminal</h2></div>
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
				
<script type="text/javascript">
	express.submitbutton = function(task)
	{
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
			express.submitform(task, document.getElementById('user-form'));
		}
	}
</script>

<form action="edit_branch.php" method="post" name="adminForm" id="user-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>Detalles de Sucursal</legend>
			<ul class="adminformlist">
							<li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Nombre de la Terminal">Nombre<span class="star">&nbsp;*</span></label>				<input name="branch_name" id="jform_name" class="inputbox required" size="30" maxlength="20" type="text" value="<?php echo $brach_name; ?>" onkeypress="return permite(event, 'car')"></li>
							
							<li>
                            <li>
							  <label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Dirección de la Terminal">Dirección<span class="star">*</span></label>				<input name="brach_address" id="jform_username" class="inputbox required" size="30" maxlength="30" type="text" value="<?php echo $address_branch; ?>" onkeypress="return permite(event, 'num_car')"></li>
				  <li>
<label id="jform_password-lbl" for="jform_password" class="hasTip" title="Teléfono de la Terminal (Opcional)">Teléfono<span class="star">&nbsp;*</span></label>

<input name="branch_phone" id="jform_username" class="inputbox required" size="30" type="text" maxlength="15" value="<?php echo$phone_branch; ?>" onkeypress="return permite(event, 'num')">
</li>
							
							<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Fecha Registro</label>				<input title="" name="register_date" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $date_reg_branch; ?>"></li>
							
							<li>
<label id="jform_sendEmail-lbl" for="jform_sendEmail" class="hasTip" title="Estado de la Terminal">Operativo</label>
<fieldset id="jform_sendEmail" class="radio">
<?php
if($operative=="si"){
	
echo '<input id="jform_sendEmail0" name="operating" value="no" type="radio"><label for="jform_sendEmail0">No</label>
<input id="jform_sendEmail1" name="operating" value="si" type="radio" checked="checked"><label for="jform_sendEmail1">Si</label>';

}
else{
	
echo '<input id="jform_sendEmail0" name="operating" value="no" checked="checked" type="radio"><label for="jform_sendEmail0">No</label>
<input id="jform_sendEmail1" name="operating" value="si" type="radio"><label for="jform_sendEmail1">Si</label>';
	
	
}


?>
</fieldset></li>

<li><label id="jform_block-lbl" for="jform_block" class="hasTip" title="Esta Terminal esta Autorizada para Vaciar los Buses">Autorizado para iniciar,  vaciar Bus</label>				
<fieldset id="jform_block" class="radio">
<?php
if($aut_empty_bus=="si"){

echo'	
<input id="jform_block0" name="aut_empty_bus" value="no"  type="radio"><label for="jform_block0">No</label>
<input id="jform_block1" name="aut_empty_bus" value="si" checked="checked" type="radio"><label for="jform_block1">Si</label>';

}
else{
	
echo'	
<input id="jform_block0" name="aut_empty_bus" value="no"  checked="checked" type="radio"><label for="jform_block0">No</label>
<input id="jform_block1" name="aut_empty_bus" value="si"  type="radio"><label for="jform_block1">Si</label>';
	
}
?>
</fieldset></li>
<li><label id="jform_id-lbl" for="jform_id" class="hasTip" title="Número de Identificación">ID</label><input name="branch_id" id="jform_id" class="readonly" readonly="readonly" type="text" value="<?php echo $id_branch; ?>"></li>
						</ul>
                        <li><label id="jform_id-lbl" for="jform_id" class="hasTip" title="Número de orden de la Terminal">Nº Orden de Ruta</label><input name="order_branch" id="jform_password" autocomplete="off" class="inputbox required" size="5" maxlength="2" type="text" value="<?php echo $order_travel; ?>" onkeypress="return permite(event, 'num')"></li>
                        <li>
                        <label id="jform_id-lbl" for="jform_id" class="hasTip" title="Número de orden de la Terminal">Orden de Ruta Actual:</label>
                        

                        </li>
                        <?php
          switch($order_travel)
		  {              
             case($order_travel==0);           
             echo '<img src="templates/images/route.jpg" width="660" height="200"/>';  
		     break;
			 case($order_travel==1);
			 echo '<img src="templates/images/route1.jpg" width="660" height="200"/>';
			 break;
			 case($order_travel==2);
			 echo '<img src="templates/images/route2.jpg" width="660" height="200"/>';
			 break;
			 case($order_travel==3);
			 echo '<img src="templates/images/route3.jpg" width="660" height="200"/>';
			 break;
			 case($order_travel==4);
			 echo '<img src="templates/images/route4.jpg" width="660" height="200"/>';
			 break;
			 case($order_travel>=5);
			 echo '<img src="templates/images/route5n.jpg" width="660" height="200"/>';
			 break;
			 
			  
		
		  }
		?>
		</fieldset>
<input name="task" value="" type="hidden">
		<input name="cff1982236c38552a8d96f4d6bde89c1" value="1" type="hidden">
				
			</div>
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
		<div class="clr"></div>
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


</body></html>
    <?php
	break;
	
	case($task=="delete"); //elimina la sucursal
	
	remove_branch($con, $cid);
	
	break;
}
?>