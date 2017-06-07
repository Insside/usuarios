<?php
$usuarios = new Usuarios();
$politicas = new Usuarios_Politicas();
$jerarquias = new Usuarios_Jerarquias();
$permisos=$v->getValue("permisos");
$rol =$v->getValue("rol");
if (!empty($permisos)) {
  $keys = array_keys($permisos);
  $politicas->asignar($rol, $keys, "ASIGNADO");
}
/** JavaScripts **/
$f->windowClose();
?>