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
/** Valores **/
$itable=$validaciones->recibir("itable");
$valores['rol']=time();
$valores['nombre']=$validaciones->recibir("_nombre");
$valores['descripcion']=$validaciones->recibir("_descripcion");
$valores['fecha']=$fechas->hoy();
$valores['hora']=$fechas->ahora();
$valores['creador']=$usuario["usuario"];
$html="<div class=\"i100x100_rol\" style=\"float: left;\"></div>";
$html.="<div class=\"notificacion\"><p>";
$html.="Todos los usuarios están sujetos a las reglas de permisos a la hora de trabajar en un "
        . "sistema informático. Un Rol agrupa una serie de permisos que en esencia definen las "
        . "funciones de un usuario en el sistema, esta política es utilizada generalmente para poder "
        . "rotar la funciones informáticas y reales de un empleado de la empresa u entidad en la medida "
        . "que este desempeña diferentes cargos reales en la misma, o incluso poder asignar sus "
        . "funciones a quien lo remplaza al momento de la rotación de los cargos, periodo vacaciones "
        . "y similares, este formulario le permitira crear un rol en blanco al cual luego podra asignarle "
        . "los permisos que estime convenientes segun su criterio y propositos.";
$html.="</p></div>";
/** Campos **/
$f->oculto("itable",$itable);
$f->campos['rol']=$f->text("rol",$valores['rol'], "10","required codigo", true);
$f->campos['nombre']=$f->text("nombre",$valores['nombre'], "32","", false);
$f->campos['descripcion']=$f->textarea("descripcion",$valores['descripcion'], "h150 required",25,80,true);
$f->campos['fecha']=$f->text("fecha",$valores['fecha'], "10","required automatico", true);
$f->campos['hora']=$f->text("hora",$valores['hora'], "8","required automatico", true);
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","required automatico", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Registrar");
/** Celdas **/
$f->celdas['info']=$f->celda("",$html,"","notificacion");
$f->celdas["rol"] = $f->celda("Rol:", $f->campos['rol'],"","w100px");
$f->celdas["nombre"] = $f->celda("Nombre Representativo:", $f->campos['nombre']);
$f->celdas["descripcion"] = $f->celda("Descripción / Utilidad:", $f->campos['descripcion']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas **/
$f->fila["info"]=$f->fila($f->celdas['info'],"notificacion");
$f->fila["f1"] = $f->fila($f->celdas["rol"].$f->celdas["nombre"]);
$f->fila["f2"] = $f->fila($f->celdas["descripcion"]);
$f->fila["f3"] = $f->fila($f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
/** Compilando **/
$f->filas($f->fila['info']);
$f->filas($f->fila['f1']);
$f->filas($f->fila['f2']);
$f->filas($f->fila['f3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['continuar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaScript * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Nuevo Rol\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width:640, height: 440});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
