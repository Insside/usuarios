<?php

$usuarios = new Usuarios();
$usuario = $usuarios->consultar($v["usuario"]);
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

/** Clases Declaradas E Inicializadas * */
$uj = new Usuarios_Jerarquias();
$ur=new Usuarios_Roles();
/** Tabla * */
$ujlistado= $uj->consultar($usuario["usuario"]);
$ujtabla = "<div id=\"muij\" class=\"\">";
$conteo = 0;
foreach ($ujlistado as $fila){
    $conteo++;
    $rol=$ur->consultar($fila['rol'] );
    $ujtabla.=""
            . "<div class=\"fila\">"
            . "<div class=\"celda w16\"><b>" . str_pad($conteo,2, '0', STR_PAD_LEFT) . "</b></div>"
            . "<div class=\"celda w64\">" . $fila['rol'] . "</div>"
             . "<div class=\"celda\"><a href=\"#\" onClick=\"MUI.Usuarios_Rol_Visualizar('".$fila['rol'] ."','');\">" . $rol['nombre'] . "</a></div>"
            . "<div class=\"celda w64\">" . $fila['fecha'] . "</div>"
            . "<div class=\"celda w64\">" . $fila['hora'] . "</div>"
            . "</div>";
}
$ujtabla.="</div>";
/** Campos * */
$f->campos["jerarquias-info"] = "<p>Consultar la jerarquía de un usuario es obtener el listado de roles asignados "
        . "al mismo, como listado de sus funciones en el sistema. Para modificar los roles asignados a este usuario "
        . "ingrese aquí [ <a href=\"#\">Modificar Roles</a> ].</p>";
/** Celdas * */
$f->celdas["jerarquias-info"] = $f->celda("<b>Roles Asignados / Jerarquia</b>", $f->campos["jerarquias-info"]);
$f->celdas["ujtabla"] = $ujtabla;
$f->fila["jerarquias-info"] = $f->fila($f->celdas["jerarquias-info"]);
$f->fila["jf1"] = $f->fila($f->celdas["ujtabla"]);
$f->celdas["foto"] = $f->celda("", $f->campos["foto"], "", "w200");
$f->celdas["datos"] = $f->celda("", $f->fila["jerarquias-info"] . $f->fila["jf1"]);
/** Filas * */
$f->fila["roles"] = $f->fila($f->celdas["foto"] . $f->celdas["datos"]);
?>