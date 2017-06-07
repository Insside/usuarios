<?php
$usuarios = new Usuarios();
$jerarquias = new Usuarios_Jerarquias();
$transaccion =Request::getValue("transaccion");
$usuario =$v->recibir("usuario");
$roles=$v->recibir("roles");

if (!empty($roles)) {
  $keys = array_keys($_REQUEST['roles']);
  $jerarquias->asignar($usuario, $keys, "ASIGNADO");
}
/** JavaScripts **/
$f->windowClose();
?>