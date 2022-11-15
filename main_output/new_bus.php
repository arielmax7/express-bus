<?php
session_start(); //iniciamos sesion *//
$valid_user=$_SESSION["valid_user"];
//importamos las librerias principales *//
require_once('../core_system/includes.php');
require_once('../core_system/sixth_lib_query.php');
//validamos al usuario
check_valid_user_user($valid_user);
//conexion a la BD
$con=db_connect();
date_default_timezone_set($zone);
recover_info_user($con,$valid_user);
check_valid_function_sa_only($level);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" dir="ltr" lang="es-es"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="Express Bus 1.2 - Open Source">
  <title>Agregar nuevo Bus | <?php default_title(); ?> </title>
  
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
        <?php
		if(isset($_POST["msgreturn"])){
				$msgreturn = $_POST["msgreturn"];	
				}
				else{
					
				$msgreturn = false;	
				}
	  switch ($msgreturn)
	  {
		  case($msgreturn == empty($msgreturn));
		  echo '';  
		  break; 
		  case($msgreturn=="already_id");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error El ID del Bus ya existe coloque un ID diferente</li></ul></dd></dl>';
		  
		  break;
		  
		  case($msgreturn=="no_support_lib_gen");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error el n&uacute;mero de asientos colocados no es soportado por la libreria de modelado (Gen libs).</li></ul></dd></dl>';
		  
		  break;
		  
		  case($msgreturn=="ok_new_bus");
		  
		  echo'<dl id="system-message">
<dt class="message">Mensaje</dt>
<dd class="message message">

	<ul>
		<li>Bus agregado correctamente Puede continuar agregando.</li>
	</ul>
</dd>
</dl>';
		  
		  break;
		  
		  case($msgreturn=="bad_file");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error no se pudo subir la imagen solo se permiten imagenes con extensiones jpg,gif,png tama&ntilde;o maximo 1MB </li></ul></dd></dl>';
		  
		  break;
		  
		  case($msgreturn=="already_mat");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error La matricula es incorrecta este ya existe en el sitema </li></ul></dd></dl>';
		  
		  break;
		  
		  case($msgreturn=="upload_fail");
		  
		  echo '
                    <dl id="system-message">
                    <dt class="error">Error</dt>
                    <dd class="error message fade">
	                <ul>
		            <li>Error No se pudo subir la imagen de bus intentelo mas tarde si esto persite evite subir imagenes </li></ul></dd></dl>';
		  
		  break;
	  }
?>
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
<li class="button" id="toolbar-save-new">
<a href="#" onclick="javascript:express.submitbutton('save_new')" class="toolbar">
<span class="icon-32-save-new">
</span>
Guardar &amp; Nuevo
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
<a href="#" onclick="popupWindow('../help/help_buses2.html', 'Ayuda', 900, 500, 1)" rel="help" class="toolbar">
<span class="icon-32-help">
</span>
Ayuda
</a>
</li>

</ul>
<div class="clr"></div>
</div>
					<div class="pagetitle icon-48-plugin">
					  <h2>Gestor de Buses: Añadir Nuevo Bus</h2></div>
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

<form action="add_bus.php" method="post" name="adminForm" id="user-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend>Detalles del Bus</legend>
			<ul class="adminformlist">
            <li>
							  <label id="jform_registerDate-lbl" for="jform_registerDate" class="hasTip" title="Coloque el Número de Identificación del Bus">ID Bus<span class="star">&nbsp;*</span></label>				<input name="id_bus" id="jform_name" class="inputbox required" size="20" maxlength="6" type="text" onkeypress="return permite(event, 'num')"></li>
							<li>
							  <label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Coloque el Número de Asientos">Nº De Asientos<span class="star">*</span></label>				<input name="num_places_bus" id="jform_username" class="inputbox required" size="3" maxlength="2" type="text" onkeypress="return permite(event, 'num')"></li>
<li>
<label id="jform_password-lbl" for="jform_password" class="hasTip" title="Coloque la Categoría del Bus">Categoría</label>	
 
 <select name="category_bus">
 <option value="1">1</option>
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
 <option value="5">5</option>
 </select>
<img src="templates/images/admin/star.png" />
	         
</li>
							
							  <label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Coloque una Descripción del Bus">Descripción<span class="star">&nbsp;*</span></label>				<input name="description_bus" id="jform_name" class="inputbox required" size="20" maxlength="15" type="text" onkeypress="return permite(event, 'car')"></li>
							<li><label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Coloque la Matrícula del Bus">Matrícula<span class="star">*</span></label>				<input name="enrollment" id="jform_username" class="inputbox required" size="20" maxlength="10" type="text" onkeypress="return permite(event, 'num_car')"></li>
                            <li>
<label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Seleccione La librería de Generación">Librería Modelado<span class="star">*</span></label>	
			
<select name="lib_gen">
<?php recover_gen_libs_edit($con,$em=0); ?>

</select>

</li>
							<li>
							  <label id="jform_lastvisitDate-lbl" for="jform_lastvisitDate" class="hasTip" title="">Fecha de Registro</label>				<input title="" id="jform_lastvisitDate" size="22" name="date_reg" class="readonly" readonly="readonly" type="text" value="<?php echo date("Y-m-d"); ?>"></li>
                              
                         
                              
<li>
<label id="jform_sendEmail-lbl" for="jform_sendEmail" class="hasTip" title="En Operación">Operativo</label>
<fieldset id="jform_sendEmail" class="radio">

	
<input id="jform_sendEmail0" name="operative" value="no" type="radio"><label for="jform_sendEmail0">No</label>
<input id="jform_sendEmail1" name="operative" value="si" checked="checked" type="radio"><label for="jform_sendEmail1">Si</label>	

</fieldset>
</li>


  <li>
<label id="jform_id-lbl" for="jform_id" class="hasTip" title="Subir una Foto del Bus">Subir Imágen 1MB max</label>                            
 <input name="userfile" type="file" >       
        
      </li>  
                              

                              
                              
                           
             			
                               
                               
                               </li>
                
                              
						</ul>
		</fieldset>

				
			<ul class="checklist usergroups">
</ul>		
			</div>

	<div class="width-40 fltrt">
		<div id="sliders" class="pane-sliders">
		  <div class="panel">
		    <h3 class="title pane-toggler" id="settings"><a href="javascript:void(0);"><span>Librerias Dispnibles (Gen libs)</span></a></h3>
		    <div style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;" class="pane-slider content pane-hide">		
   <fieldset class="panelform">
		<ul class="adminformlist">
									
												
<?php
recover_info_gen_libs_new($con);
?>
</li>
					  </ul>
		</fieldset>
				</div></div></div>
		<input name="task" value="" type="hidden">
		<input name="option_bar" value="new" type="hidden">	</div>
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