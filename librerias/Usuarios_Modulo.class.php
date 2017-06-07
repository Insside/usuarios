<?php 
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 */
/**
 * Description of Tesoreria_Modulo
 *
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 */
if (!class_exists('Usuarios_Modulo')) {

    class Usuarios_Modulo {

        public $modulo = "002";
        private $nombre = "Usuarios";
        private $titulo = "Modulo Control de Usuarios.";
        private $descripcion = "Modulo Control de Usuarios.";
        private $creador = "0";
        private $permisos;

        function Usuarios_Modulo() {
        }

        function crear($modulo, $nombre, $titulo, $descripcion, $creador = "0") {
            $fechas = new Fechas();
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_modulos` WHERE `modulo` =" . $modulo . ";";
            $consulta = $db->sql_query($sql);
            $conteo = $db->sql_numrows($consulta);
            if ($conteo == 0) {
                $sql = "INSERT INTO `aplicacion_modulos` SET ";
                $sql.="`modulo` = '" . $modulo . "', ";
                $sql.="`nombre` = '" . $nombre . "', ";
                $sql.="`titulo` = '" . $titulo . "', ";
                $sql.="`descripcion` = '" . $descripcion . "', ";
                $sql.="`fecha` = '" . $fechas->hoy() . "', ";
                $sql.="`hora` = '" . $fechas->ahora() . "', ";
                $sql.="`creador` = '" . $creador . "';";
                $consulta = $db->sql_query($sql);
            } else {
                
            }
            $db->sql_close();
            return($sql);
        }
        
        public function getModulo(){
            return($this->modulo);
        }

    }

}
?>