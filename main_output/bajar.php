<?php
// forzar a la descarga del archivo .sql (backup)
$sUrlDescargas = "backups_db/"; //Introducir directorio de descargas
$sDocumento = $sUrlDescargas.$_GET["backup"];
header("Content-type: application/force-download");
header("Content-Disposition: filename=".basename($_GET["backup"]));
header("Content-Transfer-Encoding: binary");
if (!@readfile($sDocumento))
echo "Ha sido imposible descargar el backup";
?>