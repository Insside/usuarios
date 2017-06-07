<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
$componentes=new Usuarios_Componentes();
$componentes->regenerar();
?>