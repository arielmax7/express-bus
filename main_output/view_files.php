<?php
// permi te buscar archivos con extension .sql dentro de los backups
$contenido = array();
function inspecRec($dir) {
        global $contenido;
        if ($gd = opendir($dir)) { //Abro directorio
                while (($ar = readdir($gd)) !== false) { //recorro su interior
                        if(preg_match("/.*\.sql/i",$ar)) { //compruebo extension
                                $co = file_get_contents($dir.'/'.$ar); //extraigo su contenido 
                                preg_match_all("/[^a-zA-Z]t\('(.*)'(,.+)?\)/Ui",$co,$re); //compruebo funcion t()
                                
                                if(count($re[1])) { //si ha encontrado contenido…
                                        echo "<br><strong>$dir/$ar</strong>"; flush(); //imprimo el nombre de archivo
                                        foreach($re[1] as $r){ //introduzco frases
                                                if(!isset($contenido[$r]))
                                                        $contenido[$r] = $r;
                                        }
                                } else {
                                        echo '<tr class="row0">
										<td class="center"><input id="cb0" name="cid" value='.$ar.' onclick="isChecked(this.checked);" title="Eliminar" type="checkbox"></td>
										
										<td><a href="bajar.php?backup='.$ar.'">'.$ar.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<img src="templates/images/admin/dl-blue.gif"></td></tr>'; flush(); //imprimo nombre de archivo
                               } 
                       } elseif(is_dir($ar) && $ar != '.'  && $ar != '..') { //si es un directorio..
                               inspecRec($ar); //recursivamente lo inspecciono tambien
                       }
                }
                closedir($gd); //cierro el recurso
        } else {
                echo "<hr>Error: $dir<br>";
        }
} 
?>