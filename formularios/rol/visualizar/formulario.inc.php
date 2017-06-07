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
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$sesion=new Sesion();
$ur=new Usuarios_Roles();
$up=new Usuarios_Politicas();
/** Valores **/
$itable=$validaciones->recibir("itable");
$rol=$validaciones->recibir("rol");
$v=$ur->consultar($rol);
/** Campos **/
$f->oculto("itable",$itable);
$f->oculto("rol",$v['rol']);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cerrar");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "button","Modificar");
$f->campos['permisos'] = $f->button("permisos" . $f->id, "button","Permisos");

require_once($ROOT."modulos/usuarios/formularios/rol/visualizar/segmentos/informacion.inc.php");
require_once($ROOT."modulos/usuarios/formularios/rol/visualizar/segmentos/permisos.inc.php");
require_once($ROOT."modulos/usuarios/formularios/rol/visualizar/segmentos/creador.inc.php");
/** Tabs **/
$f->fila["tabs"]=""
        . "<ul id=\"tabs\ class=\"TabbedPane\">"
        . "<li><a class=\"tab\" href=\"#\" id=\"one\">Información</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"two\">Permisos Asociados</a></li>"
         . "<li><a class=\"tab\" href=\"#\" id=\"two\">Creador</a></li>"
        ."</ul>";
$f->fila["home"]=""
        . "<div id=\"home\">"
        . "<div class=\"feature\">".$f->fila["informacion"]."</div>"
        . "<div class=\"feature\">".$f->fila["permisos"]."</div>"
        . "<div class=\"feature\">".$f->fila["creador"]."</div>"
        ."</div>";
/** Compilando **/
$f->filas($f->fila['tabs']);
$f->filas($f->fila['home']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['permisos'], "inferior-derecha");
$f->botones($f->campos['modificar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaScript * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Rol ".$v['rol']." ".$v['nombre']."\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width:640, height: 370});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("modificar" . $f->id, "MUI.Usuarios_Rol_Modificar('$rol','$itable');MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("permisos" . $f->id, "MUI.Usuarios_Rol_Politicas_Modificar('$rol','$itable');MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("var tabs".$f->id."= new MUI.TabbedPane(('.tab','.feature',{autoplay: false,transitionDuration:500,slideInterval:3000,hover:true});");
?>