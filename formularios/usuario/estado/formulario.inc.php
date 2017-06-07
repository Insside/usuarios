<?php
/** Variables **/
$sesion=new Sesion();
$cadenas = new Cadenas();
$fechas = new Fechas();
$validaciones = new Validaciones();
$perfils=new Usuarios_Perfiles();
$equipos=new Usuarios_Equipos();
$usuarios=new Usuarios();
/************************************************************************
 * Copyright (c) 2015, Alexis
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
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
 ***********************************************************************/
$um=new Usuarios_Modulo();
$empresa=Sesion::getValue("empresa");
$modulo= $um->getModulo();
$uu=new Usuarios_Usuario($validaciones->recibir("usuario"));
$up=new Usuarios_Perfil($uu->getPerfil());
/** Valores **/





$v['info'] = "<p>Este formulario le permitirá activar o deshabilitar un usuario, una cuenta deshabilitada no tendrá permitido acceder al sistema, cambie el estado según corresponda con sus propósitos. Es usual deshabilitar todos aquellos usuarios que no realizaran más labores en el sistema.</p>";
if (!isset($v['foto']) || empty($v['foto'])) {
  $v['foto'] = "modulos/usuarios/imagenes/usuario.fw.png";
}
/** Campos **/
$f->oculto("itable",$validaciones->recibir("itable")); 
$f->oculto("usuario",$uu->getUsuario()); 

$f->campos['info'] = $v['info'];
$f->campos['foto'] = "<div><img id=\"photo{$f->id}\" src=\"archivos/imagen.php?time={$f->id}&image={$empresa}/{$modulo}/" . $up->getFoto(). "&width=240&height=320\"/></div>";
$f->campos['estado'] =$usuarios->combo_estado("estado",$uu->getEstado(),"");
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Modificar");
/** Celdas **/
$f->celdas["info"] = $f->celda("", $f->campos['info']);
$f->celdas["foto"] = $f->celda("", $f->campos['foto'], "", "w200");
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** Filas **/
$f->fila['sf1'] = $f->fila($f->celdas["info"]);
$f->fila['sf2'] = $f->fila($f->celdas["estado"]);
/** Subceldas **/
$f->celdas["foto"] = $f->celda("", $f->campos['foto'], "", "w200");
$f->celdas["datos"] = $f->celda("", $f->fila['sf1'] . $f->fila['sf2']);
/** Filas * */
$f->fila["f1"] = $f->fila($f->celdas["foto"] . $f->celdas["datos"]);
/** Compilando **/
$f->filas($f->fila['f1']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['continuar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** Javascripts **/
//MUI.Usuarios_Usuario_Roles
$f->windowTitle("Activar / Deshabilitar / {$uu->getAlias()}","1.2");
$f->windowResize(array("autoresize"=>false,"width"=>"480","height"=>"390"));
$f->windowCenter();
$f->eClick("roles" . $f->id, "MUI.Usuarios_Usuario_Roles('".$uu->getUsuario()."');MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>