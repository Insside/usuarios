<?php
$politica=$up->politica($rol);

$html2="<div style=\"height:265px;overflow: scroll; font-size:13px; line-height:12px;\">";
$conteo=0;
foreach ($politica as $clave=>$valor){
    $conteo++;
    $html2.="<div style=\"border-bottom: 1px solid rgb(204, 204, 204);padding: 2px;\"><b>".$conteo."</b>: ".$valor["permiso"]."</div>";
}
$html2.="</div>";

$f->celdas['politicas']=$f->celda("",$html2,"","notificacion");
$f->fila["politicas"]=$f->fila($f->celdas['politicas']);
$f->fila["permisos"]=$f->fila["politicas"];
?>