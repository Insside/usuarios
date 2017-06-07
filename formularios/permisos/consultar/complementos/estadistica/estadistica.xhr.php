<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
/*
 * Este archivo XHR retorna las estadisticas asociadas a las solicitudes procesadas por un usuario
 * del sistema las cuales a saber estan distribuidas como recibidas, procesadas y pendientes.
 * La información se proporsiona en cifras y prorcentajes exactos. 
 * 
 * Copyright (c) 2015, Jose Alexis Correa Valencia
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
/** Clases **/
$sesion=new Sesion();
$validaciones=new Validaciones();
$permisos=new Usuarios_Permisos();
/** Variables **/
$usuario=Sesion::usuario();
$t=$permisos->conteo();
?>

<h2>Permisos Registrados</h2>
<p class="critico"><?php echo($t); ?></p>
<div class="criticoporcentual"><a href="#" onClick="#">TOTAL 100%</a> </div>
<br>
<p>  
    La información visualizada corresponde a la totalidad de permisos registrados y activos en el sistema, 
    Nos permitimos recordarle que los permisos no se crean ni se destruyen por parte de los administradores 
    del sistema, estos son creados y redefinidos en la programación de los diversos módulos y su utilización 
    se limita a su asignación a uno o varios roles, para su utilización.
</p>
<hr>
<p>
  Para mayor información y referencia técnica visite:
  <a href="http://www.insside.com/plataforma/imis/usuarios/permisos.html" target="_blank">
    Insside / Imis / Usuarios / Permisos
  </a>
</p>