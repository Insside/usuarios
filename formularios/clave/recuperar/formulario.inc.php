<?php

$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
require_once($ROOT . "librerias/Componentes.class.php");

$usuarios = new Usuarios();
$cadenas = new Cadenas();
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

$v = array();
$v['info'] = "<p>Ingresa la dirección de correo electrónico y te ayudaremos a recuperar tu cuenta. Si eres usuario de este sistema y tu usuario coincide con la dirección de correo electrónico con la que te registraste o registraron para utilizar este aplicativo te guiaremos por una serie de preguntas para verificar tu identidad. Si la dirección de correo electrónico o el número de teléfono están debidamente registrados en tu perfil, se te enviara un código. Si no lo has hecho, deberás solicitar al personal encargado de la administración del aplicativo que lo haga o que en efecto te concedan una nueva contraseña de acceso. Ingresa tu dirección de correo electrónico y presiona <u><i>continuar</i></u>. </p>";
if (!isset($v['foto']) || empty($v['foto'])) {
    $v['foto'] = "modulos/usuarios/imagenes/usuario.fw.png";
}
/** Campos * */
$f->oculto("itable", $validaciones->recibir("itable"));
$f->campos['info'] = $v['info'];
$f->campos['foto'] = "<img src=\"" . $v['foto'] . "\" width=\"200\" height=\"267\"/>";
$f->campos['correo'] = $f->iTextBox("correo","correo","","required","128"); 
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "submit", "Continuar");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
/** Celdas * */
$f->celdas["info"] = $f->celda("<b>¿Olvidaste tu contraseña?</b> ", $f->campos['info']);
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);

/** Filas * */
$f->fila['sf1'] = $f->fila($f->celdas["info"]);
$f->fila['sf2'] = $f->fila($f->celdas["correo"]);
/** Subceldas * */
$f->celdas["foto"] = $f->celda("", $f->campos['foto'], "", "w200");
$f->celdas["datos"] = $f->celda("", $f->fila['sf1'] . $f->fila['sf2'] );
/** Filas * */
$f->fila["f1"] = $f->fila($f->celdas["foto"] . $f->celdas["datos"]);
/** Compilando * */
$f->filas($f->fila['f1']);
/** Botones * */
$f->botones($f->campos["ayuda"], "inferior-izquierda");
$f->botones($f->campos["modificar"], "inferior-derecha");
$f->botones($f->campos["cancelar"], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'),\"Ayuda: Recuperar Contraseña <span style=\'color:#47639E;\'>v1.0</span>\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'),{width: 640,height:390});");
//$f->JavaScript("MUI.centerWindow($('".$f->ventana."'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
//$f->eClick("modificar".$f->id,"MUI.Usuarios_Usuario_Perfil_Modificar();");
?>
