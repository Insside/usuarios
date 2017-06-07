<?php

$db = new MySQL(Sesion::getConexion());
$consulta = $db->sql_query("SELECT * FROM `usuarios_acciones` WHERE(`usuario`='" . $v['usuario'] . "') ORDER BY `fecha`,`hora` DESC;");
$tabla = "<div id=\"muh\" class=\"h265\">";
$conteo = 0;
while ($fila = $db->sql_fetchrow($consulta)) {
    $conteo++;
    $tabla.=""
            . "<div class=\"fila\">"
            . "<div class=\"celda\">" . str_pad($conteo,6, '0', STR_PAD_LEFT) . "</div>"
            . "<div class=\"celda\">" . $fila['fecha'] . "</div>"
            . "<div class=\"celda\">" . $fila['hora'] . "</div>"
            . "<div class=\"celda\">" . $fila['modulo'] . "</div>"
            . "<div class=\"celda\">" . $cadenas->capitalizar($fila['tipo']) . "</div>"
            . "<div class=\"celda\">" . $cadenas->capitalizar($fila['valor']) . "</div>"
            . "<div class=\"celda\">" . $cadenas->recortar($fila['descripcion'], 25) . "</div>"
            . "</div>";
}
$tabla.="</div>";
$db->sql_close();
$f->celdas["tabla"] = $tabla;
/** Filas * */
$f->fila["historial"] = $f->fila($f->celdas["tabla"]);
?>