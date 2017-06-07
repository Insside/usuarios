<?php


/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 */
/**
 * Description of Usuarios_Empleados
 * La tabla que registra la informacion del usuario, no es la misma tabla que registra el perfil o datos
 * personales del usuario como Empleado que labora en la entidad, esta clase es una versión 
 * resumida que permite recrear y actualizar perfiles de empleado de una forma muy basica en caso
 * de que el sistema creado no disponga acceso o contratación con nuestro software de gestión de 
 * empleados.
 *
 * @author Alexis
 */
if (!class_exists('Usuarios_Perfiles')) {

    class Usuarios_Perfiles {

        var $tabla = "usuarios_perfiles";
        var $indice = "perfil";
        var $sesion;
        var $fechas;
        var $cadenas;

        function Usuarios_Perfiles() {
//            $this->sesion = new Sesion();
//            $this->fechas = new Fechas();
//            $this->cadenas = new Cadenas();
//            $db = new MySQL(Sesion::getConexion());
//            if (!$db->sql_tablaexiste($this->tabla)) {
//                $this->tabla_crear();
//            }
//            $db->sql_close();
        }

        /**
         * Este método permite crear un perfil de datos asignable a un usuario. Los perfiles de usuario 
         * son una de las herramientas más importantes de INSSIDE para la configuración del entorno
         *  de trabajo. Permiten definen un entorno de trabajo personalizado, en el que se incluye la 
         * configuración individual de las notificaciones, entre otros aspectos. Cada usuario debe tener 
         * un perfil asociado a su nombre de usuario.
         * @param type $p es un vector que contine los datos necesarios para la creacion del perfil.
         * @return type retorna el id del perfil creado.
         */
        function crear($p = array()) {
            $perfil = time();
            $db = new MySQL(Sesion::getConexion());
            $sql = "INSERT INTO `usuarios_perfiles` SET "
                    . "`perfil`='" . $p["perfil"] . "',"
                    . "`documento`='" . $p["documento"] . "',"
                    . "`identificacion`='" . $p["identificacion"] . "',"
                    . "`nombres`='" . $p["nombres"] . "',"
                    . "`apellidos`='" . $p["apellidos"] . "',"
                    . "`direccion`='" . $p["direccion"] . "',"
                    . "`telefonos`='" . $p["telefonos"] . "',"
                    . "`correo`='" . $p["correo"] . "',"
                    . "`sexo`='" . $p["sexo"] . "',"
                    . "`foto`='" . $p["foto"] . "',"
                    . "`creado`='" . $p["creado"] . "',"
                    . "`actualizado`='" . $p["actualizado"] . "',"
                    . "`creador`='" . $p["creador"] . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
            echo($sql);
            return($consulta);
        }

        function consultar($perfil) {
            $db = new MySQL(Sesion::getConexion());
            $sql = ""
                    . "SELECT * "
                    . "FROM `usuarios_perfiles` "
                    . "WHERE `perfil` = '" . $perfil . "'";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            //echo($sql);
            return($fila);
        }

        function actualizar($perfil, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `" . $this->tabla . "` SET `" . $campo . "`='" . $valor . "' WHERE `" . $this->indice . "`='" . $perfil . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
        }

        function eliminar($perfil) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `" . $this->tabla . "` WHERE `" . $this->indice . "`='" . $perfil . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
        }

        function tabla_crear() {
            $db = new MySQL(Sesion::getConexion());
            $sql = "CREATE TABLE `usuarios_perfiles` (
        `empleado` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000' COMMENT 'Numero Identificación',
        `documento` enum('CC','CE') DEFAULT 'CC',
        `nombres` varchar(255) NOT NULL DEFAULT '',
        `apellidos` varchar(255) NOT NULL DEFAULT '',
        `direccion` varchar(255) NOT NULL DEFAULT '',
        `telefono` varchar(255) NOT NULL DEFAULT '',
        `correo` varchar(255) NOT NULL DEFAULT '',
        `sexo` enum('M','F') NOT NULL DEFAULT 'M',
        `foto` varchar(255) DEFAULT NULL,
        `creado` date DEFAULT NULL,
        `actualizado` date DEFAULT NULL,
        `creador` varchar(10) DEFAULT NULL,
        PRIMARY KEY (`empleado`)
      ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    ";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
            return($consulta);
        }

        function combo($name, $selected) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `usuarios_perfiles` ORDER BY `nombres` DESC";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $name . '"id="' . $name . '">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<option value="' . $fila['perfil'] . '"' . (($selected == $fila['perfil']) ? "selected" : "") . '>' . $fila['perfil'] . ": " . $fila['nombres'] . " " . $fila['apellidos'] . '</option>');
                $conteo++;
            } $db->sql_close();
            $html .= ("</select>");
            return($html);
        }

        /**
         * Retorna los datos de un usuario proporsionando el correo electronico
         * asociado a un perfil, el valor retornado es un vector.
         * @param type $correo
         * @return type Array
         */
        function correo($correo) {
            $db = new MySQL(Sesion::getConexion());
            $consulta_perfil = $db->sql_query(""
                    . "SELECT * "
                    . "FROM `usuarios_perfiles` "
                    . "WHERE `correo` = '" . $correo . "'");
            $perfil = $db->sql_fetchrow($consulta_perfil);
            $consulta_usuario = $db->sql_query(""
                    . "SELECT * "
                    . "FROM `usuarios_usuarios` "
                    . "WHERE `perfil` = '" . $perfil["perfil"] . "'");
            $usuario = $db->sql_fetchrow($consulta_usuario);
            $db->sql_close();
            return($usuario);
        }

        /**
         * Retorna el listado de criterios aplicables a la busqueda en la tabla
         * de instalaciones.
         * @param type $parametros
         * @return type
         */
        public function getListFilter($parametros = array()) {
            if (is_array($parametros)) {
                $db = new MySQL(Router::getDefaultConexion());
                $sql = "SELECT * FROM `usuarios_perfiles_criterios` ORDER BY `criterio`;";
                $consulta = $db->sql_query($sql);
                $usos = array();
                while ($fila = $db->sql_fetchrow($consulta)) {
                    array_push($usos, $fila);
                }
                return($usos);
            } else {
                echo("Error: Perfiles_Criterios::getList() esperava un vector de parametros.");
            }
        }

    }

}
?>