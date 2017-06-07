<?php
$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
$sesion=new Sesion();
$validaciones=new Validaciones();
/*
 * Copyright (c) 2013, Alexis
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
$usuario=Sesion::usuario();
$v['uid']=$usuario['usuario'];
$v['criterio']=$validaciones->recibir("criterio");
$v['valor']=$validaciones->recibir("valor");
$v['fechainicial']=$validaciones->recibir("fechainicial");
$v['fechafinal']=$validaciones->recibir("fechafinal");
$v['transaccion']=$validaciones->recibir("transaccion");
$v['url']="modulos/usuarios/formularios/permisos/consultar/permisos.json.php?"
        . "uid=".$v['uid']
        . "&criterio=".$v['criterio']
        . "&valor=".$v['valor']
        . "&fechainicial=".$v['fechainicial']
        . "&fechafinal=".$v['fechafinal']
        . "&transaccion=".$v['transaccion'];

/** Creación de la tabla **/
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url']));
$tabla->boton('btnVer', 'Visualizar', 'permiso', "MUI.Usuarios_Permisos_Permiso_Consultar", "pVer");
//$tabla->boton('btnModificar', 'Modificar', 'rol', "MUI.Usuarios_Roles_Rol_Modificar", "edit");
//$tabla->boton('btnEliminar', 'Eliminar', 'rol', "MUI.Usuarios_Roles_Rol_Eliminar", "pEliminar");
//$tabla->boton('btnBuscar', 'Buscar', '', "MUI.Usuarios_Roles_Complementos_Buscar", "pBuscar");
//$tabla->boton('btnPermisos', 'Permisos', 'rol', "MUI.Usuarios_Roles_Rol_Permisos", "new");
$tabla->columna('cCodigo', 'Codigo del Permiso', 'codigo', 'string', '300', 'left', 'false');
$tabla->columna('cPermiso', 'Permiso', 'permiso', 'string', '300', 'right', 'true');
$tabla->columna('cNombrel', 'Nombre', 'nombre', 'string', '200', 'left', 'false');
$tabla->columna('cDescripcion', 'Descripción', 'descripcion', 'string', '300', 'left', 'false');
$tabla->columna('cFecha', 'Fecha', 'fecha', 'date', '90', 'center', 'false');
$tabla->columna('cHora', 'Hora', 'hora', 'string', '90', 'center', 'false');
$tabla->generar();
?>
