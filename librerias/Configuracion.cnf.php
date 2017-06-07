<?php
if(!defined("ROOT")){define('ROOT', dirname(__FILE__) . '/../../../');}
if(!defined("ROOT_MODULE_APLICACION")){define('ROOT_MODULE_APLICACION', dirname(__FILE__) . '/../');}
$ROOT = (!isset($ROOT)) ? ROOT:$ROOT;
require_once($ROOT . "librerias/Configuracion.cnf.php");

Sesion::init();
$usuario = Sesion::usuario();
// Modulo
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Historial.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Jerarquias.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Politicas.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Roles.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Equipos.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Equipo.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Perfiles.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Perfil.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Componentes.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Modulo.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Permisos.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Usuarios.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Usuario.class.php");
require_once($ROOT."modulos/usuarios/librerias/Usuarios_Strings.class.php");
?>