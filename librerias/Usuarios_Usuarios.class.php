<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios_Usuario
 *
 * @author Insside
 */
if (!class_exists("Usuarios_Usuarios")) {

    class Usuarios_Usuarios {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `usuarios_usuarios` SET "
                        . "`usuario`='" . $datos['usuario'] . "',"
                        . "`perfil`='" . $datos['perfil'] . "',"
                        . "`alias`='" . $datos['alias'] . "',"
                        . "`clave`='" . $datos['clave'] . "',"
                        . "`token`='" . $datos['token'] . "',"
                        . "`equipo`='" . $datos['equipo'] . "',"
                        . "`fecha`='" . $datos['fecha'] . "',"
                        . "`hora`='" . $datos['hora'] . "',"
                        . "`creador`='" . $datos['creador'] . "',"
                        . "`estado`='" . $datos['estado'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Usuarios_Usuarios::crear se esperaba un vector.");
            }
        }

        public function actualizar($usuario, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `usuarios_usuarios` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `usuario`='" . $usuario . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($usuario) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `usuarios_usuarios` WHERE `usuario`='" . $usuario . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($usuario) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `usuarios_usuarios` WHERE `usuario`='" . $usuario . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

        /**
         * Este metodo consulta si el permiso especificado le ha sido asignado al usuario
         * en alguno de los roles que desempeña, si el permiso existe retornara verdadero
         * de lo contrario retornara falso.
         * @param type $permiso
         * @param type $usuario
         * @return type
         */
        function permiso($permiso, $usuario) {
            $politicas = new Usuarios_Politicas();
            $jerarquias = new Usuarios_Jerarquias();
            $roles = $jerarquias->consultar($usuario);
            foreach ($roles as $rol) {
                $asignado = $politicas->consultar($rol['rol'], $permiso);
                if (!empty($asignado['permiso'])) {
                    return(true);
                }
            }
            return(false);
        }

    }

}
