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
 * Description of Equipos
 *
 * @author Alexis
 */
if (!class_exists('Usuarios_Equipos')) {

    class Usuarios_Equipos {

        function combo($name, $selected) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `usuarios_equipos` ORDER BY `nombre` ASC";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $name . '"id="' . $name . '">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html.=('<option value="' . $fila['equipo'] . '"' . (($selected == $fila['equipo']) ? "selected" : "") . '>' . $fila['nombre'] . '</option>');
                $conteo++;
            } $db->sql_close();
            $html.=("</select>");
            return($html);
        }

        function combo_electoral($name, $selected) {
            $cadenas = new Cadenas();
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * "
                    . "FROM `preelectoral_candidatos` "
                    . "WHERE `departamento` = 'VALLE' AND `municipio` = 'BUGA' "
                    . "ORDER BY `nombre_1`,`nombre_2`,`apellido_1`,`apellido_2`";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $name . '"id="' . $name . '">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $fila['nombre'] = $cadenas->capitalizar($fila['nombre_1'] . " " . $fila['nombre_2'] . " " . $fila['apellido_1'] . " " . $fila['apellido_2'] . " - " . $fila['candidato']);
                $html.=('<option value="' . $fila['candidato'] . '"' . (($selected == $fila['equipo']) ? "selected" : "") . '>' . $fila['nombre'] . '</option>');
                $conteo++;
            } $db->sql_close();
            $html.=("</select>");
            return($html);
        }

        function consultar($equipo) {
            $db = new MySQL(Sesion::getConexion());
            $consulta = $db->sql_query("SELECT * FROM `usuarios_equipos` WHERE `equipo`='" . $equipo . "' ;");
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

    }

}
?>