<?php
function backupDatabase($file, $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME)
{
	mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
	mysql_select_db($DB_NAME);
   $tables = array();
   $result = mysql_query('SHOW TABLES');
     while($row = mysql_fetch_row($result)){ $tables[] = $row[0]; }
     //ciclo de salida
     $return = "";
     foreach($tables as $table){
     $result = mysql_query('SELECT * FROM '.$table);
     $num_fields = mysql_num_fields($result);
     $return.= 'DROP TABLE IF EXISTS '.$table.';';
     $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
     $return.= "\n".$row2[1].";";
     for ($i = 0; $i < $num_fields; $i++){
       while($row = mysql_fetch_row($result)){
       $return.= "\n".'INSERT INTO '.$table.' VALUES(';
         for($j=0; $j<$num_fields; $j++){
         $row[$j] = addslashes($row[$j]);
         //$row[$j] = ereg_replace("n","",$row[$j]); remplaza un un caracter por otro
         if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
           if ($j<($num_fields-1)) { $return.= ','; }
         }
       $return.= ");";
       }
     }
     $return.="\n";
     }
   //save file
   $handle = fopen($file,'w+');
   fwrite($handle,$return);
   fclose($handle);
}
?>