<?php
if (!class_exists("Usuarios_Permisos")) {

    class Usuarios_Permisos {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `aplicacion_permisos` SET "
                        . "`modulo`='" . $datos['modulo'] . "',"
                        . "`permiso`='" . $datos['permiso'] . "',"
                        . "`nombre`='" . $datos['nombre'] . "',"
                        . "`descripcion`='" . $datos['descripcion'] . "',"
                        . "`fecha`='" . $datos['fecha'] . "',"
                        . "`hora`='" . $datos['hora'] . "',"
                        . "`creador`='" . $datos['creador'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Aplicacion_Permisos::crear se esperaba un vector.");
            }
        }

        public function actualizar($modulo, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `aplicacion_permisos` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `modulo`='" . $modulo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($modulo) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `aplicacion_permisos` "
                    . "WHERE `modulo`='" . $modulo . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($modulo) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_permisos` "
                    . "WHERE `modulo`='" . $modulo . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        function inicializar() {
            $sql = "create table permisos(permiso char(32) not null,descripcion blob not null,fecha date not null,hora time not null,creador char(11),primary key(permiso));";
            $db = new MySQL(Sesion::getConexion());
            if (!$db->sql_tablaexiste("permisos")) {
                $db->sql_query($sql);
            }$db->sql_close();
        }

        //\\//\\//\\//\\//\\//\\ Estadisticas & Conteos //\\//\\//\\//\\//\\//\\
        function conteo() {
            $db = new MySQL(Sesion::getConexion());
            $consulta = $db->sql_query("SELECT Count(*) AS `conteo` FROM `aplicacion_permisos`;");
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila['conteo']);
        }

        function combo($name, $selected) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `aplicacion_permisos` ORDER BY `modulo`,`permiso` DESC";
            $consulta = $db->sql_query($sql);
            $html = ('<select name="' . $name . '"id="' . $name . '">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<option value="' . $fila['permiso'] . '"' . (($selected == $fila['permiso']) ? "selected" : "") . '>' . $fila['modulo'] . ": " . $fila['permiso'] . '</option>');
                $conteo++;
            } $db->sql_close();
            $html .= ("</select>");
            return($html);
        }

        function politicas($permiso) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT  `usuarios_politicas`.`rol`,`usuarios_roles`.`nombre` ";
            $sql .= "FROM `usuarios_roles`";
            $sql .= "INNER JOIN `usuarios_politicas` ON `usuarios_politicas`.`rol` = `usuarios_roles`.`rol` ";
            $sql .= "WHERE `permiso` = '" . $permiso . "' ";
            $sql .= "GROUP BY `usuarios_politicas`.`rol`,`usuarios_roles`.`nombre`; ";
            $consulta = $db->sql_query($sql);
            $html = ('<p style="padding-left: 10px !important;">');
            $conteo = 0;
            while ($fila = $db->sql_fetchrow($consulta)) {
                $html .= ('<br><b><a href="#" onClick="MUI.Usuarios_Roles_Rol_Permisos(\'' . $fila['rol'] . '\');">' . $fila['rol'] . '</a></b>: ' . $fila['nombre'] . '');
                $conteo++;
            } $db->sql_close();
            $html .= ("</p>");
            return($html);
        }

    }

} 
?>