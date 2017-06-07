<?php
$permisos=new Usuarios_Permisos();
$roles=new Usuarios_Roles();
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

/** Valores **/
$valores=$permisos->consultar($validaciones->recibir("permiso"));
$info="<div class=\"i100x100_permiso\" style=\"float: left;\"></div>"
        . "<div class=\"notificacion\"><p>Un permiso es una propiedad que "
        . "tiene o no tiene el rol que desempeña un usuario, mediante esta propiedad se garantiza el "
        . "acceso a la utilización de un determinado recurso o función efectuada "
        . "por un módulo y/o sus componentes, la existencia del permiso en instancia garantiza el acceso, "
        . "su ausencia niega la utilización o acceso a cualquier funcionalidad otorgada por el mismo. "
        . "También se le recuerda que los permisos no se crean ni se destruyen por parte de los "
        . "administradores del sistema, estos son creados y redefinidos en la programación de los "
        . "diversos módulos y su utilización se limita a su asignación a uno o varios roles, para su "
        . "utilización.</p></div>";
/** Campos **/
$f->campos['modulo']=$f->campo("modulo",$valores['modulo']);
$f->campos['permiso']=$f->campo("permiso",$valores['permiso']);
$f->campos['nombre']=$f->campo("nombre",$valores['nombre']);
$f->campos['descripcion']="<p><b>".$valores['nombre']."</b>: ".$valores['descripcion']."</p>";
$f->campos['fecha']=$f->campo("fecha",$valores['fecha']);
$f->campos['hora']=$f->campo("hora",$valores['hora']);
$f->campos['creador']=$f->campo("creador",$valores['creador']);
$f->campos['ayuda']=$f->button("ayuda".$f->id, "button","Ayuda");
$f->campos['cerrar']=$f->button("cerrar".$f->id, "button","Cerrar");
/** Celdas **/
$f->celdas["info"]=$f->celda("",$info);
$f->celdas["modulo"]=$f->celda("Modulo:",$f->campos['modulo']);
$f->celdas["permiso"]=$f->celda("Permiso:",$f->campos['permiso']);
$f->celdas["nombre"]=$f->celda("Nombre:",$f->campos['nombre']);
$f->celdas["descripcion"]=$f->celda("",$f->campos['descripcion']);
$f->celdas["fecha"]=$f->celda("Fecha:",$f->campos['fecha']);
$f->celdas["hora"]=$f->celda("Hora:",$f->campos['hora']);
$f->celdas["creador"]=$f->celda("Creador:",$f->campos['creador']);
/** Filas **/
$f->fila["fila0"]=$f->fila($f->celdas["info"]);
$f->fila["fila1"]=$f->fila($f->celdas["modulo"].$f->celdas["permiso"]);
$f->fila["fila2"]="<h2>Descripción General</h2>";
$f->fila["fila3"]=$f->fila($f->celdas["descripcion"]);
$f->fila["fila4"]="<h2>Creación del Permiso</h2>";
$f->fila["fila5"]=$f->fila($f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
$f->fila["fila6"]="<h2>Roles Asociados</h2>";
$f->fila["fila7"]=$permisos->politicas($valores['permiso']);
/** Compilando **/
$f->fila["informacion"]=$f->fila["fila0"].$f->fila["fila1"].$f->fila["fila2"].$f->fila["fila3"];
$f->fila["trazabilidad"]=$f->fila["fila4"].$f->fila["fila5"].$f->fila["fila6"].$f->fila["fila7"];   

$f->fila["tabs"]=""
        . "<ul id=\"tabs\" class=\"TabbedPane\">"
        . "<li><a class=\"tab\" href=\"#\" id=\"one\">Información</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"two\">Trazabilidad</a></li>"
        ."</ul>";
$f->fila["home"]=""
        . "<div id=\"home\">"
        . "<div class=\"feature\">".$f->fila["informacion"]."</div>"
        . "<div class=\"feature\">".$f->fila["trazabilidad"]."</div>"
        ."</div>";
/** Compilando **/
$f->filas($f->fila['tabs']);
$f->filas($f->fila['home']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cerrar'], "inferior-derecha");
/** JavaScript * */
$f->JavaScript("var tabs = new MUI.TabbedPane(('.tab','.feature',{autoplay: false,transitionDuration:500,slideInterval:3000,hover:true});");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Permiso - ".$valores['nombre']."\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 640, height: 450});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cerrar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
