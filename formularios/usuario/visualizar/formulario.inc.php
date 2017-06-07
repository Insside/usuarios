<?php

/*
 * Copyright (c) 2014, Alexis
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
/** Variables * */
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$sesion = new Sesion();
$usuarios = new Usuarios();
/** Valores * */
$itable = $validaciones->recibir("itable");
$v = $usuarios->consultar($validaciones->recibir("usuario"));
/** Campos * */
$f->oculto("itable", $itable);
$f->oculto("usuario", $v['usuario']);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "button", "Modificar");
require_once($ROOT . "modulos/usuarios/formularios/usuario/visualizar/segmentos/informacion.inc.php");
require_once($ROOT . "modulos/usuarios/formularios/usuario/visualizar/segmentos/roles.inc.php");
require_once($ROOT . "modulos/usuarios/formularios/usuario/visualizar/segmentos/historial.inc.php");
require_once($ROOT . "modulos/usuarios/formularios/usuario/visualizar/segmentos/creador.inc.php");
/** Tabs * */
/** <TabbedPane> **/
$tp = new TabbedPane(array("pagesHeight" => "410px"));
$tp->addTab("Información",null, $f->fila["informacion"]);
$tp->addTab("Roles", null, $f->fila["roles"]);
$tp->addTab("Historial",null, $f->fila["historial"]);
$tp->addTab("Creador",null, $f->fila["creador"]);
/** Compilando * */
$f->filas($tp->getPane());
/** </TabbedPane> **/
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['modificar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaScript * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Usuario " . $v['usuario'] . " " . $v['alias'] . "\");");
//$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width:640, height: 480});");
$f->JavaScript("MUI.windowAutoResize($('" . $f->ventana . "'));");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("modificar" . $f->id, "MUI.Usuarios_Usuario_Modificar('" . $v["usuario"] . "','" . $itable . "');MUI.closeWindow($('" . $f->ventana . "'));");
?>