<?php
session_start();
if(isset($_SESSION["valid_user"])){
	$valid_user=$_SESSION["valid_user"];
				
				}
				else{
				$valid_user=false;		
				
				}
require_once('../core_system/includes.php');
require_once('../core_system/sixth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
recover_info_user($con, $valid_user); 
check_valid_function_sa_only($level);
 
$task=$_POST["task"];
$cid=$_POST["cid"];
switch($task)
{
	case($task=="maintenace"); //pone en mante nimiento al bus
	
	in_maintenace_bus($con, $cid);
	
	break;
	
	case($task=="operative"); //pone operativo al bus
	
	operative_bus($con, $cid);
	
	break;
	
	case($task=="delete_bus"); //elimina permanentemente al bus
	
	remove_bus($con, $cid);
	
	break;
	
	case($task=="edit_bus"); //edita el bus
	////////////////////*/*/*/*/*/*/*/*/*//*
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Editar Bus | <?php default_title(); ?> </title>
  <?php recover_all_info_bus($con, $cid); ?>
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
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
<a href="#" onclick="javascript:express.submitbutton('save')" class="toolbar">
<span class="icon-32-save">
</span>
Guardar &amp; Cerrar
</a>
</li>

<li class="button" id="toolbar-cancel">
<a href="buses.php" class="toolbar">
<span class="icon-32-cancel">
</span>
Cancelar
</a>
</li>

<li class="divider">
</li>

<li class="button" id="toolbar-help">
<a href="#" onclick="popupWindow('../help/help_buses3.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-redirect">
					  <h2>Gestor de Buses: Editar Bus</h2></div>
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

<form action="edit_bus.php" method="post" name="adminForm" id="user-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>Detalles del Bus</legend>
			<ul class="adminformlist">
							
							<li>
							  <label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Total de asientos del Bus">Nº De Asientos<span class="star">*</span></label>				<input name="num_places_bus" id="jform_username" class="inputbox required" size="3" maxlength="2" type="text" value="<?php echo $num_places; ?>" onkeypress="return permite(event, 'num')"></li>
<li>
<label id="jform_password-lbl" for="jform_password" class="hasTip" title="Categoría del Bus">Categoría</label>	
 
 <select name="category_bus">
 <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
 <option value="1">1</option>
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
 <option value="5">5</option>
 </select>
 
<?php
switch($category)
{ 

	case($category=="1");
	
	echo '<img src="templates/images/admin/star.png" />';
	break;
	case($category=="2");
	echo '<img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" />';
	
	break;
	case($category=="3");
	
	echo '<img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" />';
	break;
	case($category=="4");
	echo '<img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" />';
	
	break;
	case($category=="5");
	echo '<img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" /><img src="templates/images/admin/star.png" />';
	break;
                            
}
?>                         
</li>
							
							<li>
							  <label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Descripción del Bus">Descripción<span class="star">&nbsp;*</span></label>				<input name="description_bus" id="jform_name" class="inputbox required" size="20" maxlength="15" type="text" value="<?php echo $description; ?>" onkeypress="return permite(event, 'car')"></li>
							<li>
							  <label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="Número de Identificación">ID Bus</label>				<input title="" id="jform_lastvisitDate" name="id_bus" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $cid; ?>" ></li>
							<li>
							  <label id="jform_lastvisitDate-lbl" for="jform_lastvisitDate" class="hasTip" title="">Fecha de Registro</label>				<input title="" id="jform_lastvisitDate" size="22" class="readonly" readonly="readonly" type="text" value="<?php echo $registration; ?>"></li>
                              
                              
                              
<li>
<label id="jform_sendEmail-lbl" for="jform_sendEmail" class="hasTip" title="En Operación">Operativo</label>
<fieldset id="jform_sendEmail" class="radio">
<?php
if($operating=="si"){
	
echo '<input id="jform_sendEmail0" name="operative" value="no" type="radio"><label for="jform_sendEmail0">No</label>
<input id="jform_sendEmail1" name="operative" value="si" checked="checked" type="radio"><label for="jform_sendEmail1">Si</label>';	
}
else{

echo '<input id="jform_sendEmail0" name="operative" value="no" checked="checked" type="radio"><label for="jform_sendEmail0">No</label>
<input id="jform_sendEmail1" name="operative" value="si" type="radio"><label for="jform_sendEmail1">Si</label>';
}
?>
</fieldset>
</li>

<label id="jform_id-lbl" for="jform_id" class="hasTip" title="Imágen Disponible">Imgen</label>
<?php
if($image=="si"){
echo '<img src="templates/images/admin/tick.png">';	
}
else{
echo '<img src="templates/images/admin/publish_r.png">';
}
?>
</li>
  <li>
<label id="jform_id-lbl" for="jform_id" class="hasTip" title="Cambiar Imágen del Bus">Cambiar Imágen</label>                            
 <input name="userfile" type="file" >       
        
      </li>  
                              
<li>
<label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Librería de Modelado">Librería Modelado<span class="star">*</span></label>	
			
<select name="lib_gen">
<?php recover_gen_libs_edit($con,$cid); ?>

</select>

</li>
                              
                              <label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Matrícula del Bus">Matrícula<span class="star">*</span></label>				<input name="enrollment" id="jform_username" class="inputbox required" size="20" maxlength="10" type="text" value="<?php echo $enrollment; ?>" onkeypress="return permite(event, 'num_car')"></li>
                           
             			
                               
                               
                               </li>
                
                              
						</ul>
		</fieldset>

				
			<ul class="checklist usergroups">
</ul>		
			</div>

	<div class="width-40 fltrt">
		<div id="sliders" class="pane-sliders">
		  <div class="panel">
		    <h3 class="title pane-toggler" id="settings"><a href="javascript:void(0);"><span>Vista Previa del Bus</span></a></h3>
		    <div style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;" class="pane-slider content pane-hide">		
   <fieldset class="panelform">
		<ul class="adminformlist">
									
												
<?php
if($image=="si"){		
//mostramos la imagen		
  echo '<img src='.$url_image.' width="260" height="220">'; 		
}
else{
//mostramos una imagen idicando que no posee una imagen
echo '<img src="templates/images/no_image.png">';	
	
	
}
		
?>
</li>
					  </ul>
		</fieldset>
				</div></div></div>
		<input name="task" value="" type="hidden">
        
		<input name="option_bar" value="edit" type="hidden">	</div>
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
	////////////////*/*/*/*/*/*/*/*/*/*/*//*
	break;	
}
?>
