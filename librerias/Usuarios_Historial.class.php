<?php

/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 */
/**
 * Description of Historial
 * Esta clase gestionara el historial de acciones ejecutadas por cada usuario. El concepto de historial 
 * o de logging designa la grabación secuencial en la base de datos de todos los acontecimientos que 
 * afectan los procesos particulares de cada aplicación.
 * Advertencia: Esta clase no debe usar la clase Sesion() ya que puede generar errores de redundancia
 * ciclica. 
 * @author Alexis
 */
if (!class_exists('Usuarios_Historial')) {
    $ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
    require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
    require_once($ROOT . "librerias/Fechas.class.php");

    class Usuarios_Historial {

        var $tabla = "usuarios_acciones";
        var $indice = "accion";
        var $fechas;
        var $cadenas;

        function Historial() {
            $this->fechas = new Fechas();
            $this->cadenas = new Cadenas();
            $db = new MySQL(Sesion::getConexion());
            if (!$db->sql_tablaexiste($this->tabla)) {
                $this->tabla_crear();
            }
            $db->sql_close();
        }

        function get_Historia($usuario) {
            $db = new MySQL(Sesion::getConexion());
            $consulta = $db->sql_query("SELECT * FROM `" . $this->tabla . "` WHERE(`usuario`='" . $usuario . "');");
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        function set_Historia($datos) {
            $db = new MySQL(Sesion::getConexion());
            $sql = ""
                    . "INSERT INTO `" . $this->tabla . "` (`accion`, `usuario`,`modulo`,`tipo`,`valor`,`descripcion`,`fecha`,`hora`,`sql`)"
                    . "VALUES("
                    . "'" . $datos['accion'] . "',"
                    . "'" . $datos['usuario'] . "',"
                    . "'" . $datos['modulo'] . "',"
                    . "'" . $datos['tipo'] . "',"
                    . "'" . $datos['valor'] . "',"
                    . "'" . $datos['descripcion'] . "',"
                    . "'" . $datos['fecha'] . "',"
                    . "'" . $datos['hora'] . "',"
                    . "'" . $datos['sql'] . "');"
                    . "";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
            //echo($sql);
            return($sql);
        }

        /**
         * Resgistra un intento de acceso al sistema.
         * @param type $usuario: Usuario que realiza la accion
         * @param type $resultado: Cadena que indica el "EXITO" o "ERROR" en la acción.
         * @param type $sql: Datos SQL o adicionales.
         */
        function set_Acceso($usuario, $modulo, $resultado, $sql = "") {
            $fechas = new Fechas();
            $tipo = "ACCEDER";
            $mensaje_exito = "El usuario accedio satisfactoriamente al sistema.";
            $mensaje_error = "Se nego el acceso al sistema.";
            $registro = $this->set_Historia(array(
                "accion" => time(),
                "usuario" => $usuario,
                "modulo" => $modulo,
                "tipo" => $tipo,
                "valor" => $resultado,
                "descripcion" => (($resultado == "EXITO") ? $mensaje_exito : $mensaje_error),
                "fecha" => $fechas->hoy(),
                "hora" => $fechas->ahora(),
                "sql" => $sql
            ));
        }

        /**
         * 
         * @param type $usuario
         * @param type $modulo
         * @param type $resultado
         * @param type $sql
         */
        function set_Salir($usuario, $modulo, $resultado, $sql = "") {
            $tipo = "SALIR";
            $mensaje_exito = "El usuario salio satisfactoriamente del sistema.";
            $mensaje_error = "Se nego salida del sistema.";
            $registro = $this->set_Historia(array(
                "accion" => time(),
                "usuario" => $usuario,
                "modulo" => $modulo,
                "tipo" => $tipo,
                "valor" => $resultado,
                "descripcion" => (($resultado == "EXITO") ? $mensaje_exito : $mensaje_error),
                "fecha" => $this->fechas->hoy(),
                "hora" => $this->fechas->ahora(),
                "sql" => $sql
            ));
        }

        function actualizar($empleado, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `" . $this->tabla . "` SET `" . $campo . "`='" . $valor . "' WHERE `" . $this->indice . "`='" . $empleado . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
        }

        function eliminar($empleado) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `" . $this->tabla . "` WHERE `" . $this->indice . "`='" . $empleado . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
        }

        function tabla_crear() {
            $db = new MySQL(Sesion::getConexion());
            $sql = "CREATE TABLE `usuarios_acciones` (
  `accion` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',
  `usuario` int(10) unsigned zerofill DEFAULT NULL,
  `modulo` int(3) unsigned zerofill DEFAULT '000',
  `tipo` enum('ACCEDER','SALIR','CONSULTAR','CREAR','ACTUALIZAR','ELIMINAR') DEFAULT 'CONSULTAR',
  `valor` enum('EXITO','ERROR') DEFAULT 'ERROR',
  `descripcion` varchar(255) DEFAULT '',
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `sql` text,
  PRIMARY KEY (`accion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    ";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
            return($consulta);
        }

    }

}
//$h=new Historial();
//$h-> set_Acceso("","000","EXITO",$sql="");
?>