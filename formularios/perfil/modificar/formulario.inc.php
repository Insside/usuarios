<?php

$usuarios = new Usuarios();
$cadenas = new Cadenas();
$equipos = new Usuarios_Equipos();
/*
 * Copyright (c) 2015, Alexis
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
$usuario = Sesion::usuario();
$transaccion = $validaciones->recibir("transaccion");
$perfil = $usuarios->perfil($validaciones->recibir("perfil"));
$equipo = $equipos->consultar($usuario['equipo']);
$componentes=new Componentes();
if (!isset($perfil['foto']) || empty($perfil['foto'])) {
  $perfil['foto'] = "modulos/usuarios/imagenes/usuario.fw.png";
}

$perfil['nombre'] = $cadenas->capitalizar($perfil['nombres'] . " " . $perfil['apellidos']);
$perfil['info'] = "<p>Este formulario le permitirá modificar  la información de un perfil, si la información que desea modificar no es accesible mediante este formulario contacte al departamento de sistemas.</p>";


$_path= dirname(__FILE__);
require_once($_path."/includes/campos.inc.php");
require_once($_path."/includes/celdas.inc.php");
require_once($_path."/includes/perfil.inc.php");
require_once($_path."/includes/direccion.inc.php");
require_once($_path."/includes/telefonos.inc.php");
require_once($_path."/includes/correo.inc.php");
/** Compilando * */
/** <TabbedPane> **/
$tp = new TabbedPane(["pagesHeight" => "300px"]);
$tp->addTab("Perfil",null, $f->fila["perfil"]);
$tp->addTab("Dirección",null, $f->fila["direccion"]);
$tp->addTab("Teléfonos",null, $f->fila["telefonos"]);
$tp->addTab("Correo",null, $f->fila["correo"]);
/** Compilando * */
$f->filas($tp->getPane());
/** </TabbedPane> **/
/** Botones * */
$f->botones($f->campos["ayuda"], "inferior-izquierda");
$f->botones($f->campos["modificar"], "inferior-derecha");
$f->botones($f->campos["cancelar"], "inferior-derecha");
/** JavaScripts * */
$f->windowTitle("Perfil Personal/{$perfil['nombre']}","1.2");
$f->windowResize(["autoresize"=>false,"width"=>"640","height"=>"400"]);
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
//$f->eClick("modificar".$f->id,"MUI.Usuarios_Usuario_Perfil_Modificar();");
?>
