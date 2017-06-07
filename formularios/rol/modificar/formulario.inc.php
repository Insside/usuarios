<?php
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
/** Variables **/
$usuario=Sesion::usuario();
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$rol=$roles->consultar($validaciones->recibir("rol"));
/** Valores **/
$itable=$validaciones->recibir("itable");
$valores=$rol;
$valores['creador']=$usuario['usuario'];
$html="<div class=\"i100x100_modificar\" style=\"float: left;\"></div>";
$html.="<div class=\"notificacion\"><p><b>Recuerde</b>: "
        . "El presente formulario le permitirá modificar el nombre y descripción formal de un Rol, se "
        . "le recuerda que la modificación de estas características descriptivas no afecta los permisos "
        . "que le hayan sido previamente otorgados, para modificar los permisos asignados al Rol "
        . "presione el botón “Permisos” en la parte inferior de este mensaje.</p></div>";
/** Campos **/
$f->oculto("itable",$itable);
$f->campos['rol']=$f->text("rol",$valores['rol'], "10","required codigo", true);
$f->campos['nombre']=$f->text("nombre",$valores['nombre'], "32","", false);
$f->campos['descripcion']=$f->textarea("descripcion",$valores['descripcion'], "h150 required",25,80,true);
$f->campos['fecha']=$f->text("fecha",$valores['fecha'], "10","required automatico", true);
$f->campos['hora']=$f->text("hora",$valores['hora'], "8","required automatico", true);
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","required automatico", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['permisos'] = $f->button("permisos". $f->id, "button","Permisos");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Modificar");
/** Celdas **/
$f->celdas['info']=$f->celda("",$html,"","notificacion");
$f->celdas["rol"] = $f->celda("Rol:", $f->campos['rol']);
$f->celdas["nombre"] = $f->celda("Nombre:", $f->campos['nombre']);
$f->celdas["descripcion"] = $f->celda("Descripción del Rol / Función:", $f->campos['descripcion']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas **/
$f->fila["info"]=$f->fila($f->celdas['info'],"notificacion");
$f->fila["f1"] = $f->fila($f->celdas["rol"].$f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
$f->fila["f2"] = $f->fila($f->celdas["nombre"]);
$f->fila["f3"] = $f->fila($f->celdas["descripcion"]);
/** Compilando **/
$f->filas($f->fila['info']);
$f->filas($f->fila['f1']);
$f->filas($f->fila['f2']);
$f->filas($f->fila['f3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['permisos'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");

/** JavaScript * */
$f->eClick("permisos" . $f->id,"MUI.Usuarios_Rol_Politicas_Modificar('".$rol['rol']."','$itable');MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Modificar Rol - ".$rol['nombre']."\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 480, height: 410});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
