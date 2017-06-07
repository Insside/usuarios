<?php
$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
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
$_path= dirname(__FILE__);
$usuario=Sesion::usuario();
$v['uid']=$usuario['usuario'];
$v['criterio']=$validaciones->recibir("criterio");
$v['valor']=$validaciones->recibir("valor");
$v['inicio']=$validaciones->recibir("inicio");
$v['fin']=$validaciones->recibir("fin");
$v['transaccion']=$validaciones->recibir("transaccion");
$v['url']="modulos/usuarios/formularios/perfiles/consultar/perfiles.json.php?"
        . "uid=".$v['uid']
        . "&criterio=".$v['criterio']
        . "&valor=".$v['valor']
        . "&inicio=".$v['inicio']
        . "&fin=".$v['fin']
        . "&transaccion=".$v['transaccion'];

/** Creación de la tabla **/
$tabla = new Grid(array("id" =>"Grid_". time(), "url" => $v['url']));
$tabla->boton('btnCrear', 'Crear', '', "MUI.Usuarios_Perfiles_Perfil_Crear", "new");
$tabla->boton('btnModificar', 'Modificar', 'perfil', "MUI.Usuarios_Perfiles_Perfil_Modificar", "edit");
$tabla->boton('btnEliminar', 'Eliminar', 'perfil', "MUI.Usuarios_Perfiles_Perfil_Eliminar", "pEliminar");
$tabla->boton('btnBuscar', 'Filtrar', '', "MUI.Usuarios_Perfiles_Buscar", "pBuscar");
//$tabla->boton('btnPermisos', 'Permisos', 'rol', "MUI.Usuarios_Roles_Rol_Permisos", "new");
$tabla->columna('cPerfil', 'Perfil', 'perfil', 'string', '90', 'center', 'false');
$tabla->columna('cNombre', 'Nombre', 'nombre', 'string', '200', 'left', 'false');
$tabla->columna('cDireccion', 'Dirección', 'direccion', 'string', '200', 'left', 'false');
$tabla->columna('cCorreo', 'Correo Electrónico', 'correo', 'string', '150', 'center', 'false');
$tabla->columna('cTelefonos', 'Teléfonos', 'telefonos', 'string', '90', 'center', 'false');
$tabla->generar();
?>
