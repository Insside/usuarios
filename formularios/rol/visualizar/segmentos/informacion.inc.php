<?php
/** Campos **/
$f->campos["foto"]="<div class=\"i200x267_seguridad\" style=\"width:200px;height:267px; float:left; display:block; margin-right: 10px;margin-left:0px;\"></div>";
$f->campos['rol']=$f->campo("rol",$v['rol']);
$f->campos['nombre']=$f->campo("nombre",$v['nombre']);
$f->campos['descripcion']=$f->campo("descripcion",$v['descripcion']);
$f->campos['fecha']=$f->campo("fecha",$v['fecha']);
$f->campos['hora']=$f->campo("hora",$v['hora']);
$f->campos['creador']=$f->campo("creador",$v['creador']);
/** Celdas **/
$f->celdas["rol"]=$f->celda("Rol:",$f->campos['rol']);
$f->celdas["nombre"]=$f->celda("Nombre:",$f->campos['nombre']);
$f->celdas["descripcion"]=$f->celda("Descripcion:",$f->campos['descripcion']);
$f->celdas["fecha"]=$f->celda("Fecha de Creación:",$f->campos['fecha']);
$f->celdas["hora"]=$f->celda("Hora de Creación:",$f->campos['hora']);
$f->celdas["creador"]=$f->celda("Creador:",$f->campos['creador']);
/** Filas **/
$f->fila["if1"]=$f->fila($f->celdas["rol"].$f->celdas["nombre"]);   
$f->fila["if2"]=$f->fila($f->celdas["descripcion"]);
$f->fila["if3"]=$f->fila($f->celdas["fecha"].$f->celdas["hora"]);

$f->celdas["ifoto"] = $f->celda("", $f->campos["foto"],"","w200");
$f->celdas["idatos"] = $f->celda("",$f->fila["if1"].$f->fila["if2"].$f->fila["if3"]);
/** Filas * */
$f->fila["informacion"] =$f->fila($f->celdas["ifoto"].$f->celdas["idatos"]);
?>