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
require_once('../core_system/firts_lib_query.php');
$pl=$_GET["pl"];
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
date_default_timezone_set($zone);
recover_info_user($con, $valid_user);
if(!isset($bus)){
	$bus=false;
				}
recover_info_bus_for_user($con, $valid_user, $bus);
check_is_ocupied_place_pp($con, $bus, $dt,$pl, $id_location_us);
//check_open_or_close_bus($con, $bus, $dt, $hrs, $valid_user, $location);
inser_place_temp($con, $bus, $dt, $pl, $hrs, $user_name, $id_location_us);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="generator" content="Express Bus 1.2 - Open Source">
<title>Boletos | Registro de cliente | <?php default_title(); ?></title>
<link rel="shortcut icon" href="favicon.ico">
  <script type="text/javascript" src="jquery_libraries/express_core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-core.js"></script>
  <script type="text/javascript" src="jquery_libraries/mootools-more.js"></script>
  <script type="text/javascript" src="jquery_libraries/validate.js"></script>
  <script type="text/javascript" src="jquery_libraries/get_client_ajax.js"></script>
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
  <script type="text/javascript">
  var ajax = new sack();
	var currentClientID=false;
	function getClientData()
	{
		var clientId = document.getElementById('jform_username').value.replace(/[^0-9]/g,'');
		//deshabilita esta opcion si deseas controlar la cantidad de digitos exacta del dni
		//ejemplo 8 digitos
		//if(clientId.length==8 && clientId!=currentClientID){
			currentClientID = clientId
			ajax.requestFile = 'getClient.php?getClientId='+clientId;	// Specifying which file to get
			ajax.onCompletion = showClientData;	// Specify function that will be executed after file has been found
			ajax.runAJAX();		// Execute AJAX function			
		//}
		
	}
	
	function showClientData()
	{
		var formObj = document.forms['adminForm'];	
		eval(ajax.response);
	}
	
	
	function initFormEvents()
	{
		document.getElementById('jform_username').oninput = getClientData;
		document.getElementById('jform_username').focus();
	}
	
	
	window.onload = initFormEvents;
  
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
				<span class="title"><a href="#"><?php company_name($con); ?></a></span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-menu">
			<ul id="menu" class="disabled">
<li class="disabled"><a>Sitio</a>
</li>
<li class="disabled"><a>Boletos</a>
</li>

<li class="disabled"><a>Ayuda</a>
</li>
</ul>

		</div>
		<div id="module-status">
			<span class="loggedin-users"><font color="#0E9845">Bienvenid@:</font><?php echo $user_name; ?>&nbsp;<font color="#0E9845">&nbsp;<img src="templates/images/menu/icon-16-groups.png" />&nbsp;Tipo:</font><?php echo $level; ?></span><span class="backloggedin-users"><font color="#0E9845">Terminal: </font> <?php echo $location; ?></span><span class="no-unread-messages"><b><?php recover_mails($con, $valid_user); ?> Mensajes</b></span>
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

<a href="#" onclick="javascript:if (document.adminForm.boxchecked.value==0){alert('Por favor, primero llene todos los datos');}else if(confirm('¿Está seguro que desea realizar la operacion?')){ express.submitbutton('ok')}" class="toolbar">

<span class="icon-32-save">
</span>
Guardar &amp; Cerrar
</a>
</li>



<li class="button" id="toolbar-cancel">

<a class="toolbar" href="javascript:if(document.adminForm.boxchecked.value==0){alert('Por favor seleccione un elemento de la lista para eliminar');}else if(confirm('¿Está seguro que desea cancelar la operacion?')){submitbutton('cancel');}">

<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a class="toolbar" href="#" onclick="window.open('../help/help_ticket2.html', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=900,height=500,directories=no,location=no');">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-article">
					  <h2>Boletos:  clientes</h2></div>
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

<form action="complete_proces.php" method="post" name="adminForm" id="user-form" class="form-validate">
<div class="width-60 fltlft">
<fieldset class="adminform">
<legend>Datos del Cliente</legend>
<ul class="adminformlist">
<li><label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Coloca el Número de Documento ">DNI<span class="star">&nbsp;*</span></label><input name="ci" id="jform_username" class="inputbox required" size="30" type="text" maxlength="8"></li>
<li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Coloca el Nombre del Pasajero">Nombres<span class="star">&nbsp;*</span></label>				<input name="name_client" id="jform_name" class="inputbox required" size="30" type="text"></li>
<li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Coloca los Apellidos del Pasajero">Apellidos<span class="star">&nbsp;*</span></label>				<input name="last_name_client" id="jform_name" class="inputbox required" size="30" type="text"></li>


<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip">Origen</label><input title="" name="origin" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $location; ?>"></li>
<li><label id="jform_registerDate-lbl" for="jform_username" class="hasTip required" title="Coloca el Destino del Pasajero">Destino<span class="star">&nbsp;*</span></label>

<?php recover_terminals_for_tickets($con, $bus, $location); //recupera todos las terminales o destinos que tiene el bus *// ?>


</li>
<li><label id="jform_username-lbl" for="jform_username" class="hasTip" title="Coloca el Tipo de Venta">Vender - Reservar<span class="star">&nbsp;*</span></label>				
                            
                          <select name="op" id="jform_username" >
                            <option value="v">Vender</option>
                            <option value="r">Reservar</option>
                            </select>
                            </li>       
                            
                         <li><label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Coloca el Precio del Boleto">Precio<span class="star">&nbsp;*</span></label><input name="money" id="jform_name" class="inputbox required" size="7" type="text">&nbsp;<input type="text" value="<?php recover_type_money($con); ?>" size="3"  readonly="readonly"/></li>   
                                                
<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Fecha de Viaje</label><input title="" name="dt" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $dt; ?>"></li>

           
                            <li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Hora de viaje</label>				<input title="" name="hrs" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $hrs; ?>"></li>
                            
             		
                           
                            
</li>

   
<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Número de asiento</label><input title="" name="place" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $_GET["pl"]; ?>"></li>
           <li><label id="jform_id-lbl" for="jform_id" class="hasTip" title="">Ubicación</label><input name="look" id="jform_id" value="<?php if ($pl%2==0){ echo 'Pasillo'; } else{ echo 'Ventana';} ?>" class="readonly" readonly="readonly" type="text"></li>
                            <li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Bus</label>				<input title="" name="bus" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $bus; ?>"></li>
							
                 
							
							<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Fecha de emisión</label>				<input title="" name="date_reg" id="jform_registerDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php $fr=date("Y-m-d H:i:s"); echo $fr;  ?>"></li>
                            
<li><label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="">Nº de viajes del cliente</label>				<input name="travelers" size="7" class="readonly" type="text"></li>
								
				</ul>
		</fieldset>
	</div>
    
   <?php //este codigo es muy importante sin esto no funciona jquery de los botones de seleccion aqui comienza?>     				
		<input name="option" value="com_users" type="hidden">
		<input name="task" value="" type="hidden">
		<input name="boxchecked" value="1" type="hidden">
		<input name="hidemainmenu" value="0" type="hidden">
   <?php //aqui termino recuera importar los archivos java core,moontols,validate ?>     
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
			<?php		view_menu_user_cp_2(); ?> </span>
		</p>
	</div>
</body></html>