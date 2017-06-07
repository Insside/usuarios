<?php
$ROOT = (!isset($ROOT)) ? "../../../../../../../" : $ROOT;
require_once($ROOT . "modulos/usuarios/librerias/Configuracion.cnf.php");
$up=new Usuarios_Perfiles();
$fechas=new Fechas();
/* 
 * Copyright (c) 2016, Alexis
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
$v['criterio']=$validaciones->recibir("criterio");
$v['valor']=$validaciones->recibir("valor");
$v['fechainicial']=$validaciones->recibir("fechainicial");   
$v['fechafinal']=$validaciones->recibir("fechafinal");

$s['fechainicial']=$validaciones->recibir("fechainicial");
$s['fechafinal']=$validaciones->recibir("fechafinal");

$v['fechainicial']=empty($s['fechainicial'])?"2012-01-01":$s['fechainicial'];
$v['fechafinal']=empty($s['fechafinal'])?$fechas->hoy():$s['fechafinal'];
/** Consultando **/
$upgl=$up->getListFilter(array()); 
/** Campos **/
$f->campos['criterio']=$f->getSelect(array("id" =>"criterio","values" => $upgl,"label" => "nombre","option" => "campo","onChange" => "","selected"=>$v['criterio']));
$f->campos['valor']=$f->text("valor",$v['valor'], "8","", false);
$f->campos['fechainicial']=$f->calendario("fechainicial",$v['fechainicial'],"-1","2");
$f->campos['fechafinal']=$f->calendario("fechafinal",$v['fechafinal'],"-1");
$f->campos['buscar'] = $f->button("buscar" . $f->id, "submit","Filtrar");
/** Celdas **/
$f->celdas["criterio"] = $f->celda("Criterio:", $f->campos['criterio']);
$f->celdas["valor"] = $f->celda("Valor:", $f->campos['valor']);
$f->celdas["fechainicial"] = $f->celda("Fecha Inicial:", $f->campos['fechainicial']);
$f->celdas["fechafinal"] = $f->celda("Fecha Final:", $f->campos['fechafinal']);
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["criterio"]);
$f->fila["fila2"] = $f->fila($f->celdas["valor"]);
$f->fila["fila3"] = $f->fila($f->celdas["fechainicial"]);
$f->fila["fila4"] = $f->fila($f->celdas["fechafinal"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->filas($f->fila['fila4']);
/** Botones **/
$f->botones($f->campos['buscar'], "inferior-izquierda");
?>