<?php
$validaciones=new Validaciones();
$fechas=new Fechas();
/* 
 * Copyright (c) 2016, Alexis
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
$uu=new Usuarios();
$up=new Usuarios_Perfiles();
//print_r($_REQUEST);
$correo=$validaciones->recibir("correo");
$u=$up->correo($correo);
$token=$uu->token($u["usuario"]);
echo($correo);
$c=new Correo();
$c->destinatario=$correo;
$c->mensaje="Su código de acceso es:<br><b>".$token."</b>";
$c->Componer();
$c->enviar();




$v = array();
$v['info'] = "<p>Por favor verifique el buzón de mensajes de su correo electrónico, en el encontrará un código que le permitirá acceder al sistema y modificar su contraseña. Copie el código e ingréselo en la casilla disponible en la parte inferior de este mensaje, luego presione continuar.</p>";
if (!isset($v['foto']) || empty($v['foto'])) {
    $v['foto'] = "modulos/usuarios/imagenes/usuario.fw.png";
}
/** Campos * */
$f->oculto("itable", $validaciones->recibir("itable"));
$f->campos['info'] = $v['info'];
$f->campos['foto'] = "<img src=\"" . $v['foto'] . "\" width=\"200\" height=\"267\"/>";
$f->campos['correo'] = $f->textarea("token","",""); 
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "submit", "Continuar");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
/** Celdas * */
$f->celdas["info"] = $f->celda("<b>Instrucciones</b> ", $f->campos['info']);
$f->celdas["correo"] = $f->celda("Código de Acceso (Token):", $f->campos['correo']);

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




/** JavaScripts **/
//$f->windowClose();
//$f->JavaScript("if(".$itable."){".$itable.".refresh();}");
?>