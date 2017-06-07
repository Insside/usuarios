<?php
if (!class_exists('Usuarios_Politicas')) {

    class Usuarios_Politicas {

        function crear($rol, $permiso, $creador) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "INSERT INTO `usuarios_politicas` SET `permiso`='" . $permiso . "', `rol`='" . $rol . "',`creador`='" . $creador . "',`fecha`='" . date('Y-m-d', time()) . "',`hora`='" . date('H:i:s', time()) . "';";
            $consulta = $db->sql_query($sql);
            echo($sql);
            $db->sql_close();
        }

        /**
         * Permite verificar si un determinado rol tiene o no asignado un permiso en sus politicas
         * @param type $rol
         * @param type $permiso
         */
        function consultar($rol, $permiso) {
            $db = new MySQL(Sesion::getConexion());
            $sql = ""
                    . "SELECT * "
                    . "FROM `usuarios_politicas` "
                    . "WHERE(`rol`='" . $rol . "' AND `permiso`='" . $permiso . "')"
                    . "ORDER BY `rol`,`permiso`"
                    . ";";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        function conteo($rol) {
            $db = new MySQL(Sesion::getConexion());
            $sql = ("SELECT Count(*) AS `conteo`, `usuarios_politicas`.`rol` FROM `usuarios_politicas` INNER JOIN `usuarios_roles` ON `usuarios_politicas`.`rol` = `usuarios_roles`.`rol` WHERE `usuarios_roles`.`rol`='" . $rol . "'; ");
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila['conteo']);
        }

        function estado($rol, $permiso) {
            $db = new MySQL(Sesion::getConexion());
            $sql = ("SELECT * FROM `usuarios_politicas` WHERE `rol`='" . $rol . "' AND `permiso`='" . $permiso . "' ;");
            $consulta = $db->sql_query($sql);
            if ($db->sql_numrows($consulta) == 0) {
                $resultado = false;
            } else {
                $resultado = true;
            };
            $db->sql_close();
            return($resultado);
        }

        function asignar($rol, $permisos, $creador) {
            $this->eliminar($rol);
            for ($i = 0; $i < count($permisos); $i++) {
                $permiso = $permisos[$i];
                $this->crear($rol, $permiso, $creador);
            }
        }
        /**
         * Borra todas las politicas asociadas a un rol.
         * @param type $rol
         */
        function eliminar($rol) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `usuarios_politicas` WHERE `rol`='" . $rol . "';";
            $consulta = $db->sql_query($sql);
            $db->sql_close();
        }

        function inicializar() {
            $sql = "create table politicas(rol char(32) not null,permiso char(32) not null,fecha date,hora time,creador char(11),primary key (rol, permiso));";
            $db = new MySQL(Sesion::getConexion());
            if (!$db->sql_tablaexiste("politicas")) {
                $consulta = $db->sql_query($sql);
            }$db->sql_close();
        }

        /**
         * Se define por politica al conjunto de todos los permisos asignados a un rol, este metodo
         * retorna un vector que contiene todos los permisos referenciados.
         * @param type $rol
         * @return type
         */
        function politica($rol) {
            $politica = array();
            $db = new MySQL(Sesion::getConexion());
            $sql = ("SELECT * FROM `usuarios_politicas` WHERE(`rol`='" . $rol . "');");
            $consulta = $db->sql_query($sql);
            while ($fila = $db->sql_fetchrow($consulta)) {
                array_push($politica, $fila);
            }
            $db->sql_close();
            return($politica);
        }

    }

}
?>