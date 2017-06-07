<?php 
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/Fechas.class.php");
/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 */
if (!class_exists('Usuarios_Roles')) {

    class Usuarios_Roles {

        var $tabla = "roles", $indice = "rol", $sesion, $fechas;

        function Usuarios_Roles() {
            $this->sesion = new Sesion();
            $this->fechas = new Fechas();
         }

        function crear() {
            $rol = time();
            $db = new MySQL(Sesion::getConexion());
            $sql = "INSERT INTO `usuarios_roles` SET ";
            $sql.="`rol`='" . $rol . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
            return($rol);
        }

        function eliminar($rol) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `usuarios_roles` WHERE `rol`='" . $rol . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
            $politicas = new Usuarios_Politicas();
            $politicas->eliminar($rol);
        }

        function actualizar($rol, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `usuarios_roles` SET `" . $campo . "`='" . $valor . "' WHERE `rol`='" . $rol . "';";
            echo($sql);
            $consulta = $db->sql_query($sql);
            $db->sql_close();
        }

        function consultar($rol) {
            $db = new MySQL(Sesion::getConexion());
            $consulta = $db->sql_query("SELECT * FROM `usuarios_roles` WHERE `rol`='" . $rol . "' ;");
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        function inicializar() {
            $sql = "CREATE TABLE `usuarios_roles` (`rol` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',`nombre` varchar(32) DEFAULT NULL,`descripcion` blob NOT NULL,`fecha` date NOT NULL,`hora` time NOT NULL,`creador` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',PRIMARY KEY (`rol`));";
            $db = new MySQL(Sesion::getConexion());
            if (!$db->sql_tablaexiste("roles")) {
                $consulta = $db->sql_query($sql);
            }$db->sql_close();
        }

        //\\//\\//\\//\\//\\//\\ Estadisticas & Conteos //\\//\\//\\//\\//\\//\\
        function conteo() {
            $db = new MySQL(Sesion::getConexion());
            $consulta = $db->sql_query("SELECT Count(*) AS `conteo` FROM `usuarios_roles`;");
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila['conteo']);
        }

    }

}
?>