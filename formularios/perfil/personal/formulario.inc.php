<?php
$usuarios = new Usuarios();
$cadenas = new Cadenas();
$equipos=new Usuarios_Equipos();
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
$transaccion = $validaciones->recibir("transaccion");
$usuario = Sesion::usuario(); 
$perfil = $usuarios->perfil($usuario['perfil']);
$equipo=$equipos->consultar($usuario['equipo']);
$um=new Usuarios_Modulo();
$empresa=Sesion::getValue("empresa");
$modulo= $um->getModulo();

if (!isset($perfil['foto']) || empty($perfil['foto'])) {
  $perfil['foto'] = "modulos/usuarios/imagenes/usuario.fw.png";
}
$perfil['nombre'] = $cadenas->capitalizar($perfil['nombres'] . " " . $perfil['apellidos']);
$perfil['info'] = "<p>Este formulario le permitirá modificar parcialmente la información de su perfil personal y realizar el cambio de contraseña, si la información que desea modificar no es accesible mediante este formulario contacte al departamento de sistemas.</p>";


/** Campos * */
$f->campos['info'] = $perfil['info'];
$f->campos['equipo'] = $f->campo("equipo", $equipo['equipo'].": ".$equipo['nombre']);
$f->campos['perfil'] = $f->campo("perfil", $perfil['perfil']);
$f->campos['nombres'] = $f->campo("nombres", $perfil['nombres']);
$f->campos['apellidos'] = $f->campo("apellidos", $perfil['apellidos']);
$f->campos['direccion'] = $f->text("direccion", $perfil['direccion'], "128", "required", false);
$f->campos['telefonos'] = $f->text("telefonos", $perfil['telefonos'], "128", "required", false);
$f->campos['correo'] = $f->text("correo", $perfil['correo'], "128", "required", false);
$f->campos['sexo'] = $f->campo("sexo", $perfil['sexo']);
$f->campos['creador'] = $f->campo("creador", $perfil['creador']);
$f->campos['foto'] = "<div><img id=\"photo{$f->id}\" src=\"archivos/imagen.php?time={$f->id}&image={$empresa}/{$modulo}/" . $perfil['foto'] . "&width=240&height=320\"/></div>";
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "submit", "Guardar");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['responsabilizar'] = $f->button("responsabilizar" . $f->id, "button", "Responsabilizar");

$f->campos['clave'] = $f->clave("clave" . $f->id, $usuario['clave'], "128", "required", false);
$f->campos['confirmacion'] = $f->clave("confirmacion" . $f->id, $usuario['clave'], "128", "required", false);
/** Celdas * */
$f->celdas["info"] = $f->celda("", $f->campos['info']);
$f->celdas["equipo"] = $f->celda("Equipo de Trabajo:", $f->campos['equipo']);
$f->celdas["perfil"] = $f->celda("Perfil:", $f->campos['perfil']);
$f->celdas["nombres"] = $f->celda("Nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("Apellidos:", $f->campos['apellidos']);
$f->celdas["direccion"] = $f->celda("Dirección:", $f->campos['direccion']);
$f->celdas["telefonos"] = $f->celda("Teléfonos:", $f->campos['telefonos']);
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["clave"] = $f->celda("Clave:", $f->campos['clave']);
$f->celdas["confirmacion"] = $f->celda("Confirmación:", $f->campos['confirmacion']);
/** Filas * */
$f->fila['sf1'] = $f->fila($f->celdas["info"]);
$f->fila['sf2'] = $f->fila($f->celdas["perfil"] . $f->celdas["nombres"] . $f->celdas["apellidos"]);
$f->fila['sf3'] = $f->fila($f->celdas["direccion"] . $f->celdas["telefonos"]);
$f->fila['sf4'] = $f->fila($f->celdas["correo"]);
$f->fila['sf5'] = $f->fila($f->celdas["clave"] . $f->celdas["confirmacion"]);


$f->celdas["foto"] = $f->celda("", $f->campos['foto'], "", "w200");
$f->celdas["datos"] = $f->celda("", $f->fila['sf1'] . $f->fila['sf2'] . $f->fila['sf3'] . $f->fila['sf4'] . $f->fila['sf5']);
/** Filas * */
$f->fila["f1"] = $f->fila($f->celdas["foto"] . $f->celdas["datos"]);
//$f->fila["fila1"] = $f->fila($f->celdas["perfil"] . $f->celdas["nombres"] . $f->celdas["apellidos"]);
//$f->fila["fila2"] = $f->fila($f->celdas["direccion"] . $f->celdas["telefonos"] . $f->celdas["correo"]);
//$f->fila["fila3"] = $f->fila($f->celdas["sexo"] . $f->celdas["creado"] . $f->celdas["actualizado"]);
//$f->fila["fila4"] = $f->fila($f->celdas["creador"]);
/** Compilando * */
$f->filas($f->fila['f1']);
//$f->filas($f->fila['fila2']);
//$f->filas($f->fila['fila3']);
//$f->filas($f->fila['fila4']);
/** Botones * */
$f->botones($f->campos["ayuda"], "inferior-izquierda");
$f->botones($f->campos["modificar"], "inferior-derecha");
$f->botones($f->campos["cancelar"], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'),\"Perfil Personal - <span style=\'color:#47639E;\'>" . $perfil['nombre'] . "</span>\");");
if (empty($trasmision)) {
  $f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'),{width: 640,height:350});");
} else {
  $f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'),{width: 640,height:390});");
}
//$f->JavaScript("MUI.centerWindow($('".$f->ventana."'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
//$f->eClick("modificar".$f->id,"MUI.Usuarios_Usuario_Perfil_Modificar();");
?>
