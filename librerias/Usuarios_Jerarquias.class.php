<?php
/**
 * @package Insside
 * @subpackage Usuarios
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @copyright (c) 2015 www.insside.com
 *  Jeraquias v1.0 2014-03-16 01:45 p.m.
 *  Se define como jerarquía al criterio que permite establecer un orden de superioridad o de subordinación entre 
 *  personas, esta constituido conceptualmente en el sistema como el conjunto de todos los roles posibles y 
 *  asignados a un usuario en el sistema. A mayor cantitad de roles mayor el nivel de jerarquia. La gerarquia es 
 * la consulta, asignacion y actualización de los roles asignados aun usuario especifico en referencia a sus 
 * funciones en el sistema, secuencialmente cada rol aporta una carga de privilegios  variable que define su 
 * postura ante los diferentes componentes y modulos del sistema.
 * 
 * */
if (!class_exists('Usuarios_Jerarquias')) {

  class Usuarios_Jerarquias {

    function asignar($usuario, $roles, $creador) {
      $this->eliminar($usuario);
      for ($i = 0; $i < count($roles); $i++) {
        $rol = $roles[$i];
        $this->crear($usuario, $rol, $creador);
      }
    }

    function crear($usuario, $rol, $creador) {
      $db = new MySQL(Sesion::getConexion());
      $sql = "INSERT INTO `usuarios_jerarquias` SET `usuario`='" . $usuario . "', `rol`='" . $rol . "',`creador`='" . $creador . "',`fecha`='" . date('Y-m-d', time()) . "',`hora`='" . date('H:i:s', time()) . "';";
      $consulta = $db->sql_query($sql);
      $db->sql_close();
    }

    /**
     * Metodo: Consulta
     * Consultar la gerarquia de un usuario es obtener el listado de roles asignados al mismo, como vector 
     * contemplativo de sus funciones en el sistema. El resultado de la ejecucion de este metodo en la presente 
     * clase es el vector de todos roles contenidos en la base de datos especificamente en la tabla <<usuarios_jerarquias>>
     * @param type $usuario
     */
    function consultar($usuario) {
      $db = new MySQL(Sesion::getConexion());
      $consulta = $db->sql_query("SELECT * FROM `usuarios_jerarquias` WHERE `usuario`='" . $usuario . "' ;");
      $filas = array();
      while ($fila = $db->sql_fetchrow($consulta)) {
        array_push($filas, $fila);
      }
      $db->sql_close();
      return($filas);
    }

    function eliminar($usuario) {
      $db = new MySQL(Sesion::getConexion());
      $sql = "DELETE FROM `usuarios_jerarquias` WHERE `usuario`='" . $usuario . "';";
      $consulta = $db->sql_query($sql);
      $db->sql_close();
    }

    function usuario($usuario) {
      $db = new MySQL(Sesion::getConexion());
      $sql = "SELECT * FROM `usuarios_jerarquias` WHERE `usuario`='" . $usuario . "' ;";
      $consulta = $db->sql_query($sql);
      $conteo = 0;
      while ($fila = $db->sql_fetchrow($consulta)) {
        $filas[$conteo] = $fila;
        $conteo++;
      }$db->sql_close();
      if (isset($filas)) {
        return($filas);
      }
    }

    function estado($rol, $usuario) {
      $db = new MySQL(Sesion::getConexion());
      $sql = ("SELECT * FROM `usuarios_jerarquias` WHERE `rol`='" . $rol . "' AND `usuario`='" . $usuario . "' ;");
      $consulta = $db->sql_query($sql);
      if ($db->sql_numrows($consulta) == 0) {
        $resultado = false;
      } else {
        $resultado = true;
      };
      $db->sql_close();
      return($resultado);
    }

    function inicializar() {
      $sql = "create table jerarquias(usuario char(11) not null,rol char(32) not null,fecha date not null,hora time not null,creador char(11) not null,primary key (usuario, rol));";
      $db = new MySQL(Sesion::getConexion());
      if (!$db->sql_tablaexiste("jerarquias")) {
        $consulta = $db->sql_query($sql);
      }$db->sql_close();
    }

  }

}
?>